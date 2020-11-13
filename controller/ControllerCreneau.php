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
}

?>
