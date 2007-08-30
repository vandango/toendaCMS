
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
