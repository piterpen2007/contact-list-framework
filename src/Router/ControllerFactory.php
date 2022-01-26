<?php

namespace EfTech\ContactList\Infrastructure\Router;

use EfTech\ContactList\Infrastructure\Controller\ControllerInterface;
use EfTech\ContactList\Infrastructure\DI\ContainerInterface;

class ControllerFactory
{
    /** di контейнер
     * @var ContainerInterface
     */
    private ContainerInterface $diContainer;

    /**
     * @param ContainerInterface $diContainer
     */
    public function __construct(ContainerInterface $diContainer)
    {
        $this->diContainer = $diContainer;
    }

    /** Создаёт контроллер
     * @param string $controllerClassName имя класса создаваемого контроллера
     * @return ControllerInterface
     */
    public function create(string $controllerClassName):ControllerInterface
    {
        return $this->diContainer->get($controllerClassName);
    }
}