<div class="row">
    <div class="col s12 m10 offset-m1 l8 offset-l2">
        <?php
        if ($next_action === 'updated') {
            echo "<form method=\"post\" action=\"index.php?action=$next_action" . "&controller=$controller" . "&festival_id=$festival_id\"" . " enctype=\"multipart/form-data\">";
        } else {
            echo "<form method=\"post\" action=\"index.php?action=$next_action" . "&controller=$controller\"" . " enctype=\"multipart/form-data\">";
        }
        ?>
        <div class="card-panel grey lighten-4">
            <h5>À propos du festival</h5>
            <div class="row">
                <div class="input-field col s5">
                    <i class="material-icons prefix">account_box</i>
                    <input name="festival_name" id="festival_name" type="text" class="validate" value="<?php echo $nameHTML; ?>" required>
                    <label for="festival_name">Nom du festival<span class="flow-text red-text" title="Ce champ est obligatoire ">*</span></label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">description</i>
                    <input name="festival_description" id="festival_description" type="text" class="validate" value="<?php echo $descriptionHTML; ?>" required>
                    <label for="festival_description">Description<span class="flow-text red-text" title="Ce champ est obligatoire ">*</span></label>
                </div>
            </div>


            <div class="row">
                <div class="input-field col s6">
                    <i class="material-icons prefix">insert_invitation</i>
                    <input name="festival_startdate" id="festival_startdate" placeholder=" " type="date" max="2050-01-01" min="2020-01-01" class="validate" value="<?php echo $startdateHTML; ?>" required>
                    <label for="festival_startdate">Date de début<span class="flow-text red-text" title="Ce champ est obligatoire ">*</span></label>
                </div>
                <div class="input-field col s6">
                    <i class="material-icons prefix">insert_invitation</i>
                    <input name="festival_enddate" id="festival_enddate" placeholder=" " type="date" max="2050-01-01" min="2020-01-01" class="validate" value="<?php echo $enddateHTML; ?>" required>
                    <label for="festival_enddate">Date de fin<span class="flow-text red-text" title="Ce champ est obligatoire ">*</span></label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s3">
                    <i class="material-icons prefix">place</i>
                    <input name="city" id="city" type="text" class="validate" value="<?php echo $cityHTML; ?>" required>
                    <label for="city">Ville<span class="flow-text red-text" title="Ce champ est obligatoire ">*</span></label>
                </div>
            </div>
        </div>

        <div class="row">
            <input type="hidden" name="action" value="<?php echo $next_action; ?>">
            <input type="hidden" name="user_id" value=<?php echo "\"" . $_SESSION['login'] . "\"" ?>>
            <input class="btn col s12 m4 offset-m4 l4 offset-l4" type="submit" value="Envoyer" />
        </div>
        </form>
    </div>
</div>