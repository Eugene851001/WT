<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $title;?></title>
		<meta charset = "utf-8" >
		<meta name="viewport" content="width=device-width" />
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body class = "body">
		<div class = "grid-container">
			<header>
				<h3><?php echo $header;?></h3>
			</header>
			<nav>
				<?php include "Nav.php";?>
			</nav>
			<article>
				<div class="forms">
					<form action="Login.php" method="POST">
						Логин<input type="text" name="login" value=<?php echo $login;?>>
						Пароль<input type="text" name="password" value=<?php echo $password;?>>
						<div><input type="checkbox" name="Remember" value="RemeberMe">Запомнить меня</div>
						<input type="submit" value="Отправить"/>
					</form>
				</div>
			</article>		
			<aside>
				<?php echo $aside;?>
			</aside>
			<footer>
				<h4>Copyright &copy; TrahanovEugene 2020</h4>
			</footer>
		</div>
	</body>
</html>