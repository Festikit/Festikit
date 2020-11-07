<ul class="collection">
	<li class="collection-header">
		<h4>Liste de tous les utilisateurs</h4>
	</li>
	<?php
	// Liste tous les utilisateurs de la base de donnée: bénévoles (postulé accepté: oui et non) et les responsables
	$i = 1;
	foreach ($tab_u as $u) {
		$user_id = rawurlencode($u->getId());
		$user_firstname = htmlspecialchars($u->getFirstname());
		$user_lastname = htmlspecialchars($u->getLastname());
		echo "<li class=\"collection-item avatar\">
		<div class=\"circle green\">
		</div>
		<span class=\"title\">$user_firstname</span>
		<p>$user_lastname
		</p>
		<div class=\"secondary-content\">
			<a title=\"en savoir plus\" href=\"index.php?action=read&user_id=$user_id\" class=\"btn\"><i class=\"material-icons\">more</i></a>
			<a title=\"supprimer\" href=\"index.php?action=delete&user_id=$user_id\" class=\"btn\"><i class=\"material-icons\">delete</i></a>
			<a title=\"modifier\" href=\"index.php?action=update&user_id=$user_id\" class=\"btn\"><i class=\"material-icons\">edit</i></a>
		}
		</div>
	</li>";
	}
	?>
</ul>