<?php
declare(strict_types=1);

namespace app\src;

use app\src\Route;
use app\src\Request;

class App 
{
    public static string $APP_PATH;
    public array $config;
    public Route $route;
    public Request $request;


    public function __construct($path)
    {
        self::$APP_PATH = $path;
        $this->route = new Route();
    }

    public function runForest()
    {
        $this->route->direct();
    }
}