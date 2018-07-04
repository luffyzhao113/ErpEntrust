<?php

namespace App\Repositories\Modules\BaseRole;

use luffyzhao\laravelTools\Repositories\Facades\RepositoryInterface;

interface Interfaces extends RepositoryInterface
{
    public function withCount($relations);
}
