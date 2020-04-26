<?php 
	
error_reporting(0);	
	
require_once('DatabaseHandler.php');
$db = new DatabaseHandler();
$db->connect();
$db->makeQuery('SELECT * FROM pages WHERE page_id=1');
$row = mysqli_fetch_array($db->result);
$title = $row['page_title'];
$content = 'Content not found';
$content_file_name = $row['page_content'];
$content .= $SERVER['DOCUMENT_ROOT'] . $content_file_name;
if(file_exists($SERVER['DOCUMENT_ROOT'] . $content_file_name)) {
    $content = file_get_contents($content_file_name);
}
$header = $row['header'];

include('../Template.php');