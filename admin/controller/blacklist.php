<?php
$db =JFactory::getDBO();

$query = "SELECT * FROM #__users";
$db->setQuery($query);
$sxeblacklist = new SimpleXMLElement($xmlblacklist->asXML());
?>