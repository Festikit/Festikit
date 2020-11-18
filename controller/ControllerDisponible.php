<?php

require_once File::build_path(array("model","ModelDisponible.php"));

class ControllerDisponible {

    public static function readAll() {
        $tab_d = ModelDisponible::getAllDisponible();

        $pagetitle = 'Liste des dispo';
        $controller = 'disponible';
        $view = 'list';
        require File::build_path(array("view","view.php"));
    }
}

?>
