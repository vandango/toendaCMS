ALTER TABLE "public"."#####contactform"
  ADD COLUMN "contacttext" TEXT;

ALTER TABLE "public"."#####newsmanager"
  ADD COLUMN "news_text" TEXT;

ALTER TABLE "public"."#####newsmanager"
  ADD COLUMN "readmore_link" INTEGER;

ALTER TABLE "public"."#####newsmanager"
  ALTER COLUMN "readmore_link" SET DEFAULT 0;

ALTER TABLE "public"."#####newsmanager"
  ADD COLUMN "news_spacing" INTEGER;

ALTER TABLE "public"."#####newsmanager"
  ALTER COLUMN "news_spacing" SET DEFAULT 0;
