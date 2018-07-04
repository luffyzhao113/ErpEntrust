<?php

namespace App\Http\Requests\Base\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LockRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password' => ['required', 'string', 'between:6,20']
        ];
    }

    /**
     * 中文字段
     * @method attributes
     *
     * @return array
     *
     * @author luffyzhao@vip.126.com
     */
    public function attributes()
    {
        return [
            'password' => '密码'
        ];
    }
}
