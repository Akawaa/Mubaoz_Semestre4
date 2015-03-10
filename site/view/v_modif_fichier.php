<?php
   //Liste les répertoire pour l'ajout de répertoire dans l'arborescence
   function listerRepertoires($chemin, $level, $results)
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
                  <option value="<?php echo $nom_repertoire.'/'.$fichier ?>" <?php if ($results[0]['emplacement'] == $nom_repertoire.'/'.$fichier) { echo "selected"; }?>>
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


<!-- Récupération des colonnes du fichier-->
<?php
    $fichierAmodif = $_GET['modiffichier'];
    echo "Vous pouvez modifier le fichier : ".$fichierAmodif;
    // Get a db connection.
    $db = JFactory::getDbo();
     
    // Create a new query object.
    $query = $db->getQuery(true);
     
    // Select all records from the user profile table where key begins with "custom.".
    // Order it by the ordering field.
    $query->select($db->quoteName(array('id', 'nonfichier', 'titrefichier', 'emplacement', 'validitefichierstart', 'validitefichierend')));
    $query->from($db->quoteName('#__mubaoz_fichier'));
    $query->where($db->quoteName('titrefichier') . ' = '. $db->quote($fichierAmodif));

    // Reset the query using our newly populated query object.
    $db->setQuery($query);
     
    // Load the results as a list of stdClass objects (see later for more options on retrieving data).
    $results = $db->loadAssocList();
    //$array = selectUnFichier($_GET['modiffichier']);
?>



<div class="register">
<form method="post" enctype="multipart/form-data" action="">
    <p>Emplacement de votre fichier : </p>
    <?php $level = 3; ?>
    <select id="register-input" name="destination">
        <?php $chemin = JPATH_ROOT."/upload/shared"; ?>
        <option value="<?php echo $chemin; ?>" <?php if ($results[0]['emplacement'] == $chemin) {
            echo "selected";
        }?>>shared</option>
            <?php listerRepertoires($chemin, $level, $results); ?>
        <?php $chemin = JPATH_ROOT."/upload/users/".$userName; ?>
        <option value="<?php echo $chemin; ?>" <?php if ($results[0]['emplacement'] == $chemin) {
            echo "selected";
        }?>><?php echo $userName; ?></option>
            <?php listerRepertoires($chemin, $level, $results); ?>
    </select>

 	<label for="username">Nom du fichier :</label><label for="username">
  <i>Attention : enlever l'extension du fichier pourrait poser des problèmes de fonctionnement</i></label> 
    <input id="register-input"  type="text"  name="nom_du_fichier_modifie" value="<?php echo $results[0]['titrefichier']; ?>">
         
    <label for="date">Date du début de validité du fichier :</label>
    <?php $dateDeconvertitDebut = deconvertitDatepicker($results[0]['validitefichierstart']); ?>
    <input id="register-input"  type="date" id="datepicker" name="date_debut_validite" value="<?php echo $dateDeconvertitDebut; ?>">


    <label for="date">Date de fin de validité du fichier :</label>
    <?php $dateDeconvertitFin = deconvertitDatepicker($results[0]['validitefichierend']); ?>
    <input id="register-input"  type="date" id="datepicker2" name="date_fin_validite"  value="<?php echo $dateDeconvertitFin; ?>">

    <input type="hidden" name="ancienEmplacement" value="<?php echo $results[0]['emplacement']; ?>">
    <input type="hidden" name="ancienTitre" value="<?php echo $results[0]['titrefichier']; ?>">
    <input type="hidden" name="idFichier" value="<?php echo $results[0]['id']; ?>">
    <input type="hidden" name="nomfichier" value="<?php echo $results[0]['nonfichier']; ?>">

    <input class="register-button" type="submit" name="modif" value="Valider">
</form>

<script>
    $(function() {
        $( "#datepicker" ).datepicker();
    });

    $(function() {
        $( "#datepicker2" ).datepicker();
    });
</script>



<?php
  if (isset($_POST['modif'])) {
      $array['newTitre'] = $_POST['nom_du_fichier_modifie'];
      $array['lienfichier'] = md5($array['newTitre']);
      $array['newEmplacement'] = $_POST['destination'];
      $array['oldEmplacement'] = $_POST['ancienEmplacement'];
      $array['recupdateDebut'] = $_POST['date_debut_validite'];
      $array['validitefichierstart'] = convertitDatepicker($array['recupdateDebut']);
      $array['recupdateFin'] = $_POST['date_fin_validite'];
      $array['validitefichierend'] = convertitDatepicker($array['recupdateFin']);
      $array['idFichier'] = $_POST['idFichier'];
      $array['oldTitre'] = $_POST['ancienTitre'];
      $array['nomFichier'] = $_POST['nomfichier'];

      rename($array['oldEmplacement']."/".$array['oldTitre'], $array['oldEmplacement']."/".$array['newTitre']);
      if ($array['oldEmplacement'] != $array['newEmplacement']) {
        copy($array['oldEmplacement']."/".$array['newTitre'], $array['newEmplacement']."/".$array['newTitre']);
        unlink($array['oldEmplacement']."/".$array['newTitre']);
      }
      echo "<br>";



      $db = JFactory::getDbo();
       
      $query = $db->getQuery(true);
       
      // Fields to update.
      $fields = array(
          $db->quoteName('titrefichier') . ' = ' . $db->quote($array['newTitre']),
          $db->quoteName('nonfichier') . ' = ' . $db->quote($array['nomFichier']),
          $db->quoteName('emplacement') . ' = ' . $db->quote($array['newEmplacement']),
          $db->quoteName('lienfichier') . ' = ' . $db->quote($array['lienfichier']),
          $db->quoteName('validitefichierstart') . ' = ' . $db->quote($array['validitefichierstart']),
          $db->quoteName('validitefichierend') . ' = ' . $db->quote($array['validitefichierend'])
      );
       
      // Conditions for which records should be updated.
      $conditions = array(
          $db->quoteName('id') . ' = ' . $db->quote($array['idFichier'])
      );
       
      $query->update($db->quoteName('#__mubaoz_fichier'))->set($fields)->where($conditions);
       
      $db->setQuery($query);
       
      $result = $db->execute();
      echo "<br>";
      echo "<p class='alert'> Le fichier a bien été modifié</p>";
  }
?>