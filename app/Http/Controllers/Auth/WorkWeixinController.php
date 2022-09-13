<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use xXutianyi\WecomAuth\Config;
use xXutianyi\WecomAuth\SDK\Authen;

class WorkWeixinController extends Controller
{
    private Authen $sdk;
    private Config $sdkConfig;

    public function __construct()
    {
        $this->sdkConfig = new Config(\config('wecom.corp_id'), \config('wecom.corp_secret'), \config('wecom.agent_id'));
        $this->sdk = new Authen($this->sdkConfig);
    }

    public function callback(Request $request)
    {
        $code = $request->code;
        $workWeixinUserId = $this->sdk->AuthenByCode($code)['UserId'];
        $user = User::findWecom($workWeixinUserId);
        if ($user) {
            Auth::login($user);
            return $this->intended();
        } else {
            return redirect()->route('login.create', ['user_wecom_id' => $workWeixinUserId]);
        }
    }

}
