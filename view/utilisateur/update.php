<?php
//if (!($log_u == "" && $user_firstname == "" && $user_lastname == "" && $user_mail == "" && $user_phone == "" && $user_birthdate == "")) {
$log_u = htmlspecialchars($tab_u->getId());
$user_firstname = htmlspecialchars($tab_u->getFirstname());
$user_lastname = htmlspecialchars($tab_u->getLastname());
$user_mail = htmlspecialchars($tab_u->getMail());
$user_phone = htmlspecialchars($tab_u->getPhone());
$user_postal_code = htmlspecialchars($tab_u->getPostalCode());
$user_birthdate = htmlspecialchars($tab_u->getBirthdate());
//}
?>

<div class="row">
    <div class="card-panel col s12 m10 offset-m1 l8 offset-l2 grey lighten-4">
        <form method="post" action="index.php?action=updated" enctype="multipart/form-data">
            <h5 class="center-align">À propos de moi</h5>
            <div class="row">
                <div class="input-field col s9">
                    <i class="material-icons prefix">email</i>
                    <?php echo '<input name="user_mail" id="user_mail" type="email" value="' . rawurldecode($user_mail) . '" required>'; ?>
                    <label class="active" for="user_mail">Email</label>
                </div>
                <div class="col s3"></div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <i class="material-icons prefix">person</i>
                    <?php echo '<input name="user_lastname" id="user_lastname" type="text" value="' . rawurldecode($user_lastname) . '" class="validate" required>'; ?>
                    <label class="active" for="user_lastname">Nom</label>
                </div>
                <div class="input-field col s6">
                    <?php echo '<input name="user_firstname" id="user_firstname" type="text" value="' . rawurldecode($user_firstname) . '" class="validate" required>'; ?>
                    <label class="active" for="user_firstname">Prenom</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <i class="material-icons prefix">insert_invitation</i>
                    <?php echo '<input name="user_birthdate" id="user_birthdate" type="date" max="2010-01-01" min="1900-01-01" class="validate" value="' . rawurldecode($user_birthdate) . '" name="user_birthdate" required>'; ?>
                    <label for="user_birthdate" class="active">date de naissance</label>
                </div>
                <div class="file-field input-field col s6">
                    <div class="btn">
                        <i class="material-icons">file_download</i>
                        <span>Photo de profil</span>
                        <input type="hidden" name="MAX_FILE_SIZE" value="64000" />
                        <input name="user_picture" id="user_picture" type="file" accept="image/png, image/jpeg, image/jpg" required>
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <i class="material-icons prefix">person_pin</i>
                    <?php echo  '<input name="user_postal_code" id="user_postal_code" type="number" value="' . rawurldecode($user_postal_code) . '" class="validate" required>'; ?>
                    <label for="user_postal_code" class="active">Code Postal</label>
                </div>
                <div class="input-field col s6">
                    <i class="material-icons prefix">phone</i>
                    <?php echo '<input id="user_phone" name="user_phone" value="' . rawurldecode($user_phone) . '" type="tel" class="validate" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" required>'; ?>
                    <label for="user_phone" class="active">Numéro de Téléphone</label>
                </div>
            </div>
    </div>
    <div class="row">
        <input type="hidden" name="action" value="updated">
        <input type="hidden" name="user_id" value="<?php echo rawurldecode($log_u) ?>">
        <button class="btn col s12 m4 offset-m4 l4 offset-l4" type="submit">Modifier</button>
    </div>
    </form>
</div>
</div>