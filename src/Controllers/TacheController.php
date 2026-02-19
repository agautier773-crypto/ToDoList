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

use App\Helpers;

class TacheController extends Controller{

    public function index(){
        View::render("tache.index", [
            "categorie" =>(new Categorie())->findAll(),
            "taches" =>(new Tache()) -> findAll(),
        ]);
    }
}