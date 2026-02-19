<?php

namespace App\Models;
use App\Core\Model;
use App\Core\Traits\HasRelationships;


/**
 * Représente une tâche d'un utilisateur.
 *
 * @package App\Core\Model
 */
class Tache extends Model{
    use HasRelationships;


    public int $id;
    public string $titre = "";
    public string $description = "";
    public string $date_creation = "";
    public string $date_fin = "";
    public string $statut = "";

    // Regarder si on laisse une catégorie à null
    public ?int $categorie_id = null;

    /**
     * Liste des champs utilisés par le trait IsFillable
     * pour la génération et la préparation des requêtes SQL.
     *
     * @var string[]
     */
    public array $fillable = [
        "titre",
        "description",
        "date_fin",
        "statut",
    ];

    /**
     * Utilisateurs associés à cette tâche.
     *
     * @return User[]
     */
    public function user(){
        return $this->belongsToMany(User::class, "tache_user");
    }

    /**
     * Catégorie associé à la tâche.
     *
     * @return User[]|null
     */
    public function categorie(){
        return $this->belongsTo(Categorie::class, "categorie_id");
    }

    public function getNameCategorie(){
        $categories = $this->categorie();
        $libelle =  [];
        foreach ($categories as $categorie){
            $libelle[] = $categorie ->nom;
        }
        return $libelle;
    }
}

