<?php
session_start();
function connectDb()
{
    $server = '127.0.0.1';
    $pseudo = 'root';
    $pwd = '';
    $dbname = 'forumrevision';

    static $db = null;

    if ($db === null)
    {
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        $db = new PDO("mysql:host=$server;dbname=$dbname", $pseudo, $pwd, $pdo_options);
        $db->exec('SET CHARACTER SET utf8');
    }
    return $db;
}

function addUser($uname, $pwd, $fname, $lname)
{
  if (userExists($uname) != true)
 {
    try {
            $db = connectDb();
            $sql = "INSERT INTO users(name,surname,login,password) " .
                    " VALUES (:lastName, :firstName, :username, :pwd)";
            $request = $db->prepare($sql);
            if ($request->execute(array(
                        'lastName' => $lname,
                        'firstName' => $fname,
                        'username' => $uname,
                        'pwd' => sha1($pwd)))) {
                return $db->lastInsertID();
            } else {
                return NULL;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            return array();
        }
  }
  else{
      echo "username already exists !";
  }

}

function userExists($uname)
{
    try {
        $db = connectDb();
        $sql = "SELECT login FROM users "
                . "WHERE login = :login";

        $request = $db->prepare($sql);
        if ($request->execute(array(
                    'login' => $uname))) {
            $result = $request->fetch(PDO::FETCH_ASSOC);
            if (isset($result['login'])) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }
}

function connexion($user, $pwd)
{
  $db = connectDb();
      $sql = "SELECT idUser, surname, name, login  FROM users "
              . "WHERE idUser = :uid AND password = :pwd";
      $request = $db->prepare($sql);
      if ($request->execute(array(
                  'uid' => $user,
                  'pwd' => sha1($pwd)))) {
          $result = $request->fetch(PDO::FETCH_ASSOC);
          var_dump($result);
          $_SESSION['username'] = $result['login'];
          $_SESSION['name'] = $result['name'];
          $_SESSION['surname'] = $result['surname'];
          return true;
      }
      else {
          return false;
      }
  }
