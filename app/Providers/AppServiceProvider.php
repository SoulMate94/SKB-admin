<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Encore\Admin\Config\Config as LaravelAdminConfig;
use Illuminate\Http\Resources\Json\Resource;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);  // 针对 key was too long;

        if (! \Schema::hasTable('admin_config')) {
            // Init laravel-admin table first
            // TODO: `php artisan migrate`
        } else {
            LaravelAdminConfig::load();
        }

        // resource 没有wrap
        Resource::withoutWrapping();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
