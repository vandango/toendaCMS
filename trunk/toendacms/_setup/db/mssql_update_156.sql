
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

