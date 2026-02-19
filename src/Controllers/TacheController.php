<?php
namespace App\Controllers;

use App\Core\Database;
use App\Core\Session;
use App\Core\View;
use App\Core\Controller;
use App\Core\Wizardvalidator;
use App\Models\Categorie;
use App\Models\Tache;
use App\Models\User;
use App\Core\Traits\HasRelationships;
use App\Helpers;

class TacheController extends Controller{

    public function index(){
        View::render("tache.index", [
            "categorie" =>(new Categorie())->findAll(),
            "taches" =>(new Tache()) -> findAll(),
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