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
$router
   // ajout des routes
    ->get("/", App\Controllers\HomepageController::class ."::home")
    ->get("/users/create", App\Controllers\UserController::class . "::create")
    ->post("/users/create", App\Controllers\UserController::class . "::store")
    ->get("/users/terms", App\Controllers\UserController::class . "::terms")
    ->get("/users/privacy", App\Controllers\UserController::class . "::privacy")

    ->get("/tache", App\Controllers\TacheController::class ."::index")

    ->get("/login", App\Controllers\AuthController::class . "::login")
    ->post("/login", App\Controllers\AuthController::class . "::Attemptlogin")
    ->get("/logout", App\Controllers\AuthController::class . "::logout")

->run();

//$user = (new User()) -> find(1) ->getNameRole();
