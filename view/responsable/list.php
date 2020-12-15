
<?php
	// Liste tous les responsables
	
	$i = 1;
        foreach ($tab_nomResponsable as $r) {
                
                $user_id = rawurlencode($r->getResponsableId());
		$user_firstname = htmlspecialchars($r->getUserFirstname());
                $user_lastname = htmlspecialchars($r->getUserLastname());
              echo "<p>Responsable $i : <a href=\"index.php?action=read&controller=responsable&responsable_id=$user_id\"> <span class=\"title\">$user_firstname $user_lastname</span></a></p>";
            $i++;
        }

?>