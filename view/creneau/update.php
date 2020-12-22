<?php
if (!($log_c == "" && $creneau_startdate == "" && $creneau_enddate == "" && $festival_id == "" && $poste_id == "")) {
    $log_c = htmlspecialchars($tab_c->getCreneauId());
    $creneau_startdate = htmlspecialchars($tab_c->getCreneauStart());
    $creneau_enddate = htmlspecialchars($tab_c->getCreneauEnd());
    $festival_id = htmlspecialchars($tab_c->getFestivalId());
    $poste_id = htmlspecialchars($tab_c->getPosteId());
}
?>
<div class="row">
    <div class="col s12 m4 l2">
    </div>
    <div class="card-panel col s12 m12 l8 grey lighten-4">
        <form method="get" action="index.php?action=updated&controller=creneau">
            <h5 class="center-align">Modifier ce creneau</h5>
            <div class="row">
                <div class="input-field col s6">
                    <i class="material-icons prefix">music_note</i>
                    <?php echo '<input name="festival_id" id="festival_id" type="text" value="' . $nom_festival . '" disabled>'; ?>
                    <label class="active" for="festival_id">Festival</label>
                </div>

                <div class="input-field col s6">
                    <i class="material-icons prefix">work</i>
                    <?php echo '<input name="poste_id" id="poste_id" type="text" value="' . $nom_poste . '" disabled>'; ?>
                    <label class="active" for="poste_id">Poste</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <i class="material-icons prefix">insert_invitation</i>
                    <?php echo '<input name="creneau_startdate" id="creneau_startdate" type="datetime-local" value="' . $creneau_startdate . '" required>'; ?>
                    <label class="active" for="creneau_startdate">Date de début</label>
                </div>


                <div class="input-field col s6">
                    <i class="material-icons prefix">insert_invitation</i>
                    <?php echo '<input name="creneau_enddate" id="creneau_enddate" type="datetime-local" value="' . $creneau_enddate . '" required>'; ?>
                    <label class="active" for="creneau_enddate">Date de fin</label>
                </div>
            </div>
            <div class="row">
                <div class="col s8 m4 l4"></div>
                <?php echo " <input type=\"hidden\" name=\"creneau_id\" value=\"$log_c\">"; ?>
                <?php echo " <input type=\"hidden\" name=\"poste_id\" value=\"$poste_id\">"; ?>
                <?php echo " <input type=\"hidden\" name=\"festival_id\" value=\"$festival_id\">"; ?>
                <input type="hidden" name="action" value=<?php if($type === 'gen'){echo "updatedGen";} else {echo "updated";}?>>
                <input type="hidden" name="controller" value="creneau">
                <input class="btn col s12 m4 l4" type="submit" value="Modifier" />
            </div>
        </form>
    </div>
</div>