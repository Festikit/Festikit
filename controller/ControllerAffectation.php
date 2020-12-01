<?php

require_once File::build_path(array("model","ModelAffectation.php"));

class ControllerAffectation {

    public static function readAll() {
        $tab_a = ModelAffectation::selectAll();

        $pagetitle = 'Liste des affectations';
        $controller = 'affectation';
        $view = 'list';
        require File::build_path(array("view","view.php"));
    }
}

?>
