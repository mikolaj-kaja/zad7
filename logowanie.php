<!DOCTYPE html>
<html>
<head>
		<meta charset="UTF-8">
		<title>Kaja</title>
		<style>
		#error {
			color: red;
		}
		#correct {
			color: green;
		}
		</style>
</head>
<body>
<a href=index.html />Strona główna</a>
<br />
<p>Formularz logowania do systemu plików</p>
<form method="post" action="weryfikuj.php">
Login:	<input type="text" name="user" maxlength="20" size="20"><br>
Hasło:	<input type="password" name="pass" maxlength="20" size="20"><br>
<input type="submit" value="Send"/>
<?php if(!$password_status=="") { echo $password_status; } ?>
</form>

</body>
</html>