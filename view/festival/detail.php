<?php

//---------- recupération des infos ----------//
// HTML
$festival_idHTML = htmlspecialchars($f->get("festival_id"));
$nameHTML = htmlspecialchars($f->get("festival_name"));
$startdateHTML = htmlspecialchars($f->get("festival_startdate"));
$enddateHTML = htmlspecialchars($f->get("festival_enddate"));
$descriptionHTML = htmlspecialchars($f->get("festival_description"));
$cityHTML = htmlspecialchars($f->get("city"));
$creatorHTML = htmlspecialchars($f->get("user_id"));
// URL
$festival_idURL = rawurldecode($f->get("festival_id"));
$nameURL = rawurldecode($f->get("festival_name"));
$startdateURL = rawurldecode($f->get("festival_startdate"));
$enddateURL = rawurldecode($f->get("festival_enddate"));
$descriptionURL = rawurldecode($f->get("festival_description"));
$cityURL = rawurldecode($f->get("city"));
$creatorURL = rawurldecode($f->get("user_id"));


// Détail les informations d'un festival

echo "<h2 class=\"flow-text center\"> Festival " . $nameHTML . "</h2>";
?>
<a class="btn-large waves-effect waves-light secondary-content" href="<?php echo "index.php?action=update&controller=festival&festival_id=$festival_idURL&festival_name=$nameURL&festival_startdate=$startdateURL
&festival_enddate=$enddateURL&festival_description=$descriptionURL&city=$cityURL" ?>"> Modifier ce festival</a>


<div class="row">
    <form class="col s12">
        <div class="row">
            <div class="input-field col s12">
                <?php
                $user_firstname = htmlspecialchars($createur->getFirstname());
                $user_lastname = htmlspecialchars($createur->getLastname());
                echo "<textarea name=\"festival_createur\" id=\"festival_createur\" class=\"materialize-textarea\" readonly>$user_firstname $user_lastname</textarea>" 
                ?>
                <label for="festival_createur">Créateur</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <?php
                $festival_description = $f->getFestivalDescription();
                $festival_id = htmlspecialchars($f->getFestivalId());
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
        <a class="btn-large waves-effect waves-light secondary-content" href="index.php?action=create&controller=poste&festival_id=<?php echo $festival_id ?>"> Ajouter un poste</a>
        <h4 class="center">Liste des postes</h4>
    </li>
    <?php
    if (empty($tab_poste)) {
        echo "Il n'y a pas encore de postes pour ce festival.</br>";
    } else {
        $i = 1;
        foreach ($tab_poste as $p) {
            $poste_name = htmlspecialchars($p->getPosteName());
            $poste_description = htmlspecialchars($p->getPosteDescription());
            $poste_id = $p->getPosteId();
            if($poste_name == 'Generique'){
                echo "";
            }
            else {
                echo "<li class=\"collection-item avatar\">
                <span class=\"title\"> <a href=\"index.php?action=read&controller=poste&poste_id=$poste_id\"> $poste_name</a> </span>
                <p> $poste_description </p>
                <div class=\"secondary-content\">
                    <a title=\"en savoir plus\" href=\"index.php?action=read&controller=poste&poste_id=$poste_id\" class=\"btn\"><i class=\"material-icons\">more</i></a>
                    <a title=\"modifier\" href=\"index.php?action=update&controller=poste&poste_id=$poste_id\" class=\"btn\"><i class=\"material-icons\">edit</i></a>
                </div>
                </li>";
            }
            
            $i++;
        }
    }
    ?>
</ul>

<ul class="collection">
    <li class="collection-header">
        <a class="btn-large waves-effect waves-light secondary-content" href="index.php?action=updateGen&controller=creneau&festival_id=<?php echo $festival_id; ?>"> Modifier ces creneaux</a>
        <h4 class="center">Créneaux génériques du festival</h4>
    </li>
    <?php
    $festivalGenerique = $_GET['festival_id'];
    $compteur = 1;
    if (ModelFestival::getCreneauxGeneriquesDate($festivalGenerique)) {
        foreach (ModelFestival::getCreneauxGeneriquesDate($festivalGenerique) as $creneau_de_date_courant) { ?>
            <table>
                <tr>
                    <th id=""><label for="dispo_date1">jour n°<?php echo $compteur ?></label></th>

                    <?php
                    // Affichage dynamique des heures correspondant aux créneaux génériques
                    
                    $compteurCreneauxHeure = 0;
                    $date_depart_creneau_courant = $creneau_de_date_courant->getCreneauStart();

                    if (ModelFestival::getCreneauxGeneriquesHeureByJour($festivalGenerique, $date_depart_creneau_courant)) {
                        foreach (ModelFestival::getCreneauxGeneriquesHeureByJour($festivalGenerique, $date_depart_creneau_courant) as $h) {
                            $cStart = $h->getCreneauStart();
                            $cEnd = $h->getCreneauEnd();
                            //cr début
                            $cStart = $cStart . "";
                            $cStartmod = substr($cStart, 0, -3);
                            //cr fin
                            $cEnd = $cEnd . "";
                            $cEndmod = substr($cEnd, 0, -3);

                            echo "<th id=\"\"><label for=\"dispo_heure$compteurCreneauxHeure\">" . $cStartmod . " " . $cEndmod . "</label></th>";

                            $compteurCreneauxHeure++;
                        }
                    } else echo "<th><i> Le festival n'a pas encore de créneaux </i></th>";
                    ?>
                </tr>

        <?php
            // Affichage dynamique des jours de festival (Les dates des créneaux génériques sans doublons)
            $numCreneauHeure = 1;

            echo "
            <tr>
            <td class=\"firstColumn\"><label for=\"date_$numCreneauHeure\">$date_depart_creneau_courant</label></td>
            ";

            if (ModelFestival::getCreneauxGeneriquesHeureByJour($festivalGenerique, $date_depart_creneau_courant)) {
                foreach (ModelFestival::getCreneauxGeneriquesHeureByJour($festivalGenerique, $date_depart_creneau_courant) as $h) {
                    $cStart = $h->getCreneauStart();
                    $cEnd = $h->getCreneauEnd();
                    echo "<td><label><i class=\"material-icons\" name=\"dispo_heure$cStart" . "_$cEnd"  . "date_$date_depart_creneau_courant\" 
                    id=\"dispo_heure$compteur" . "date_$date_depart_creneau_courant\">check</i><span> </span></label></td>";
                }
            } else echo "<td><i> Il n'y a donc rien à afficher ici.. </i></td>";
            echo "</tr>";
            echo "</br>";
            $compteur++;
        }
    } else echo "<td><i> Vous n'avez encore ajouté aucun jour à votre festival.. </i></td>";
        ?>
            </table>
</ul>

<?php /*?>
<ul class="collection">
    <li class="collection-header">
        <a class="btn-large waves-effect waves-light secondary-content" href="index.php?action=createGen&controller=creneau&festival_id=<?php echo $festival_id; ?>"> Ajouter un creneau</a>
        <h4 class="center">Liste des creneaux</h4>
    </li>
    <?php
    if (empty($tab_creneau_gen)) {
        echo "Il n'y a pas encore de créneaux génériques pour ce festival.</br>";
    } else {
        $i = 1;
        foreach ($tab_creneau_gen as $cg) {
            $c = ModelCreneau::select($cg);
            $creneau_id = htmlspecialchars($c->getCreneauId());
            $creneau_startdate = htmlspecialchars($c->getCreneauStart());
            $creneau_enddate = $c->getCreneauEnd();
            echo "<li class=\"collection-item avatar\">
                <span class=\"title\"> <a href=\"index.php?action=read&controller=creneau&creneau_id=$creneau_id\">Créneau $creneau_id</a> </span>
                <p>Début: $creneau_startdate</p>
                <p>Fin: $creneau_enddate</p>
                <div class=\"secondary-content\">
                    <a title=\"en savoir plus\" href=\"index.php?action=read&controller=creneau&creneau_id=$creneau_id\" class=\"btn\"><i class=\"material-icons\">more</i></a>
                    <a title=\"modifier\" href=\"index.php?action=update&controller=creneau&creneau_id=$creneau_id\" class=\"btn\"><i class=\"material-icons\">edit</i></a>
                </div>
            </li>";
            $i++;
        }

        /*
        $creneau = ModelCreneau::select($tab_creneau_gen[0]);
        $deb = $creneau->getCreneauStart();
        $fin = $creneau->getCreneauEnd();
        
        
        $deb = $deb."";
        $modif = substr($deb, 4);
        $deb_gen = 2020 . "$modif";
        
        $date_debut = date('Y-m-d H:i:s', strtotime("$deb_gen"));
        echo "$date_debut"; 
        
    }
    ?>
</ul>*/ ?>



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
                $user_picture = $b->getPicture();
                echo '<li class="collection-item avatar">
        <img src="data:image/jpg;base64,' . base64_encode($user_picture) . '" onerror="this.onerror=null; this.src=\'data:image/png;base64,' . base64_encode($user_picture) . '\'" width="70px"/>';
                echo "<span class=\"title\">$user_firstname</span>
                <p>$user_lastname
                </p>
                <div class=\"secondary-content\">
                    <a title=\"en savoir plus\" href=\"index.php?action=read&user_id=$user_id\" class=\"btn\"><i class=\"material-icons\">more</i></a>
                    <a title=\"supprimer\" href=\"index.php?action=delete&user_id=$user_id\" class=\"btn\"><i class=\"material-icons\">delete</i></a>
                    <a title=\"refuser\" href=\"index.php?action=refuserUtilisateur&controller=festival&user_id=$user_id&festival_id=$festival_id\" class=\"btn\">Refuser</a>
                    <a title=\"Assigner en tant que responsable\" href=\"index.php?action=ajouterResponsable&controller=festival&user_id=$user_id&festival_id=$festival_id\" class=\"btn\">assigner</a>
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
                $user_picture = $c->getPicture();
                echo '<li class="collection-item avatar">
        <img src="data:image/jpg;base64,' . base64_encode($user_picture) . '" onerror="this.onerror=null; this.src=\'data:image/png;base64,' . base64_encode($user_picture) . '\'" width="70px"/>';
                echo "<span class=\"title\">$user_firstname</span>
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
if (!$boolResponsable) {
?>
    <div class="row">
        <ul class="collection col s12 m12 l6">
            <li class="collection-header">
                <h4>Liste des responsables</h4>
            </li>
            <?php

            if (empty($tab_responsable)) {
                echo "Il n'y a pas encore de responsable pour ce festival.</br>";
            } else {
                $i = 1;
                foreach ($tab_responsable as $r) {
                    $festival_id = rawurlencode($f->getFestivalId());
                    $user_id = rawurlencode($r->getResponsableId());
                    $user_firstname = rawurlencode($r->getUserFirstname());
                    $user_lastname = rawurlencode($r->getUserLastName());
                    $user_picture = $r->getPicture();
                    echo '<li class="collection-item avatar">
        <img src="data:image/jpg;base64,' . base64_encode($user_picture) . '" onerror="this.onerror=null; this.src=\'data:image/png;base64,' . base64_encode($user_picture) . '\'" width="70px"/>';
                    echo "<span class=\"title\">$user_firstname</span>
                <p>$user_lastname
                </p>
                <div class=\"secondary-content\">
                    <a title=\"en savoir plus\" href=\"index.php?action=read&user_id=$user_id\" class=\"btn\"><i class=\"material-icons\">more</i></a>
                    <a title=\"Désassigner\" href=\"index.php?action=desassignerResponsable&controller=festival&user_id=$user_id&festival_id=$festival_id\" class=\"btn\">Désassigner</a>
                </div>
                
            </li>";
                    $i++;
                }
            }
            ?>
        </ul>
    </div>
<?php
}
