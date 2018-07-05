<?php

namespace App\Http\Requests\Base\Permission;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class UpdateRequest extends FormRequest
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
            'parent_id' => ['required', 'integer'],
            'name' => ['required', 'string', 'between:2,50', Rule::unique('base_permissions')->ignore($this->route('permission'))],
            'icon' => ['string', 'nullable', 'max:200', 'required_if:islink,1'],
            'display_name' => ['required', 'string', 'between:2,50'],
            'description' => ['nullable', 'string', 'max:200'],
            'sort' => ['required', 'integer', 'between:0,999'],
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
    public function attributes()
    {
        return [
            'parent_id' => '所属上级',
            'name' => '权限标识',
            'icon' => '菜单图标',
            'islink' => '是否菜单',
            'display_name' => '权限名称',
            'description' => '权限说明',
            'sort' => '排序'
        ];
    }

    /**
     * 错误提示
     * @method messages
     *
     * @return array
     *
     * @author luffyzhao@vip.126.com
     */
    public function messages()
    {
        return [
            'icon.required_if' => '当菜单&权限为菜单时，菜单图标不能为空'
        ];
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
            if (!$this->linkForParent()) {
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
    protected function linkForParent(){
        $islink = $this->input('islink');
        if($islink == 0){
            $perm = $this->route('permission');
            return DB::table('base_permissions')->where('parent_id', $perm)->count() === 0;
        }
        return true;
    }
}
