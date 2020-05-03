<?php

function getUserName($login) {
    require_once('DatabaseHandler.php');
    $db = new DatabaseHandler();
    $db->tableName = 'users';
    $db->connect();
    $login = $db->link->real_escape_string($login);
    $db->makeQuery('SELECT user_name FROM users WHERE login=\'' . $login .'\';');
    $row = mysqli_fetch_array($db->result);
    if(isset($row)) {
        return $row['user_name'];
    } else {
        return false;
    }
}

function isCorrectCredits($login, $password) {
    require_once('DatabaseHandler.php');
    $db = new DatabaseHandler();
    $db->connect();
    $login = $db->link->real_escape_string($login);
    $password = $db->link->real_escape_string($password);
    $db->makeQuery('SELECT user_name FROM users WHERE login=\'' . $login . '\' and password=\'' . $password . '\';');
    $row = mysqli_fetch_array($db->result);
    if(isset($row)) {
        return $row['user_name'];
    } else {
        return false;
    }
}

function getPassword($login) {
    require_once('DatabaseHandler.php');
    $db = new DatabaseHandler();
    $db->connect();
    $login = $db->link->real_escape_string($login);
    $db->makeQuery('SELECT password FROM users WHERE login=\'' . $login . '\';');
    $row = mysqli_fetch_array($db->result);   
    if(isset($row)) {
        return $row['password'];
    } else {
        return false;
    }
}