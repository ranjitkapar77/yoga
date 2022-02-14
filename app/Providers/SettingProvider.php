<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class SettingProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Setting', function ($app) {
            return new Setting();
        });
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Setting', Setting::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (!$this->app->runningInConsole() && count(Schema::getColumnListing('settings'))) {
            $columns =  Schema::getColumnListing('settings');
            $settings = Setting::latest()->first();
            foreach ($columns as $key => $setting) {
                Config::set('settings.' . $setting, $settings[$setting]);
            }
        }
    }
}
