<?php
namespace App\Core;
/**
 * Classe de base pour tous les controllers de l'application
 */
class Controller{

    public string $view_path ;

    /**
     * Initialise le controlleur
     * Configure le chemin vers le repertoire des vues en utilisant le repertoire parent
     */
    public function __construct(){
        $this->view_path = dirname(__DIR__) . "/Views";
    }
// Plus besoin car on utilise celui de view
//    /**
//     * Regarde si le fichier de vue existe par rapport au chemin déclaré
//     * @param string $view
//     * @param array $data
//     * @return void
//     */
//    public function render(string $view, array $data = []){
//        extract($data);
//        $view_file = $this->view_path . "/" . $view .".php";
//        if (file_exists($view_file)) {
//            require $view_file;
//        }else{
//            echo "la vue n'existe pas! ";
//        }
//    }

    /**
     * Redirige l'utilisateur vers une URL spécifique
     * @param $path
     * @return void
     */
    public function redirect($path){
        header("Location: {$path}");
        exit;
    }
}