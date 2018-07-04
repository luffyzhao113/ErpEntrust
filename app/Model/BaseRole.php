<?php

namespace App\Model;

use App\Entrust\Traits\RoleTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class BaseRole extends Model
{
    use RoleTrait;

    protected $entrustUserModel = BaseAdmin::class;

    protected $entrustRoleUserTable = 'base_role_admin';

    protected $entrustPermissionModel = BasePermission::class;

    protected $entrustPermissionRoleTable = 'base_permission_role';

    protected $fillable = ['name', 'status', 'description'];

    /**
     * 不显示or包含超级管理员
     * @param Builder $query
     * @return Builder
     */
    public function scopeHideSuper(Builder $query){
        return $query->where('super', '=', 0);
    }
}
