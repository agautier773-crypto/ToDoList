<?php
 namespace App\Models;

 use App\Core\Model;
 use App\Core\Traits\HasRelationships;

 /**
  * Représente un utilisateur de l'application.
  *
  * @package App\Core\Model
  */
 class User extends Model {
     use HasRelationships;

     /**
      * Clé primaire
      * @var int
      */ //|null à voir
     public int $id;

     /**
      * Nom de l'utilisateur
      */
     public string $nom = "";

     /**
      * Prénom de l'utilisateur
      */
     public string $prenom = "";

     /**
      * Email de l'utilisateur
      */
     public string $email = "";

     /**
      * Mot de passe de l'utilisateur
      */
     public string $password = "";

     /**
      * Date de création de l'utilisateur
      */
     public string $date_creation = "";

     /**
      * Liste des champs utilisés par le trait IsFillable
      * pour la génération et la préparation des requêtes SQL.
      *
      * @var string[]
      */
     public array $fillable = [
         "nom",
         "prenom",
         "email",
         "password",
     ];



     /**
      * Tâches associées à cet utilisateur.
      *
      * @return Tache[]
      */
     public function taches(){
         return $this->belongsToMany(Tache::class, "tache_user");
     }
 }