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
<?php
function secure_input($data) {
  	$data = trim($data);
  	$data = stripslashes($data);
  	$data = htmlspecialchars($data);
  	return $data;
}
		$password_status="";
		$user=secure_input($_POST['user']);
		$pass1=secure_input($_POST['pass1']);
		$pass2=secure_input($_POST['pass2']);
		if ( !empty($_POST) && $pass1 === $pass2 ){
				$link = mysqli_connect(localhost, user,Password1, zad7);if(!$link)
				{ echo"Błąd: ". mysqli_connect_errno()." ".mysqli_connect_error(); exit(); }

				$result = mysqli_query($link, "SELECT * FROM users WHERE user='$user' LIMIT 1");
				$rekord = mysqli_fetch_array($result);
				if($rekord) {
						$password_status = "<br/><span id='error'>Login zajęty</span>";
				} else {
						mysqli_query($link, "INSERT INTO users (user, pass) VALUES ('$user','$pass1')");
						mkdir("/var/www/utp/zad7/pliki/$user");
						$password_status="<br/><span id='correct'>Dodano użytkownika</span>";
				}
				mysqli_close($link);
		}else if (!empty($_POST)){
				$password_status="<br/><span id='error'>Hasła są różne</span>";
		}
?>

<p>Formularz rejestracji</p>
<form method="post">
Login:	<input type="text" name="user" maxlength="20" size="20"><br>
Hasło:	<input type="password" name="pass1" maxlength="20" size="20"><br>
Powtórz Hasło:<input type="password" name="pass2" maxlength="20" size="20"><br>
<input type="submit" value="Send"/>
<?php if(!$password_status=="") { echo $password_status; } ?>
</form>

</body>
</html>