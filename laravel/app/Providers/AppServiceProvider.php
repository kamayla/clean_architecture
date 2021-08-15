<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Packages\Application\AuthUser\AuthUserGetInteractor;
use Packages\Application\Payment\PaymentRegisterInteractor;
use Packages\Application\Payment\PaymentUpdateAccountInteractor;
use Packages\Application\Product\ProductCreateInteractor;
use Packages\Application\Shop\ShopCreateInteractor;
use Packages\Application\User\UserCreateInteractor;
use Packages\Application\User\UserGetInteractor;
use Packages\Domain\CommonRepository\DataStoreTransactionInterface;
use Packages\Domain\CommonRepository\UuidGeneratorInterface;
use Packages\Domain\Models\Payment\PaymentRepository;
use Packages\Domain\Models\Product\ProductRepository;
use Packages\Domain\Models\Shop\ShopRepository;
use Packages\Domain\Models\User\UserRepository;
use Packages\Infrastructure\EloquentRepository\DataStoreTransactionEloquentRepository;
use Packages\Infrastructure\EloquentRepository\ProductEloquentRepository;
use Packages\Infrastructure\EloquentRepository\ShopEloquentRepository;
use Packages\Infrastructure\EloquentRepository\UserEloquentRepository;
use Packages\Infrastructure\ExtarnalServiceRepository\Stripe\StripeRepository;
use Packages\Infrastructure\LaravelFeatureRepository\UuidGenerateLaravelFeatureRepository;
use Packages\UseCase\AuthUser\Get\AuthUserGetUseCaseInterface;
use Packages\UseCase\Payment\Register\PaymentRegisterUseCaseInterface;
use Packages\UseCase\Payment\UpdateAccount\PaymentUpdateAccountUseCaseInterface;
use Packages\UseCase\Product\Create\ProductCreateUseCaseInterface;
use Packages\UseCase\Shop\Create\ShopCreateUseCaseInterface;
use Packages\UseCase\User\Create\UserCreateUseCaseInterface;
use Packages\UseCase\User\Get\UserGetUseCaseInterface;
use Packages\Infrastructure\ExtarnalServiceRepository\PayJp\PayJpRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /**
         * Eloquentリポジトリを登録
         */
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
            ProductRepository::class,
            ProductEloquentRepository::class
        );


        /**
         * ファサード系Repositoryを登録
         */
        $this->app->bind(
            UuidGeneratorInterface::class,
            UuidGenerateLaravelFeatureRepository::class
        );


        /**
         * UserCaseを登録
         */
        $this->app->bind(
            UserCreateUseCaseInterface::class,
            UserCreateInteractor::class
        );

        $this->app->bind(
            UserGetUseCaseInterface::class,
            UserGetInteractor::class
        );

        $this->app->bind(
            ShopCreateUseCaseInterface::class,
            ShopCreateInteractor::class
        );

        $this->app->bind(
            ProductCreateUseCaseInterface::class,
            ProductCreateInteractor::class
        );

        $this->app->bind(
            AuthUserGetUseCaseInterface::class,
            AuthUserGetInteractor::class
        );

        $this->app->bind(
            PaymentRegisterUseCaseInterface::class,
            PaymentRegisterInteractor::class
        );

        $this->app->bind(
            PaymentUpdateAccountUseCaseInterface::class,
            PaymentUpdateAccountInteractor::class
        );


        /**
         * ExtarnalAPIのリポジトリを登録
         */
        $this->app->bind(
            PaymentRepository::class,
            PayJpRepository::class
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
