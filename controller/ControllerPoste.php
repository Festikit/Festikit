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
            $view = 'messageRetour';
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
            if ($p == false) {
                $pagetitle = 'Erreur action read';
                $controller = 'poste';
                $view = 'messageRetour';
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
            $view = 'messageRetour';
        }
        require File::build_path(array("view", "view.php"));
    }

    public static function update(){
        if (Session::is_admin()) {
            $controller = 'poste';
            $view='update';
            $pagetitle='modification du poste';
            $log_p  = $_GET['poste_id'];
            $tab_p = ModelPoste::select($log_p);
        } else {
            $pagetitle = 'Erreur';
            $controller = 'utilisateur';
            $message = "Vous n'avez pas l'autorisation !";
            $view = 'messageRetour';
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
            
            $tab_p = ModelPoste::select($log_p);
            $tab_creneau = ModelCreneau::getCreneauxDateByPosteId($log_p);
        } else {
            $pagetitle = 'Erreur';
            $controller = 'utilisateur';
            $message = "Vous n'avez pas l'autorisation !";
            $view = 'messageRetour';
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
            $view = 'messageRetour';
        }

        require(File::build_path(array("view", "view.php")));
    }
   


    public static function created()
    {
        if (Session::is_admin()) {    

            $poste_name = $_GET['poste_name'];
            $poste_description = $_GET['poste_description'];
            $festival_id = $_GET['festival_id'];        

            $dataPoste = array(
                "poste_name" => $poste_name,
                "poste_description" => $poste_description,
                "festival_id" => $festival_id,
                
            );
        
            if (is_bool(ModelPoste::save($dataPoste))) {
                $controller = 'utilisateur';
                $view = 'messageRetour';
                $message = 'Erreur: Insertion des données dans la table poste';
                $pagetitle = 'erreur';
            } else {
                $pagetitle = 'Détail du festival';
                $controller = 'utilisateur';
                $view = 'messageSuite';
                $message = 'Le poste ' . "\"$poste_name\"" . ' a été créer avec succés !';
                $path='action=read&controller=festival&festival_id=' . $festival_id;
            }
        } else {
            $pagetitle = 'Erreur';
            $controller = 'utilisateur';
            $message = "Vous n'avez pas l'autorisation !";
            $view = 'messageRetour';
        }
        
        require(File::build_path(array("view", "view.php")));
    }

    public static function delete(){
        if (Session::is_admin()) {
            $poste_id = $_GET['poste_id'];
            $festival_id = ModelPoste::select($poste_id)->get('festival_id');

            if (is_bool(ModelPoste::delete($poste_id))) {
                $controller = 'utilisateur';
                $view = 'messageRetour';
                $message = 'Erreur: Suppression des données dans la table poste';
                $pagetitle = 'erreur';
            } else {
                $pagetitle = 'Détail du festival';
                $controller = 'utilisateur';
                $view = 'messageSuite';
                $message = 'Le poste a été supprimer avec succés !';
                $path='action=read&controller=festival&festival_id=' . $festival_id;
            }
        } else {
            $pagetitle = 'Erreur';
            $controller = 'utilisateur';
            $message = "Vous n'avez pas l'autorisation !";
            $view = 'messageRetour';
        }
        require File::build_path(array("view","view.php"));
    }
}

?>
