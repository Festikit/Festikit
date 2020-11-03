<?php
	// Liste tous les festivals

	$i = 1;
	foreach ($tab_f as $f) {
		echo "<p>$i : Le festival d'id:" . htmlspecialchars($f->getId()) . "</p>";
    	$i++;
	}

?>