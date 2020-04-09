<form action="Main.php" method="POST">
    Введите имя базы данных<input type="text" name="db_name"/></br>
	<input type="submit" value="Показать базу данных"/>
</form>
<?php 
	if(isset($_POST['db_name'])) {
		require_once('ShowDB.php');
		if($result = showDatabase($_POST['db_name'])) {
			echo $result;
		}
		else{
			echo 'Please, check the input';
		}
	}
	else {
		echo 'Please, enter the names of database and table';
	}
	
	

	
	
	