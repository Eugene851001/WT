<?php 
	
function getPageInfo($searchInfo, &$title, &$header, &$content, &$aside) {
	require_once('DatabaseHandler.php');
	$db = new DatabaseHandler();
	$db->connect();
	$db->makeQuery('SELECT * FROM pages WHERE ' . $searchInfo);
	$row = mysqli_fetch_array($db->result);
	$title = $row['page_title'];
    if(empty($title)) {
		$title = 'Title not found';
	}
	$content = 'Content not found';
	$content_file_name = $row['page_content'];
	//$content .= $content_file_name;
	if(file_exists($content_file_name)) {
		$content = file_get_contents($content_file_name);
	}
	$header = $row['header'];
	if(empty($header)) {
		$header = 'Header not found';
	}
	
	$db->makeQuery('SELECT * FROM surveys ORDER BY RAND()');
	$row = mysqli_fetch_array($db->result);
	$survey_file_name = $row["LINK"];
	if(file_exists($survey_file_name)) {
		$aside = file_get_contents($survey_file_name);
	}
	else {
		$aside = 'Survey not found!!!';
	}
}