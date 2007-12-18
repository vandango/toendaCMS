
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
