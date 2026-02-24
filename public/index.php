<?php


#var_dump(dirname(__DIR__) ."/autoloader.php");

require_once (dirname(__DIR__) ."/autoloader.php");
require_once (dirname(__DIR__) ."/src/Helpers/functions.php");
use App\Core\Session;
use App\Core\Wizardvalidator;
\App\Core\Session::getInstance();

$router = new App\Core\Router();


$router -> addMiddleware([
    "auth" => App\Core\Middlewares\AuthMiddlewares::class,
    "csrf" => App\Core\Middlewares\CsrfMiddlewares::class,

    // ajout des middlewares
]);
$router
   // ajout des routes
    ->get("/", App\Controllers\HomepageController::class ."::home")
    ->get("/users/create", App\Controllers\UserController::class . "::create")
    ->post("/users/create", App\Controllers\UserController::class . "::store")
    ->get("/users/terms", App\Controllers\UserController::class . "::terms")
    ->get("/users/privacy", App\Controllers\UserController::class . "::privacy")
    ->get("/categorie", App\Controllers\CategorieController::class . "::index")
    ->get("/categorie/delete/{id}", App\Controllers\CategorieController::class . "::delete")

    ->get("/tache/create", App\Controllers\TacheController::class . "::create")-> middleware("auth")
    ->post("/tache/create", App\Controllers\TacheController::class . "::store")-> middleware("auth")
    ->get("/tache/update/{id}", \App\Controllers\TacheController::class . "::edit")-> middleware("auth")
    ->post("/tache/update/{id}", \App\Controllers\TacheController::class . "::update")-> middleware("auth")
    ->get("/tache", App\Controllers\TacheController::class ."::index")-> middleware("auth")
    ->get("/tache/show/{id}", App\Controllers\TacheController::class ."::show")-> middleware("auth")
    ->get("/tache/delete/{id}", App\Controllers\TacheController::class ."::delete")-> middleware("auth")

    ->get("/login", App\Controllers\AuthController::class . "::login")
    ->post("/login", App\Controllers\AuthController::class . "::attemptlogin")
    ->get("/logout", App\Controllers\AuthController::class . "::logout")

->run();

//$user = (new User()) -> find(1) ->getNameRole();
