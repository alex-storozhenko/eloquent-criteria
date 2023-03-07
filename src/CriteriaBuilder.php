<?php

declare(strict_types=1);

namespace AlexStorozhenko\EloquentCriteria;

use AlexStorozhenko\EloquentCriteria\Contracts\Criteria;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Support\Traits\ForwardsCalls;

/** @mixin EloquentBuilder */
class CriteriaBuilder
{
    use ForwardsCalls;

    private array $applied = [];

    public function __construct(private EloquentBuilder $builder)
    {
    }

    public static function for(EloquentBuilder $builder): static
    {
        return new static($builder);
    }

    public function apply(Criteria $criteria): static
    {
        return $this->applyIfNotApplied($criteria);
    }

    /** alias for apply() method needed for the keep chain of calls from eloquent query */
    public function applyCriteria(Criteria $criteria): static
    {
        return $this->apply($criteria);
    }

    private function applyIfNotApplied(Criteria $criteria): static
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
