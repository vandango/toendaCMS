
ALTER TABLE "#####user" ADD COLUMN "skype" varchar(100);


ALTER TABLE "#####sidemenu" ADD COLUMN "parent_lvl2" VARCHAR(5) DEFAULT '-';
ALTER TABLE "#####sidemenu" ADD COLUMN "parent_lvl3" VARCHAR(5) DEFAULT '-';

ALTER TABLE "#####sidemenu" ADD COLUMN "root" VARCHAR( 5 ) DEFAULT '-'  ;

ALTER TABLE "#####sidemenu" ADD COLUMN "parent_lvl1" VARCHAR( 5 ) DEFAULT '-'  ;

ALTER TABLE "#####contactform" ADD "show_contactemail" INT DEFAULT '0' NOT NULL ;

CREATE TABLE "#####usergroup" (
"uid" VARCHAR( 32 ) NOT NULL ,
"name" VARCHAR( 25 ) NOT NULL ,
"right" INT NOT NULL
);



INSERT INTO "#####usergroup" ( "uid" , "name" , "right" )
VALUES ( 'daf91e6be506252b897977537fa488c8', 'Developer', '0');

INSERT INTO "#####usergroup" ( "uid" , "name" , "right" )
VALUES ( '8a318ecd72b639ceca72c87dbc6f241c', 'Administrator', '1' );

INSERT INTO "#####usergroup" ( "uid" , "name" , "right" )
VALUES ( '7f2a4a04ddeffc7caa029e289be712a1', 'Writer', '2');

INSERT INTO "#####usergroup" ( "uid" , "name" , "right" )
VALUES ( '418aed8f001f0b88e36bc68013000794', 'Editor', '3' );

INSERT INTO "#####usergroup" ( "uid" , "name" , "right" )
VALUES ( 'fcc0abe286b322744765b271c8ede1fd', 'Presenter', '4' );

INSERT INTO "#####usergroup" ( "uid" , "name" , "right" )
VALUES ( 'c4e1aea1d163b0d3b3db90b667a2ba81', 'User', '5' );

ALTER TABLE "public"."tcms_user"
  ALTER COLUMN "group" TYPE VARCHAR(32);

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
