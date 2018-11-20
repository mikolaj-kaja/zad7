<?php
		if( !isset($_SESSION["user_name"]) || !isset($_SESSION["user_id"]) ){
				header("Location: http://utp.mikolajkaja.pl/zad7/logowanie.php");
		}
?>