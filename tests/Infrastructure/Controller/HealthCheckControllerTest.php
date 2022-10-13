<?php

namespace App\Tests\Infrastructure\Controller;

use App\Infrastructure\Controller\HealthCheckController;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;

class HealthCheckControllerTest extends TestCase
{
    public function testCheckReturnsOk(): void
    {
        $controller = new HealthCheckController();
        $response = $controller();
        $result = json_decode($response->getContent(), true);

        self::assertInstanceOf(JsonResponse::class, $response);
        self::assertEmpty($result);
    }
}
