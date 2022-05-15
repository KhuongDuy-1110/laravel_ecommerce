<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\View\Composers\HotProductsComposer;
use App\Http\View\Composers\CategoryComposer;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
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
        // view composer        
        View::Composer(['frontend/Home'], HotProductsComposer::class);
        View::Composer(['layouts/client','frontend/Home','backend/product/ProductCreate','backend/product/ProductUpdate'],CategoryComposer::class);
   
    }
    
    protected function configureRateLimiting()
    {
        
        RateLimiter::for('test', function (Request $request) {
            return Limit::perMinute(100)->by($request->ip())->response(function(){
                return response('denied',429);
            });
        });
    }
}
