<?php

namespace Silvanite\Brandenburg\Test;

use Silvanite\Brandenburg\Facades\PolicyFacade;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Silvanite\Brandenburg\Providers\BrandenburgServiceProvider;

class TestCase extends OrchestraTestCase
{
    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        parent::setUp();

        $this->artisan('migrate', ['--database' => 'testbench']);

        $this->loadLaravelMigrations(['--database' => 'testbench']);

        $this->setupDatabase($this->app);
    }

    /**
     * Load package service provider
     * @param  \Illuminate\Foundation\Application $app
     * @return Silvanite\Brandenburg\BrandenburgServiceProvider
     */
    protected function getPackageProviders($app)
    {
        return [
            BrandenburgServiceProvider::class,
            TestServiceProvider::class,
        ];
    }

    /**
     * Load package alias
     * @param  \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [
            'PolicyFacade' => PolicyFacade::class,
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);

        $app['config']->set('brandenburg.userModel', 'Silvanite\Brandenburg\Test\User');
    }

    protected function setupDatabase($app)
    {
        $editor = User::make();

        $editor->name = "Ellis Briggs";
        $editor->email = "ellis.briggs@email.localhost";
        $editor->password = bcrypt('pa55word');
        $editor->save();

        $contributor = User::make();

        $contributor->name = "Oscar Mitchell";
        $contributor->email = "oscar.mitchell@email.localhost";
        $contributor->password = bcrypt('pa55word');
        $contributor->save();
    }
}
