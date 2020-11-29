<div class="row">
    <div class="col s12 m4 l2">
    </div>
    <div class="col s12 m4 l8">
        <?php
        /*
            echo "<form method=\"post\" action=\"index.php?action=created&user_id=" . $_GET['user_id'] . "\" enctype=\"multipart/form-data" . " class=\"col s12\">";
        */
        ?>

        <form method="post" action="index.php?action=created&controller=festival" enctype="multipart/form-data" class="col s12">

            <div class="card-panel grey lighten-4">
                <h5>À propos du festival</h5>
                <div class="row">
                    <div class="input-field col s5">
                        <i class="material-icons prefix">account_box</i>
                        <input name="festival_name" id="festival_name" type="text" class="validate" required>
                        <label for="festival_name">Nom du festival<span class="flow-text red-text" title="Ce champ est obligatoire ">*</span></label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">description</i>
                        <input name="festival_description" id="festival_description" type="text" class="validate" required>
                        <label for="festival_description">Description<span class="flow-text red-text" title="Ce champ est obligatoire ">*</span></label>
                    </div>
                </div>


                <div class="row">
                    <div class="input-field col s6">
                        <i class="material-icons prefix">insert_invitation</i>
                        <input name="festival_startdate" id="festival_startdate" placeholder=" " type="date" max="2050-01-01" min="2020-01-01" class="validate" required>
                        <label for="festival_startdate">Date de début<span class="flow-text red-text" title="Ce champ est obligatoire ">*</span></label>
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix">insert_invitation</i>
                        <input name="festival_enddate" id="festival_enddate" placeholder=" " type="date" max="2050-01-01" min="2020-01-01" class="validate" required>
                        <label for="festival_enddate">Date de fin<span class="flow-text red-text" title="Ce champ est obligatoire ">*</span></label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s3">
                        <i class="material-icons prefix">place</i>
                        <input name="city" id="city" type="text" class="validate" required>
                        <label for="city">Ville<span class="flow-text red-text" title="Ce champ est obligatoire ">*</span></label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col s12 m4 l4"></div>
                <input type="hidden" name="action" value="created">
                <input class="btn col s12 m4 l4" type="submit" value="Envoyer" />
            </div>
        </form>
    </div>
</div>