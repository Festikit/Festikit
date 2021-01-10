
<<<<<<< HEAD
<?php
	// Liste tous les responsables
	
	$i = 1;
        foreach ($tab_nomResponsable as $r) {
                
=======
    <div class="card col l8 offset-l2 col m10 offset-m1 col s12">
        <ul class="collection">
            <li class="collection-header">
                <h4>Liste de tous les responsables</h4>
            </li>
            <?php
            // Liste tous les responsables
            $i = 1;
            foreach ($tab_nomResponsable as $r) {
>>>>>>> parent of 6845639... Debug responsable
                $user_id = rawurlencode($r->getResponsableId());
		$user_firstname = htmlspecialchars($r->getUserFirstname());
                $user_lastname = htmlspecialchars($r->getUserLastname());
              echo "<p>Responsable $i : <a href=\"index.php?action=read&controller=responsable&responsable_id=$user_id\"> <span class=\"title\">$user_firstname $user_lastname</span></a></p>";
            $i++;
        }

?>