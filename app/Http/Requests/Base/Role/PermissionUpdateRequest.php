<?php

namespace App\Http\Requests\Base\Role;

use Illuminate\Foundation\Http\FormRequest;

class PermissionUpdateRequest extends FormRequest
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
            'permission' => ['nullable', 'array'],
            'permission.*' => ['integer']
        ];
    }

    public function messages()
    {
        return [
            'permission.array' => '格式不正确！'
        ];
    }
}
