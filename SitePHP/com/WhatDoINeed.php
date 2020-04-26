<?php 
	
error_reporting(0);	

require_once('LoadRegularPage.php');
getPageInfo("page_title='What do i need?'", $title, $header, $content, $aside);

include('../Template.php');