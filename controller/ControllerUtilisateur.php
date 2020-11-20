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
        $tab_u = ModelUtilisateur::selectAll();

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
            $message = "erreur de la fonction read dans le controller utilisateur";
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
        $tab_u = ModelUtilisateur::selectAll();
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
        $tab_u = ModelUtilisateur::selectAll();
        require (File::build_path(array("view","view.php")));
    }


    public static function created(){
        
        // Initialisation des variables pour user
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_mail = $_POST['user_mail'];
        $user_phone = $_POST['user_phone'];
        $user_birthdate = $_POST['user_birthdate'];
        $user_postal_code = $_POST['user_postal_code'];
        $user_driving_license = $_POST['user_driving_license'];

        // Test d'upload de la photo
        if (!empty($_FILES['user_picture']) && is_uploaded_file($_FILES['user_picture']['tmp_name'])) {
            
            $img_taille = $_FILES['user_picture']['size'];
            $taille_max = $_POST['MAX_FILE_SIZE'];

            if ($img_taille > $taille_max) {
                $controller = 'utilisateur';
                $view = 'error';
                $message = 'Erreur: L\'image est trop volumineuse' . "( > $taille_max)";
                $pagetitle = 'erreur';

            } else {
                $user_picture = addslashes(file_get_contents($_FILES['user_picture']['tmp_name']));
                if($user_picture == false) {
                    $controller = 'utilisateur';
                    $view = 'error';
                    $message = 'Erreur: Initialisation de $user_picture';
                    $pagetitle = 'erreur';
                }
            }
        } else {
            $controller = 'utilisateur';
            $view = 'error';
            $message = 'Erreur: Image non upload';
            $pagetitle = 'erreur';
        }

        // Test d'initialisation des variables pour user
        if(isset($user_firstname, $user_lastname, $user_mail, $user_phone, $user_postal_code, $user_birthdate, $user_picture, $user_driving_license)) {

            // Création du tableau associatif pour l'insertion dans user
            $dataUser = array(
                'user_firstname' => $user_firstname, 
                'user_lastname' => $user_lastname, 
                'user_mail' => $user_mail,  
                'user_phone' => $user_phone, 
                'user_birthdate' => $user_birthdate, 
                'user_picture' => $user_picture, 
                'user_postal_code' => $user_postal_code,
                'user_driving_license' => $user_driving_license, 
            );

            // Insertion dans user + test d'insertion
            if(is_bool(ModelUtilisateur::save($dataUser))) {
                $controller = 'utilisateur';
                $view = 'error';
                $message = 'Erreur: Insertion des données dans la table user';
                $pagetitle = 'erreur';

            } else {

                // Initialisation des variables pour postuler
                $user_id = ModelUtilisateur::getIdByMail($user_mail);
                $festival_id = $_GET['festival_id'];
                $postuler_accepted = 0;

                // Test d'initialisation des variables pour postuler
                if(isset($user_id, $festival_id, $postuler_accepted)) {
                    
                    // Création du tableau associatif pour l'insertion dans postuler
                    $dataPostuler = array(
                        'user_id' => $user_id, 
                        'festival_id' => $festival_id, 
                        'postuler_accepted' => $postuler_accepted,   
                    );

                    // Insertion dans postuler + test d'insertion
                    if(is_bool(ModelPostuler::save($dataPostuler))) {
                        $controller = 'utilisateur';
                        $view = 'error';
                        $message = 'Erreur: Insertion des données dans la table postuler';
                        $pagetitle = 'erreur';
                    } else {
                        // Reussite de toutes les insertions
                        $controller = 'utilisateur';
                        $view = 'created';
                        $pagetitle = 'creation utilisateur';
                    }
                } else {
                    $controller = 'utilisateur';
                    $view = 'error';
                    $message = 'Erreur: initialisation des variables nécessaire à la création d\'une instance de postuler';
                    $pagetitle = 'erreur';
                }
            }
        } else {
            $controller = 'utilisateur';
            $view = 'error';
            $message = 'Erreur: initialisation des variables nécessaire à la création d\'un utilisateur';
            $pagetitle = 'erreur';
        }
        
        $tab_u = ModelUtilisateur::selectAll();

        require (File::build_path(array("view","view.php")));
    }
}
