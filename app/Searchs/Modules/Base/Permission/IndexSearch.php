<?php

namespace App\Searchs\Modules\Base\Permission;

use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class IndexSearch extends SearchAbstract
{
    protected $relationship = [
        'islink' => '='
    ];

    /**
     * 是否菜单
     * @method getIslinkAttribute
     * @param $val
     * @param $data
     *
     * @return bool
     *
     * @author luffyzhao@vip.126.com
     */
    protected function getIslinkAttribute($val, $data){
        if(!in_array($val, [0, 1])){
            return false;
        }
        return $val;
    }
}
