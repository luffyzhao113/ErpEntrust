<?php

namespace App\Repositories\Modules\BaseAdmin;

use luffyzhao\laravelTools\Repositories\Facades\RepositoriesAbstract;
use Illuminate\Database\Eloquent\Model;

class Eloquent extends RepositoriesAbstract implements Interfaces
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * 更新
     * @method update
     * @param Model $model
     * @param array $values
     * @param array $attributes
     *
     * @return Model
     *
     * @author luffyzhao@vip.126.com
     */
    function update(Model $model, array $values, array $attributes = [])
    {
        if(!(isset($values['password']) && $values['password'])){
            unset($values['password']);
        }
        return parent::update($model, $values, $attributes);
    }
}
