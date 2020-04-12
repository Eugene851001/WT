<form action="Main.php" method="POST">
    Введите имя базы данных<input type="text" name="db_name"/></br>
	Введите имя таблицы<input type="text" name="table_name"></br>
	<input type="submit" value="Показать таблицу"/>
</form>
<?php 

if(isset($_POST['db_name']) && isset($_POST['table_name'])) {
require_once('ShowDBRand.php');
    if($result = showDatabaseTableRand($_POST['db_name'], $_POST['table_name'])) {
        echo $result;
    }
    else{
        echo 'Please, check the input';
    }
}
else {
   echo 'Please, enter the names of database and table';
}
		