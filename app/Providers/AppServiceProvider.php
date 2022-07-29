<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\SettingModel;
use App\SettingsVpn;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $appsettings = SettingsVpn::select('cronjob')->first();
        view()->share('appsettings',$appsettings);
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
