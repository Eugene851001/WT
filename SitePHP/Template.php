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
				<?php echo $content;?>
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