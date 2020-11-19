<?php

require_once File::build_path(array("model","ModelPreference.php"));

class ControllerPreference {

    public static function readAll() {
        $tab_p = ModelPreference::getAllPreference();

        $pagetitle = 'Liste des preferences';
        $controller = 'preference';
        $view = 'list';
        require File::build_path(array("view","view.php"));
    }
}

?>