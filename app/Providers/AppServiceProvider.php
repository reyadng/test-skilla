<?php

namespace App\Providers;

use App\Services\IOrderService;
use App\Services\IWorkerService;
use App\Services\OrderService;
use App\Services\WorkerService;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
        $this->app->bind(IOrderService::class, OrderService::class);
        $this->app->bind(IWorkerService::class, WorkerService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Passport::enablePasswordGrant();
        Passport::hashClientSecrets();
    }
}
