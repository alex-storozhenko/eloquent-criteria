<?php

namespace AlexStorozhenko\EloquentCriteria\Tests;

use AlexStorozhenko\EloquentCriteria\EloquentCriteriaServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            EloquentCriteriaServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');
    }
}
