<?php

require_once File::build_path(array("model", "ModelFestival.php"));

class ControllerFestival
{

    public static function readAll()
    {
        $tab_f = ModelFestival::selectAll();

        $pagetitle = 'Liste des festivals';
        $controller = 'festival';
        $view = 'list';
        require File::build_path(array("view", "view.php"));
    }

    public static function read()
    {

        $festival_id = $_GET['festival_id'];
        $f = ModelFestival::select($festival_id);

        $tab_benevoleAccepted = ModelFestival::getBenevolesAcceptedByFestival($festival_id);
        $tab_candidature = ModelFestival::getCandidatsByFestival($festival_id);
        $tab_poste = ModelFestival::getPostesByFestival($festival_id);
        $tab_date = ModelFestival::getJoursByFestival($festival_id);
        $tab_responsable = ModelFestival::getResponsableByFestival($festival_id);
        $tab_creneau = ModelFestival::getCreneauxByFestival($festival_id);
        $tab_creneau_gen = array();
        
        //------------------------------------ Tableau de Créneaux génériques ------------------------------------//
            if (ModelFestival::getCreneauxGeneriquesHeure($festival_id) && ModelFestival::getCreneauxGeneriquesDate($festival_id)){
                foreach (ModelFestival::getCreneauxGeneriquesHeure($festival_id) as $h) {
                    $cStart = $h->getCreneauStart();
                    $cEnd = $h->getCreneauEnd();
                    foreach (ModelFestival::getCreneauxGeneriquesDate($festival_id) as $d) {
                        $CreneauDate = $d->getCreneauStart();
                        $post = "dispo_heure$cStart" . "_$cEnd" . "date_$CreneauDate";

                        
                            $heureStart = substr($post,11,8); // Je récupère 8 caractères à partir du 11ème (inclus)
                            $heureEnd = substr($post,20,8);
                            $date = substr($post,-10); // Je récupère les 10 derniers caractères

                            
                            $CreneauStart = $date . " " . $heureStart;
                            $CreneauEnd = $date . " " . $heureEnd;
                            

                            $creneau_id = ModelFestival::getCreneauxIdByDateHeure($festival_id, $CreneauStart, $CreneauEnd);
                            if ($creneau_id){
                            $creneau_id = $creneau_id->getCreneauId();
                            array_push($tab_creneau_gen,"$creneau_id");}
                            

                        
                    }
                }
            }

            // ------------------------------------   FIN    ------------------------------------


        if ($f == false) {
            $pagetitle = 'Erreur action read';
            $controller = 'festival';
            $view = 'error';
            $message = 'erreur de la fonction read dans le controller festival';
        } else {
            $pagetitle = 'Détail du festival';
            $controller = 'festival';
            $view = 'detail';
        }

        require File::build_path(array("view", "view.php"));
    }


    public static function create()
    {

            $nameHTML = "";
            $startdateHTML = "";
            $enddateHTML = "";
            $descriptionHTML = "";
            $cityHTML = "";

            $pagetitle = 'Formulaire d\'enregistrement';
            $controller = 'festival';
            $view = 'update';
            $next_action = "created";
            $primary_property = "required";
        
        require File::build_path(array("view", "view.php"));
    }

    public static function update()
    {
        
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
                $controller = 'festival';
                $view = 'error';
                $message = "Erreur: Le controller n'a pas pu récupérer les éléments du formulaire update";
            }
        
        require File::build_path(array("view", "view.php"));
    }

    public static function updated()
    {
        
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
                $controller = 'festival';
                $view = 'updated';
                $pagetitle = 'modification festival';

            }
        
        $tab_f = ModelFestival::selectAll();
        require(File::build_path(array("view", "view.php")));
    }



    public static function created(){
        $festival_name = $_POST['festival_name'];
        $festival_startdate = $_POST['festival_startdate'];
        $festival_enddate = $_POST['festival_enddate'];
        $festival_description = $_POST['festival_description'];
        $user_id = 4;
        $city = $_POST['city'];

        if(isset($festival_name, $festival_startdate, $festival_enddate, $festival_description, $user_id, $city)) {
            $dataUser = array(
                'festival_name' => $festival_name, 
                'festival_startdate' => $festival_startdate, 
                'festival_enddate' => $festival_enddate,  
                'festival_description' => $festival_description, 
                'user_id' => $user_id,
                'city' => $city, 
                );

            $f = new ModelFestival($dataUser);
            $f->save($dataUser);
            
            $tab_f = ModelFestival::selectAll();

            $pagetitle = 'Liste des festivals';
            $controller = 'festival';
            $view = 'list';
            
        } else {
            $controller = 'utilisateur';
            $view = 'error';
            $message = 'Erreur: initialisation des variables nécessaire à la création d\'un utilisateur';
            $pagetitle = 'erreur';
        }
        require File::build_path(array("view","view.php"));
    }
    

    public static function accepterUtilisateur()
    {
        $festival_id = $_GET['festival_id'];
        $f = ModelFestival::select($festival_id);
        $f->accepterUtilisateur($_GET['user_id']);

        $tab_benevoleAccepted = ModelFestival::getBenevolesAcceptedByFestival($festival_id);
        $tab_candidature = ModelFestival::getCandidatsByFestival($festival_id);
        $tab_poste = ModelFestival::getPostesByFestival($festival_id);
        $tab_creneau = ModelFestival::getCreneauxByFestival($festival_id);
        $tab_responsable = ModelFestival::getResponsableByFestival($festival_id);

        if ($f == false) {
            $pagetitle = 'Erreur action read';
            $controller = 'festival';
            $view = 'error';
            $message = 'erreur de la fonction accepterUtilisateur dans le controller festival';
        } else {
            $pagetitle = 'Détail du festival';
            $controller = 'festival';
            $view = 'detail';
        }
        require File::build_path(array("view", "view.php"));
    }

    public static function refuserUtilisateur()
    {
        $festival_id = $_GET['festival_id'];
        $f = ModelFestival::select($festival_id);
        $f->refuserUtilisateur($_GET['user_id']);

        $tab_benevoleAccepted = ModelFestival::getBenevolesAcceptedByFestival($festival_id);
        $tab_candidature = ModelFestival::getCandidatsByFestival($festival_id);
        $tab_poste = ModelFestival::getPostesByFestival($festival_id);
        $tab_creneau = ModelFestival::getCreneauxByFestival($festival_id);
        $tab_responsable = ModelFestival::getResponsableByFestival($festival_id);

        if ($f == false) {
            $pagetitle = 'Erreur action read';
            $controller = 'festival';
            $view = 'error';
            $message = 'erreur de la fonction refuserUtilisateur dans le controller festival';
        } else {
            $pagetitle = 'Détail du festival';
            $controller = 'festival';
            $view = 'detail';
        }
        require File::build_path(array("view", "view.php"));
    }

    public static function ajouterResponsable(){
        $festival_id = $_GET['festival_id'];
        $f = ModelFestival::select($festival_id);
        $f->ajouterResponsable($_GET['user_id'], $festival_id);
        $tab_responsable = ModelFestival::getResponsableByFestival($festival_id);

        $tab_benevoleAccepted = ModelFestival::getBenevolesAcceptedByFestival($festival_id);
        $tab_candidature = ModelFestival::getCandidatsByFestival($festival_id);
        $tab_poste = ModelFestival::getPostesByFestival($festival_id);
        $tab_creneau = ModelFestival::getCreneauxByFestival($festival_id);
        $tab_responsable = ModelFestival::getResponsableByFestival($festival_id);

        if ($f == false) {
            $pagetitle = 'Erreur action read';
            $controller = 'festival';
            $view = 'error';
            $message = 'erreur de la fonction ajouterResponsable dans le controller festival';
        } else {
            $pagetitle = 'Détail du festival';
            $controller = 'festival';
            $view = 'detail';
        }
        require File::build_path(array("view", "view.php"));
    }

    
}
