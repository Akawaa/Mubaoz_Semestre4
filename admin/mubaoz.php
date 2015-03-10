<?php
include JPATH_COMPONENT_ADMINISTRATOR."/view/head.php";
include JPATH_COMPONENT_ADMINISTRATOR."/view/menu.php";
include JPATH_COMPONENT_ADMINISTRATOR."/controller/xml.php";
include JPATH_COMPONENT_ADMINISTRATOR."/controller/controlfolder.php";

include JPATH_COMPONENT_ADMINISTRATOR."/model/dest.php";
include JPATH_COMPONENT_ADMINISTRATOR."/model/copy.php";
include JPATH_COMPONENT_ADMINISTRATOR."/model/suppr.php";
?>

<div class="contenu" id="contenu_1">
<?php include JPATH_COMPONENT_ADMINISTRATOR."/view/folderchoice.php"; ?>
</div>

<div class="contenu" id="contenu_2">
<?php
include JPATH_COMPONENT_ADMINISTRATOR."/controller/blacklist.php";
include JPATH_COMPONENT_ADMINISTRATOR."/view/blacklist.php";
?>
</div>
<div class="contenu" id="contenu_3">
<?php
include JPATH_COMPONENT_ADMINISTRATOR."/view/explorer/index.php";
?>
</div>
<?php
include JPATH_COMPONENT_ADMINISTRATOR."/view/footer.php";
?>
