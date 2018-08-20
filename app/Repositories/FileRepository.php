<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Files;

/**
 * Class FileRepository
 *
 * @package App\Repositories
 */
class FileRepository extends AbstractRepository
{
    /**
     * FileRepository constructor.
     *
     * @param Files $model
     */
    public function __construct(Files $model)
    {
        parent::__construct($model);
    }

    /**
     * @param string $name
     *
     * @return Files|null
     */
    public function findByName(string $name): ?Files
    {
        return $this->model->where('name', $name)->first();
    }
}
