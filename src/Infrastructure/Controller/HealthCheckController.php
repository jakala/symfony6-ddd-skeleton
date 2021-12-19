<?php

namespace App\Infrastructure\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class HealthCheckController.
 */
class HealthCheckController
{
    private const STATUS_OK = true;

    public function __invoke(): JsonResponse
    {
        $status = ['status' => self::STATUS_OK];
        return new JsonResponse($status);
    }
}
