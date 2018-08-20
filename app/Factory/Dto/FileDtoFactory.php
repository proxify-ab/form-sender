<?php

declare(strict_types=1);

namespace App\Factory\Dto;

use App\Dto\FileDto;
use App\Entities\File;
use App\Services\FileUploaderService;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class FileDtoFactory
 *
 * @package App\Factory\Dto
 */
class FileDtoFactory
{
    /**
     * @param UploadedFile $file
     *
     * @return FileDto
     */
    public static function create(UploadedFile $file): FileDto
    {
        $dto = new FileDto();
        $dto
            ->setName(self::generateName($file))
            ->setExtension($file->getClientOriginalExtension())
            ->setMimeType($file->getClientMimeType())
            ->setSize($file->getSize());

        return $dto;
    }

    /**
     * @param File $file
     *
     * @return FileDto
     */
    public static function createFromEntity(File $file): FileDto
    {
        $dto = new FileDto();
        $dto
            ->setId($file->getId())
            ->setName($file->getName())
            ->setExtension($file->getExtension())
            ->setMimeType($file->getMime())
            ->setSize($file->getSize());

        return $dto;
    }

    /**
     * @param UploadedFile $file
     *
     * @return string
     */
    public static function generateName(UploadedFile $file): string
    {
        $name = uniqid(sprintf('%s_', FileUploaderService::INPUT_KEY));

        return "{$name}.{$file->getClientOriginalExtension()}";
    }
}
