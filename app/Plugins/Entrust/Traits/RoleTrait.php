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
     * eloquent save 后刷新缓存
     * @method save
     * @param array $options
     *
     * @return bool
     *
     * @author luffyzhao@vip.126.com
     */
    public function save(array $options = [])
    {   //both inserts and updates
        if (!parent::save($options)) {
            return false;
        }
        if (Cache::getStore() instanceof TaggableStore) {
            Cache::tags('BaseAuth')->flush();
        }
        return true;
    }

    /**
     * eloquent delete 后刷新缓存
     * @method delete
     * @param array $options
     *
     * @return bool
     *
     * @author luffyzhao@vip.126.com
     */
    public function delete(array $options = [])
    {   //soft or hard
        if (!parent::delete($options)) {
            return false;
        }
        if (Cache::getStore() instanceof TaggableStore) {
            Cache::tags('BaseAuth')->flush();
        }
        return true;
    }

    /**
     * eloquent restore 后刷新缓存
     * @method delete
     * @param array $options
     *
     * @return bool
     *
     * @author luffyzhao@vip.126.com
     */
    public function restore()
    {   //soft delete undo's
        if (!parent::restore()) {
            return false;
        }
        if (Cache::getStore() instanceof TaggableStore) {
            Cache::tags('BaseAuth')->flush();
        }
        return true;
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

    /**
     * 定义删除事件
     * @method boot
     *
     * @static
     *
     * @author luffyzhao@vip.126.com
     */
    public static function boot()
    {
        parent::boot();

        static::deleting(function ($role) {
            if (!method_exists(static::class, 'bootSoftDeletes')) {
                $role->perms()->sync([]);
            }

            return true;
        });
    }
}