<?php


namespace App\Core\Middlewares;

use App\Core\Session;
use App\Core\Auth;

class AuthMiddlewares implements InterfaceMiddlewares
{

    public function handle(): void
    {
        if (!Auth::check()) {
            Session::setFlash("warning", "vous devez être log");
            header("Location: /login");
            exit;
        }
    }
}
