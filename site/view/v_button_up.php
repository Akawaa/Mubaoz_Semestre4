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


<script>
    $(function() {
        $( "#datepicker" ).datepicker();
    });

    $(function() {
        $( "#datepicker2" ).datepicker();
    });
</script>

<div class="register">
<form method="post" enctype="multipart/form-data" action="">
	

    <p class="info">Votre fichier sera enregistré dans la base de donnée, le nom du propriétaire est le suivant : 
        
        <?php
                $user = JFactory::getUser();
                $userName = $user->username;
                echo $userName;
        ?>

    </p>
    <input type="hidden" >

    <p>Emplacement de votre fichier : </p>
    <?php $level = 3; ?>
    <select id="register-input" name="destination">
        <?php $chemin = JPATH_ROOT."/upload/shared"; ?>
        <option value="<?php echo $chemin; ?>">shared</option>
            <?php listerRepertoires($chemin, $level); ?>
        <?php $chemin = JPATH_ROOT."/upload/users/".$userName; ?>
        <option value="<?php echo $chemin; ?>"><?php echo $userName; ?></option>
            <?php listerRepertoires($chemin, $level); ?>
    </select>

 	  <label for="username">Nom du fichier :</label>   
    <input id="register-input" type="text"  name="file_name">
    
    <center>    
    <label for="date">Date du début de validité du fichier :</label>
    <input id="datepicker"  type="text" name="date_debut_validite">


    <label for="date">Date de fin de validité du fichier :</label>
    
    <input id="datepicker2" type="text" name="date_fin_validite">


  <p>
   
    <input  type="file" name="fichier" size="30">
    <input class="register-button" type="submit" name="upload" value="Uploader">
  
  </p>
</center>
</form>