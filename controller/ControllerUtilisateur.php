<?php

require_once File::build_path(array("model","ModelUtilisateur.php"));

class ControllerUtilisateur {

    public static function readAll() {
        $tab_u = ModelUtilisateur::getAllUtilisateurs();

        $pagetitle = 'Liste des utilisateurs';
        $controller = 'utilisateur';
        $view = 'list';
        require File::build_path(array("view","view.php"));
    }

    public static function read() {

        $pagetitle = 'Détail de l\'utilisateur';
        $controller = 'utilisateur';
        $view = 'detail';
        
        $user_id = $_GET['user_id'];
        $u = ModelUtilisateur::getUtilisateurById($user_id);
        if($u == false) {
            require File::build_path(array("view","utilisateur","error.php"));
        } else {
            require File::build_path(array("view","view.php"));
        }
    }

    public static function delete(){
        $controller = 'utilisateur';
        $pagetitle = 'supprimons ceci';
        $view = 'deleted';
        $user_id = $_GET['user_id'];
        ModelUtilisateur::deleteById($user_id);
        $tab_u = ModelUtilisateur::getAllUtilisateurs();
        require File::build_path(array("view","view.php"));
    }
}

?>
