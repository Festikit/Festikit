<?php

echo "<p>Nom du poste : " . htmlspecialchars($p->getPosteName()) . "</p>" . 
    "<p>Description du poste : " . htmlspecialchars($p->getPosteDescription()) . "<br>
    Poste affecté au festival d'Id : <a href=\"index.php?action=read&controller=festival&festival_id=" . rawurlencode($p->getFestivalId()) . "\">" . htmlspecialchars($p->getFestivalId()) . "</a></p>";

echo "<p> Retour: <a href=\"index.php?action=read&controller=festival&festival_id=" . rawurlencode($p->getFestivalId()) . "\">Cliquez ici </a> </p>";
