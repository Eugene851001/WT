<?php 
	
error_reporting(0);	

require_once('LoadRegularPage.php');
getPageInfo("page_title='Compiler'", $title, $header, $content, $aside);
require_once('CompilerScript.php');
if(isset($_POST['code'])) {
    $result = execute($_POST['code']);
    if(!$result)
        $result = 'error';
}

include('../CompilerTemplate.php');
