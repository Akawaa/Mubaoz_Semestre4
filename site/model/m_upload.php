<?php
        include JPATH_COMPONENT."/model/m_fonction.php";
        include JPATH_COMPONENT_ADMINISTRATOR."/controller/xml.php";
		include JPATH_COMPONENT_ADMINISTRATOR."/controller/controlfolder.php";
        if( isset($_POST['upload']) ) // si formulaire soumis
        {
        // dossier où sera déplacé le fichier
            foreach($xml as $path){
                $mypath=$path->currentpath; 
            }
            $content_dir = JPATH_ROOT.$pathos.$mypath.$pathos;
            echo $content_dir;
            $tmp_file = $_FILES['fichier']['tmp_name'];

            if( !is_uploaded_file($tmp_file) )
            {
                exit("Le fichier est introuvable");
            }

            // on vérifie maintenant l'extension je l'ai désactiver par defaut mais je l'ai crée.
            /* $type_file = $_FILES['fichier']['type'];

            if( !strstr($type_file, 'jpg') && !strstr($type_file, 'jpeg') && !strstr($type_file, 'bmp') && !strstr($type_file, 'gif') )
            {
                exit("Le fichier n'est pas une image");
            }*/

            // on copie le fichier dans le dossier de destination
            $name_file = $_FILES['fichier']['name'];

            $spl = new SplFileInfo($_FILES['fichier']['name']);
            $extension = $spl->getExtension();

            if( !move_uploaded_file($tmp_file, $_POST['destination']."/" . $_POST['file_name'].".".$extension) ) //test
            {
                exit("Impossible de copier le fichier dans $content_dir");
            }

            echo " Le fichier a bien été uploadé ".$_FILES['fichier']['type'];
        }



        //Insertion des données du formulaire
        if (isset($_POST['file_name'])) {
            //Connexion avec JFactory::getDBO();
            $db = JFactory::getDBO();

            // Création d'un query object.
            $query = $db->getQuery(true);

            // colonnes où on va insert
            $columns = array('id_user','nonfichier', 'emplacement', 'titrefichier', 'lienfichier', 'validitefichierstart', 'validitefichierend');


            $user =& JFactory::getUser();

            $id_user = $user->get('id');
            $nom_fichier = $_FILES['fichier']['name']; //nom fichiSer d'origine
            $emplacement = $_POST['destination'];

            $spl = new SplFileInfo($nom_fichier);
            $extension = $spl->getExtension();

            $file_name = $_POST['file_name'].".".$extension; //nom du fichier donné par l'user
            $lienfichier = md5($file_name);
            $recupdateDebut = $_POST['date_debut_validite'];
            $validitefichierstart = convertitDatepicker($recupdateDebut);
            $recupdateFin = $_POST['date_fin_validite'];
            $validitefichierend = convertitDatepicker($recupdateFin);



                    // values à insert
                    $values = array($db->quote($id_user),$db->quote($nom_fichier), $db->quote($emplacement), $db->quote($file_name),  $db->quote($lienfichier),  $db->quote($validitefichierstart), $db->quote($validitefichierend));

                    // prépare l'insert
                    $query
                        ->insert($db->quoteName('#__mubaoz_fichier'))
                        ->columns($db->quoteName($columns))
                        ->values(implode(',', $values));

                    // éxecute la requête
                    $db->setQuery($query);
                    $db->execute();
        }
        
        
?>