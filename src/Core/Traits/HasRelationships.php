<?php

namespace App\Core\Traits;


use App\Core\Model;
use App\Models\Article;
use App\Models\Role;
use App\Models\User;
use App\Controllers\ArticleController;

/**
 * Fournit des méthodes pour définir et récupérer les relations
 *Gère les relations d'une base de données
 * Extrait uniquement les valeurs des champs fillable
 * Génère des placeholders SQL pour INSERT et UPDATE
 * Récupère la liste des noms de champs

 */
trait HasRelationships {

    /**
     * Définit une relation plusieurs a plusieurs (N:N)
     * Récuperer les infos d'une table de liaison
     * @param string $targetClass
     * @param string $pivotTable
     * @return Model|array
     */
    public function belongsToMany(string $targetClass, string $pivotTable):Model|array{
        $targetTable =  (new $targetClass())->getNameTable();
        $foreignKey = $this->getNameTable() . "_id";
        $targetKey = $targetTable . "_id";
        $sql = "SELECT {$targetTable}.* FROM {$targetTable} JOIN {$pivotTable} 
            ON {$targetTable}.id = {$pivotTable}.{$targetKey} WHERE {$pivotTable}.{$foreignKey} = :id";
        return $this->readQuery($sql, ["id" => $this->id], false, $targetClass);
    }

    /**
     * Définit une relation un à plusieurs (1 : N)
     * va voir si il y a clé étrangère dans une table
     * @param string $targetClass
     * @param string $foreingKey
     * @return Model|array
     */
    public function hasMany(string $targetClass, string $foreingKey):Model|array{
        $targetTable = (new $targetClass())->getNameTable(); # article
        # SELECT * FROM article WHERE user_id = 2
        $sql = "SELECT * FROM {$targetTable} WHERE {$foreingKey} = :id";
        return $this->readQuery($sql, ["id" => $this->id], false, $targetClass);
    }

    /**
     * Définit une relation plusieurs à un (N:1)
     * va voir si il y a une clé étrangere dans une table
     * @param string $targetClass Class cible
     * @param string $foreignKey Clé étrangère
     * @return Model|array
     */
    public function belongsTo(string $targetClass, string $foreignKey):Model|array|bool
    {
        $targetTable = (new $targetClass())->getNameTable();
        $sql = "SELECT * FROM {$targetTable} WHERE id = :id";
        return $this->readQuery($sql, ["id" => $this->$foreignKey], true, $targetClass);
    }

    /**
     * Ecrire dans une table de liaison
     * Supprime les relations existantes si il y en a
     * Ajoute les nouvelles relations dans la table de liaison
     * @param string $targetClass
     * @param array $data
     * @param string $pivotTable
     * @return bool
     */
    public function sync(string $targetClass, array $data, string $pivotTable = ""):bool
    {

        $targetTable = (new $targetClass())->getNameTable();
        $targetKey = $targetTable . "_id";
        $baseTable = $this->getNameTable();
        $baseKey = $baseTable . "_id";
        try{
            $this->pdo->beginTransaction();
            $sqlDelete = "DELETE FROM {$pivotTable} WHERE {$pivotTable}.{$baseKey} = :id";
            $dataDelete = [
                "id" => $this->id
            ];
            $stmt = $this->pdo->prepare($sqlDelete);
            $stmt->execute($dataDelete);
            //$this->writeQuery($sqlDelete, $dataDelete);
            # ET ENSUITE ON AJOUTE
            if ($pivotTable == "") {
                $pivotTable = $baseTable . '_' . $targetTable; # user_role
            }
            if(!empty($data)){
                $sql = "INSERT INTO {$pivotTable} ({$baseKey}, {$targetKey}) VALUES (:{$baseKey}, :{$targetKey})";
                $stmt = $this->pdo->prepare($sql);

                foreach ($data as $id_role){
                    $stmt->execute([
                        $baseKey => $this->id,
                        $targetKey => $id_role
                    ]);
                }
            }
            $this->pdo->commit();
            return true;

        }catch (\Exception $e){
        $this->pdo->rollBack();
        return false;
        }
    }

    public function detach($targetClass, $foreignKey){
        $table = (new $targetClass())->getNameTable();
        $sql = "UPDATE {$table} SET {$foreignKey} = NULL WHERE {$foreignKey} = :id";
        $data = [
            "id"=>$this->id,
        ];
        var_dump($sql);
        return $this->writeQuery($sql, $data);
    }
}