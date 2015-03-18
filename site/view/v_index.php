<?php
//include JPATH_COMPONENT."/model/m_fonction.php"; 
$user = JFactory::getUser();
$userName = $user->username;
?>

<script>
function plugin() {
document.writeln('<style> h1, h2, h3, h4, h5, h6, .site-title, .navigation, .well, img { display:none;}</style>');
}
if (top.frames.length!=0)plugin();
</script>



<h2>Bienvenue <?php if (!$user->guest) {
 echo $user->username;} ?></h2>
<h3><i>vous êtes sur la partie utilisateur du module</i></h3>
<?php
if (!$user->guest) {
$tab3= array();
$i=0; 
foreach ($sxeblacklist->users->name as $param => $value) {
    $tab3[]=$value;
	  }

if(!in_array($user->username, $tab3)):?>
    <a class="menu" href="<?php JURI::base()?>index.php?option=com_mubaoz?upload=upload" >Ajouter un fichier</a>
	<a class="menu" href="<?php JURI::base()?>index.php?option=com_mubaoz?newRepertory=newRepertory" >Creer un nouveau sous dossier</a>
	<a class="menu" href="<?php JURI::base()?>index.php?option=com_mubaoz?show_file=show_file">Mes fichiers uploadé</a>
	<a class="menu" href="<?php JURI::base()?>index.php?option=com_mubaoz?show_tab_file=show_tab_file">Tableaux des fichiers</a><br><br>
<br><br>
<?php 
endif;
}
?>

<?php if (isset($_GET['upload'])) {
	include JPATH_COMPONENT."/view/v_button_up.php";
}?>

<?php if (isset($_GET['show_file'])) {
	include JPATH_COMPONENT."/view/v_listing.php";
}?>
<?php if (isset($_GET['newRepertory'])) { 
	include JPATH_COMPONENT."/view/v_newFolder.php";
}?>
<?php if (isset($_GET['show_tab_file'])) {
	include JPATH_COMPONENT."/view/v_tableau_fichier.php";
}?>

<?php
	if (isset($_GET['modiffichier'])) {
		include JPATH_COMPONENT."/view/v_modif_fichier.php";
	}
?>


<?php
	if(isset($_GET['id'])) {
		$id_download = $_GET['id'];
		include JPATH_COMPONENT."/view/download.php";
	}

	if (isset($_GET['dateperimestart'])) {
		echo "<b>Vérifiez la date de validité de votre fichier, le fichier sera valide le '".$_GET['dateperimestart']."'' !</b>";
	}
	if (isset($_GET['dateperimeend'])) {
		echo "<b>Vérifiez la date de validité de votre fichier, le fichier est périmé !</b>";
	}
?>