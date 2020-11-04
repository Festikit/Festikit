<?php
	// Détail les informations d'un festival
	
    $festival_id = htmlspecialchars($f->getFestivalId());

    /* TODO : Récupérer les autres informations des festivals via les getters */
    
    echo "<p> Festival $festival_id </p>";

    if(empty($tab_benevoleAccepted)) {
        echo "Il n'y a pas encore de bénévoles dont la candidature a été acceptée pour ce festival";
    } else {
        echo "<p> Liste des bénévoles acceptés: </br>";

        foreach ($tab_benevoleAccepted as $b) {
            echo "  - Bénévole d'id: <a href=\"index.php?action=read&user_id=" . rawurlencode($b->getId()) . "\">" . htmlspecialchars($b->getId()) . "</a></p>";
        }
    }

    echo "<p> Retour: <a href=\"index.php?action=readAll&controller=festival\">Cliquez ici </a> </p>";

?>