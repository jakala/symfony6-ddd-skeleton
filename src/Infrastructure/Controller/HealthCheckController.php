<?php

namespace App\Infrastructure\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class HealthCheckController.
 */
class HealthCheckController
{
    public function __invoke(): JsonResponse
    {
        $status = [];
        return new JsonResponse($status);
    }
}
