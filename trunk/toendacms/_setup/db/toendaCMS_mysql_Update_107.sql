
ALTER TABLE `#####sidemenu` ADD `target` VARCHAR( 20 ) NULL DEFAULT '';
ALTER TABLE `#####topmenu` ADD `target` VARCHAR( 20 ) NULL DEFAULT '';

ALTER TABLE `#####content` ADD `language` VARCHAR( 25 ) NULL ;

CREATE TABLE `#####content_languages` (
	`uid` VARCHAR( 5 ) NOT NULL ,
	`content_uid` VARCHAR( 5 ) NOT NULL ,
	`language` VARCHAR( 25 ) NOT NULL ,
	`title` VARCHAR( 255 ) NULL ,
	`key` VARCHAR( 255 ) NULL ,
	`content00` TEXT NULL ,
	`content01` TEXT NULL ,
	`foot` VARCHAR( 255 ) NULL ,
	`autor` VARCHAR( 255 ) NULL
) ENGINE = MyISAM;

ALTER TABLE `#####content_languages` ADD `db_layout` VARCHAR( 50 ) NOT NULL ,
ADD `access` VARCHAR( 10 ) NOT NULL ,
ADD `in_work` INT NOT NULL DEFAULT '0',
ADD `published` INT NOT NULL DEFAULT '0';

ALTER TABLE `#####news` ADD `show_on_frontpage` INT( 1 ) NOT NULL ;
UPDATE `#####news` SET `show_on_frontpage` = 1;

ALTER TABLE `#####sidebar_extensions` ADD `lang` VARCHAR( 255 ) NOT NULL ;

ALTER TABLE `#####frontpage` ADD `language` VARCHAR( 25 ) NOT NULL AFTER `uid` ;

ALTER TABLE `#####newsmanager` ADD `language` VARCHAR( 25 ) NOT NULL ;
