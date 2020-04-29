<?php 
	
error_reporting(0);	

require_once('LoadRegularPage.php');
getPageInfo("page_title='Registration'", $title, $header, $content, $aside);

include('../Template.php');
