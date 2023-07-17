<?php
//Une route est une correspondance entre une URL, un controller et une méthode
class Router {
    
    private $routes = [];
    
    public function addRoute ($url, $controller, $method) 
    {
        $this->routes[$url] = [
                'controller' => $controller, // Nom de la classe controlleur à exécutée
                'method' => $method // Nom de la méthode de la classe controller à executée 
            ];
    }

    public function setDefaultRoute($route) {
        $this->route = $route;
    }
    
    public function foundRoute($url){
        if(isset($this->route[$url])){
            return $this->route[$url];
        } else {
            return null;
        }
    }
    
    public function dispatch()
    {
        $url = $_SERVER['REQUEST_URI']; // Contient l'url de la requete html actuelle // l'url par défault est : /  
        
        //Vérifie si la route existe 
        if (isset($this->routes[$url]))
        {
            $controller = $this->routes[$url]['controller']; //Récupère le controller  
            $method = $this->routes[$url]['method']; //Récupère la méthode
            
            //Exécute la méthode du contrôlleur 
            call_user_func_array([new $controller, $method],[]);
        } else{
            //Route non trouvé
            header('404 not found');
        }
    }
}

//Créer une nouvelle instance du
$router = new Router;

//Ajoute des routes
$router->addRoute('/create','create','user' );
$router->addRoute('/edit', 'edit','user' );
$router->addRoute('/delete', 'delete', 'user' );
$router->addRoute('/read', 'read', 'user');
$router->addRoute('/read_all','readAll', 'user' );

$router->setDefaultRoute('/create'); // Définit la route par défault 

$router->dispatch(); // Démarre le routeur

if($router->foundRoute($route)) {
    
    $controller = new $router->controller;
    $method = $router->method;
    $controller->$method();
    
} else {
    header('404 not found'); 
}

?>