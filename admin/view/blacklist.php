<div class="register-small">
	<h3>Blacklist</h3>
<p> Utilisateurs joomla </p>
<FORM method=post action="">
    <div style="width:100px;min-width:50px;height:auto;min-height:100px;border:2px solid #999999;border-color:green;">
<?php
$rows = $db->loadObjectList();
$name="toto";
$tab3= array();
foreach ($rows as $row) {
foreach ($sxeblacklist->users->name as $name) {
if (!in_array($row->username, $tab3))
   {
   	if ($name!=($row->username)) {
			echo '<INPUT type="submit" name="blacklist" value="'.$row->username.'"> <br>';
	}
    $tab3[]=$row->username;
   }
}
}
?>
	</div>


</FORM>
<p> Utilisateurs joomla inderdit d'uploader </p>
<FORM method=post action="">
    <div style="width:100px;min-width:50px;height:auto;min-height:100px;border:2px solid #999999;border-color:red;">
<?php
foreach ($sxeblacklist->users->name as $name) {
		if ($name!="00001100110000cx86") {
	  echo '<INPUT type="submit" name="blacklistsuppr" value="'.htmlspecialchars($name, ENT_NOQUOTES, 'UTF-8').'"> <br>';
	  }
}
?>
</div>
</FORM>

<?php

if(!empty($_POST['blacklist'])) {
$datatest=$_POST['blacklist'];

$res=count($sxeblacklist->xpath("//name[text() = '$datatest']"));
if ($res==0) {
	$character = $sxeblacklist->users[0];
	$character->addChild('name',$_POST['blacklist']);
	$sxeblacklist->asXML($blacklistfile);
}
unset($_POST);
$page = $monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; 
header("Refresh: $sec; url=$page");
}


if(!empty($_POST['blacklistsuppr'])) {
$res=$_POST['blacklistsuppr'];
unset($sxeblacklist->xpath('/blacklist/users/name[.="' . $res . '"]')[0][0]);
$sxeblacklist->asXML($blacklistfile);
unset($_POST);
$page = $monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; 
header("Refresh: $sec; url=$page");
}
?>
</div>