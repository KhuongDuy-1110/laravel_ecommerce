<?php

namespace App\Providers;

use App\Repository\EloquentRepositoryInterface;
use App\Repository\ProductRepositoryInterface;
use App\Repository\OrderRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use App\Repository\CategoryRepositoryInterface;
use App\Repository\Eloquent\BaseRepository;
use App\Repository\Eloquent\ProductRepository;
use App\Repository\Eloquent\OrderRepository;
use App\Repository\Eloquent\UserRepository;
use App\Repository\Eloquent\CategoryRepository;
use App\Repository\Eloquent\CacheProductRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        // $productRepo = null;
        // if(env('APP_CACHE')=='true') {
        //     $productRepo = CacheProductRepository::class;
        // } else {
        //     $productRepo = ProductRepository::class;
        // }

        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        // $this->app->bind(ProductRepositoryInterface::class, $productRepo);
        $this->app->bind(ProductRepositoryInterface::class, function($app){
                if(env('APP_CACHE')) {
                    Log::info('hehe');
                    return CacheProductRepository::class;
                } else {
                    Log::info('haha');
                    return ProductRepository::class;
                }
            }
        );
    }
    
    public function boot()
    {
        
    }
}
