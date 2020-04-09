<?php

$patterns = array();
$patterns['file'] = '/({FILE=")(.*)("})/';
$patterns['variable'] = '/({VAR=")(.*)("})/';
$patterns['config'] = '/({CONFIG=")(.*)("})/';
$patterns['database'] = '/({DB=")(.*)("})/';
$configFileName = 'config.ini';
$configFileContent = parse_ini_file($configFileName);

if(isset($_FILES['userfiles'])) {
    foreach ($_FILES['userfiles']['error'] as $key => $value) {
        if($_FILES['userfiles']['error'][$key] === UPLOAD_ERR_OK) {
            $fileName = $_FILES['userfiles']['name'][$key];
            $content = $content = file_get_contents($fileName); 
            foreach($patterns as $key => $value) {
                $matches = array();
                preg_match($value, $content, $matches);
                if (($key === 'file') && (isset($matches[2])))
                {
                    $replacement = $matches[2];
                    $replacement = file_get_contents($replacement);
                    $content = preg_replace($value, $replacement, $content);
                } elseif (($key === 'variable') && isset($matches[2])) {
                    $replacement = $matches[2];
                    if(isset($GLOBALS[$replacement])) {
                        $content = preg_replace($value, $GLOBALS[$replacement], $content);
                    }
                } elseif($key === 'config' && isset($matches[2])){
                    $replacement = $matches[2];
                    if (isset($configFileContent[$replacement])) {
                        $content = preg_replace($value, $configFileContent[$replacement], $content);
                    }
                } elseif($key === 'database' && isset($matches[2])){
                    $replacement = getFromDatabase($matches[2]);
                    if($replacement) {
                        $content = preg_replace($value, $replacement, $content);
                    }
                }
            }
            echo $content;
        }
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