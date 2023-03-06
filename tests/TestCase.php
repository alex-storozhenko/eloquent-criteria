<?php

namespace AlexStorozhenko\EloquentCriteria\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use AlexStorozhenko\EloquentCriteria\EloquentCriteriaServiceProvider;

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
