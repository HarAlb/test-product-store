<?php

namespace Modules\Order\App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Order\App\Contracts\OrderQueryFilterInterface;
use Modules\Order\App\Contracts\OrderRepositoryInterface;
use Modules\Order\App\Filters\OrderQueryFilter;
use Modules\Order\App\Repositories\OrderRepository;

class OrderServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'Order';

    protected string $moduleNameLower = 'order';

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);

        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(OrderQueryFilterInterface::class, OrderQueryFilter::class);

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
