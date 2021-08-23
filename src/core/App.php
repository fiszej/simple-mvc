<?php
declare(strict_types=1);

namespace app\src\core;

use app\src\coreRoute;
use app\src\core\Request;
use app\src\core\Database;

class App 
{
    public static string $APP_PATH;
    public array $config;
    public Route $route;
    public Request $request;
    public static Database $db;


    public function __construct(string $path, array $config)
    {
        self::$APP_PATH = $path;
        $this->route = new Route();
        $this->request = new Request();
        self::$db = new Database($config);
    }

    public function runForest()
    {
        $this->route->direct();
    }
}