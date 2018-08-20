<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\FileRequest;
use App\Services\FileUploaderService;
use Dingo\Api\Http\Response;

/**
 * Class FileApiController
 *
 * @package App\Http\Controllers\Api
 */
class FileApiController extends BaseApiController
{
    /** @var FileUploaderService */
    protected $fileUploaderService;

    /**
     * FileController constructor.
     *
     * @param FileUploaderService $fileUploaderService
     */
    public function __construct(FileUploaderService $fileUploaderService)
    {
        $this->fileUploaderService = $fileUploaderService;
    }

    /**
     * @param FileRequest $request
     *
     * @return Response
     * @throws \Exception
     */
    public function upload(FileRequest $request): Response
    {
        if (null === $uploadedFile = $request->file(FileUploaderService::INPUT_KEY)) {
            throw $this->createNotFoundException('File not found or wrong input key');
        }

        try {
            $file = $this->fileUploaderService->upload($uploadedFile['0']);
        } catch (\Exception $e) {
            throw $this->createBadRequestException($e->getMessage());
        }

        return $this->response->item($file, $file)->setStatusCode(201);
    }
}
