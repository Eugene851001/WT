<?php 

error_reporting(0);

const MIN_PASS_LEN = 5;
const MIN_LOGIN_LEN = 2; 

require_once('LoadRegularPage.php');
getPageInfo("page_title='Registration'", $title, $header, $content, $aside);
require_once('RegistrationScript.php');
require_once('LoginScript.php');
if(isset($_POST['name']) && isset($_POST['login']) && isset($_POST['password']) && isset($_POST['mail'])) {
    echo 'Add user';
    $isCorrectInput = true;
    if(strlen($_POST['login']) <= MIN_LOGIN_LEN)
    {
        $isCorrectInput = false;
        $content .= '<p>The password length sould be more than ' . MIN_LOGIN_LEN  . ' </p>';
    }
    if(strlen($_POST['password']) <= MIN_PASS_LEN)
    {
        $isCorrectInput = false;
        $content .= '<p>The password length sould be more than ' . MIN_PASS_LEN . ' </p>';
    
    }
    $password = $_POST['password'];
    $password = password_hash($password, PASSWORD_BCRYPT);
    if($isCorrectInput && addUser($_POST['name'], $_POST['login'], $password, $_POST['mail'])) {
        $content = 'Добро пожаловать, '  . getUserName($_POST['login']);
        if(isset($_POST['Remember'])) {
            setcookie('login', $_POST['login'], time() + 60 * 10);
            setcookie('password', getPassword($_POST['login']), time() + 60 * 10);
        }
    } else if($isCorrectInput){
        $content .= '<p>Please, choose another login</p>';
    }
}

include('../Template.php');
