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
		$folder='';
		$user = $_SESSION["user_name"];
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
		echo "Witaj " . $user . "!"; 
		echo "<br/><br/>Ostatnie błędne logowanie: $bledne";
?>

<form method="post">
		<input type="hidden" name="logout">
		<input type="submit" value="Wyloguj się">
</form>

<?php
echo '<br/>Wyślij plik<br/>
<form method="POST" ENCTYPE="multipart/form-data">
Wprowadź nazwę folderu (puste dla katalogu głównego): <input type="text" name="folder" value="Nazwa folderu" />
<input type="file" name="plik"/>
<input type="hidden" name="wyslano" value="1" />
<input type="submit" value="Wyślij plik"/> </form>
';

if ( isset($_POST['wyslano']) && is_uploaded_file($_FILES['plik']['tmp_name']) ){
		$folder=$_POST['folder'];

		if($folder !== ''){
				echo 'Odebrano plik: '.$_FILES['plik']['name'].'<br/>';
				move_uploaded_file($_FILES['plik']['tmp_name'], "../pliki/$user/$folder/".$_FILES['plik']['name']);
		}else{
				echo 'Odebrano plik: '.$_FILES['plik']['name'].'<br/>';
				move_uploaded_file($_FILES['plik']['tmp_name'], "../pliki/$user/".$_FILES['plik']['name']);
		}
} else if(isset($_POST['wyslano'])){
		echo 'Błąd przy przesyłaniu danych!';
}

//Utwórz folder
echo "<br/>
<form method='POST'>
Wprowadź nazwę folderu: <input type='text' name='create_folder' value='Nazwa folderu' />
<input type='submit' value='Utwórz folder' />
</form>\n";

if( isset($_POST['create_folder']) ){
		$folder=$_POST['create_folder'];
		if( !file_exists("../pliki/$user/$folder") ){
				mkdir("../pliki/$user/$folder");
				echo "<br/>Folder ".$folder." utworzono pomyślnie!";
		}else{
				echo "<br/>Taki folder już istnieje!";
		}
}


echo "<br/>Lista plików<br/>";
require_once("wyswietl_pliki.php");
?>


</body>
</html>