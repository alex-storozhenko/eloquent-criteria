<?php

namespace AlexStorozhenko\EloquentCriteria\Tests;

use AlexStorozhenko\EloquentCriteria\EloquentCriteriaServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [EloquentCriteriaServiceProvider::class];
    }

    protected function getEnvironmentSetUp($app)
    {
        config()->set('database.connections.test', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => 'eloquent_criteria_',
        ]);

        config()->set('database.default', 'test');
    }
}
