<?php

namespace App\Providers;


use App\Actions\CreateProduct;
use App\Actions\CreateProductInterface;
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
        // binding CreateProductInterface by CreateProduct which implements its method with sql database
        $this->app->bind(CreateProductInterface::class, CreateProduct::class);
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
