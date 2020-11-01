<?php
	// Détail les informations d'un utilisateur
	
    $user_id = htmlspecialchars($u->getId());
    $user_firstname = htmlspecialchars($u->getFirstname());
    $user_lastname =  htmlspecialchars($u->getLastname());
    $user_mail = htmlspecialchars($u->getMail());
    $user_phone = htmlspecialchars($u->getPhone());
    $user_birthdate = htmlspecialchars($u->getBirthdate());
    $user_picture = htmlspecialchars($u->getPicture());

    echo "<p> Utilisateur $user_id: $user_firstname $user_lastname,</br>mail: $user_mail téléphone: $user_phone $user_birthdate </br>$user_picture  </p>";

    echo "<p> Retour: <a href=\"index.php?action=readAll\">Cliquez ici </a> </p>";

?>