<?php

namespace EfTech\ContactList\Infrastructure\Router;

use EfTech\ContactList\Infrastructure\http\ServerRequest;
use Psr\Http\Message\ServerRequestInterface;

interface RouterInterface
{
    /** Возвращает обработчик запроса
     * @param ServerRequestInterface $serverRequest - объект серверного http запроса
     * @return callable|null
     */
    public function getDispatcher(ServerRequestInterface &$serverRequest): ?callable;
}
