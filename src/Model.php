<?php

declare(strict_types=1);

namespace AlexStorozhenko\EloquentCriteria;

use AlexStorozhenko\EloquentCriteria\Concerns\CriteriaQuery;
use Illuminate\Database\Eloquent\Model as EloquentModel;

abstract class Model extends EloquentModel
{
    use CriteriaQuery;
}
