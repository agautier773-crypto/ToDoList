<?php

namespace App\Core;

use \PDO;
# use App\Core\Config;
# Pas besoin de le mettre, car même namespace

class Database{

    /**
     * Connexion a une base de donnée
     * @var PDO
     *
     */
    protected static PDO $pdo;

    /**
     * Récupère l'instance pdo singleton pour la connexion a la bdd
     * Implémente le pattern singleton pour permettre qu'une seule connexion
     * Si pas de connexion, alors elle est créée automatiquement
     * @return PDO|null
     */
    public static function getPDO() : ?PDO{
        if(!empty(self::$pdo)){
            return self::$pdo;
        }else{
            try {
                $db_cfg = Config::get("database");
                $dsn ="mysql:dbname={$db_cfg["name"]};host={$db_cfg["host"]}";
                self::$pdo = new PDO($dsn, $db_cfg["username"], $db_cfg["password"]);
                return self::$pdo;
            } catch (\Exception $e) {
                echo "Attention erreur connexion base de données ! " . $e->getMessage();
                return null;
            }
        }
    }

}