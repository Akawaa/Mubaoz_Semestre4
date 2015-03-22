<?php
if(isset($_GET['chemin'])&&isset($_GET['fichier'])){
        
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $titre = $_GET['fichier'];
        $conditions = array(
    		$db->quoteName('emplacement') . ' = '.$_GET['chemin'].'',
    		$db->quoteName('titrefichier') . ' = '.$titre.''
    	);
    	
    	$query->select($db->quoteName(array('id_user')));
    	$query->from($db->quoteName('#__mubaoz_fichier'));
	$query->where($conditions);
        $db->setQuery($query);
	$id = $db->loadObject();
	



		
		$user =& JFactory::getUser();
		$user_id = $user->get('id');
		
		$query = $db->getQuery(true);
		$conditions = array(
			$db->quoteName('id_user') . ' = '.$user->id,
    			$db->quoteName('emplacement') . ' = '.$_GET['chemin'].'',
    			$db->quoteName('titrefichier') . ' = '.$_GET['fichier'].''
    			);
    			
    		$query->delete($db->quoteName('#__mubaoz_fichier'));
		$query->where($conditions);
 
		$db->setQuery($query);
		$result = $db->execute();
		
		if($id->id_user == $user->id)	unlink( $_GET['chemin'].'/'.$_GET['fichier']) ;

		
	}
  function lister($chemin,$nom_dossier,$tableau) {
    echo '<b>'.$nom_dossier.'</b><blockquote>';
   
    // nom du répertoire à lister
    $nom_repertoire = $chemin;
     
    // on ouvre un pointeur sur le repertoire
    $pointeur = opendir($nom_repertoire);
     
    // pour chaque fichier et dossier
    while ($fichier = readdir($pointeur))
    {
      // on ne traite pas les . et ..
      if(($fichier != '.') && ($fichier != '..'))
      {
        // si c'est un dossier, on le lit
        if (is_dir($nom_repertoire.'/'.$fichier))
        {
          lister($nom_repertoire.'/'.$fichier,$fichier,$tableau);
        }
        else
        {
          for($i=0;$i<count($tableau);$i++) {
          	if(strcmp($nom_repertoire, $tableau[$i]['emplacement']) === 0 ) {
          		if(strcmp($fichier, $tableau[$i]['titrefichier']) === 0) {
          			echo $fichier.'<a href="'.JURI::base().'index.php/component/mubaoz?modiffichier='.$tableau[$i]['titrefichier'].'"> modifier</a>';
                $url_download = JURI::base().'download?id='.$tableau[$i]['lienfichier'];
                ?><a href="<?php JURI::base()?>index.php?option=com_mubaoz?show_file=show_file" onclick="return alert('Lien de téléchargement : <?= $url_download; ?>')"> télécharger</a>
                <a href="<?php JURI::base()?>index.php/component/mubaoz?show_file=show_file&chemin='<?php echo $nom_repertoire?>'&fichier='<?php echo $fichier?>'" onclick="return confirm('Voulez-vous vraiment suprimer ce fichier?');"> Supprimer</a><br>
                
                <?php 
          		}
          	}
          }
        }
      }
    }
    echo '</blockquote>';
     //index.php/component/mubaoz
    //fermeture du pointeur
    closedir($pointeur);
  }
?>


<?php
	// Get a db connection.
	$db = JFactory::getDbo();
	 
	// Create a new query object.
	$query = $db->getQuery(true);
	 
	// Select all records from the user profile table where key begins with "custom.".
	// Order it by the ordering field.
	$query->select($db->quoteName(array('titrefichier', 'emplacement', 'lienfichier')));
	$query->from($db->quoteName('#__mubaoz_fichier'));
	$query->where($db->quoteName('id_user') . ' = '. $db->quote($user->get('id')));

	// Reset the query using our newly populated query object.
	$db->setQuery($query);
	 
	// Load the results as a list of stdClass objects (see later for more options on retrieving data).
	$results = $db->loadAssocList();
?>
<div class="register">
<h2>Arborescence de vos fichiers</h2>

<div class="listing">
  <?php
    $dir = JPATH_ROOT."/upload/shared";
    lister($dir,"shared",$results);
  ?>

  <b>users</b><blockquote>
    <?php
      $dir = JPATH_ROOT."/upload/users/".$user->username;
      lister($dir,$user->username,$results);
    ?>
  </blockquote>
</div>
</div>

