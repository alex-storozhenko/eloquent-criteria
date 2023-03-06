<?php

declare(strict_types=1);

namespace AlexStorozhenko\EloquentCriteria\Concerns;

use AlexStorozhenko\EloquentCriteria\Contracts\Criteria;
use AlexStorozhenko\EloquentCriteria\CriteriaBuilder;

trait CriteriaQuery
{
    public function applyCriteria(Criteria $criteria): CriteriaBuilder
    {
        return $this->criteriaQuery()->apply($criteria);
    }

    public function criteriaQuery(): CriteriaBuilder
    {
        return CriteriaBuilder::for($this->query());
    }
}
