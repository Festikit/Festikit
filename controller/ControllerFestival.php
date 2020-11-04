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

    public static function read() {

        $festival_id = $_GET['festival_id'];
        $f = ModelFestival::getFestivalById($festival_id);
        //$tab_benevoleAccepted = ModelFestival::getBenevoleAcceptedByFestival($festival_id);
        // La solution serait d'appeler ModelUtilisateur 
        $tab_benevoleAccepted = ModelUtilisateur::getBenevoleAcceptedByFestival($festival_id);
        //Mais a-ton le droit ?
        

        if($f == false) {
            $pagetitle = 'Erreur action read';
            $controller = 'festival';
            $view = 'error';
        } else {
            $pagetitle = 'Détail du festival';
            $controller = 'festival';
            $view = 'detail';  
        }
        
        require File::build_path(array("view","view.php"));
    }
}

?>
