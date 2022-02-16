<?php

namespace EfTech\ContactList\Infrastructure\Router;

use EfTech\ContactList\Infrastructure\Controller\ControllerInterface;
use Psr\Http\Message\ServerRequestInterface;

final class DefaultRouter implements RouterInterface
{
    /** Ассоциативный массив в коотором сопоставляется url path и обработчики
     * @var array
     */
    private array $handlers;

    /** фабрика по созданию конроллеров
     * @var ControllerFactory
     */
    private ControllerFactory $controllerFactory;

    /**
     * @param array $handlers
     * @param ControllerFactory $controllerFactory
     */
    public function __construct(array $handlers, ControllerFactory $controllerFactory)
    {
        $this->handlers = $handlers;
        $this->controllerFactory = $controllerFactory;
    }

    /** Возвращает обработчик запроса
     * @param ServerRequestInterface $serverRequest - объект серверного http запроса
     * @return callable|null
     */
    public function getDispatcher(ServerRequestInterface &$serverRequest): ?callable
    {
        $urlPath = $serverRequest->getUri()->getPath();


        $dispatcher = null;
        if (array_key_exists($urlPath, $this->handlers)) {
            if (is_callable($this->handlers[$urlPath])) {
                $dispatcher = $this->handlers[$urlPath];
            } elseif (
                is_string($this->handlers[$urlPath]) &&
                is_subclass_of($this->handlers[$urlPath], ControllerInterface::class, true)
            ) {
                $dispatcher = $this->controllerFactory->create($this->handlers[$urlPath]);
            }
        }

        return $dispatcher;
    }
}
