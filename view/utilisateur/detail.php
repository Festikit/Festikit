<?php
	// Détail les informations d'un utilisateur
	
    $user_id = htmlspecialchars($u->getId());
    $user_firstname = htmlspecialchars($u->getFirstname());
    $user_lastname =  htmlspecialchars($u->getLastname());
    $user_mail = htmlspecialchars($u->getMail());
    $user_phone = htmlspecialchars($u->getPhone());
    $user_birthdate = htmlspecialchars($u->getBirthdate());
    $user_picture = htmlspecialchars($u->getPicture());
    $user_postal_code = htmlspecialchars($u->getPostalCode());
    if($u->getDrivingLicense() == 1) {
        $user_driving_license = "oui";
    } else {
        $user_driving_license = "non";
    }

    echo "<p> $user_firstname $user_lastname</br>
    Adresse mail: $user_mail </br>
    Téléphone: $user_phone </br>
    Date de naissance: $user_birthdate </br>
    Adresse postale: $user_postal_code </br>
    Permis de conduire: $user_driving_license </br>";
    // header("Content-type: image/jpg");
    echo "<img src=\"$user_picture\" alt=\"Photo de l'utilisateur $user_id\"></p>";
    echo '<a href="index.php?action=delete&user_id=' .rawurlencode($user_id) .'">Supprimer utilisateur</a>';
    echo '~~';
    echo '<a href="index.php?action=update&user_id=' .rawurlencode($user_id) .'">Modifier utilisateur</a>';
    echo "$user_picture"; // getPicture ne renvoie rien ...
    echo "<p> Retour: <a href=\"index.php?action=readAll\">Cliquez ici </a> </p>";

?>