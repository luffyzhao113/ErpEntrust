<?php

namespace App\Searchs\Modules\Base\Auth;

use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class MessageSearch extends SearchAbstract
{
    protected $relationship = [
        'read_at' => '='
    ];

    /**
     * 是否已读
     * @param $value
     * @param $data
     * @return \Closure
     */
    protected function getReadAtAttribute($value, $data)
    {
        return function ($query) use ($value){
            if($value){
                $query->whereNull('read_at');
            }else{
                $query->whereNotNull('read_at');
            }
        };
    }
}
