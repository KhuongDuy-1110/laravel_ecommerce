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

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    
    public function register()
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
    }

    
    public function boot()
    {
        
    }
}
