<?php
echo '<p>Poste d\'id :   '. $log_p .'   mis à jour</p>';
require File::build_path(array("view","$controller","update.php"));
?>