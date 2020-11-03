<?php

require_once File::build_path(array("controller","ControllerUtilisateur.php"));
require_once File::build_path(array("controller","ControllerFestival.php"));

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
	        require File::build_path(array("view","view.php"));
		}
	} else {
		$pagetitle = 'Erreur classe';
        $controller = 'utilisateur';
        $view = 'error';
        require File::build_path(array("view","view.php"));
	}
} else {
	$action = 'readAll';
	ControllerUtilisateur::$action(); 
}
?>


