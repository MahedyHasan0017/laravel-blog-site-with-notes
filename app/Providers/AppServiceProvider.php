<?php

namespace App\Providers;

use App\Http\ViewComposers\ActivityComposer;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Schema::defaultStringLength(191) ; 

        Blade::aliasComponent('components.badge','badge');
        Blade::aliasComponent('components.update','updated') ; 
        Blade::aliasComponent('components.tags','tags') ; 

        // Blade::
        //adding view folder and file names 
        view()->composer(['home.home','posts.single-post'], ActivityComposer::class) ; 

        // view()->composer('*', ActivityComposer::class) ; //will serve those compose structure to all pages

    }
}
