<?php

namespace App\Http\Requests\Landing;

use Illuminate\Foundation\Http\FormRequest;

class CaptchaRequest extends FormRequest
{

    public function rules()
    {
        return [
            'mobile' => [
                'required',
                'regex:/^(13\d|14[01456879]|15[0-35-9]|16[2567]|17[0-8]|18\d|19[0-35-9])\d{8}$/'
            ],
        ];
    }

    public function messages()
    {
        return [
            'mobile.required' => '请输入手机号',
            'mobile.regex' => '手机号格式错误',
        ];
    }
}
