<?php

namespace App\Repositories\Patterns;

use App\Pattern;
use App\Repositories\EloquentRepository;

class DbPatternsRepository extends EloquentRepository implements PatternsRepository
{
    public function __construct(Pattern $model)
    {
        $this->model = $model;
    }
}
