<?php
	// Liste tous les festivals
	// TODO: Lien pour créer un festival

	$i = 1;
	foreach ($tab_f as $f) {
		echo "<p>$i : <a href=\"index.php?action=read&controller=festival&festival_id=" . rawurlencode($f->getFestivalId()) . "\">" . htmlspecialchars($f->getFestivalName()) . "</a></p>";
		// TODO: il doit y avoir un lien qui pointe sur le formulaire généré par rapport au festival
		// TODO: update
    	$i++;
	}

?>