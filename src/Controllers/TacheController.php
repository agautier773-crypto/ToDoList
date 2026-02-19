<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Core\View;
use App\Core\Wizardvalidator;
use App\Models\Categorie;
use App\Models\Tache;


class TacheController extends Controller{
    public function create(){
        $tache = new Tache();
        $categories = (new Categorie())->findAll();
        View::render("tache.form",[
            'tache'=> $tache,
            'categories'=> $categories,
        ]);
    }

    public function store(){
        var_dump($_POST);
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
//        var_dump($validated);

        $tache = new Tache();
        $tache->fill($validated);
//        var_dump($tache);
//        die;

        $tache->save();
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
            "categorie" => "required",
        ]);
        if ($validator->fails()){
            # erreurs
            foreach ($validator->errors() as $error){
                Session::setFlash("danger", $error);
            }
            Session::set("old", $_POST);
            header("Location: /tache/update");
            exit;
        }
        $validated = $validator->validated();
        $validated["categorie_id"] = $validated["categorie"];
        unset($validated["categorie"]);
        $tache->fill($validated);
//        var_dump($tache);
//        die;
        $tache->save();

        $this->redirect("/tache");

    }
    public function index(){
        View::render("tache.index", [
            "categories" =>(new Categorie())->findAll(),
            "tache" =>(new Tache()) -> findAll(),
        ]);
    }

    public function show($id){
        $t = new Tache();
        $t = $t->find($id);

        View::render("tache.show", ["tache" =>$t]);
    }

    public function delete($id):void{
        $t = (new Tache())->find($id);
        if(!$t){
            $this->redirect("/tache");
        }
        $t->sync(Categorie::class, [], "categorie_id");
        $t -> delete($id);
        Session::setFlash("warning", "Cette tâche a été supprimée");
        $this->redirect("/tache");
    }
}