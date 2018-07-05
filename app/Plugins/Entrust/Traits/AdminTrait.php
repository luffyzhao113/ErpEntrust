<?php namespace App\Plugins\Entrust\Traits;


use Illuminate\Cache\TaggableStore;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use InvalidArgumentException;

trait AdminTrait
{
    /**
     * 用户对应角色模型
     * @var
     * @author luffyzhao@vip.126.com
     */
//    protected $entrustRoleModel = Model::class;

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
