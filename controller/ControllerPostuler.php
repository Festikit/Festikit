<?php

require_once File::build_path(array("model","ModelPostuler.php"));

class ControllerPostuler {

    public static function readAll() {
        $tab_p = ModelPoste::getAllPostuler();

        $pagetitle = 'Liste postuler';
        $controller = 'postuler';
        $view = 'list';
        require File::build_path(array("view","view.php"));
    }
}

?>
