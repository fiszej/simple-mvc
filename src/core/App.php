<?php
declare(strict_types=1);

namespace app\src\core;

use app\src\core\Route;
use app\src\core\Request;
use app\src\core\Database;
use app\src\core\Session;

class App 
{
    public static string $PATH;
    public array $config;
    public Route $route;
    public Request $request;
    public static Database $db;
    public Session $session;


    public function __construct(string $path, array $config)
    {
        self::$PATH = $path;
        $this->route = new Route();
        $this->request = new Request();
        self::$db = new Database($config);
        $this->session = new Session();
    }

    public function runForest()
    {
        $this->route->direct();
    }
}