<?php
 namespace App\Models;

 use App\Core\Model;
 use App\Core\Traits\HasRelationships;
 use App\Core\Traits\IsFillable;

 class User extends Model {
     use HasRelationships;
     public int $id;
     public string $nom = "";
     public string $prenom = "";
     public string $email = "";
     public string $password = "";
     public string $date_creation = "";
     public array $fillable = [
         "nom",
         "prenom",
         "email",
         "password",
         "date_creation",
     ];
     public array $tache;

     public function taches(){
         return $this->belongsToMany(Tache::class, "tache_user");
     }
 }