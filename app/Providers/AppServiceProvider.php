<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\View\Composers\HotProductsComposer;
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
        // View::Composer(['home'], function ($view){
        //     $view->with('HotProducts',Product::where('hot',1)->orderBy('id','desc')->get());
        // });

        View::Composer(['home'], HotProductsComposer::class);

        
        // config rate limit by ip
        RateLimiter::for('test', function (Request $request) {
            return Limit::perMinute(100)->by($request->ip())->response(function(){
                return response('denied',429);
            });
        });
        

    }

    protected function configureRateLimiting()
    {
    }

}
