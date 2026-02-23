<?php

namespace  App\Core\Traits;

/**
 * Permet de manipuler les données avant les requetes sql
 * Extrait uniquement les propriétés de l'objet qui sont définies dans le tableau $fillable, pour éviter l'assignation en masse de champs sensibles.
 */
trait IsFillable {

    public function getValues(){
        $values = [];
        foreach (get_object_vars($this) as $attr => $value){
            if (in_array($attr, $this->fillable)){
                $values[$attr] = $value;
            }
        }
        return $values;
    }

    /**
     * Génère une chaine de placeholders de valeur préparée pour les requêtes
     * Soit des placeholders pour INSERT,
     * Soit des assignations pour UPDATE
     *
     * @param bool $isUpdate
     * @return string
     */
    public function getPreparedValues(bool $isUpdate = false){
        # username = :username OU :username
        $preparedValues = [];
        foreach ($this->fillable as $attr){
            if ($isUpdate) {
                $preparedValues[] = $attr . " = :" . $attr;
            }else{
                $preparedValues[] = ":" . $attr;
            }
        }
        return implode(", ", $preparedValues);
    }

    /**
     * Récupère la liste des noms de champs remplissables
     *
     * @return string
     */
    public function getFields(){
        return implode(", ", $this->fillable);
    }
}