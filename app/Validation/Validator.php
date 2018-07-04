<?php
/**
 * luffy-restaurant-order
 * Validator.php.
 * @author luffyzhao@vip.126.com
 */

namespace App\Validation;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator as Base;

class Validator extends Base
{
    /**
     * 手机号码
     * @method ValidatePhone
     * @param $attribute
     * @param $value
     * @param $parameters
     *
     * @return false|int
     *
     * @author luffyzhao@vip.126.com
     */
    public function ValidatePhone($attribute, $value, $parameters)
    {
        return preg_match('/^1[3456789]\d{9}$/', $value);
    }

    /**
     * 是否下级
     * @method ValidateHasData
     * @param $attribute
     * @param $value
     * @param $parameters
     *
     * @return bool
     *
     * @author luffyzhao@vip.126.com
     */
    public function ValidateHasData($attribute, $value, $parameters){
        $table = $parameters[0] ?? '';
        $column = $parameters[1] ?? 'parent_id';
        return DB::table($table)->where($column, '=', $value)->value('id') === null ? true : false;
    }
}