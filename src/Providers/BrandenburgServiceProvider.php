<?php

namespace Silvanite\Brandenburg\Providers;

use Illuminate\Support\ServiceProvider;
use Gate;

use Silvanite\Brandenburg\Policy;

use Illuminate\Routing\Router;
use Illuminate\Contracts\Http\Kernel;

class BrandenburgServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Router $router, Kernel $kernel)
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');

        $this->publishes([
            __DIR__.'/../Config/brandenburg.php' => config_path('brandenburg.php'),
        ]);

        $this->registerPolicies();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../Config/brandenburg.php', 'brandenburg'
        );
    }

    /**
     * Register the Policies module
     *
     * @param string $IoC name of the container
     * @return Silvanite\Brandenburg\Policy
     */
    private function registerPolicies($container = "BrandenburgPolicy")
    {
        $this->app->bind($container, function(){
            return new Policy;
        });
    }
}
