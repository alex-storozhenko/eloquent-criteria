<?php

declare(strict_types=1);

namespace AlexStorozhenko\EloquentCriteria\Concerns;

use AlexStorozhenko\EloquentCriteria\Contracts\Criteria;
use AlexStorozhenko\EloquentCriteria\CriteriaBuilder;

trait CriteriaQuery
{
    public static function apply(Criteria $criteria): CriteriaBuilder
    {
        return static::criteriaQuery()->apply($criteria);
    }

    public static function criteriaQuery(): CriteriaBuilder
    {
        return CriteriaBuilder::for(static::query());
    }
}
