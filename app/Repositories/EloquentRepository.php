<?php

namespace App\Repositories;

use App\Filters\Filters;

abstract class EloquentRepository
{
    /**
     * @var Filters
     */
    protected $filters;

    /**
     * @var array
     */
    protected $orderBy;

    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * Returns the query Builder object for the associated model.
     *
     * @return mixed
     */
    public function query()
    {
        $query = $this->model->query();

        if ($this->filters && method_exists($this->model, "scopeFilter")) {
            $query->filter($this->filters);
        }

        if ($this->orderBy) {
            $query = $this->orderQuery($query);
        }

        return $query;
    }

    /**
     * Finds a single instance of the model with the given ID. Throws
     * an exception if the record is not found. Is subject to the query filters.
     *
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->query()->findOrFail($id);
    }

    /**
     * Returns all instances of the model. Is subject to the query filters.
     *
     * @return mixed
     */
    public function getAll()
    {
        return $this->query()->get();
    }

    /**
     * Returns all instances of the model that match a set of given criteria.
     *
     * @param array $criteria
     * @return mixed
     */
    public function findWhere($criteria = [])
    {
        return $this->query()->where($criteria)->get();
    }

    /**
     * Creates a new instance of the model using the given data.
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Updates the given model with the given data.
     *
     * @param       $model
     * @param array $data
     * @return mixed
     */
    public function update($model, array $data)
    {
        return $model->update($data);
    }

    /**
     * Deletes the given model.
     *
     * @param $model
     * @return mixed
     */
    public function delete($model)
    {
        return $model->delete();
    }

    /**
     * Sets the Filters object for the query, to filter the results returned by a set of
     * given filter methods.
     *
     * @param Filters $filters
     * @return $this
     */
    public function setFilters(Filters $filters)
    {
        $this->filters = $filters;
        return $this;
    }

    /**
     * Sets the default ordering for this call.
     *
     * @param array $orderBy
     * @return $this
     */
    public function orderBy(array $orderBy)
    {
        $this->orderBy = $orderBy;
        return $this;
    }

    /**
     * Adds the relevant 'orderBy()' calls to the query.
     *
     * @param $query
     * @return mixed
     */
    private function orderQuery($query)
    {
        foreach ($this->orderBy as $field => $direction) {
            $query = $query->orderBy($field, $direction);
        }

        return $query;
    }
}
