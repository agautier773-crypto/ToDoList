<?php
namespace App\Models;

use App\Core\Model;
use App\Core\Traits\HasRelationships;

/**
 * Représente une catégorie d'une tâche.
 *
 * @package App\Core\Model
 */
class Categorie extends Model
{
    use HasRelationships;

    /**
     * Clé primaire
     * @var ?int
     */
    public ?int $id;

    /**
     * Nom de la catégorie
     * @var string
     */
    public string $nom = "";

    /**
     * Liste des champs utilisés par le trait IsFillable
     * pour la génération et la préparation des requêtes SQL.
     *
     * @var string[]
     */
    public array $fillable = [
        "nom",
    ];

    /**
     * Tâches associées à cette catégorie.
     *
     * @return Tache[]
     */
    public function taches(): array
    {
        return $this->hasMany(Tache::class, "categorie_id");
    }
}