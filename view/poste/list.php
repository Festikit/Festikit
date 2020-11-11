<?php
	// Liste tous les festivals

	$i = 1;
	foreach ($tab_p as $p) {
		echo "<p>$i : " . htmlspecialchars($p->getPosteName()) . ": " . htmlspecialchars($p->getPosteDescription()) . "</a></p>";
    	$i++;
	}

?>