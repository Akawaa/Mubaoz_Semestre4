<?php
if(!empty($_POST['suppr'])) {

function rmdir_recursive($dir)
{
 //Liste le contenu du répertoire dans un tableau
 $dir_content = scandir($dir);
 //Est-ce bien un répertoire?
 if($dir_content !== FALSE){
  //Pour chaque entrée du répertoire
  foreach ($dir_content as $entry)
  {
   //Raccourcis symboliques sous Unix, on passe
   if(!in_array($entry, array('.','..'))){
    //On retrouve le chemin par rapport au début
    $entry = $dir . '/' . $entry;
    //Cette entrée n'est pas un dossier: on l'efface
    if(!is_dir($entry)){
     unlink($entry);
    }
    //Cette entrée est un dossier, on recommence sur ce dossier
    else{
     rmdir_recursive($entry);
    }
   }
  }
 }
 //On a bien effacé toutes les entrées du dossier, on peut à présent l'effacer
 rmdir($dir);
}


	foreach($xml as $path){
		$oldpath= $path->oldpath;	
	}
	
	foreach($xml as $path){
		$currentpath= $path->currentpath;	
	}
	$oldpath=$_SERVER['DOCUMENT_ROOT'].$oldpath.$pathos;
	
	rmdir_recursive($oldpath);
		echo "<p class='alert'>Dossier supprimée</p>";
}
?>