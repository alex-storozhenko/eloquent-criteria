<?php

declare(strict_types=1);

namespace AlexStorozhenko\EloquentCriteria\Contracts;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

interface Criteria
{
    /**
     * Apply criteria to query
     *
     * @param  EloquentBuilder  $builder
     * @return EloquentBuilder
     */
    public function apply(EloquentBuilder $builder): EloquentBuilder;
}

