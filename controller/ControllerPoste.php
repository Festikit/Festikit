<?php

require_once File::build_path(array("model","ModelPoste.php"));

class ControllerPoste {

    public static function readAll() {
        $tab_p = ModelPoste::selectAll();

        $pagetitle = 'Liste des postes';
        $controller = 'poste';
        $view = 'list';
        require File::build_path(array("view","view.php"));
    }
}

?>
