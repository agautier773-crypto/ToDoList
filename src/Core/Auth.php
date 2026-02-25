<?php

namespace App\Core;

use App\Models\User;

class Auth{
    public static ?User $user = null;

    public static function check(): bool{
        return Session::has('user');
    }

    public static function user(){
        if (!self::$user) {
            self::$user = (new User())->find(self::id());
            return self::$user;
        }
        return self::$user;
    }

    public static function id(): ?int{
        if (Session::has('user')) {
            return Session::get("user");
        }
        return null;
    }

    public static function attempt($validated): void{
        $user = (new User())->findBy("email", $validated["email"], true);
        if ($user) {
            if (password_verify($validated["password"], $user->password)) {
                self::login($user);
            }
        }
        Session::setFlash("error", "combo mail/mdp erroné !");
        header("location: /login");
        exit;
    }

    public static function login(User $user): void{
        Session::setUser($user->id);
        Session::setFlash("success", "Connexion réussie");
        header("location: /tache");
        exit;
    }

    public static function logout(): void{
        unset($_SESSION["user"]);
        Session::setFlash("success", "Vous êtes bien deconnecté");
        header("Location: /login");
        exit;
    }
}
