<?php
session_start();
if( isset($_POST["logout"])) session_unset();
require_once('stopka.php');

$user=$_SESSION["user_name"];
$file = basename($_GET['file']);
$file2 = "/var/www/utp/zad7/pliki/$user/".$file;

if(!file_exists($file2)){ // file does not exist
    die('file not found');
} else {
    header("Cache-Control: public");
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$file");
    header("Content-Type: application/text");
    header("Content-Transfer-Encoding: binary");

    // read the file from disk
    readfile($file2);
}

?>