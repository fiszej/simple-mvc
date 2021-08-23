<?php
declare(strict_types=1);

namespace app\src\form;

class Form 
{

    public function startForm(string $action , string $method, string $attr = '')
    {

        echo sprintf('<form action="%s" method="%s" class="%s">', $action, $method, $attr);
    }

    public function endForm()
    {
        echo '</form>';
    }
}