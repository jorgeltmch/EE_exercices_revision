<?php
/*
* Auteur : Machado Jorge
* Titre : EE,	Révision – Forum	- Chapitre	1
* Description : revision de la 2eme (Php/SQL)
* Version : 1.0.0
* Date : 30.08.2018
* Copyright : Entreprise Ecole CFPT-I © 2018
*/

//if (filter_has_var(INPUT_POST,'submit')) {
     // récupération des données provenant des données saisies par l'utilisateur

    $uname = trim(filter_input(INPUT_POST,'uname',FILTER_SANITIZE_STRING));
    $pwd = trim(filter_input(INPUT_POST,'pwd',FILTER_SANITIZE_STRING));

    // vérification des données saisies
    /*
    $result = checkUserIdentification($pseudo, $pwd);
    if (empty($result)) {
        $errors['Login'] = 'Identification ou mot de passe invalide';
    } else {
        $_SESSION['user'] = $result;
        SetMessageFlash('Bienvenue '.$result['firstName'].' '.$result['lastName'],"success");
        header("location:showusers.php");
        exit;
    }
    */
//}

 ?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>EE Revision</title>
  </head>
    <body>
      <form action="index.php" method="POST">
        <fieldset>
            <legend>Connexion :</legend>
            <label for="uname"><b>Username</b></label></br>
            <input type="text" placeholder="Enter Username" name="uname" required></br>

            <label for="psw"><b>Password</b></label></br>
            <input type="password" placeholder="Enter Password" name="pwd" required></br>

            <button type="submit" name="submit">Login</button>
            <button type="button" name="cancel">Cancel</button>
            <a href="./signup.php">Don't have an account?</a>
        </fieldset>
      </form>
      <?php
      if (!empty($uname) && !empty($pwd)) {
        echo $uname . " " . $pwd;
      }
       ?>
    </body>
</html>
