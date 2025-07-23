<?php

namespace Modules\Category\App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Category\App\Contracts\CategoryRepositoryInterface;
use Modules\Category\App\Repositories\CategoryRepository;

class CategoryServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'Category';

    protected string $moduleNameLower = 'category';

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);

        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);

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
