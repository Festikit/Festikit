<h4 class="center">Modification des créneaux génériques</h4>
<?php if(isset($_GET['festival_id'])){$festival_id = $_GET['festival_id'];}?>
<a class="btn-large waves-effect waves-light secondary-content" href="index.php?action=createGen&controller=creneau&festival_id=<?php echo $festival_id; ?>"> Ajouter un creneau</a>
</br>
</br>
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
                            $cStart = $cStart."";
                            $cStartmod = substr($cStart, 0, -3);
                            //cr fin
                            $cEnd = $cEnd."";
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
                    
                    $creneau_courant_id = $h->getCreneauId();
                    
                    echo "<td><a title=\"modifier\" href=\"index.php?action=update&controller=creneau&creneau_id=$creneau_courant_id&type=gen\" class=\"btn\"><i class=\"material-icons\">edit</i></a>";
                    echo "<a title=\"modifier\" href=\"index.php?action=deleteGen&controller=creneau&creneau_id=$creneau_courant_id&type=gen&festival_id=$festival_id\" class=\"btn\"><i class=\"material-icons\">delete</i></a></td>";
                    
                }
            } else echo "<td><i> Il n'y a donc rien à afficher ici.. </i></td>";
            echo "</tr>";
            echo "</br>";
            $compteur++;
        }
    } else echo "<td><i> Vous n'avez encore ajouté aucun jour à votre festival.. </i></td>";
        ?>
            </table>
</br>
</br>
</br>
<a class="btn-large waves-effect waves-light secondary-content" href="index.php?action=read&controller=festival&festival_id=<?php echo $festival_id?>"> Retour au festival</a>
