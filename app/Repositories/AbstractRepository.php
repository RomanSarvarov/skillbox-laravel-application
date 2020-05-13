<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository implements RepositoryInterface
{
    protected Model $model;

    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    /**
     * @return Model|Mixed
     */
    protected function startConditions(): Model
    {
        return clone $this->model;
    }

    abstract protected function getModelClass(): string;
}
