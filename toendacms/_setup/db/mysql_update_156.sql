
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

ALTER TABLE `#####products` CHANGE `category` `category` VARCHAR( 32 ) NULL;
ALTER TABLE `#####products` ADD `language` VARCHAR( 25 ) NOT NULL DEFAULT 'english_EN';
ALTER TABLE `#####products_config` ADD `use_sidebar_categories` TINYINT NOT NULL DEFAULT '1';
ALTER TABLE `#####products_config` ADD `max_latest_products` INT NOT NULL DEFAULT '15';

ALTER TABLE `#####newsmanager` ADD `use_rss091_img` TINYINT NOT NULL DEFAULT '1';
ALTER TABLE `#####newsmanager` ADD `rss091_text` VARCHAR( 255 ) NOT NULL DEFAULT '';
ALTER TABLE `#####newsmanager` ADD `use_rss10_img` TINYINT NOT NULL DEFAULT '1';
ALTER TABLE `#####newsmanager` ADD `rss10_text` VARCHAR( 255 ) NOT NULL DEFAULT '';
ALTER TABLE `#####newsmanager` ADD `use_rss20_img` TINYINT NOT NULL DEFAULT '1';
ALTER TABLE `#####newsmanager` ADD `rss20_feed` VARCHAR( 255 ) NOT NULL DEFAULT '';
ALTER TABLE `#####newsmanager` ADD `use_atom03_img` TINYINT NOT NULL DEFAULT '1';
ALTER TABLE `#####newsmanager` ADD `atom03_text` VARCHAR( 255 ) NOT NULL DEFAULT '';
ALTER TABLE `#####newsmanager` ADD `use_opml_img` TINYINT NOT NULL DEFAULT '1';
ALTER TABLE `#####newsmanager` ADD `opml_text` VARCHAR( 255 ) NOT NULL DEFAULT '';
ALTER TABLE `#####newsmanager` ADD `use_comment_feed` TINYINT NOT NULL DEFAULT '1';
ALTER TABLE `#####newsmanager` ADD `comment_feed_text` VARCHAR( 255 ) NULL DEFAULT '';
ALTER TABLE `#####newsmanager` ADD `comment_feed_type` VARCHAR( 7 ) NULL DEFAULT '';
ALTER TABLE `#####newsmanager` ADD `use_comment_feed_img` TINYINT NOT NULL DEFAULT '0';
ALTER TABLE `#####newsmanager` ADD `comments_feed_amount` INT NOT NULL DEFAULT '5';
