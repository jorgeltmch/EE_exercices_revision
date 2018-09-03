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
  if (!empty($_POST["title"]) && !empty($_POST["title"]) && !empty($idNews)) {
    $title = filter_input(INPUT_POST,'title',FILTER_SANITIZE_STRING);
    $description = filter_input(INPUT_POST,'description',FILTER_SANITIZE_STRING);
    if (editNews($idNews, $title, $description) == true) {
      
      echo ":)";
    }
    else{
      echo ":(";
    }
  }
 ?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>EE Revision</title>
    <link rel="stylesheet" href="./css/style.css">
  </head>
    <body>
      <?php
       ?>
       <form action="#" method="POST">
         <fieldset>
             <legend>New post :</legend>
             <label for="uname"><b>Title</b></label></br>
             <input type="text" name="title" value="<?php echo $news["title"] ?>"></br>

             <label for="description"><b>Description</b></label></br>
             <textarea rows="10" cols="100" name="description"><?php echo $news["description"] ?></textarea>
             <button type="submit" name="edit">Edit</button>
         </fieldset>
       </form>
    </body>
</html>
