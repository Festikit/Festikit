<?php

require_once File::build_path(array("controller","ControllerUtilisateur.php"));
require_once File::build_path(array("controller","ControllerFestival.php"));
require_once File::build_path(array("controller","ControllerResponsable.php"));
require_once File::build_path(array("controller","ControllerPoste.php"));
require_once File::build_path(array("controller","ControllerCreneau.php"));
require_once File::build_path(array("controller","ControllerPostuler.php"));
require_once File::build_path(array("controller","ControllerSlot.php"));
require_once File::build_path(array("controller","ControllerAffectation.php"));
require_once File::build_path(array("controller","ControllerDisponible.php"));
require_once File::build_path(array("controller","ControllerLieu.php"));
require_once File::build_path(array("controller","ControllerPreference.php"));



if(isset($_GET['action'])) {

	if(isset($_GET['controller'])) {
		$controller =  $_GET['controller'];
		$controller_class = "Controller" . ucfirst($controller);
	} else {
		$controller_class = "ControllerUtilisateur";
	}
	
	if(class_exists($controller_class)) {
		$class_methods = get_class_methods($controller_class);

		if(in_array($_GET['action'], $class_methods)) {
			$action = $_GET['action'];
			$controller_class::$action(); 
		} else {
			$pagetitle = 'Erreur action';
	        $controller = 'utilisateur';
			$view = 'error';
			$message = 'erreur de action (routeur)';
	        require File::build_path(array("view","view.php"));
		}
	} else {
		$pagetitle = 'Erreur classe';
        $controller = 'utilisateur';
		$view = 'error';
		$message = 'erreur de classe (routeur)';
        require File::build_path(array("view","view.php"));
	}
} else {
	$action = 'readAll';
	ControllerUtilisateur::$action(); 
}
?>


