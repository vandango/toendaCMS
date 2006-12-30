
ALTER TABLE `#####contactform` ADD `contacttext` TEXT NOT NULL ;
ALTER TABLE `#####newsmanager` ADD `news_text` TEXT NOT NULL ;
ALTER TABLE `#####newsmanager` ADD `readmore_link` INT( 1 ) NOT NULL DEFAULT '0';
ALTER TABLE `#####newsmanager` ADD `news_spacing` INT( 2 ) NOT NULL DEFAULT '0';
