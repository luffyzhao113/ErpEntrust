<?php

namespace App\Searchs\Modules\Base\Role;

use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class IndexSearch extends SearchAbstract
{
    protected $relationship = [
        'name' => '='
    ];
}
