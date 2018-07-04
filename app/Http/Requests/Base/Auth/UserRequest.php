<?php
/**
 * luffy-restaurant-order
 * UserRequest.php.
 * @author luffyzhao@vip.126.com
 */

namespace App\Http\Requests\Base\Auth;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    /**
     * 验证规则
     * @method rules
     *
     * @return array
     *
     * @author luffyzhao@vip.126.com
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'between:2,10'],
            'email' => ['required', 'string', 'email', 'between:3,100', Rule::unique('base_admins')->ignore(auth('base')->user()->id)],
            'password' => ['nullable', 'between:6,20', 'confirmed'],
            'password_confirmation' => ['nullable', 'between:6,20'],
        ];
    }

    /**
     * 字段中文名称
     * @method attributes
     *
     * @return array
     *
     * @author luffyzhao@vip.126.com
     */
    public function attributes(){
        return [
            'name' => '用户姓名',
            'email' => '登录邮箱',
            'password' => '用户密码',
            'password_confirmation' => '确认密码'
        ];
    }
}