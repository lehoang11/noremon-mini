<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Cache;
use File;
use Sproduct;
use Cart;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        View::share('title', null);
        View::share('breadcrumbs', null);

        View::composer(['site.block.header'], function($view) {
            $data['global_cate'] = Cache::remember('cate_cache_key', 18000, function() {
                return Sproduct::globalProCategory();
            });
            
            $view->with($data);
            
         });


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('backend', function() {
            return new \App\Services\Backend;
        });

        $this->app->bind('smenu', function() {
            return new \App\Services\Smenu;
        });
        $this->app->bind('srole', function() {
            return new \App\Services\Srole;
        });

        $this->app->bind('sproduct', function() {
            return new \App\Services\Sproduct;
        });

        $this->app->bind('uploadimage', function() {
            return new \App\Services\Uploadimage;
        });
    }
}
