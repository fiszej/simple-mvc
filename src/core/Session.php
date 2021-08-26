<?php
declare(strict_types=1);

namespace app\src\core;

class Session
{

    public const FLASH = 'flash';

    public function __construct()
    {
        session_start();
    }

    public static function setFlashMessage($key, $message)
    {
        $_SESSION[self::FLASH][$key] = $message;
    }

    public static function getFlashMessage($key)
    {
        return $_SESSION[self::FLASH][$key];
    }

    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function get($key)
    {
        return $_SESSION[$key];
    }

    public static function delete($key)
    {
        unset($_SESSION[$key]);
    }

    public function __destruct()
    {
        unset($_SESSION[self::FLASH]);
        
    }
}