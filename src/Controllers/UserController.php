<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Core\View;
use App\Core\WizardValidator;
use App\Models\User;

class UserController extends Controller {

    public function create() :void{
        View::render("users.create");
    }

    public function store(){
        var_dump($_POST);
        $validator = new WizardValidator($_POST, [
            "prenom" => "required|min:2|max:1000",
            "nom" => "required|min:2|max:1000",
            "password" => "required",
            "email" => "required|min:2",
        ]);
        if ($validator->fails()){
            # erreurs
            foreach ($validator->errors() as $error){
                Session::setFlash("danger", $error);
            }
            Session::set("old", $_POST);
            header("Location: /users/create");
            exit;
        }
        $validated = $validator->validated();

        $user = new User();
        $user->fill($validated);


        $user->password = password_hash($validated["password"], PASSWORD_DEFAULT);
        $user->save();
        Session::setFlash("success", "Utilisateur bien créer !");
        $this->redirect("/users/create");

    }

    public function terms() :void{
        View::render("users.terms");
    }

    public function privacy() :void{
        View::render("users.privacy");
    }

}