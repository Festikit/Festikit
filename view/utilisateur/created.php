<div class="row">
    <form class="col s6">
        <?php
        $festival_nameHTML = htmlspecialchars($festival->getFestivalName());
        echo '<p>Inscription validé pour le festival' . "\"$festival_nameHTML\"" . ', veuillez confirmer votre compte par mail !</p>'; 
            
        ?>
    </form>
</div>

<div class="row">
    <form class="col s6">
        <?php
        echo '<a class="btn-large waves-effect waves-light secondary-content" href="index.php?action=connect">Se connecter</a>';
        ?>
    </form>
</div>
