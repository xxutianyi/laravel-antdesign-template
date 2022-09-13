<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use xXutianyi\WecomAuth\Config;
use xXutianyi\WecomAuth\SDK\Authen;
use function inertia;
use function redirect;

class LocalSessionController extends Controller
{

    private $sdk;
    private $sdkConfig;

    public function __construct()
    {
        $this->sdkConfig = new Config(\config('wecom.corp_id'), \config('wecom.corp_secret'), \config('wecom.agent_id'));
        $this->sdk = new Authen($this->sdkConfig);
    }

    public function wecom()
    {
        $url = $this->sdk->GetBootUrl(route('login.wecom'));
        return response()->redirectTo($url);
    }

    public function create(Request $request): \Inertia\Response|\Inertia\ResponseFactory|\Illuminate\Http\RedirectResponse
    {
        if (str_contains($request->userAgent(), 'wxwork')) {
            return $this->wecom();
        }

        if (Auth::check()) {
            return redirect()->intended();
        }

        return inertia('Auth/Login', ['user_wecom_id' => $request->user_wecom_id]);
    }

    public function store(LoginRequest $request): \Illuminate\Http\RedirectResponse
    {

        if (Auth::check()) {
            return redirect()->intended();
        }

        $request->authenticate();

        if ($request->user_wecom_id) {
            $user = Auth::user();
            $user->wecom_id = $request->user_wecom_id;
            $user->save();
        }

        return redirect()->intended();
    }

    public function destroy(): \Illuminate\Http\RedirectResponse
    {
        Auth::logout();

        return redirect()->route('login.create');
    }

}
