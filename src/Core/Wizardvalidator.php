<?php

namespace App\Core;

/**
 * Permet la validation des données saisie dans un formulaire
 */
class Wizardvalidator {

    private mixed $data;

    private array $rules;

    public array $errors = [];

    public array $validated = [];

    public array $default_msg = [
        "max"      => "Le champ :field est trop grand",
        "min"      => "Le champ :field est trop petit",
        "unique"   => "Le champ :field existe déjà",
        "required" => "le champ :field est requis"
    ];


    /**
     * Initialise le validateur avec les données à valider et les règles
     * @param mixed $data
     * @param array $rules
     */
    public function __construct(mixed $data, array $rules){
        $this->data = $data;
        $this->rules = $rules;
    }

    /**
     * Parsing pour extraires les différentes règles et paramètres si il y en a
     * Analyse chaque règle, extrait les paramètres éventuels, et appelle la méthode de validation correspondante.
     * Supporte les règles multiples séparées par "|" et les paramètres séparés par ":".
     * @return void
     */
    public function getRules(){
        foreach ($this->rules as $field => $rule){
            if(str_contains($rule, "|")){
                $fragementRules = explode("|", $rule);
                //var_dump($fragementRules);
                foreach ($fragementRules as $fragement){
                    if(str_contains($fragement, ":")){
                        [$name_rule, $param] = explode(":", $fragement);
                        //var_dump("Pour le champ : {$field} on doit appliquer la regle : {$name_rule}($param)");
                        $this->applyRules($name_rule, $field, $param, $this->data[$field]);
                    }else{
                        //var_dump("Pour le champ : {$field} on doit appliquer la regle : {$fragement}()");
                        $this->applyRules($fragement, $field, "",$this->data[$field]);
                    }
                }
            }else{
                if(str_contains($rule, ":")){
                    [$name_rule, $param] = explode(":", $rule);
                    $this->applyRules($name_rule, $field,"",$this->data[$field]);
                }else{
                    //var_dump("Pour le champ : {$field} on doit appliquer la regle : {$fragement}()2");
                    $this->applyRules($rule, $field,"",$this->data[$field]);
                }
            }
        }
    }

    /**
     * Applique les règles avec ou sans les paramètres
     * @param $name
     * @param string $field
     * @param $param
     * @param mixed|null $value
     * @return mixed
     */
    public function applyRules($name, string $field, $param = null, mixed $value = null)
    {

        if (method_exists($this, $name)) {
            $isValid = false;
            if ($param === null || $param == '') {
                $isValid = $this->$name($value);
            } else {
                $isValid = $this ->$name($param, $value);
            }
            //var_dump("Résultat pour la methode {$name} : " . ($isValid ? 'true' : 'false'));
        }
        if ($isValid){
            $this->validated[$field] = $value;
        }else{
            $this ->addError($name, $field);
        }
        return $isValid;

    }

    /**
     * Vérifie le nombre min de caractères saisie par l'utilisateur
     * @param string $min
     * @param mixed $value
     * @return bool
     */
    public function min (string $min, mixed $value): bool{
        if (strlen($value) <= intval($min)){
            return false;
        }
        return true;
    }

    /**
     * Vérifie le nombre max de caractères saisie par l'utilisateur
     * @param string $max
     * @param mixed $value
     * @return bool
     */
    public function max (string $max, string $value) :bool{
        if (strlen($value) > $max){
            return false;
        }
        return true;
    }

    /**
     * Vérifie que la valeur soit unique
     * @param $param
     * @param $value
     * @return bool
     */
    public function unique($param, $value){
        if (str_contains($param, ",")) {
            [$table, $champ] = (explode(",", $param));

            $pdo = Database::getPDO();

            $sql = "SELECT COUNT(id) FROM {$table} WHERE {$champ} = :value";
            $req = $pdo->prepare($sql);
            $req->execute(['value' => $value]);

            return $req->fetchColumn() == 0;
        }
    }

    /**
     * Vérifie que la valeur ne soit pas vide
     * @param $value
     * @return bool
     */
    public function required($value){
        return !empty($value);
    }

    /**
     * Vérifie si un champ peut être vide
     * @param $value
     * @return bool
     */
    public function nullable($value):bool{
        return true;
    }

    /**
     * Ajoute un message d'erreur pour un champ donné.
     * @param $nameRule
     * @param $field
     * @return void
     */
    public function addError($nameRule, $field){
        $this-> errors[$field] = $this->getMessageError($nameRule, $field);
    }

    /**
     * Retourne les valeurs validées
     * @return array
     */
    public function validated(){
        return $this->validated;
    }

    /**
     * Retourne les erreurs
     * @return array
     */
    public function errors(){
        return $this->errors;
    }

    /**
     * Récupère le message qui correspond au champ
     * @param string $nameRule
     * @param string $field
     * @return array|mixed|string|string[]
     */
    public function getMessageError(string $nameRule, string $field){
        $msg = $this->default_msg[$nameRule];
        return str_replace(":field", $field, $msg);
    }

    /**
     * Vérifie que toutes les valeurs dans data n'est pas produit d'erreur
     * @return bool
     */
    public function fails(){
        $this->getRules();
        return count ($this->errors) != 0;
    }
}