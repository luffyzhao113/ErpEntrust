<?php namespace App\Entrust\Traits;


use Illuminate\Cache\TaggableStore;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use InvalidArgumentException;

trait AdminTrait
{
//    /**
//     * 用户对应角色模型
//     * @var
//     * @author luffyzhao@vip.126.com
//     */
//    protected $entrustRoleModel;
//    /**
//     * 用户与角色关联表
//     * @var
//     * @author luffyzhao@vip.126.com
//     */
//    protected $entrustRoleUserTable;
    /**
     * 在缓存开启状态下缓存用户下的所有角色
     * @method cachedRoles
     *
     * @return \Illuminate\Database\Eloquent\Model
     *
     * @author luffyzhao@vip.126.com
     */
    public function cachedRole()
    {
        $userPrimaryKey = $this->primaryKey;
        $cacheKey = get_class($this) . '_for_role_' . $this->{$userPrimaryKey};

        if(Cache::getStore() instanceof TaggableStore) {
            return Cache::tags('BaseAuth')->remember($cacheKey, Config::get('cache.ttl'), function () {
                return $this->roles()->first();
            });
        }
        else return $this->roles()->first();
    }

    /**
     * eloquent save 后刷新缓存
     * @method save
     * @param array $options
     *
     * @return mixed
     *
     * @author luffyzhao@vip.126.com
     */
    public function save(array $options = [])
    {   //both inserts and updates
        if(Cache::getStore() instanceof TaggableStore) {
            Cache::tags(get_class($this))->flush();
        }
        return parent::save($options);
    }

    /**
     * eloquent delete 后刷新缓存
     * @method delete
     * @param array $options
     *
     * @return mixed
     *
     * @author luffyzhao@vip.126.com
     */
    public function delete(array $options = [])
    {   //soft or hard
        $result = parent::delete($options);
        if(Cache::getStore() instanceof TaggableStore) {
            Cache::tags(get_class($this))->flush();
        }
        return $result;
    }

    /**
     * eloquent restore 后刷新缓存
     * @method restore
     *
     * @return mixed
     *
     * @author luffyzhao@vip.126.com
     */
    public function restore()
    {   //soft delete undo's
        $result = parent::restore();
        if(Cache::getStore() instanceof TaggableStore) {
            Cache::tags(get_class($this))->flush();
        }
        return $result;
    }

    /**
     * 多对多关联角色表
     * @method role
     *
     * @return mixed
     *
     * @author luffyzhao@vip.126.com
     */
    public function roles()
    {
        return $this->belongsTo($this->entrustRoleModel,'role_id', 'id');
    }

    /**
     * Check if user has a permission by its name.
     *
     * @param string|array $permission Permission string or array of permissions.
     * @param bool         $requireAll All permissions in the array are required.
     *
     * @return bool
     */
    public function can($permission, $requireAll = false)
    {
        $role = $this->cachedRole();
        if($role && $role->super === 1){
            return true;
        }
        foreach ($role->cachedPermissions() as $perm) {
            if (str_is( $permission, $perm->name) ) {
                return true;
            }
        }

        return false;
    }

    /**
     *Filtering users according to their role
     *
     *@param string $role
     *@return users collection
     */
    public function scopeWithRole($query, $role)
    {
        return $query->whereHas('role', function ($query) use ($role)
        {
            $query->where('name', $role);
        });
    }

}
