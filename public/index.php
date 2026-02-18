<?php
require_once (dirname(__DIR__) ."/autoloader.php");
require_once (dirname(__DIR__) ."/src/Helpers/functions.php");
use App\Core\Session;
use App\Core\Wizardvalidator;
\App\Core\Session::getInstance();


$router = new App\Core\Router();

$router -> addMiddleware([
    // ajout des middlewares
]);

   // ajout des routes
$router->get("/users/create", App\Controllers\UserController::class . "::create");
$router->post("/users/create", App\Controllers\UserController::class . "::store");
$router->get("/users/terms", App\Controllers\UserController::class . "::terms");
$router->get("/users/privacy", App\Controllers\UserController::class . "::privacy");
//var_dump(password_hash("azerty", PASSWORD_DEFAULT));
$router
    ->get("/", App\Controllers\HomepageController::class ."::home")


$router->run();

//$user = (new User()) -> find(1) ->getNameRole();
