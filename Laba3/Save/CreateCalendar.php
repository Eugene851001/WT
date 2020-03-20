<?php
	
	if (isset($_POST['year'])) {
		$year = $_POST['year'];
		$week = array(1, 2, 3, 4, 5, 6, 7);
		echo cal_days_in_month(CAL_GREGORIAN, 2, 2020) . '</br>';//31
		echo date("w", strtotime("$year-3-14")) . '</br>';
		print_r($week);
		echo '</br>';
		$calendar = getCalendar($year);
		printCalendar($calendar);
		WriteFile("calendar.html", printCalendar($calendar));
	}
	
function getCalendar($year){
	$calendar;
	for($month = 1; $month < 13; $month++) {
		$daysAmount = cal_days_in_month(CAL_GREGORIAN, $month, $year + $month / 4);
		$firstDayMonth = date("w", strtotime("$year-$month-1"));
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
			$calendar[($month + 7) % 12 + 1]["SW"][$weekNumber] = $currentSchoolWeekNumber;
			$prevSchoolWeekNumber = $currentSchoolWeekNumber;
		}
	}
	return $calendar;
}

function WriteFile($fileName, $content) {
	if ($handle = fopen($fileName, 'w')) {
		fwrite($handle, $content);
		fclose($handle);
	}
	else {
		echo "Can not open the file $fileName";
	}
}
	
function printCalendar($calendar) {
	$strResult = "";
	for ($month = 1; $month < 13; $month++) {
		$calendarMonth = ($month + 7) % 12 + 1; 
		echo "Month: $calendarMonth" . '</br>';
		$strResult = $strResult . "Month: $calendarMonth" . '</br>';
		foreach($calendar[$month] as $dayOfWeek => $weekDayDays) {
			echo "Day of week: $dayOfWeek: ";
			$strResult = $strResult . "Day of week: $dayOfWeek: ";
			foreach($weekDayDays as $weekNumber => $dayNumber) {
				echo "$dayNumber    ";
				$strResult = $strResult . "$dayNumber   ";
			}
			echo '</br>';
			$strResult = $strResult . '</br>';
		}
	}
	return $strResult;
}
	
	