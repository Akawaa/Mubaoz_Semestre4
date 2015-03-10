<?php
	function forcerTelechargement($nom, $situation, $poids)
	{
		header('Content-Type: application/octet-stream');
		header('Content-Length: '. $poids);
		header('Content-disposition: attachment; filename='. $nom);
		header('Pragma: no-cache');
		header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		header('Expires: 0');
		readfile($situation);
		exit();
	}

	// Get a db connection.
	$db = JFactory::getDbo();
	 
	// Create a new query object.
	$query = $db->getQuery(true);
	 
	// Select all records from the user profile table where key begins with "custom.".
	// Order it by the ordering field.
	$query->select($db->quoteName(array('titrefichier', 'emplacement', 'lienfichier', 'validitefichierstart', 'validitefichierend')));
	$query->from($db->quoteName('#__mubaoz_fichier'));
	$query->where($db->quoteName('id_user') . ' = '. $db->quote($user->get('id')));

	// Reset the query using our newly populated query object.
	$db->setQuery($query);
	 
	// Load the results as a list of stdClass objects (see later for more options on retrieving data).
	$results = $db->loadAssocList();



	if(isset($id_download)) {
		for($i=0;$i<count($results);$i++) {
			// **** rajouter une vérification si la validité et correct
          	if(strcmp($id_download, $results[$i]['lienfichier']) === 0 ) {
          		$date1 = date_create($results[$i]['validitefichierstart']);
          		$date2 = date_create(date("y")."-".date("m")."-".date("d"));
          		$date3 = date_create($results[$i]['validitefichierend']);
          		if ($date1 > $date2) {
          			header('Location: http://localhost/Site-Projet-Tut/Joomla_3.3.6-Stable-Full_Package/index.php?option=com_mubaoz&dateperimestart='.$results[$i]['validitefichierstart']); 
          		}
          		else if ($date3 < $date2) {
          			header('Location: http://localhost/Site-Projet-Tut/Joomla_3.3.6-Stable-Full_Package/index.php?option=com_mubaoz&dateperimeend='.$results[$i]['validitefichierend']); 
          		}
          		else {
          			// correspondance entre url et bdd
          			$chemin = $results[$i]['emplacement'].'/'.$results[$i]['titrefichier'];
          			forcerTelechargement($results[$i]['titrefichier'], $chemin, filesize($chemin));
          		}
          	}
        }
	}
?>