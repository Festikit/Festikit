<?php
	// Détail les informations d'un utilisateur
    $user_id = htmlspecialchars($u->getId());
    $user_firstname = htmlspecialchars($u->getFirstname());
    $user_lastname =  htmlspecialchars($u->getLastname());
    $user_mail = htmlspecialchars($u->getMail());
    $user_phone = htmlspecialchars($u->getPhone());
    $user_birthdate = htmlspecialchars($u->getBirthdate());
    $user_postal_code = htmlspecialchars($u->getPostalCode());
    if($u->getDrivingLicense() == 1) {
        $user_driving_license = "oui";
    } else {
        $user_driving_license = "non";
    }
    $user_picture = $u->getPicture();

    echo "<h5> $user_firstname $user_lastname ";
    if($boolAdmin) {
        echo "(Administrateur)";
    } 

    echo " </h5>
    <p>Adresse mail: $user_mail </br>
    Téléphone: $user_phone </br>
    Date de naissance: $user_birthdate </br>
    Adresse postale: $user_postal_code </br>
    Permis de conduire: $user_driving_license </br>";
    
    $picture = ModelUtilisateur::generatorPicture($user_id);
    echo '<img src="data:image/jpg;base64,' . base64_encode($picture->getPicture()) . '" width="200px"/>';

    // Affichage des festivals où l'utilisateur est bénévole

    echo "<p> Liste des festivals en tant que bénévole: </br>";

    if(empty($tab_festivalWhereAccepted)) {
        echo "Il n'y a pas encore de festival pour ce bénévole.</br>";
    } else {
        $i = 1;
        foreach ($tab_festivalWhereAccepted as $f) {
            echo " $i : <a href=\"index.php?action=read&controller=festival&festival_id=" . rawurlencode($f->getFestivalId()) . "\">" . htmlspecialchars($f->getFestivalName()) . "</a></p>";
            $i++;
        }
    }


    // Affichage des festivals où l'utilisateur est candidat

    echo "<p> Liste des candidatures: </br>";

    if(empty($tab_festivalWhereCandidat)) {
        echo "Il n'y a pas de candidature pour ce festival.</br>";
    } else {
        $i = 1;
        foreach ($tab_festivalWhereCandidat as $c) {
            echo " $i : <a href=\"index.php?action=read&controller=festival&festival_id=" . rawurlencode($c->getFestivalId()) . "\">" . htmlspecialchars($c->getFestivalName()) . "</a></p>";
            $i++;
        }
    }



    
    echo '<br><a href="index.php?action=delete&user_id=' .rawurlencode($user_id) .'">Supprimer utilisateur</a>';
    echo '~~';
    echo '<a href="index.php?action=update&user_id=' .rawurlencode($user_id) .'">Modifier utilisateur</a>';
    echo "<p> Retour: <a href=\"index.php?action=readAll\">Cliquez ici </a> </p>";
