<?php

require_once File::build_path(array("model", "ModelUtilisateur.php"));
class ControllerUtilisateur
{

    public static function create()
    {
        if (isset($_SESSION['login'])) {
            $boolUser = 1;
        } else {
            $boolUser = 0;
        }

        $festival_id = $_GET['festival_id'];
        $f = ModelFestival::select($festival_id);

        $pagetitle = 'Formulaire d\'enregistrement';
        $controller = 'utilisateur';
        $view = 'create';
        require File::build_path(array("view", "view.php"));
    }

    public static function readAll()
    {
        if (Session::is_admin()) {
            $tab_u = ModelUtilisateur::selectAll();

            $pagetitle = 'Liste des utilisateurs';
            $controller = 'utilisateur';
            $view = 'list';
        } else {
            $pagetitle = 'Erreur';
            $controller = 'utilisateur';
            $message = "Vous n'avez pas l'autorisation !";
            $view = 'messageRetour';
        }
        require File::build_path(array("view", "view.php"));
    }

    public static function read()
    {
        $user_id = $_GET['user_id'];
        if(Session::is_responsable()) {
            $responsable_id = ModelResponsable::getResponsableByUser($_SESSION['login'])->getResponsableId();
        }

        if (Session::is_user($user_id) || Session::is_admin() || (Session::is_responsable() && ModelFestival::checkResponsableWhereUserInFestival($responsable_id, $user_id))) {
            $u = ModelUtilisateur::select($user_id);

            $tab_festivalWhereAccepted = ModelUtilisateur::getFestivalWhereAccepted($user_id);
            $tab_festivalWhereCandidat = ModelUtilisateur::getFestivalWhereCandidat($user_id);

            $boolBenevole = 0;
            $boolAdmin = 0;
            $boolResponsable = 0;
            if (Session::is_responsable() && Session::is_user($user_id)) {
                $tab_festivalWhereResponsable = ModelFestival::getFestivalByResponsable($user_id);
                $boolResponsable = 1;
            } else if (Session::is_admin() && Session::is_user($user_id)) {
                $tab_festivalWhereCreateur = ModelFestival::getFestivalByCreateur($user_id);
                $boolAdmin = 1;
            } else {
                $boolBenevole = 1;
            }

            if ($u == false) {
                $pagetitle = 'Erreur action';
                $controller = 'utilisateur';
                $view = 'messageRetour';
                $message = "erreur de la fonction read dans le controller utilisateur";
            } else {
                $pagetitle = 'Détail de l\'utilisateur';
                $controller = 'utilisateur';
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

    public static function readForCreator()
    {
        $user_id = $_GET['user_id'];
        $festival_id = $_GET['festival_id'];        
        if(Session::is_responsable()) {
            $responsable_id = ModelResponsable::getResponsableByUser($_SESSION['login'])->getResponsableId();
        }

        if (Session::is_user($user_id) || Session::is_admin() || (Session::is_responsable() && ModelFestival::checkResponsableWhereUserInFestival($responsable_id, $user_id))) {
            $u = ModelUtilisateur::select($user_id);

            $tab_festivalWhereAccepted = ModelUtilisateur::getFestivalWhereAccepted($user_id);
            $tab_festivalWhereCandidat = ModelUtilisateur::getFestivalWhereCandidat($user_id);
            $tab_postuler = ModelPostuler::getIdByUserAndFestival($user_id, $festival_id);
            

            $boolBenevole = 0;
            $boolAdmin = 0;
            $boolResponsable = 0;
            if (Session::is_responsable() && Session::is_user($user_id)) {
                $tab_festivalWhereResponsable = ModelFestival::getFestivalByResponsable($user_id);
                $boolResponsable = 1;
            } else if (Session::is_admin() && Session::is_user($user_id)) {
                $tab_festivalWhereCreateur = ModelFestival::getFestivalByCreateur($user_id);
                $boolAdmin = 1;
            } else {
                $boolBenevole = 1;
            }

            if ($u == false) {
                $pagetitle = 'Erreur action';
                $controller = 'utilisateur';
                $view = 'messageRetour';
                $message = "erreur de la fonction read dans le controller utilisateur";
            } else {
                $pagetitle = 'Détail de l\'utilisateur';
                $controller = 'utilisateur';
                $view = 'detailForCreator';
            }
        } else {
            $pagetitle = 'Erreur';
            $controller = 'utilisateur';
            $message = "Vous n'avez pas l'autorisation !";
            $view = 'messageRetour';
        }

        require File::build_path(array("view", "view.php"));
    }

    public static function delete()
    {
        $user_id = $_GET['user_id'];
        if (Session::is_user($user_id) || Session::is_admin()) {
            $user_lastname = htmlspecialchars(ModelUtilisateur::select($user_id)->getLastname());
            $user_firstname = htmlspecialchars(ModelUtilisateur::select($user_id)->getFirstname());

            ModelUtilisateur::delete($user_id);

            if (Session::is_admin()) {
                $tab_u = ModelUtilisateur::selectAll();

                $pagetitle = 'Compte supprimé';
                $controller = 'utilisateur';
                $view = 'messageSuite';
                $path = "action=readAll";
                $message = "L'utilisateur $user_lastname $user_firstname a été supprimé avec succès.";
            } else {
                $pagetitle = 'Compte supprimé';
                $controller = 'utilisateur';
                $view = 'messageSuite';
                $path = "action=connect";
                $message = "Vous avez supprimé votre compte avec succès";
            }
        } else {
            $pagetitle = 'Erreur';
            $controller = 'utilisateur';
            $message = "Vous n'avez pas l'autorisation !";
            $view = 'messageRetour';
        }
        require File::build_path(array("view", "view.php"));
    }

    public static function update()
    {
        $user_id  = $_GET['user_id'];
        if (Session::is_user($user_id) || Session::is_admin()) {
            $tab_u = ModelUtilisateur::select($user_id);
            $controller = 'utilisateur';
            $view = 'update';
            $pagetitle = 'modification utilisateur';
        } else {
            $pagetitle = 'Erreur';
            $controller = 'utilisateur';
            $message = "Vous n'avez pas l'autorisation !";
            $view = 'messageRetour';
        }
        require(File::build_path(array("view", "view.php")));
    }

    public static function updated()
    {
        $user_id = $_GET['user_id'];
        if (Session::is_user($user_id) || Session::is_admin()) {

            $user_id = $_GET['user_id'];
            $user_firstname = $_GET['user_firstname'];
            $user_lastname = $_GET['user_lastname'];
            $user_mail = $_GET['user_mail'];
            $user_phone = $_GET['user_phone'];
            $user_postal_code = $_GET['user_postal_code'];
            $user_birthdate = $_GET['user_birthdate'];

            $tab_umod = array(
                "user_id" => $user_id,
                "user_firstname" => $user_firstname,
                "user_lastname" => $user_lastname,
                "user_mail" => $user_mail,
                "user_phone" => $user_phone,
                "user_postal_code" => $user_postal_code,
                "user_birthdate" => $user_birthdate
            );
            $utilisateurmod = new ModelUtilisateur();
            $utilisateurmod->update($tab_umod);

            $user_lastname = htmlspecialchars(ModelUtilisateur::select($user_id)->getLastname());
            $user_firstname = htmlspecialchars(ModelUtilisateur::select($user_id)->getFirstname());

            $controller = 'utilisateur';
            $view = 'messageSuite';
            $path = "action=read&user_id=$user_id";
            $message = "L'utilisateur $user_lastname $user_firstname a été modifié avec succès.";
            $pagetitle = 'modification utilisateur';
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
        $reussiteUser = false;

        if (!isset($_SESSION['login'])) {
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
        }

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


        // On vérifie que l'utilisateur est connecté
        // Si c'est le cas on ne veut pas faire d'insertions dans la table user
        if (!isset($_SESSION['login'])) {

            // Test d'upload de la photo
            $reussitePicture = false;
            if (!empty($_FILES['user_picture']) && is_uploaded_file($_FILES['user_picture']['tmp_name'])) {

                // Vérification de l'extension
                $listeExtensions = array('/png', '/jpg', '/jpeg');
                $extension = strrchr($_FILES['user_picture']['type'], '/');
                if (in_array($extension, $listeExtensions)) {

                    // Vérification de la taille
                    if ($_FILES['user_picture']['size'] < $_POST['MAX_FILE_SIZE']) {
                        $user_picture = addslashes(file_get_contents($_FILES['user_picture']['tmp_name']));
                        if ($user_picture == false) {
                            $message = 'Erreur: Initialisation de $user_picture';
                        } else {
                            $reussitePicture = true;
                        }
                    } else {
                        $message = 'Erreur: L\'image est trop volumineuse' . "( > " . $_POST['MAX_FILE_SIZE'] . ")";
                    }
                } else {
                    $message = 'Erreur: Le format de l\'image n\'est pas autorisé (!= png jpg ou jpeg)';
                }
            } else {
                $message = 'Erreur: Image non upload';
            }

            

            
            // Insertion pour user
            if ($reussitePicture) {
                //Verification mail
                $reussite_mail = false;
                if (!ModelUtilisateur::mailExiste($user_mail))
                {
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
                    $reussite_mail = true;
                }
                else{
                    $reussite_mail = false;
                    $reussiteInitUser = false;
                    $controller = 'utilisateur';
                    $view = 'messageRetour';
                    $message = 'Un compte existe déjà avec ce mail';
                    $pagetitle = 'erreur';
                }
                
            }


            // L'utilisateur étant créé, on récupère son id à partir de son mail
            if ($reussitePicture && $reussiteInitUser && $reussiteUser && $reussite_mail) {
                $user_id = ModelUtilisateur::getIdByMail($user_mail);
                $user_id = $user_id->getId();
                if (!empty($user_id)) {
                    $reussiteId = true;
                } else {
                    $message = 'Erreur: Récupération de l\'id utilisateur';
                    $reussiteId = false;
                }
            }
        } else {
            // On est ici si l'utilisateur à déjà un compte 
            $user_id = $_SESSION['login'];
        }

        // Insertion pour postuler
        $reussiteInitPostuler = true;
        if ($reussitePicture && $reussiteInitUser && $reussiteUser && $reussiteId && $reussiteInitPostuler) {
            if (isset($user_id, $festival_id, $venir_avec_vehicule, $besoin_hebergement, $peut_heberger, $configuration_couchage, $arrivee_festival, $depart_festival, $autres_dispos, $experience)) {
                if (self::createdPostuler($user_id, $festival_id, $venir_avec_vehicule, $besoin_hebergement, $peut_heberger, $configuration_couchage, $arrivee_festival, $depart_festival, $autres_dispos, $experience)) {
                    $reussitePostuler = true;
                } else {
                    $message = "Erreur: createdPostuler";
                    $reussitePostuler = false;
                }
            } else {
                $message = 'Erreur: initialisation des variables nécessaire à la création d\'une instance de postuler';
                $reussiteInitPostuler = false;
            }
        }

        // Insertion pour préférence
        if ($reussitePicture && $reussiteInitUser && $reussiteUser && $reussiteId && $reussiteInitPostuler && $reussitePostuler) {
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
        if ($reussitePicture && $reussiteInitUser && $reussiteUser && $reussiteId && $reussiteInitPostuler && $reussitePostuler && $reussitePreference) {
            foreach (ModelFestival::getCreneauxGeneriquesHeure($festival_id) as $h) {
                $cStart = $h->getCreneauStart();
                $cEnd = $h->getCreneauEnd();
                foreach (ModelFestival::getCreneauxGeneriquesDate($festival_id) as $d) {
                    $CreneauDate = $d->getCreneauStart();
                    $post = "dispo_heure$cStart" . "_$cEnd" . "date_$CreneauDate";

                    if (isset($_POST["$post"])) {
                        $heureStart = substr($post, 11, 8); // Je récupère 8 caractères à partir du 11ème (inclus)
                        $heureEnd = substr($post, 20, 8);
                        $date = substr($post, -10); // Je récupère les 10 derniers caractères

                        $CreneauStart = $date . " " . $heureStart;
                        $CreneauEnd = $date . " " . $heureEnd;
                        $creneau_id = ModelFestival::getCreneauxIdByDateHeure($festival_id, $CreneauStart, $CreneauEnd);
                        $creneau_id = $creneau_id->getCreneauId();
                        if (isset($creneau_id)) {
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
            $view = 'messageRetour';
            $pagetitle = 'erreur';
        } else {
            $festival = ModelFestival::select($_POST['festival_id']);
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
            // en attente le temps de corriger le problème
            // ModelUtilisateur::envoyerEmailVerfification($user_mail);
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

    public static function valideMail()
    {
        if (isset($_GET['user_mail']) && isset($_GET['codeValidation'])) {
            $user = ModelUtilisateur::getUserByMail($_GET['user_mail']);
            if ($user->valideMail($_GET['codeValidation'])) {
                $controller = "utilisateur";
                $view = "valideMail";
                $pagetitle = "validation mail";
            } else {
                $controller = "utilisateur";
                $view = "messageRetour";
                $message = "Erreur lors de la verification de l'email";
            }
        }

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

                if (ModelResponsable::boolResponsableByUserId($_SESSION['login'])) { // return true or false
                    $_SESSION['responsable'] = true;
                } else {
                    $_SESSION['responsable'] = false;
                }

                if (ModelUtilisateur::boolAdminByUserId($_SESSION['login'])->getAdmin()) { // return 1 or 0
                    $_SESSION['admin'] = true;
                    $boolAdmin = 1; // pour vue détail
                } else {
                    $_SESSION['admin'] = false;
                    $boolAdmin = 0;
                }

                $tab_festivalWhereAccepted = ModelUtilisateur::getFestivalWhereAccepted($user_id);
                $tab_festivalWhereCandidat = ModelUtilisateur::getFestivalWhereCandidat($user_id);

                $boolBenevole = 0;
                $boolAdmin = 0;
                $boolResponsable = 0;
                if (Session::is_responsable()) {
                    $tab_festivalWhereResponsable = ModelFestival::getFestivalByResponsable($user_id);
                    $boolResponsable = 1;
                } else if (Session::is_admin()) {
                    $tab_festivalWhereCreateur = ModelFestival::getFestivalByCreateur($user_id);
                    $boolAdmin = 1;
                } else {
                    $boolBenevole = 1;
                }

                $pagetitle = 'Détail de l\'utilisateur';
                $controller = 'utilisateur';
                $view = 'detail';
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
            $view = "messageRetour";
            $pagetitle = "Erreur";
        }
        require File::build_path(array("view", "view.php"));
    }

    public static function deconnect()
    {
        session_unset();
        session_destroy();

        $controller = 'utilisateur';
        $message = "Vous êtes déconnecté !";
        $view = "deconnected";
        $pagetitle = "Déconnnexion";

        require File::build_path(array("view", "view.php"));
    }
}
