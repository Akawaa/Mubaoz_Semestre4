<?php

function read_ut (){
	
	$query = "SELECT #__users.id, #__users.name,#__users.username, #__users.email, #__users.registerDate
		  FROM #__mubaoz_blacklist, #__users
		  WHERE #__mubaoz_blacklist.id_user = #__users.id";
       
        $db=& JFactory::getDBO();
        $db->setQuery( $query );
        $rows = $db->loadObjectList(); 
        return $rows;
}

function insert($id){
	$db = JFactory::getDBO();

    // Création d'un query object.
    $query = $db->getQuery(true);

    // colonnes où on va insert
    $columns = array('id', 'id_user');

    // values à insert
    $values = array(null, $db->quote($id));

    // prépare l'insert
    $query
        ->insert($db->quoteName('#__mubaoz_blacklist'))
        ->columns($db->quoteName($columns))
        ->values(implode(',', $values));

    // éxecute la requête
    $db->setQuery($query);
    $db->execute();
}

function read_user(){
	$query = "SELECT #__users.id, #__users.username
		  FROM #__users";
       
        $db=& JFactory::getDBO();
        $db->setQuery( $query );
        $rows = $db->loadObjectList(); 
        return $rows;
}

function estSurBlacklist($id){
	$query = "SELECT *
		  FROM #__mubaoz_blacklist
		  WHERE #__mubaoz_blacklist.id_user = $id";
       
        $db=& JFactory::getDBO();
        $db->setQuery( $query );
        $rows = $db->loadObjectList(); 
        if($rows->id == null){
        	return true;
        }
        return false;
}
?>
