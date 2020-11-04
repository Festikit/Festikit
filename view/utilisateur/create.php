<!DOCTYPE html>
<html lang="fr" xml:lang="fr">

<head>
    <title>Formulaire</title>
    <meta charset="utf-8">
    <!-- Materialize: Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js">
    </script>

    <script>
        $(document).ready(function() {
            $('select').material_select();
        });
    </script>
</head>

<body class="grey lighten-3">
    <div class="row">
        <div class="col s12 m4 l2">
        </div>
        <div class="col s12 m4 l8">
            <!-- TODO: mettre l'action created -->
            <form method="post" action="creerVoiture.php" class="col s12">

                <div class="card-panel grey lighten-4">
                    <h5>À propos de moi</h5>
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">email</i>
                            <input id="user_email" type="email" class="validate" required>
                            <label for="user_email">Email<abbr title="Ce champ est obligatoire ">*</abbr></label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s6">
                            <i class="material-icons prefix">person</i>
                            <input id="user_lastname" type="text" class="validate" required>
                            <label for="user_lastname">Non<abbr title="Ce champ est obligatoire ">*</abbr></label>
                        </div>
                        <div class="input-field col s6">
                            <input id="user_fistname" type="text" class="validate" required>
                            <label for="user_fistname">Prenom<abbr title="Ce champ est obligatoire ">*</abbr></label>
                        </div>
                    </div>


                    <div class="row">
                        <div class="input-field col s6">
                            <i class="material-icons prefix">insert_invitation</i>
                            <input id="date_naissance" placeholder=" " type="date" max="2010-01-01" min="1900-01-01" class="validate" required>
                            <label for="date_naissance">date de naissance<abbr
                                    title="Ce champ est obligatoire ">*</abbr></label>
                        </div>
                        <div class="file-field input-field col s6">
                            <div class="btn">
                                <i class="material-icons">file_download</i>
                                <span>Photo de profil</span>
                                <input id="avatar" type="file" accept="image/png, image/jpeg">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s6">
                            <i class="material-icons prefix">person_pin</i>
                            <input id="code_postal" type="number" class="validate" required>
                            <label for="code_postal">Code Postal<abbr title="Ce champ est obligatoire ">*</abbr></label>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix">phone</i>
                            <input id="user_phone" type="tel" class="validate" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" required>
                            <label for="user_phone">Numéro de Téléphone<abbr
                                    title="Ce champ est obligatoire ">*</abbr></label>
                        </div>
                    </div>
                </div>

                <div class="card-panel grey lighten-4">
                    <h5>Mobilité</h5>
                    <!-- TODO: Corrigé le h5 degeu -->
                    <div class="row">
                        <div class="col s12">
                            <label for="permis"></label> Permis de conduire<abbr title="Ce champ est obligatoire">*</abbr> :
                            <label>
                                <input required name="permis" type="radio" value="1" />
                                <span>Oui</span>
                            </label>
                            <label>
                                <input required name="permis" type="radio" value="0" />
                                <span>Non</span>
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col s12">
                            <label for="vehicule"></label> Venez vous avec votre véhicule ?<abbr title="Ce champ est obligatoire">*</abbr> :
                            <label>
                                <input required name="vehicule" type="radio" value="1" />
                                <span>Oui</span>
                            </label>
                            <label>
                                <input required name="vehicule" type="radio" value="0" />
                                <span>Non</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="card-panel grey lighten-4">
                    <h5>Hébergement</h5>
                    <div class="row">
                        <div class="col s12">
                            <label for="besoin_heberge"></label>Avez vous besoin d'être hébergé ?<abbr title="Ce champ est obligatoire">*</abbr> :
                            <label>
                                <input required name="besoin_heberge" type="radio" value="1" />
                                <span>Oui</span>
                            </label>
                            <label>
                                <input required name="besoin_heberge" type="radio" value="0" />
                                <span>Non</span>
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col s12">
                            <label for="peut_heberge"></label>Pouvez vous héberger des personnes ?<abbr title="Ce champ est obligatoire">*</abbr> :
                            <label>
                                <input required name="peut_heberge" type="radio" value="1" />
                                <span>Oui</span>
                            </label>
                            <label>
                                <input required name="peut_heberge" type="radio" value="0" />
                                <span>Non</span>
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <label for="couchage_id"></label>Si oui, pouvez-vous nous expliquer la configuration de couchage ?
                            <textarea id="couchage_id" placeholder=" clic-clac, chambre d'ami, accès indépendant..." class="materialize-textarea"></textarea>
                        </div>
                    </div>
                </div>

                <div class="card-panel grey lighten-4">
                    <h5>Vos dispositions pour le festival</h5>

                    <h6>Arrivée</h6>
                    <div class="row">
                        <div class="input-field col s6">
                            <i class="material-icons prefix">insert_invitation</i>
                            <input id="arrivee_date" placeholder=" " type="date" class="validate">
                            <label for="arrivee_date">Date d'arrivée approximatif</label>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix">access_time</i>
                            <input id="arrivee-heure" placeholder=" " type="time" class="validate">
                            <label for="arrivee-heure">Date d'arrivée approximatif</label>
                        </div>
                    </div>

                    <h6>Départ</h6>
                    <div class="row">
                        <div class="input-field col s6">
                            <i class="material-icons prefix">insert_invitation</i>
                            <input id="depart_date" placeholder=" " type="date" class="validate">
                            <label for="depart_date">Date de depart approximatif</label>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix">access_time</i>
                            <input id="depart-heure" placeholder=" " type="time" class="validate">
                            <label for="depart-heure">Date de départ approximatif</label>
                        </div>
                    </div>

                    <h6>Vos disponibilités</h6>
                    <table>
                        <tr>
                            <th id=""><label for="dispo_date1">jour</label></th>
                            <th id="matin"><label for="dispo_date1">Matin: 8h-14h</label></th>
                            <th id="après-midi"><label for="dispo_date2">Après-midi: 14h-17h</label></th>
                            <th id="fin-après-midi"><label for="dispo_date3">Fin d'après-midi: 17h-20h</label></th>
                            <th id="soiree"><label for="dispo_date4">Soirée: 20h-22h</label></th>
                            <th id="fin-soirée"><label for="dispo_date5">Fin de soirée: 22h-00h</label></th>
                            <th id="minuit"><label for="dispo_date6">Apres 00h</label></th>
                        </tr>
                        <tr>
                            <td class="firstColumn"><label for="dispo_lieu1">Samedi 4 Avril (au marché de
                                    Pézenas)</label></td>
                            <td><label><input type="checkbox" id="dispo_lieu1_date1" value="1" /><span> </span></label></td>
                            <td><label><input type="checkbox" id="dispo_lieu1_date2" value="1" /><span> </span></label></td>
                            <td><label><input type="checkbox" id="dispo_lieu1_date3" value="1" /><span> </span></label></td>
                            <td><label><input type="checkbox" id="dispo_lieu1_date4" value="1" /><span> </span></label></td>
                            <td><label><input type="checkbox" id="dispo_lieu1_date5" value="1" /><span> </span></label></td>
                            <td><label><input type="checkbox" id="dispo_lieu1_date6" value="1" /><span> </span></label></td>
                        </tr>
                        <tr>
                            <td class="firstColumn"><label for="dispo_lieu2">Samedi 11 Avril (au marché de
                                    Pézenas)</label></td>
                            <td><label><input type="checkbox" id="dispo_lieu2_date1" value="1" /><span> </span></label></td>
                            <td><label><input type="checkbox" id="dispo_lieu2_date2" value="1" /><span> </span></label></td>
                            <td><label><input type="checkbox" id="dispo_lieu2_date3" value="1" /><span> </span></label></td>
                            <td><label><input type="checkbox" id="dispo_lieu2_date4" value="1" /><span> </span></label></td>
                            <td><label><input type="checkbox" id="dispo_lieu2_date5" value="1" /><span> </span></label></td>
                            <td><label><input type="checkbox" id="dispo_lieu2_date6" value="1" /><span> </span></label></td>
                        </tr>
                        <tr>
                            <td class="firstColumn"><label for="dispo_lieu3">Lundi 13 avril (déco+ install + barbecue
                                    d'accueil)</label></td>
                            <td><label><input type="checkbox" id="dispo_lieu3_date1" value="1" /><span> </span></label></td>
                            <td><label><input type="checkbox" id="dispo_lieu3_date2" value="1" /><span> </span></label></td>
                            <td><label><input type="checkbox" id="dispo_lieu3_date3" value="1" /><span> </span></label></td>
                            <td><label><input type="checkbox" id="dispo_lieu3_date4" value="1" /><span> </span></label></td>
                            <td><label><input type="checkbox" id="dispo_lieu3_date5" value="1" /><span> </span></label></td>
                            <td><label><input type="checkbox" id="dispo_lieu3_date6" value="1" /><span> </span></label></td>
                        </tr>
                        <tr>
                            <td class="firstColumn"><label for="dispo_lieu4">Mardi 14 avril</label></td>
                            <td><label><input type="checkbox" id="dispo_lieu4_date1" value="1" /><span> </span></label></td>
                            <td><label><input type="checkbox" id="dispo_lieu4_date2" value="1" /><span> </span></label></td>
                            <td><label><input type="checkbox" id="dispo_lieu4_date3" value="1" /><span> </span></label></td>
                            <td><label><input type="checkbox" id="dispo_lieu4_date4" value="1" /><span> </span></label></td>
                            <td><label><input type="checkbox" id="dispo_lieu4_date5" value="1" /><span> </span></label></td>
                            <td><label><input type="checkbox" id="dispo_lieu4_date6" value="1" /><span> </span></label></td>
                        </tr>
                        <tr>
                            <td class="firstColumn"><label for="dispo_lieu5">Mercredi 15 avril</label></td>
                            <td><label><input type="checkbox" id="dispo_lieu5_date1" value="1" /><span> </span></label></td>
                            <td><label><input type="checkbox" id="dispo_lieu5_date2" value="1" /><span> </span></label></td>
                            <td><label><input type="checkbox" id="dispo_lieu5_date3" value="1" /><span> </span></label></td>
                            <td><label><input type="checkbox" id="dispo_lieu5_date4" value="1" /><span> </span></label></td>
                            <td><label><input type="checkbox" id="dispo_lieu5_date5" value="1" /><span> </span></label></td>
                            <td><label><input type="checkbox" id="dispo_lieu5_date6" value="1" /><span> </span></label></td>
                        </tr>
                        <tr>
                            <td class="firstColumn"><label for="dispo_lieu6">Jeudi 16 avril</label></td>
                            <td><label><input type="checkbox" id="dispo_lieu6_date1" value="1" /><span> </span></label></td>
                            <td><label><input type="checkbox" id="dispo_lieu6_date2" value="1" /><span> </span></label></td>
                            <td><label><input type="checkbox" id="dispo_lieu6_date3" value="1" /><span> </span></label></td>
                            <td><label><input type="checkbox" id="dispo_lieu6_date4" value="1" /><span> </span></label></td>
                            <td><label><input type="checkbox" id="dispo_lieu6_date5" value="1" /><span> </span></label></td>
                            <td><label><input type="checkbox" id="dispo_lieu6_date6" value="1" /><span> </span></label></td>
                        </tr>
                        <tr>
                            <td class="firstColumn"><label for="dispo_lieu7">Vendredi 17 avril</label></td>
                            <td><label><input type="checkbox" id="dispo_lieu7_date1" value="1" /><span> </span></label></td>
                            <td><label><input type="checkbox" id="dispo_lieu7_date2" value="1" /><span> </span></label></td>
                            <td><label><input type="checkbox" id="dispo_lieu7_date3" value="1" /><span> </span></label></td>
                            <td><label><input type="checkbox" id="dispo_lieu7_date4" value="1" /><span> </span></label></td>
                            <td><label><input type="checkbox" id="dispo_lieu7_date5" value="1" /><span> </span></label></td>
                            <td><label><input type="checkbox" id="dispo_lieu7_date6" value="1" /><span> </span></label></td>
                        </tr>
                        <tr>
                            <td class="firstColumn"><label for="dispo_lieu8">Samedi 18 avril</label></td>
                            <td><label><input type="checkbox" id="dispo_lieu8_date1" value="1" /><span> </span></label></td>
                            <td><label><input type="checkbox" id="dispo_lieu8_date2" value="1" /><span> </span></label></td>
                            <td><label><input type="checkbox" id="dispo_lieu8_date3" value="1" /><span> </span></label></td>
                            <td><label><input type="checkbox" id="dispo_lieu8_date4" value="1" /><span> </span></label></td>
                            <td><label><input type="checkbox" id="dispo_lieu8_date5" value="1" /><span> </span></label></td>
                            <td><label><input type="checkbox" id="dispo_lieu8_date6" value="1" /><span> </span></label></td>
                        </tr>
                        <tr>
                            <td class="firstColumn"><label for="dispo_lieu9">Dimanche 19 avril (rangement,
                                    désinstallation)</label></td>
                            <td><label><input type="checkbox" id="dispo_lieu9_date1"  value="dispo_date1" /><span> </span></label>
                            </td>
                            <td><label><input type="checkbox" id="dispo_lieu9_date2"  value="dispo_date2" /><span> </span></label>
                            </td>
                            <td><label><input type="checkbox" id="dispo_lieu9_date3"  value="dispo_date3" /><span> </span></label>
                            </td>
                            <td><label><input type="checkbox" id="dispo_lieu9_date4"  value="dispo_date4" /><span> </span></label>
                            </td>
                            <td><label><input type="checkbox" id="dispo_lieu9_date5"  value="dispo_date5" /><span> </span></label>
                            </td>
                            <td><label><input type="checkbox" id="dispo_lieu9_date6"  value="dispo_date6" /><span> </span></label>
                            </td>
                        </tr>
                    </table>

                    <h6>Autres disponibilités</h6>
                    <div class="row">
                        <div class="input-field col s6">
                            <i class="material-icons prefix">insert_invitation</i>
                            <input id="creneau_date" placeholder=" " type="date" class="validate">
                            <label for="creneau_date">Date de disponibilités</label>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix">access_time</i>
                            <input id="creneau_heure" placeholder=" " type="time" class="validate">
                            <label for="creneau_heure">Heure de disponibilités</label>
                        </div>
                    </div>
                </div>

                <div class="card-panel grey lighten-4">
                    <h5>Vos préférences</h5>
                    <table>
                        <tr>
                            <th id="poste"><label for="interet1">Poste</label></th>
                            <th id="interet1"><label for="interet1">1</label></th>
                            <th id="interet2"><label for=" interet2">2</label></th>
                            <th id="interet3"><label for="interet3">3</label></th>
                            <th id="toute_semaine"><label for="toute_semaine">Je suis prêt à ne faire que cette mission
                                    toute la semaine</label></th>
                        </tr>
                        <tr>
                            <td class="firstColumn "><label for="runs">Runs (transfert en voiture des artistes et pros
                                    lieu d'arrivée, festival, lieu d'hébergement)</label></td>
                            <td><label><input type="radio" id="runs" value="1" /><span> </span></label></td>
                            <td><label><input type="radio" id="runs" value="2" /><span> </span></label></td>
                            <td><label><input type="radio" id="runs" value="3" /><span> </span></label></td>
                            <td><label><input type="radio" id="runs" value="4" /><span> </span></label></td>
                        </tr>
                        <tr>
                            <td class="firstColumn "><label for="accueil">Accueil Public et prévention (vérification
                                    billets, gestion du public pendant le concert)</label></td>
                            <td><label><input type="radio" id="accueil" value="1" /><span> </span></label></td>
                            <td><label><input type="radio" id="accueil" value="2" /><span> </span></label></td>
                            <td><label><input type="radio" id="accueil" value="3" /><span> </span></label></td>
                            <td><label><input type="radio" id="accueil" value="4" /><span> </span></label></td>
                        </tr>
                        <tr>
                            <td class="firstColumn "><label for="diffusion">Diffusion (distribution hélicon,
                                    vérification affichage, flyage, sondages)</label></td>
                            <td><label><input type="radio" id="diffusion" value="1" /><span> </span></label></td>
                            <td><label><input type="radio" id="diffusion" value="2" /><span> </span></label></td>
                            <td><label><input type="radio" id="diffusion" value="3" /><span> </span></label></td>
                            <td><label><input type="radio" id="diffusion" value="4" /><span> </span></label></td>
                        </tr>
                        <tr>
                            <td class="firstColumn "><label for="after">After : Préparation, Accueil, Nettoyage</label>
                            </td>
                            <td><label><input type="radio" id="after" value="1" /><span> </span></label></td>
                            <td><label><input type="radio" id="after" value="2" /><span> </span></label></td>
                            <td><label><input type="radio" id="after" value="3" /><span> </span></label></td>
                            <td><label><input type="radio" id="after" value="4" /><span> </span></label></td>
                        </tr>
                        <tr>
                            <td class="firstColumn "><label for="billeterie">Billetterie</label></td>
                            <td><label><input type="radio" id="billetterie" value="1" /><span> </span></label></td>
                            <td><label><input type="radio" id="billetterie" value="2" /><span> </span></label></td>
                            <td><label><input type="radio" id="billetterie" value="3" /><span> </span></label></td>
                            <td><label><input type="radio" id="billetterie" value="4" /><span> </span></label>
                            </td>
                        </tr>
                        <tr>
                            <td class="firstColumn "><label for="aide">Aide à la technique</label></td>
                            <td><label><input type="radio" id="aide" value="1" /><span> </span></label></td>
                            <td><label><input type="radio" id="aide" value="2" /><span> </span></label></td>
                            <td><label><input type="radio" id="aide" value="3" /><span> </span></label></td>
                            <td><label><input type="radio" id="aide" value="4" /><span> </span></label></td>
                        </tr>
                        <tr>
                            <td class="firstColumn "><label for="buvette">Buvette</label></td>
                            <td><label><input type="radio" id="buvette" value="1" /><span> </span></label></td>
                            <td><label><input type="radio" id="buvette" value="2" /><span> </span></label></td>
                            <td><label><input type="radio" id="buvette" value="3" /><span> </span></label></td>
                            <td><label><input type="radio" id="buvette" value="4" /><span> </span></label></td>
                        </tr>
                        <tr>
                            <td class="firstColumn "><label for="joker">Joker : petites missions différentes tout au
                                    long de la journée, vous êtes donc d'astreinte sur vos heures de dispo</label></td>
                            <td><label><input type="radio" id="joker" value="1" /><span> </span></label></td>
                            <td><label><input type="radio" id="joker" value="2" /><span> </span></label></td>
                            <td><label><input type="radio" id="joker" value="3" /><span> </span></label></td>
                            <td><label><input type="radio" id="joker" value="4" /><span> </span></label></td>
                        </tr>
                        <tr>
                            <td class="firstColumn "><label for="cuisine">Cuisine (préparation des plats, service au
                                    self, plonge, nettoyage...)</label></td>
                            <td><label><input type="radio" id="cuisine" value="1" /><span> </span></label></td>
                            <td><label><input type="radio" id="cuisine" value="2" /><span> </span></label></td>
                            <td><label><input type="radio" id="cuisine" value="3" /><span> </span></label></td>
                            <td><label><input type="radio" id="cuisine" value="4" /><span> </span></label>
                            </td>
                        </tr>
                        <tr>
                            <td class="firstColumn "><label for="decoration">Décoration</label></td>
                            <td><label><input type="radio" id="decoration" value="1" /><span> </span></label></td>
                            <td><label><input type="radio" id="decoration" value="2" /><span> </span></label></td>
                            <td><label><input type="radio" id="decoration" value="3" /><span> </span></label></td>
                            </td4>
                            <td><label><input type="radio" id="decoration" value="4" /><span> </span></label>
                            </td>
                        </tr>
                    </table>

                    <div class="row">
                        <h5>Concerts</h5>
                        <div class="col s12">
                            <div class="row">
                                <label for="choisirconcert_id">Choisissez un concert auquel vous souhaiteriez
                                    assister</label>
                                <select id="choisirconcert_id">
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
                            <label for="deja_benevole"></label>Avez-vous déjà été bénévole sur le festival ?<abbr title="Ce champ est obligatoire">*</abbr> :
                            <label>
                                <input required name="deja_benevole" id="deja_benevole" type="radio" value="1" />
                                <span>Oui</span>
                            </label>
                            <label>
                                <input required name="deja_benevole" id="deja_benevole" type="radio" value="0" />
                                <span>Non</span>
                            </label>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Compiled and minified JavaScript -->

</body>

</html>