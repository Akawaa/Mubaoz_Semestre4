<?php
$urlcomponentadmin = JPATH_COMPONENT_ADMINISTRATOR;
$fichier = JPATH_COMPONENT_ADMINISTRATOR."/controller/path.xml";
$urljoomla=JPATH_ROOT;

if(file_exists($fichier)) {

	$xml = simplexml_load_file($fichier);

} else {
	exit( '<pre>Echec lors de l\'ouverture du fichier '.$fichier.'</pre>
	<pre> Veuillez réinstaller Mubaoz</pre>' );
}

$blacklistfile = JPATH_COMPONENT_ADMINISTRATOR."/controller/blacklist.xml";

if(file_exists($blacklistfile)) {

	$xmlblacklist = simplexml_load_file($blacklistfile);

} else {
	exit( '<pre>Echec lors de l\'ouverture du fichier '.$fichier.'</pre>
	<pre> Veuillez réinstaller Mubaoz</pre>' );
}

if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
   $pathos="\\";
} else {
   $pathos="/";
}
?>