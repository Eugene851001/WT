<?php
error_reporting(0);    
    
function showDatabase($db_name){
    $link = mysqli_connect('localhost', 'root', 'password', $db_name);
    if(mysqli_connect_error()) {
        return false;
    }
    $db = helpShowDatabase($link, 'site_php');
    if(!$db)
        return false;
    $result = '';
    foreach($db as $key => $value) {
        $result .= $value . '</br>';
    }
    mysqli_close($link);
    return $result;
}
    
function showTable($link, $tableName) {
    $return = '<table>';
    if($result = mysqli_query($link, 'SELECT * FROM ' . $tableName)) {
        while ($row = mysqli_fetch_array($result)) {
            $return .= '<tr>';
            foreach($row as $key => $value) {
                if (!is_numeric($key)) {
                    if (empty($value)) {
                        $return .= '<td>NULL</td>';
                    }
                    else {
                        $return .= '<td>' . $value . '</td>';
                    }
                }
            }
            $return .= '</tr>';
        }
        $return .= '</table>';
        return $return;
    }
    else{
        return false;
    }
}

function helpShowDatabase($link, $databaseName) {
    $return = array();
    if ($result = mysqli_query($link, "SELECT table_name, table_rows FROM 
        INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '" . $databaseName . "'")) {
            while($tableName = mysqli_fetch_array($result)) {
                $return[] = showTable($link, $tableName[0]);
            }
            return $return;
    } else {
        return false;
    }
}

