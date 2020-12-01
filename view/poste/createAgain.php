<div class="row">
    <div class="col s12 m4 l2">
    </div>
    <div class="card-panel col s12 m12 l8 grey lighten-4">
        <form method="get" action="index.php?action=updated&controller=poste">
            <h5 class="center-align">Le poste à été créé, en ajouter un autre ?</h5>
            
            
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
                <div class="col s8 m4 l4"></div>
                <input type="hidden" name="action" value="created">
                <input type="hidden" name="controller" value="poste">
                <input type="hidden" name="festival_id" value=<?php echo "\"" . $_GET['festival_id'] . "\"" ?>>
                <input class="btn col s12 m4 l4" type="submit" value="Rajouter un poste" />
            </div>
        </form>
    </div>
</div>