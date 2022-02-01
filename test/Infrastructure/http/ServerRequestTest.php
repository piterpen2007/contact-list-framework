<?php

namespace EfTech\FrameworkTest\Infrastrucrute\http;

use EfTech\ContactList\Infrastructure\http\ServerRequest;
use EfTech\ContactList\Infrastructure\Uri\Uri;
use PHPUnit\Framework\TestCase;

/**
 * Тестирование ServerRequest
 */
class ServerRequestTest extends TestCase
{
    /**
     * Тестирование метода атрибутов ServerRequest
     *
     * @return void
     */
    public function testMethods(): void
    {
        $serverRequest = new ServerRequest(
            'GET',
            '1.1',
            '/test',
            Uri::createFromString('https://ya.ru'),
            [],
            ''
        );
        $serverRequest->setAttributes(["id" => 5]);
        $this->assertEquals(
            ["id" => 5],
            $serverRequest->getAttributes(),
            "получены некорректные атрибуты"
        );
    }
}
