<?php

namespace App\Helpers;

use App\Core\Session;
use Exception;

class Csrf{

    private const SESSION_TOKEN_KEY = 'csrf_token';

    private const FIELD_NAME = 'csrf_token';

    /**
     * @throws Exception
     * @throws Exception
     */
    public static function generateToken():string{
        Session::isStarted();

        $token = bin2hex(random_bytes(32));
        $_SESSION[self::SESSION_TOKEN_KEY] = [
            'token' => $token,
        ];
        return $token;
    }

    /**
     * @throws Exception
     */
    public static function getToken(): string{
        Session::isStarted();

        if(!self::isTokenValid()){
            return self::generateToken();
        }
        return $_SESSION[self::SESSION_TOKEN_KEY]['token'];
    }

    /**
     * @throws Exception
     */
    public static function field():string{
        $token = self::getToken();
        $fieldName = self::FIELD_NAME;

        return "<input type='hidden' value='{$token}' name='{$fieldName}'";
    }

    public static function isTokenValid():bool{
        if(!isset($_SESSION[self::SESSION_TOKEN_KEY]['token'])){
            return false;
        }
        return true;
    }

}