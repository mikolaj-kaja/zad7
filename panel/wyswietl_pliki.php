<?php
session_start();
if( isset($_POST["logout"])) session_unset();
require_once('stopka.php');
//Wywietl pliki z katalogu użytkownika
$user=$_SESSION["user_name"];

/*function dir_is_empty($dir) {
  $handle = opendir($dir);
  while (false !== ($entry = readdir($handle))) {
    if ($entry != "." && $entry != "..") {
      closedir($handle);
      return FALSE;
    }
  }
  closedir($handle);
  return TRUE;
}*/
//Usuń plik $file
if( isset($_POST['delete_file']) ){
		$file=$_POST['delete_file'];
		$file="../pliki/$user/$file";
		if( unlink($file) )	{	echo 'Usunięto pomyślnie '.$_POST['delete_file']; }
		else { echo 'Błąd usuwania pliku - ' . $_POST['delete_file'] . ' - ścieżka - ' . $file; }
}

//if( isset($_POST['delete_folder']) ){
//		if(dir_is_empty($_POST['delete_folder']))	{ rmdir($_POST['delete_folder']); echo 'Usunięto pomyślnie folder - '.$_POST['delete_folder']; }else{ echo 'Nie usunięto folderu - '.$_POST['delete_folder']. ' - zawiera pliki.'; }
//}

//Wyświetl pliki i foldery

// Create recursive dir iterator which skips dot folders
$dir = new RecursiveDirectoryIterator("/var/www/utp/zad7/pliki/$user",
    FilesystemIterator::SKIP_DOTS);

// Flatten the recursive iterator, folders come before their files
$it  = new RecursiveIteratorIterator($dir,
    RecursiveIteratorIterator::SELF_FIRST);

// Maximum depth is 1 level deeper than the base folder
$it->setMaxDepth(1);

// Basic loop displaying different messages based on file or folder
foreach ($it as $fileinfo) {
    if ($fileinfo->isDir()) {
        //printf("<br/><form method='POST'>Folder - %s<input type='hidden' name='delete_folder' value='%s'><input type='submit' value='Usuń'></form>\n", $fileinfo->getFilename(), $fileinfo->getFilename());
        printf("<br/><form method='POST'>Folder - %s\n<br/>", $fileinfo->getFilename());
    } elseif ($fileinfo->isFile()) {
    		if($it->getSubPath() === ''){
    				printf("<br/><form method='POST'>%s <a href='download.php?file=%s'>Pobierz</a><input type='hidden' name='delete_file' value='%s'><input type='submit' value='Usuń'></form>\n", $fileinfo->getFilename(),$fileinfo->getFilename(), $fileinfo->getFilename());
    		}else{
    				printf("<br/><form method='POST'>%s -> %s <a href='download.php?file=%s/%s'>Pobierz</a><input type='hidden' name='delete_file' value='%s/%s'><input type='submit' value='Usuń'></form>\n", $it->getSubPath(), $fileinfo->getFilename(),$it->getSubPath(), $fileinfo->getFilename(), $it->getSubPath(), $fileinfo->getFilename());
    		}
		}
}

?>