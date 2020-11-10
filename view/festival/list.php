<?php
	// Liste tous les festivals

	$i = 1;
	foreach ($tab_f as $f) {
		echo "<p>$i : <a href=\"index.php?action=read&controller=festival&festival_id=" . rawurlencode($f->getFestivalId()) . "\">" . htmlspecialchars($f->getFestivalName()) . "</a></p>";
    	$i++;
	}

?>