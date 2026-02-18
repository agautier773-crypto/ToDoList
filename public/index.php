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

//var_dump(password_hash("azerty", PASSWORD_DEFAULT));
$router
    ->get("/", App\Controllers\HomepageController::class ."::home")



->run();

//$user = (new User()) -> find(1) ->getNameRole();
