<?php

declare(strict_types=1);

namespace AlexStorozhenko\EloquentCriteria\Contracts;

interface CriteriaBuilder
{
    public function apply(Criteria $criteria): CriteriaBuilder;
}
