<?php
	// Liste tous les utilisateurs de la base de donnée: bénévoles (postulé accepté: oui et non) et les responsables

	$i = 1;
	foreach ($tab_u as $u) {
		echo "<p>$i : L'utilisateur d'id 
		<a href=\"index.php?action=read&user_id=" . rawurlencode($u->getId()) . "\">" . htmlspecialchars($u->getId()) . "</a> ~ ~ 
		<a href=\"index.php?action=delete&user_id=" .rawurlencode($u->getId()) . "\"> (Supprimer utilisateur) </a>  ~ ~ 
		<a href=\"index.php?action=update&user_id=" .rawurlencode($u->getId()) . "\"> (Modifier utilisateur) </a> 
		</p>";
		
		
    	$i++;
	}

?>