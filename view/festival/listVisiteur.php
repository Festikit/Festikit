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
            <a href=\"index.php?action=readForUser&controller=festival&festival_id=$festival_id\"> <span class=\"title\">$festival_name</span></a>
            <div class=\"secondary-content\">
                <a title=\"en savoir plus\" href=\"index.php?action=readForUser&controller=festival&festival_id=$festival_id\" class=\"btn\"><i class=\"material-icons\">more</i></a>
                <a title=\"S'inscrire\" href=\"index.php?action=create&festival_id=$festival_id\" class=\"btn\">S'inscrire</a>
			</div>
			</li>";
		$i++;
	}
	?>
</ul>