
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

