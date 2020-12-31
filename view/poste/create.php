<div class="row">
    <div class="card-panel col s12 m10 offset-m1 l8 offset-l2 grey lighten-4">
        <form method="get" action="index.php?action=updated&controller=poste">
            <h5 class="center-align">Ajouter un poste</h5>

            <div class="row">
                <div class="input-field col s6">
                    <i class="material-icons prefix">insert_invitation</i>
                    <?php echo '<input name="poste_name" id="poste_name" type="text" required>'; ?>
                    <label class="active" for="poste_name">Nom du poste</label>
                </div>


                <div class="input-field col s6">
                    <i class="material-icons prefix">insert_invitation</i>
                    <?php echo '<input name="poste_description" id="poste_description" type="text" required>'; ?>
                    <label class="active" for="poste_description">Description</label>
                </div>
            </div>
            <div class="row">
                <input type="hidden" name="action" value="created">
                <input type="hidden" name="controller" value="poste">
                <input type="hidden" name="festival_id" value=<?php echo "\"" . $_GET['festival_id'] . "\"" ?>>
                <button class="btn col s12 m4 offset-m4 l4 offset-l4" type="submit">Ajouter le poste</button>
            </div>
        </form>
    </div>
</div>