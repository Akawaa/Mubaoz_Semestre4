<?php
define( '_JEXEC', 1 );
define( 'JPATH_BASE', realpath(dirname(__FILE__).'/../../../' ));
require_once ( JPATH_BASE.'/includes/defines.php' );
require_once ( JPATH_BASE.'/includes/framework.php' );

$mainframe = JFactory::getApplication('site');
?>
<?php

header("Content-Type: text/plain");

//Connexion avec JFactory::getDBO();
$db = JFactory::getDBO();

// Création d'un query object.
$query = $db->getQuery(true);


$nomFichier = $_POST["nom"];
$titreFichier = $_POST["titre"];
$user_courant =& JFactory::getUser();


$condition = array(
    $db->quoteName('id_user') . ' = '.$user_courant->id,
    $db->quoteName('nonfichier') . ' = ' . $db->quote($nomFichier),
    $db->quoteName('titrefichier') . ' = ' . $db->quote($titreFichier),
);

$query->delete($db->quoteName('#__mubaoz_fichier'))->where($condition);

$db->setQuery($query);

$result = $db->execute();

?>