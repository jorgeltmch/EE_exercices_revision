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
$idNews = $_GET["idNews"];
$news = getNewsById($idNews);
$delete = isset($_POST["delete"]) ? $_POST["delete"] : "";
  if ($delete == true && !empty($idNews)) {
    if (deleteNews($idNews) == true) {
      echo ":)";
      header("Location: main.php");
      exit;
    }
    else{
      echo "<div class=\"info\">The news was deleted</div>";
    }
  }
  else{
      echo "<div class=\"info\">The news did not got deleted</div>";
  }
 ?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>EE Revision</title>
    <link rel="stylesheet" href="../resources/style.css">
  </head>
    <body>
      <form action="#" method="post">
       <p>Are you sure you want to delete this news ? </p>
       <input type="radio" name="delete" value="true"> Yes
       <input type="radio" name="delete" value="false" checked="checked"> No
       <input type="submit" name="btnOK" value="Delete"><br>
     </form>
    </body>
</html>
