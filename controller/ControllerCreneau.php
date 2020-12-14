<?php

require_once File::build_path(array("model", "ModelCreneau.php"));

class ControllerCreneau
{

    public static function readAll()
    {
        $tab_c = ModelCreneau::selectAll();

        $pagetitle = 'Liste des creneaux';
        $controller = 'creneau';
        $view = 'list';
        require File::build_path(array("view", "view.php"));
    }

    public static function read()
    {

        $creneau_id = $_GET['creneau_id'];
        $c = ModelCreneau::select($creneau_id);

        if ($c == false) {
            $pagetitle = 'Erreur action read';
            $controller = 'creneau';
            $view = 'error';
            $message = 'erreur de la fonction read dans le controller Creneau';
        } else {
            $pagetitle = 'Détail du créneau';
            $controller = 'creneau';
            $view = 'detail';
        }

        require File::build_path(array("view", "view.php"));
    }

    public static function update()
    {
        $controller = 'creneau';
        $view = 'update';
        $pagetitle = 'modification du creneau';
        $log_c  = $_GET['creneau_id'];
        $tab_c = ModelCreneau::select($log_c);
        $nom_poste = ModelPoste::select($tab_c->getPosteId())->getPosteName();
        $nom_festival = ModelFestival::select($tab_c->getFestivalId())->getFestivalName();
        require(File::build_path(array("view", "view.php")));
    }

    public static function updated()
    {

        $controller = 'creneau';
        $view = 'updated';
        $pagetitle = 'modification du creneau';

        $log_c = $_GET['creneau_id'];
        $creneau_startdate = $_GET['creneau_startdate'];
        $creneau_enddate = $_GET['creneau_enddate'];
        $festival_id = $_GET['festival_id'];
        $poste_id = $_GET['poste_id'];

        $tab_cmod = array(
            "creneau_id" => $log_c,
            "creneau_startdate" => $creneau_startdate,
            "creneau_enddate" => $creneau_enddate,
            "festival_id" => $festival_id,
            "poste_id" => $poste_id,
        );
        $creneaumod = new ModelCreneau();
        $creneaumod->update($tab_cmod);
        $tab_c = ModelCreneau::selectAll();
        require(File::build_path(array("view", "view.php")));
    }

    public static function deleteInPoste()
    {
        $controller = 'poste';
        $view = 'update';
        $pagetitle = 'modification du poste';

        $creneau_id = $_GET['creneau_id'];
        $log_p  = $_GET['poste_id'];

        ModelCreneau::delete($creneau_id);
        $tab_creneau = ModelCreneau::getAllCreneauxByPosteId($log_p);
        $tab_p = ModelPoste::select($log_p);

        require(File::build_path(array("view", "view.php")));
    }

    public static function create()
    {
        $controller = 'creneau';
        $view = 'create';
        $pagetitle = 'ajout d\'un créneau';

        $festival_id = $_GET['festival_id'];
        $poste_id = $_GET['poste_id'];

        $nom_festival = ModelFestival::select($festival_id)->getFestivalName();
        $nom_poste = ModelPoste::select($poste_id)->getPosteName();

        require(File::build_path(array("view", "view.php")));
    }

    public static function created()
    {
        $controller = 'poste';
        $view = 'update';
        $pagetitle = 'ajout d\'un créneau';

        $creneau_startdate = $_GET['creneau_startdate'];
        $creneau_enddate = $_GET['creneau_enddate'];
        $festival_id = $_GET['festival_id'];
        $poste_id = $_GET['poste_id'];

        $dataCreneau = array(
            "creneau_startdate" => $creneau_startdate,
            "creneau_enddate" => $creneau_enddate,
            "festival_id" => $festival_id,
            "poste_id" => $poste_id
        );

        $log_p  = $poste_id;
        $tab_creneau = ModelCreneau::getAllCreneauxByPosteId($log_p);
        $tab_p = ModelPoste::select($log_p);
        if (is_bool(ModelCreneau::save($dataCreneau))) {
            $controller = 'creneau';
            $view = 'error';
            $message = 'Erreur: Insertion des données dans la table poste';
            $pagetitle = 'erreur';
        }
        require(File::build_path(array("view", "view.php")));
    }

    public static function createGen()
    {
        $controller = 'creneau';
        $view = 'createGen';
        $pagetitle = 'ajout d\'un créneau générique';

        $festival_id = $_GET['festival_id'];
        $poste_id = 37;

        require(File::build_path(array("view", "view.php")));
    }

    public static function createdGen()
    {
        $controller = 'creneau';
        $view = 'createdGen';
        $pagetitle = 'ajout d\'un créneau';

        $creneau_startdate = $_GET['creneau_startdate'];
        $creneau_enddate = $_GET['creneau_enddate'];
        $festival_id = $_GET['festival_id'];
        $poste_id = $_GET['poste_id'];

        //cr début
        $creneau_startdate = $creneau_startdate."";
        $rest = substr($creneau_startdate, 4);
        $creneau_startdate_modif = 2000 . "$rest";
        $creneau_startdate_gen = date('Y-m-d H:i:s', strtotime("$creneau_startdate_modif"));
        //cr fin
        $creneau_enddate = $creneau_enddate."";
        $rest = substr($creneau_enddate, 4);
        $creneau_enddate_modif = 2000 . "$rest";
        $creneau_enddate_gen = date('Y-m-d H:i:s', strtotime("$creneau_enddate_modif"));
        
        $dataCreneau = array(
            "creneau_startdate" => $creneau_startdate_gen,
            "creneau_enddate" => $creneau_enddate_gen,
            "festival_id" => $festival_id,
            "poste_id" => $poste_id
        );
        

        $f = ModelFestival::select($festival_id);
        $tab_benevoleAccepted = ModelFestival::getBenevolesAcceptedByFestival($festival_id);
        $tab_candidature = ModelFestival::getCandidatsByFestival($festival_id);
        $tab_poste = ModelFestival::getPostesByFestival($festival_id);
        $tab_date = ModelFestival::getJoursByFestival($festival_id);
        $tab_responsable = ModelFestival::getResponsableByFestival($festival_id);
        $tab_creneau = ModelFestival::getCreneauxByFestival($festival_id);
        $tab_creneau_gen = ModelCreneau::getCreneauxGen($festival_id);


        if (is_bool(ModelCreneau::save($dataCreneau))) {
            $controller = 'creneau';
            $view = 'error';
            $message = 'Erreur: Insertion des données dans la table poste';
            $pagetitle = 'erreur';
        }
        require(File::build_path(array("view", "view.php")));
    }
}
