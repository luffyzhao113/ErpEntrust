<?php

namespace App\Http\Requests\Base\Admin;

use App\Model\BaseAdmin;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    protected $admin;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $admin = $this->admin();
        return $admin && $admin->roles->super == 0;
    }

    /**
     * 验证的用户
     * @method admin
     *
     * @return mixed
     *
     * @author luffyzhao@vip.126.com
     */
    public function admin(){
        if(!$this->admin){
            $this->admin = BaseAdmin::find($this->route('admin'));
        }
        return $this->admin;
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
            'email' => ['required', 'string', 'email', 'between:3,100', Rule::unique('base_admins')->ignore($this->route('admin'))],
            'role_id' => ['required', 'integer', 'min:1'],
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
            'status' => '用户状态',
            'email' => '登录邮箱',
            'role_id' => '角色ID',
            'password' => '用户密码',
            'password_confirmation' => '确认密码'
        ];
    }
}
