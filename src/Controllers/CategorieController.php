<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Core\View;
use App\Core\WizardValidator;
use App\Models\Categorie;

class CategorieController extends Controller
{

    /**
     * Liste toutes les catégories
     */
    public function index(): void
    {
        View::render("categories.index",[
            "categories" => (new Categorie())->findAll(),
        ]);
    }

    /**
     * Affiche le formulaire de création
     */
    public function create(): void
    {
        View::render("categories.form",[
            "categorie" => new Categorie(),
        ]);
    }

    /**
     * Enregistre une nouvelle catégorie
     */
    public function store(): void
    {
        $validator = new WizardValidator($_POST, [
            "nom" => "required|min:2|max:100",
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors() as $error) {
                Session::setFlash("danger", $error);
            }
            Session::set("old", $_POST);
            $this->redirect("/categories/create");
        }

        $validated = $validator->validated();

        $categorie = new Categorie();
        $categorie->fill($validated);
        $categorie->save();

        Session::setFlash("success", "Catégorie créée avec succès !");
        $this->redirect("/categories");
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit(int $id): void
    {
        $categorie = Categorie::find($id);

        if (!$categorie) {
            Session::setFlash("danger", "Catégorie introuvable.");
            $this->redirect("/categories");
        }

        View::render("categories.edit", compact("categorie"));
    }

    /**
     * Met à jour une catégorie
     */
    public function update(int $id): void
    {
        $categorie = Categorie::find($id);

        if (!$categorie) {
            Session::setFlash("danger", "Catégorie introuvable.");
            $this->redirect("/categories");
        }

        $validator = new WizardValidator($_POST, [
            "nom" => "required|min:2|max:100",
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors() as $error) {
                Session::setFlash("danger", $error);
            }
            Session::set("old", $_POST);
            $this->redirect("/categories/{$id}/edit");
        }

        $validated = $validator->validated();

        $categorie->fill($validated);
        $categorie->save();

        Session::setFlash("success", "Catégorie mise à jour avec succès !");
        $this->redirect("/categories");
    }

    /**
     * Supprime une catégorie
     */
    public function delete(int $id): void{
        $c = (new Categorie())->find($id);
        $c->delete();

        Session::setFlash("success", "Catégorie supprimée avec succès !");
        $this->redirect("/categorie");
    }
}
