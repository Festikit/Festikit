<?php

require_once File::build_path(array("model","ModelLieu.php"));

class ControllerLieu {

    public static function readAll() {
        $tab_l = ModelLieu::selectAll();

        $pagetitle = 'Liste des lieux';
        $controller = 'lieu';
        $view = 'list';
        require File::build_path(array("view","view.php"));
    }
}

?>