<?php
if (isset($_FILES["pictures"])) {
	$path = $_SERVER['DOCUMENT_ROOT'];
	foreach ($_FILES['pictures']['error'] as $key => $error) {
		if ($error == UPLOAD_ERR_OK) {
			echo $_FILES['pictures']['tmp_name'][$key] . '</br>';
			echo $_FILES['pictures']['size'][$key] . '</br>';
			if (move_uploaded_file($_FILES['pictures']['tmp_name'][$key], $path . '/' . $_FILES['pictures']['name'][$key])) {
				echo 'Loaded</br>';
			}
			else {
				echo $_FILES['pictures']['name'][$key] . '->' . $path . '/' . $_FILES['pictures']['name'][$key];
				echo 'Not loaded</br>';
			}
		}
	}
}
?>

<form action="uploadFile.php" method="post" enctype="multipart/form-data">
	<p>Изображения:
		<input type="file" name="pictures[]" />
		<input type="file" name="pictures[]" />
		<input type="file" name="pictures[]" />
		<input type="submit" value="Отправить" />
	</p>
</form>