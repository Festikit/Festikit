<?php
	// Détail les informations d'un festival
	
    /* TODO : Récupérer les autres informations des festivals via les getters */

    echo "<p> Festival " . htmlspecialchars($f->getFestivalName()) . "</p>";


    if(empty($tab_date)) {
        echo "Il n'y a pas encore de dates pour ce festival.</br>";
    } else {
        $i = 1;
        echo "<pre>";
        print_r($tab_date);
        echo "</pre>";
        foreach ($tab_date as $d) {
            echo $d->getCreneauStart() . " " ;
            $i++;
        }
    }


    // Affichage des créneaux 
    
    echo "<p> Liste des créneaux: </br>";

    if(empty($tab_creneau)) {
        echo "Il n'y a pas encore de créneaux pour ce festival.</br>";
    } else {
        $i = 1;
        foreach ($tab_creneau as $c) {
            echo " $i : " . htmlspecialchars($c->getCreneauStart()) . " - " . htmlspecialchars($c->getCreneauEnd()) . ")</p>";
            $i++;
        }
    }



    // Affichage des postes
    
    echo "<p> Liste des postes: </br>";

    if(empty($tab_poste)) {
        echo "Il n'y a pas encore de postes pour ce festival.</br>";
    } else {
        $i = 1;
        foreach ($tab_poste as $p) {
            echo " $i : " . htmlspecialchars($p->getPosteName()) . "(" . htmlspecialchars($p->getPosteDescription()) . ")</a></p>";
            $i++;
        }
    }
    


    // Affichage des bénévoles

    echo "<p> Liste des bénévoles acceptés: </br>";

    if(empty($tab_benevoleAccepted)) {
        echo "Il n'y a pas encore de bénévoles pour ce festival.</br>";
    } else {
        $i = 1;
        foreach ($tab_benevoleAccepted as $b) {
              echo " $i : <a href=\"index.php?action=read&user_id=" . rawurlencode($b->getId()) . "\">" . htmlspecialchars($b->getFirstname()) . " " .htmlspecialchars($b->getLastname()) . "</a></p>";
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
            echo " $i : <a href=\"index.php?action=read&user_id=" . rawurlencode($c->getId()) . "\">" . htmlspecialchars($c->getFirstname()) . " " .htmlspecialchars($c->getLastname()) . "</a></p>";
            $i++;
        }
    }


    echo "<p> Retour: <a href=\"index.php?action=readAll&controller=festival\">Cliquez ici </a> </p>";

?>