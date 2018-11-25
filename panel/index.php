<?php
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
<?php
		$link = mysqli_connect(localhost, user,Password1, zad7);
		if(!$link) { echo"Błąd: ". mysqli_connect_errno()." ".mysqli_connect_error(); exit(); }
		$user=$_SESSION["user_name"];
		$result = mysqli_query($link, "SELECT time FROM `historia_logowan` WHERE user_name LIKE '$user' AND correct_login LIKE 'No' ORDER BY `time` DESC LIMIT 1");
		$rekord = mysqli_fetch_array($result);
		$bledne=$rekord[0];
		if($bledne == ""){
				$bledne="brak";
		}
?>


<p>Panel użytkownika</p>
<?php
		echo "Witaj " . $_SESSION["user_name"] . "!"; 
		echo "<br/><br/>Ostatnie błędne logowanie: $bledne";
?>

<form method="post">
		<input type="hidden" name="logout">
		<input type="submit" value="Wyloguj się">
</form>


<?php
echo '<br/>Wyślij plik<br/>
<form action="odbierz.php" method="POST" ENCTYPE="multipart/form-data">
<input type="file" name="plik"/>
<input type="submit" value="Wyślij plik"/> </form>
';

echo "<br/>Lista plików<br/>";
require_once("wyswietl_pliki.php");
?>


</body>
</html>