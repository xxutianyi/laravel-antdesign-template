<?php

namespace App\Utils;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class IPLocation
{
    public string $ip;
    public string|null $region;
    public string|null $city;
    public string|null $country;

    /**
     * @throws GuzzleException
     */
    public function __construct($ip)
    {
        $this->ip = $ip;
        $this->callApi();
    }

    /**
     * @return void
     * @throws GuzzleException
     * @throws Exception
     */
    private function callApi(): void
    {
        $secretId = config('utils.ip_api.id');
        $secretKey = config('utils.ip_api.secret');
        $source = 'market';

        // 签名
        $datetime = gmdate('D, d M Y H:i:s T');
        $signStr = sprintf("x-date: %s\nx-source: %s", $datetime, $source);
        $sign = base64_encode(hash_hmac('sha1', $signStr, $secretKey, true));
        $auth = sprintf('hmac id="%s", algorithm="hmac-sha1", headers="x-date x-source", signature="%s"', $secretId, $sign);

        // 请求头
        $headers = array(
            'X-Source' => $source,
            'X-Date' => $datetime,
            'Authorization' => $auth,

        );

        $queryParams = array(
            'ip' => $this->ip,
        );
        $url = 'https://service-7dioukzx-1301232119.bj.apigw.tencentcs.com/release/IpAddrquery';

        $client = new Client();

        $res = $client->get($url, [
            'headers' => $headers,
            'query' => $queryParams
        ])->getBody();

        $res = json_decode($res, true);

        if ($res['error_code']) {
            throw new Exception('IP Api Error:' . json_encode($res));
        }

        $res = $res['result'];

        $this->country = $res['country'];
        $this->region = $res['province'];
        $this->city = $res['city'];
    }
}
