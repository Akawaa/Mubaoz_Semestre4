<?php

	foreach($xml as $path){
		$oldpath= $path->currentpath;	
	}

if(!empty($_POST['changefolder'])) {
	$dest = $_POST["destination"];
	$dossier = $_SERVER['DOCUMENT_ROOT'].$pathos.$dest.$pathos;
		if(!is_dir($dossier)){
			mkdir($dossier, 0777);
		}
	$xml->path->oldpath = $oldpath;
	$xml->path->currentpath = $dest;
	$xml->asXML($fichier);
	echo "<p class='alert'>Changement du repertoire reussi ! <br>
	Le nouveau emplacement est :".$dest."</p>";
}
?>