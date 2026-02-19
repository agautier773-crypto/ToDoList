<?php

namespace App\Core;

use App\Core\Database;
use App\Core\Traits\IsFillable;
use App\Helpers\Csrf;
use App\Models\Article;
use App\Models\User;
use PDO;
use App\Helpers;

/**
 * Classe pour tous les modèles de l'application
 * opérations CRUD et gestion sql pour intéragir avec une base de données via PDO
 */
class Model {
    use IsFillable;

    /**
     * @var string
     */
    protected string $table = "";
    /**
     * @var PDO|null
     */
    protected ?PDO $pdo;


    /**
     * Initialise la connexion PDO et définit le nom de la table
     *  Récupère automatiquement l'instance PDO via la classe Database
     *  Définit le nom de la table en fonction du nom de la classe
     */
    public function __construct(){
        $this->pdo = Database::getPDO();
        $this->table = get_class($this);
    }

    /**
     * récupère tous les enregistrements d'une table
     * @return array
     */
    public function findAll():array{
        $sql = "SELECT * FROM {$this->getNameTable()}";
        return $this->readQuery($sql);
    }

    /**
     * pointe et récupère un enregistrement d'une table
     * @param int $id
     * @return array
     */
    public function find(int $id){
        $sql = "SELECT * FROM " . $this->getNameTable() . " WHERE id = :id";
        return $this->readQuery($sql, ["id" => $id], true);
    }

    /**
     * Créer un nouvel enregistrement dans une bdd
     * utilise les propriétés de l'objet
     * @return bool résultat de l'execution de la requête
     * @throws \Exception
     */
    public function create():bool{
        $values = $this->getPreparedValues();
        $sql = "INSERT INTO {$this->getNameTable()} ({$this->getFields()}) VALUES ({$values})";
        var_dump($values, $sql);

        return $this->writeQuery($sql, $this->getValues());
    }

    /**
     * Permets la modif et l'enregistrement d'une ligne déja existante dans une table
     * @return bool
     */
    public function update():bool{
        $sql = "UPDATE {$this->getNameTable()} SET {$this->getPreparedValues(true)} WHERE id = :id";
        $values = $this->getValues();
        $fields = explode(", ", $this->getFields());

        $values["id"] = $this->id;
        return $this->writeQuery($sql, $values);
    }

    /**
     * Supprime un enregistrement dans une table
     * @param $id
     * @return bool
     */
    public function delete($id):bool{
        $sql = "DELETE FROM {$this->getNameTable()} WHERE id = :id";
        return $this->writeQuery($sql, ["id" => $id]);
    }

    /**
     * Sauvegarde l'objet courant
     * @return void
     */
    public function save(){
        if (!isset($this->id)){
            $this->create();
        }else{
            $this->update();
        }
    }

    /**
     * Recherche enregistrement par par un champ spécifique
     * @param string $field
     * @param string $value
     * @return array
     */
    public function findBy(string $field, string $value, bool $isOne = false):Model|array|null{
        # SELECT * FROM user WHERE mail = toto@trotro.wip
        $sql = "SELECT * FROM {$this->getNameTable()} WHERE {$field} = :{$field}";
        return $this->readQuery($sql, ["{$field}" => $value], $isOne);
    }
    public function findOneBy(string $field, string $value){
        # SELECT * FROM user WHERE mail = toto@trotro.wip
        $sql = "SELECT * FROM {$this->getNameTable()} WHERE {$field} = :{$field}";
        return $this->readQuery($sql, ["{$field}" => $value], true);
    }


    /**
     * récupère le nom de la table
     * extrait le nom de la classe sans le namespace et convertit en minuscule
     * @return string
     */
    public function getNameTable(){
        $resultat_parsing = explode("\\", $this->table);
        $last_index = count($resultat_parsing) - 1;
        return strtolower($resultat_parsing[$last_index]);
    }


    /**
     * Exécute une requête préparée
     * @param string $sql
     * @param array $data
     * @param bool $isOne
     * @param string|null $fetchClass
     * @return array|Model
     */
//    public function executeQuery(string $sql, array $data = [], bool $isOne = false, ?string $fetchClass = null) : array|Model{
//        $req = $this->pdo->prepare($sql);
//        $req->execute($data);
//        if (!$fetchClass){
//            $class = static::class;
//        }else{
//            $class = $fetchClass;
//        }
//        $req->setFetchMode(PDO::FETCH_CLASS, $class);
//        if ($isOne){
//            return $req->fetch();
//        }
//        return $req->fetchAll();
//    }

    /**
     * @param string $sql
     * @param array $data
     * @param string|null $fetchClass
     * @param bool $isOne
     * @return array|false|mixed
     * On prepare la requete SQL
     * on l'execute avec les données à récup
     * Gestion des données de retour
     * Indiquer avec setFetchMode la classe a utiliser pour le retour
     * gestion du retour (fetch/fetchAll)
     */
    public function readQuery(string $sql, array $data = [], bool $isOne = false, string $fetchClass = null){
        $req = $this->pdo->prepare($sql);
        $req->execute($data);
        if (!$fetchClass) {
            $class = static::class;
        }else {
            $class = $fetchClass;
        }
        $req->setFetchMode(PDO::FETCH_CLASS, $class);
        if ($isOne){
            $result = $req->fetch();
            return $result ?: null;
        }
        return $req->fetchAll();
    }

    public function writeQuery(string $sql, array $data = []):bool{
        try {
            $this->pdo->beginTransaction();
            $req = $this->pdo->prepare($sql);
            $req->execute($data);
            $lastId = $this->pdo->lastInsertId();
            $this->pdo->commit();
            if ($lastId > 0){
                $this->id =$lastId;
            }
            return true ;

        }catch(\Exception $e){
            $this->pdo->rollBack();
            echo $e->getMessage();
            return false;
        }

    }

    public function fill(array $values)
    {
        $attr = explode(", ", $this->getFields());
        foreach ($attr as $field) {
            if (property_exists($this, $field)){
                $this->$field = $values[$field];
            }
        }
    }
}