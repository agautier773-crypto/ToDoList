<?php

namespace App\Core;

/**
 * Represente le fichier de configuration qui est a la racine du projet
 */
class Config {

    /**
     * @var array stock les informations de la configuration
     */
    private static $cfg = [];

    /**
     * Permet de charger et d'enregistrer la configuration a partir d'un fichier de conf
     * @return void
     */
    public static function  load() : void {
        $cfg_file = dirname(__DIR__, 2) . "/config.php";
         if (file_exists($cfg_file)) {
            Config::$cfg = require $cfg_file;
        }
    }

    /**
     * Permet de recuperer une valeur dans le fichier de configuration
     * @param string $key
     * @return mixed
     */
    public static function get(string $key) : mixed {
        if (empty(self::$cfg)) {
            Config::load();
        }
        return Config::$cfg[$key] ?? null;
    }

}