<?php

namespace App\Providers;

use App\Repositories\IOrderRepository;
use App\Repositories\IUserRepository;
use App\Repositories\OrderRepository;
use App\Repositories\UserRepository;
use App\Services\IOrderService;
use App\Repositories\IWorkerRepository;
use App\Services\OrderService;
use App\Repositories\WorkerRepository;
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
        $this->app->bind(IWorkerRepository::class, WorkerRepository::class);
        $this->app->bind(IOrderRepository::class, OrderRepository::class);
        $this->app->bind(IUserRepository::class, UserRepository::class);
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
