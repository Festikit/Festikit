<?php
	// Liste toutes les affectations

	$i = 1;
	foreach ($tab_a as $a) {
		echo "<p>$i : " . htmlspecialchars($a->getAffectationId()) . "</p>";
    	$i++;
	}

?>