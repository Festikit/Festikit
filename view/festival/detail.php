<?php
	// Détail les informations d'un festival

    echo "<h4>" . htmlspecialchars($f->getFestivalName()) . "</h4>";


    // Affichage des bénévoles

    echo "<p> Liste des bénévoles acceptés: </br>";

    if(empty($tab_benevoleAccepted)) {
        echo "Il n'y a pas encore de bénévoles pour ce festival.</br>";
    } else {
        $i = 1;
        foreach ($tab_benevoleAccepted as $b) {
            $user_firstname = htmlspecialchars($b->getFirstname());
            $user_lastname =  htmlspecialchars($b->getLastname());
            echo " $i : <a href=\"index.php?action=read&user_id=" . rawurlencode($b->getId()) . "\">" . htmlspecialchars($b->getFirstname()) . " " .htmlspecialchars($b->getLastname()) . "</a></p>";
            /* Je n'arrive pas à afficher le nom et le prénom du bénévole...*/
            $i++;
        }
    }


    // Affichage des candidatures

    echo "<p> Liste des candidatures: </br>";

    if(empty($tab_candidature)) {
        echo "Il n'y a pas de candidature pour ce festival.</br>";
    } else {
        $i = 1;
        foreach ($tab_candidature as $c) {

            $nom = $c->getFirstname();
            echo " $i : <a href=\"index.php?action=read&user_id=" . rawurlencode($c->getId()) . "\">" . htmlspecialchars($c->getFirstname()) . " " .htmlspecialchars($c->getLastname()) . "</a></p>";
            /* Je n'arrive pas à afficher le nom et le prénom du candidat...*/
            $i++;
        }
    }


    echo "<p> Retour: <a href=\"index.php?action=readAll&controller=festival\">Cliquez ici </a> </p>";

?>