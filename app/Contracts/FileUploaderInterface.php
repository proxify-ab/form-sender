<?php

declare(strict_types=1);

namespace App\Contracts;

use App\Dto\FileDto;
use App\Exceptions\Services\FileUploaderServiceException;
use Illuminate\Http\UploadedFile;

/**
 * Interface FileUploaderInterface
 *
 * @package App\Contracts
 */
interface FileUploaderInterface
{
    /**
     * @param UploadedFile $uploadedFile
     *
     * @return FileDto
     * @throws FileUploaderServiceException
     * @throws \Exception
     */
    public function upload(UploadedFile $uploadedFile): FileDto;

    /**
     * @param string $name
     *
     * @return bool
     */
    public function remove(string $name): bool;
}
