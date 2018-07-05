<?php
/**
 * luffy-restaurant-order
 * RoleTrait.php.
 * @author luffyzhao@vip.126.com
 */

namespace App\Plugins\Entrust\Traits;

use Illuminate\Cache\TaggableStore;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cache;

trait RoleTrait
{
    /**
     * 用户模型
     * @var
     * @author luffyzhao@vip.126.com
     */
//    protected $entrustUserModel = Model::class;
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
     * 缓存角色下所有的权限
     * @method cachedPermissions
     *
     * @return \Illuminate\Database\Eloquent\Collection
     *
     * @author luffyzhao@vip.126.com
     */
    public function cachedPermissions()
    {
        $rolePrimaryKey = $this->primaryKey;
        $cacheKey = get_class($this) . '_for_role_' . $this->$rolePrimaryKey;
        if (Cache::getStore() instanceof TaggableStore) {
            return Cache::tags('BaseAuth')->remember($cacheKey, Config::get('cache.ttl', 60), function () {
                if($this->getAttribute('super') === 0){
                    return $this->perms()->get();
                }else{
                    return $this->entrustPermissionModel::all();
                }
            });
        } else{
            if($this->getAttribute('super') === 0) {
                return $this->perms()->get();
            }else{
                return $this->entrustPermissionModel::all();
            }
        }
    }

    /**
     * 用户模型
     * @method users
     *
     * @return mixed
     *
     * @author luffyzhao@vip.126.com
     */
    public function users()
    {
        return $this->hasMany($this->entrustUserModel, 'role_id', 'id');
    }

    /**
     * 多对多关联权限模型
     * @method perms
     *
     * @return mixed
     *
     * @author luffyzhao@vip.126.com
     */
    public function perms()
    {
        return $this->belongsToMany($this->entrustPermissionModel, $this->entrustPermissionRoleTable, 'role_id', 'permission_id');
    }

}