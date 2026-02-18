<?php

namespace App\Models;
use App\Core\Model;
use App\Core\Traits\HasRelationships;
use App\Core\Traits\IsFillable;

class Tache extends Model{
    use HasRelationships;
    use IsFillable;

    public int $id;
    public string $titre = "";
    public string $description = "";
    public string $date_creation = "";
    public string $date_fin = "";
    public string $statut = "";

    public ?int $categorie_id = null;

    public array $fillable = [
        "titre",
        "description",
        "date_creation",
        "date_fin",
        "statut",
    ];

    public function user(){
        return $this->belongsToMany(User::class, "tache_user");
    }
    public function categorie(){
        return $this->hasMany(Categorie, "categorie_id");
    }
}

