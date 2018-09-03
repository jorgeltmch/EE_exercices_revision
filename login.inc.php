<?php
session_start();
/**
*	Connexion to the database
*	@return	$db pdo object
*/
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
/**
 * Adds user to the database
 * @param type $uname
 * @param type $pwd
 * @param type $fname
 * @param type $lname
 * @return false if the addition failed
 */
function addUser($uname, $pwd, $fname, $lname)
{
  echo "AHAHAHHA";
  if (userExists($uname) == false)
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
            return NULL;
        }
  }
  else{
      echo "username already exists !";
  }

}
/**
 * desfines if the username already exists
 * @param type $uname
 * @return boolean true or false depending on the result
 */
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
/**
 * Verifies if the connexion is correct
 * @param type $user
 * @param type $pwd
 * @return type
 */
function connexion($user, $pwd)
{
  $db = connectDb();
      $sql = "SELECT idUser, surname, name, login  FROM users "
              . "WHERE login = :uid AND password = :pwd";
      $request = $db->prepare($sql);
      if ($request->execute(array(
                  'uid' => $user,
                  'pwd' => sha1($pwd)))) {
            $result = $request->fetch(PDO::FETCH_ASSOC);

            var_dump($result["login"]);
            $_SESSION['username'] = $result['login'];
            $_SESSION['name'] = $result['name'];
            $_SESSION['surname'] = $result['surname'];
            $_SESSION["userId"] = $result["idUser"];
            return $result;


      }
      else {
          return NULL;
      }
  }
  /**
   * logs out and clears the session
   */
   function logout(){
    $_SESSION = array();
    if (ini_get("session.use_cookies"))
    {
      setcookie(session_name(), '', 0);
    }
    session_destroy();

  }
  /**
   * inserts the post in the database
   * @param type $idUser (user that published the post)
   * @param type $title
   * @param type $description
   * @return the post if that worked, if not, returns null
   */
  function insertPost($idUser, $title, $description){
    try {
            $db = connectDb();
            $sql = "INSERT INTO news(title,description,idUser) " .
                    " VALUES (:title, :description, :id)";
            $request = $db->prepare($sql);
            if ($request->execute(array(
                        'title' => $title,
                        'description' => $description,
                        'id' => $idUser))) {
                return $db->lastInsertID();
            } else {
                return NULL;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            return array();
        }
  }
  /**
   * returns all of the user's posts
   * @param type $userId
   * @return \Exception
   */
  function getPosts($userId){
    try {
        $db = connectDb();
        $sql = "SELECT idNews, title, description, creationDate, lastEditDate, idUser FROM news ORDER BY lastEditDate DESC";

        $request = $db->prepare($sql);
        if ($request->execute(array(
                    'id' => $userId))) {
            $result = $request->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return NULL;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
        return $e;
    }
  }
  /**
   * returns selected news
   * @param type $idNews
   * @return \Exception
   */
  function getNewsById($idNews){
    try {
        $db = connectDb();
        $sql = "SELECT description, title FROM news "
                . "WHERE idNews = :id";

        $request = $db->prepare($sql);
        if ($request->execute(array(
                    'id' => $idNews))) {
            $result = $request->fetch(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return NULL;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
        return $e;
    }
  }

  /**
   * returns selected user
   * @param type $idUser
   * @return \Exception
   */
function getUserById($idUser){
  try {
      $db = connectDb();
      $sql = "SELECT surname, name, login FROM users "
              . "WHERE idUser = :id";

      $request = $db->prepare($sql);
      if ($request->execute(array(
                  'id' => $idUser))) {
          $result = $request->fetchAll(PDO::FETCH_ASSOC);
          return $result;
      } else {
          return NULL;
      }
  } catch (Exception $e) {
      echo $e->getMessage();
      return $e;
  }
}
/**
 * edits news that already exists
 * @param type $idNews
 * @param type $title
 * @param type $description
 * @return boolean true or false depending on if it worked or not
 */
function editNews($idNews, $title, $description){
  try {
          $db = connectDb();
          $sql = "UPDATE news SET title = :title , description = :description WHERE idNews = :id";
          $request = $db->prepare($sql);
          if ($request->execute(array(
                      'id' => $idNews,
                      'title' => $title,
                      'description' => $description
                    ))) {
              return true;
          } else {
              return false;
          }
      } catch (Exception $e) {
          echo $e->getMessage();
          return false;
      }
}

/**
 * deletes news that already exists
 * @param type $idNews
 * @param type $title
 * @param type $description
 * @return boolean true or false depending on if it worked or not
 */
function deleteNews($idNews){
  try {
          $db = connectDb();
          $sql = "DELETE FROM news WHERE idNews = :id";
          $request = $db->prepare($sql);
          if ($request->execute(array(
                      'id' => $idNews
                    ))) {
              return true;
          } else {
              return false;
          }
      } catch (Exception $e) {
          echo $e->getMessage();
          return false;
      }
}
