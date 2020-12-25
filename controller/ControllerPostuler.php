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
        $festival_id = $_GET['festival_id'];
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
            $postuler_id = ModelPostuler::getPostulerByUserAndFestival($user_id, $festival_id);
            print_r($postuler_id);
            $disponible_id = ModelDisponible::getDisponibleByUserAndFestival($user_id, $festival_id)->getDisponibleId();
            $preference_id = ModelPreference::getPreferenceByUserAndFestival($user_id, $festival_id)->getPreferenceId();
            ModelPostuler::delete($postuler_id);
            ModelDisponible::delete($disponible_id);
            ModelPreference::delete($preference_id);
            if(is_bool(ModelPostuler::delete($postuler_id)) && is_bool(ModelDisponible::delete($disponible_id)) && is_bool(ModelPreference::delete($preference_id))) {
                $pagetitle = 'Erreur';
                $controller = 'utilisateur';
                $message = "Erreur: Suppression de la candidature.";
                $view = 'error';
            } else {
                $controller = 'postuler';
                $pagetitle = 'Suppression de candidature';
                $view = 'deleted';
                $tab_u = ModelUtilisateur::selectAll();
            }
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
