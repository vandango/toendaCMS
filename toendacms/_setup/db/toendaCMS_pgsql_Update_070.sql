CREATE TABLE "public"."#####knowledgebase" (
"uid" VARCHAR( 10 ) NOT NULL ,
"category" VARCHAR( 10 ) ,
"parent" VARCHAR( 10 ) ,
"title" VARCHAR( 255 ) ,
"subtitle" VARCHAR( 255 ) ,
"content" TEXT,
"image" VARCHAR( 255 ) ,
"type" CHAR( 1 ) NOT NULL ,
"date" VARCHAR( 16 ) NOT NULL ,
"last_update" VARCHAR( 16 ) NOT NULL ,
"access" VARCHAR( 10 ) NOT NULL ,
"autor" VARCHAR( 255  ) NOT NULL ,
"sort" INTEGER NOT NULL ,
"publish_state" INTEGER NOT NULL
) WITH OIDS;

CREATE TABLE "public"."#####knowledgebase_config" (
"uid" VARCHAR( 13 ) NOT NULL ,
"id" VARCHAR( 13 ) NOT NULL ,
"title" VARCHAR( 255 ) NULL ,
"subtitle" VARCHAR( 255 ) NULL ,
"text" TEXT NULL ,
"enabled" INTEGER  ,
"autor_enabled" INTEGER ,
"access" VARCHAR( 10 ) NOT NULL
) WITH OIDS;

INSERT INTO "public"."#####knowledgebase_config" ( "uid" , "id" , "title" , "subtitle" , "text" , "enabled" , "autor_enabled" , "access" )
VALUES (
'knowledgebase', 'knowledgebase', 'FAQs and Articles', 'A small knowledge database', 'Here you will find an example set of FAQs and Articles.', 1, 1, 'Public'
);

ALTER TABLE "public"."#####frontpage" ADD "sb_news_title" VARCHAR( 255 )  ,
ADD "sb_news_amount" INTEGER  ,
ADD "sb_news_chars" INTEGER  ;

ALTER TABLE "public"."#####frontpage" ADD "sb_news_enabled" INTEGER   ;
ALTER TABLE "public"."#####frontpage" ADD "sb_news_display" INTEGER   ;
ALTER TABLE "public"."#####user" ADD "last_login" VARCHAR( 19 ) ;
ALTER TABLE "public"."#####newsmanager" ADD "use_timesince" INTEGER ;
ALTER TABLE "public"."#####newsmanager" ADD "use_trackback" INTEGER ;
ALTER TABLE "public"."#####contactform" ADD "use_adressbook" INTEGER  ;
ALTER TABLE "public"."#####contactform" ADD "use_contact" INTEGER ;
ALTER TABLE "public"."#####newsmanager" DROP COLUMN "use_feeds";
ALTER TABLE "public"."#####imagegallery_config" ADD COLUMN "image_sort" VARCHAR(4);
ALTER TABLE "public"."#####sidebar_extensions" ADD COLUMN "show_memberlist" INTEGER;
ALTER TABLE "public"."#####news_categories" ALTER COLUMN "uid" TYPE VARCHAR(10);
ALTER TABLE "public"."#####downloads" ADD COLUMN "parent" VARCHAR(10);
ALTER TABLE "public"."#####downloads" ADD COLUMN "mirror" INTEGER;
ALTER TABLE "public"."#####downloads" ALTER COLUMN "uid" TYPE VARCHAR(10);
ALTER TABLE "public"."#####downloads" ALTER COLUMN "cat" TYPE VARCHAR(10);
ALTER TABLE "public"."#####downloads" DROP COLUMN "folder";
ALTER TABLE "public"."#####user" ADD COLUMN "skype" varchar(100);
ALTER TABLE "public"."#####contactform" ADD "show_contactemail" INT DEFAULT '0' NOT NULL ;

CREATE TABLE "public"."#####usergroup" (
"uid" VARCHAR( 32 ) NOT NULL ,
"name" VARCHAR( 25 ) NOT NULL ,
"right" INT NOT NULL
);

INSERT INTO "public"."#####usergroup" ( "uid" , "name" , "right" )
VALUES ( 'daf91e6be506252b897977537fa488c8', 'Developer', '0');

INSERT INTO "public"."#####usergroup" ( "uid" , "name" , "right" )
VALUES ( '8a318ecd72b639ceca72c87dbc6f241c', 'Administrator', '1' );

INSERT INTO "public"."#####usergroup" ( "uid" , "name" , "right" )
VALUES ( '7f2a4a04ddeffc7caa029e289be712a1', 'Writer', '2');

INSERT INTO "public"."#####usergroup" ( "uid" , "name" , "right" )
VALUES ( '418aed8f001f0b88e36bc68013000794', 'Editor', '3' );

INSERT INTO "public"."#####usergroup" ( "uid" , "name" , "right" )
VALUES ( 'fcc0abe286b322744765b271c8ede1fd', 'Presenter', '4' );

INSERT INTO "public"."#####usergroup" ( "uid" , "name" , "right" )
VALUES ( 'c4e1aea1d163b0d3b3db90b667a2ba81', 'User', '5' );

ALTER TABLE "public"."#####user" ALTER COLUMN "group" TYPE VARCHAR(32);
ALTER TABLE "public"."#####contactform" ADD COLUMN "contacttext" TEXT;
ALTER TABLE "public"."#####newsmanager" ADD COLUMN "news_text" TEXT;
ALTER TABLE "public"."#####newsmanager" ADD COLUMN "readmore_link" INTEGER;
ALTER TABLE "public"."#####newsmanager" ALTER COLUMN "readmore_link" SET DEFAULT 0;
ALTER TABLE "public"."#####newsmanager" ADD COLUMN "news_spacing" INTEGER;
ALTER TABLE "public"."#####newsmanager" ADD COLUMN "news_spacing" INTEGER;
ALTER TABLE "public"."#####frontpage" ADD COLUMN "language" VARCHAR(25);
ALTER TABLE "public"."#####newsmanager" ADD COLUMN "language" VARCHAR(25);
ALTER TABLE "public"."#####impressum" ADD COLUMN "language" VARCHAR(25);
ALTER TABLE "public"."#####contactform" ADD COLUMN "language" VARCHAR(25);
ALTER TABLE "public"."#####news" ADD COLUMN "language" VARCHAR(25);
ALTER TABLE "public"."#####topmenu" ADD COLUMN "language" VARCHAR(25);
ALTER TABLE "public"."#####sidemenu" ADD COLUMN "language" VARCHAR(25);

