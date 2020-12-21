<div class="container mb-2">
	<?php echo "<p>Candidature supprimée</p>"; ?>
</div>

<?php
/* TODO: Changer vue en fonction des vues détail propre à chaque utilisateur */
if($boolUser) {
	require File::build_path(array("view","utilisateur","detail.php"));
}
if($boolAdmin) {
	require File::build_path(array("view","utilisateur","detail.php"));
}
?>