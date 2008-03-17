
ALTER TABLE `#####guestbook` ADD `text` TEXT NULL ,
ADD `language` VARCHAR( 25 ) NOT NULL DEFAULT 'english_EN';

RENAME TABLE `#####impressum`  TO `#####imprint` ;

CREATE TABLE `#####log` (
`uid` VARCHAR( 32 ) NOT NULL ,
`user_uid` VARCHAR( 32 ) NULL ,
`stamp` INT( 11 ) NOT NULL COMMENT 'UNIX-Timestamp',
`ip` VARCHAR( 40 ) NULL ,
`module` VARCHAR( 40 ) NULL ,
`text` TEXT NULL
);
