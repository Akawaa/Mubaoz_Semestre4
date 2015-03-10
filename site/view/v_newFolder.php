<?php
   //Liste les répertoire pour l'ajout de répertoire dans l'arborescence
   function listerRepertoires($chemin, $level)
   {      
      $levelDessous = $level;
      //chemin du répertoire (utilisé en post pour avoir le chemin du nouveau dossier)
      $nom_repertoire = $chemin;
       
      //on ouvre un pointeur sur le repertoire
      $pointeur = opendir($nom_repertoire);
       
      //pour chaque fichier et dossier
      while ($fichier = readdir($pointeur))
      {
         //on ne traite pas les . et ..
         if(($fichier != '.') && ($fichier != '..'))
         {
            //si c'est un dossier, on le lit
            if (is_dir($nom_repertoire.'/'.$fichier))
            { ?>
               
                  <option value="<?php echo $nom_repertoire.'/'.$fichier ?>">
                     <?php 
                        for ($i=0; $i < $level ; $i++) { 
                           echo "-";
                        }
                        echo $fichier
                     ?>
                  </option>
               <?php
                  listerRepertoires($nom_repertoire.'/'.$fichier, $levelDessous+=3);
            }
         }
      }
      //fermeture du pointeur
      closedir($pointeur);
   }
?>

<div class="register">
<form method="post" enctype="multipart/form-data" action="">
   <label>Nom du dossier : </label><input type="text" name="name_folder">
   <label>Séléctionnez votre dossier parent : </label>
   <?php $level = 3; ?>
   <select id="register-input" name="chemin">
   	<?php $chemin = JPATH_ROOT."/upload/shared"; ?>
   	<option value="<?php echo $chemin; ?>">shared</option>
   		<?php listerRepertoires($chemin, $level); ?>
   	<?php $chemin = JPATH_ROOT."/upload/users/".$userName; ?>
   	<option value="<?php echo $chemin; ?>"><?php echo $userName; ?></option>
   		<?php listerRepertoires($chemin, $level); ?>
   </select>
   <br>
   <center>
      <input class="register-button" type="submit" name="creerFolder" value="Créer le dossier">
   </center>
</form>
</div>


<?php
   if (isset($_POST['name_folder']) && isset($_POST['chemin'])) {
      mkdir($_POST['chemin']."/".$_POST['name_folder'], 0777);
   }
?>
