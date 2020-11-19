<?php
if (!($log_c == "" && $creneau_startdate == "" && $creneau_enddate == "" && $festival_id == "" && $poste_id == "")) {
    $log_c = htmlspecialchars($tab_c->getCreneauId());
    $creneau_startdate = htmlspecialchars($tab_c->getCreneauStart());
    $creneau_enddate = htmlspecialchars($tab_c->getCreneauEnd());
    $festival_id = htmlspecialchars($tab_c->getFestivalId());
    $poste_id = htmlspecialchars($tab_c->getPosteId());
}
?>

<form method="get" action="index.php?action=updated&controller=creneau">
        <div class="card-panel col s12 grey lighten-4">
            <h5 class="center-align">Modifier ce creneau</h5>
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">assignment_ind</i>
                    <?php echo '<input name="creneau_id" id="creneau_id" type="number" value="' . $log_c . '" required readonly>'; ?>
                    <label class="active" for="creneau_id">ID</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">insert_invitation</i>
                    <?php echo '<input name="creneau_startdate" id="creneau_startdate" type="datetime-local" value="' . $creneau_startdate . '" required>'; ?>
                    <label class="active" for="creneau_startdate">Date de début</label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix">insert_invitation</i>
                <?php echo '<input name="creneau_enddate" id="creneau_enddate" type="datetime-local" value="' . $creneau_enddate . '" required>'; ?>
                <label class="active" for="creneau_enddate">Date de fin</label>
            </div>
        </div>
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">music_note</i>
                    <?php echo '<input name="festival_id" id="festival_id" type="text" value="' . $festival_id . '" required readonly>'; ?>
                    <label class="active" for="festival_id">Id du festival</label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix">work</i>
                <?php echo '<input name="poste_id" id="poste_id" type="text" value="' . $poste_id . '" required readonly>'; ?>
                <label class="active" for="poste_id">Id du poste</label>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m4 l4"></div>
            <input type="hidden" name="action" value="updated">
            <input type="hidden" name="controller" value="creneau">
            <input class="btn col s12 m4 l4" type="submit" value="Modifier" />
        </div>
    </div>
</form>