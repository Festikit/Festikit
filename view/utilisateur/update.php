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


<?php echo '<form method="get" action="index.php?action=updated ">'; ?>
<fieldset>
    <legend>Mon formulaire :</legend>
    <p>
        <label for="username_id">Login</label> :
        <?php echo '<input type="text" value="'.rawurldecode($log_u).'" name="user_id" id="username_id" readonly/>'; ?>
    </p>
    <p>
        <label for="user_firstname_id">user_firstname</label> :
        <?php echo '<input type="text" value="'.rawurlencode($user_firstname).'" name="user_firstname" id="user_firstname_id" required/>';?>
    </p>
    <p>
        <label for="user_lastname_id">user_lastname</label> :
        <?php echo '<input type="text" value=" '.rawurlencode($user_lastname).'" name="user_lastname" id="user_lastname_id" required/> ';?>
    </p>
    <p>
        <label for="user_mail_id">user_mail</label> :
        <?php echo '<input type="text" value="'.rawurldecode($user_mail).'" name="user_mail" id="user_mail_id" readonly/>'; ?>
    </p>
    <p>
        <label for="user_phone_id">user_phone</label> :
        <?php echo '<input type="text" value="'.rawurlencode($user_phone).'" name="user_phone" id="user_phone_id" required/>';?>
    </p>
    <p>
        <label for="user_birthdate_id">user_birthdate</label> :
        <?php echo '<input type="text" value=" '.rawurlencode($user_birthdate).'" name="user_birthdate" id="user_birthdate_id" required/> ';?>
    </p>
    <p>
        <?php echo '<input type="hidden" name="action" value="updated">';?>
        <input type="submit" value="Envoyer" />
    </p>
</fieldset>
</form>

