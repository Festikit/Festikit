<?php

require_once File::build_path(array("model","ModelPostuler.php"));

class ControllerPostuler {

    public static function readAll() {
        $tab_p = ModelPoste::selectAll();

        $pagetitle = 'Liste postuler';
        $controller = 'postuler';
        $view = 'list';
        require File::build_path(array("view","view.php"));
    }

    /* Supprime la candidature d'un bénévole */
    public static function delete() {
        $user_id = $_GET['user_id'];
        if(Session::is_user($user_id)){
            $boolUser = 1;
        } else {
            $boolUser = 0;
        }
        if(Session::is_admin()){
            $boolAdmin = 1;
        } else {
            $boolAdmin = 0;
        }
        if(Session::is_user($user_id) || Session::is_admin()) {
            $controller = 'postuler';
            $pagetitle = 'Suppression de candidature';
            $view = 'deleted';
            ModelPostuler::delete($user_id);
            ModelDisponible::delete($user_id);
            ModelPreference::delete($user_id);
            $tab_u = ModelUtilisateur::selectAll();
        } else {
            $pagetitle = 'Erreur';
            $controller = 'utilisateur';
            $message = "Vous n'avez pas l'autorisation !";
            $view = 'errorAccess';
        }
        require File::build_path(array("view", "view.php"));
    }
}

?>
