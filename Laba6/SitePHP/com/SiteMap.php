<?php

require_once('DatabaseHandler.php');
$db = new DatabaseHandler();
$db->connect();
$result='<div class="lists">';
showTree(0, $db, $result);
$result .= '</div>';

 
$db->makeQuery('SELECT * FROM surveys ORDER BY RAND()');
$row = mysqli_fetch_array($db->result);
$survey_file_name = $row["LINK"];
if(file_exists($survey_file_name)) {
    $aside = file_get_contents($survey_file_name);
}
else {
    $aside = 'Survey not found!!!';
}

$db->close();

$content = $result;
$title = 'Site map';
$header = 'Карта сайта Документация PHP';


require_once('../Template.php');

function showTree($parent_id, $db, &$result){
    $db->makeQuery('SELECT title, section_id, link FROM sections WHERE parent_section_id=' . $parent_id);
    if(mysqli_num_rows($db->result) > 0) {
        $result .= '<ul>';
        while($row = mysqli_fetch_array($db->result)) {
            $result .= '<li>';
            $result .= '<a href="' . $row['link']. '">' . $row['title'] . '</a>';
            $saveResult = $db->result;
            showTree($row['section_id'], $db, $result);
            $db->result = $saveResult;
            $result .= '</li>';
        }
        $result .= '</ul>';
    }
}