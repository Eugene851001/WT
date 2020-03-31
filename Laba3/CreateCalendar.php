<?php
	
	define('MIN_YEAR', 1);
	define('MAX_YEAR', 2049);
	define('MIN_COURSE', 1);
	define('MAX_COURSE', 3);
	
	if (isset($_POST['year']) && isset($_POST['course'])) {
		$year = $_POST['year'];
		$course = $_POST['course'];
		if (is_numeric($year) && $year >= MIN_YEAR && $year <= MAX_YEAR
			&& is_numeric($course) && $course >= MIN_COURSE && $course <= MAX_COURSE) {
			unset($_POST['incorrect']);
			echo '</br>';
			$calendar = getCalendar($year);
			$calendarTable = showCalendar($calendar, $course, $year);
			echo $calendarTable;
			writeFile("calendar.html", $calendarTable);
		}
		else {
			$_POST['incorrect'] = true;
			include "Main.php";
			echo "Please, check the input";
		}
	}
	
function getCalendar($year){
	$calendar;
	for($month = 1; $month < 13; $month++) {
		//первый учебный месяц соответсвует 9 календарному месяцу
		$calendarMonth = ($month + 7)  % 12 + 1;
		//первые четыре месяца учебного года в одном календарном году, остальные в другом
		$calendarYear = ($month < 5) ? $year : $year + 1;
		$daysAmount = cal_days_in_month(CAL_GREGORIAN, $calendarMonth, $calendarYear);
		//узнаём какой день недели является первым в этом месяце
		$firstDayMonth = date("w", strtotime("$calendarYear-$calendarMonth-1"));
		//1 - понедельник, 7 - воскресенье
		$firstDayMonth = $firstDayMonth ? $firstDayMonth : 7;
		for ($dayOfWeek = 1; $dayOfWeek <= 7; $dayOfWeek++) {
			if ($dayOfWeek < $firstDayMonth) {
				$calendar[$month][$dayOfWeek][1] = 0;
			}
			else {
				$calendar[$month][$dayOfWeek][1] = $dayOfWeek - $firstDayMonth + 1;
			}
			for ($weekNumber = 2; $weekNumber <= $daysAmount / 7 + 2; $weekNumber++) {
				$dayNumber = ($weekNumber - 1) * 7 + $dayOfWeek - $firstDayMonth + 1;
				if ($dayNumber <= $daysAmount) {
					$calendar[$month][$dayOfWeek][$weekNumber] = $dayNumber;
				}
			}
		}
		
	}
	$prevSchoolWeekNumber = 4;
	for($month = 1; $month < 13; $month++) {
		for($weekNumber = 1; $weekNumber <= count($calendar[$month][1]); $weekNumber++) {
			$currentSchoolWeekNumber = $prevSchoolWeekNumber % 4 + 1; 
			$calendar[$month]['SW'][$weekNumber] = $currentSchoolWeekNumber;
			$prevSchoolWeekNumber = $currentSchoolWeekNumber;
		}
		//если месяц закончился не на воскресенье, то первая неделя след. месяца будет иметь такой же номер
		if (count($calendar[$month][7]) < count($calendar[$month][1])) {
			$prevSchoolWeekNumber--;
		}
	}
	return $calendar;
}

function writeFile($fileName, $content) {
	if ($handle = fopen($fileName, 'w')) {
		fwrite($handle, $content);
		fclose($handle);
	}
	else {
		echo "Can not open the file $fileName";
	}
}
	
function showCalendar($calendar, $course, $year) {
	$strResult = '<link rel="stylesheet" type="text/css" href="tableStyles.css" />';
	$strResult = $strResult . '<table>';
	$dayOfWeekNames  = array(1 => "Monday", "Tuesday", "Wednesday", "Thursday", "Friday",
		"Saturday", "Sunday", 'SW' => "School Week");
	$monthsNames = array(1 => 'January', 'February', 'March', 'April', 'May', 'June', 
		'July', 'August', 'September', 'October', 'November', 'December');
	for ($month = 1; $month < 13; $month++) {
		$calendarMonth = ($month + 7) % 12 + 1; 
		$strResult = $strResult . '<tr><td>' . $monthsNames[$calendarMonth] . '</td></tr>';
		foreach($calendar[$month] as $dayOfWeek => $weekDayDays) {
			$strResult = $strResult . '<tr>';
			$strResult = $strResult . '<td>' . $dayOfWeekNames[$dayOfWeek] . '</td>';
			foreach($weekDayDays as $weekNumber => $dayNumber) {
				//Определяем входит ли день в сессию или в каникулы 
				$className = '';
				if ($dayOfWeek !== 'SW'){
					if (isSession($course, $calendarMonth, $dayNumber, $year)) {
						$className = 'session-day';
					}
					else {
						if (isHoliday($course, $calendarMonth, $dayNumber, $year)) {
							$className = 'holiday-day';
						}
					}
				}
				//Выводим число дня в таблицу
				$strResult = $strResult . '<td class=' . $className .  '>' . ($dayNumber === 0 ? " " : $dayNumber) . '</td>';
			}
			$strResult = $strResult . '</tr>';
		}
		$strResult = $strResult . '<tr><td>------------------<td></tr>';
	}
	$strResult = $strResult . '</table>';
	return $strResult;
}


//считает с попракой на то, что месяцы 1-8 находятся в следующем году
function getSerialDayNumber($day, $month, $year) {
	$counter = 0;
	for ($i = 1; $i < $month; $i++) {
		$counter += cal_days_in_month(CAL_GREGORIAN, $i, $year);
	}
	if ($month >= 1 && $month <= 9) {
		$counter += 365;
	}
	$counter += $day;
	return $counter;
}

function isHoliday($course, $month, $day, $year) {
	include "SessionsAndHolidays.php";
	return isInInterval($studentHolidays[$course], $day, $month, $year);
}

function isSession($course, $month, $day, $year) {
		include "SessionsAndHolidays.php";
		return isInInterval($studentSessions[$course], $day, $month, $year);
}	

function isInInterval($schedule, $day, $month, $year) {
		$isChecked = false;
		$amount = count($schedule);
		for ($i = 1; $i <= $amount && !$isChecked; $i++) { 
			$currentSchedule = $schedule[$i];
			if (getSerialDayNumber($currentSchedule['start']['day'], $currentSchedule['start']['month'], $year) <=
				getSerialDayNumber($day, $month, $year) && getSerialDayNumber($day, $month, $year) 
				<= getSerialDayNumber($currentSchedule['finish']['day'], $currentSchedule['finish']['month'], $year)) {
					$isChecked = true;
			}
			else {
				$isChecked =  false;
			}
		}
		return $isChecked;

}

	
