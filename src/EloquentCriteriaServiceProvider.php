<?php

namespace AlexStorozhenko\EloquentCriteria;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use AlexStorozhenko\EloquentCriteria\Commands\EloquentCriteriaCommand;

class EloquentCriteriaServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('eloquent-criteria')
            ->hasCommand(EloquentCriteriaCommand::class);
    }
}
