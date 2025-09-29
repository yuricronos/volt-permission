<?php

namespace Yuricronos\VoltPermission;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use RolesComponent;

class VoltPermissionServiceProvider extends ServiceProvider
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
        if ($this->app->runningInConsole()) {
            return;
        }
        // $this->configureRoutes();
    }

    protected function configureRoutes(): void
    {
        $this->loadRoutesFrom(__DIR__ . "/../routes/volt.php");
    }
}
