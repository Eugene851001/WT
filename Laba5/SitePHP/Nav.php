<link rel="stylesheet" type="text/css" href="style.css" />
	<p class=<?php echo basename($_SERVER['SCRIPT_NAME']) === 'Main.php' ? 'active' : '';?>> 
		<a href="Main.php"><?php echo $_SERVER['SCRIPT_NAME'];?>
			Главная
		</a>
	</p>
	<p class=<?php echo basename($_SERVER['SCRIPT_NAME']) === 'Manual.php' ? 'active' : ''; ?>>
		<a href = "Manual.php">
			Учебник
		</a>
	</p>
	<p class=<?php echo basename($_SERVER['SCRIPT_NAME']) === 'Guid.php' ? 'active' : '';?>>
		<a href="Guid.php">
			Справочник языка
		</a>
	</p>			
	<p class=<?php echo basename($_SERVER['SCRIPT_NAME']) === 'Compiler.php' ? 'active' : '';?>>
		<a href = "Compiler.php">
			Онлайн компилятор
		</a>
	</p>
	<p class=<?php echo basename($_SERVER['SCRIPT_NAME']) === 'Registration.php' ? 'active' : '';?>>
		<a href = "Registration.php">
			Регистрация
		</a>
	</p>
	<p class=<?php echo basename($_SERVER['SCRIPT_NAME']) === 'SiteMap.php' ? 'active' : '';?>>
		<a href = "SiteMap.php">
			Карта сайта
		</a>
	</p>