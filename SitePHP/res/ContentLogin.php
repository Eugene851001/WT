<div class="forms">
	<form action="Login.php" method="POST">
		Логин<input type="text" name="login" value=<?php echo $login;?>>
		Пароль<input type="text" name="password" value=<?php echo $password;?>>
		<div><input type="checkbox" name="Remember" value="RemeberMe">Запомнить меня</div>
		<input type="submit" value="Отправить"/>
	</form>
</div>