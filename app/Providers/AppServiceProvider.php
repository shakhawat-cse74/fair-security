<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use App\Models\SystemSetting;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $systemSettings = SystemSetting::getCached();
        View::share('systemSettings', $systemSettings);
        
        $this->app->singleton('system.settings', function () use ($systemSettings) {
            return $systemSettings;
        });
    }
}
