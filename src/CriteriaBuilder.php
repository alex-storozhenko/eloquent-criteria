<?php

declare(strict_types=1);

namespace AlexStorozhenko\EloquentCriteria;

use AlexStorozhenko\EloquentCriteria\Contracts\Criteria;
use AlexStorozhenko\EloquentCriteria\Contracts\CriteriaBuilder as CriteriaBuilderContract;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Support\Traits\ForwardsCalls;

/** @mixin EloquentBuilder */
final class CriteriaBuilder implements CriteriaBuilderContract
{
    use ForwardsCalls;

    private array $applied = [];

    public function __construct(private EloquentBuilder $builder)
    {
    }

    public static function for(EloquentBuilder $builder): CriteriaBuilder
    {
        return new self($builder);
    }

    public function apply(Criteria $criteria): CriteriaBuilder
    {
        return $this->applyIfNotApplied($criteria);
    }

    private function applyIfNotApplied(Criteria $criteria): CriteriaBuilder
    {
        // Prevent duplicate criteria applying
        if (! in_array(get_class($criteria), $this->applied)) {
            $this->applied[] = get_class($criteria);
            $this->builder = $criteria->apply($this->builder);
        }

        return $this;
    }

    public function __call($name, $arguments)
    {
        $result = $this->forwardCallTo($this->builder, $name, $arguments);

        if ($result instanceof EloquentBuilder) {
            $this->builder = $result;

            return $this;
        }

        return $result;
    }

    public function getEloquentQuery(): EloquentBuilder
    {
        return $this->builder;
    }
}
