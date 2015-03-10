<?php
foreach($xml as $path){
		$dest= $path->currentpath;	
}
	$dossier = $_SERVER['DOCUMENT_ROOT'].$dest.$pathos;
		if(!is_dir($dossier)){
			mkdir($dossier, 0777);			
		}
		$dossiershared=$dossier."/shared";
		if(!is_dir($dossiershared)){
			mkdir($dossiershared, 0777);			
		}
		$dossierusers=$dossier."/users";
		if(!is_dir($dossierusers)){
			mkdir($dossierusers, 0777);			
		}
$user = JFactory::getUser();
if (!$user->guest) {
		$dossiercurrentusers=$dossier."/users/".$user->username;
		if(!is_dir($dossiercurrentusers)){
			mkdir($dossiercurrentusers, 0777);			
		}
}
?>