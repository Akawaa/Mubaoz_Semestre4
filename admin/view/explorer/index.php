<?php
/* Ceci est le fichier ou sera l'explorateur de fichier, vous pouvez modifier ce fichier a volonter, et rajouter des fichiers (images...) dans ce dossier.


Voivi une liste de fonction et de variable que j'ai crée qui peut vous etre utile et que vous pouvez utiliser :

rmdir_recursive($mondossier) permet de supprimer un dossier avec tous ce qu'il contient attention !

$oldpath ancin repertoire ou sont stocker les download

$currentpath repertoire actuel ou sont les ficier downloader, pour y acceder vous devez faire:
$currentpath=$_SERVER['DOCUMENT_ROOT'].$pathos.$currentpath.$pathos;

$pathos est une variable qui permet d'utiliser "/" ou "\" si vous etes sous Windows ou Linux

voila, pour la semmaine du 02/02/2015 je veut que le programme liste tous les fichiers du repertoire de download (Je l'ai fait) et affiche le titre du fichier et la date
et puis c'est tous, si on fais sa on aurra bien avancée.*/

?>

<?php
include JPATH_COMPONENT_ADMINISTRATOR."/controller/xml.php";
include JPATH_COMPONENT_ADMINISTRATOR."/controller/controlfolder.php";

?>

<style>
* {
    font-family : 'Arial', sans-serif;
    font-size : 12px;
}

ul {
    list-style : none;
    margin : 0px;
    padding : 0px;
    padding-left : 25px;
}

ul.tree {
/*display:none;*/
}

li {
    padding-left : 20px;
    line-height : 18px;
    cursor : pointer;
	list-style-type: none;
}

li.folder {
    background : url("components/com_mubaoz/view/explorer/folder.png") no-repeat left center;
}

li.file {
    background : background :url("components/com_mubaoz/view/explorer/file.png") no-repeat left center;
}


</style>

<script src="jquery-1.11.1.min.js"></script>
<script>
jQuery(function($){
    // On commence par cacher tous les sous dossiers
    $("ul.tree").hide();

    // Lors du click du un dossier
    $("li.folder").click(function () {
        // Si le dossier n'est pas ouvert on l'ouvre, sinon, on le ferme
        $(this).next("ul").toggle("fast");
    });

    // Lors du click sur un fichier
    $("li.file").click(function () {
        // On lance le téléchargement du fichier
        document.location = "dl.php?f="+$(this).attr("rel");
    });
});

</script>

<?php
echo "<div class='register-small'>
        <h3>Arborescence</h3>";
function scan($dir) {
    // On regarde déjà si le dossier existe
    if(is_dir($dir)) {
        // On le scan et on récupère dans un tableau le nom des fichiers et des dossiers
        $files = scandir($dir);

        // On supprime . et .. qui sont respectivement le dossier courant et le dossier précédent
        unset($files[0], $files[1]);

        // On tri le tableau de façon intéligente (à la façon humaine)
        // http://www.php.net/function.natcasesort
        natcasesort($files);

        // On commence par afficher les dossiers
        foreach($files as $f) {
            // S'il y a un dossier
            if(is_dir($dir.$f)) {
                // On affiche alors les données
                echo '<li class="folder">'.$f.'</li>';
                echo '<ul class="tree">';

                // Et du coup comme c'est un dossier, un le rescan
                scan($dir.$f."/");

                echo '</ul>';
            }
        }

        // Puis on affiche les fichiers
        foreach($files as $f) {
            // S'il y a un fichier
            if(is_file($dir.$f)) {
                echo '<li class="file" rel="'.$dir.$f.'">'.$f."test".'</li>';
            }
        }
    }
}

foreach($xml as $path){
		$dest= $path->currentpath;	
}

scan($_SERVER['DOCUMENT_ROOT'].$dest.$pathos);


$query = "SELECT * FROM #__mubaoz_fichier;";
$database = JFactory::getDBO();
        $database->setQuery( $query );          // execution de la requéte
        $rows = $database->loadObjectList();  // récupération des objets

foreach ( $rows as $row ) // parcourir les objets
{   
     echo $row->titrefichier;
} 
?>
