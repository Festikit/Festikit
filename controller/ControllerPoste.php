<?php

require_once File::build_path(array("model","ModelPoste.php"));

class ControllerPoste {

    public static function readAll() {
        if (Session::is_admin()) {
            $tab_p = ModelPoste::selectAll();

            $pagetitle = 'Liste des postes';
            $controller = 'poste';
            $view = 'list';
        } else {
            $pagetitle = 'Erreur';
            $controller = 'utilisateur';
            $message = "Vous n'avez pas l'autorisation !";
            $view = 'errorAccess';
        }
        require File::build_path(array("view","view.php"));
    }

    public static function read() {
        $poste_id = $_GET['poste_id'];
        $p = ModelPoste::select($poste_id);
        $festival_id = $p->getFestivalId();

        $boolResponsable = 0;
        if(Session::is_responsable()) {
            $boolResponsable = 1;
        }
        if (Session::is_admin() || (Session::is_responsable() && (ModelFestival::getResponsableByFestivalAndUser($festival_id, $_SESSION['login']) ))) {
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
        } else {
            $pagetitle = 'Erreur';
            $controller = 'utilisateur';
            $message = "Vous n'avez pas l'autorisation !";
            $view = 'errorAccess';
        }
        require File::build_path(array("view", "view.php"));
    }

    public static function update(){
        if (Session::is_admin()) {
            $controller = 'poste';
            $view='update';
            $pagetitle='modification du poste';
            $log_p  = $_GET['poste_id'];
            $tab_creneau = ModelCreneau::getAllCreneauxByPosteId($log_p);
            $tab_p = ModelPoste::select($log_p);
        } else {
            $pagetitle = 'Erreur';
            $controller = 'utilisateur';
            $message = "Vous n'avez pas l'autorisation !";
            $view = 'errorAccess';
        }
        require (File::build_path(array("view","view.php")));
    }

    public static function updated(){
        if (Session::is_admin()) {
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
            $postemod->update($tab_pmod); //gen
            $tab_p = ModelPoste::selectAll();
        } else {
            $pagetitle = 'Erreur';
            $controller = 'utilisateur';
            $message = "Vous n'avez pas l'autorisation !";
            $view = 'errorAccess';
        }
        require (File::build_path(array("view","view.php")));
    }

    public static function create()
    {
        if (Session::is_admin()) {
            $controller = 'poste';
            $view = 'create';
            $pagetitle = 'ajout d\'un poste';
        } else {
            $pagetitle = 'Erreur';
            $controller = 'utilisateur';
            $message = "Vous n'avez pas l'autorisation !";
            $view = 'errorAccess';
        }

        require(File::build_path(array("view", "view.php")));
    }
   


    public static function created()
    {
        if (Session::is_admin()) {
            $controller = 'poste';
            $view = 'created';
            $pagetitle = 'ajout d\'un poste';

            $poste_name = $_GET['poste_name'];
            $poste_description = $_GET['poste_description'];
            $festival_id = $_GET['festival_id'];        

            $dataPoste = array(
                "poste_name" => $poste_name,
                "poste_description" => $poste_description,
                "festival_id" => $festival_id,
                
            );
        
            if (is_bool(ModelPoste::save($dataPoste))) {
                $controller = 'creneau';
                $view = 'error';
                $message = 'Erreur: Insertion des données dans la table poste';
                $pagetitle = 'erreur';
            }
            $f = ModelFestival::select($festival_id);
            $tab_benevoleAccepted = ModelFestival::getBenevolesAcceptedByFestival($festival_id);
            $tab_candidature = ModelFestival::getCandidatsByFestival($festival_id);
            $tab_poste = ModelFestival::getPostesByFestival($festival_id);
            $tab_date = ModelFestival::getJoursByFestival($festival_id);
            $tab_responsable = ModelFestival::getResponsableByFestival($festival_id);
            $tab_creneau = ModelFestival::getCreneauxByFestival($festival_id);
            $tab_creneau_gen = ModelCreneau::getCreneauxGen($festival_id);
            if(Session::is_responsable()) {
                $boolResponsable = 1;
            } else {
                $tab_responsable = ModelFestival::getResponsableByFestival($festival_id);
                $boolResponsable = 0;
            }
        } else {
            $pagetitle = 'Erreur';
            $controller = 'utilisateur';
            $message = "Vous n'avez pas l'autorisation !";
            $view = 'errorAccess';
        }
        
        require(File::build_path(array("view", "view.php")));
    }

    public static function delete(){
        if (Session::is_admin()) {
            $controller = 'poste';
            $pagetitle = 'supprimons ceci';
            $view = 'deleted';
            $poste_id = $_GET['poste_id'];
            ModelPoste::delete($poste_id);
        } else {
            $pagetitle = 'Erreur';
            $controller = 'utilisateur';
            $message = "Vous n'avez pas l'autorisation !";
            $view = 'errorAccess';
        }
        require File::build_path(array("view","view.php"));
    }
}

?>
