<?php

require_once File::build_path(array("model","ModelCreneau.php"));

class ControllerCreneau {

    public static function readAll() {
        $tab_c = ModelCreneau::selectAll();

        $pagetitle = 'Liste des creneaux';
        $controller = 'creneau';
        $view = 'list';
        require File::build_path(array("view","view.php"));
    }

    public static function read() {

        $creneau_id = $_GET['creneau_id'];
        $c = ModelCreneau::getCreneauById($creneau_id);

        if ($c == false) {
            $pagetitle = 'Erreur action read';
            $controller = 'creneau';
            $view = 'error';
            $message = 'erreur de la fonction read dans le controller Creneau';
        } else {
            $pagetitle = 'Détail du créneau';
            $controller = 'creneau';
            $view = 'detail';
        }

        require File::build_path(array("view", "view.php"));
    }
}

?>
