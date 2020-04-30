<?php 

error_reporting(0);

require_once('LoadRegularPage.php');
getPageInfo("page_title='Statistics'", $title, $header, $content, $aside);

require_once('StatisticHandler.php');

$browserInfo = get_browser($_SERVER['HTTP_USER_AGENT'], true);
$browserName = $browserInfo['browser'];
addToStatistics($browserName, $_SERVER['REMOTE_ADDR']);

$content = getStatisticsTable();

include('../Template.php');