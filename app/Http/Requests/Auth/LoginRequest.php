<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{

    /**
     * 用户权限
     * @return bool
     * @throws ValidationException
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * 第一个规则失败后停止
     * @var bool
     */
    protected $stopOnFirstFailure = true;

    /**
     * 验证规则
     * @return array
     * @throws ValidationException
     */
    public function rules(): array
    {
        $this->ensureIsNotRateLimited();
        RateLimiter::hit($this->throttleKey());
        return [
            'mobile' => ['required', 'string', 'exists:users'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * 自定义错误提示
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'mobile.exists' => '用户未注册，请联系管理员'
        ];
    }

    /**
     * 登录认证
     * @return void
     * @throws ValidationException
     */
    public function authenticate()
    {

        if (!Auth::attempt($this->only('mobile', 'password'), $this->boolean('remember'))) {

            throw ValidationException::withMessages([
                'mobile' => '用户名或密码错误',
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }


    /**
     * 流量控制
     * @return void
     * @throws ValidationException
     */
    public function ensureIsNotRateLimited()
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'mobile' => "错误次数过多，请 $seconds 秒后重试"
        ]);
    }

    /**
     * 流量控制关键字
     * @return string
     */
    public function throttleKey(): string
    {
        return Str::lower($this->input('mobile')) . '|' . $this->ip();
    }
}
