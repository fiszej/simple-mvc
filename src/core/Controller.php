<?php
declare(strict_types=1);

namespace app\src\core;

abstract class Controller
{
    public function view($view, $data = []) {
        extract($data);
        include App::$PATH."/views/$view.php";
    }
}