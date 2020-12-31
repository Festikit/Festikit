
<?php

echo "<p> Le créneaux d'Id " . htmlspecialchars($c->getCreneauId()) .
    " commence le : " . htmlspecialchars($c->getCreneauStart()) .
    " et finit le : " . htmlspecialchars($c->getCreneauEnd()) . "</p>" .
    "<p> Il est assigné : <br>" .
    "- au festival d'Id : <a href=\"index.php?action=read&controller=festival&festival_id=" . rawurlencode($c->getFestivalId()) . "\">" . htmlspecialchars($c->getFestivalId()) . "</a><br>" .
    "- au poste d'Id : <a href=\"index.php?action=read&controller=poste&poste_id=" . rawurlencode($c->getPosteId()) . "\">" . htmlspecialchars($c->getPosteId()) . "</a></p>";

echo "<p> Retour: <a href=\"index.php?action=readAll&controller=$controller\">Cliquez ici </a> </p>";
