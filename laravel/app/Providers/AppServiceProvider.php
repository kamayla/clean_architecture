<?php

namespace App\Providers;

use Packages\Domain\Models\User\UserRepository;
use Packages\Domain\CommonRepository\DataStoreTransactionInterface;
use Packages\Infrastructure\EloquentRepository\UserEloquentRepository;
use Packages\Infrastructure\EloquentRepository\DataStoreTransactionEloquentRepository;
use Packages\UseCase\User\Create\UserCreateUseCaseInterface;
use Packages\Application\User\UserCreateInteractor;
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
        $this->app->bind(
            DataStoreTransactionInterface::class,
            DataStoreTransactionEloquentRepository::class
        );

        $this->app->bind(
            UserRepository::class,
            UserEloquentRepository::class
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
