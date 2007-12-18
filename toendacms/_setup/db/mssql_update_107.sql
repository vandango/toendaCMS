
ALTER TABLE [#####sidemenu] ADD [target] VARCHAR( 20 ) NULL DEFAULT '';
ALTER TABLE [#####topmenu] ADD [target] VARCHAR( 20 ) NULL DEFAULT '';
ALTER TABLE [#####content] ADD [language] VARCHAR( 25 ) NULL ;

CREATE TABLE [#####content_languages] (
	[uid] VARCHAR( 5 ) NOT NULL ,
	[content_uid] VARCHAR( 5 ) NOT NULL ,
	[language] VARCHAR( 25 ) NOT NULL ,
	[title] VARCHAR( 255 ) NULL ,
	[key] VARCHAR( 255 ) NULL ,
	[content00] TEXT NULL ,
	[content01] TEXT NULL ,
	[foot] VARCHAR( 255 ) NULL ,
	[autor] VARCHAR( 255 ) NULL
) ;


ALTER TABLE [#####content_languages] 
ADD CONSTRAINT pk_#####content_languages PRIMARY KEY ([uid]);

ALTER TABLE [#####content_languages] ADD [db_layout] VARCHAR( 50 ) NOT NULL;
ALTER TABLE [#####content_languages] ADD [access] VARCHAR( 10 ) NOT NULL;
ALTER TABLE [#####content_languages] ADD [in_work] INT NOT NULL DEFAULT '0';
ALTER TABLE [#####content_languages] ADD [published] INT NOT NULL DEFAULT '0';

ALTER TABLE [#####news] ADD [show_on_frontpage] INT NOT NULL DEFAULT 1;
UPDATE [#####news] SET [show_on_frontpage] = 1;

ALTER TABLE [#####sidebar_extensions] ADD [lang] VARCHAR( 255 ) NOT NULL DEFAULT '' ;
ALTER TABLE [#####frontpage] ADD [language] VARCHAR( 25 ) NOT NULL DEFAULT '' ;
ALTER TABLE [#####newsmanager] ADD [language] VARCHAR( 25 ) NOT NULL DEFAULT '';
ALTER TABLE [#####impressum] ADD [language] VARCHAR( 25 ) NOT NULL DEFAULT '' ;
ALTER TABLE [#####contactform] ADD [language] VARCHAR( 25 ) NOT NULL DEFAULT '' ;
ALTER TABLE [#####news] ADD [language] VARCHAR( 25 ) NOT NULL DEFAULT '' ;
ALTER TABLE [#####topmenu] ADD [language] VARCHAR( 25 ) NOT NULL DEFAULT '' ;
ALTER TABLE [#####sidemenu] ADD [language] VARCHAR( 25 ) NOT NULL DEFAULT '' ;



ALTER TABLE [#####products_config] ADD [language] VARCHAR( 25 );
ALTER TABLE [#####products_config] ADD [show_price_only_users] TINYINT NULL;
ALTER TABLE [#####products_config] ADD [startpagetitle] VARCHAR( 255 ) NULL;


EXEC sp_rename '#####products.image', 'image1', 'COLUMN';
ALTER TABLE [#####products] ADD [image2] VARCHAR( 255 ) NULL;
ALTER TABLE [#####products] ADD [image3] VARCHAR( 255 ) NULL;
ALTER TABLE [#####products] ADD [image4] VARCHAR( 255 ) NULL;
ALTER TABLE [#####products] ADD [show_on_startpage] TINYINT NOT NULL DEFAULT '0';
ALTER TABLE [#####products] ADD [pub] TINYINT NOT NULL DEFAULT '0';
ALTER TABLE [#####products] ADD [parent] VARCHAR( 32 ) NULL;


ALTER TABLE [#####products] ALTER COLUMN [category] VARCHAR( 32 ) NULL;
ALTER TABLE [#####products] ADD [language] VARCHAR( 25 ) NOT NULL DEFAULT 'english_EN';
ALTER TABLE [#####products_config] ADD [use_sidebar_categories] TINYINT NOT NULL DEFAULT '1';
ALTER TABLE [#####products_config] ADD [max_latest_products] INT NOT NULL DEFAULT '15';


ALTER TABLE [#####newsmanager] ADD [use_rss091_img] TINYINT NOT NULL DEFAULT '1';
ALTER TABLE [#####newsmanager] ADD [rss091_text] VARCHAR( 255 ) NOT NULL DEFAULT '';
ALTER TABLE [#####newsmanager] ADD [use_rss10_img] TINYINT NOT NULL DEFAULT '1';
ALTER TABLE [#####newsmanager] ADD [rss10_text] VARCHAR( 255 ) NOT NULL DEFAULT '';
ALTER TABLE [#####newsmanager] ADD [use_rss20_img] TINYINT NOT NULL DEFAULT '1';
ALTER TABLE [#####newsmanager] ADD [rss20_feed] VARCHAR( 255 ) NOT NULL DEFAULT '';
ALTER TABLE [#####newsmanager] ADD [use_atom03_img] TINYINT NOT NULL DEFAULT '1';
ALTER TABLE [#####newsmanager] ADD [atom03_text] VARCHAR( 255 ) NOT NULL DEFAULT '';
ALTER TABLE [#####newsmanager] ADD [use_opml_img] TINYINT NOT NULL DEFAULT '1';
ALTER TABLE [#####newsmanager] ADD [opml_text] VARCHAR( 255 ) NOT NULL DEFAULT '';
ALTER TABLE [#####newsmanager] ADD [use_comment_feed] TINYINT NOT NULL DEFAULT '1';
ALTER TABLE [#####newsmanager] ADD [comment_feed_text] VARCHAR( 255 ) NULL DEFAULT '';
ALTER TABLE [#####newsmanager] ADD [comment_feed_type] VARCHAR( 7 ) NULL DEFAULT '';
ALTER TABLE [#####newsmanager] ADD [use_comment_feed_img] TINYINT NOT NULL DEFAULT '0';
ALTER TABLE [#####newsmanager] ADD [comments_feed_amount] INT NOT NULL DEFAULT '5';
