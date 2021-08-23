<?php
declare(strict_types=1);

namespace app\src\form;

use app\src\Model;

class Input 
{
    public string $type = 'text';
    public string $name;
    public string $attr;

    public function __construct(string $type, string $name, string $attr = '')
    {
        $this->type = $type;
        $this->name = $name;
        $this->attr = $attr;
    }

    public function renderInput()
    {
        echo sprintf('<input type="%s" name="%s" class="form-control %s"><br>', 
            $this->type, 
            $this->name,
            $this->attr
        );
    }
}