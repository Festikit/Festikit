<!DOCTYPE html>
<html lang="fr" xml:lang="fr">

<head>
	<title><?php echo $pagetitle; ?></title>
	<meta charset="utf-8">
	<!-- Materialize: Compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js">
	</script>

	<script>
		$(document).ready(function() {
			$('select').material_select();
		});
	</script>
</head>

<body class="grey lighten-3">
	<!-- HEADER -->
	<header>
		<nav>
			<div class="nav-wrapper grey">
				<a href="#" class="brand-logo">🎈</a>
				<ul id="nav-mobile" class="right hide-on-med-and-down">
					<li><a href="index.php?action=readAll">Accueil Utilisateur</a></li>
					<!-- ou: <li><a href="index.php?action=readAll&controller=utilisateur">Accueil Utilisateurs</a></li>-->
					<li><a href="index.php?action=readAll&controller=festival">Accueil Festival</a></li>
					<li><a href="index.php?action=create">Formulaire</a></li>
				</ul>
			</div>
		</nav>
	</header>


	<!-- BODY -->
	<?php
	$filepath = File::build_path(array("view", $controller, "$view.php"));
	require $filepath;
	?>

	<footer class="page-footer grey">
		<div class="container">
			<div class="row">
				<div class="col l6 s12">
					<h5 class="white-text">Footer Content</h5>
					<p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer
						content.
					</p>
				</div>
				<div class="col l4 offset-l2 s12">
					<h5 class="white-text">Links</h5>
					<ul>
						<li><a class="grey-text text-lighten-3" href="#!">Link 1</a></li>
						<li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
						<li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
						<li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="footer-copyright">
			<div class="container">
				© 2020 Festival - Bénévoles
				<a class="grey-text text-lighten-4 right" href="#!">More Links</a>
			</div>
		</div>
	</footer>
</body>

</html>