<?php

namespace Modules\OrderItem\App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\OrderItem\App\Contracts\OrderItemRepositoryInterface;
use Modules\OrderItem\App\Repositories\OrderItemRepository;

class OrderItemServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'OrderItem';

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(OrderItemRepositoryInterface::class, OrderItemRepository::class);

        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/migrations'));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
