<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\View\Composers\HotProductsComposer;
use App\Product;

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
        // View::Composer(['home'], function ($view){
        //     $view->with('HotProducts',Product::where('hot',1)->orderBy('id','desc')->get());
        // });

        View::Composer(['home'], HotProductsComposer::class);
    }
}
