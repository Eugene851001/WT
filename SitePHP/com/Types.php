<?php 
	
error_reporting(0);	

$title;
$content;
$header;
$aside;
require_once('LoadRegularPage.php');
getPageInfo("page_title='Types'", $title, $header, $content, $aside);

include('../Template.php');