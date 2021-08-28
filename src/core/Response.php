<?php
declare(strict_types=1);

namespace app\src\core;

class Response
{
    public static function setStatusCode($code)
    {
        return http_response_code($code);
    }

    
}