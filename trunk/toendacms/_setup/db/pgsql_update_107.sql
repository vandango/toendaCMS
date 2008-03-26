
ALTER TABLE "public"."#####sidemenu" ADD COLUMN "target" VARCHAR(20);
ALTER TABLE "public"."#####topmenu" ADD COLUMN "target" VARCHAR(20);
ALTER TABLE "public"."#####content" ADD COLUMN "language" VARCHAR(25);
ALTER TABLE "public"."#####newsmanager" ADD COLUMN "readmore_link" INTEGER;
ALTER TABLE "public"."#####newsmanager" ALTER COLUMN "readmore_link" SET DEFAULT 0;
ALTER TABLE "public"."#####newsmanager" ADD COLUMN "news_text" TEXT;
ALTER TABLE "public"."#####contactform" ADD COLUMN "contacttext" TEXT;
ALTER TABLE "public"."#####sidebar_extensions" ADD COLUMN "lang" VARCHAR(255);

ALTER TABLE "public"."#####news" ADD COLUMN "show_on_frontpage" INTEGER;
UPDATE "public"."#####news" SET "show_on_frontpage" = 1;

CREATE TABLE "public"."#####content_languages" (
  "uid" VARCHAR(5) NOT NULL, 
  "content_uid" VARCHAR(5), 
  "language" VARCHAR(25), 
  "title" VARCHAR(255), 
  "key" VARCHAR(255), 
  "content00" TEXT, 
  "content01" TEXT, 
  "foot" VARCHAR(255), 
  "autor" VARCHAR(255), 
  "db_layout" VARCHAR(50), 
  "access" VARCHAR(10), 
  "in_work" INTEGER DEFAULT 0, 
  "published" INTEGER DEFAULT 0, 
  PRIMARY KEY("uid")
) WITH OIDS;


ALTER TABLE "public"."#####newsmanager" ADD COLUMN "news_spacing" INTEGER;
ALTER TABLE "public"."#####frontpage" ADD COLUMN "language" VARCHAR(25);
ALTER TABLE "public"."#####newsmanager" ADD COLUMN "language" VARCHAR(25);
ALTER TABLE "public"."#####impressum" ADD COLUMN "language" VARCHAR(25);
ALTER TABLE "public"."#####contactform" ADD COLUMN "language" VARCHAR(25);
ALTER TABLE "public"."#####news" ADD COLUMN "language" VARCHAR(25);
ALTER TABLE "public"."#####topmenu" ADD COLUMN "language" VARCHAR(25);
ALTER TABLE "public"."#####sidemenu" ADD COLUMN "language" VARCHAR(25);

ALTER TABLE "public"."#####products_config" ADD COLUMN "language" VARCHAR( 25 );
ALTER TABLE "public"."#####products_config" ADD COLUMN "show_price_only_users" INTEGER;
ALTER TABLE "public"."#####products_config" ADD COLUMN "startpagetitle" VARCHAR( 255 );

ALTER TABLE "public"."#####products" CHANGE COLUMN "image" "image1" VARCHAR( 255 );
ALTER TABLE "public"."#####products" ADD COLUMN "image2" VARCHAR( 255 ) ,
ADD COLUMN "image3" VARCHAR( 255 ),
ADD COLUMN "image4" VARCHAR( 255 ),
ADD COLUMN "show_on_startpage" INTEGER ,
ADD COLUMN "pub" INTEGER,
ADD COLUMN "parent" VARCHAR( 32 );

ALTER TABLE "public"."#####products" CHANGE COLUMN "category" "category" VARCHAR( 32 );
ALTER TABLE "public"."#####products" CHANGE COLUMN "category" "category" VARCHAR( 32 );
ALTER TABLE "public"."#####products" ADD COLUMN "language" VARCHAR( 25 );
ALTER TABLE "public"."#####products_config" ADD COLUMN "use_sidebar_categories" INTEGER;
ALTER TABLE "public"."#####products_config" ADD COLUMN "max_latest_products" INTEGER;

ALTER TABLE "public"."#####newsmanager" ADD COLUMN "use_rss091_img" INTEGER;
ALTER TABLE "public"."#####newsmanager" ADD COLUMN "rss091_text" VARCHAR( 255 );
ALTER TABLE "public"."#####newsmanager" ADD COLUMN "use_rss10_img" INTEGER;
ALTER TABLE "public"."#####newsmanager" ADD COLUMN "rss10_text" VARCHAR( 255 );
ALTER TABLE "public"."#####newsmanager" ADD COLUMN "use_rss20_img" INTEGER;
ALTER TABLE "public"."#####newsmanager" ADD COLUMN "rss20_feed" VARCHAR( 255 );
ALTER TABLE "public"."#####newsmanager" ADD COLUMN "use_atom03_img" INTEGER;
ALTER TABLE "public"."#####newsmanager" ADD COLUMN "atom03_text" VARCHAR( 255 );
ALTER TABLE "public"."#####newsmanager" ADD COLUMN "use_opml_img" INTEGER;
ALTER TABLE "public"."#####newsmanager" ADD COLUMN "opml_text" VARCHAR( 255 );
ALTER TABLE "public"."#####newsmanager" ADD COLUMN "use_comment_feed" INTEGER;
ALTER TABLE "public"."#####newsmanager" ADD COLUMN "comment_feed_text" VARCHAR( 255 );
ALTER TABLE "public"."#####newsmanager" ADD COLUMN "comment_feed_type" VARCHAR( 7 );
ALTER TABLE "public"."#####newsmanager" ADD COLUMN "use_comment_feed_img" INTEGER;
ALTER TABLE "public"."#####newsmanager" ADD COLUMN "comments_feed_amount" INTEGER;




ALTER TABLE `#####imagegallery_config` ADD `list_option_amount` INTEGER NOT NULL DEFAULT '4';

ALTER TABLE `#####guestbook` ADD `text` TEXT NULL ,
ADD `language` VARCHAR( 25 ) NOT NULL DEFAULT 'english_EN';

ALTER TABLE "public"."#####impressum" RENAME TO "#####imprint";





CREATE TABLE "public"."#####log" (
"uid" VARCHAR( 32 ) NOT NULL ,
"user_uid" VARCHAR( 32 ) NULL ,
"stamp" INTEGER NOT NULL,
"ip" VARCHAR( 40 ) NULL ,
"module" VARCHAR( 40 ) NULL ,
"text" TEXT NULL, 
PRIMARY KEY("uid")
) WITH OIDS;

