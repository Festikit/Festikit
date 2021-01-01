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
            if ($u->getDrivingLicense() == 1) {
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
            echo '<img alt="photo de profil" src="data:image/jpg;base64,' . base64_encode($user_picture) . '" onerror="this.onerror=null; this.src=\'data:image/png;base64,' . base64_encode($user_picture) . '\'" width="200px"/>';
            ?>
        </div>

        <div class="col s12">
            <?php
            echo "<p><a class=\"btn waves-effect waves-light modal-trigger\" href=\"#confirmation$user_id\">Supprimer utilisateur</a>  ";
            echo "<a class=\"btn waves-effect waves-light\" href=\"index.php?action=update&user_id=$user_id\">Modifier utilisateur</a></p>";
            echo "
        <div id=\"confirmation$user_id\" class=\"modal\">
            <div class=\"modal-content\">
                <h4>Êtes vous sûr de vouloir le supprimer ?</h4>
                <p>Cette action sera irréversible.</p>
            </div>
            <div class=\"modal-footer\">
                <a href=\"#!\" class=\"modal-close waves-effect waves-green btn-flat\">Annuler</a>
                <a href=\"index.php?action=delete&user_id=$user_id\" class=\"btn red modal-close waves-effect waves-green btn-flat\">Supprimer</a>
            </div>
        </div>
            ";
            ?>
        </div>
    </div>
</div>

<!-- Affichage des festivals où l'utilisateur est le créateur -->
<?php if ($boolAdmin) { ?>
    <ul class="collection">
        <li class="collection-header">
            <h4>Liste des festivals en tant que créateur</h4>
        </li>
    <?php

    if (empty($tab_festivalWhereCreateur)) {
        echo "Vous n'êtes créateur d'aucun festival.";
    } else {
        foreach ($tab_festivalWhereCreateur as $f) {
            echo "
                <li class=\"collection-item avatar\">
                    <a href=\"index.php?action=read&controller=festival&festival_id=" . rawurlencode($f->getFestivalId()) . "\">" . htmlspecialchars($f->getFestivalName()) . "</a>
                    <div class=\"secondary-content\">
                        <a title=\"en savoir plus\" href=\"index.php?action=read&controller=festival&festival_id=" . rawurlencode($f->getFestivalId()) . "\" class=\"btn\"><i class=\"material-icons\">more</i></a>
                    </div>
                </li>";
        }
    }
    echo "</ul>";
}
    ?>


    <!-- Affichage des festivals où l'utilisateur est responsable -->
    <?php if ($boolResponsable) { ?>
        <ul class="collection">
            <li class="collection-header">
                <h4>Liste des festivals en tant que responsable</h4>
            </li>
        <?php

        if (empty($tab_festivalWhereResponsable)) {
            echo "Vous n'êtes responsable d'aucun festival.";
        } else {
            foreach ($tab_festivalWhereResponsable as $f) {
                echo "
                <li class=\"collection-item avatar\">
                    <a href=\"index.php?action=read&controller=festival&festival_id=" . rawurlencode($f->getFestivalId()) . "\">" . htmlspecialchars($f->getFestivalName()) . "</a>
                    <div class=\"secondary-content\">
                        <a title=\"en savoir plus\" href=\"index.php?action=read&controller=festival&festival_id=" . rawurlencode($f->getFestivalId()) . "\" class=\"btn\"><i class=\"material-icons\">more</i></a>
                    </div>
                </li>";
            }
        }
        echo "</ul>";
    }
        ?>

        <!-- Affichage des festivals où l'utilisateur est bénévole -->
        <?php if ($boolResponsable || $boolBenevole) { ?>
            <ul class="collection">
                <li class="collection-header">
                    <h4>Liste des festivals en tant que bénévole</h4>
                </li>
            <?php

            if (empty($tab_festivalWhereAccepted)) {
                echo "Il n'y a pas encore de festival.";
            } else {
                foreach ($tab_festivalWhereAccepted as $f) {
                    if ($boolResponsable) {
                        echo "
                    <li class=\"collection-item avatar\">
                        <a href=\"index.php?action=read&controller=festival&festival_id=" . rawurlencode($f->getFestivalId()) . "\">" . htmlspecialchars($f->getFestivalName()) . "</a>
                        <div class=\"secondary-content\">
                            <a title=\"en savoir plus\" href=\"index.php?action=read&controller=festival&festival_id=" . rawurlencode($f->getFestivalId()) . "\" class=\"btn\"><i class=\"material-icons\">more</i></a>
                        </div>
                    </li>";
                    }
                    if ($boolBenevole) {
                        echo "
                    <li class=\"collection-item avatar\">
                        <a href=\"index.php?action=readForUser&controller=festival&festival_id=" . rawurlencode($f->getFestivalId()) . "\">" . htmlspecialchars($f->getFestivalName()) . "</a>
                        <div class=\"secondary-content\">
                            <a title=\"en savoir plus\" href=\"index.php?action=readForUser&controller=festival&festival_id=" . rawurlencode($f->getFestivalId()) . "\" class=\"btn\"><i class=\"material-icons\">more</i></a>
                        </div>
                    </li>";
                    }
                }
            }
            echo "</ul>";
        }
            ?>

            <!-- Affichage des festivals où l'utilisateur est candidat -->
            <?php if ($boolResponsable || $boolBenevole) { ?>
                <ul class="collection">
                    <li class="collection-header">
                        <h4>Liste des festivals en tant que candidat</h4>
                    </li>
                <?php
                if (empty($tab_festivalWhereCandidat)) {
                    echo "Il n'y a pas de candidature.</br>";
                } else {
                    foreach ($tab_festivalWhereCandidat as $c) {
                        $festival_id = rawurlencode($c->getFestivalId());
                        $festival_name = $c->getFestivalName();
                        if ($boolResponsable) {
                            echo "
                    <li class=\"collection-item avatar\">
                    <a href=\"index.php?action=read&controller=festival&festival_id=$festival_id\">$festival_name</a>
                        <div class=\"secondary-content\">
                            <a title=\"en savoir plus\" href=\"index.php?action=read&controller=festival&festival_id=$festival_id\" class=\"btn\"><i class=\"material-icons\">more</i></a>
                            <a title=\"supprimer\" href=\"#confirmation$festival_id\" class=\"btn modal-trigger\"><i class=\"material-icons\">delete</i></a>
                        </div>
                    </li>";
                        }
                        if ($boolBenevole) {
                            echo "
                    <li class=\"collection-item avatar\">
                    <a href=\"index.php?action=readForUser&controller=festival&festival_id=$festival_id\">$festival_name</a>
                        <div class=\"secondary-content\">
                            <a title=\"en savoir plus\" href=\"index.php?action=readForUser&controller=festival&festival_id=$festival_id\" class=\"btn\"><i class=\"material-icons\">more</i></a>
                            <a title=\"supprimer\" href=\"#confirmation$festival_id\" class=\"btn modal-trigger\"><i class=\"material-icons\">delete</i></a>
                        </div>
                    </li>";
                        }
                        echo "
            <div id=\"confirmation$festival_id\" class=\"modal\">
                <div class=\"modal-content\">
                    <h4>Êtes vous sûr de vouloir le supprimer ?</h4>
                    <p>Cette action serat irréversible.</p>
                </div>
                <div class=\"modal-footer\">
                    <a href=\"#!\" class=\"modal-close waves-effect waves-green btn-flat\">Annuler</a>
                    <a href=\"index.php?action=delete&controller=postuler&user_id=$user_id&festival_id=$festival_id\" class=\"btn red modal-close waves-effect waves-green btn-flat\">Supprimer</a>
                </div>
            </div>
                ";
                    }
                }
                echo "</ul>";
            }
                ?>