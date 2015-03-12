<script>
    var chemin_revoquer = "<?php echo JUri::base().'components/com_mubaoz/view/revoquer.php' ?>"
</script>

<?php

function lister($tableau) {

    for($i=0;$i<count($tableau);$i++) {

        echo  "<tr><td><input type='checkbox' name='Choix[]'></td><td>".$tableau[$i]['nonfichier']."</td><td>".$tableau[$i]['titrefichier'].'</td><td>'.date("d-m-Y",strtotime($tableau[$i]['validitefichierstart'])).'</td><td>'.date("d-m-Y",strtotime($tableau[$i]['validitefichierend'])).'</td><td style="text-align: center;font-size:20px;"><a href="'.JURI::base().'index.php/component/mubaoz?modiffichier='.$tableau[$i]['titrefichier'].'">✎</a></td>';
        ?>
        <td style="text-align: center; font-size: 20px;"><a href="<?php JURI::base()?>index.php/component/mubaoz?show_file=show_tab_file&chemin='<?php echo $tableau[$i]['emplacement']; ?>'&fichier='<?php echo $tableau[$i]['titrefichier'];?>'" onclick="return confirm('Voulez-vous vraiment suprimer ce fichier?');">✘</a></td>
        <td style="text-align: center; font-size: 20px;"><a href="#" onclick="revoquerFichier('<?php echo $tableau[$i]['nonfichier'];?>');return false;">↫</a></td>
    <?php
    }
}

?>

<?php
// Get a db connection.
$db = JFactory::getDbo();

// Create a new query object.
$query = $db->getQuery(true);

// Select all records from the user profile table where key begins with "custom.".
// Order it by the ordering field.
$query->select($db->quoteName(array('titrefichier','emplacement','nonfichier','validitefichierstart','validitefichierend')));
$query->from($db->quoteName('#__mubaoz_fichier'));
$query->where($db->quoteName('id_user') . ' = '. $db->quote($user->get('id')),'OR');
$query->where($db->quoteName('emplacement').' = '. $db->quote(JPATH_ROOT."/upload/shared"));


// Reset the query using our newly populated query object.
$db->setQuery($query);

// Load the results as a list of stdClass objects (see later for more options on retrieving data).
$results = $db->loadAssocList();
?>
<div class="register">
    <h2>Listes des dossiers et de vos fichiers</h2>

    <script type="text/javascript">
        function CocheTout(ref, name) {
            var form = ref;

            while (form.parentNode && form.nodeName.toLowerCase() != 'form'){
                form = form.parentNode;
            }

            var elements = form.getElementsByTagName('input');

            for (var i = 0; i < elements.length; i++) {
                if (elements[i].type == 'checkbox' && elements[i].name == name) {
                    elements[i].checked = ref.checked;
                }
            }
        }
    </script>

    <table id="fichier" class="table">
        <form method="post" action="#">
            <input type="submit" class="register-button-small" name="supprimer" value="Supprimer">
            <input type="submit"  class="register-button-small" name="revoquer"  value="Révoquer">

            <tr>
                <th><input type="checkbox" onClick="CocheTout(this,'Choix[]')"></th>
                <th>Nom du fichier</th>
                <th>Titre</th>
                <th>Date début</th>
                <th>Date fin</th>
                <th>Modifier</th>
                <th>Supprimer</th>
                <th>Révoquer</th>
            </tr>

            <?php
            lister($results);
            ?>

        </form>
    </table>

</div>

