<?php

namespace App\Models;

use App\Core\Model;
use App\Core\Traits\HasRelationships;
use App\Core\Traits\IsFillable;

class Categorie extends Model{

    use HasRelationships;
    use IsFillable;

    public int $id;
    public string $nom = "";

    public array $fillable = [
        "nom",
    ];

    public function tache(){
        return $this->belongsTo(Tache::class, "categorie_id");
    }
}
