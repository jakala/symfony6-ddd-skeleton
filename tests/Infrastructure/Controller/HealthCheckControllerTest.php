<?php

namespace App\Tests\Infrastructure\Controller;

use App\Infrastructure\Controller\HealthCheckController;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;

class HealthCheckControllerTest extends TestCase
{
    /** @test */
    public function test_check_returns_ok(): void
    {
        $controller = new HealthCheckController();
        $response = $controller();
        self::assertInstanceOf(JsonResponse::class, $response);
        $result = json_decode($response->getContent(), true);

        self::assertArrayHasKey('status', $result);
        self::assertTrue($result['status']);
    }
}
