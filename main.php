<?php
/*
* Auteur : Machado Jorge
* Titre : EE,	Révision – Forum	- Chapitre	1
* Description : revision de la 2eme (Php/SQL)
* Version : 1.0.0
* Date : 30.08.2018
* Copyright : Entreprise Ecole CFPT-I © 2018
*/
include("./login.inc.php");
 ?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>EE Revision</title>
  </head>
    <body>
      <?php
      //if (!empty($_SESSION["username"])) {
        echo "<h1>Bonjour" . $_SESSION["surname"] . $_SESSION["name"] . ", voici votre fil d'actualités !";
    //  }
       ?>
    </body>
</html>
