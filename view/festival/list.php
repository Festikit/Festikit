<ul class="collection">
	<li class="collection-header">
		<h4>Liste de tous les festivals</h4>
	</li>
	<?php
	// Liste tous les utilisateurs de la base de donnée: bénévoles (postulé accepté: oui et non) et les responsables
	$i = 1;
	foreach ($tab_f as $f) {
		$festival_name = htmlspecialchars($f->getFestivalName());
		$festival_id = $f->getFestivalId();
		echo "<li class=\"collection-item\">
		<span class=\"title\">$festival_name</span>
		<div class=\"secondary-content\">
			<a title=\"en savoir plus\" href=\"index.php?action=read&controller=festival&festival_id=$festival_id\" class=\"btn\"><i class=\"material-icons\">more</i></a>
			<a title=\"voir le formulaire\" href=\"index.php?action=create&festival_id=$festival_id\" class=\"btn\"><i class=\"material-icons\">assignment</i></a>
		</div>
	</li>";
		$i++;
	}
	?>
</ul>