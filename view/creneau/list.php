<?php
	// Liste tous les créneaux

	$i = 1;
	foreach ($tab_c as $c) {
		echo "<p>$i : " . htmlspecialchars($c->getCreneauStart()) . " - " . htmlspecialchars($c->getCreneauEnd()) . "</a></p>";
    	$i++;
	}

?>