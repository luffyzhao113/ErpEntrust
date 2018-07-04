<?php

namespace App\Http\Requests\Base\Permission;

use App\Model\BasePermission;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator;

class DestroyRequest extends FormRequest
{
    /**
     * 权限验证
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
     * 添加验证后钩子
     * @method withValidator
     * @param Validator $validator
     *
     * @author luffyzhao@vip.126.com
     */
    public function withValidator(Validator $validator){
        $validator->after(function ($validator) {
            if (!$this->hasChild()) {
                $validator->errors()->add('islink', '菜单还有下级不能修改成权限');
            }
        });
    }

    /**
     * 权限不能有下级
     * @method linkForParent
     *
     * @return bool
     *
     * @author luffyzhao@vip.126.com
     */
    protected function hasChild(){
        return DB::table('base_permissions')->where('parent_id', $this->route('permission'))->count() === 0;
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
}
