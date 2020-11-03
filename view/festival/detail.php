<?php
	// Détail les informations d'un festival
	
    $festival_id = htmlspecialchars($f->getId());

    /* TODO : Récupérer les autres informations des festivals via les getters */
    
    echo "<p> Festival $festival_id </p>";
    echo "<p> Retour: <a href=\"index.php?action=readAll&controller=festival\">Cliquez ici </a> </p>";

?>