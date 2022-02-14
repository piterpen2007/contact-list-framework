<?php

namespace EfTech\ContactList\Infrastructure\View;

use EfTech\ContactList\Infrastructure\http\httpResponse;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/** Определяет поведение классов ответственных за рендеринг результатов
 *
 */
interface RenderInterface
{
    /** Отображает результаты пользователя
     * @param ResponseInterface $httpResponse $httpResponse
     * @return void
     */
    public function render(ResponseInterface $httpResponse): void;
}
