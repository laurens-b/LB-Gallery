DROP TABLE IF EXISTS `#__lbgallery_items`;
 
CREATE TABLE `#__lbgallery_items` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`catid` INT(11) NOT NULL DEFAULT '0',
	`alias` VARCHAR(255) NOT NULL,
	`title` VARCHAR(255) NOT NULL,
	`path` VARCHAR(255) NOT NULL,
	`created` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
	`published` tinyint(4) NOT NULL,
	`ordering` int(11) NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`)
)
	ENGINE =MyISAM
	AUTO_INCREMENT =0
	DEFAULT CHARSET =utf8;


# Denk om aanpassen uninstall.mysql.utf8.sql bij onderstaande!!
#
# DROP TABLE IF EXISTS `#__lbgallery_albums`;
# 
# CREATE TABLE `#__lbgallery_albums` (
# 	`id` INT(11) NOT NULL AUTO_INCREMENT,
# 	`title` VARCHAR(255) NOT NULL,
# 	`created` DATETIME NOT NULL DEFAULT NOW(),
# 	`state` tinyint(4) NOT NULL,
# 	PRIMARY KEY (`id`)
# )
# 	ENGINE =MyISAM
# 	AUTO_INCREMENT =0
# 	DEFAULT CHARSET =utf8;
