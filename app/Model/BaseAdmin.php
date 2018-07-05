<?php

namespace App\Model;

use App\Plugins\Entrust\Traits\AdminTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;


class BaseAdmin extends Authenticatable implements JWTSubject
{
    use AdminTrait, Notifiable;

    protected $fillable = ['name', 'password', 'status', 'role_id', 'email', 'photo'];

    protected $hidden = ['password'];

    protected $entrustRoleModel = BaseRole::class;


    /**
     * 自动加密
     * @method setPasswordAttribute
     * @param $value
     *
     * @author luffyzhao@vip.126.com
     */
    protected function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
