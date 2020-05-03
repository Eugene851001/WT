<?php

function addToStatistics($browserName, $address) {
    $db = new DatabaseHandler();
    $db->connect();
    $db->makeQuery('SELECT id FROM statistics WHERE browser_name=\'' . $browserName . '\' and   user_address=\'' . $address . '\';');
    $row = mysqli_fetch_array($db->result);
    if(empty($row)) {
        $db->makeQuery('INSERT INTO statistics VALUES(NULL, \'' . $browserName . '\', \'' . $address . '\');');
    }
}

function getStatisticsTable() {
    $db = new DatabaseHandler();
    $db->connect();
    $table = '<table border="1" align="center"><tr><td>Кол-во пользователей</td><td>Браузер</td></tr>';
    $db->makeQuery('SELECT COUNT(*), browser_name FROM statistics GROUP BY 
        browser_name ORDER BY COUNT(*) DESC;');
    if($db->result) {
        while ($row = mysqli_fetch_array($db->result)) {
            $table .= '<tr>';
            foreach($row as $key => $value) {
                if (!is_numeric($key)) {
                    if (empty($value)) {
                        $table .= '<td>NULL</td>';
                    }
                    else {
                        $table .= '<td>' . $value . '</td>';
                    }
                }   
           }
           $table .= '</tr>';
        }
        $table .= '</table>';
        return $table;
    }
}
