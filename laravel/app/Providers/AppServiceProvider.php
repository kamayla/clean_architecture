<?php

namespace App\Providers;

use Packages\Domain\Models\User\UserRepository;
use Packages\Domain\CommonRepository\DataStoreTransactionInterface;
use Packages\Infrastructure\EloquentRepository\UserEloquentRepository;
use Packages\Infrastructure\EloquentRepository\DataStoreTransactionEloquentRepository;
use Packages\UseCase\User\Create\UserCreateUseCaseInterface;
use Packages\Application\User\UserCreateInteractor;
use Illuminate\Support\ServiceProvider;
use Packages\Domain\Models\Shop\ShopRepository;
use Packages\Infrastructure\EloquentRepository\ShopEloquentRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            DataStoreTransactionInterface::class,
            DataStoreTransactionEloquentRepository::class
        );

        $this->app->bind(
            UserRepository::class,
            UserEloquentRepository::class
        );

        $this->app->bind(
            ShopRepository::class,
            ShopEloquentRepository::class
        );

        $this->app->bind(
            UserCreateUseCaseInterface::class,
            UserCreateInteractor::class
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
