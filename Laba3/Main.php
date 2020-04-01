<link rel="stylesheet" type="text/css" href="inputForm.css" />
<?php echo $_SERVER['SCRIPT_NAME'];?>
<form action="Main.php" method="POST"  class =<?php echo 'incorrect-input;'?>>
    Введите год<input type="text" 	name="year"/></br>
    Введите курс<input type="text" name="course" /></br>
	<input type="submit" value="Получить каледарь"/>
</form>
<?php 
    if(isset($_POST['year']) && isset($_POST['course'])) {
        echo 'Year: ' . $_POST['year'] . '</br>' . 'Course: ' . $_POST['course'] . '</br>';
        require_once('CreateCalendar.php');
        if(isCorrectInput($_POST['year'], $_POST['course'])) {
            $calendar = getCalendar($_POST['year']);
            $table = showCalendar($calendar, $_POST['course'], $_POST['year']);
            echo $table;
            file_put_contents('Calendar.html', $table);
        }
        else {
            echo 'Please, check the input';
        }
    }
    else {
        echo 'Please, enter the year and course';
    }