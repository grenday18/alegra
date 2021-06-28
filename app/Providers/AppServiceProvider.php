<?php

namespace App\Providers;

use App\Observers\OrderbuyObserver;
use App\Observers\OrderObserver;
use App\Order;
use App\Orderbuy;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Order::observe(OrderObserver::class);
        Orderbuy::observe(OrderbuyObserver::class);
    }
}
