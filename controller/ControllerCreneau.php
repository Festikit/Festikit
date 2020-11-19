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

    public static function read() {

        $creneau_id = $_GET['creneau_id'];
        $c = ModelCreneau::getCreneauById($creneau_id);

        if ($c == false) {
            $pagetitle = 'Erreur action read';
            $controller = 'creneau';
            $view = 'error';
            $message = 'erreur de la fonction read dans le controller Creneau';
        } else {
            $pagetitle = 'Détail du créneau';
            $controller = 'creneau';
            $view = 'detail';
        }

        require File::build_path(array("view", "view.php"));
    }

    public static function update(){
        $controller = 'creneau';
        $view='update';
        $pagetitle='modification du creneau';
        $log_c  = $_GET['creneau_id'];
        $tab_c = ModelCreneau::getCreneauById($log_c);
        require (File::build_path(array("view","view.php")));
    }

    public static function updated(){
    
        $controller = 'creneau';
        $view='updated';
        $pagetitle='modification du creneau';
        
        $log_c = $_GET['creneau_id'];
        $creneau_startdate = $_GET['creneau_startdate'];
        $creneau_enddate = $_GET['creneau_enddate'];
        $festival_id = $_GET['festival_id'];
        $poste_id = $_GET['poste_id'];
          
        $tab_cmod = array(
            "creneau_id" => $log_c,
            "creneau_startdate" => $creneau_startdate,
            "creneau_enddate" => $creneau_enddate,
            "festival_id" => $festival_id,
            "poste_id" => $poste_id,
        );
        $creneaumod = new ModelCreneau();
        $creneaumod->update($tab_cmod);
        $tab_c = ModelCreneau::selectAll();
        require (File::build_path(array("view","view.php")));
    }
}

?>
