<div class="row">
    <div class="col s12 m4 l2">
    </div>
    <div class="col s12 m4 l8">
        <?php
        /*
            echo "<form method=\"post\" action=\"index.php?action=created&festival_id=" . $_GET['festival_id'] . "\" enctype=\"multipart/form-data" . " class=\"col s12\">";
        */
        ?>

        <form method="post" action="index.php?action=created&festival_id=1" enctype="multipart/form-data" class="col s12">

            <div class="card-panel grey lighten-4">
                <h5>À propos de moi</h5>
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">email</i>
                        <input name="user_mail" id="user_mail" type="email" class="validate" required>
                        <label for="user_mail">Email<span class="flow-text red-text" title="Ce champ est obligatoire ">*</span></label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s6">
                        <i class="material-icons prefix">person</i>
                        <input name="user_lastname" id="user_lastname" type="text" class="validate" required>
                        <label for="user_lastname">Nom<span class="flow-text red-text" title="Ce champ est obligatoire ">*</span></label>
                    </div>
                    <div class="input-field col s6">
                        <input name="user_firstname" id="user_firstname" type="text" class="validate" required>
                        <label for="user_firstname">Prenom<span class="flow-text red-text" title="Ce champ est obligatoire ">*</span></label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s6">
                        <i class="material-icons prefix">lock</i>
                        <input name="user_password1" id="user_password1" type="password" class="validate" required>
                        <label for="user_password1">Mot de passe<span class="flow-text red-text" title="Ce champ est obligatoire ">*</span></label>
                    </div>
                    <div class="input-field col s6">
                        <input name="user_password2" id="user_password2" type="password" class="validate" required>
                        <label for="user_password2">Retapez le mot de passe<span class="flow-text red-text" title="Ce champ est obligatoire ">*</span></label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s6">
                        <i class="material-icons prefix">insert_invitation</i>
                        <input name="user_birthdate" id="user_birthdate" placeholder=" " type="date" max="2010-01-01" min="1900-01-01" class="validate" required>
                        <label for="user_birthdate">Date de naissance<span class="flow-text red-text" title="Ce champ est obligatoire ">*</span></label>
                    </div>
                    <div class="file-field input-field col s6">
                        <div class="btn">
                            <i class="material-icons">file_download</i>
                            <span>Photo de profil</span>
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s6">
                        <i class="material-icons prefix">person_pin</i>
                        <input name="user_postal_code" id="user_postal_code" type="number" class="validate" required>
                        <label for="user_postal_code">Code Postal<span class="flow-text red-text" title="Ce champ est obligatoire ">*</span></label>
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix">phone</i>
                        <input name="user_phone" id="user_phone" type="tel" class="validate" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" required>
                        <label for="user_phone">Numéro de Téléphone<span class="flow-text red-text" title="Ce champ est obligatoire ">*</span></label>
                    </div>
                </div>
            </div>
            <div class="card-panel grey lighten-4">
                <h5>Mobilité</h5>
                <!-- TODO: Corrigé le h5 degeu -->
                <div class="row">
                    <div class="col s12">
                        <label for="user_driving_license"></label> Permis de conduire<span class="flow-text red-text" title="Ce champ est obligatoire">*</span> :
                        <label>
                            <input id="user_driving_license" name="user_driving_license" type="radio" value="1" required />
                            <span>Oui</span>
                        </label>
                        <label>
                            <input id="user_driving_license" name="user_driving_license" type="radio" value="0" required />
                            <span>Non</span>
                        </label>
                    </div>
                </div>

                <div class="row">
                    <div class="col s12">
                        <label for="vehicule"></label> Venez vous avec votre véhicule ?<span class="flow-text red-text" title="Ce champ est obligatoire">*</span> :
                        <label>
                            <input name="vehicule" type="radio" value="1" required />
                            <span>Oui</span>
                        </label>
                        <label>
                            <input name="vehicule" type="radio" value="0" required />
                            <span>Non</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="card-panel grey lighten-4">
                <h5>Hébergement</h5>
                <div class="row">
                    <div class="col s12">
                        <label for="besoin_hebergement"></label>Avez vous besoin d'être hébergé ?<span class="flow-text red-text" title="Ce champ est obligatoire">*</span> :
                        <label>
                            <input name="besoin_hebergement" type="radio" value="1" required />
                            <span>Oui</span>
                        </label>
                        <label>
                            <input name="besoin_hebergement" type="radio" value="0" required />
                            <span>Non</span>
                        </label>
                    </div>
                </div>

                <div class="row">
                    <div class="col s12">
                        <label for="peut_heberger"></label>Pouvez vous héberger des personnes ?<span class="flow-text red-text" title="Ce champ est obligatoire">*</span> :
                        <label>
                            <input name="peut_heberger" type="radio" value="1" required />
                            <span>Oui</span>
                        </label>
                        <label>
                            <input name="peut_heberger" type="radio" value="0" required />
                            <span>Non</span>
                        </label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <label for="configuration_couchage"></label>Si oui, pouvez-vous nous expliquer la configuration de couchage ?
                        <textarea name="configuration_couchage" id="configuration_couchage" placeholder=" clic-clac, chambre d'ami, accès indépendant..." class="materialize-textarea"></textarea>
                    </div>
                </div>
            </div>

            <div class="card-panel grey lighten-4">
                <h5>Vos dispositions pour le festival</h5>

                <h6>Arrivée</h6>
                <div class="row">
                    <div class="input-field col s6">
                        <i class="material-icons prefix">insert_invitation</i>
                        <input name="arrivee_festival_date" id="arrivee_festival_date" placeholder=" " type="date" class="validate">
                        <label for="arrivee_festival_date">Date d'arrivée approximatif</label>
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix">access_time</i>
                        <input name="arrivee_festival_heure" id="arrivee_festival_heure" placeholder=" " type="time" class="validate">
                        <label for="arrivee_festival_heure">Heure d'arrivée approximatif</label>
                    </div>
                </div>

                <h6>Départ</h6>
                <div class="row">
                    <div class="input-field col s6">
                        <i class="material-icons prefix">insert_invitation</i>
                        <input name="depart_festival_date" id="depart_festival_date" placeholder=" " type="date" class="validate">
                        <label for="depart_festival_date">Date de depart approximatif</label>
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix">access_time</i>
                        <input name="depart_festival_heure" id="depart_festival_heure" placeholder=" " type="time" class="validate">
                        <label for="depart_festival_heure">Heure de départ approximatif</label>
                    </div>
                </div>

                <h6>Vos disponibilités</h6>
                <table>
                    <tr>
                        <th id=""><label for="dispo_date1">jour</label></th>

                        <?php
                        // Affichage dynamique des heures correspondant aux créneaux génériques
                        $festivalGenerique = 6;
                        $compteurCreneauxHeure = 0;
                        foreach (ModelFestival::getCreneauxGeneriquesHeure($festivalGenerique) as $h) {
                            $cStart = $h->getCreneauStart();
                            $cEnd = $h->getCreneauEnd();
                            echo "<th id=\"\"><label for=\"dispo_heure$compteurCreneauxHeure\">" . $cStart . " " . $cEnd . "</label></th>";

                            $compteurCreneauxHeure++;
                        }
                        ?>

                    </tr>

                    <?php
                    // Affichage dynamique des jours de festival (Les dates des créneaux génériques sans doublons)
                    $numCreneauHeure = 1;
                    foreach (ModelFestival::getCreneauxGeneriquesDate($festivalGenerique) as $d) {
                        $CreneauDate = $d->getCreneauStart();
                        echo "
                                  <tr>
                                  <td class=\"firstColumn\"><label for=\"date_$numCreneauHeure\">$CreneauDate</label></td>
                                  ";
                        $compteur = 1;
                        foreach (ModelFestival::getCreneauxGeneriquesHeure($festivalGenerique) as $h) {
                            $cStart = $h->getCreneauStart();
                            $cEnd = $h->getCreneauEnd();
                            echo "<td><label><input type=\"checkbox\" name=\"dispo_heure$cStart" . "_$cEnd"  . "date_$CreneauDate\" id=\"dispo_heure$compteur" . "date_$CreneauDate\" value=\"1\" /><span> </span></label></td>";
                        }
                        echo "</tr>";
                    }
                    ?>

                </table>

                <h6>Autres disponibilités</h6>
                <div class="row">
                    <div class="input-field col s6">
                        <i class="material-icons prefix">insert_invitation</i>
                        <input name="autres_dispos_date" id="autres_dispos_date" placeholder=" " type="date" class="validate">
                        <label for="autres_dispos_date">Date de disponibilités</label>
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix">access_time</i>
                        <input name="autres_dispos_heure" id="autres_dispos_heure" placeholder=" " type="time" class="validate">
                        <label for="autres_dispos_heure">Heure de disponibilités</label>
                    </div>
                </div>
            </div>

            <div class="card-panel grey lighten-4">
                <h5>Vos préférences</h5>
                <table class="striped">
                    <thead>
                        <tr>
                            <th id="poste"><label for="interet1">Poste</label></th>
                            <th id="interet1"><label for="interet1">1</label></th>
                            <th id="interet2"><label for="interet2">2</label></th>
                            <th id="interet3"><label for="interet3">3</label></th>
                            <th id="toute_semaine"><label for="toute_semaine">Je suis prêt à ne faire que cette mission
                                    toute la semaine</label></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach (ModelFestival::getPostesByFestival($_GET['festival_id']) as $post) {
                            $nomPoste = $post->getPosteName();
                            $descriptionPoste = $post->getPosteDescription();
                            $idPoste = $post->getPosteId();
                            echo "
                        <tr>
                        <td><label for=\"$idPoste\">$nomPoste<br>$descriptionPoste</label></td>
                        <td><label><input type=\"radio\" name=\"" . "Poste" . $idPoste . "\" id=\"$idPoste\" value=\"1\" /><span> </span></label></td>
                        <td><label><input type=\"radio\" name=\"" . "Poste" . $idPoste . "\" id=\"$idPoste\" value=\"2\" /><span> </span></label></td>
                        <td><label><input type=\"radio\" name=\"" . "Poste" . $idPoste . "\" id=\"$idPoste\" value=\"3\" /><span> </span></label></td>
                        <td><label><input type=\"radio\" name=\"" . "Poste" . $idPoste . "\" id=\"$idPoste\" value=\"4\" /><span> </span></label></td>
                        </tr>
                        ";
                        }
                        ?>
                    </tbody>
                </table>

                <div class="row">
                    <h5>Concerts</h5>
                    <div class="col s12">
                        <div class="row">
                            <label for="choisirconcert_id">Choisissez un concert auquel vous souhaiteriez
                                assister</label>
                            <select name="choisirconcert_id" id="choisirconcert_id">
                                <!-- TODO : l'affichage de cette partie doit être automatisé avec le php -->
                                <option value="" disabled selected>Sélectionner</option>

                                <option value="concert1">13/04 - Cinéma Le Molière - film Daniel Darc - lecture
                                    Dimoné
                                </option>
                                <option value="concert2">14/04 -Théâtre Historique - 20h30- Estelle Meyer + Wally Le
                                    Projet
                                    Derli</option>
                                <option value="concert3">15/04 - Théâtre Historique - 14h30 - Presque Oui Icibalao
                                    (Jeune
                                    Public)</option>
                                <option value="concert4">15/04 - Théâtre Historique - 19h - Jerrycan</option>
                                <option value="concert5">15/04 - Foyer des Campagnes - 21h - La Pieta + Soirée Girls
                                    Gang
                                </option>
                                <option value="concert6">16/04 - Pl. Gambetta - 12h - Création Canada/Occitanie
                                </option>
                                <option value="concert7">16/04 - Théâtre Historique - 19h - programmation en cours
                                </option>
                                <option value="concert8">16/04 - Foyer des Campagnes - 21h - Natasha Kanapé + Diane
                                    Tell
                                </option>
                                <option value="concert9">17/04 - Pl. Gambetta - 12h - François Bijou</option>
                                <option value="concert11">17/04 - Th. Historique - 14h - Remise des coups de Cœur
                                    Chanson de
                                    l'Académie Ch. Cros</option>
                                <option value="concert12">17/04 - Th. Historique - 19h - Clara Ysé</option>
                                <option value="concert13">17/04 - Foyer des Campagnes - 21h - Nemir</option>
                                <option value="concert14">18/04 - Pl. Gambetta - 12h - Sugar & Tiger</option>
                                <option value="concert15">18/04 - Th. Historique - 15h - Plateaux découvertes -
                                    L'Affaire
                                    Sirven
                                    / Orly / Murielle Holtz</option>
                                <option value="concert16">18/04 - Foyer des Campagnes - 19h - Melba</option>
                                <option value="concert17">18/04 - Foyer des Campagnes - 21H - Batlik + Dimoné &
                                    Kursed
                                </option>
                            </select>


                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col s12">
                        <label for="experience"></label>Avez-vous déjà été bénévole sur le festival ?<span class="flow-text red-text" title="Ce champ est obligatoire">*</span> :
                        <label>
                            <input name="experience" id="experience" type="radio" value="1" required />
                            <span>Oui</span>
                        </label>
                        <label>
                            <input name="experience" id="experience" type="radio" value="0" required />
                            <span>Non</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col s12 m4 l4"></div>
                <input type="hidden" name="action" value="created">
                <input type="hidden" name="festival_id" value=<?php echo "\"" . $_GET['festival_id'] . "\"" ?>>
                <input class="btn col s12 m4 l4" type="submit" value="Envoyer" />
            </div>
        </form>
    </div>
</div>