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
$lname = isset($_POST["lastName"]) ? filter_input(INPUT_POST,'lastName',FILTER_SANITIZE_STRING) : "";
$fname = isset($_POST["firstName"]) ? filter_input(INPUT_POST,'firstName',FILTER_SANITIZE_STRING) : "";
$uname = isset($_POST["uName"]) ? filter_input(INPUT_POST,'uName',FILTER_SANITIZE_STRING) : "";

/*$lname = filter_input(INPUT_POST,'lastName',FILTER_SANITIZE_STRING);
$fname = filter_input(INPUT_POST,'firstName',FILTER_SANITIZE_STRING);
$uname = trim(filter_input(INPUT_POST,'uName',FILTER_SANITIZE_STRING)); */
$pwd = filter_input(INPUT_POST,'pwd',FILTER_SANITIZE_STRING);
$cpwd = filter_input(INPUT_POST,'confirmedPwd',FILTER_SANITIZE_STRING);

if (!empty($uname) && !empty($pwd) && !empty($cpwd) && !empty($fname) && !empty($lname)) {
  if ($pwd == $cpwd) {
    addUser($uname, $pwd, $fname, $lname);
  }
  else{
    echo "<div class=\"warning\">Passwords don't match</div>";
  }
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
      <form action="signup.php" method="POST">
        <fieldset>
            <legend>Inscription :</legend>
            <label for="firstName"><b>First name</b></label></br>
            <input type="text" placeholder="Enter first name" name="firstName" value="<?php echo $fname ?>"required></br>

            <label for="lastName"><b>Last name</b></label></br>
            <input type="text" placeholder="Enter last name" name="lastName" value="<?php echo $lname ?>" required></br>

            <label for="uname"><b>Username</b></label></br>
            <input type="text" placeholder="Enter Username" name="uName" value="<?php echo $uname ?>" required></br>

            <label for="psw"><b>Password</b></label></br>
            <input type="password" placeholder="Enter Password" name="pwd" required></br>

            <label for="confirmedPwd"><b>Confirm password</b></label></br>
            <input type="password" placeholder="Enter Password" name="confirmedPwd" required></br>

            <button type="submit" name="submit">Sign up</button>
            <button type="button" name="cancel">Cancel</button>
            <a href="./index.php"> Already have an account? </a>
        </fieldset>
      </form>
      <?php

       ?>
    </body>
</html>
