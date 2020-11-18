<?php
	// Liste tous les lieux

	$i = 1;
	foreach ($tab_l as $l) {
		echo "<p>$i : " . htmlspecialchars($l->getLieuId()) . "</p>";
    	$i++;
	}

?>