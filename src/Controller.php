<?php
declare(strict_types=1);

namespace app\src;

abstract class Controller
{
    public function view($view, $data = []) {
        extract($data);
        include App::$APP_PATH."/views/$view.php";
    }
}