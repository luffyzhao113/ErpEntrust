<?php

namespace App\Http\Requests\Base\Permission;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => ['required', 'string', 'between:2,50', 'unique:base_permissions'],
            'icon' => ['string', 'nullable', 'max:200', 'required_if:islink,1'],
            'islink' => ['required', 'numeric', 'in:0,1'],
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
}
