CREATE TABLE IF NOT EXISTS `#__mubaoz_fichier` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
`id_user` int(11) NOT NULL,
`nonfichier` VARCHAR(255) NOT NULL ,
`emplacement` VARCHAR(255) NOT NULL ,
`titrefichier` VARCHAR(255)  NOT NULL ,
`lienfichier` VARCHAR(255)  NOT NULL ,
`validitefichierstart` DATE NOT NULL DEFAULT '0000-00-00',
`validitefichierend` DATE NOT NULL DEFAULT '0000-00-00',
PRIMARY KEY (`id`),
FOREIGN KEY (`id_user`) REFERENCES `#__users`(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__mubaoz_blacklist` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
`id_user` int(11),
PRIMARY KEY (`id`),
FOREIGN KEY (`id_user`) REFERENCES `#__users`(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT COLLATE=utf8_general_ci;