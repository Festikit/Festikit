
<?php
	// Liste tous les responsables
	$i = 1;
	foreach ($tab_r as $r) {
		echo "<p>Responsable $i : <a href=\"index.php?action=read&controller=responsable&responsable_id=" . rawurlencode($r->getId()) . "\">" . "Plus de details" . "</a></p>";
    	$i++;
	}

?>