
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