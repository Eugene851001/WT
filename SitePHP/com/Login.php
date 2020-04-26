<?php

require_once('LoadRegularPage.php');
getPageInfo("page_title='Login in'", $title, $header, $content, $aside);
require_once('LoginScript.php');
$isRequireLogin = true;

if(isset($_REQUEST['exit']) && $_REQUEST['exit']) {
    setcookie('login', '', time() - 1);
    setcookie('password', '', time() - 1);
    unset($_COOKIE['login']);
    unset($_COOKIE['password']);
}

if(isset($_COOKIE['login']) && isset($_COOKIE['password'])) {
    echo $_COOKIE['password'];
    if(isCorrectCredits($_COOKIE['login'], $_COOKIE['password'])) {
        $content = '<p>Вы уже вошли</p>';
        $content .= '<p><a href="?exit=true">Выйти</a></p>';
        $isRequireLogin = false;
    }
}

if($isRequireLogin && isset($_POST['login']) && isset($_POST['password'])) {
    $isCorrectInput = false;
    $userName = getUserName($_POST['login']);
    $passwordHash = getPassword($_POST['login']);
    if($userName && $passwordHash) {
        if(password_verify($_POST['password'], $passwordHash)) {
            $isCorrectInput = true;
            $content = 'Добро пожаловать, ' . $userName;
            if(isset($_POST['Remember'])) {
                setcookie('login' , $_POST['login'], time() + 60 * 10);
                setcookie('password', $passwordHash, time() + 60 * 10);
            }
        }
    } 
    if(!$isCorrectInput) {
        $content = 'Please, check the input';
    }
}

include('../Template.php');