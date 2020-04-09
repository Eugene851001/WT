<?php 
	
error_reporting(0);	

$title;
$content;
$header;
$aside;
require_once('LoadRegularPage.php');
getPageInfo("page_title='Something usefull'", $title, $header, $content, $aside);

include('../Template.php');