<?php

namespace Yuricronos\VoltPermission;

use Illuminate\Support\ServiceProvider;

class VoltPermissionAssets extends ServiceProvider
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

            // // delete existing views
            // $views = ['views/livewire/volt/roles.blade.php'];
            // foreach ($views as $view) {
            //     if (file_exists(resource_path($view))) {
            //         unlink(resource_path($view));
            //     }
            // }

            // // delete existing routes
            // $routePath = base_path('routes/volt.php');
            // if (file_exists($routePath)) {
            //     unlink($routePath);
            // }

            // // delete require from web.php
            // $path = base_path('routes/web.php');
            // if (file_exists($path)) {
            //     $webRoutes = file_get_contents($path);
            //     $voltReq = "require __DIR__ . '/volt.php';";
            //     if (strpos($webRoutes, $voltReq) !== false) {
            //         $webRoutes = preg_replace('/' . preg_quote($voltReq, '/') . '/', '', $webRoutes);
            //         file_put_contents($path, $webRoutes);
            //     }
            // }

            // publish views
            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views'),
            ], 'views');

            // publish routes
            $this->publishes([
                __DIR__ . '/../routes' => base_path('routes'),
            ], 'routes');

            $this->app->terminating(function () {
                $path = base_path('routes/web.php');
                if (file_exists($path)) {
                    $webRoutes = file_get_contents($path);
                    $voltReq = "require __DIR__ . '/volt.php';";
                    if (strpos($webRoutes, $voltReq) === false) {
                        file_put_contents(
                            $path,
                            PHP_EOL . $voltReq,
                            FILE_APPEND
                        );
                    }
                }
            });
        }
    }
}
