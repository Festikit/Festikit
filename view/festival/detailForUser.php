<?php

//---------- recupération des infos ----------//
// HTML
$nameHTML = htmlspecialchars($f->get("festival_name"));




// Détail les informations d'un festival

echo "<h2 class=\"flow-text center\"> Festival " . $nameHTML . "</h2>";
?>


<div class="row">
    <form class="col s12">
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