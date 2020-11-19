<?php
	// Liste tous les slots

	$i = 1;
	foreach ($tab_s as $s) {
		echo "<p>$i : " . htmlspecialchars($s->getSlotId()) . "</p>";
    	$i++;
	}

?>