<style>
    .tooltip {
        position: relative;
        display: inline-block;
    }

    .tooltip .tooltiptext {
        visibility: hidden;
        width: 140px;
        background-color: #555;
        color: #fff;
        text-align: center;
        border-radius: 6px;
        padding: 5px;
        position: absolute;
        z-index: 1;
        bottom: 150%;
        left: 50%;
        margin-left: -75px;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .tooltip .tooltiptext::after {
        content: "";
        position: absolute;
        top: 100%;
        left: 50%;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: #555 transparent transparent transparent;
    }

    .tooltip:hover .tooltiptext {
        visibility: visible;
        opacity: 1;
    }
</style>
<script>
    function share() {
        if (navigator.share) {
            navigator.share({
                    title: 'Festival : <?php echo $f->getFestivalName() ?>',
                    text: 'Invitation à devenir bénévole pour le festival <?php echo $f->getFestivalName() ?>',
                    url: 'https://benevoles.herokuapp.com/index.php?action=create&festival_id=<?php echo $festival_id ?>',
                })
                .then(() => console.log('Successful share'))
                .catch((error) => console.log('Error sharing', error));
        } else {
            var elem = document.querySelector('#partage')
            var instance = M.Modal.getInstance(elem);
            instance.open();
        }
    }
</script>

<script>
    function copier() {
        var copyText = document.getElementById("urlPartage");

        copyText.select();
        copyText.setSelectionRange(0, 99999);

        document.execCommand("copy");

        var tooltip = document.getElementById("myTooltip");
        tooltip.innerHTML = "Copié !";
    }

    function outFunc() {
        var tooltip = document.getElementById("myTooltip");
        tooltip.innerHTML = "Copier le lien";
    }
</script>

<div id="partage" class="modal">
    <div class="modal-content">
        <h4>Partager le formulaire</h4>
        <div class="row">
            <input class="col s9" readonly type="text" value="https://benevoles.herokuapp.com/index.php?action=create&festival_id=<?php echo $festival_id ?>" id="urlPartage">
            <div class="tooltip col s3">
                <button class="btn" onclick="copier()" onmouseout="outFunc()">
                    <span class="tooltiptext" id="myTooltip">Copier le lien</span>
                    Copier le lien
                </button>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Annuler</a>
    </div>
</div>

<div class="fixed-action-btn">
    <button onclick="share()" class="btn red z-depth-3 waves-effect"> Partager le formulaire
    </button>
</div>
<div class="row">
    <div class="col s12 m10 offset-m1 l8 offset-l2">

        <form method="post" action="index.php?action=created" enctype="multipart/form-data" class="col s12" onsubmit="return checkPasswordOnSubmit();">

            <?php
            $festivalNameHtml = htmlspecialchars($f->getFestivalName());
            echo "<h3>Inscription : $festivalNameHtml</h3>";
            if (!$boolUser) {
            ?>

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
                        <div class="input-field col s6 m4">
                            <i class="material-icons prefix">lock</i>
                            <input name="user_password1" id="user_password1" type="password" autocomplete="new-password" class="validate" onChange="checkPasswordLength();" required>
                            <label for="user_password1">Mot de passe<span class="flow-text red-text" title="Ce champ est obligatoire ">*</span></label>
                        </div>
                        <div class="input-field col s6 m4">
                            <input name="user_password2" id="user_password2" type="password" class="validate" onChange="checkPasswordMatch();" required>
                            <label for="user_password2">Retapez le mot de passe<span class="flow-text red-text" title="Ce champ est obligatoire ">*</span></label>
                        </div>

                        <div class="input-field col s12 m4 registrationFormAlert">
                            <label>
                                <i class="material-icons verification-length"></i>
                                <span id="checkPasswordLength"></span>
                            </label>
                        </div>
                        <div class="input-field col s12 m4 registrationFormAlert">
                            <label>
                                <i class="material-icons verification-match"></i>
                                <span id="checkPasswordMatch"></span>
                            </label>
                        </div>
                        <div class="input-field col s12 m4 registrationFormAlert" id="checkPasswordMatch"></div>
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
                            <i class="material-icons prefix">insert_invitation</i>
                            <input name="user_birthdate" id="user_birthdate" placeholder=" " type="date" max="2010-01-01" min="1900-01-01" class="validate" required>
                            <label for="user_birthdate">Date de naissance<span class="flow-text red-text" title="Ce champ est obligatoire ">*</span></label>
                        </div>
                        <div class="file-field input-field col s6">
                            <div class="btn">
                                <i class="material-icons">file_download</i>
                                <span>Photo de profil</span>
                                <input type="hidden" name="MAX_FILE_SIZE" value="250000" />
                                <input name="user_picture" id="user_picture" type="file" accept="image/png, image/jpeg, image/jpg" required>
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

            <?php
            }
            ?>

            <div class="card-panel grey lighten-4">
                <h5>Mobilité</h5>
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
                <?php /*<table>
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
                            echo "<td><label><input type=\"checkbox\" name=\"dispo_heure$cStart" . "_$cEnd"  . "date_$CreneauDate\" id=\"dispo_heure$compteur"
                             . "date_$CreneauDate\" value=\"1\" /><span> </span></label></td>";
                        }
                        echo "</tr>";
                    }
                    ?>

                </table> */ ?>

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
                                echo "<td><label><input type=\"checkbox\" name=\"dispo_heure$cStart" . "_$cEnd"  . "date_$date_depart_creneau_courant\" 
                                id=\"dispo_heure$compteur" . "date_$date_depart_creneau_courant\" value=\"1\" /><span> </span></label></td>";
                            }
                        } else echo "<td><i> Il n'y a donc rien à afficher ici.. </i></td>";
                        echo "</tr>";

                        $compteur++;
                    }
                } else echo "<td><i> Il n'y a aucun jour assigné à ce festival.. </i></td>";
                    ?>
                        </table>
                        </ul>
                        </br>
                        </br>

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
                        <td><label for=\"$idPoste\"> <span class=\"black-text\" >$nomPoste</span><br>$descriptionPoste</label></td>
                        <td><label><input type=\"radio\" name=\"" . "Poste" . $idPoste . "\" id=\"$idPoste\" value=\"1\" required /><span> </span></label></td>
                        <td><label><input type=\"radio\" name=\"" . "Poste" . $idPoste . "\" id=\"$idPoste\" value=\"2\" required /><span> </span></label></td>
                        <td><label><input type=\"radio\" name=\"" . "Poste" . $idPoste . "\" id=\"$idPoste\" value=\"3\" required /><span> </span></label></td>
                        <td><label><input type=\"radio\" name=\"" . "Poste" . $idPoste . "\" id=\"$idPoste\" value=\"4\" required /><span> </span></label></td>
                        </tr>
                        ";
                        }
                        ?>
                    </tbody>
                </table>

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
                <input type="hidden" name="action" value="created">
                <input type="hidden" name="festival_id" value=<?php echo "\"$festival_id\"" ?>>
                <button type="submit" class="btn col s12 m4 offset-m4 l4 offset-l4" id="ButtonSignIn">Envoyer</button>
            </div>
        </form>
    </div>
</div>