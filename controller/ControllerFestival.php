<?php

require_once File::build_path(array("model","ModelFestival.php"));

class ControllerFestival {

    public static function readAll() {
        $tab_f = ModelFestival::getAllFestivals();

        $pagetitle = 'Liste des festivals';
        $controller = 'festival';
        $view = 'list';
        require File::build_path(array("view","view.php"));
    }
}

?>
