<?php
declare(strict_types=1);

namespace app\src\core;

class Route
{
    private array $routes = [];

    
    public function get(string $path, $controller)
    {
        $this->routes['GET'][$path] = $controller;
    }

    
    public function post(string $path, $controller)
    {
        $this->routes['POST'][$path] = $controller;
    }

   
    public function direct()
    {
        $uri = Request::uri();
        $method = Request::method();

        $callback = $this->routes[$method][$uri];
  
        if (is_string($callback)) {
            include "views/$callback.php";
            return;
        }     
        if (is_array($callback)) {
            $controller = new $callback[0];
            $method = $callback[1];
            return $controller->$method();
        }

        return call_user_func($callback);

    }
}