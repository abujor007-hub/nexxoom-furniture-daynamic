<?php

namespace App\Providers;

use App\Models\adds;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use App\Models\Link;

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
        Paginator::useBootstrapFive();


      
    View::composer(['commonsection.nav', 'commonsection.footer'], function ($view) {

        $link = Link::first();
        $add= adds::first();

        $view->with('link', $link);
        $view->with('add', $add);
    });
    

    
}

}