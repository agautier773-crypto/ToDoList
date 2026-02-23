<?php

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Controller;
use App\Core\View;
use App\Core\WizardValidator;

class AuthController extends Controller
{
    public function login(): void
    {
        View::render("auth.login");
    }

    public function attemptLogin(): void
    {
        $validator = new WizardValidator($_POST, [
            "email" => "required",
            "password" => "required",
        ]);

        if ($validator->fails()){
            # gestion des erreurs
            var_dump($validator->errors());
            die("ERROR");
        }
        $validated = $validator->validated();
        Auth::attempt($validated);

    }

    public function logout(): void{
        Auth::logout();
    }
}