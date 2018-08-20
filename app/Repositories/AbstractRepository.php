<?php

declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Database\Eloquent\MassAssignmentException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class AbstractRepository
 *
 * @package App\Repositories
 */
abstract class AbstractRepository
{
    /** @var Model */
    protected $model;

    /**
     * AbstractRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param int $id
     *
     * @return Model|null
     */
    public function find(int $id): ?Model
    {
        return $this->model->find($id);
    }

    /**
     * @return Collection
     */
    public function findAll(): Collection
    {
        return $this->model->get();
    }

    /**
     * @param array $attributes
     *
     * @return Model
     * @throws \Exception
     */
    public function save(array $attributes): Model
    {
        $model = $this->model->newInstance($attributes);

        try {
            $result = $model->save();
        } catch (MassAssignmentException $e) {
            throw new \Exception($e->getMessage());
        }

        if (false === $result) {
            throw new \Exception('Something went wrong');
        }

        return $model;
    }
}
