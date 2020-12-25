<?php
session_start();

require_once __DIR__ . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'File.php';

require_once File::build_path(array('lib', 'Session.php'));
require_once File::build_path(array('lib', 'Security.php'));

require_once File::build_path(array("controller","routeur.php"));

// Timeout sur session
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > (30*60))) { // Dernière activité datant de moins de 30min
    session_unset();
    session_destroy();
 } else {
    $_SESSION['LAST_ACTIVITY'] = time(); // Mise à jour de la dernière activité
 }

?>
