<?php

class Router {
    
    private $routes = [];
    
    public function addRoute ($url, $controller, $method) 
    {
        $this->routes[$url] = [
                'controller' => $controller,
                'method' => $method
            ];
    }
    
    public function dispatch()
    {
        $url = $_SERVER['REQUEST_URI']; // je    
    }
}


?>