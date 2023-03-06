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
}
