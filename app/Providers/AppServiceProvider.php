<?php

namespace App\Providers;

use App\Models\CourseCategory;
use App\Models\Extra;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Models\Setting;
use App\Models\Menu;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();
        $setting = Setting::first();
        View::share('setting', $setting);
        View::share('globalExtra', Extra::get());
        View::share('category', CourseCategory::latest()->where('publish_status', '1')->where('delete_status', '0')->take('5')->get());
    }
}
