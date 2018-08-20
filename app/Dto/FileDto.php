<?php

declare(strict_types=1);

namespace App\Dto;

use League\Fractal\TransformerAbstract;

/**
 * Class FileDto
 *
 * @package App\Dto
 */
final class FileDto extends TransformerAbstract
{
    /** @var int|null */
    protected $id = null;

    /** @var string */
    protected $name;

    /** @var string */
    protected $extension;

    /** @var string */
    protected $mimeType;

    /** @var int */
    protected $size;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getExtension(): string
    {
        return $this->extension;
    }

    /**
     * @return string
     */
    public function getMimeType(): string
    {
        return $this->mimeType;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @param FileDto $dto
     *
     * @return array
     */
    public function transform(FileDto $dto): array
    {
        return [
            'id' => $dto->id,
            'name' => $dto->name,
            'extension' => $dto->extension,
            'mime_type' => $dto->mimeType,
            'size' => $dto->size,
        ];
    }

    /**
     * @param int|null $id
     *
     * @return FileDto
     */
    public function setId(?int $id): FileDto
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @param string $name
     *
     * @return FileDto
     */
    public function setName(string $name): FileDto
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param string $extension
     *
     * @return FileDto
     */
    public function setExtension(string $extension): FileDto
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * @param string $mimeType
     *
     * @return FileDto
     */
    public function setMimeType(string $mimeType): FileDto
    {
        $this->mimeType = $mimeType;

        return $this;
    }

    /**
     * @param int $size
     *
     * @return FileDto
     */
    public function setSize(int $size): FileDto
    {
        $this->size = $size;

        return $this;
    }
}
