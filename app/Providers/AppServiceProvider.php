<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator as BaseValidator;
use App\Validation\Validator;
use Illuminate\Contracts\Translation\Translator;
use App\Repositories\Modules\BaseAdmin\Provider AS BaseAdmin;
use App\Repositories\Modules\BasePermission\Provider AS BasePermission;
use App\Repositories\Modules\BaseRole\Provider AS BaseRole;
use App\Repositories\Modules\BaseLogs\Provider AS BaseLogs;
use App\Repositories\Modules\Notification\Provider as Notification;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        BaseValidator::resolver(function(Translator $translator, array $data, array $rules,
            array $messages = [], array $customAttributes = [])
        {
            return new Validator($translator, $data, $rules, $messages, $customAttributes);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(Notification::class);
        $this->app->register(BaseAdmin::class);
        $this->app->register(BasePermission::class);
        $this->app->register(BaseRole::class);
        $this->app->register(BaseLogs::class);
    }
}
