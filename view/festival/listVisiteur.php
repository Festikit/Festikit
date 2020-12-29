<ul class="collection">
	<li class="collection-header">
		<h4>Liste de tous les festivals</h4>
	</li>
	<?php
	$i = 1;
	foreach ($tab_f as $f) {
		$festival_name = htmlspecialchars($f->getFestivalName());
		$festival_id = $f->getFestivalId();
		echo "<li class=\"collection-item\">
        $festival_name
		<div class=\"secondary-content\">
			<a title=\"voir le formulaire\" href=\"index.php?action=create&festival_id=$festival_id\" class=\"btn\"><i class=\"material-icons\">assignment</i></a>
		</div>
	</li>";
		$i++;
	}
	?>
</ul>