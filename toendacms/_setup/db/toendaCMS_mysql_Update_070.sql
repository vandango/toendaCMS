
CREATE TABLE `#####knowledgebase` (
`uid` VARCHAR( 10 ) NOT NULL ,
`category` VARCHAR( 10 ) ,
`parent` VARCHAR( 10 ) , 
`title` VARCHAR( 255 ) ,
`subtitle` VARCHAR( 255 ) ,
`content` TEXT,
`image` VARCHAR( 255 ) ,
`type` CHAR( 1 ) NOT NULL ,
`date` VARCHAR( 16 ) NOT NULL ,
`last_update` VARCHAR( 16 ) NOT NULL ,
`access` VARCHAR( 10 ) NOT NULL ,
`autor` VARCHAR( 255  ) NOT NULL ,
`sort` INT( 5 ) NOT NULL ,
`publish_state` INT( 1 ) NOT NULL
) TYPE = MYISAM ;


CREATE TABLE `#####knowledgebase_config` (
`uid` VARCHAR( 13 ) NOT NULL ,
`id` VARCHAR( 13 ) NOT NULL ,
`title` VARCHAR( 255 ) NULL ,
`subtitle` VARCHAR( 255 ) NULL ,
`text` TEXT NULL ,
`enabled` INT( 1 ) NOT NULL ,
`autor_enabled` INT( 1 ) NOT NULL, 
`access` VARCHAR( 10 ) NOT NULL
) TYPE = MYISAM ;

INSERT INTO `#####knowledgebase_config` ( `uid` , `id` , `title` , `subtitle` , `text` , `enabled` , `autor_enabled` , `access` )
VALUES (
'knowledgebase', 'knowledgebase', 'FAQs and Articles', 'A small knowledge database', 'Here you will find an example set of FAQs and Articles.', 1, 1, 'Public'
);

ALTER TABLE `#####frontpage` ADD `sb_news_title` VARCHAR( 255 ) AFTER `module_use_0` ,
ADD `sb_news_amount` INT( 2 ) AFTER `sb_news_title` ,
ADD `sb_news_chars` INT( 5 ) AFTER `sb_news_amount` ;

ALTER TABLE `#####frontpage` ADD `sb_news_enabled` INT( 1 ) NOT NULL AFTER `sb_news_chars` ;

ALTER TABLE `#####frontpage` ADD `sb_news_display` INT( 1 ) NOT NULL AFTER `sb_news_enabled` ;

ALTER TABLE `#####user` ADD `last_login` VARCHAR( 19 ) AFTER `join_date` ;

ALTER TABLE `#####newsmanager` ADD `use_timesince` INT( 1 ) NOT NULL AFTER `use_trackback` ;

ALTER TABLE `#####contactform` ADD `use_adressbook` INT( 1 ) AFTER `enabled` ;

ALTER TABLE `#####contactform` ADD `use_contact` INT( 1 ) AFTER `use_adressbook` ;

ALTER TABLE `#####imagegallery_config` ADD `image_sort` VARCHAR( 4 ) NOT NULL DEFAULT 'desc';

ALTER TABLE `#####sidebar_extensions` ADD `show_memberlist` INT NOT NULL AFTER `show_news_cat_amount` ;

ALTER TABLE `#####imagegallery_config` ADD `list_option` INT( 1 ) NOT NULL AFTER `image_sort` ;

ALTER TABLE `#####downloads` ADD `parent` VARCHAR( 10 ) NOT NULL AFTER `cat` ;
ALTER TABLE `#####downloads` CHANGE `cat` `cat` VARCHAR( 10 ) NULL DEFAULT NULL ;
ALTER TABLE `#####downloads` CHANGE `uid` `uid` VARCHAR( 10 ) NOT NULL ;
ALTER TABLE `#####downloads` CHANGE `folder` `folder` VARCHAR( 255 ) NULL ,
CHANGE `parent` `parent` VARCHAR( 10 ) NULL ;
ALTER TABLE `#####downloads` ADD `mirror` INT( 1 ) AFTER `sql_type` ;
ALTER TABLE `#####downloads` DROP `folder` ;
ALTER TABLE `#####sidemenu` ADD `parent_lvl2` VARCHAR( 5 ) DEFAULT '-' AFTER `parent` ,
ADD `parent_lvl3` VARCHAR( 5 ) DEFAULT '-' AFTER `parent_lvl2` ;

ALTER TABLE `#####sidemenu` ADD `root` VARCHAR( 5 ) DEFAULT '-' AFTER `subid` ;
ALTER TABLE `#####sidemenu` ADD `parent_lvl1` VARCHAR( 5 ) DEFAULT '-' AFTER `parent` ;

ALTER TABLE `#####user` ADD `skype` VARCHAR( 100 ) NULL DEFAULT '' AFTER `msn` ;

ALTER TABLE `#####contactform` ADD `show_contactemail` INT( 1 ) DEFAULT '0' NOT NULL ;

CREATE TABLE `#####usergroup` (
`uid` VARCHAR( 32 ) NOT NULL ,
`name` VARCHAR( 25 ) NOT NULL ,
`right` INT( 1 ) NOT NULL
) TYPE = MYISAM;

ALTER TABLE `#####user` CHANGE `group` `group` VARCHAR( 32 ) NOT NULL ;

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
