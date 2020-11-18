<?php
	// Liste toutes les preferences

	$i = 1;
	foreach ($tab_p as $p) {
		echo "<p>$i : " . htmlspecialchars($p->getPreferenceId()) . "</p>";
    	$i++;
	}

?>