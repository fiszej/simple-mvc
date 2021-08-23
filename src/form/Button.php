<?php
declare(strict_types=1);

namespace app\src\form;

class Button 
{
    public static function send(string $type, string $name, string $value, string $attr = '')
    {
        echo sprintf('<input type="%s" name="%s" value="%s" class="%s">', $type, $name, $value, $attr);
    }
}