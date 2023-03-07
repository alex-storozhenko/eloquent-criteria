<?php

use AlexStorozhenko\EloquentCriteria\Concerns\CriteriaQuery;
use AlexStorozhenko\EloquentCriteria\Contracts\Criteria;
use AlexStorozhenko\EloquentCriteria\CriteriaBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Schema;

beforeEach(function () {
    Schema::create('users', function (Blueprint $table) {
        $table->id();
        $table->string('first_name');
        $table->string('last_name')->nullable();
        $table->string('email');
        $table->timestamp('email_verified_at')->nullable();
        $table->timestamp('is_banned_at')->nullable();
        $table->timestamps();
    });

    $user = new class extends Model
    {
        protected $table = 'users';

        protected $guarded = [];
    };

    $user->create([
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'john.doe@test.com',
    ]);

    $user->create([
        'first_name' => 'John',
        'last_name' => null,
        'email' => 'john.null@test.com',
    ]);

    $user->create([
        'first_name' => 'Mary Jn',
        'last_name' => 'Ostin',
        'email' => 'ositnmary@test.com',
        'email_verified_at' => now()->subMonth(),
        'is_banned_at' => now(),
    ]);

    $user->create([
        'first_name' => 'Mery Jn',
        'last_name' => 'Flur',
        'email' => 'flur12@test.com',
        'email_verified_at' => now()->subMonth(),
    ]);

    $user->create([
        'first_name' => 'Mary Jn',
        'last_name' => null,
        'email' => 'ositnmary@test.com',
        'email_verified_at' => now()->subMonth(),
        'is_banned_at' => now(),
    ]);
});

it('have static context access through for() method', function () {
    $user = new class extends Model
    {
        protected $table = 'users';

        protected $guarded = [];
    };

    expect(CriteriaBuilder::for($user->query()))
        ->toBeInstanceOf(CriteriaBuilder::class);
});

it('can return origin eloquent builder', function () {
    $user = new class extends Model
    {
        protected $table = 'users';

        protected $guarded = [];
    };

    expect(CriteriaBuilder::for($user->query())->getEloquentQuery())
        ->toBeInstanceOf(Builder::class);
});

it('can apply criteria on query', function () {
    $criteria = new class() implements Criteria
    {
        public function apply(Builder $builder): Builder
        {
            return $builder->whereNull('last_name');
        }
    };

    expect(CriteriaBuilder::for((new class() extends Model
    {
        protected $table = 'users';

        protected $guarded = [];
    })->query())->apply($criteria)->get())->toHaveCount(2);
});

it('can support chain of calls and do forward to Eloquent', function () {
    $criteria = new class() implements Criteria
    {
        public function apply(Builder $builder): Builder
        {
            return $builder->whereNull('last_name');
        }
    };

    $user = new class extends Model
    {
        use CriteriaQuery;

        protected $table = 'users';

        protected $guarded = [];
    };

    expect($user
        ->applyCriteria($criteria)
        ->orWhereNotNull('is_banned_at')
        ->applyCriteria(new class() implements Criteria
        {
            public function apply(Builder $builder): Builder
            {
                return $builder->whereNotNull('email_verified_at');
            }
        })->paginate())->toBeInstanceOf(LengthAwarePaginator::class);
});
