
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

ALTER TABLE `#####news` ADD `show_on_frontpage` INT( 1 ) NOT NULL ;
UPDATE `#####news` SET `show_on_frontpage` = 1;

ALTER TABLE `#####sidebar_extensions` ADD `lang` VARCHAR( 255 ) NOT NULL ;
