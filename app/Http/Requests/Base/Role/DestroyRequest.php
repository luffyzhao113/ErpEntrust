<?php

namespace App\Http\Requests\Base\Role;

use App\Model\BaseRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class DestroyRequest extends FormRequest
{
    protected $role;
    /**
     * 验证
     * @method authorize
     *
     * @return bool
     *
     * @author luffyzhao@vip.126.com
     */
    public function authorize()
    {
        $role = $this->role();
        return $role && $role->super === 0;
    }

    /**
     * role 数据模型
     * @method model
     *
     * @author luffyzhao@vip.126.com
     */
    public function role(){
        if(!$this->role){
            $this->role = BaseRole::where('id', $this->route('role'))->withCount(['users'])->first();
        }
        return $this->role;
    }

    /**
     * 验证规则
     * @method rules
     *
     * @return array
     *
     * @author luffyzhao@vip.126.com
     */
    public function rules(){
        return [];
    }

    /**
     * 添加验证后钩子
     * @method withValidator
     * @param Validator $validator
     *
     * @author luffyzhao@vip.126.com
     */
    public function withValidator(Validator $validator){
        $validator->after(function ($validator) {
            if ($this->role->users_count !== 0) {
                $validator->errors()->add('', '角色下还有用户不能删除');
            }
        });
    }
}
