<?php

namespace App\Repositories\Modules\BaseRole;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Application;
use Config;
use luffyzhao\laravelTools\Repositories\Cache\LaravelCache;
use App\Model\BaseRole;

class Provider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->bind(Interfaces::class, function (Application $app) {
            $repository = new Eloquent(new BaseRole());

            $cache = new LaravelCache($app['cache'], 'BaseAuth', 3600);

            return new Cache($repository, $cache);
        });
    }
}
