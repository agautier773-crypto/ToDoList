<?php

namespace App\Controllers;

use App\Core\Controller;

use App\Models\Categorie;
use App\Models\Tache;
use App\Models\User;
use App\Core\View;
use App\Core\Auth;
use App\Core\Session;
use App\Core\Wizardvalidator;


/**
 * Contrôleur gérant les tâches.
 * Fournit les fonctionnalités CRUD communes
 */
class TacheController extends Controller{
    public function create(){
        $tache = new Tache();
        $categories = (new Categorie())->findAll();
        View::render("tache.form",[
            'tache'=> $tache,
            'categories'=> $categories,
            "titre" => "Ajouter une nouvelle tâche",
        ]);
    }

    public function store(){
        $validator = new WizardValidator($_POST, [
            "titre" => "required|min:5|max:200",
            "description" => "nullable|required|min:2|max:1000",
            "date_fin" => "required",
            "categorie"=> "required",
        ]);

        if ($validator->fails()){
            # erreurs
            foreach ($validator->errors() as $error){
                Session::setFlash("danger", $error);
            }
            Session::set("old", $_POST);
            header("Location: /tache/create");
            exit;
        }

        $validated = $validator->validated();
        $validated["statut"]="à faire";
        $validated["categorie_id"] = $validated["categorie"];
        unset($validated["categorie"]);
        $tache = new Tache();
        $tache->fill($validated);

        $tache->save();
        $tache->sync(User::class, [Auth::id()], "tache_user");

        Session::setFlash("success", "Tache bien créer !");
        $this->redirect("/tache");
    }

    /**
     * Affiche le formulaire de modification
     *
     * @param mixed $id
     *
     * @return void
     *
     * @throws \Exception
     */
    public function edit(mixed $id) : void{
        $id = intval($id);
        $tache = (new Tache())->find($id);
        $categories = (new Categorie())->findAll();

        View::render('tache.form',[
            'tache'=>$tache,
            'categories'=>$categories,
        ]);
    }

    /**
     * Met à jour une tâche
     *
     * @param mixed $id
     *
     * @return void
     */
    public function update(mixed $id): void
    {
        $id=intval($id);
        $tache = (new Tache())->find($id);


        $validator = new WizardValidator($_POST, [
            "titre" => "required|min:5|max:200",
            "description" => "nullable|required|min:2|max:1000",
            "date_fin" => "required",
            "statut" => "required",
            "categorie_id" => "required",
        ]);
        if ($validator->fails()){
            # erreurs
            foreach ($validator->errors() as $error){
                Session::setFlash("danger", $error);
            }
            Session::set("old", $_POST);
            header("Location: /tache/update/".$tache->id);
            exit;
        }
        $validated = $validator->validated();
        $tache->fill($validated);
        $tache->save();

        $this->redirect("/tache");

    }
    public function index(){
        View::render("tache.index", [
            "categories" => (new Categorie())->findAll(),
            // Pour avoir que les tâches lié à l'utilisateur connecté
            "tache" => (new User())->find(Auth::id())->taches(),
            "titre" => "Liste des tâches",
        ]);
    }

    public function show($id){
        $t = new Tache();
        $t = $t->find($id);

        View::render("tache.show", [
            "tache" =>$t,
            "titre" => "Mes tâches",
        ]);
    }

    public function delete($id):void{
        $t = (new Tache())->find($id);
        if(!$t){
            $this->redirect("/tache");
        }
        $t->sync(User::class, [], "tache_user");
        $t -> delete($id);
        Session::setFlash("warning", "Cette tâche a été supprimée");
        $this->redirect("/tache");
    }
}