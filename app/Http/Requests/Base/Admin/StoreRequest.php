<?php

namespace App\Http\Requests\Base\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    /**
     * 身份验证
     * @method authorize
     *
     * @return bool
     *
     * @author luffyzhao@vip.126.com
     */
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
            'status' => ['required', 'numeric', 'in:0,1'],
            'email' => ['required', 'string', 'email', 'between:3,100', Rule::unique('base_admins')],
            'role_id' => ['required', 'integer', 'min:1'],
            'password' => ['required', 'string', 'between:6,20', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'between:6,20'],
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
            'status' => '用户状态',
            'email' => '登录邮箱',
            'role_id' => '角色ID',
            'password' => '用户密码',
            'password_confirmation' => '确认密码'
        ];
    }
}
