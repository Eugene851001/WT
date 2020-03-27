<?php

	date_default_timezone_set('Europe/Minsk');
	$templates = array('{TIME}' => date('H:i:s'), 
						'{IP}' => $_SERVER['REMOTE_ADDR'],
						'{DATE}' => date('d m Y'));
	$fileContent = file_get_contents('Compiler.html');
	foreach($templates as $key => $value) {
		$fileContent = str_replace($key, $value, $fileContent);
	}
	echo $fileContent;
	