<?php
	// Détail les informations d'un responsable'

    $responsable_id = htmlspecialchars($r->getId());
    $user_id = htmlspecialchars($r->getUserId());
    $festival_id =  htmlspecialchars($r->getFestivalId());
    

    echo "<h5> $responsable_id </h5>
    <p>User ID: $user_id </br>
    Festival ID: $festival_id </br>";


?>