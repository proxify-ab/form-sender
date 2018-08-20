<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\FileUploaderInterface;
use App\Dto\FileDto;
use App\Exceptions\Services\FileUploaderServiceException;
use App\Factory\Dto\FileDtoFactory;
use App\Repositories\FileRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

/**
 * Class FileUploaderService
 *
 * @package App\Service
 */
class FileUploaderService implements FileUploaderInterface
{
    const INPUT_KEY = 'file';
    const DISK_NAME = 'public';

    const ERROR_MESSAGE_CANNOT_UPLOAD = 'File cannot be uploaded';

    /** @var LoggerInterface */
    protected $logger;

    /** @var FileRepository */
    protected $repository;

    /**
     * FileUploaderService constructor.
     *
     * @param LoggerInterface $logger
     * @param FileRepository $repository
     */
    public function __construct(LoggerInterface $logger, FileRepository $repository)
    {
        $this->logger = $logger;
        $this->repository = $repository;
    }

    /**
     * {@inheritdoc}
     */
    public function upload(UploadedFile $uploadedFile): FileDto
    {
        try {
            $file = $this->process($uploadedFile);
        } catch (FileException $e) {
            $this->logger->error($e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            throw new FileUploaderServiceException($e->getMessage());
        }

        $arguments = [
            'name' => $file->getName(),
            'mime' => $file->getMimeType(),
            'extension' => $file->getExtension(),
            'size' => $file->getSize(),
        ];

        try {
            $this->repository->save($arguments);
        } catch (\Exception $e) {
            $this->remove($file->getName());

            throw $e;
        }

        return $file;
    }

    /**
     * {@inheritdoc}
     */
    public function remove(string $name): bool
    {
        $isDeleted = Storage::disk(FileUploaderService::DISK_NAME)
            ->delete($name);

        return $isDeleted;
    }

    /**
     * @param UploadedFile $uploadedFile
     *
     * @return FileDto
     * @throws FileException
     */
    protected function process(UploadedFile $uploadedFile): FileDto
    {
        $file = FileDtoFactory::create($uploadedFile);

        if (false === $uploadResult = $uploadedFile->storeAs(self::DISK_NAME, $file->getName())) {
            throw new FileException(self::ERROR_MESSAGE_CANNOT_UPLOAD);
        }

        return $file;
    }
}
