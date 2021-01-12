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
            echo '<img src="data:image/jpg;base64,' . base64_encode($user_picture) . '" onerror="this.onerror=null; this.src=\'data:image/png;base64,' . base64_encode($user_picture) . '\'" width="200px"/>';
            ?>
        </div>

        <div class="col s6">
        <?php
        //Detail les informations de la table postuler  
        
        $postuler_id = htmlspecialchars($tab_postuler->getPostulerId());
        $p = ModelPostuler::select($postuler_id);
        $venir_avec_vehicule = htmlspecialchars($p->getVenirAvecVehicule());
        $besoin_hebergement = htmlspecialchars($p->getBesoinHebergement());
        $peut_heberger = htmlspecialchars($p->getPeutHeberger());
        $configuration_couchage = htmlspecialchars($p->getConfigurationCouchage());
        $arrivee_festival = htmlspecialchars($p->getArriveeFestival());
        $depart_festival = htmlspecialchars($p->getDepartFestival());
        $autres_dispos = htmlspecialchars($p->getAutresDispos());
        $experience = htmlspecialchars($p->getExperience());
        
        echo "<p>Vient avec un véhicule : "; if ($venir_avec_vehicule == 1){echo "Non";}
            else{echo "Oui";} echo "</br>
            Besoin d'un hébergement : "; if ($besoin_hebergement == 0){echo "Non";}
            else{echo "Oui";} echo "</br>
            Peut héberger : "; if ($peut_heberger == 0){echo "Non";}
            else{echo "Oui </br> Configuration de couchage : $configuration_couchage";} echo "</br>
            
            Date d'arrivée au festival : $arrivee_festival </br>
            Date de départ du festival : $depart_festival </br>
            Autres disponibilités : $autres_dispos </br>
            A déjà participé à ce festival : "; if ($experience == 0){echo "Non";}
            else{echo "Oui";} echo "</br>
            ";
                       
        
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
        <h4>Liste des festivals en tant que bénévole</h4>
    </li>
    <?php

    if (empty($tab_festivalWhereAccepted)) {
        echo "Il n'y a pas encore de festival.";
    } else {
        foreach ($tab_festivalWhereAccepted as $f) {
            echo "
            <li class=\"collection-item avatar\">
                <a href=\"index.php?action=readForUser&controller=festival&festival_id=" . rawurlencode($f->getFestivalId()) . "\">" . htmlspecialchars($f->getFestivalName()) . "</a>
                <div class=\"secondary-content\">
                    <a title=\"en savoir plus\" href=\"index.php?action=readForUser&controller=festival&festival_id=" . rawurlencode($f->getFestivalId()) . "\" class=\"btn\"><i class=\"material-icons\">more</i></a>
                </div>
            </li>";
        }
    }
    ?>
</ul>

<!-- Affichage des festivals où l'utilisateur est candidat -->
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
            echo "
            <li class=\"collection-item avatar\">
            <a href=\"index.php?action=readForUser&controller=festival&festival_id=\"$festival_id\"\>$festival_name</a>
                <div class=\"secondary-content\">
                    <a title=\"en savoir plus\" href=\"index.php?action=readForUser&controller=festival&festival_id=\"$festival_id\" class=\"btn\"><i class=\"material-icons\">more</i></a>
                    <a title=\"annuler la candidature\" href=\"#confirmation$festival_id\" class=\"btn modal-trigger\"><i class=\"material-icons\">delete</i></a>
                </div>
                <div id=\"confirmation$festival_id\" class=\"modal\">
                <div class=\"modal-content\">
                    <h4>Êtes vous sûr de vouloir le supprimer ?</h4>
                    <p>Cette action sera irréversible.</p>
                </div>
                <div class=\"modal-footer\">
                    <a href=\"#!\" class=\"modal-close waves-effect waves-green btn-flat\">Annuler</a>
                    <a href=\"index.php?action=delete&controller=postuler&user_id=\"$user_id\"&festival_id=\"$festival_id\" class=\"btn red modal-close waves-effect waves-green btn-flat\">Supprimer</a>
                </div>
            </div>
            </li>";
        }
    }
    ?>
</ul>
