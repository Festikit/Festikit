<?php

require_once File::build_path(array("model","ModelUtilisateur.php"));

class ControllerUtilisateur {

    public static function create() {
        $pagetitle = 'Formulaire d\'enregistrement';
        $controller = 'utilisateur';
        $view = 'create';
        require File::build_path(array("view","view.php"));
    }

    public static function readAll() {
        $tab_u = ModelUtilisateur::getAllUtilisateurs();

        $pagetitle = 'Liste des utilisateurs';
        $controller = 'utilisateur';
        $view = 'list';
        require File::build_path(array("view","view.php"));
    }

    public static function read() {
        
        $user_id = $_GET['user_id'];
        $u = ModelUtilisateur::getUtilisateurById($user_id);

        $tab_festivalWhereAccepted = ModelUtilisateur::getFestivalWhereAccepted($user_id);
        $tab_festivalWhereCandidat = ModelUtilisateur::getFestivalWhereCandidat($user_id);

        if($u == false) {
            $pagetitle = 'Erreur action';
            $controller = 'utilisateur';
            $view = 'error';
            $message = "erreur read du controller";
        } else {
            $pagetitle = 'Détail de l\'utilisateur';
            $controller = 'utilisateur';
            $view = 'detail';
        }
        require File::build_path(array("view","view.php"));
    }

    public static function delete(){
        $controller = 'utilisateur';
        $pagetitle = 'supprimons ceci';
        $view = 'deleted';
        $user_id = $_GET['user_id'];
        ModelUtilisateur::deleteById($user_id);
        $tab_u = ModelUtilisateur::getAllUtilisateurs();
        require File::build_path(array("view","view.php"));
    }

    public static function update(){
        $controller = 'utilisateur';
        $view='update';
        $pagetitle='modification utilisateur';
        $log_u  = $_GET['user_id'];
        $tab_u = ModelUtilisateur::getUtilisateurById($log_u);
        require (File::build_path(array("view","view.php")));
    }

    public static function updated(){
    
        $controller = 'utilisateur';
        $view='updated';
        $pagetitle='modification utilisateur';
        
        $log_u = $_GET['user_id'];
        $user_firstname = $_GET['user_firstname'];
        $user_lastname = $_GET['user_lastname'];
        $user_mail = $_GET['user_mail'];
        $user_phone = $_GET['user_phone'];
        $user_postal_code = $_GET['user_postal_code'];
        $user_birthdate = $_GET['user_birthdate'];
        
        $tab_umod = array(
            "user_id" => $log_u,
            "user_firstname" => $user_firstname,
            "user_lastname" => $user_lastname,
            "user_mail" => $user_mail,
            "user_phone" => $user_phone,
            "user_postal_code" => $user_postal_code,
            "user_birthdate" => $user_birthdate
        );
        $utilisateurmod = new ModelUtilisateur();
        $utilisateurmod->update($tab_umod);
        $tab_u = ModelUtilisateur::getAllUtilisateurs();
        require (File::build_path(array("view","view.php")));
    }

    

    public static function created(){
        $controller = 'utilisateur';
        $view='created';
        $pagetitle='creation utilisateur';

        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_mail = $_POST['user_mail'];
        $user_phone = $_POST['user_phone'];
        $user_postal_code = $_POST['user_postal_code'];
        $user_birthdate = $_POST['user_birthdate'];


        $utilisateurmod = new ModelUtilisateur($user_firstname, $user_lastname, $user_mail, $user_phone, $user_postal_code, $user_birthdate);

        $utilisateurmod->saveUser();
        $tab_u = ModelUtilisateur::getAllUtilisateurs();
        require (File::build_path(array("view","view.php")));
    }
}
