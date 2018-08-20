<?php

declare(strict_types=1);

namespace App\Dto;

use App\Models\Files;

/**
 * Class FileMailDto
 *
 * @package App\Dto
 */
class FileMailDto
{
    /** @var string */
    private $name;

    /**
     * FileMailDto constructor.
     *
     * @param Files $files
     */
    public function __construct(Files $files)
    {
        $this->name = $files->name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
