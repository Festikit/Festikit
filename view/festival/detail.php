<?php

// Détail les informations d'un festival

/* TODO : Récupérer les autres informations des festivals via les getters */

echo "<h2 class=\"flow-text center\"> Festival " . htmlspecialchars($f->getFestivalName()) . "</h2>";
?>
<div class="row">
    <form class="col s12">
        <div class="row">
            <div class="input-field col s12">
                <?php
                $festival_description = $f->getFestivalDescription();
                echo "<textarea name=\"festival_description\" id=\"festival_description\" class=\"materialize-textarea\" readonly>$festival_description</textarea>" ?>
                <label for="festival_description">Description</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix">insert_invitation</i>
                <?php
                $festival_startdate = rawurlencode($f->getFestivalStartDate());
                echo "<input id=\"festival_startdate\" value=\"$festival_startdate\" type=\"date\" class=\"validate\" readonly>" ?>
                <label for="festival_startdate" class="active">Début du festival</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix">insert_invitation</i>
                <?php
                $festival_enddate = rawurlencode($f->getFestivalEndDate());
                echo "<input id=\"festival_enddate\" value=\"$festival_enddate\" type=\"date\" class=\"validate\" readonly>" ?>
                <label for="festival_enddate" class="active">Fin du festival</label>
            </div>
        </div>
    </form>
</div>

<ul class="collection">
    <li class="collection-header">
        <a class="btn-large waves-effect waves-light secondary-content" href="index.php?action=read&controller=poste&poste_id=$poste_id"> Ajouter un poste</a>
        <h4 class="center">Liste des postes</h4>
    </li>
    <?php
    $i = 1;
    foreach ($tab_poste as $p) {
        $poste_name = htmlspecialchars($p->getPosteName());
        $poste_description = htmlspecialchars($p->getPosteDescription());
        $poste_id = $p->getPosteId();
        echo "<li class=\"collection-item avatar\">
        <span class=\"title\"> <a href=\"index.php?action=read&controller=poste&poste_id=$poste_id\"> $poste_name</a> </span>
        <p> $poste_description </p>
		<div class=\"secondary-content\">
            <a title=\"en savoir plus\" href=\"index.php?action=read&controller=poste&poste_id=$poste_id\" class=\"btn\"><i class=\"material-icons\">more</i></a>
            <a title=\"modifier\" href=\"#!\" class=\"btn\"><i class=\"material-icons\">edit</i></a>
		</div>
	</li>";
        $i++;
>>>>>>> 36254d01bb8d7cf3e5aa21dc830d17ed1e012ff0
    }
    ?>
</ul>
<div class="row">
    <ul class="collection col s12 m12 l6">
        <li class="collection-header">
            <h4>Liste des bénévoles</h4>
        </li>
        <?php
        if (empty($tab_benevoleAccepted)) {
            echo "Il n'y a pas encore de bénévoles pour ce festival.</br>";
        } else {
            $i = 1;
            foreach ($tab_benevoleAccepted as $b) {
                $festival_id = rawurlencode($f->getFestivalId());
                $user_id = rawurlencode($b->getId());
                $user_firstname = htmlspecialchars($b->getFirstname());
                $user_lastname = htmlspecialchars($b->getLastname());
                echo "<li class=\"collection-item avatar\">
                <div class=\"circle green\">
                </div>
                <span class=\"title\">$user_firstname</span>
                <p>$user_lastname
                </p>
                <div class=\"secondary-content\">
                    <a title=\"en savoir plus\" href=\"index.php?action=read&user_id=$user_id\" class=\"btn\"><i class=\"material-icons\">more</i></a>
                    <a title=\"supprimer\" href=\"index.php?action=delete&user_id=$user_id\" class=\"btn\"><i class=\"material-icons\">delete</i></a>
                    <a title=\"refuser\" href=\"index.php?action=refuserUtilisateur&controller=festival&user_id=$user_id&festival_id=$festival_id\" class=\"btn\">Refuser</a>
                </div>
            </li>";
                $i++;
            }
        }
        ?>
    </ul>
    <ul class="collection col s12 m12 l6">
        <li class="collection-header">
            <h4>Liste des candidats</h4>
        </li>
        <?php
        if (empty($tab_candidature)) {
            echo "Il n'y a pas de candidature pour ce festival.</br>";
        } else {
            $i = 1;
            foreach ($tab_candidature as $c) {
                $festival_id = rawurlencode($f->getFestivalId());
                $user_id = rawurlencode($c->getId());
                $user_firstname = htmlspecialchars($c->getFirstname());
                $user_lastname = htmlspecialchars($c->getLastname());
                echo "<li class=\"collection-item avatar\">
                <div class=\"circle green\">
                </div>
                <span class=\"title\">$user_firstname</span>
                <p>$user_lastname
                </p>
                <div class=\"secondary-content\">
                    <a title=\"en savoir plus\" href=\"index.php?action=read&user_id=$user_id\" class=\"btn\"><i class=\"material-icons\">more</i></a>
                    <a title=\"supprimer\" href=\"index.php?action=delete&user_id=$user_id\" class=\"btn\"><i class=\"material-icons\">delete</i></a>
                    <a title=\"accepter\" href=\"index.php?action=accepterUtilisateur&controller=festival&user_id=$user_id&festival_id=$festival_id\" class=\"btn\">Accepter</a>
                </div>
            </li>";
                $i++;
            }
        }
        ?>
    </ul>
</div>

<?php


echo "<p> Retour: <a href=\"index.php?action=readAll&controller=festival\">Cliquez ici </a> </p>";
