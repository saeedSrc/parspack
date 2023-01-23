<?php

namespace App\Providers;


use App\Actions\Comment;
use App\Actions\CommentInterface;
use App\Actions\Product;
use App\Actions\ProductInterface;
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
        // binding ProductInterface by Product which implements its method with sql database
        $this->app->bind(ProductInterface::class, Product::class);

        // binding CommentInterface by Comment which implements its method with sql database
        $this->app->bind(CommentInterface::class, Comment::class);
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
