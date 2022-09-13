<?php

namespace App\Http\Requests\Landing;

use App\Utils\SMSCaptcha;
use Illuminate\Foundation\Http\FormRequest;

class LandingRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required'],
            'mobile' => [
                'required',
                'regex:/^(13\d|14[01456879]|15[0-35-9]|16[2567]|17[0-8]|18\d|19[0-35-9])\d{8}$/'
            ],
            'captcha' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!SMSCaptcha::check($this->mobile, $value)) {
                        $fail("验证码错误，请核对或重新获取");
                    }
                },
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '请输入您的名字',
            'captcha.required' => '请输入验证码',
            'mobile.required' => '请输入手机号',
            'mobile.regex' => '手机号格式错误',
        ];
    }
}
