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

    public static function read() {

        $poste_id = $_GET['poste_id'];
        $p = ModelPoste::getPosteById($poste_id);

        if ($p == false) {
            $pagetitle = 'Erreur action read';
            $controller = 'poste';
            $view = 'error';
        } else {
            $pagetitle = 'Détail du poste';
            $controller = 'poste';
            $view = 'detail';
        }

        require File::build_path(array("view", "view.php"));
    }
}

?>
