<?php

namespace App\Searchs\Modules\Base\Logs;

use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class IndexSearch extends SearchAbstract
{
    protected $relationship = [
        'admin_id' => '='
    ];
}
