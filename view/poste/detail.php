<?php

echo htmlspecialchars($p->getPosteName()) . " :" . htmlspecialchars($p->getPosteDescription());

echo "<p> Retour: <a href=\"index.php?action=readAll&controller=poste\">Cliquez ici </a> </p>";
