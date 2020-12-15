<?php

require_once File::build_path(array("model","ModelResponsable.php"));

class ControllerResponsable {

    public static function readAll() {
        $tab_r = ModelResponsable::selectAll();
        $tab_nomResponsable = ModelResponsable::getNomResponsable();

        $pagetitle = 'Liste des responsables';
        $controller = 'responsable';
        $view = 'list';
        require File::build_path(array("view","view.php"));
    }

    public static function read() {
        
        $responsable_id = $_GET['responsable_id'];
        $r = ModelResponsable::select($responsable_id);


        if($r == false) {
            $pagetitle = 'Erreur action';
            $controller = 'responsable';
            $view = 'error';
            $message = 'erreur de la fonction read';
        } else {
            $pagetitle = 'Détail du responsable';
            $controller = 'responsable';
            $view = 'detail';
        }
        require File::build_path(array("view","view.php"));
    }


    


    /*public static function desassignerResponsable(){
        $responsable_id = $_GET['responsable_id'];
        $festival_id = $_GET['festival_id'];
        $f = ModelResponsable::select($festival_id);
        $f->desassignerResponsable($responsable_id);

        $tab_benevoleAccepted = ModelFestival::getBenevolesAcceptedByFestival($festival_id);
        $tab_candidature = ModelFestival::getCandidatsByFestival($festival_id);
        $tab_poste = ModelFestival::getPostesByFestival($festival_id);
        $tab_creneau = ModelFestival::getCreneauxByFestival($festival_id);
        $tab_responsable = ModelFestival::getResponsableByFestival($festival_id);

        if ($f == false) {
            $pagetitle = 'Erreur action read';
            $controller = 'festival';
            $view = 'error';
            $message = 'erreur de la fonction desassignerResponsable dans le controller festival';
        } else {
            $pagetitle = 'Détail du festival';
            $controller = 'festival';
            $view = 'detail';
        }
        require File::build_path(array("view", "view.php"));
    } */

   } 

?>
