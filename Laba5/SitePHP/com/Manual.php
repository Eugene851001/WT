<?php 

$title;
$content;
$header;
$aside;
require_once('LoadRegularPage.php');
getPageInfo("page_title='Manual'", $title, $header, $content, $aside);

include('../Template.php');