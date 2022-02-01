<?php


use EfTech\ContactList\Infrastructure\Session\SessionInterface;
use EfTech\ContactList\Infrastructure\Session\SessionNative;
use PHPUnit\Framework\TestCase;

class SessionNativeTest extends TestCase
{
    /**
     * Тестирование создания объекта
     *
     * @return void
     */
    public function testCreateSessionObject(): void
    {
        $session = [];
        $sessionNative = new SessionNative(
            $session,
        );
        $this->assertInstanceOf(
            SessionInterface::class,
            $sessionNative,
            "Объект не имплементирует SessionInterface"
        );
    }

    /**
     * Тестирование получения данных о сессии
     *
     * @return void
     */
    public function testGetSession(): void
    {
        $session = ['id' => 5];
        $sessionNative = new SessionNative(
            $session,
        );
        $this->assertEquals(
            5,
            $sessionNative->get('id'),
            "некорректен get"
        );
    }

    /**
     * Тестирование проверки наличия ключа в сессии
     *
     * @return void
     */
    public function testHasSession(): void
    {
        $session = ['id' => 5];
        $sessionNative = new SessionNative(
            $session,
        );
        $this->assertEquals(
            true,
            $sessionNative->has('id'),
            "некорректен has"
        );
    }

    /**
     * Тестирование добавления данных в сессию
     *
     * @return void
     */
    public function testSetSession(): void
    {
        $session = [];
        $sessionNative = new SessionNative(
            $session,
        );
        $this->assertEquals(
            5,
            $sessionNative->set('id', 5)->get('id'),
            "некорректен set"
        );
    }

}
