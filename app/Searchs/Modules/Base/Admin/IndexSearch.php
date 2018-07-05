<?php
/**
 * Created by PhpStorm.
 * User: luffyzhao
 * Date: 2018/6/26
 * Time: 20:35
 */

namespace App\Searchs\Modules\Base\Admin;


use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class IndexSearch extends SearchAbstract
{
    protected $relationship = [
        'role_id' => '=',
        'name' => 'like',
        'status' => '=',
        'email' => 'like'
    ];

    /**
     * name模糊查询
     * @method getNameAttribute
     * @param $value
     * @param $data
     *
     * @return string
     *
     * @author luffyzhao@vip.126.com
     */
    protected function getNameAttribute($value, $data)
    {
        return "%{$value}%";
    }

    /**
     * email模糊查询
     * @method getEmailAttribute
     * @param $value
     * @param $data
     *
     * @return string
     *
     * @author luffyzhao@vip.126.com
     */
    protected function getEmailAttribute($value, $data)
    {
        return "%{$value}%";
    }
}