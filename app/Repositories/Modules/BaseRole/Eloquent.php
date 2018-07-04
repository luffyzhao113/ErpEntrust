<?php

namespace App\Repositories\Modules\BaseRole;

use luffyzhao\laravelTools\Repositories\Facades\RepositoriesAbstract;
use Illuminate\Database\Eloquent\Model;

class Eloquent extends RepositoriesAbstract implements Interfaces
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * 统计关联结果数目
     * @method withCount
     * @param $relations
     *
     * @return $this
     *
     * @author luffyzhao@vip.126.com
     */
    public function withCount($relations){
        $this->model = $this->model->withCount($relations);
        return $this;
    }
}
