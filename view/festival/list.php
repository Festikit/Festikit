<?php
	// Liste tous les festivals

	$i = 1;
	foreach ($tab_f as $f) {
		echo "<p>$i : Le festival d'id: <a href=\"index.php?action=read&controller=festival&festival_id=" . rawurlencode($f->getId()) . "\">" . htmlspecialchars($f->getId()) . "</a></p>";
    	$i++;
	}

?>