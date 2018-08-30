<?php
function connectDb()
{
    $server = '127.0.0.1';
    $pseudo = 'root';
    $pwd = '';
    $dbname = 'forum';

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
  if (userExists($uname) == false) {
    try {
            $db = connectDb();
            $sql = "INSERT INTO users(name,surname,login,password) " .
                    " VALUES (:lastName, :firstName, :username, :pwd)";
            $request = $db->prepare($sql);
            if ($request->execute(array(
                        'lastName' => $fname,
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

function userExists($uname) {
    try {
        $db = connectDb();
        $sql = "SELECT login FROM users "
                . "WHERE login = :username";

        $request = $db->prepare($sql);
        if ($request->execute(array(
                    'username' => $uname))) {
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
