

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

