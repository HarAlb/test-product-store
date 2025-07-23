<?php

namespace Modules\Auth\App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Auth\App\Contracts\AuthTokenServiceInterface;
use Modules\Auth\App\Services\SanctumAuthTokenService;

class AuthServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'Auth';

    protected string $moduleNameLower = 'auth';

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthTokenServiceInterface::class, SanctumAuthTokenService::class);

        $this->app->register(RouteServiceProvider::class);

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
