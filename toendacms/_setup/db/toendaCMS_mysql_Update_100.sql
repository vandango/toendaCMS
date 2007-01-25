
ALTER TABLE `#####contactform` ADD `show_contactemail` INT( 1 ) DEFAULT '0' NOT NULL ;
ALTER TABLE `#####user` CHANGE `group` `group` VARCHAR( 32 ) NOT NULL ;

CREATE TABLE `#####usergroup` (
`uid` VARCHAR( 32 ) NOT NULL ,
`name` VARCHAR( 25 ) NOT NULL ,
`right` INT( 1 ) NOT NULL
) TYPE = MYISAM;

INSERT INTO `#####usergroup` ( `uid` , `name` , `right` )
VALUES (
'daf91e6be506252b897977537fa488c8', 'Developer', '0'
), (
'8a318ecd72b639ceca72c87dbc6f241c', 'Administrator', '1'
);
INSERT INTO `#####usergroup` ( `uid` , `name` , `right` )
VALUES (
'7f2a4a04ddeffc7caa029e289be712a1', 'Writer', '2'
), (
'418aed8f001f0b88e36bc68013000794', 'Editor', '3'
);
INSERT INTO `#####usergroup` ( `uid` , `name` , `right` )
VALUES (
'fcc0abe286b322744765b271c8ede1fd', 'Presenter', '4'
), (
'c4e1aea1d163b0d3b3db90b667a2ba81', 'User', '5'
);

ALTER TABLE `#####contactform` ADD `contacttext` TEXT NOT NULL ;
ALTER TABLE `#####newsmanager` ADD `news_text` TEXT NOT NULL ;
ALTER TABLE `#####newsmanager` ADD `readmore_link` INT( 1 ) NOT NULL DEFAULT '0';
ALTER TABLE `#####newsmanager` ADD `news_spacing` INT( 2 ) NOT NULL DEFAULT '0';

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

ALTER TABLE `#####impressum` ADD `language` VARCHAR( 25 ) NOT NULL AFTER `uid` ;

ALTER TABLE `#####contactform` ADD `language` VARCHAR( 25 ) NOT NULL AFTER `uid` ;
