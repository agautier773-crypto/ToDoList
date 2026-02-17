<?php

namespace App\Core;

use App\Core\Controller;

class Session{
    private static ?Session $instance = null;
    public static function getInstance (){
        if (self::$instance === null){
            self::isStarted();
            self::$instance = new self();
        }
        return self::$instance;
    }

    public static function isStarted():void{
        if (session_status() === PHP_SESSION_NONE) session_start();
    }

    public static function has($key):bool{
        return isset($_SESSION[$key]);
    }

    public static function get($key):mixed{
        return $_SESSION[$key] ?? null;
    }

    public static function setFlash(string $type, string $message): void{
        $_SESSION["_flash"][$type][] = $message;
    }

    public static function getAllFlashes(){
        $msg = $_SESSION["_flash"] ?? null;
        unset($_SESSION["_flash"]);
        return $msg;
    }
    public static function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }
    public static function setUser(int $id) {
        $_SESSION["user"] = $id;
    }

}