
ALTER TABLE `#####guestbook` ADD `text` TEXT NULL ,
ADD `language` VARCHAR( 25 ) NOT NULL DEFAULT 'english_EN';

RENAME TABLE `#####impressum`  TO `#####imprint` ;
