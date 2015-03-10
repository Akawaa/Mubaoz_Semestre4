<html>
	<div class="register">
		<?php
			echo '<br> Repertoire actuel : ';
			foreach($xml as $path){
				echo $path->currentpath;	
			}
			echo '<br> Repertoire par defaut : ';
			foreach($xml as $path){
				echo $path->defaultpath;	
			}
			echo '<br> Ancien repertoire : ';
			foreach($xml as $path){
				echo $path->oldpath;	
			}
			
			//$xml->path->currentpath = 'nouveaucontenue';
			//$xml->asXML($fichier);
			$repertoire=$path->currentpath;
			//echo '<br>'.$repertoire;
		?>

		<form action="" method="post">
		 Changer le dossier destination : <?php echo $_SERVER['DOCUMENT_ROOT'] /*JPATH_ROOT.$pathos*/; ?><input type="text" value="<?php echo $repertoire;?>" name="destination" />
		 <input type="submit" name="changefolder" value="valider" />
		 </form> 
		 
		
		<form action="" method="post">
		    <p> Copier l'ancien emplacement vers le nouveau emplacement : <input type="submit" id="copy" name="copy" value="Copier"></p>
		<form>
		
		<form action="" method="post">
		    <p> Supprimer l'ancien dossier : <input type="submit" id="suppr" name="suppr" value="Supprimer"></p>
		<form>
	</div>
</html>


