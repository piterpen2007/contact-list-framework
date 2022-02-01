<?php

namespace EfTech\FrameworkTest\Infrastrucrute\http;

use EfTech\ContactList\Infrastructure\http\httpResponse;
use PHPUnit\Framework\TestCase;

/**
 * Тестирование класса HttpResponse
 */
class HttpResponseTest extends TestCase
{
 /**
 * Тестирование класса HttpResponse
 *
 * @return void
 */
    public function testHttpResponse(): void
    {
        $actual = [
            'protocolVersion' => '1.1',
            'headers' => [],
            'body' => '',
            'statusCode' => 200,
            'reasonPhrase' => 'success'
        ];


        $httpResponse = new HttpResponse('1.1', [], '', 200, 'success');
        $this->assertEquals($actual['headers'], $httpResponse->getHeaders(), "некоррктный headers");
        $this->assertEquals($actual['statusCode'], $httpResponse->getStatusCode(), "некорректный status code");
        $this->assertEquals(
            $actual['protocolVersion'],
            $httpResponse->getProtocolVersion(),
            "некорректный protocol version"
        );
        $this->assertEquals($actual['body'], $httpResponse->getBody(), "некорректный body");
        $this->assertEquals($actual['reasonPhrase'], $httpResponse->getReasonPhrase(), "некорректный reason phrase");
    }
}
