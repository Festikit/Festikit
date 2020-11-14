
<?php

echo "<p> Le créneaux d'Id ". htmlspecialchars($c->getCreneauId()) . 
    " commence le : ". htmlspecialchars($c->getCreneauStart()) . 
    " et finit le : " . htmlspecialchars($c->getCreneauEnd()) . "</p>" .
    "<p> Il est assigné : <br> - au festival d'Id : ". htmlspecialchars($c->getFestivalId()) . "<br>" .
    "- au poste d'Id : ". htmlspecialchars($c->getPosteId()) . "</p>";

echo "<p> Retour: <a href=\"index.php?action=readAll&controller=$controller\">Cliquez ici </a> </p>";
