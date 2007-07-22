
ALTER TABLE `#####products_config` ADD `language` VARCHAR( 25 );
ALTER TABLE `#####products_config` ADD `show_price_only_users` TINYINT NULL;
ALTER TABLE `#####products_config` ADD `startpagetitle` VARCHAR( 255 ) NULL ;

ALTER TABLE `#####products` CHANGE `image` `image1` VARCHAR( 255 );
ALTER TABLE `#####products` ADD `image2` VARCHAR( 255 ) NULL ,
ADD `image3` VARCHAR( 255 ) NULL ,
ADD `image4` VARCHAR( 255 ) NULL ,
ADD `show_on_startpage` TINYINT NOT NULL DEFAULT '0',
ADD `pub` TINYINT NOT NULL DEFAULT '0',
ADD `parent` VARCHAR( 32 ) NULL ;
ALTER TABLE `#####products` CHANGE `category` `category` VARCHAR( 32 );
ALTER TABLE `#####products` CHANGE `category` `category` VARCHAR( 32 ) NULL;
ALTER TABLE `#####products` ADD `language` VARCHAR( 25 ) NOT NULL DEFAULT 'english_EN';
ALTER TABLE `#####products_config` ADD `use_sidebar_categories` TINYINT NOT NULL DEFAULT '1';
