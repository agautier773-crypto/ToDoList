<?php

namespace App\Core;

use Exception;

/**
 * Gestionnaire de vue de l'application
 * Charge et affiche des vues avec un layout
 */
class View {

    /**
     * Chemin absolu vers le répertoire des vues
     *
     * @var string
     */
    public static string $view_path = "C:/Wamp64/www/ToDoList/views";
    /**
     * @var string
     */
    public static string $layout_path = "C:/Wamp64/www/ToDoList/views/layouts";

    /**
     * Affiche une vue dans le layout principal
     * Charge une vue spécifique et l'injecte dans le layout principal
     * @param string $view
     * @param array $data
     * @return void
     * @throws Exception
     */
    public static function render(string $view, array $data = []) {
        if (str_contains($view, ".")){
            $view = str_replace(".", "/", $view);
        }
        $layout_path = self::$layout_path . "/main.php";

        if (file_exists($layout_path)) {
            $view_file = self::$view_path . "/" . $view .".php";
            if (file_exists($view_file)) {
                $data["content"] =  $view_file;
            }
            $data["messages"] = Session::getAllFlashes();
            extract($data);
            require $layout_path;
        }else{
            throw new Exception("la vue $view n'existe pas");
        }
    }
}