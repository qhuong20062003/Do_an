<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use App\Services\CartService;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $cart_items = CartService::getCartItems();
            $view->with('cart_items', $cart_items);
        });
    }
}
