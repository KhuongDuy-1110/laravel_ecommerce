<?php

namespace App\Providers;

use App\Repository\EloquentRepositoryInterface;
use App\Repository\ProductRepositoryInterface;
use App\Repository\OrderRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use App\Repository\CategoryRepositoryInterface;
use App\Repository\AdminRepositoryInterface;
use App\Repository\ImageRepositoryInterface;
use App\Repository\PostRepositoryInterface;

use App\Repository\Eloquent\BaseRepository;
use App\Repository\Eloquent\ProductRepository;
use App\Repository\Eloquent\OrderRepository;
use App\Repository\Eloquent\UserRepository;
use App\Repository\Eloquent\CategoryRepository;
use App\Repository\Eloquent\AdminRepository;
use App\Repository\Eloquent\ImageRepository;
use App\Repository\Eloquent\PostRepository;
use App\Repository\Eloquent\Cache\CacheProductRepository;
use App\Repository\Eloquent\Cache\CacheCategoryRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(AdminRepositoryInterface::class, AdminRepository::class);
        $this->app->bind(ImageRepositoryInterface::class, ImageRepository::class);
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);

        $this->app->bind(CategoryRepositoryInterface::class, function(){
            $model = \App\Models\Category::class;
            if(env('APP_CACHE')) {
                return new CacheCategoryRepository(new $model);
            }
            return new CategoryRepository(new $model);
        });
        $this->app->bind(ProductRepositoryInterface::class, function(){
            $model = \App\Models\Product::class;
            if(env('APP_CACHE')) {
                return new CacheProductRepository(new $model);  
            }
            return new ProductRepository(new $model);
        });
        
    }
     
    public function boot()
    {
        
    }
}