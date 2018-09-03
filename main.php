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
    <link rel="stylesheet" href="./css/style.css">
  </head>
    <body>
      <?php
      $title = isset($_POST["title"]) ? filter_input(INPUT_POST,'title',FILTER_SANITIZE_STRING) : "";
      $description = isset($_POST["description"]) ? filter_input(INPUT_POST,'description',FILTER_SANITIZE_STRING) : "";
      $posts = getPosts($_SESSION["userId"]);

      if (!empty($_SESSION["username"])) {
        echo "<h1>Bonjour " . $_SESSION["surname"] . " " . $_SESSION["name"] . ", voici votre fil d'actualités ! </h1>";
      }
      else{
        header("Location: index.php");
        exit;
      }


      if (filter_has_var(INPUT_POST, "add")) {
        if (empty($title) || empty($description)) {
          echo "<h1>All fields must be completed</h1>";
        }
        else{
          insertPost($_SESSION["userId"], $title, $description);
        }
      }

      if (filter_has_var(INPUT_POST, "logout")) {
        logout();
        header("Location: index.php");
        exit;
      }

       ?>
       <form action="main.php" method="POST">
         <fieldset>
             <legend>New post :</legend>
             <label for="uname"><b>Title</b></label></br>
             <input type="text" name="title" value="<?php echo $title ?>"></br>

             <label for="description"><b>Description</b></label></br>
             <textarea rows="10" cols="100" name="description"><?php echo $description ?></textarea>
             <button type="submit" name="add">Add</button>
         </fieldset>
         <button type="submit" name="logout">Log Out</button>
       </form>
       <?php foreach ($posts as $key => $value) {
         $user = getUserById($value["idUser"]);
         ?>
         <div class="post">
           <p> Auteur : <?php echo $user[0]["name"] ?> <?php echo $user[0]["surname"]; ?></p>
           <p> Posté le : <?php echo $value["creationDate"] ?>. Dernieres modifications le : <?php echo $value["lastEditDate"]; ?>.</p>
           <h2> <?php echo $value["title"]; ?> </h2>
           <p><?php echo $value["description"]; ?></p>
           <?php if ($user[0]["login"] == $_SESSION["username"]) : ?>
             <a href="./updateNews.php?idNews=<?php echo $value["idNews"];?>">Edit</a>
             <a href="./deleteNews.php?idNews=<?php echo $value["idNews"];?>">Delete</a>
           <?php endif; ?>

         </div>
       <?php } ?>

    </body>
</html>
