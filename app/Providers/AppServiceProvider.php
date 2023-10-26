<?php

namespace App\Providers;

use App\Repositories\Comment\CommentRepository;
use App\Repositories\Comment\CommentRepositoryInterface;
use App\Repositories\Merchandise\MerchandiseRepository;
use App\Repositories\Merchandise\MerchandiseRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \App\Repositories\Market\MarketRepositoryInterface::class,
            \App\Repositories\Market\MarketRepository::class
        );
        $this->app->singleton(
            UserRepositoryInterface::class,
            UserRepository::class
        );
        $this->app->singleton(
            CommentRepositoryInterface::class,
            CommentRepository::class
        );
        $this->app->singleton(
            MerchandiseRepositoryInterface::class,
            MerchandiseRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
