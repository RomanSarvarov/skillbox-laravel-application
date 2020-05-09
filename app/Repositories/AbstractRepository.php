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

    public function getAll()
    {
        return $this->startConditions()->all();
    }

    public function getById(int $id)
    {
        return $this->startConditions()->find($id);
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
