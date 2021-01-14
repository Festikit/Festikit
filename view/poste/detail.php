<div class="container mb-2">
    <?php
    echo "<h4>Poste : " . htmlspecialchars($p->getPosteName()) . "</h4>" .
        "<p>Description du poste : " . htmlspecialchars($p->getPosteDescription()) . "</p>
        <p>Poste affecté au festival <a href=\"index.php?action=read&controller=festival&festival_id=" . rawurlencode($p->getFestivalId()) . "\">" . htmlspecialchars($festival_name) . "</a></p>";
    if (!$boolResponsable)
        echo "<a title=\"modifier\" href=\"index.php?action=update&controller=poste&poste_id=$poste_id\" class=\"btn\">Modifier le poste</a>";
    ?>
</div>
    <ul class="collection">



        <li class="collection-header">
            <h4 class="center">creneaux du poste</h4>
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