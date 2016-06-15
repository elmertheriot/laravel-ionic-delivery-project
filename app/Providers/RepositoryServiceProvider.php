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
    }
}
