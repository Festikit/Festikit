<?php
if (!($log_u == "" && $user_firstname == "" && $user_lastname == "" && $user_mail == "" && $user_phone == "" && $user_birthdate == "")) {
    $log_u = htmlspecialchars($tab_u->getId());
    $user_firstname = htmlspecialchars($tab_u->getFirstname());
    $user_lastname = htmlspecialchars($tab_u->getLastname());
    $user_mail = htmlspecialchars($tab_u->getMail());
    $user_phone = htmlspecialchars($tab_u->getPhone());
    $user_birthdate = htmlspecialchars($tab_u->getBirthdate());
}
?>

<form method="get" action="index.php?action=updated">
        <div class="card-panel col s12 grey lighten-4">
            <h5 class="center-align">À propos de moi</h5>
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">assignment_ind</i>
                    <?php echo '<input name="user_id" id="user_id" type="number" value="'. rawurldecode($log_u) . '" required disabled>' '<input type="text" value="'; ?>
                    <label class="active" for="user_id">ID</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">email</i>
                    <?php echo '<input name="user_firstname" id="user_email" type="email" value="' . rawurldecode($user_mail) . '" required disabled>'; ?>
                    <label class="active" for="user_email">Email</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <i class="material-icons prefix">person</i>
                    <?php echo '<input id="user_lastname" type="text" value="' . rawurlencode($user_lastname) .'" class="validate" required>'; ?>
                    <label class="active" for="user_lastname">Nom</label>
                </div>
                <div class="input-field col s6">
                <?php echo '<input id="user_fistname" type="text" value="' . rawurlencode($user_firstname) . '" class="validate" required>'; ?>
                    <label class="active" for="user_fistname">Prenom</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <i class="material-icons prefix">insert_invitation</i>
                <?php echo '<input name"user_birthdate" id="user_birthdate" type="date" max="2010-01-01" min="1900-01-01" class="validate" value="' . rawurlencode($user_birthdate) . '" name="user_birthdate" required>'; ?>
                    <label for="user_birthdate" class="active">date de naissance</label>
                </div>
                <div class="file-field input-field col s6">
                    <div class="btn">
                        <i class="material-icons">file_download</i>
                        <span>Photo de profil</span>
                        <input name="user_picture" id="user_picture" type="file" accept="image/png, image/jpeg">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <i class="material-icons prefix">person_pin</i>
                    <?php echo '<input id="user_postal_code" type="number" value="' .rawurlencode($user_postal_code). '" class="validate" required>'; ?>
                    <label for="user_postal_code" class="active">Code Postal</label>
                </div>
                <div class="input-field col s6">
                    <i class="material-icons prefix">phone</i>
                    <?php echo '<input id="user_phone" name="user_phone" value="' . rawurlencode($user_phone) . '" type="tel" class="validate" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" required>'; ?>
                    <label for="user_phone" class="active">Numéro de Téléphone</label>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m4 l4"></div>
                <input type="hidden" name="action" value="updated">
                <input class="btn col s12 m4 l4" type="submit" value="Modifier" />
            </div>
        </div>
</form>
