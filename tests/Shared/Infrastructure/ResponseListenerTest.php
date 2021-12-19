<?php

namespace App\Tests\Shared\Infrastructure;

use App\Shared\Infrastructure\ResponseListener;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class ResponseListenerTest extends TestCase
{
    /** @test */
    public function checkEventRequestIsMasterReturnsFalse(): void
    {
        $event = $this->getResponseEventNotMasterRequest();
        $listener = new ResponseListener();

        $listener->onResponse($event);
    }

    /** @test */
    public function checkEventRequestResponseNotSuccessfulReturnsFalse(): void
    {
        $event = $this->getResponseEventResponseNotSuccessful();
        $listener = new ResponseListener();

        $listener->onResponse($event);
    }

    /** @test */
    public function checkEventRequestWithValidResponse(): void
    {
        $event = $this->getValidResponseEvent();
        $listener = new ResponseListener();

        $listener->onResponse($event);
    }

    private function getResponseEventNotMasterRequest(): ResponseEvent
    {
        $event = $this->getMockBuilder(ResponseEvent::class)
            ->disableOriginalConstructor()
            ->getMock();
        $event->method('isMainRequest')
            ->willReturn(false);

        return $event;
    }

    private function getResponseEventResponseNotSuccessful(): ResponseEvent
    {
        $event = $this->getMockBuilder(ResponseEvent::class)
            ->disableOriginalConstructor()
            ->getMock();

        $response = $this->getMockBuilder(Response::class)
            ->disableOriginalConstructor()
            ->getMock();

        $response
            ->method('isSuccessful')
            ->willReturn(false);

        $event->method('getResponse')
            ->willReturn($response);

        return $event;
    }

    private function getValidResponseEvent(): responseEvent
    {
        $data = json_encode(['key' => 'value']);

        $event = $this->getMockBuilder(ResponseEvent::class)
            ->disableOriginalConstructor()
            ->getMock();

        $response = $this->getMockBuilder(Response::class)
            ->disableOriginalConstructor()
            ->getMock();

        $response
            ->method('isSuccessful')
            ->willReturn(true);

        $response
            ->method('getContent')
            ->willReturn($data);

        $event->method('getResponse')
            ->willReturn($response);

        $event->method('isMainRequest')
            ->willReturn(true);

        return $event;
    }
}
