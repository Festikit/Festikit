<div class="row">
    <div class="col s12 m4 l2">
    </div>
    <div class="col s12 m4 l8">
        <?php
        if (!($log_p == "" && $poste_name == "" && $poste_description == "")) {
            $log_p = htmlspecialchars($tab_p->getPosteId());
            $poste_name = htmlspecialchars($tab_p->getPosteName());
            $poste_description = htmlspecialchars($tab_p->getPosteDescription());
        }
        ?>

        <form method="get" action="index.php?action=updated&controller=poste">
                <div class="card-panel col s12 grey lighten-4">
                    <h5 class="center-align">Modifier ce poste</h5>
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">assignment_ind</i>
                            <?php echo '<input name="poste_id" id="poste_id" type="number" value="' . $log_p . '" required readonly>'; ?>
                            <label class="active" for="poste_id">ID</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">Nom</i>
                            <?php echo '<input name="poste_name" id="poste_name" type="text" value="' . $poste_name . '" required>'; ?>
                            <label class="active" for="poste_name">Nom</label>
                        </div>
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
                    <div class="col s12 m4 l4"></div>
                    <input type="hidden" name="action" value="updated">
                    <input type="hidden" name="controller" value="poste">
                    <input class="btn col s12 m4 l4" type="submit" value="Modifier" />
                </div>
            </div>
        </form>
    </div>
</div>