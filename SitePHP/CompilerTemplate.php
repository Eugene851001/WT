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
				<form action = "Compiler.php" method = "POST" class = "compiler-forms">
					<textarea style = "max-width:80%; text-align: left;" name = "code" cols = "80" rows = "15"><?php if(isset($_POST['code'])) echo $_POST['code'];?>
					</textarea>
					<p>
						<input type = "submit" value = "Скомпилировать">
					</p>
					<p>
						<textarea style = "max-width:80%" name = "arr" cols = "80" rows = "15"><?php echo $result;?>
						</textarea>
					</p>
				</form>
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