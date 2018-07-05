<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Plugins\Entrust\Traits\PermissionTrait;

class BasePermission extends Model
{
    use PermissionTrait;

    protected $fillable = ['parent_id', 'name', 'icon', 'islink', 'display_name', 'description', 'sort'];

    protected $entrustPermissionModel = BasePermission::class;

    protected $entrustPermissionRoleTable = 'base_permission_role';

    /**
     * 作用域
     */
    public static function boot(){
        static::addGlobalScope('orderBy', function(Builder $builder) {
            $builder->orderBy('sort', 'ASC')->orderBy('id', 'DESC');
        });
    }
}
