
ALTER TABLE `#####imagegallery_config` ADD `list_option_amount` TINYINT NOT NULL DEFAULT '4';

ALTER TABLE `#####guestbook` ADD `text` TEXT NULL ,
ADD `language` VARCHAR( 25 ) NOT NULL DEFAULT 'english_EN';

RENAME TABLE `#####impressum`  TO `#####imprint` ;
