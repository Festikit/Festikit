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

        if(Session::is_user($user_id) || Session::is_admin()) {
            
            $tab_postuler = ModelPostuler::getPostulerByUserAndFestival($user_id, $festival_id);
            // Suppression de toutes les candidatures de ce candidat pour ce festival
            // Si jamais le candidat c'est inscrit plusieurs fois au festival (normalement impossible)
            foreach($tab_postuler as $postuler) {
                $postuler_id = $postuler->getPostulerId();
                ModelPostuler::delete($postuler_id);
                $reussitePostuler = 1;
                if(!is_bool(ModelPostuler::delete($postuler_id))){
                    $message = "Erreur : Suppression pour la table Postuler";
                    $reussitePostuler = 0;
                    break;
                }
            }

            if($reussitePostuler) {
                $tab_disponible = ModelDisponible::getDisponibleByUserAndFestival($user_id, $festival_id);
                // Suppression de toutes les disponibilités de ce candidat pour ce festival
                foreach($tab_disponible as $disponible) {
                    $disponible_id = $disponible->getDisponibleId();
                    $reussiteDisponible = 1;
                    if(!is_bool(ModelDisponible::delete($disponible_id))){
                        $message = "Erreur : Suppression pour la table Disponible";
                        $reussitePostuler = 0;
                        break;
                    }
                }
            }

            if($reussitePostuler && $reussiteDisponible) {
                $tab_preference = ModelPreference::getPreferenceByUserAndFestival($user_id, $festival_id);
                // Suppression de toutes les préférences de ce candidat pour ce festival
                foreach($tab_preference as $preference) {
                    $preference_id = $preference->getPreferenceId();
                    $reussitePreference = 1;
                    if(!is_bool(ModelPreference::delete($preference_id))){
                        $message = "Erreur : Suppression pour la table Preference";
                        $reussitePreference = 0;
                        break;
                    }
                }
            }
            
            if($reussitePostuler && $reussiteDisponible && $reussitePreference) { // ou if(!isset($message))
                /*
                controller = 'postuler';
                $pagetitle = 'Suppression de candidature';
                $view = 'deleted';
                */
                $message = "Candidature supprimée !";
            } else {
                $message = "Erreur: Suppression de candidature.";
            }
        } else {
            $message = "Vous n'avez pas l'autorisation !";
        }
        $controller = 'utilisateur';
        $pagetitle = 'Suppression de candidature';
        require File::build_path(array("view", "view.php"));
    }
}

?>
