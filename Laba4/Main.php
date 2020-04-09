<?php 

$patterns = array();
$patterns[] = '/(<h[1-6]\s*)(.*)(<\/h[1-6]\s*>)/';
$patterns[] = '/(<em\s*>)(.*)(<\/em\s*>)/';
$patterns[] = '/(<b\s*>)(.*)(<\/b\s*>)/';
$replacements = array();
$replacements[] = '${1} style="color:blue"${2}${3}';
$replacements[] = '<em style="color:green">${2}</em>';
$replacements[] = '<b style="color:red">${2}</b>';

if(isset($_FILES['userfiles'])) {
	foreach ($_FILES['userfiles']['error'] as $key => $value) {
		if($_FILES['userfiles']['error'][$key] === UPLOAD_ERR_OK) {
            $fileName = $_FILES['userfiles']['name'][$key];
            if (!$fileContent = file_get_contents($fileName)) {
				echo 'File is not found';
			}
			else{
				echo preg_replace($patterns, $replacements, $fileContent);
			}
		}
		else ($_FILES['userfiles']['error'][$key] == ERR_FILE_NOT_FOUND) {
			echo 'Not found';
		}
        else{
            echo 'Error during loading';
        }
    }	
}

	