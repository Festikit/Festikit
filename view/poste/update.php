<div class="row">
    <div class="col s12 m10 offset-m1 l8 offset-l2">
        <?php
        if (!($log_p == "" && $poste_name == "" && $poste_description == "")) {
            $log_p = htmlspecialchars($tab_p->getPosteId());
            $poste_name = htmlspecialchars($tab_p->getPosteName());
            $poste_description = htmlspecialchars($tab_p->getPosteDescription());
            $festival_id = htmlspecialchars($tab_p->getFestivalId());
        }
        ?>

        <div class="card-panel col s12 grey lighten-4">
            <form method="get" action="index.php?action=updated&controller=poste">
                <h5 class="center-align">Modifier ce poste</h5>
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">Nom</i>
                        <?php echo '<input name="poste_name" id="poste_name" type="text" value="' . $poste_name . '" required>'; ?>
                        <label class="active" for="poste_name">Nom</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">description</i>
                        <?php echo '<input name="poste_description" id="poste_description" type="text" value="' . $poste_description . '" class="validate" required>'; ?>
                        <label class="active" for="poste_description">description</label>
                    </div>
                </div>
                <div class="row">
                    <?php echo " <input type=\"hidden\" name=\"poste_id\" value=\"$log_p\">"; ?>
                    <input type="hidden" name="action" value="updated">
                    <input type="hidden" name="controller" value="poste">
                    <input class="btn col s12 m4 offset-m4 l4 offset-l4" type="submit" value="Modifier" />
                </div>
        </div>
    </div>
    </form>
</div>
<ul class="collection">
    <li class="collection-header">
        <?php echo "<a class=\"btn-large waves-effect waves-light secondary-content\" href=\"index.php?action=create&controller=creneau&poste_id=$log_p&festival_id=$festival_id\"> Ajouter un creneau</a>"; ?>
        <h4 class="center">Liste des creneaux</h4>
    </li>
   
    <?php
    $posteCour = $_GET['poste_id'];
    $compteur = 1;
    if (ModelCreneau::getCreneauxDateByPosteId($posteCour)) {
        foreach (ModelCreneau::getCreneauxDateByPosteId($posteCour) as $creneau_de_date_courant) { ?>
            <table>
                <tr>
                    <th id=""><label for="dispo_date1">jour n°<?php echo $compteur ?></label></th>

                    <?php
                    // Affichage dynamique des heures correspondant aux créneaux génériques
                    
                    $compteurCreneauxHeure = 0;
                    $date_depart_creneau_courant = $creneau_de_date_courant->getCreneauStart();

                    if (ModelCreneau::getCreneauxHeureByJour($posteCour, $date_depart_creneau_courant)) {
                        foreach (ModelCreneau::getCreneauxHeureByJour($posteCour, $date_depart_creneau_courant) as $h) {
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
                    } else echo "<th><i> Le poste n'a pas encore de créneaux </i></th>";
                    ?>
                </tr>

        <?php
            // Affichage dynamique des jours de festival (Les dates des créneaux génériques sans doublons)
            $numCreneauHeure = 1;

            echo "
            <tr>
            <td class=\"firstColumn\"><label for=\"date_$numCreneauHeure\">$date_depart_creneau_courant</label></td>
            ";

            if (ModelCreneau::getCreneauxHeureByJour($posteCour, $date_depart_creneau_courant)) {
                foreach (ModelCreneau::getCreneauxHeureByJour($posteCour, $date_depart_creneau_courant) as $h) {
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
    } else echo "<td><i> Vous n'avez encore ajouté aucun créneaux à votre poste.. </i></td>";
        ?>
            </table>
    
    
    
    
    
    <?php
    /*if (!$tab_creneau) {
        echo "<li> <span class=\"title\"> Le poste n'a aucun créneau </span> </li>";
    } else {
        foreach ($tab_creneau as $creaneau) {
            $creneau_id = htmlspecialchars($creaneau->getCreneauId());
            $creneau_startdate = htmlspecialchars($creaneau->getCreneauStart());
            $creneau_enddate = $creaneau->getCreneauEnd();
            echo "<li class=\"collection-item avatar\">
            <span class=\"title\"> <a href=\"index.php?action=read&controller=creneau&creneau_id=$creneau_id\">Créneau $creneau_id</a> </span>
            <p>Début: $creneau_startdate</p>
            <p>Fin: $creneau_enddate</p>
    		<div class=\"secondary-content\">
                <a title=\"en savoir plus\" href=\"index.php?action=read&controller=creneau&creneau_id=$creneau_id\" class=\"btn\"><i class=\"material-icons\">more</i></a>
                <a title=\"supprimer\" href=\"index.php?action=deleteInPoste&controller=creneau&creneau_id=$creneau_id&poste_id=$log_p\" class=\"btn\"><i class=\"material-icons\">delete</i></a>
                <a title=\"modifier\" href=\"index.php?action=update&controller=creneau&creneau_id=$creneau_id\" class=\"btn\"><i class=\"material-icons\">edit</i></a>
    		</div>
    	</li>";
        }
    }*/
    ?>
</ul>