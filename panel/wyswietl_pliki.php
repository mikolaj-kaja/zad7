<?php
session_start();
if( isset($_POST["logout"])) session_unset();
require_once('stopka.php');
//Wywietl pliki z katalogu użytkownika
$user=$_SESSION["user_name"];

// Create recursive dir iterator which skips dot folders
$dir = new RecursiveDirectoryIterator("/var/www/utp/zad7/pliki/$user/",
    FilesystemIterator::SKIP_DOTS);

// Flatten the recursive iterator, folders come before their files
$it  = new RecursiveIteratorIterator($dir,
    RecursiveIteratorIterator::SELF_FIRST);

// Maximum depth is 1 level deeper than the base folder
$it->setMaxDepth(1);

// Basic loop displaying different messages based on file or folder
foreach ($it as $fileinfo) {
    if ($fileinfo->isDir()) {
        printf("<br/>Folder - %s\n", $fileinfo->getFilename());
    } elseif ($fileinfo->isFile()) {
    		if($it->getSubPath() === ''){
    				printf("<br/>%s <a href='download.php?file=%s'>Pobierz</a>\n", $fileinfo->getFilename(),$fileinfo->getFilename());
    		}else{
    				printf("<br/>%s -> %s <a href='download.php?file=%s/%s'>Pobierz</a>\n", $it->getSubPath(), $fileinfo->getFilename(),$it->getSubPath(), $fileinfo->getFilename());
    		}
		}
}
?>