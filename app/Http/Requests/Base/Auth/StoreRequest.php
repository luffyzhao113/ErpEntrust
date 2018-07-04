<?php

namespace App\Http\Requests\Base\Auth;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * 验证规则
     * @return array
     */
    public function rules()
    {
        return [
            'email' => ['required', 'string', 'email', 'between:3,100'],
            'password' => ['required', 'string', 'between:6,20'],
        ];
    }

    /**
     * 字段中文名称
     * @return array
     */
    public function attributes()
    {
        return [
            'email' => '用户邮箱',
            'password' => '用户密码',
        ];
    }
}
