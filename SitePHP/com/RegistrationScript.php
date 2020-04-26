<?php 

function addUser($name, $login, $password, $mail) {
    require_once('DatabaseHandler.php');
    $db = new DatabaseHandler();
    $db->tableName = 'users';
    $db->connect();
    $name = $db->link->real_escape_string($name);
    $login = $db->link->real_escape_string($login);
    $password = $db->link->real_escape_string($password);
    $mail = $db->link->real_escape_string($mail);
    $db->makeQuery('SELECT user_name FROM users WHERE login=\'' . $login . '\';');
    $row = mysqli_fetch_array($db->result);
    if(empty($row)) {
        $db->makeQuery('INSERT INTO users VALUES(NULL, \'' . $name . '\', \'' . 
            $login . '\', \'' . $password . '\', \'' . $mail . '\');');
        return true;
    } else {
        return false;
    }
}

 