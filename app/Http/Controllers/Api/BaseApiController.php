<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class BaseApiController
 *
 * @package App\Http\Controllers\Api
 */
class BaseApiController extends Controller
{
    use Helpers;

    /**
     * @param string $message
     *
     * @return BadRequestHttpException
     */
    protected function createBadRequestException(string $message = ''): BadRequestHttpException
    {
        return new BadRequestHttpException($message);
    }

    /**
     * @param string $message
     *
     * @return NotFoundHttpException
     */
    protected function createNotFoundException(string $message = ''): NotFoundHttpException
    {
        return new NotFoundHttpException($message);
    }
}
