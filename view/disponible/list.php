<?php
	// Liste toutes les dispo

	$i = 1;
	foreach ($tab_d as $d) {
		echo "<p>$i : " . htmlspecialchars($d->getDisponibleId()) . "</p>";
    	$i++;
	}

?>