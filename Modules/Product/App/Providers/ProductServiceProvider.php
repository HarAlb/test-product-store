<?php

namespace Modules\Product\App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Product\App\Contracts\ProductQueryFilterInterface;
use Modules\Product\App\Contracts\ProductRepositoryInterface;
use Modules\Product\App\Filters\ProductQueryFilter;
use Modules\Product\App\Repositories\ProductRepository;

class ProductServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'Product';

    protected string $moduleNameLower = 'product';

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);

        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);

        $this->app->bind(ProductQueryFilterInterface::class, ProductQueryFilter::class);

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
