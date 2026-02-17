<?php

namespace App\Core;

/**
 * Gestionnaire de routage de l'application
 * Permet de définir et gérer les routes http de l'app et dispatcher les requ^ztes vers les controlleurs approprés
 *
 */
class Router{

    /**
     * tableau contenant toutes les routes enregistrées
     * @var array
     */
    public array $routes = [];

    public ?int $lastRoute = null;
    public array $middlewares = [];
    public string $lastMethod;

    /**
     * Execute le routeur et traite la requête courante
     * Compare l'URI de la requête avec les routes enregistrés et dispatch vers les controlleurs
     * @return void|null
     */
    public function run()
    {
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $requestUri = $_SERVER["REQUEST_URI"];
        $param = [];

        foreach ($this->routes[$requestMethod] as $path => $routes) {
            if (preg_match($routes['path'], $requestUri, $matches)) {
                $param = (array_pop($matches));
                foreach($routes["middleware"] as $middleware){
                    $middleware->handle();
                }
                return $this->dispatch($routes['action'], $param);
            }
        }
        echo "404";
    }

    /**
     *  Dispatch vers le controlleur appropriés
     * @param string $action
     * @param string $param
     * @return void
     */
    public function dispatch(string $action, string $param = ""){

        $controller = explode("::", $action)[0];
        $method = explode("::", $action)[1];
        if (class_exists($controller)){
            $controller = new $controller();
            if (method_exists($controller, $method)&& $param != "") {
                $controller->$method($param);
            }else{
                $controller->$method();
            }
        }
    }

    /**
     * Ajoute une route au Routeur
     * @param string $methodHttp
     * @param string $path
     * @param string $action
     * @return $this
     */

    public function add(string $methodHttp, string $path, string $action) : Router {
        $path = $this->getPattern($path);
        $this->lastMethod = $methodHttp;
        $this->routes[$methodHttp][] = [
            'path' => $path,
            'action' => $action,
            'matches' => [],
            'middleware'=>[]
        ];

        $this->lastRoute = array_key_last($this->routes[$methodHttp]);
        return $this;
    }

    /**
     * Appel Get
     * @param string $path
     * @param string $action
     * @return $this
     */
    public function get(string $path, string $action) : Router {
        $this->add("GET",$path,$action);
        return $this;
    }


    /**
     * Appel Post
     * @param string $path
     * @param string $action
     * @return $this
     */
    public function post(string $path, string $action) : Router {
        $this->add("POST",$path, $action);
        return $this;
    }

    /**
     * Utilitaire pour visualiser l'ensemble des routes
     * @return $this
     */
    public function dumpRoutes() : Router {
        return $this;
    }

    /**
     * Convertit une route en expression régulière
     * @param string $path
     * @return string
     */
    public function getPattern(string $path){
        $pattern = "/{[a-z0-9]+}/";
        $replace = "([\d]+)";
        $chemin = preg_replace($pattern, $replace, $path);
        $chemin = "#^". $chemin . "$#";
        return $chemin;
    }

    public function middleware($middleware){

        //var_dump($middleware);
        if(str_contains($middleware, ":")){
            [$name, $params] = explode(":", $middleware);
            //var_dump($this->middlewares[$name]);
            $m = new $this->middlewares[$name](trim($params));
            //var_dump($m);
        }else{
            $name = $middleware;
            $m = new $this->middlewares[$name]();
        }
        $this->routes[$this->lastMethod][$this->lastRoute]["middleware"][]= $m;
        //var_dump($this->routes[$this->lastMethod][$this->lastRoute]);
        return $this;
    }

    public function addMiddleware($array){

        $this->middlewares = $array;

    }

}