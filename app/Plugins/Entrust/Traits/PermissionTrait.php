<?php
/**
 * luffy-restaurant-order
 * PermissionTrait.php.
 * @author luffyzhao@vip.126.com
 */

namespace App\Plugins\Entrust\Traits;


use Illuminate\Support\Facades\Config;

trait PermissionTrait
{
    /**
     * 权限模型
     * @var
     * @author luffyzhao@vip.126.com
     */
//    protected $entrustPermissionModel = Model::class;
    /**
     * 角色与权限中间表
     * @var
     * @author luffyzhao@vip.126.com
     */
//    protected $entrustPermissionRoleTable = '';

    /**
     * 多对多关联角色模型
     * @method role
     *
     * @return mixed
     *
     * @author luffyzhao@vip.126.com
     */
    public function roles()
    {
        return $this->belongsToMany($this->entrustPermissionModel, $this->entrustPermissionRoleTable, 'permission_id', 'role_id');
    }

}