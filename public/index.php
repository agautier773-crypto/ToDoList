<?php
require_once (dirname(__DIR__) ."/autoloader.php");
require_once (dirname(__DIR__) ."/src/Helpers/functions.php");
use App\Core\Session;
use App\Core\Wizardvalidator;
\App\Core\Session::getInstance();

//var_dump(password_hash("Wood",PASSWORD_DEFAULT));
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
    ->get("/tache/create", App\Controllers\TacheController::class . "::create")
    ->post("/tache/create", App\Controllers\TacheController::class . "::store")
    ->get("/tache/update/{id}", \App\Controllers\TacheController::class . "::edit")
    ->post("/tache/update/{id}", \App\Controllers\TacheController::class . "::update")

->run();

//$user = (new User()) -> find(1) ->getNameRole();
