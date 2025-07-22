<?php

namespace Modules\User\App\Providers;

use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'User';

    protected string $moduleNameLower = 'user';

    /**
     * Register any application services.
     */
    public function register(): void
    {
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
