<?php


namespace App\Core\Middlewares;

use App\Core\Session;
use App\Helpers\Csrf;

class CsrfMiddlewares implements InterfaceMiddlewares
{

    public function handle(): void
    {
        $attempUri = $_SERVER["REQUEST_URI"];
        //var_dump($_POST['csrf_token']);
        //var_dump($_SESSION['csrf_token']['token']);
        //die("stop");
        if ($_POST['csrf_token'] != $_SESSION['csrf_token']['token'] || !Csrf::isTokenValid()) {
            Session::setFlash("danger", "Le token n'est pas bon");
            header("Location: {$attempUri}");
            exit;
        }
    }
}