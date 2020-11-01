<?php
	// Détail les informations d'un utilisateur
	
    $user_id = htmlspecialchars($u->getId());
    $user_firstname = htmlspecialchars($u->getFirstname());
    $user_lastname =  htmlspecialchars($u->getLastname());
    $user_mail = htmlspecialchars($u->getMail());
    $user_phone = htmlspecialchars($u->getPhone());
    $user_birthdate = htmlspecialchars($u->getBirthdate());
    $user_picture = htmlspecialchars($u->getPicture());
    
    echo "<p> Utilisateur $user_id: $user_firstname $user_lastname</br>
    Mail: $user_mail </br>
    Téléphone: $user_phone </br>
    Date de naissance: $user_birthdate</p>";
    // header("Content-type: image/jpg");
    echo "<img src=\"$user_picture\" alt=\"Photo de l'utilisateur $user_id\"></p>";
    echo "$user_picture"; // getPicture ne renvoie rien ...
    echo "<p> Retour: <a href=\"index.php?action=readAll\">Cliquez ici </a> </p>";

?>