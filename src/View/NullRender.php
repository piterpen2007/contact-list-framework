<?php

namespace EfTech\ContactList\Infrastructure\View;

use EfTech\ContactList\Infrastructure\http\httpResponse;
use EfTech\ContactList\Infrastructure\View\RenderInterface;
use Psr\Http\Message\ResponseInterface;

/** Рендер заглушка
 *
 */
final class NullRender implements RenderInterface
{
    public function render(ResponseInterface $httpResponse): void
    {
        // TODO: Implement render() method.
    }
}
