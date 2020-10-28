<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $pagetitle; ?></title>
    </head>
    <body>
    	<!-- HEADER -->
    	<nav>
    		<ul>
    			<li><a href="index.php?action=readAll">Accueil Utilisateur</a></li>
                <!-- ou: 
    			<li><a href="index.php?action=readAll&controller=utilisateur">Accueil Utilisateurs</a></li>
                -->
    		</ul>
    	</nav>

    	<!-- BODY -->
		<?php
		$filepath = File::build_path(array("view", $controller, "$view.php"));
		require $filepath;
		?>

	<!-- FOOTER -->
	<p>
  		Footer, en cours...
	</p>
    </body>
</html>