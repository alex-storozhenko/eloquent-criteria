<?php

use AlexStorozhenko\EloquentCriteria\Contracts\Criteria;
use AlexStorozhenko\EloquentCriteria\Model as ModelWithCriteriaBuilder;
use AlexStorozhenko\EloquentCriteria\Support\CriteriaChain;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;

uses(RefreshDatabase::class);

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

it('can apply group of criteria one by one', function () {
    $user = new class extends ModelWithCriteriaBuilder
    {
        protected $table = 'users';

        protected $guarded = [];
    };

    expect($user->apply(new CriteriaChain(
        new class() implements Criteria
        {
            public function apply(Builder $builder): Builder
            {
                return $builder->whereNotNull('is_banned_at');
            }
        },
        new class() implements Criteria
        {
            public function apply(Builder $builder): Builder
            {
                return $builder->whereNull('last_name');
            }
        }
    ))->get())->toHaveCount(1);
});
