<?php

namespace EfTech\FrameworkTest\Infrastructure\http;

use EfTech\ContactList\Infrastructure\http\ServerResponseFactory;
use EfTech\ContactList\Infrastructure\Uri\Uri;
use JsonException;
use PHPUnit\Framework\TestCase;

/**
 *  Тестирование методов ServerResponseFactory
 */
class ServerResponseFactoryTest extends TestCase
{
    /**
     * Провайдер данных для тестирования createJsonResponse
     *
     * @return array
     * @throws JsonException
     */
    public function createJsonResponseDataProvider(): array
    {
        $result = [
            'id_recipient' => 1,
            'full_name' => 'Осипов Геннадий Иванович',
            'birthday' => '15.06.1985',
            'profession' => 'Системный администратор'
        ];

        return [
            'Тестирование ситуации, когда поддерживаеться код ответа и результат имеет правильный формат' => [
                'in'  => [
                    'httpCode' => 200,
                    'result'   => $result,
                ],
                'out' => [
                    'reasonPhrase'    => 'OK',
                    'protocolVersion' => '1.1',
                    'statusCode'      => 200,
                    'headers'         => ['Content-Type' => 'application/json'],
                    'body'            => json_encode($result, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE),
                ],
            ],
            'Тестирование ситуации, когда код ответа не поддерживается'          => [
                'in'  => [
                    'httpCode' => 900,
                    'result'   => $result,
                ],
                'out' => [
                    'reasonPhrase'    => 'Unknown error',
                    'protocolVersion' => '1.1',
                    'statusCode'      => 520,
                    'headers'         => ['Content-Type' => 'application/json'],
                    'body'            => '{"status": "fail", "message": "response coding error"}',
                ],
            ],
        ];
    }

    /**
     * Провайдер данных для тестирования createHtmlResponse
     *
     * @return array
     */
    public function createHtmlResponseDataProvider(): array
    {
        $result = '<html>success</html>';

        return [
            'Тестирование ситуации, когда все прошло хорошо. CreateJsonResponse' => [
                'in'  => [
                    'httpCode' => 200,
                    'result'   => $result,
                ],
                'out' => [
                    'reasonPhrase'    => 'OK',
                    'protocolVersion' => '1.1',
                    'statusCode'      => 200,
                    'headers'         => ['Content-Type' => 'text/html'],
                    'body'            => '<html>success</html>',
                ],
            ],
            'Тестирование ситуации, когда код ответа не поддерживается'          => [
                'in'  => [
                    'httpCode' => 2000,
                    'result'   => $result,
                ],
                'out' => [
                    'reasonPhrase'    => 'Unknown Error',
                    'protocolVersion' => '1.1',
                    'statusCode'      => 520,
                    'headers'         => ['Content-Type' => 'text/html'],
                    'body'            => '<h1>Unknown Error</h1>',
                ],
            ],
        ];
    }

    /**
     * Провайдер данных для тестирования redirect
     *
     * @return array
     */
    public function redirectDataProvider(): array
    {
        $uri = Uri::createFromString("https://www.ya.ry/weather/10");

        return [
            'Тестирование ситуации, когда все прошло хорошо. CreateJsonResponse' => [
                'in'  => [
                    'httpCode' => 302,
                    'uri'      => $uri,
                ],
                'out' => [
                    'reasonPhrase'    => 'Found',
                    'protocolVersion' => '1.1',
                    'statusCode'      => 302,
                    'headers'         => ['Location' => 'https://www.ya.ry/weather/10'],
                    'body'            => '',
                ],
            ],
            'Тестирование ситуации, когда код ответа некорректный для редиректа' => [
                'in'  => [
                    'httpCode' => 200,
                    'uri'      => $uri,
                ],
                'out' => [
                    'reasonPhrase'    => 'Unknown Error',
                    'protocolVersion' => '1.1',
                    'statusCode'      => 520,
                    'headers'         => ['Content-Type' => 'text/html'],
                    'body'            => '<h1>Unknown Error</h1>',
                ],
            ],
            'Тестирование ситуации, когда код ответа не поддерживается'          => [
                'in'  => [
                    'httpCode' => 2000,
                    'uri'      => $uri,
                ],
                'out' => [
                    'reasonPhrase'    => 'Unknown Error',
                    'protocolVersion' => '1.1',
                    'statusCode'      => 520,
                    'headers'         => ['Content-Type' => 'text/html'],
                    'body'            => '<h1>Unknown Error</h1>',
                ],
            ],
        ];
    }

    /**
     * Тестирование createJsonResponse
     *
     * @dataProvider createJsonResponseDataProvider
     *
     * @param array $in
     * @param array $out
     *
     * @return void
     */
    public function testCreateJsonResponse(array $in, array $out): void
    {
        $response = ServerResponseFactory::createJsonResponse($in['httpCode'], $in['result']);
        $this->assertEquals(
            $out['body'],
            $response->getBody(),
            "некорректный body"
        );
        $this->assertEquals(
            $out['reasonPhrase'],
            $response->getReasonPhrase(),
            "некорректный reason phrase"
        );
        $this->assertEquals(
            $out['protocolVersion'],
            $response->getProtocolVersion(),
            "некорректный protocol version"
        );
        $this->assertEquals(
            $out['statusCode'],
            $response->getStatusCode(),
            "некорректный status code"
        );
        $this->assertEquals(
            $out['headers'],
            $response->getHeaders(),
            "некорректный headers"
        );
    }

    /**
     * Тестирование createHtmlResponse
     *
     * @dataProvider createHtmlResponseDataProvider
     *
     * @param array $in
     * @param array $out
     *
     * @return void
     */
    public function testCreateHtmlResponse(array $in, array $out): void
    {
        $response = ServerResponseFactory::createHtmlResponse($in['httpCode'], $in['result']);
        $this->assertEquals(
            $out['body'],
            $response->getBody(),
            "некорректный body"
        );
        $this->assertEquals(
            $out['reasonPhrase'],
            $response->getReasonPhrase(),
            "некорректный reason phrase"
        );
        $this->assertEquals(
            $out['protocolVersion'],
            $response->getProtocolVersion(),
            "некорректный protocol version"
        );
        $this->assertEquals(
            $out['statusCode'],
            $response->getStatusCode(),
            "некорректный status code"
        );
        $this->assertEquals(
            $out['headers'],
            $response->getHeaders(),
            "некорректный headers"
        );
    }

    /**
     * Тестирование redirect
     *
     * @dataProvider redirectDataProvider
     *
     * @param array $in
     * @param array $out
     *
     * @return void
     */
    public function testRedirect(array $in, array $out): void
    {
        $response = ServerResponseFactory::redirect($in['uri'], $in['httpCode']);
        $this->assertEquals(
            $out['body'],
            $response->getBody(),
            "некорректный body"
        );
        $this->assertEquals(
            $out['reasonPhrase'],
            $response->getReasonPhrase(),
            "некорректный reason phrase"
        );
        $this->assertEquals(
            $out['protocolVersion'],
            $response->getProtocolVersion(),
            "некорректный protocol version"
        );
        $this->assertEquals(
            $out['statusCode'],
            $response->getStatusCode(),
            "некорректный status code"
        );
        $this->assertEquals(
            $out['headers'],
            $response->getHeaders(),
            "некорректный headers"
        );
    }
}
