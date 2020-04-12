<?php

function showDatabaseTableRand($db_name, $tableName){ 
    require_once('DatabaseHandler.php');
    $db = new DatabaseHandler();
    $db->dbName = $db_name;
    $result = '';
    $db->connect();
    if(mysqli_connect_error()) {
        return false;
    }
    $result = showTable($db->link, $tableName);
    $db->close();
    return $result;
}

function showTable($link, $tableName) {
    $return = '<table>';
    if($record = mysqli_query($link, 'SELECT DISTINCT * FROM '  . $tableName . ' ORDER BY RAND()')) {
        while ($row = mysqli_fetch_array($record)) {
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
    else {
        return false;
    }
}


