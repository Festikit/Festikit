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
        $reussiteUser = false;

        // Initialisation des variables pour user
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_mail = $_POST['user_mail'];
        $user_phone = $_POST['user_phone'];
        $user_birthdate = $_POST['user_birthdate'];
        $user_postal_code = $_POST['user_postal_code'];
        $user_driving_license = $_POST['user_driving_license'];

        // Initialisation des variables pour postuler
        $venir_avec_vehicule = $_POST['vehicule'];
        $besoin_hebergement = $_POST['besoin_hebergement'];
        $peut_heberger = $_POST['peut_heberger'];
        $configuration_couchage = $_POST['configuration_couchage'];

        $arrivee_festival_date = $_POST['arrivee_festival_date'];
        $arrivee_festival_heure = $_POST['arrivee_festival_heure'];
        $arrivee_festival = date('Y-m-d H:i:s', strtotime("$arrivee_festival_date $arrivee_festival_heure"));
        
        $depart_festival_date = $_POST['depart_festival_date'];
        $depart_festival_heure = $_POST['depart_festival_heure'];
        $depart_festival = date('Y-m-d H:i:s', strtotime("$depart_festival_date $depart_festival_heure"));

        $autres_dispos_date = $_POST['autres_dispos_date'];
        $autres_dispos_heure = $_POST['autres_dispos_heure'];
        $autres_dispos = date('Y-m-d H:i:s', strtotime("$autres_dispos_date $autres_dispos_heure"));
        
        $experience = $_POST['experience'];

        $festival_id = $_POST['festival_id'];

        // Test d'upload de la photo
        if (!empty($_FILES['user_picture']) && is_uploaded_file($_FILES['user_picture']['tmp_name'])) {
            
            // Vérification de l'extension
            $listeExtensions = array('/png', '/jpg', '/jpeg');
            $extension = strrchr($_FILES['user_picture']['type'], '/');
            if(in_array($extension, $listeExtensions)) {

                // Vérification de la taille
                if ($_FILES['user_picture']['size'] < $_POST['MAX_FILE_SIZE']) {
                    $user_picture = addslashes(file_get_contents($_FILES['user_picture']['tmp_name']));
                    if($user_picture == false) {
                        $controller = 'utilisateur';
                        $view = 'error';
                        $message = 'Erreur: Initialisation de $user_picture';
                        $pagetitle = 'erreur';
                    }
                } else {
                    $controller = 'utilisateur';
                    $view = 'error';
                    $message = 'Erreur: L\'image est trop volumineuse' . "( > $taille_max)";
                    $pagetitle = 'erreur';                    
                }
            } else {
                $controller = 'utilisateur';
                $view = 'error';
                $message = 'Erreur: Le format de l\'image n\'est pas autorisé (!= png jpg ou jpeg)';
                $pagetitle = 'erreur';
            }
        } else {
            $controller = 'utilisateur';
            $view = 'error';
            $message = 'Erreur: Image non upload';
            $pagetitle = 'erreur';
        }
        
    
        if(isset($user_picture)) {
            // Test d'initialisation des variables pour user
            if(isset($user_firstname, $user_lastname, $user_mail, $user_phone, $user_postal_code, $user_birthdate, $user_driving_license)) {

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
                /*
                echo "<pre>";
                print_r($dataUser);
                echo "</pre>";
                */
                // Insertion dans user + test d'insertion
                if(is_bool(ModelUtilisateur::save($dataUser))) {
                    $controller = 'utilisateur';
                    $view = 'error';
                    $message = 'Erreur: Insertion des données dans la table user';
                    $pagetitle = 'erreur';

                } else {
                    $reussiteUser = true;
                }
            } else {
                $controller = 'utilisateur';
                $view = 'error';
                $message = 'Erreur: initialisation des variables nécessaire à la création d\'un utilisateur';
                $pagetitle = 'erreur';
            }
        }

        if($reussiteUser) {
            if(self::createdPostuler($user_mail, $festival_id, $venir_avec_vehicule, $besoin_hebergement, $peut_heberger, $configuration_couchage, $arrivee_festival, $depart_festival, $autres_dispos, $experience)) {
                // Reussite de toutes les insertions
                $controller = 'utilisateur';
                $view = 'created';
                $pagetitle = 'creation utilisateur';
            } else {

                /* TODO 
                Pour afficher les messages d'erreurs des fonctions createdPreference createdPostuler...
                Lorsqu'on veut lever l'erreur on renvoir false et on initialise la variable message
                Ensuite on appelle la vue erreur ici dans create
                */

                $controller = 'utilisateur';
                $view = 'erreur';
                $pagetitle = 'creation utilisateur';
            }

            /* Insertion pour preference */

            $user_id = ModelUtilisateur::getIdByMail($user_mail);
            $user_id = $user_id->getId();

            // Initialisation des variables pour préférence
            foreach (ModelFestival::getPostesByFestival($festival_id) as $post) {
                $poste_id = $post->getPosteId();
                $post = "Poste" . $poste_id;
                //echo $post . "<br>";
                //echo $_POST[$post] . "<br>";
                //${'Poste' . $poste_id} = $_POST[$post];
                //$rang = $_POST[$post];
                //echo "${'Poste' . $poste_id}";
                //echo $poste_id;
                self::createdPreference($user_id, $poste_id, $_POST[$post]);
            }


            /* Insertion pour disponible */
            $festivalGenerique = 6;
            foreach (ModelFestival::getCreneauxGeneriquesHeure($festivalGenerique) as $h) {
                $cStart = $h->getCreneauStart();
                $cEnd = $h->getCreneauEnd();
                foreach (ModelFestival::getCreneauxGeneriquesDate($festivalGenerique) as $d) {
                    $CreneauDate = $d->getCreneauStart();
                    $post = "dispo_heure$cStart" . "_$cEnd" . "date_$CreneauDate";

                    if(isset($_POST["$post"])) {
                        $heureStart = substr($post,11,8); // Je récupère 8 caractères à partir du 11ème (inclus)
                        $heureEnd = substr($post,20,8);
                        $date = substr($post,-10); // Je récupère les 10 derniers caractères

                        //$CreneauStart = date('Y-m-d H:i:s', strtotime("$date $heureStart"));
                        //$CreneauEnd = date('Y-m-d H:i:s', strtotime("$date $heureEnd"));
                        //$CreneauStart = new DateTime($date->format('Y-m-d') .' ' .$heureStart->format('H:i:s'));
                        //$CreneauEnd = new DateTime($date->format('Y-m-d') .' ' .$heureEnd->format('H:i:s'));
                        $CreneauStart = DateTime::createFromFormat('Y-m-d H:i:s', "$date" . " " . "$heureStart");
                        echo $CreneauStart->format('Y-m-d H:i:s');
                        $CreneauStart = ob_get_contents();
                        $CreneauEnd = DateTime::createFromFormat('Y-m-d H:i:s', "$date" . " " . "$heureStart");
                        echo $CreneauStart->format('Y-m-d H:i:s');
                        $CreneauEnd = ob_get_contents();
                        //echo "Disponible: " . $post . "<br>" . $CreneauStart ."   ". $CreneauEnd . "<br><br>";

                        //echo $merge->format('Y-m-d H:i:s'); // Outputs '2017-03-14 13:37:42'

                        $creneau_id = ModelFestival::getCreneauxIdByDateHeure($festivalGenerique, $CreneauStart, $CreneauEnd);
                        echo $creneau_id;
                    }
                }
            }   
        }

        $tab_u = ModelUtilisateur::selectAll();

        require (File::build_path(array("view","view.php")));
    }


    public static function createdPostuler($user_mail, $festival_id, $venir_avec_vehicule, $besoin_hebergement, $peut_heberger, $configuration_couchage, $arrivee_festival, $depart_festival, $autres_dispos, $experience) {
        
        // Initialisation des variables pour postuler
        $user_id = ModelUtilisateur::getIdByMail($user_mail);
        $user_id = $user_id->getId();
        $postuler_accepted = 0;

        //echo $festival_id;

        // Test d'initialisation des variables pour postuler
        if(isset($user_id, $festival_id, $postuler_accepted)) {
            
            // Création du tableau associatif pour l'insertion dans postuler
            $dataPostuler = array(
                'user_id' => $user_id, 
                'festival_id' => $festival_id, 
                'postuler_accepted' => $postuler_accepted,
                'venir_avec_vehicule' => $venir_avec_vehicule,
                'besoin_hebergement' => $besoin_hebergement,
                'peut_heberger' => $peut_heberger,
                'configuration_couchage' => $configuration_couchage,
                'arrivee_festival' => $arrivee_festival,
                'depart_festival' => $depart_festival,
                'autres_dispos' => $autres_dispos,
                'experience' => $experience,   
            );
            /*
            echo "<pre>";
            print_r($dataPostuler);
            echo "</pre>";
            */

            // Insertion dans postuler + test d'insertion
            if(is_bool(ModelPostuler::save($dataPostuler))) {
                $controller = 'utilisateur';
                $view = 'error';
                $message = 'Erreur: Insertion des données dans la table postuler';
                $pagetitle = 'erreur';
            } else {
                return true;
            }
        } else {
            $controller = 'utilisateur';
            $view = 'error';
            $message = 'Erreur: initialisation des variables nécessaire à la création d\'une instance de postuler';
            $pagetitle = 'erreur';
        }
    }

    public static function createdPreference($user_id, $poste_id, $rang) {
        $dataPreference = array(
            'user_id' => $user_id, 
            'poste_id' => $poste_id, 
            'rang' => $rang,
        );

        // Insertion dans preference + test d'insertion
        if(is_bool(ModelPreference::save($dataPreference))) {
            $controller = 'utilisateur';
            $view = 'error';
            $message = 'Erreur: Insertion des données dans la table preference';
            $pagetitle = 'erreur';
        } else {
            return true;
        }
    }
}
