<?php
// Start the session
session_start();

if( isset($_POST["logout"])) session_unset();
require_once('stopka.php');
?>

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

<p>Panel użytkownika</p>
<?php echo "Witaj " . $_SESSION["user_name"] . "!"; ?>

<form method="post">
		<input type="hidden" name="logout">
		<input type="submit" value="Wyloguj się">
</form>

</body>
</html>