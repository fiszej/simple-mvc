<?php
declare(strict_types=1);

namespace app\src\core;

class Request 
{
    public static function uri()
    {
        $uri = $_SERVER['REQUEST_URI'] ?? '/';
        $pos = strpos($uri, '?');
        if ($pos) {
            $uri = substr($uri, 0, $pos);
        }
        return $uri;
    }

    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}