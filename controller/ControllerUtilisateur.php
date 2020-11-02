<?php

require_once File::build_path(array("model","ModelUtilisateur.php"));

class ControllerUtilisateur {

    public static function readAll() {
        $tab_u = ModelUtilisateur::getAllUtilisateurs();

        $pagetitle = 'Liste des utilisateurs';
        $controller = 'utilisateur';
        $view = 'list';
        require File::build_path(array("view","view.php"));
    }

    public static function read() {

        $pagetitle = 'Détail de l\'utilisateur';
        $controller = 'utilisateur';
        $view = 'detail';
        
        $user_id = $_GET['user_id'];
        $u = ModelUtilisateur::getUtilisateurById($user_id);
        if($u == false) {
            require File::build_path(array("view","utilisateur","error.php"));
        } else {
            require File::build_path(array("view","view.php"));
        }
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
        $controller = 'Utilisateur';
        $view='update';
        $pagetitle='modification utilisateur';
        $log_u  = $_GET['user_id'];
        $tab_u = ModelUtilisateur::getUtilisateurById($log_u);
        require (File::build_path(array("view","view.php")));
    }

    public static function updated(){
    
        $controller = 'Utilisateur';
        $view='updated';
        $pagetitle='modification utilisateur';
        $log_u = $_GET['user_id'];
        $user_firstname = $_GET['user_firstname'];
        $user_lastname = $_GET['user_lastname'];
        $user_mail = $_GET['user_mail'];
        $user_phone = $_GET['user_phone'];
        $user_birthdate = $_GET['user_birthdate'];
        $tab_umod = array(
            "user_id" => $log_u,
            "user_firstname" => $user_firstname,
            "user_lastname" => $user_lastname,
            "user_mail" => $user_mail,
            "user_phone" => $user_phone,
            "user_birthdate" => $user_birthdate
        );
        $utilisateurmod = new ModelUtilisateur();
        $utilisateurmod->update($tab_umod);
        $tab_u = ModelUtilisateur::getAllUtilisateurs();
        require (File::build_path(array("view","view.php")));
        
    }
}

?>
