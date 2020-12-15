<div class="container">
    <div class="row">
        <div class="col s6">
            <?php
            // Détail les informations d'un utilisateur
            $user_id = htmlspecialchars($u->getId());
            $user_firstname = htmlspecialchars($u->getFirstname());
            $user_lastname =  htmlspecialchars($u->getLastname());
            $user_mail = htmlspecialchars($u->getMail());
            $user_phone = htmlspecialchars($u->getPhone());
            $user_birthdate = htmlspecialchars($u->getBirthdate());
            $user_postal_code = htmlspecialchars($u->getPostalCode());
            if($u->getDrivingLicense() == 1) {
                $user_driving_license = "oui";
            } else {
                $user_driving_license = "non";
            }
            $user_picture = $u->getPicture();

            echo "<h5> $user_firstname $user_lastname </h5>
            <p>Adresse mail: $user_mail </br>
            Téléphone: $user_phone </br>
            Date de naissance: $user_birthdate </br>
            Adresse postale: $user_postal_code </br>
            Permis de conduire: $user_driving_license </br>";
            ?>
        </div>

        <div class="col s6">
            <?php
            $picture = ModelUtilisateur::generatorPicture($user_id);
            echo '<img src="data:image/jpg;base64,' . base64_encode($picture->getPicture()) . '" width="200px"/>';
            ?>
        </div>
        
        <div class="col s12">
            <?php
            echo '<p><a class="btn waves-effect waves-light" href="index.php?action=delete&user_id=' . rawurlencode($user_id) . '">Supprimer utilisateur</a>  ';
            echo '<a class="btn waves-effect waves-light" href="index.php?action=update&user_id=' . rawurlencode($user_id) . '">Modifier utilisateur</a></p>';
            ?>
        </div>        
    </div>
</div>

    <!-- Affichage des festivals où l'utilisateur est bénévole -->
    <ul class="collection">
        <li class="collection-header">
            <h4>Liste des festivales en tant que bénévole:</h4>
        </li>
    <?php

    if(empty($tab_festivalWhereAccepted)) {
        echo "Il n'y a pas encore de festival.";
    } else {
        foreach ($tab_festivalWhereAccepted as $f) {
            echo "
            <li class=\"collection-item avatar\">
                <a href=\"index.php?action=read&controller=festival&festival_id=" . rawurlencode($f->getFestivalId()) . "\">" . htmlspecialchars($f->getFestivalName()) . "</a>
                <div class=\"secondary-content\">
                    <a title=\"en savoir plus\" href=\"index.php?action=read&controller=festival&festival_id=" . rawurlencode($f->getFestivalId()) . "\" class=\"btn\"><i class=\"material-icons\">more</i></a>
                </div>
            </li>";
        }
    }
    ?>
    </ul>

    <!-- Affichage des festivals où l'utilisateur est candidat -->
    <ul class="collection">
        <li class="collection-header">
            <h4>Liste des festivales en tant que candidature:</h4>
        </li>
    <?php
    if(empty($tab_festivalWhereCandidat)) {
        echo "Il n'y a pas de candidature.</br>";
    } else {
        foreach ($tab_festivalWhereCandidat as $c) {
            echo "
            <li class=\"collection-item avatar\">
            <a href=\"index.php?action=read&controller=festival&festival_id=" . rawurlencode($c->getFestivalId()) . "\">" . htmlspecialchars($c->getFestivalName()) . "</a>
                <div class=\"secondary-content\">
                    <a title=\"en savoir plus\" href=\"index.php?action=read&controller=festival&festival_id=" . rawurlencode($c->getFestivalId()) . "\" class=\"btn\"><i class=\"material-icons\">more</i></a>
                </div>
            </li>";
        }
    }
    ?>
    </ul>
