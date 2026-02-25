<?php

namespace App\Core;

use App\Core\Traits\IsFillable;
use App\Helpers\Csrf;
use Exception;
use PDO;

/**
 * Classe pour tous les modèles de l'application
 * Opérations CRUD et
 * gestion sql pour interagir avec une base de données via PDO
 */
class Model {
    use IsFillable;

    /**
     * Nom de la table associée au modèle
     * @var string
     */
    protected string $table = "";

    /**
     * Stock l'instance de PDO (singleton)
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
     * Pointe et récupère un enregistrement d'une table
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
     * @return bool
     * @throws Exception
     */
    public function create():bool{
        $values = $this->getPreparedValues();
        $sql = "INSERT INTO {$this->getNameTable()} ({$this->getFields()}) VALUES ({$values})";
        return $this->writeQuery($sql, $this->getValues());
    }

    /**
     * Permet la modification et l'enregistrement d'une ligne
     * déjà existante dans une table
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
     * @throws Exception
     */

    public function save(){
        if (!isset($this->id)){
            $this->create();
        }else{
            $this->update();
        }
    }

    /**
     * Recherche un ou plusieurs enregistrements selon un champ et une valeur donnés.
     * @param string $field Nom du champ sur lequel filtrer (ex: 'email')
     * @param string $value Valeur recherchée (ex: 'toto@trotro.wip')
     * @param bool $isOne Si true, retourne un seul résultat, sinon un tableau
     * @return static|array|null Une instance si $isOne, un tableau d'instances sinon, null si non trouvé
     */
    public function findBy(string $field, string $value, bool $isOne = false):Model|array|null{
        # SELECT * FROM user WHERE mail = toto@trotro.wip
        $sql = "SELECT * FROM {$this->getNameTable()} WHERE {$field} = :{$field}";
        return $this->readQuery($sql, ["{$field}" => $value], $isOne);
    }

    /**
     * Récupère le nom de la table
     * Extrait le nom de la classe sans le namespace et convertit en minuscule
     * @return string
     */
    public function getNameTable(){
        $resultat_parsing = explode("\\", $this->table);
        $last_index = count($resultat_parsing) - 1;
        return strtolower($resultat_parsing[$last_index]);
    }

# DQL = Data Query Language
# DML = Data Manipulation Language

    /**
     * Exécute les requêtes DQL préparées :
     *  - SELECT
     * et retourne le résultat hydraté.
     * @param string $sql
     * @param array $data
     * @param bool $isOne Si true, retourne un seul résultat (fetch)
     * @param string|null $fetchClass Classe à utiliser pour l'hydratation (défaut : classe courante)
     * @return object|array|null Une instance if $isOne, un tableau d'instances sinon, null si rien
     */

    # On prépare la requête SQL
    # on l'exécute avec les données à récup
    # Gestion des données de retour
    # Indiquer avec setFetchMode la classe à utiliser pour le retour
    # gestion du retour (fetch/fetchAll)
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

    /**
     * Exécute les requêtes DML préparées :
     *  - INSERT
     *  - UPDATE
     *  - DELETE
     * @param string $sql
     * @param array $data
     * @return bool
     */
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

        }catch (Exception $e){
            $this->pdo->rollBack();
            echo $e->getMessage();
            return false;
        }

    }

    /**
     * Hydrate les propriétés du modèle à partir d'un tableau associatif
     * Seuls les champs retournés par getFields() sont hydratés. (fillable)
     * @param array $values
     * @return void
     */
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