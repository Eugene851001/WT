<link rel="stylesheet" type="text/css" href="inputForm.css" />
<?php echo $_SERVER['SCRIPT_NAME'];?>
<form action="CreateCalendar.php" method="POST"  class =<?php echo 'incorrect-input;'?>>
	Введите год<input class=<?php echo isset($_POST['incorrect']) ? 'incorrect-input' : '';?> 
		type="text" 	name="year"/></br>
	Введите курс<input class=<?php echo isset($_POST['incorrect']) ? 'incorrect-input' : '';?> type="text" name="course" /></br>
	<input type="submit" value="Получить каледарь"/>
</form>