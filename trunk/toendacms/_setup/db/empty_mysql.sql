-- phpMyAdmin SQL Dump
-- version 2.8.2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Erstellungszeit: 17. Februar 2007 um 01:11
-- Server Version: 5.0.21
-- PHP-Version: 5.2.1
-- 
-- Datenbank: `tcms_blog`
-- 

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####albums`
-- 

CREATE TABLE `#####albums` (
  `uid` varchar(12) NOT NULL default '',
  `title` varchar(255) default NULL,
  `album_id` varchar(6) NOT NULL default '',
  `published` int(1) NOT NULL default '0',
  `desc` text,
  `image` varchar(255) default NULL,
  PRIMARY KEY  (`uid`)
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####albums`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####comments`
-- 

CREATE TABLE `#####comments` (
  `uid` varchar(10) NOT NULL default '',
  `module` varchar(5) NOT NULL default '',
  `timestamp` varchar(14) NOT NULL default '',
  `name` varchar(255) NOT NULL default '',
  `email` varchar(255) default NULL,
  `web` varchar(255) default NULL,
  `msg` text,
  `time` varchar(14) NOT NULL default '',
  `ip` varchar(15) default NULL,
  `domain` varchar(255) default NULL,
  PRIMARY KEY  (`uid`)
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####comments`
-- 

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####contactform`
-- 

CREATE TABLE `#####contactform` (
  `uid` varchar(11) NOT NULL default '',
  `language` varchar(25) NOT NULL,
  `contact` varchar(255) NOT NULL default '',
  `show_contacts_in_sidebar` int(1) NOT NULL default '0',
  `send_id` varchar(11) NOT NULL default '',
  `contacttitle` varchar(255) NOT NULL default '',
  `contactstamp` varchar(255) NOT NULL default '',
  `contacttext` text NOT NULL,
  `access` varchar(10) NOT NULL default '',
  `enabled` int(1) default NULL,
  `use_adressbook` int(1) default NULL,
  `use_contact` int(1) default NULL,
  `show_contactemail` int(1) NOT NULL default '0',
  PRIMARY KEY  (`uid`)
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####contactform`
-- 

INSERT INTO `#####contactform` (`uid`, `language`, `contact`, `show_contacts_in_sidebar`, `send_id`, `contacttitle`, `contactstamp`, `contacttext`, `access`, `enabled`, `use_adressbook`, `use_contact`, `show_contactemail`) VALUES ('contactform', 'english_EN', 'info@toenda.com', 0, 'contactform', 'Contact Us and ...', '... send us a message.', 'my contacttext&lt;br /&gt;\r\n', 'Public', 1, 1, 1, 1),
('196716e11c5', 'germany_DE', '', 0, 'contactform', '', '', '', 'Public', 1, 0, 0, 0);

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####contacts`
-- 

CREATE TABLE `#####contacts` (
  `uid` varchar(10) NOT NULL default '',
  `default_con` int(1) NOT NULL default '0',
  `published` int(1) NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `position` varchar(255) default NULL,
  `email` varchar(255) NOT NULL default '',
  `street` varchar(255) default NULL,
  `country` varchar(255) default NULL,
  `state` varchar(255) default NULL,
  `town` varchar(255) default NULL,
  `postal` int(8) default NULL,
  `phone` varchar(40) default NULL,
  `fax` varchar(40) default NULL,
  PRIMARY KEY  (`uid`)
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####contacts`
-- 

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####content`
-- 

CREATE TABLE `#####content` (
  `uid` varchar(5) NOT NULL default '',
  `title` varchar(255) default NULL,
  `key` varchar(255) default NULL,
  `content00` text,
  `content01` text,
  `foot` varchar(255) default NULL,
  `db_layout` varchar(50) default NULL,
  `access` varchar(10) NOT NULL default '',
  `in_work` int(1) NOT NULL default '0',
  `published` int(1) NOT NULL default '0',
  `autor` varchar(255) default NULL,
  `language` varchar(25) default NULL,
  PRIMARY KEY  (`uid`)
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####content`
-- 

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####content_languages`
-- 

CREATE TABLE `#####content_languages` (
  `uid` varchar(5) collate utf8_unicode_ci NOT NULL,
  `content_uid` varchar(5) collate utf8_unicode_ci NOT NULL,
  `language` varchar(25) collate utf8_unicode_ci NOT NULL,
  `title` varchar(255) collate utf8_unicode_ci default NULL,
  `key` varchar(255) collate utf8_unicode_ci default NULL,
  `content00` text collate utf8_unicode_ci,
  `content01` text collate utf8_unicode_ci,
  `foot` varchar(255) collate utf8_unicode_ci default NULL,
  `autor` varchar(255) collate utf8_unicode_ci default NULL,
  `db_layout` varchar(50) collate utf8_unicode_ci NOT NULL,
  `access` varchar(10) collate utf8_unicode_ci NOT NULL,
  `in_work` int(11) NOT NULL default '0',
  `published` int(11) NOT NULL default '0'
) ENGINE=InnoDB ;

-- 
-- Daten für Tabelle `#####content_languages`
-- 

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####downloads`
-- 

CREATE TABLE `#####downloads` (
  `uid` varchar(10) NOT NULL default '',
  `name` varchar(255) default NULL,
  `date` varchar(16) NOT NULL default '',
  `desc` text,
  `type` varchar(255) NOT NULL default '',
  `sort` int(1) default NULL,
  `pub` int(1) default NULL,
  `access` varchar(10) default NULL,
  `image` varchar(255) default NULL,
  `file` varchar(255) default NULL,
  `cat` varchar(10) default NULL,
  `parent` varchar(10) default NULL,
  `sql_type` char(1) NOT NULL default '',
  `mirror` int(1) default NULL,
  PRIMARY KEY  (`uid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####downloads`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####downloads_config`
-- 

CREATE TABLE `#####downloads_config` (
  `uid` varchar(8) NOT NULL default '',
  `download_id` varchar(8) NOT NULL default '',
  `download_title` varchar(255) default NULL,
  `download_stamp` varchar(255) default NULL,
  `download_text` text
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####downloads_config`
-- 

INSERT INTO `#####downloads_config` (`uid`, `download_id`, `download_title`, `download_stamp`, `download_text`) 
VALUES ('download', 'download', '', '', '');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####frontpage`
-- 

CREATE TABLE `#####frontpage` (
  `uid` varchar(9) NOT NULL default '',
  `language` varchar(25) NOT NULL,
  `front_id` varchar(9) NOT NULL default '',
  `front_title` varchar(255) default NULL,
  `front_stamp` varchar(255) default NULL,
  `front_text` text,
  `news_title` varchar(255) default NULL,
  `news_cut` int(5) NOT NULL default '0',
  `module_use_0` int(2) NOT NULL default '0',
  `sb_news_title` varchar(255) default NULL,
  `sb_news_amount` int(2) default NULL,
  `sb_news_chars` int(5) default NULL,
  `sb_news_enabled` int(1) NOT NULL default '0',
  `sb_news_display` int(1) NOT NULL default '0',
  PRIMARY KEY  (`uid`)
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####frontpage`
-- 

INSERT INTO `#####frontpage` (`uid`, `language`, `front_id`, `front_title`, `front_stamp`, `front_text`, `news_title`, `news_cut`, `module_use_0`, `sb_news_title`, `sb_news_amount`, `sb_news_chars`, `sb_news_enabled`, `sb_news_display`) 
VALUES ('24k58ilp6', 'english_EN', 'frontpage', '', '', '', 'News', 0, 5, '', 5, 100, 0, 3),
('4frtgh587', 'germany_DE', 'frontpage', '', '', '', 'Neuigkeiten', 0, 5, '', 5, 100, 0, 3);

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####guestbook`
-- 

CREATE TABLE `#####guestbook` (
  `uid` varchar(9) NOT NULL default '',
  `guest_id` varchar(9) default NULL,
  `booktitle` varchar(255) default NULL,
  `bookstamp` varchar(255) default NULL,
  `access` varchar(10) default NULL,
  `enabled` int(1) default NULL,
  `clean_link` int(1) NOT NULL default '0',
  `clean_script` int(1) NOT NULL default '0',
  `convert_at` int(1) NOT NULL default '0',
  `show_email` int(1) NOT NULL default '0',
  `name_width` varchar(4) default NULL,
  `text_width` varchar(4) default NULL,
  `color_row_1` varchar(6) default NULL,
  `color_row_2` varchar(6) default NULL
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####guestbook`
-- 

INSERT INTO `#####guestbook` (`uid`, `guest_id`, `booktitle`, `bookstamp`, `access`, `enabled`, `clean_link`, `clean_script`, `convert_at`, `show_email`, `name_width`, `text_width`, `color_row_1`, `color_row_2`) 
VALUES ('guestbook', 'guestbook', '', '', 'Public', 1, 1, 1, 1, 1, '140', '360', 'efefef', 'ffffff');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####guestbook_items`
-- 

CREATE TABLE `#####guestbook_items` (
  `uid` varchar(32) NOT NULL default '',
  `name` varchar(255) default NULL,
  `email` varchar(255) default NULL,
  `text` text,
  `date` varchar(8) default NULL,
  `time` varchar(5) default NULL
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####guestbook_items`
-- 

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####imagegallery`
-- 

CREATE TABLE `#####imagegallery` (
  `uid` varchar(10) NOT NULL default '',
  `album` varchar(6) NOT NULL default '',
  `image` varchar(255) NOT NULL default '',
  `text` text,
  `date` varchar(14) NOT NULL default ''
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####imagegallery`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####imagegallery_config`
-- 

CREATE TABLE `#####imagegallery_config` (
  `uid` varchar(12) NOT NULL default '',
  `image_id` varchar(12) NOT NULL default '',
  `image_title` varchar(255) default NULL,
  `image_stamp` text,
  `image_details` int(1) NOT NULL default '0',
  `use_comments` int(1) NOT NULL default '0',
  `access` varchar(10) NOT NULL default '',
  `max_image` int(2) default NULL,
  `needle_image` varchar(255) default NULL,
  `show_lastimg_title` int(1) default NULL,
  `align_image` varchar(6) default NULL,
  `size_image` int(3) default NULL,
  `image_sort` varchar(4) NOT NULL default 'desc',
  `list_option` int(1) NOT NULL default '0'
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####imagegallery_config`
-- 

INSERT INTO `#####imagegallery_config` (`uid`, `image_id`, `image_title`, `image_stamp`, `image_details`, `use_comments`, `access`, `max_image`, `needle_image`, `show_lastimg_title`, `align_image`, `size_image`, `image_sort`, `list_option`) 
VALUES ('imagegallery', 'imagegallery', '', '', 0, 1, 'Public', 5, '', 1, 'center', 100, 'desc', 1);

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####impressum`
-- 

CREATE TABLE `#####impressum` (
  `uid` varchar(9) NOT NULL default '',
  `language` varchar(25) NOT NULL,
  `imp_id` varchar(9) NOT NULL default '',
  `imp_title` varchar(255) default NULL,
  `imp_stamp` varchar(255) default NULL,
  `imp_contact` varchar(10) NOT NULL default '',
  `taxno` varchar(50) default NULL,
  `ustid` varchar(50) default NULL,
  `legal` text
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####impressum`
-- 

INSERT INTO `#####impressum` (`uid`, `language`, `imp_id`, `imp_title`, `imp_stamp`, `imp_contact`, `taxno`, `ustid`, `legal`)
VALUES ('impressum', 'english_EN', 'impressum', '', '', '', '', '', ''),
('hgztkj87r', 'germany_DE', 'impressum', '', '', '', '', '', '');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####knowledgebase`
-- 

CREATE TABLE `#####knowledgebase` (
  `uid` varchar(10) NOT NULL default '',
  `category` varchar(10) default NULL,
  `parent` varchar(10) default NULL,
  `title` varchar(255) default NULL,
  `subtitle` varchar(255) default NULL,
  `content` text,
  `image` varchar(255) default NULL,
  `type` char(1) NOT NULL default '',
  `date` varchar(16) NOT NULL default '',
  `last_update` varchar(16) NOT NULL default '',
  `access` varchar(10) NOT NULL default '',
  `autor` varchar(32) NOT NULL default '',
  `sort` int(5) NOT NULL default '0',
  `publish_state` int(1) NOT NULL default '0'
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####knowledgebase`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####knowledgebase_config`
-- 

CREATE TABLE `#####knowledgebase_config` (
  `uid` varchar(13) NOT NULL default '',
  `id` varchar(13) NOT NULL default '',
  `title` varchar(255) default NULL,
  `subtitle` varchar(255) default NULL,
  `text` text,
  `enabled` int(1) NOT NULL default '0',
  `autor_enabled` int(1) NOT NULL default '0',
  `access` varchar(10) NOT NULL default ''
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####knowledgebase_config`
-- 

INSERT INTO `#####knowledgebase_config` (`uid`, `id`, `title`, `subtitle`, `text`, `enabled`, `autor_enabled`, `access`) 
VALUES ('knowledgebase', 'knowledgebase', '', '', '', 1, 0, 'Public');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####links`
-- 

CREATE TABLE `#####links` (
  `uid` varchar(32) NOT NULL default '',
  `type` char(1) NOT NULL default 'l',
  `category` varchar(32) default NULL,
  `sort` int(4) default NULL,
  `name` varchar(255) default NULL,
  `desc` text,
  `link` varchar(255) default NULL,
  `published` int(1) NOT NULL default '0',
  `target` varchar(20) default NULL,
  `rss` varchar(255) default NULL,
  `access` varchar(10) NOT NULL default '',
  `module` int(1) default NULL
) ENGINE=MyISAM ;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####links_config`
-- 

CREATE TABLE `#####links_config` (
  `uid` varchar(17) NOT NULL default '',
  `link_use_side_desc` int(1) default NULL,
  `link_use_side_title` int(1) default NULL,
  `link_side_title` varchar(255) default NULL,
  `link_use_main_desc` int(1) default NULL,
  `link_main_title` varchar(255) default NULL,
  `link_main_subtitle` varchar(255) default NULL,
  `link_main_text` text,
  `link_main_access` varchar(10) default NULL
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####links_config`
-- 

INSERT INTO `#####links_config` (`uid`, `link_use_side_desc`, `link_use_side_title`, `link_side_title`, `link_use_main_desc`, `link_main_title`, `link_main_subtitle`, `link_main_text`, `link_main_access`) 
VALUES ('links_config_side', 0, 1, 'Blogroll', NULL, NULL, NULL, NULL, NULL),
('links_config_main', NULL, NULL, NULL, 1, '', '', '', 'Public');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####news`
-- 

CREATE TABLE `#####news` (
  `uid` varchar(10) NOT NULL default '',
  `language` varchar(25) NOT NULL,
  `title` varchar(255) default NULL,
  `autor` varchar(255) NOT NULL default '',
  `date` varchar(10) NOT NULL default '',
  `time` varchar(5) NOT NULL default '',
  `newstext` text,
  `stamp` double NOT NULL default '0',
  `published` int(1) NOT NULL default '0',
  `publish_date` varchar(16) NOT NULL default '',
  `comments_enabled` int(1) NOT NULL default '1',
  `image` varchar(255) default NULL,
  `access` varchar(10) NOT NULL default '',
  `show_on_frontpage` int(1) NOT NULL,
  PRIMARY KEY  (`uid`)
) ENGINE=MyISAM ;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####news_categories`
-- 

CREATE TABLE `#####news_categories` (
  `uid` varchar(5) NOT NULL default '',
  `name` varchar(255) NOT NULL default '',
  `desc` text
) ENGINE=MyISAM ;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####news_to_categories`
-- 

CREATE TABLE `#####news_to_categories` (
  `uid` varchar(32) NOT NULL default '',
  `news_uid` varchar(10) NOT NULL default '',
  `cat_uid` varchar(5) NOT NULL default ''
) ENGINE=MyISAM ;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####newsletter`
-- 

CREATE TABLE `#####newsletter` (
  `uid` varchar(10) NOT NULL default '',
  `nl_title` varchar(255) NOT NULL default '',
  `nl_show_title` int(1) NOT NULL default '0',
  `nl_text` varchar(255) NOT NULL default '',
  `nl_link` varchar(255) NOT NULL default ''
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####newsletter`
-- 

INSERT INTO `#####newsletter` (`uid`, `nl_title`, `nl_show_title`, `nl_text`, `nl_link`) 
VALUES ('newsletter', '', 1, '', '');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####newsletter_items`
-- 

CREATE TABLE `#####newsletter_items` (
  `uid` varchar(6) NOT NULL default '',
  `user` varchar(255) NOT NULL default '',
  `email` varchar(255) NOT NULL default ''
) ENGINE=MyISAM ;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####newsmanager`
-- 

CREATE TABLE `#####newsmanager` (
  `uid` varchar(11) character set latin1 collate latin1_german1_ci NOT NULL,
  `news_id` varchar(11) character set latin1 collate latin1_german1_ci NOT NULL,
  `news_title` varchar(255) default NULL,
  `news_stamp` varchar(255) default NULL,
  `news_text` text NOT NULL,
  `news_image` varchar(255) default NULL,
  `use_comments` int(1) NOT NULL default '0',
  `show_autor` int(1) NOT NULL default '0',
  `show_autor_as_link` int(1) NOT NULL default '0',
  `news_amount` int(5) NOT NULL default '0',
  `access` varchar(10) NOT NULL default '',
  `news_cut` int(5) NOT NULL default '0',
  `use_gravatar` int(1) NOT NULL default '0',
  `use_emoticons` int(1) NOT NULL default '0',
  `use_rss091` int(1) default NULL,
  `use_rss10` int(1) default NULL,
  `use_rss20` int(1) default NULL,
  `use_atom03` int(1) default NULL,
  `use_opml` int(1) default NULL,
  `syn_amount` int(1) default NULL,
  `use_syn_title` int(1) default NULL,
  `def_feed` varchar(7) default NULL,
  `use_trackback` int(11) default NULL,
  `use_timesince` int(1) NOT NULL default '0',
  `readmore_link` int(1) NOT NULL default '0',
  `news_spacing` int(2) NOT NULL default '0',
  `language` varchar(25) NOT NULL,
  PRIMARY KEY  (`uid`)
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####newsmanager`
-- 

INSERT INTO `#####newsmanager` (`uid`, `news_id`, `news_title`, `news_stamp`, `news_text`, `news_image`, `use_comments`, `show_autor`, `show_autor_as_link`, `news_amount`, `access`, `news_cut`, `use_gravatar`, `use_emoticons`, `use_rss091`, `use_rss10`, `use_rss20`, `use_atom03`, `use_opml`, `syn_amount`, `use_syn_title`, `def_feed`, `use_trackback`, `use_timesince`, `readmore_link`, `news_spacing`, `language`) 
VALUES ('newsmanager', 'newsmanager', '', '', '', '', 1, 1, 1, 20, 'Public', 0, 0, 1, 1, 1, 1, 1, 1, 5, 0, 'RSS2.0', 0, 2, 0, 0, 'english_EN'),
('45789hgtzu', 'newsmanager', '', '', '', '', 1, 1, 1, 20, 'Public', 0, 0, 1, 1, 1, 1, 1, 1, 5, 0, 'RSS2.0', 0, 2, 0, 0, 'germany_DE');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####notepad`
-- 

CREATE TABLE `#####notepad` (
  `uid` varchar(32) NOT NULL default '',
  `name` varchar(200) NOT NULL default '',
  `note` text,
  PRIMARY KEY  (`uid`)
) ENGINE=MyISAM ;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####poll_config`
-- 

CREATE TABLE `#####poll_config` (
  `uid` varchar(4) NOT NULL default '',
  `poll_title` varchar(30) default NULL,
  `allpoll_title` varchar(30) default NULL,
  `show_poll_title` int(1) NOT NULL default '0',
  `poll_side_width` int(3) NOT NULL default '0',
  `poll_main_width` int(3) NOT NULL default '0',
  `poll_sm_title` varchar(30) default NULL,
  `use_poll_sidemenu` int(1) NOT NULL default '0',
  `poll_sidemenu_id` int(2) NOT NULL default '0',
  `poll_tm_title` varchar(30) default NULL,
  `use_poll_topmenu` int(1) NOT NULL default '0',
  `poll_topmenu_id` int(2) NOT NULL default '0'
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####poll_config`
-- 

INSERT INTO `#####poll_config` (`uid`, `poll_title`, `allpoll_title`, `show_poll_title`, `poll_side_width`, `poll_main_width`, `poll_sm_title`, `use_poll_sidemenu`, `poll_sidemenu_id`, `poll_tm_title`, `use_poll_topmenu`, `poll_topmenu_id`) 
VALUES ('poll', 'Poll', '', 1, 110, 500, 'Poll', 0, 2, 'Poll', 0, 4);

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####poll_items`
-- 

CREATE TABLE `#####poll_items` (
  `uid` varchar(8) NOT NULL default '',
  `poll_uid` varchar(32) NOT NULL default '',
  `ip` varchar(15) NOT NULL default '',
  `domain` varchar(255) NOT NULL default '',
  `answer` int(1) NOT NULL default '0'
) ENGINE=MyISAM ;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####polls`
-- 

CREATE TABLE `#####polls` (
  `uid` varchar(32) NOT NULL default '',
  `title` varchar(255) NOT NULL default '',
  `question1` varchar(255) default NULL,
  `question2` varchar(255) default NULL,
  `question3` varchar(255) default NULL,
  `question4` varchar(255) default NULL,
  `question5` varchar(255) default NULL,
  `question6` varchar(255) default NULL,
  `question7` varchar(255) default NULL,
  `question8` varchar(255) default NULL,
  `question9` varchar(255) default NULL,
  `question10` varchar(255) default NULL,
  `question11` varchar(255) default NULL,
  `question12` varchar(255) default NULL
) ENGINE=MyISAM ;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####products`
-- 

CREATE TABLE `#####products` (
  `uid` varchar(32) NOT NULL default '',
  `name` varchar(255) NOT NULL default '',
  `product_number` varchar(255) default NULL,
  `factory` varchar(255) default NULL,
  `factory_url` varchar(255) default NULL,
  `desc` text,
  `category` varchar(255) NOT NULL default '',
  `image` varchar(255) default NULL,
  `date` varchar(16) NOT NULL default '',
  `price` varchar(50) default NULL,
  `price_tax` varchar(50) default NULL,
  `status` int(1) NOT NULL default '0',
  `quantity` int(10) default NULL,
  `weight` varchar(50) default NULL,
  `sort` int(5) NOT NULL default '0',
  `access` varchar(10) default NULL,
  `sql_type` char(1) NOT NULL default ''
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####products`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####products_config`
-- 

CREATE TABLE `#####products_config` (
  `uid` varchar(8) NOT NULL default '',
  `products_id` varchar(8) NOT NULL default '',
  `products_title` varchar(255) NOT NULL default '',
  `products_stamp` varchar(255) NOT NULL default '',
  `products_text` text NOT NULL,
  `category_state` varchar(255) NOT NULL default '',
  `category_title` varchar(255) NOT NULL default '',
  `use_category_title` int(1) NOT NULL default '0'
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####products_config`
-- 

INSERT INTO `#####products_config` (`uid`, `products_id`, `products_title`, `products_stamp`, `products_text`, `category_state`, `category_title`, `use_category_title`) 
VALUES ('products', 'products', '', '', '', '', '', 1);

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####session`
-- 

CREATE TABLE `#####session` (
  `uid` varchar(32) NOT NULL default '',
  `date` varchar(20) NOT NULL default '',
  `user` varchar(255) NOT NULL default '',
  `user_id` varchar(32) NOT NULL default ''
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####session`
-- 

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####sidebar`
-- 

CREATE TABLE `#####sidebar` (
  `uid` varchar(32) NOT NULL default '',
  `title` varchar(255) default NULL,
  `key` varchar(255) default NULL,
  `content` text,
  `foot` varchar(255) default NULL,
  `id` varchar(255) NOT NULL default ''
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####sidebar`
-- 

INSERT INTO `#####sidebar` (`uid`, `title`, `key`, `content`, `foot`, `id`) 
VALUES ('frontpage', '', '', '', '', 'frontpage');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####sidebar_extensions`
-- 

CREATE TABLE `#####sidebar_extensions` (
  `uid` varchar(18) NOT NULL default '',
  `sidemenu_title` varchar(255) default NULL,
  `sidemenu` int(1) NOT NULL default '0',
  `sidebar_title` varchar(255) default NULL,
  `show_sidebar_title` int(1) NOT NULL default '0',
  `chooser_title` varchar(255) default NULL,
  `show_chooser_title` int(1) NOT NULL default '0',
  `search_title` varchar(255) default NULL,
  `show_search_title` int(1) NOT NULL default '0',
  `search_alignment` varchar(10) default NULL,
  `search_withbr` int(1) NOT NULL default '0',
  `search_withbutton` int(1) default NULL,
  `search_word` varchar(255) default NULL,
  `login_title` varchar(255) default NULL,
  `usermenu_title` varchar(255) default NULL,
  `nologin` varchar(255) default NULL,
  `reg_link` varchar(255) default NULL,
  `reg_user` varchar(255) default NULL,
  `reg_pass` varchar(255) default NULL,
  `login_user` int(1) NOT NULL default '0',
  `usermenu` int(1) NOT NULL default '0',
  `show_login_title` int(1) NOT NULL default '0',
  `show_news_cat_amount` int(1) default '0',
  `show_memberlist` int(11) NOT NULL default '0',
  `lang` varchar(255) NOT NULL
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####sidebar_extensions`
-- 

INSERT INTO `#####sidebar_extensions` (`uid`, `sidemenu_title`, `sidemenu`, `sidebar_title`, `show_sidebar_title`, `chooser_title`, `show_chooser_title`, `search_title`, `show_search_title`, `search_alignment`, `search_withbr`, `search_withbutton`, `search_word`, `login_title`, `usermenu_title`, `nologin`, `reg_link`, `reg_user`, `reg_pass`, `login_user`, `usermenu`, `show_login_title`, `show_news_cat_amount`, `show_memberlist`, `lang`) 
VALUES ('sidebar_extensions', '', 0, '', 0, '', 1, 'Search website', 0, 'left', 0, 0, '', 'Login', 'Usermenu', 'No account yet?', 'Create one', 'Username', 'Password', 1, 1, 1, 1, 1, 'de;en;nl;');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####sidemenu`
-- 

CREATE TABLE `#####sidemenu` (
  `uid` varchar(5) character set utf8 collate utf8_unicode_ci NOT NULL,
  `language` varchar(25) NOT NULL,
  `name` varchar(255) character set utf8 collate utf8_unicode_ci default NULL,
  `id` int(3) NOT NULL default '0',
  `subid` char(3) character set utf8 collate utf8_unicode_ci NOT NULL,
  `root` varchar(5) default '-',
  `parent` varchar(5) character set utf8 collate utf8_unicode_ci NOT NULL,
  `parent_lvl1` varchar(5) default '-',
  `parent_lvl2` varchar(5) default '-',
  `parent_lvl3` varchar(5) default '-',
  `type` varchar(10) character set utf8 collate utf8_unicode_ci NOT NULL,
  `link` varchar(255) character set utf8 collate utf8_unicode_ci default NULL,
  `published` int(1) NOT NULL default '0',
  `access` varchar(10) character set utf8 collate utf8_unicode_ci NOT NULL,
  `target` varchar(20) default NULL
) ENGINE=MyISAM ;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####statistics`
-- 

CREATE TABLE `#####statistics` (
  `host` varchar(255) NOT NULL default '',
  `site_url` varchar(255) NOT NULL default '',
  `value` int(10) default '0',
  `ip_uid` varchar(32) default NULL,
  `referrer` varchar(255) default NULL,
  `timestamp` datetime default NULL
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####statistics`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####statistics_ip`
-- 

CREATE TABLE `#####statistics_ip` (
  `uid` varchar(32) NOT NULL default '',
  `ip` varchar(15) NOT NULL default '',
  `value` int(10) default NULL
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####statistics_ip`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####statistics_os`
-- 

CREATE TABLE `#####statistics_os` (
  `uid` varchar(32) NOT NULL default '',
  `browser` varchar(255) default NULL,
  `os` varchar(255) default NULL,
  `value` int(10) default NULL
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####statistics_os`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####topmenu`
-- 

CREATE TABLE `#####topmenu` (
  `uid` varchar(5) NOT NULL,
  `language` varchar(25) NOT NULL,
  `name` varchar(255) default NULL,
  `id` int(4) NOT NULL default '0',
  `type` varchar(10) default NULL,
  `link` varchar(255) default NULL,
  `published` int(1) NOT NULL default '0',
  `access` varchar(10) NOT NULL default '',
  `target` varchar(20) default NULL
) ENGINE=MyISAM ;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####user`
-- 

CREATE TABLE `#####user` (
  `uid` varchar(32) NOT NULL default '',
  `name` varchar(255) NOT NULL default '',
  `username` varchar(255) NOT NULL default '',
  `password` varchar(32) NOT NULL default '',
  `email` varchar(255) NOT NULL default '',
  `group` varchar(32) NOT NULL,
  `join_date` varchar(19) NOT NULL default '',
  `last_login` varchar(19) default NULL,
  `birthday` varchar(10) default NULL,
  `gender` varchar(5) NOT NULL default '',
  `occupation` varchar(255) default NULL,
  `homepage` varchar(255) default NULL,
  `icq` varchar(20) default NULL,
  `aim` varchar(20) default NULL,
  `yim` varchar(20) default NULL,
  `msn` varchar(20) default NULL,
  `skype` varchar(100) default '',
  `enabled` int(1) NOT NULL default '0',
  `tcms_enabled` int(1) NOT NULL default '0',
  `static_value` int(1) NOT NULL default '0',
  `signature` text,
  `location` varchar(255) default NULL,
  `hobby` varchar(255) default NULL
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####user`
-- 
-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####usergroup`
-- 

CREATE TABLE `#####usergroup` (
  `uid` varchar(32) collate utf8_unicode_ci NOT NULL,
  `name` varchar(25) collate utf8_unicode_ci NOT NULL,
  `right` int(1) NOT NULL
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####usergroup`
-- 

INSERT INTO `#####usergroup` (`uid`, `name`, `right`) VALUES ('418aed8f001f0b88e36bc68013000794', 'Editor', 3),
('7f2a4a04ddeffc7caa029e289be712a1', 'Writer', 2),
('daf91e6be506252b897977537fa488c8', 'Developer', 0),
('8a318ecd72b639ceca72c87dbc6f241c', 'Administrator', 1),
('fcc0abe286b322744765b271c8ede1fd', 'Presenter', 4),
('c4e1aea1d163b0d3b3db90b667a2ba81', 'User', 5);

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####userpage`
-- 

CREATE TABLE `#####userpage` (
  `uid` varchar(8) collate utf8_unicode_ci NOT NULL default '',
  `text_width` varchar(5) collate utf8_unicode_ci default NULL,
  `input_width` varchar(5) collate utf8_unicode_ci default NULL,
  `news_publish` int(1) NOT NULL default '0',
  `image_publish` int(1) NOT NULL default '0',
  `album_publish` int(1) NOT NULL default '0',
  `cat_publish` int(1) NOT NULL default '0',
  `pic_publish` char(1) collate utf8_unicode_ci default NULL
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####userpage`
-- 

INSERT INTO `#####userpage` (`uid`, `text_width`, `input_width`, `news_publish`, `image_publish`, `album_publish`, `cat_publish`, `pic_publish`) 
VALUES ('userpage', '150', '150', 0, 0, 0, 0, '0');
