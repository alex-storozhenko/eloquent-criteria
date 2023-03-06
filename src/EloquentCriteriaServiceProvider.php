<?php

declare(strict_types=1);

namespace AlexStorozhenko\EloquentCriteria;

use AlexStorozhenko\EloquentCriteria\Contracts\Criteria;
use Illuminate\Database\Eloquent\Builder;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class EloquentCriteriaServiceProvider extends PackageServiceProvider
{
    public function boot()
    {
        parent::boot();

        if (config('eloquent-criteria.macro_call_enabled')) {
            /**
             * $this will bind as EloquentBuilder according macro rule
             *
             * @see Macroable::__callStatic()
             * @see Closure::bindTo()
             */
            Builder::macro('criteriaQuery', fn() => CriteriaBuilder::for($this));
            Builder::macro('applyCriteria', fn(Criteria $criteria) => CriteriaBuilder::for($this)->apply($criteria));
        }

        return $this;
    }

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('eloquent-criteria')
            ->hasConfigFile();
    }
}
