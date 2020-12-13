<?php

require_once File::build_path(array("model", "ModelUtilisateur.php"));
require_once File::build_path(array('lib', 'Security.php'));
require_once File::build_path(array('lib', 'Session.php'));

class ControllerUtilisateur
{

    public static function create()
    {
        $pagetitle = 'Formulaire d\'enregistrement';
        $controller = 'utilisateur';
        $view = 'create';
        require File::build_path(array("view", "view.php"));
    }

    public static function readAll()
    {
        $tab_u = ModelUtilisateur::selectAll();

        $pagetitle = 'Liste des utilisateurs';
        $controller = 'utilisateur';
        $view = 'list';
        require File::build_path(array("view", "view.php"));
    }

    public static function read()
    {

        $user_id = $_GET['user_id'];
        $u = ModelUtilisateur::select($user_id);

        $tab_festivalWhereAccepted = ModelUtilisateur::getFestivalWhereAccepted($user_id);
        $tab_festivalWhereCandidat = ModelUtilisateur::getFestivalWhereCandidat($user_id);

        if ($u == false) {
            $pagetitle = 'Erreur action';
            $controller = 'utilisateur';
            $view = 'error';
            $message = "erreur de la fonction read dans le controller utilisateur";
        } else {
            $boolUser = 0;
            if (isset($_SESSION['login'])) {
                $session_id = $_SESSION['login'];
                if ($user_id == $session_id) {
                    $boolUser = Session::is_user($_SESSION['login']);
                }
            }
            if ($boolUser == 0) {
                $pagetitle = 'Détail de l\'utilisateur';
                $controller = 'utilisateur';
                $view = 'errorAccess';
                $message = 'Ce n\'est pas votre compte';
            } else {
                $pagetitle = 'Détail de l\'utilisateur';
                $controller = 'utilisateur';
                $view = 'detail';
            }
        }
        require File::build_path(array("view", "view.php"));
    }



    public static function delete()
    {
        $controller = 'utilisateur';
        $pagetitle = 'supprimons ceci';
        $view = 'deleted';
        $user_id = $_GET['user_id'];
        ModelUtilisateur::delete($user_id);
        $tab_u = ModelUtilisateur::selectAll();
        require File::build_path(array("view", "view.php"));
    }

    public static function update()
    {
        $log_u  = $_GET['user_id'];
        $tab_u = ModelUtilisateur::select($log_u);
        $boolUser = 0;
            if (isset($_SESSION['login'])) {
                $session_id = $_SESSION['login'];
                if ($log_u == $session_id) {
                    $boolUser = Session::is_user($_SESSION['login']);
                }
            }
            if ($boolUser == 0) {
                $pagetitle = 'Détail de l\'utilisateur';
                $controller = 'utilisateur';
                $view = 'errorAccess';
                $message = 'Ce n\'est pas votre compte';
            } else {
                $controller = 'utilisateur';
                $view = 'update';
                $pagetitle = 'modification utilisateur';
            }
        require(File::build_path(array("view", "view.php")));
    }

    public static function updated()
    {

        $controller = 'utilisateur';
        $view = 'updated';
        $pagetitle = 'modification utilisateur';

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
        $utilisateurmod->update($tab_umod); //gen
        $tab_u = ModelUtilisateur::selectAll();
        require(File::build_path(array("view", "view.php")));
    }


    public static function created()
    {
        $reussiteUser = false;

        // Initialisation des variables pour user
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_mail = $_POST['user_mail'];
        $user_phone = $_POST['user_phone'];
        $user_birthdate = $_POST['user_birthdate'];
        $user_postal_code = $_POST['user_postal_code'];
        $user_driving_license = $_POST['user_driving_license'];
        $user_password1 = $_POST['user_password1'];
        $user_password2 = $_POST['user_password2'];
        $admin = 0;

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
            if (in_array($extension, $listeExtensions)) {

                // Vérification de la taille
                if ($_FILES['user_picture']['size'] < $_POST['MAX_FILE_SIZE']) {
                    $user_picture = addslashes(file_get_contents($_FILES['user_picture']['tmp_name']));
                    if ($user_picture == false) {
                        $controller = 'utilisateur';
                        $view = 'error';
                        $message = 'Erreur: Initialisation de $user_picture';
                        $pagetitle = 'erreur';
                    }
                } else {
                    $controller = 'utilisateur';
                    $view = 'error';
                    $message = 'Erreur: L\'image est trop volumineuse' . "( > " . $_POST['MAX_FILE_SIZE'] . ")";
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


        // Insertion pour user
        if (isset($user_firstname, $user_lastname, $user_mail, $user_phone, $user_postal_code, $user_birthdate, $user_picture, $user_driving_license, $user_password1, $user_password2, $admin)) {
            $reussiteInitUser = true;
            if (self::createdUser($user_firstname, $user_lastname, $user_mail, $user_phone, $user_birthdate, $user_picture, $user_postal_code, $user_driving_license, $user_password1, $user_password2, $admin)) {
                $reussiteUser = true;
            } else {
                $message = "Erreur: createdUser";
                $reussiteUser = false;
            }
        } else {
            $message = 'Erreur: initialisation des variables nécessaire à la création d\'un utilisateur';
            $reussiteInitUser = false;
        }


        // L'utilisateur étant créé, on récupère son id à partir de son mail
        if ($reussiteUser) {
            $user_id = ModelUtilisateur::getIdByMail($user_mail);
            $user_id = $user_id->getId();
            if (!empty($user_id)) {
                $reussiteId = true;
            } else {
                $message = 'Erreur: Récupération de l\'id utilisateur';
                $reussiteId = false;
            }
        }


        // Insertion pour postuler
        if (isset($user_firstname, $user_lastname, $user_mail, $user_phone, $user_postal_code, $user_birthdate, $user_picture, $user_driving_license)) {
            $reussiteInitPostuler = true;
            if ($reussiteInitUser && $reussiteUser && $reussiteId && $reussiteInitPostuler) {
                if (self::createdPostuler($user_id, $festival_id, $venir_avec_vehicule, $besoin_hebergement, $peut_heberger, $configuration_couchage, $arrivee_festival, $depart_festival, $autres_dispos, $experience)) {
                    $reussitePostuler = true;
                } else {
                    $message = "Erreur: createdPostuler";
                    $reussitePostuler = false;
                }
            }
        } else {
            $message = 'Erreur: initialisation des variables nécessaire à la création d\'une instance de postuler';
            $reussiteInitPostuler = false;
        }

        // Insertion pour préférence
        if ($reussiteInitUser && $reussiteUser && $reussiteId && $reussiteInitPostuler && $reussitePostuler) {
            $reussitePreference = true;
            foreach (ModelFestival::getPostesByFestival($festival_id) as $post) {
                $poste_id = $post->getPosteId();
                $post = "Poste" . $poste_id;
                if (self::createdPreference($user_id, $poste_id, $_POST[$post])) {
                    $reussitePreference = true;
                } else {
                    $reussitePreference = false;
                    $message = "Erreur: createdPreference";
                    break;
                }
            }
        }

        // Insertion pour disponible 
        if ($reussiteInitUser && $reussiteUser && $reussiteId && $reussiteInitPostuler && $reussitePostuler && $reussitePreference) {
            $festivalGenerique = 6;
            foreach (ModelFestival::getCreneauxGeneriquesHeure($festivalGenerique) as $h) {
                $cStart = $h->getCreneauStart();
                $cEnd = $h->getCreneauEnd();
                foreach (ModelFestival::getCreneauxGeneriquesDate($festivalGenerique) as $d) {
                    $CreneauDate = $d->getCreneauStart();
                    $post = "dispo_heure$cStart" . "_$cEnd" . "date_$CreneauDate";

                    if (isset($_POST["$post"])) {
                        $heureStart = substr($post, 11, 8); // Je récupère 8 caractères à partir du 11ème (inclus)
                        $heureEnd = substr($post, 20, 8);
                        $date = substr($post, -10); // Je récupère les 10 derniers caractères

                        //$CreneauStart = date('Y-m-d H:i:s', strtotime("$date $heureStart"));
                        //$CreneauEnd = date('Y-m-d H:i:s', strtotime("$date $heureEnd"));
                        //$CreneauStart = new DateTime($date->format('Y-m-d') .' ' .$heureStart->format('H:i:s'));
                        //$CreneauEnd = new DateTime($date->format('Y-m-d') .' ' .$heureEnd->format('H:i:s'));
                        //$CreneauStart = DateTime::createFromFormat('Y-m-d H:i:s', "$date" . " " . "$heureStart");
                        //echo $CreneauStart->format('Y-m-d H:i:s') . "<br>";
                        //$CreneauEnd = DateTime::createFromFormat('Y-m-d H:i:s', "$date" . " " . "$heureEnd");
                        //echo $CreneauEnd->format('Y-m-d H:i:s') . "<br>";
                        $CreneauStart = $date . " " . $heureStart;
                        $CreneauEnd = $date . " " . $heureEnd;
                        //echo "Disponible: " . $post . "<br>" . $CreneauStart ."   ". $CreneauEnd . "<br>";

                        //echo $merge->format('Y-m-d H:i:s'); // Outputs '2017-03-14 13:37:42'

                        $creneau_id = ModelFestival::getCreneauxIdByDateHeure($festivalGenerique, $CreneauStart/*->format('Y-m-d H:i:s')*/, $CreneauEnd/*->format('Y-m-d H:i:s')*/);
                        $creneau_id = $creneau_id->getCreneauId();
                        if (isset($creneau_id)) {
                            //echo $creneau_id . "<br><br>";
                            $dataDisponible = array(
                                'user_id' => $user_id,
                                'creneau_id' => $creneau_id,
                            );

                            // Insertion dans disponible + test d'insertion
                            if (is_bool(ModelDisponible::save($dataDisponible))) {
                                $message = 'Erreur: Insertion des données dans la table disponible';
                            }
                        }
                    }
                }
            }
        }
        $tab_u = ModelUtilisateur::selectAll();

        // Vérification d'une éventuelle erreur
        if (isset($message)) {
            $controller = 'utilisateur';
            $view = 'error';
            $pagetitle = 'erreur';
        } else {
            $festival = ModelFestival::select($_GET['festival_id']);
            $controller = 'utilisateur';
            $view = 'created';
            $pagetitle = 'creation utilisateur';
        }
        require(File::build_path(array("view", "view.php")));
    }


    public static function createdUser($user_firstname, $user_lastname, $user_mail, $user_phone, $user_birthdate, $user_picture, $user_postal_code, $user_driving_license, $user_password1, $user_password2)
    {

        // Gestion du mot de passe
        if (strcmp($user_password1, $user_password2) == 0) {
            $mot_passe_en_clair = $user_password1;
            $mot_passe_hache = Security::hacher($mot_passe_en_clair);
        } else {
            return false;
        }

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
            'user_password' => $mot_passe_hache,
        );
        // Insertion dans user + test d'insertion
        if (is_bool(ModelUtilisateur::save($dataUser))) {
            return false;
        } else {
            return true;
        }
    }

    public static function createdPostuler($user_id, $festival_id, $venir_avec_vehicule, $besoin_hebergement, $peut_heberger, $configuration_couchage, $arrivee_festival, $depart_festival, $autres_dispos, $experience)
    {

        // Création du tableau associatif pour l'insertion dans postuler
        $dataPostuler = array(
            'user_id' => $user_id,
            'festival_id' => $festival_id,
            'postuler_accepted' => 0,
            'venir_avec_vehicule' => $venir_avec_vehicule,
            'besoin_hebergement' => $besoin_hebergement,
            'peut_heberger' => $peut_heberger,
            'configuration_couchage' => $configuration_couchage,
            'arrivee_festival' => $arrivee_festival,
            'depart_festival' => $depart_festival,
            'autres_dispos' => $autres_dispos,
            'experience' => $experience,
        );

        // Insertion dans postuler + test d'insertion
        if (is_bool(ModelPostuler::save($dataPostuler))) {
            return false;
        } else {
            return true;
        }
    }

    public static function createdPreference($user_id, $poste_id, $rang)
    {

        // Création du tableau associatif pour l'insertion dans preference
        $dataPreference = array(
            'user_id' => $user_id,
            'poste_id' => $poste_id,
            'rang' => $rang,
        );

        // Insertion dans preference + test d'insertion
        if (is_bool(ModelPreference::save($dataPreference))) {
            $message = 'Erreur: Insertion des données dans la table preference';
            return false;
        } else {
            return true;
        }
    }

    public static function connect()
    {
        $controller = "utilisateur";
        $view = "connect";
        $pagetitle = "Connexion";
        require File::build_path(array("view", "view.php"));
    }

    public static function connected()
    {

        if (isset($_POST['user_mail']) && isset($_POST['user_password'])) {
            $mot_de_passe_chiffre = Security::hacher($_POST['user_password']);
            if (ModelUtilisateur::checkPassword($_POST['user_mail'], $mot_de_passe_chiffre)) {
                $u = ModelUtilisateur::getUserByMail($_POST['user_mail']);
                $user_id = $u->getId();
                $_SESSION['login'] = $user_id;

                if(ModelResponsable::boolResponsableByUserId($_SESSION['login'])) { // return true or false
                    $_SESSION['responsable'] = true;
                } else {
                    $_SESSION['responsable'] = false;
                }

                if(ModelUtilisateur::boolAdminByUserId($_SESSION['login'])->getAdmin()) { // return 1 or 0
                    $_SESSION['admin'] = true;
                } else {
                    $_SESSION['admin'] = false;
                }

                $view = 'detail';
                $controller = 'utilisateur';
                $pagetitle = 'Profil';
            } else {
                $mail = $_POST['user_mail'];
                $controller = 'utilisateur';
                $message = "Les identifiants ne correspondent pas";
                $view = "errorLogIn";
                $pagetitle = "Erreur";
            }
        } else {
            $controller = 'utilisateur';
            $message = "Erreur Champs non remplies";
            $view = "error";
            $pagetitle = "Erreur";
        }
        require File::build_path(array("view", "view.php"));
    }

    public static function deconnect()
    {
        session_unset();
        session_destroy();
        /* Redirection page d'accueil */
        self::readAll();
    }
}
