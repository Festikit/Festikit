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
        $f = ModelFestival::getFestivalsById($festival_id);

        $tab_benevoleAccepted = ModelFestival::getBenevolesAcceptedByFestival($festival_id);
        $tab_candidature = ModelFestival::getCandidatsByFestival($festival_id);
        $tab_poste = ModelFestival::getPostesByFestival($festival_id);
        $tab_creneau = ModelFestival::getCreneauxByFestival($festival_id);
        $tab_date = ModelFestival::getJoursByFestival($festival_id);

        if ($f == false) {
            $pagetitle = 'Erreur action read';
            $controller = 'festival';
            $view = 'error';
        } else {
            $pagetitle = 'Détail du festival';
            $controller = 'festival';
            $view = 'detail';
        }

        require File::build_path(array("view", "view.php"));
    }

    public static function accepterUtilisateur()
    {
        $festival_id = $_GET['festival_id'];
        $f = ModelFestival::getFestivalsById($festival_id);
        $f->accepterUtilisateur($_GET['user_id']);

        $tab_benevoleAccepted = ModelFestival::getBenevolesAcceptedByFestival($festival_id);
        $tab_candidature = ModelFestival::getCandidatsByFestival($festival_id);
        $tab_poste = ModelFestival::getPostesByFestival($festival_id);
        $tab_creneau = ModelFestival::getCreneauxByFestival($festival_id);

        if ($f == false) {
            $pagetitle = 'Erreur action read';
            $controller = 'festival';
            $view = 'error';
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
        $f = ModelFestival::getFestivalsById($festival_id);
        $f->refuserUtilisateur($_GET['user_id']);

        $tab_benevoleAccepted = ModelFestival::getBenevolesAcceptedByFestival($festival_id);
        $tab_candidature = ModelFestival::getCandidatsByFestival($festival_id);
        $tab_poste = ModelFestival::getPostesByFestival($festival_id);
        $tab_creneau = ModelFestival::getCreneauxByFestival($festival_id);

        if ($f == false) {
            $pagetitle = 'Erreur action read';
            $controller = 'festival';
            $view = 'error';
        } else {
            $pagetitle = 'Détail du festival';
            $controller = 'festival';
            $view = 'detail';
        }
        require File::build_path(array("view", "view.php"));
    }
}
