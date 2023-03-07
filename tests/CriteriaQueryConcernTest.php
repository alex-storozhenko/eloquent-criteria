<?php

use AlexStorozhenko\EloquentCriteria\Concerns\CriteriaQuery;
use AlexStorozhenko\EloquentCriteria\Contracts\Criteria;
use AlexStorozhenko\EloquentCriteria\CriteriaBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

it('can add methods for interact with criteria builder to Eloquent', function () {
    $user = new class extends Model
    {
        use CriteriaQuery;

        protected $table = 'users';

        protected $guarded = [];
    };

    expect($user->criteriaQuery())
        ->toBeInstanceOf(CriteriaBuilder::class)
        ->and($user->applyCriteria(new class() implements Criteria
        {
            public function apply(Builder $builder): Builder
            {
                return $builder;
            }
        }))
        ->toBeInstanceOf(CriteriaBuilder::class);
});
