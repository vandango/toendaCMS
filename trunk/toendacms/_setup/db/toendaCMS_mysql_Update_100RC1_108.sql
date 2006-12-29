ALTER TABLE `#####sidemenu` ADD `parent_lvl2` VARCHAR( 5 ) DEFAULT '-' AFTER `parent` ,
ADD `parent_lvl3` VARCHAR( 5 ) DEFAULT '-' AFTER `parent_lvl2` ;

ALTER TABLE `#####sidemenu` ADD `root` VARCHAR( 5 ) DEFAULT '-' AFTER `subid` ;

ALTER TABLE `#####sidemenu` ADD `parent_lvl1` VARCHAR( 5 ) DEFAULT '-' AFTER `parent` ;
ALTER TABLE `#####user` ADD `skype` VARCHAR( 100 ) NULL DEFAULT '' AFTER `msn` ;

ALTER TABLE `#####contactform` ADD `show_contactemail` INT( 1 ) DEFAULT '0' NOT NULL  ;

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