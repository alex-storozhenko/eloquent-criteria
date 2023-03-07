<?php

declare(strict_types=1);

namespace AlexStorozhenko\EloquentCriteria\Support;

use AlexStorozhenko\EloquentCriteria\Contracts\Criteria;
use AlexStorozhenko\EloquentCriteria\CriteriaBuilder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

final class CriteriaChain implements Criteria
{
    private array $chain;

    public function __construct(Criteria ...$chain)
    {
        $this->chain = $chain;
    }

    public function apply(EloquentBuilder $builder): EloquentBuilder
    {
        $criteriaBuilder = CriteriaBuilder::for($builder);

        foreach ($this->chain as $criteria) {
            $criteriaBuilder->apply($criteria);
        }

        return $criteriaBuilder->getEloquentQuery();
    }
}
