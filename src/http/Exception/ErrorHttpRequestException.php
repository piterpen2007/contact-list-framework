<?php
namespace EfTech\ContactList\Infrastructure\http\Exception;

use \EfTech\ContactList\Infrastructure\Exception\RuntimeException;

/**
 *  Исключение выбрасывается в случае если не удалось создать объект http запроса
 */
class ErrorHttpRequestException extends RuntimeException
{

}