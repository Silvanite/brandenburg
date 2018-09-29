<?php

namespace Silvanite\Brandenburg\Providers;

use Gate;
use Illuminate\Routing\Router;
use Silvanite\Brandenburg\Policy;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\ServiceProvider;
use Illuminate\Config\Repository as Config;

class BrandenburgServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Router $router, Kernel $kernel)
    {
        $this->publishes([
            __DIR__.'/../Config/brandenburg.php' => config_path('brandenburg.php'),
        ], 'brandenburg-config');

        if (!$this->app->make(Config::class)->get('brandenburg.ignoreMigrations', false)) {
            $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        } else {
            $this->publishes([
                __DIR__.'/../Database/Migrations' => database_path('migrations'),
            ], 'brandenburg-migrations');
        }

        $this->registerPolicy();
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
     * Register the Policies module as a Facade
     *
     * @param string $IoC name of the container
     * @return Silvanite\Brandenburg\Policy
     */
    private function registerPolicy($container = "BrandenburgPolicy")
    {
        $this->app->bind($container, function(){
            return new Policy;
        });
    }
}
