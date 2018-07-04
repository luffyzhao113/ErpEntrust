<?php

namespace App\Repositories\Modules\BasePermission;

use luffyzhao\laravelTools\Repositories\Facades\CacheAbstractDecorator;
use luffyzhao\laravelTools\Repositories\Cache\CacheInterface;

class Cache extends CacheAbstractDecorator implements Interfaces
{
    public function __construct(Interfaces $repo, CacheInterface $cache)
    {
        $this->repo = $repo;
        $this->cache = $cache;
    }

    /**
     * 通过where条件查找一个模型.
     *
     * @method findWhere
     *
     * @param array $attributes Where条件
     * @param array $columns    获取字段
     *
     * @return Illuminate\Support\Collection|static|null
     *
     * @author luffyzhao@vip.126.com
     */
    public function findWhere(array $attributes, array $columns = ['*'])
    {
        $cacheKey = $this->getCache('findWhere', [
            $attributes,
            $columns,
        ]);

        if (!is_string($cacheKey)) {
            return $cacheKey;
        }

        $model = $this->repo->findWhere($attributes, $columns);

        $this->cache->put($cacheKey, $model);

        return $model;
    }
}
