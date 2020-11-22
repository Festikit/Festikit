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

        <div class="card-panel col s12 grey lighten-4">
            <form method="get" action="index.php?action=updated&controller=poste">
                <h5 class="center-align">Modifier ce poste</h5>
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">Nom</i>
                        <?php echo '<input name="poste_name" id="poste_name" type="text" value="' . $poste_name . '" required>'; ?>
                        <label class="active" for="poste_name">Nom</label>
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
                    <?php echo " <input type=\"hidden\" name=\"poste_id\" value=\"$log_p\">"; ?>
                    <input type="hidden" name="action" value="updated">
                    <input type="hidden" name="controller" value="poste">
                    <input class="btn col s12 m4 l4" type="submit" value="Modifier" />
                </div>
        </div>
    </div>
    </form>
</div>
<ul class="collection">
    <li class="collection-header">
        <a class="btn-large waves-effect waves-light secondary-content" href="index.php?action=read&controller=creneau&creneau_id=$creneau_id"> Ajouter un creneau</a>
        <h4 class="center">Liste des creneaux</h4>
    </li>
    <?php
    if (!$tab_creneau) {
        echo "<li> <span class=\"title\"> Le poste n'a aucun créneau </span> </li>";
    } else {
        foreach ($tab_creneau as $creaneau) {
            $creneau_id = htmlspecialchars($creaneau->getCreneauId());
            $creneau_startdate = htmlspecialchars($creaneau->getCreneauStart());
            $creneau_enddate = $creaneau->getCreneauEnd();
            echo "<li class=\"collection-item avatar\">
            <span class=\"title\"> <a href=\"index.php?action=read&controller=creneau&creneau_id=$creneau_id\">Créneau $creneau_id</a> </span>
            <p>Début: $creneau_startdate</p>
            <p>Fin: $creneau_enddate</p>
    		<div class=\"secondary-content\">
                <a title=\"en savoir plus\" href=\"index.php?action=read&controller=creneau&creneau_id=$creneau_id\" class=\"btn\"><i class=\"material-icons\">more</i></a>
                <a title=\"modifier\" href=\"index.php?action=update&controller=creneau&creneau_id=$creneau_id\" class=\"btn\"><i class=\"material-icons\">edit</i></a>
    		</div>
    	</li>";
        }
    }
    ?>
</ul>