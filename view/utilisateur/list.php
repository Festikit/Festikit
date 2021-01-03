<div class="row">

    <div class="card col l8 offset-l2 col m10 offset-m1 col s12">
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
                echo
                    '<li class="collection-item avatar">
            <img class="circle" alt="profil" src="data:image/jpg;base64,' . base64_encode($user_picture) . '" onerror="this.onerror=null; this.src=\'data:image/png;base64,' . base64_encode($user_picture) . '\'" width="70px"/>';
                echo "
            <a href=\"index.php?action=read&user_id=$user_id\"> <span class=\"title\">$user_firstname</span><p> $user_lastname</p></a>
            <div class=\"secondary-content\">
                <a title=\"en savoir plus\" href=\"index.php?action=read&user_id=$user_id\" class=\"btn\"><i class=\"material-icons\">more</i></a>
                <a title=\"supprimer\" href=\"#confirmation$user_id\" class=\"btn modal-trigger\"><i class=\"material-icons\">delete</i></a>
                <a title=\"modifier\" href=\"index.php?action=update&user_id=$user_id\" class=\"btn\"><i class=\"material-icons\">edit</i></a>
            </div>
            <div id=\"confirmation$user_id\" class=\"modal\">
                <div class=\"modal-content\">
                    <h4>Êtes vous sûr de vouloir le supprimer ?</h4>
                    <p>Cette action sera irréversible.</p>
                </div>
                <div class=\"modal-footer\">
                    <a href=\"#!\" class=\"modal-close waves-effect waves-green btn-flat\">Annuler</a>
                    <a href=\"index.php?action=delete&user_id=$user_id\" class=\"btn red modal-close waves-effect waves-green btn-flat\">Supprimer</a>
                </div>
            </div>
        </li>
";
                $i++;
            }
            ?>
        </ul>
    </div>
</div>