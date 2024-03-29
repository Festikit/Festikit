<?php

require_once File::build_path(array("model", "ModelFestival.php"));

class ControllerFestival
{

    public static function readAll()
    {
        if (Session::is_admin()) {
            $tab_f = ModelFestival::selectAll();
            $tab_r = ModelFestival::getFestivalByResponsable($_SESSION['login']);
            $boolResponsable = 0;
        }
        if (Session::is_responsable()) {
            $tab_r = ModelFestival::getFestivalByResponsable($_SESSION['login']);
            $tab_f = ModelFestival::selectAll();
            $boolResponsable = 1;
        }
        if (Session::is_admin() || Session::is_responsable()) {
            $user_id = $_SESSION['login'];
            $pagetitle = 'Liste des festivals';
            $controller = 'festival';
            $view = 'list';
        } 
        if (!empty($_SESSION['login']) && !Session::is_admin() && !Session::is_responsable()) // utilisateur est un bénévole
        {
            $user_id = $_SESSION['login'];
            $tab_f = ModelFestival::selectAll();
            $pagetitle = 'Liste des festivals';
            $controller = 'festival';
            $view = 'listUser';
        }
        if (empty($_SESSION['login'])) {
            $tab_f = ModelFestival::selectAll();
            $pagetitle = 'Liste des festivals';
            $controller = 'festival';
            $view = 'listVisiteur';
        }
        require File::build_path(array("view", "view.php"));
    }

    public static function readForUser()
    {
            $festival_id = $_GET['festival_id'];
            $f = ModelFestival::select($festival_id);

            if ($f == false) {
                $pagetitle = 'Erreur action read';
                $controller = 'utilisateur';
                $view = 'messageRetour';
                $message = 'erreur de la fonction read dans le controller festival';
            } else {
                $pagetitle = 'Détail du festival';
                $controller = 'festival';
                $view = 'detailForUser';
            }
        require File::build_path(array("view", "view.php"));
    }
    
    public static function read()
    {   
        $festival_id = $_GET['festival_id'];
        // Si l'utilisateur est un admin ou un responsable de ce festival
        if (Session::is_admin() || (Session::is_responsable() && (ModelFestival::getResponsableByFestivalAndUser($festival_id, $_SESSION['login']) ))) {
            $f = ModelFestival::select($festival_id);

            $tab_benevoleAccepted = ModelFestival::getBenevolesAcceptedByFestival($festival_id);
            $tab_candidature = ModelFestival::getCandidatsByFestival($festival_id);
            $tab_poste = ModelFestival::getPostesByFestival($festival_id);
            $tab_date = ModelFestival::getJoursByFestival($festival_id);
            $tab_creneau_gen = ModelCreneau::getCreneauxGen($festival_id);
            $createur = ModelFestival::getNomCreateur($festival_id);

            if(Session::is_responsable()) {
                $boolResponsable = 1;
            } else {
                $tab_responsable = ModelResponsable::getResponsableByFestival($festival_id);
                $boolResponsable = 0;
            }

            if ($f == false) {
                $pagetitle = 'Erreur action read';
                $controller = 'utilisateur';
                $view = 'messageRetour';
                $message = 'erreur de la fonction read dans le controller festival';
            } else {
                $pagetitle = 'Détail du festival';
                $controller = 'festival';
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


    public static function create()
    {
        if (Session::is_admin()) {
            $nameHTML = "";
            $startdateHTML = "";
            $enddateHTML = "";
            $descriptionHTML = "";
            $cityHTML = "";
            if (!isset($_SESSION['login'])) {
                $pagetitle = 'Création festival';
                $controller = 'utilisateur';
                $view = 'messageRetour';
                $message = 'Vous ne pouvez pas créer de festival sans être connecté';
            } else {
                $pagetitle = 'Formulaire d\'enregistrement';
                $controller = 'festival';
                $view = 'update';
                $next_action = "created";
                $primary_property = "required";
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
        if (Session::is_admin()) {
            $controller = 'festival';
            $view = 'update';
            $pagetitle = 'modification festival';

            $festival_id = rawurldecode($_GET['festival_id']);

            if (isset($_GET['festival_name'], $_GET['festival_startdate'], $_GET['festival_enddate'], $_GET['festival_description'], $_GET['city'])) {
                $nameHTML = htmlspecialchars($_GET['festival_name']);
                $startdateHTML = htmlspecialchars($_GET['festival_startdate']);
                $enddateHTML = htmlspecialchars($_GET['festival_enddate']);
                $descriptionHTML = htmlspecialchars($_GET['festival_description']);
                $cityHTML = htmlspecialchars($_GET['city']);


                $next_action = "updated";
                $primary_property = "readonly";
            } else {
                $pagetitle = 'Erreur action';
                $controller = 'utilisateur';
                $view = 'messageRetour';
                $message = "Erreur: Le controller n'a pas pu récupérer les éléments du formulaire update";
            }
        } else {
            $pagetitle = 'Erreur';
            $controller = 'utilisateur';
            $message = "Vous n'avez pas l'autorisation !";
            $view = 'messageRetour';
        }

        require File::build_path(array("view", "view.php"));
    }

    public static function updated()
    {
        if (Session::is_admin()) {
            if (isset($_POST['festival_name'], $_POST['festival_startdate'], $_POST['festival_enddate'], $_POST['festival_description'], $_POST['city'], $_GET['festival_id'])) {
                $data = array(
                    'festival_id' => $_GET['festival_id'],
                    'festival_name' => $_POST['festival_name'],
                    'festival_startdate' => $_POST['festival_startdate'],
                    'festival_enddate' => $_POST['festival_enddate'],
                    'festival_description' => $_POST['festival_description'],
                    'city' => $_POST['city'],
                );

                ModelFestival::update($data);
                $festival_name = $_POST['festival_name'];
                $festival_id = $_GET['festival_id'];

                $message = "Festival $festival_name mis à jour !";
                $path = "action=read&controller=festival&festival_id=$festival_id";
                $controller = 'utilisateur';
                $view = 'messageSuite';
                $pagetitle = 'modification festival';
            }

            $tab_f = ModelFestival::selectAll();
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
            // Initialisation des variables pour festival 
            $festival_name = $_POST['festival_name'];
            $festival_startdate = $_POST['festival_startdate'];
            $festival_enddate = $_POST['festival_enddate'];
            $festival_description = $_POST['festival_description'];
            $user_id = $_POST['user_id'];
            $city = $_POST['city'];

            // Initialisation des variables pour poste
            $poste_name = $_POST['poste_name'];
            $poste_description = $_POST['poste_description'];

            // Insertion pour festival
            $reussite_festival = false;
            if (isset($festival_name, $festival_startdate, $festival_enddate, $festival_description, $user_id, $city)) {
                $dataUser = array(
                    'festival_name' => $festival_name,
                    'festival_startdate' => $festival_startdate,
                    'festival_enddate' => $festival_enddate,
                    'festival_description' => $festival_description,
                    'user_id' => $user_id,
                    'city' => $city,
                );

                if (!ModelFestival::festivalExiste($festival_name))
                {
                    $f = new ModelFestival($dataUser);
                    $f->save($dataUser);

                    $tab_f = ModelFestival::selectAll();
                    $reussite_festival = true;
                }
                else{
                    $reussite_festival = false;
                    $controller = 'utilisateur';
                    $view = 'messageRetour';
                    $message = 'Un festival existe déjà avec ce nom';
                    $pagetitle = 'erreur';
                }
                

            } else {
                $controller = 'utilisateur';
                $view = 'messageRetour';
                $message = 'Erreur: initialisation des variables nécessaire à la création d\'un utilisateur';
                $pagetitle = 'erreur';
            }

            //On recupere l'id du festival
            if($reussite_festival)
            {
                $festival_id = ModelFestival::getIdByNomFestival($festival_name);
                $festival_id = $festival_id->getFestivalId();
                if (!empty($festival_id)) {
                    $reussiteId = true;
                } else {
                    $message = 'Erreur: Récupération de l\'id festival';
                    $controller = 'utilisateur';
                    $view = 'messageRetour';
                    $pagetitle = 'erreur';
                    $reussiteId = false;
                }
    
                // Insertion pour poste
                if ($reussiteId){
                    if (isset($poste_name, $poste_description, $festival_id)) {
                        $dataPoste = array(
                            'poste_name' => $poste_name,
                            'poste_description' => $poste_description,
                            'festival_id' => $festival_id,
                        );
        
                        if (is_bool(ModelPoste::save($dataPoste))) {
                            $controller = 'utilisateur';
                            $view = 'messageRetour';
                            $message = 'Erreur: Insertion des données dans la table poste';
                            $pagetitle = 'erreur';
                        }
        
                        $tab_p = ModelPoste::selectAll();
        
                        $pagetitle = 'Festival créé';
                        $controller = 'festival';
                        $view = 'created';
                    } else {
                        $controller = 'utilisateur';
                        $view = 'messageRetour';
                        $message = 'Erreur: initialisation des variables nécessaire à la création d\'un poste';
                        $pagetitle = 'erreur';
                    }
                }
            }
            
            
        } else {
            $pagetitle = 'Erreur';
            $controller = 'utilisateur';
            $message = "Vous n'avez pas l'autorisation !";
            $view = 'messageRetour';
        }

        require File::build_path(array("view", "view.php"));
    }


    public static function accepterUtilisateur()
    {
        if (Session::is_admin() || Session::is_responsable()) {
            $festival_id = $_GET['festival_id'];
            $f = ModelFestival::select($festival_id);
            $f->accepterUtilisateur($_GET['user_id']);

            $tab_benevoleAccepted = ModelFestival::getBenevolesAcceptedByFestival($festival_id);
            $tab_candidature = ModelFestival::getCandidatsByFestival($festival_id);
            $tab_poste = ModelFestival::getPostesByFestival($festival_id);
            $tab_creneau = ModelFestival::getCreneauxByFestival($festival_id);
            $createur = ModelFestival::getNomCreateur($festival_id);
            if(Session::is_responsable()) {
                $boolResponsable = 1;
            } else {
                $tab_responsable = ModelResponsable::getResponsableByFestival($festival_id);
                $boolResponsable = 0;
            }

            if ($f == false) {
                $pagetitle = 'Erreur action read';
                $controller = 'utilisateur';
                $view = 'messageRetour';
                $message = 'erreur de la fonction accepterUtilisateur dans le controller festival';
            } else {
                $pagetitle = 'Détail du festival';
                $controller = 'festival';
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

    public static function refuserUtilisateur()
    {
        if (Session::is_admin() || Session::is_responsable()) {
            $festival_id = $_GET['festival_id'];
            $user_id = $_GET['user_id'];
            $f = ModelFestival::select($festival_id);
            $r = ModelUtilisateur::estResponsable($user_id, $festival_id);
            if ($r == false) {
                $f->refuserUtilisateur($_GET['user_id']);

                $tab_benevoleAccepted = ModelFestival::getBenevolesAcceptedByFestival($festival_id);
                $tab_candidature = ModelFestival::getCandidatsByFestival($festival_id);
                $tab_poste = ModelFestival::getPostesByFestival($festival_id);
                $tab_creneau = ModelFestival::getCreneauxByFestival($festival_id);
                $createur = ModelFestival::getNomCreateur($festival_id);
                if(Session::is_responsable()) {
                    $boolResponsable = 1;
                } else {
                    $tab_responsable = ModelResponsable::getResponsableByFestival($festival_id);
                    $boolResponsable = 0;
                }

                if ($f == false) {
                    $pagetitle = 'Erreur action read';
                    $controller = 'utilisateur';
                    $view = 'messageRetour';
                    $message = 'erreur de la fonction refuserUtilisateur dans le controller festival';
                } else {
                    $pagetitle = 'Détail du festival';
                    $controller = 'festival';
                    $view = 'detail';
                }
            } else {
                $pagetitle = 'Détail du festival';
                $controller = 'utilisateur';
                $view = 'messageRetour';
                $message = 'Vous ne pouvez pas désassigner un responsable';
            }
        } else {
            $pagetitle = 'Erreur';
            $controller = 'utilisateur';
            $message = "Vous n'avez pas l'autorisation !";
            $view = 'messageRetour';
        }
        require File::build_path(array("view", "view.php"));
    }

    public static function ajouterResponsable()
    {
        if (Session::is_admin()) {
            $festival_id = $_GET['festival_id'];
            $user_id = $_GET['user_id'];
            if (!ModelUtilisateur::estResponsable($user_id, $festival_id)) { // Si l'utilisateur n'est pas déjà responsable du festival                
                $data = array(
                    'user_id' => $user_id,
                    'festival_id' => $festival_id,
                );
                // Insertion dans responsable + test d'insertion
                if (!is_bool(ModelResponsable::save($data))) {
                    // Pour la vue détail
                    $f = ModelFestival::select($festival_id);
                    $tab_responsable = ModelResponsable::getResponsableByFestival($festival_id);
                    $tab_benevoleAccepted = ModelFestival::getBenevolesAcceptedByFestival($festival_id);
                    $tab_candidature = ModelFestival::getCandidatsByFestival($festival_id);
                    $tab_poste = ModelFestival::getPostesByFestival($festival_id);
                    $tab_creneau = ModelFestival::getCreneauxByFestival($festival_id);
                    $createur = ModelFestival::getNomCreateur($festival_id);
                    if(Session::is_responsable()) {
                        $boolResponsable = 1;
                    } else {
                        $tab_responsable = ModelResponsable::getResponsableByFestival($festival_id);
                        $boolResponsable = 0;
                    }

                    $pagetitle = 'Détail du festival';
                    $controller = 'festival';
                    $view = 'detail';
                } else {
                    $pagetitle = 'Erreur action read';
                    $controller = 'utilisateur';
                    $view = 'messageRetour';
                    $message = 'erreur de la fonction ajouterResponsable dans le controller festival';
                }
            } else{
                $pagetitle = 'Détail du festival';
                $controller = 'utilisateur';
                $view = 'messageRetour';
                $message = 'Ce bénévole est déjà responsable dans ce festival';
            }
        } else {
            $pagetitle = 'Erreur';
            $controller = 'utilisateur';
            $message = "Vous n'avez pas l'autorisation !";
            $view = 'messageRetour';
        }

        require File::build_path(array("view", "view.php"));
    }

    public static function desassignerResponsable()
    {
        if (Session::is_admin()) {
            
            $festival_id = $_GET['festival_id'];
            $user_id = $_GET['user_id'];
            $responsable_id = ModelResponsable::getResponsableByFestivalAndUser($festival_id, $user_id)->getResponsableId();
            if (ModelUtilisateur::estResponsable($user_id, $festival_id)) { // Si l'utilisateur est bien responsable du festival                
                // Suppression dans responsable + test de suppression
                if (is_bool(ModelResponsable::delete($responsable_id))) {
                    // Pour la vue détail
                    $f = ModelFestival::select($festival_id);
                    $tab_benevoleAccepted = ModelFestival::getBenevolesAcceptedByFestival($festival_id);
                    $tab_candidature = ModelFestival::getCandidatsByFestival($festival_id);
                    $tab_poste = ModelFestival::getPostesByFestival($festival_id);
                    $tab_creneau = ModelFestival::getCreneauxByFestival($festival_id);
                    $createur = ModelFestival::getNomCreateur($festival_id);
                    if(Session::is_responsable()) {
                        $boolResponsable = 1;
                    } else {
                        $tab_responsable = ModelResponsable::getResponsableByFestival($festival_id);
                        $boolResponsable = 0;
                    }

                    $pagetitle = 'Détail du festival';
                    $controller = 'festival';
                    $view = 'detail';
                } else {
                    $pagetitle = 'Erreur action read';
                    $controller = 'utilisateur';
                    $view = 'messageRetour';
                    $message = 'erreur de la fonction desassignerResponsable dans le controller festival';
                }
            } else{
                $pagetitle = 'Détail du festival';
                $controller = 'utilisateur';
                $view = 'messageRetour';
                $message = 'Ce bénévole n\'est pas responsable dans ce festival';
            }
        } else {
            $pagetitle = 'Erreur';
            $controller = 'utilisateur';
            $message = "Vous n'avez pas l'autorisation !";
            $view = 'messageRetour';
        }

        require File::build_path(array("view", "view.php"));
    }
}
