<?php

echo "Vous n'avez pas les droits pour cette page";

sleep(3);
header('Location: /visiteur.php');
exit();