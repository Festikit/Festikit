<?php

require_once File::build_path(array("model","ModelResponsable.php"));

class ControllerResponsable {

    public static function readAll() {
        $tab_nomResponsable = ModelResponsable::getAllResponsable();

        $pagetitle = 'Liste des responsables';
        $controller = 'responsable';
        $view = 'list';
        require File::build_path(array("view","view.php"));
    }

    public static function read() {
        
        $responsable_id = $_GET['responsable_id'];
        $r = ModelResponsable::select($responsable_id);


        if($r == false) {
            $pagetitle = 'Erreur action';
            $controller = 'responsable';
            $view = 'error';
            $message = 'erreur de la fonction read';
        } else {
            $pagetitle = 'Détail du responsable';
            $controller = 'responsable';
            $view = 'detail';
        }
        require File::build_path(array("view","view.php"));
    }
   }
