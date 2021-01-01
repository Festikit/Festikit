<!DOCTYPE html>
<html lang="fr" xml:lang="fr">

<head>
	<title>
		<?php echo $pagetitle; ?>
	</title>
	<meta charset="utf-8">
	<!-- Materialize: Compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js">
	</script>
	<link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
	<link rel="manifest" href="site.webmanifest">
	<link rel="mask-icon" href="safari-pinned-tab.svg" color="#d55b5d">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#fff8f8">
	<script>
		$(document).ready(function () {
			$('.sidenav').sidenav();
			$('.modal').modal();
		});

		/* Vérification Mot de passe */
		function checkPasswordOnSubmit() {
			var user_password1 = $("#user_password1").val();
			var user_password2 = $("#user_password2").val();
			if (user_password1.length < 6) {
				alert("Le mot de passe doit contenir au moins 6 caractères");
				return false;
			} else if (user_password1 != user_password2) {
				alert("Les mots de passe ne correpondent pas.");
				return false;
			} else {
				return true;
			}
		}

		function checkPasswordLength() {
			var user_password1 = $("#user_password1").val();
			var user_password2 = $("#user_password2").val();

			if (user_password1.length < 6) {
				$("#checkPasswordLength").html("Le mot de passe doit contenir au moins 6 caractères");
			} else {
				$("#checkPasswordLength").html("Mot de passe de bonne taille");
			}
		}

		$(document).ready(function () {
			$("#user_password1").keyup(checkPasswordLength);
		});

		function checkPasswordMatch() {
			var user_password1 = $("#user_password1").val();
			var user_password2 = $("#user_password2").val();

			if (user_password1 != user_password2)
				$("#checkPasswordMatch").html("Les mots de passe de correspondent pas !");
			else
				$("#checkPasswordMatch").html("Mots de passe identiques");
		}

		$(document).ready(function () {
			$("#user_password2").keyup(checkPasswordMatch);
		});
	</script>
	<style>
		main {
			padding-top: 10vh;
			padding-bottom: 10vh;
			min-height: 70vh;
			place-content: center;
			gap: 1ch;
		}
	</style>
</head>

<body>
	<!-- HEADER -->
	<header>
		<nav height="64px">
			<div class="nav-wrapper grey">
				<a href="#" class=""><img src="rakhi.svg" alt="icone du site" width="57px" height="57px"><span
						class="brand-logo">Festivanus</span></a>
				<a href="#" data-target="mobile-demo" class="sidenav-trigger right"><i
						class="material-icons">menu</i></a>
				<ul id="nav-mobile" class="right hide-on-med-and-down">
					<?php
					if (Session::is_admin()) {
						echo '
						<li><a href="index.php?action=readAll">Accueil Utilisateur</a></li>
						<li><a href="index.php?action=readAll&controller=festival">Accueil Festival</a></li>
						<li><a href="index.php?action=readAll&controller=responsable">Accueil Responsable</a></li>
						';
					}
					if (Session::is_responsable()) {
						echo '
						<li><a href="index.php?action=readAll&controller=festival">Accueil Festival</a></li>
						';
					}
					if (!Session::is_admin() && !Session::is_responsable()) {
						echo '
						<li><a href="index.php?action=readAll&controller=festival">Inscription</a></li>
						';
					}
					if (empty($_SESSION['login'])) {
						echo '
						
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=connect">Connexion</a>
                    </li>
                    ';
					} else {
						echo '
						<li class="nav-item">
							<a class="nav-link" href="index.php?action=read&user_id=' . $_SESSION['login'] . '">Votre Compte</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="index.php?action=deconnect">Déconnexion</a>
						</li>';
					}
					?>
				</ul>
			</div>
		</nav>

		<ul class="sidenav" id="mobile-demo">
			<?php
			if (Session::is_admin()) {
				echo '
						<li><a href="index.php?action=readAll">Accueil Utilisateur</a></li>
						<li><a href="index.php?action=readAll&controller=festival">Accueil Festival</a></li>
						<li><a href="index.php?action=readAll&controller=responsable">Accueil Responsable</a></li>
						';
			}
			if (Session::is_responsable()) {
				echo '
						<li><a href="index.php?action=readAll&controller=festival">Accueil Festival</a></li>
						';
			}
			if (!Session::is_admin() && !Session::is_responsable()) {
				echo '
						<li><a href="index.php?action=readAll&controller=festival">Inscription</a></li>
						';
			}
			if (empty($_SESSION['login'])) {
				echo '
						
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=connect">Connexion</a>
                    </li>
                    ';
			} else {
				echo '
						<li class="nav-item">
							<a class="nav-link" href="index.php?action=read&user_id=' . $_SESSION['login'] . '">Votre Compte</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="index.php?action=deconnect">Déconnexion</a>
						</li>';
			}
			?>
		</ul>
	</header>

	<main>
		<!-- BODY -->
		<?php
		$filepath = File::build_path(array("view", $controller, "$view.php"));
		require $filepath;
		?>
	</main>

	<footer class="page-footer grey">
		<div class="container">
			<div class="row">
				<div class="col l6 s12">
					<h5 class="white-text">Besoin d'aider ? Contactez-nous !</h5>
					<p class="grey-text text-lighten-4">
					<h6>
						mail : <a class="grey-text text-lighten-2"
							href="mailto:mathieu.soysal+aidefestival@outlook.fr">support@GestionnaireFestival.fr</a>
					</h6>
					<h6>
						tel : <a class="grey-text text-lighten-2" href="tel:+33652600110">065260001</a>
					</h6>
					</p>
				</div>
				<div class="col l4 offset-l2 s12">
					<h5 class="white-text">Partager</h5>
					<ul>
						<li> <a href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fbenevoles.herokuapp.com"
								data-rel="popup" rel="nofollow" title="Partager sur Facebook" role="button"
								aria-label="Partager sur Facebook"><span class="fab fa-facebook-f"></span><span
									class="grey-text text-lighten-3">Facebook</span></a></li>
						<li><a href="https://twitter.com/intent/tweet?text=Gestionnaire%20de%20festival%20en%20ligne&amp;url=https%3A%2F%2Fbenevoles.herokuapp.com"
								data-rel="popup" rel="nofollow" title="Partager sur Twitter" role="button"
								aria-label="Partager sur Twitter"><span class="fab fa-twitter"></span><span
									class="grey-text text-lighten-3">Tweeter</span></a></li>
						<li><a href="https://www.linkedin.com/shareArticle?mini=true&amp;summary=Un%20moyen%20simple%20et%20efficace%20de%20faciliter%20la%20collecte%20des%20informations%20personnelles%2C%20des%20disponibilit%C3%A9s%20et%20des%20pr%C3%A9f%C3%A9rences%20de%20poste%20de%20chacun%20des%20b%C3%A9n%C3%A9voles.&amp;title=Gestionnaire%20de%20festival%20en%20ligne&amp;url=https%3A%2F%2Fbenevoles.herokuapp.com"
								data-rel="popup" rel="nofollow" title="Partager sur LinkedIn" role="button"
								aria-label="Partager sur LinkedIn"><span class="fab fa-linkedin-in"></span><span
									class="grey-text text-lighten-3">LinkedIn</span></a></li>
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