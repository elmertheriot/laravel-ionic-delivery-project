<?php

namespace DOLucasDelivery\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'DOLucasDelivery\Repositories\CategoryRepository',
            'DOLucasDelivery\Repositories\CategoryRepositoryEloquent'
        );
        $this->app->bind(
            'DOLucasDelivery\Repositories\ClientRepository',
            'DOLucasDelivery\Repositories\ClientRepositoryEloquent'
        );
        $this->app->bind(
            'DOLucasDelivery\Repositories\OrderItemRepository',
            'DOLucasDelivery\Repositories\OrderItemRepositoryEloquent'
        );
        $this->app->bind(
            'DOLucasDelivery\Repositories\OrderRepository',
            'DOLucasDelivery\Repositories\OrderRepositoryEloquent'
        );
        $this->app->bind(
            'DOLucasDelivery\Repositories\ProductRepository',
            'DOLucasDelivery\Repositories\ProductRepositoryEloquent'
        );
        $this->app->bind(
            'DOLucasDelivery\Repositories\UserRepository',
            'DOLucasDelivery\Repositories\UserRepositoryEloquent'
        );
        $this->app->bind(
            'DOLucasDelivery\Repositories\CouponRepository',
            'DOLucasDelivery\Repositories\CouponRepositoryEloquent'
        );
    }
}
