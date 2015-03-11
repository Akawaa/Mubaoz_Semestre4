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

$titreFichier = $_POST["titre"];

$revoque= new DateTime('NOW');
$revoque->modify('-1 day');



$dateFin = array(
    $db->quoteName('validitefichierend') . ' = ' . $db->quote($revoque->format("Y-m-d"))
);

$condition = array(
    $db->quoteName('nonfichier') . ' = ' . $db->quote($titreFichier)
);

$query->update($db->quoteName('#__mubaoz_fichier'))->set($dateFin)->where($condition);

$db->setQuery($query);

$result = $db->execute();

echo "Votre fichier a bien été révoqué à la date d'hier,\n soit au ".$revoque->format('d-m-Y').".";

?>