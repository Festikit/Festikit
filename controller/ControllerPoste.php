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
        $tab_creneau = ModelCreneau::getAllCreneauxByPosteId($poste_id);

        if ($p == false) {
            $pagetitle = 'Erreur action read';
            $controller = 'poste';
            $view = 'error';
            $message = 'erreur de la fonction read dans le controller Poste';
        } else {
            $pagetitle = 'Détail du poste';
            $controller = 'poste';
            $view = 'detail';
        }

        require File::build_path(array("view", "view.php"));
    }

    public static function update(){
        $controller = 'poste';
        $view='update';
        $pagetitle='modification du poste';
        $log_p  = $_GET['poste_id'];
        $tab_creneau = ModelCreneau::getAllCreneauxByPosteId($log_p);
        $tab_p = ModelPoste::getPosteById($log_p);
        require (File::build_path(array("view","view.php")));
    }

    public static function updated(){
    
        $controller = 'poste';
        $view='updated';
        $pagetitle='modification du poste';
        
        $log_p = $_GET['poste_id'];
        $poste_name = $_GET['poste_name'];
        $poste_description = $_GET['poste_description'];
          
        $tab_pmod = array(
            "poste_id" => $log_p,
            "poste_name" => $poste_name,
            "poste_description" => $poste_description,
        );
        $postemod = new ModelPoste();
        $postemod->update($tab_pmod);
        $tab_p = ModelPoste::selectAll();
        require (File::build_path(array("view","view.php")));
    }
}

?>
