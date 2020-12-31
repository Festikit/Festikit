<ul class="collection">
    <li class="collection-header">
        <h4>Liste de tous les utilisateurs</h4>
    </li>
    <?php
    // Liste tous les utilisateurs de la base de donnée: bénévoles (postulé accepté: oui et non) et les responsables
    $i = 1;
    foreach ($tab_u as $u) {
        $user_id = rawurlencode($u->getId());
        $user_firstname = htmlspecialchars($u->getFirstname());
        $user_lastname = htmlspecialchars($u->getLastname());
        $user_picture = $u->getPicture();
        echo '<li class="collection-item avatar">
        <img class="circle" alt="profil" src="data:image/jpg;base64,' . base64_encode($user_picture) . '" onerror="this.onerror=null; this.src=\'data:image/png;base64,' . base64_encode($user_picture) . '\'" width="70px"/>';
        echo "
        <a href=\"index.php?action=read&user_id=$user_id\"> <span class=\"title\">$user_firstname</span><p> $user_lastname</p></a>
        <div class=\"secondary-content\">
            <a title=\"en savoir plus\" href=\"index.php?action=read&user_id=$user_id\" class=\"btn\"><i class=\"material-icons\">more</i></a>
            <a title=\"supprimer\" href=\"index.php?action=delete&user_id=$user_id\" class=\"btn\"><i class=\"material-icons\">delete</i></a>
            <a title=\"modifier\" href=\"index.php?action=update&user_id=$user_id\" class=\"btn\"><i class=\"material-icons\">edit</i></a>
        </div>
    </li>";
        $i++;
    }
    ?>
</ul>