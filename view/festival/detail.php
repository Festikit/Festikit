<?php
	// Détail les informations d'un festival
	
    /* TODO : Récupérer les autres informations des festivals via les getters */

    echo "<p> Festival " . htmlspecialchars($f->getFestivalName()) . "</p>";

    if(empty($tab_benevoleAccepted)) {
        echo "Il n'y a pas encore de bénévoles dont la candidature a été acceptée pour ce festival";
    } else {
        echo "<p> Liste des bénévoles acceptés: </br>";

        $i = 1;
        foreach ($tab_benevoleAccepted as $b) {

            $nom = $b->getFirstname();
            echo " $i : <a href=\"index.php?action=read&user_id=" . rawurlencode($b->getId()) . "\">" . $b->getId() . "</a></p>";
            /* Je n'arrive pas à afficher le nom et le prénom du bénévole...*/
            $i++;
        }
    }

    echo "<p> Retour: <a href=\"index.php?action=readAll&controller=festival\">Cliquez ici </a> </p>";

?>