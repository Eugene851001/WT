<?php

$patternsHandlers = array();
$patternsHandlers['/({FILE=")(.*)("})/'] = 'insertFile';
$patternsHandlers['/({VAR=")(.*)("})/'] = 'insertVariable';
$patternsHandlers['/({CONFIG=")(.*)("})/'] = 'insertConfig';
$patternsHandlers['/({DB=")(.*)("})/'] = 'insertDatabase';

if(isset($_FILES['userfiles'])) {
    foreach ($_FILES['userfiles']['error'] as $key => $value) {
        if($_FILES['userfiles']['error'][$key] === UPLOAD_ERR_OK) {
            $fileName = $_FILES['userfiles']['name'][$key];
            $content = $content = file_get_contents($fileName); 
            foreach($patternsHandlers as $key => $value) {
                preg_match($key, $content, $matches);
                $value($key, $matches, $content);
            }
            echo $content;
        }
    }
}

function insertDatabase($pattern, $matches, &$content) {
    if(isset($matches[2])) {
        $replacement = getFromDatabase($matches[2]);
        $content = preg_replace($pattern, $replacement, $content);
    }
}

function insertConfig($pattern, $matches, &$content) {
    $configFileName = 'config.ini';
    $configFileContent = parse_ini_file($configFileName);
    if (isset($matches[2]) && isset($configFileContent[$matches[2]])) {
        $replacement = $matches[2];
        $content = preg_replace($pattern, $configFileContent[$replacement], $content);
    }
}

function insertVariable($pattern, $matches, &$content) {
    if(isset($matches[2]) && isset($GLOBALS[$matches[2]])) {
        $replacement = $matches[2];
        $content = preg_replace($pattern, $GLOBALS[$replacement], $content);    
    }
}

function insertFile($pattern, $matches, &$content) {
    if(isset($matches[2])) {
        $replacement = $matches[2];
        $replacement = file_get_contents($replacement);
        $content = preg_replace($pattern, $replacement, $content);
    }
}
    
function showFile($fileName) {
    echo file_get_contents($fileName);
}
    
function getFromDatabase($request) {
    $return = '';
    $link = $link = mysqli_connect('localhost', 'root', 'password', 'my_first_db');
    if($result = mysqli_query($link, $request)) {
        while($row = mysqli_fetch_array($result)) {
            foreach($row as $key => $value) {
                if (!is_numeric($key)) {
                    if (empty($value)) {
                        $return .= 'NULL' . ' ';
                    }
                    else {
                        $return .= $value . ' ';
                    }
                }
            }
        }
    } 
    else {
        return false;
    }
    return $return;
}
