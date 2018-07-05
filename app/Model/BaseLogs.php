<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BaseLogs extends Model
{
    protected $table = 'base_logs';

    protected $fillable = ['uri', 'params', 'admin_id', 'status_code', 'method', 'display_name'];

    /**
     * 作用域
     */
    public static function boot(){
        static::addGlobalScope('orderBy', function(Builder $builder) {
            $builder->orderBy('id', 'DESC');
        });
    }
    /**
     * 关联操作人
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin(){
        return $this->belongsTo(BaseAdmin::class, 'admin_id', 'id');
    }
}
