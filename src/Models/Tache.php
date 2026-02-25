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

    /**
     * Clé primaire
     * @var ?int
     */
    public ?int $id;

    /**
     * Titre de la tâche
     * @var string
     */
    public string $titre = "";

    /**
     * Description de la tâche
     * @var string
     */
    public string $description = "";

    /**
     * Date de création de la tâche
     * @var string
     */
    public string $date_creation = "";

    /**
     * Date de fin prévu pour la tâche
     * @var string
     */
    public string $date_fin = "";

    /**
     * Statut de la tâche
     * @var string
     */
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
        "categorie_id",
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
     * @return Categorie|Categorie[]
     */

    public function categorie(){
        return $this->belongsTo(Categorie::class, "categorie_id");
    }

    public function getNameCategorie(){
        $categorie = $this->categorie();

        $libelle = $categorie->nom;

        return $libelle;
    }


}

