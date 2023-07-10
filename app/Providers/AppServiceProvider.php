<?php

namespace App\Providers;

//Repositories
use App\Repositories\UserRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ProductImageRepository;
use App\Repositories\CartProductRepository;
use App\Repositories\CartRepository;

//Services
use App\Services\UserService;
use App\Services\ProductService;
use App\Services\CartService;
use App\Services\CategoryService;

//Interfaces
use App\Interfaces\IUserService;
use App\Interfaces\IProductService;
use App\Interfaces\ICartService;
use App\Interfaces\ICategoryService;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        //Binding Repositories

        $this->app->bind(UserRepository::class, function (Application $app) {
            return new UserRepository($app->make(UserRepository::class));
        });

        $this->app->bind(ProductRepository::class, function (Application $app) {
            return new ProductRepository($app->make(ProductRepository::class));
        });

        $this->app->bind(ProductImageRepository::class, function (Application $app) {
            return new ProductImageRepository($app->make(ProductImageRepository::class));
        });

        $this->app->bind(CartProductRepository::class, function (Application $app) {
            return new CartProductRepository($app->make(CartProductRepository::class));
        });

        $this->app->bind(CartRepository::class, function (Application $app) {
            return new CartRepository($app->make(CartRepository::class));
        });

        //Binding Services
        $this->app->bind(IUserService::class, UserService::class);

        $this->app->bind(IProductService::class, ProductService::class);

        $this->app->bind(ICartService::class, CartService::class);

        $this->app->bind(ICategoryService::class, CategoryService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
