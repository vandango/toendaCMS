-- SQL Manager 2007 for PostgreSQL 4.3.0.4
-- ---------------------------------------
-- Host      : localhost
-- Database  : tcms_blog
-- Version   : PostgreSQL 8.2.5 on i686-pc-mingw32, compiled by GCC gcc.exe (GCC) 3.4.2 (mingw-special)


--
-- Definition for language plpgsql (OID = 16386) : 
--
CREATE TRUSTED PROCEDURAL LANGUAGE plpgsql
   HANDLER "plpgsql_call_handler"
;
SET check_function_bodies = false;
--
-- Structure for table #####albums (OID = 16405) : 
--
SET search_path = public, pg_catalog;
CREATE TABLE public.#####albums (
    uid varchar(12) NOT NULL,
    title varchar(255),
    album_id varchar(6),
    published integer DEFAULT 0 NOT NULL,
    image varchar(255),
    "desc" text
) WITHOUT OIDS;
--
-- Structure for table #####contactform (OID = 16413) : 
--
CREATE TABLE public.#####contactform (
    uid varchar(11) DEFAULT ''::character varying NOT NULL,
    contact varchar(255) DEFAULT ''::character varying NOT NULL,
    show_contacts_in_sidebar integer DEFAULT 0 NOT NULL,
    send_id varchar(11) DEFAULT ''::character varying NOT NULL,
    contacttitle varchar(255) DEFAULT ''::character varying NOT NULL,
    contactstamp varchar(255) DEFAULT ''::character varying NOT NULL,
    "access" varchar(10) DEFAULT ''::character varying NOT NULL,
    enabled integer,
    use_adressbook integer,
    use_contact integer,
    show_contactemail integer DEFAULT 0 NOT NULL,
    contacttext text,
    "language" varchar(25)
) WITHOUT OIDS;
--
-- Structure for table #####contacts (OID = 16426) : 
--
CREATE TABLE public.#####contacts (
    uid varchar(10) DEFAULT ''::character varying NOT NULL,
    default_con integer DEFAULT 0 NOT NULL,
    published integer DEFAULT 0 NOT NULL,
    name varchar(255) DEFAULT ''::character varying NOT NULL,
    "position" varchar(255),
    email varchar(255) DEFAULT ''::character varying NOT NULL,
    street varchar(255),
    country varchar(255),
    state varchar(255),
    town varchar(255),
    postal integer,
    phone varchar(40),
    fax varchar(40)
) WITHOUT OIDS;
--
-- Structure for table #####content (OID = 16436) : 
--
CREATE TABLE public.#####content (
    uid varchar(5) DEFAULT ''::character varying NOT NULL,
    title varchar(255),
    "key" varchar(255),
    content00 text,
    content01 text,
    foot varchar(255),
    db_layout varchar(50),
    "access" varchar(10) DEFAULT ''::character varying NOT NULL,
    published integer,
    in_work integer,
    autor varchar(255),
    "language" varchar(25)
) WITHOUT OIDS;
--
-- Structure for table #####downloads (OID = 16443) : 
--
CREATE TABLE public.#####downloads (
    uid varchar(10) DEFAULT ''::character varying NOT NULL,
    name varchar(255),
    date varchar(16) DEFAULT ''::character varying NOT NULL,
    "type" varchar(255) DEFAULT ''::character varying NOT NULL,
    sort integer,
    pub integer,
    "access" varchar(10),
    image varchar(255),
    file varchar(255),
    cat varchar(10),
    sql_type char(1) DEFAULT ''::bpchar NOT NULL,
    "desc" text,
    parent varchar(10),
    mirror integer
) WITHOUT OIDS;
--
-- Structure for table #####downloads_config (OID = 16452) : 
--
CREATE TABLE public.#####downloads_config (
    uid varchar(8) DEFAULT ''::character varying NOT NULL,
    download_id varchar(8) DEFAULT ''::character varying NOT NULL,
    download_title varchar(255),
    download_stamp varchar(255),
    download_text text
) WITHOUT OIDS;
--
-- Structure for table #####frontpage (OID = 16459) : 
--
CREATE TABLE public.#####frontpage (
    uid varchar(9) DEFAULT ''::character varying NOT NULL,
    front_id varchar(9) DEFAULT ''::character varying NOT NULL,
    front_title varchar(255),
    front_stamp varchar(255),
    front_text text,
    news_title varchar(255),
    news_cut integer DEFAULT 0 NOT NULL,
    module_use_0 integer DEFAULT 0 NOT NULL,
    sb_news_title varchar(255),
    sb_news_amount integer,
    sb_news_chars integer,
    sb_news_enabled integer,
    sb_news_display integer,
    "language" varchar(25)
) WITHOUT OIDS;
--
-- Structure for table #####guestbook (OID = 16468) : 
--
CREATE TABLE public.#####guestbook (
    uid varchar(9) DEFAULT ''::character varying NOT NULL,
    guest_id varchar(9) DEFAULT ''::character varying,
    booktitle varchar(255) DEFAULT ''::character varying,
    bookstamp varchar(255) DEFAULT ''::character varying,
    "access" varchar(10) DEFAULT ''::character varying,
    enabled integer,
    clean_link integer DEFAULT 0 NOT NULL,
    clean_script integer DEFAULT 0 NOT NULL,
    convert_at integer DEFAULT 0 NOT NULL,
    show_email integer DEFAULT 0 NOT NULL,
    name_width varchar(4),
    text_width varchar(4),
    color_row_1 varchar(6),
    color_row_2 varchar(6)
) WITHOUT OIDS;
--
-- Structure for table #####guestbook_items (OID = 16482) : 
--
CREATE TABLE public.#####guestbook_items (
    uid varchar(32) DEFAULT ''::character varying NOT NULL,
    name varchar(255),
    email varchar(255),
    text text,
    date varchar(8),
    "time" varchar(5)
) WITHOUT OIDS;
--
-- Structure for table #####imagegallery (OID = 16488) : 
--
CREATE TABLE public.#####imagegallery (
    uid varchar(10) DEFAULT ''::character varying NOT NULL,
    album varchar(6) DEFAULT ''::character varying NOT NULL,
    image varchar(255) DEFAULT ''::character varying NOT NULL,
    text text,
    date varchar(14) DEFAULT ''::character varying NOT NULL
) WITHOUT OIDS;
--
-- Structure for table #####imagegallery_config (OID = 16497) : 
--
CREATE TABLE public.#####imagegallery_config (
    uid varchar(12) DEFAULT ''::character varying NOT NULL,
    image_id varchar(12) DEFAULT ''::character varying NOT NULL,
    image_title varchar(255),
    image_stamp text,
    image_details integer DEFAULT 0 NOT NULL,
    use_comments integer DEFAULT 0 NOT NULL,
    "access" varchar(10) DEFAULT ''::character varying NOT NULL,
    max_image integer,
    needle_image varchar(255),
    show_lastimg integer,
    show_lastimg_title integer,
    align_image varchar(6),
    size_image integer,
    image_sort varchar(4),
    list_option integer
) WITHOUT OIDS;
--
-- Structure for table #####imprint (OID = 16507) : 
--
CREATE TABLE public.#####imprint (
    uid varchar(9) DEFAULT ''::character varying NOT NULL,
    imp_id varchar(9) DEFAULT ''::character varying NOT NULL,
    imp_title varchar(255),
    imp_stamp varchar(255),
    imp_contact varchar(10) DEFAULT ''::character varying NOT NULL,
    taxno varchar(50),
    ustid varchar(50),
    legal text,
    "language" varchar(25)
) WITHOUT OIDS;
--
-- Structure for table #####links_config (OID = 16515) : 
--
CREATE TABLE public.#####links_config (
    uid varchar(17) DEFAULT ''::character varying NOT NULL,
    link_use_side integer DEFAULT 0 NOT NULL,
    link_use_side_desc integer DEFAULT 0 NOT NULL,
    link_use_side_title integer DEFAULT 0 NOT NULL,
    link_side_title varchar(255),
    link_use_main_desc integer,
    link_main_title varchar(255),
    link_main_subtitle varchar(255),
    link_main_text text,
    link_main_access varchar(10)
) WITHOUT OIDS;
--
-- Structure for table #####news (OID = 16524) : 
--
CREATE TABLE public.#####news (
    uid varchar(10) DEFAULT ''::character varying NOT NULL,
    title varchar(255),
    autor varchar(255) DEFAULT ''::character varying NOT NULL,
    date varchar(10) DEFAULT ''::character varying NOT NULL,
    "time" varchar(5) DEFAULT ''::character varying NOT NULL,
    newstext text,
    stamp bigint DEFAULT (0)::bigint NOT NULL,
    published integer DEFAULT 0 NOT NULL,
    publish_date varchar(16) DEFAULT ''::character varying NOT NULL,
    comments_enabled integer DEFAULT 1 NOT NULL,
    image varchar(255),
    category varchar(5) DEFAULT ''::character varying NOT NULL,
    "access" varchar(10) DEFAULT ''::character varying NOT NULL,
    show_on_frontpage integer,
    "language" varchar(25)
) WITHOUT OIDS;
--
-- Structure for table #####comments (OID = 16539) : 
--
CREATE TABLE public.#####comments (
    uid varchar(10) DEFAULT ''::character varying NOT NULL,
    "timestamp" varchar(14) DEFAULT ''::character varying NOT NULL,
    name varchar(255) DEFAULT ''::character varying NOT NULL,
    email varchar(255),
    web varchar(255),
    msg text,
    "time" varchar(14) DEFAULT ''::character varying NOT NULL,
    module varchar(5)
) WITHOUT OIDS;
--
-- Structure for table #####newsletter (OID = 16548) : 
--
CREATE TABLE public.#####newsletter (
    uid varchar(10) DEFAULT ''::character varying NOT NULL,
    use_newsletter integer DEFAULT 0 NOT NULL,
    nl_title varchar(255) DEFAULT ''::character varying NOT NULL,
    nl_show_title integer DEFAULT 0 NOT NULL,
    nl_text varchar(255) DEFAULT ''::character varying NOT NULL,
    nl_link varchar(255) DEFAULT ''::character varying NOT NULL
) WITHOUT OIDS;
--
-- Structure for table #####newsmanager (OID = 16559) : 
--
CREATE TABLE public.#####newsmanager (
    uid varchar(11) DEFAULT ''::character varying NOT NULL,
    news_id varchar(11) DEFAULT ''::character varying NOT NULL,
    news_title varchar(255),
    news_stamp varchar(255),
    news_image varchar(255),
    use_comments integer DEFAULT 0 NOT NULL,
    show_autor integer DEFAULT 0 NOT NULL,
    show_autor_as_link integer DEFAULT 0 NOT NULL,
    news_amount integer DEFAULT 0 NOT NULL,
    "access" varchar(10) DEFAULT ''::character varying NOT NULL,
    news_cut integer DEFAULT 0 NOT NULL,
    use_gravatar integer,
    use_emoticons integer,
    use_rss091 integer,
    use_rss10 integer,
    use_rss20 integer,
    use_atom03 integer,
    use_opml integer,
    syn_amount integer,
    use_syn_title integer,
    def_feed varchar(7),
    use_timesince integer,
    use_trackback integer,
    readmore_link integer DEFAULT 0,
    news_text text,
    news_spacing integer,
    "language" varchar(25),
    use_rss091_img integer,
    rss091_text varchar(255),
    use_rss10_img integer,
    rss10_text varchar(255),
    use_rss20_img integer,
    rss20_feed varchar(255),
    use_atom03_img integer,
    atom03_text varchar(255),
    use_opml_img integer,
    opml_text varchar(255),
    use_comment_feed integer,
    comment_feed_text varchar(255),
    comment_feed_type varchar(7),
    use_comment_feed_img integer,
    comments_feed_amount integer
) WITHOUT OIDS;
--
-- Structure for table #####notepad (OID = 16689) : 
--
CREATE TABLE public.#####notepad (
    uid varchar(32) DEFAULT ''::character varying NOT NULL,
    name varchar(200) DEFAULT ''::character varying NOT NULL,
    note text
) WITHOUT OIDS;
--
-- Structure for table #####poll_config (OID = 16696) : 
--
CREATE TABLE public.#####poll_config (
    uid varchar(4) DEFAULT ''::character varying NOT NULL,
    poll_title varchar(30),
    allpoll_title varchar(30),
    show_poll_title integer DEFAULT 0 NOT NULL,
    use_poll_side integer DEFAULT 0 NOT NULL,
    poll_side_width integer DEFAULT 0 NOT NULL,
    poll_main_width integer DEFAULT 0 NOT NULL,
    poll_sm_title varchar(30),
    use_poll_sidemenu integer DEFAULT 0 NOT NULL,
    poll_sidemenu_id integer DEFAULT 0 NOT NULL,
    poll_tm_title varchar(30),
    use_poll_topmenu integer DEFAULT 0 NOT NULL,
    poll_topmenu_id integer DEFAULT 0 NOT NULL
) WITHOUT OIDS;
--
-- Structure for table #####poll_items (OID = 16707) : 
--
CREATE TABLE public.#####poll_items (
    uid varchar(8) DEFAULT ''::character varying NOT NULL,
    poll_uid varchar(8) DEFAULT ''::character varying NOT NULL,
    ip varchar(15) DEFAULT ''::character varying NOT NULL,
    "domain" varchar(255) DEFAULT ''::character varying NOT NULL,
    answer integer DEFAULT 0 NOT NULL
) WITHOUT OIDS;
--
-- Structure for table #####polls (OID = 16714) : 
--
CREATE TABLE public.#####polls (
    uid varchar(32) DEFAULT ''::character varying NOT NULL,
    title varchar(255) DEFAULT ''::character varying NOT NULL,
    question1 varchar(255),
    question2 varchar(255),
    question3 varchar(255),
    question4 varchar(255),
    question5 varchar(255),
    question6 varchar(255),
    question7 varchar(255),
    question8 varchar(255),
    question9 varchar(255),
    question10 varchar(255),
    question11 varchar(255),
    question12 varchar(255)
) WITHOUT OIDS;
--
-- Structure for table #####products_config (OID = 16721) : 
--
CREATE TABLE public.#####products_config (
    uid varchar(8) DEFAULT ''::character varying NOT NULL,
    products_id varchar(8) DEFAULT ''::character varying NOT NULL,
    products_title varchar(255) DEFAULT ''::character varying NOT NULL,
    products_stamp varchar(255) DEFAULT ''::character varying NOT NULL,
    products_text text NOT NULL,
    category_state varchar(255) DEFAULT ''::character varying NOT NULL,
    category_title varchar(255) DEFAULT ''::character varying NOT NULL,
    use_category_title integer DEFAULT 0 NOT NULL,
    "language" varchar(25),
    show_price_only_users integer,
    startpagetitle varchar(255),
    use_sidebar_categories integer,
    max_latest_products integer
) WITHOUT OIDS;
--
-- Structure for table #####sidebar (OID = 16733) : 
--
CREATE TABLE public.#####sidebar (
    uid varchar(32) DEFAULT ''::character varying NOT NULL,
    title varchar(255),
    "key" varchar(255),
    content text,
    foot varchar(255),
    id varchar(255) DEFAULT ''::character varying NOT NULL
) WITHOUT OIDS;
--
-- Structure for table #####sidebar_extensions (OID = 16740) : 
--
CREATE TABLE public.#####sidebar_extensions (
    uid varchar(18) DEFAULT ''::character varying NOT NULL,
    sidemenu_title varchar(255),
    sidemenu integer DEFAULT 0 NOT NULL,
    sidebar_title varchar(255),
    show_sidebar_title integer DEFAULT 0 NOT NULL,
    sidebar integer DEFAULT 0 NOT NULL,
    chooser_title varchar(255),
    show_chooser_title integer DEFAULT 0 NOT NULL,
    chooser integer DEFAULT 0 NOT NULL,
    search_title varchar(255),
    show_search_title integer DEFAULT 0 NOT NULL,
    search_alignment varchar(10),
    search_withbr integer DEFAULT 0 NOT NULL,
    search integer DEFAULT 0 NOT NULL,
    login_title varchar(255),
    usermenu_title varchar(255),
    login integer DEFAULT 0 NOT NULL,
    nologin varchar(255),
    reg_link varchar(255),
    reg_user varchar(255),
    reg_pass varchar(255),
    login_user integer DEFAULT 0 NOT NULL,
    usermenu integer DEFAULT 0 NOT NULL,
    show_login_title integer DEFAULT 0 NOT NULL,
    show_news_categories integer DEFAULT 0 NOT NULL,
    search_withbutton integer,
    search_word varchar(255),
    show_news_cat_amount integer,
    show_memberlist integer,
    lang varchar(255)
) WITHOUT OIDS;
--
-- Structure for table #####sidemenu (OID = 16759) : 
--
CREATE TABLE public.#####sidemenu (
    uid varchar(5) DEFAULT ''::character varying NOT NULL,
    name varchar(255),
    id integer DEFAULT 0 NOT NULL,
    subid char(3) DEFAULT ''::bpchar NOT NULL,
    parent char(3) DEFAULT ''::bpchar NOT NULL,
    "type" varchar(10) DEFAULT ''::character varying NOT NULL,
    link varchar(255),
    published integer DEFAULT 0 NOT NULL,
    "access" varchar(10) DEFAULT ''::character varying NOT NULL,
    parent_lvl2 varchar(5) DEFAULT '-'::character varying,
    parent_lvl3 varchar(5) DEFAULT '-'::character varying,
    root varchar(5) DEFAULT '-'::character varying,
    parent_lvl1 varchar(5) DEFAULT '-'::character varying,
    target varchar(20),
    "language" varchar(25)
) WITHOUT OIDS;
--
-- Structure for table #####topmenu (OID = 16775) : 
--
CREATE TABLE public.#####topmenu (
    uid varchar(5) DEFAULT ''::character varying NOT NULL,
    name varchar(255),
    id integer DEFAULT 0 NOT NULL,
    link varchar(255),
    published integer DEFAULT 0 NOT NULL,
    "access" varchar(10) DEFAULT ''::character varying NOT NULL,
    "type" varchar(10),
    target varchar(20),
    "language" varchar(25)
) WITHOUT OIDS;
--
-- Structure for table #####userpage (OID = 16784) : 
--
CREATE TABLE public.#####userpage (
    uid varchar(8) DEFAULT ''::character varying NOT NULL,
    text_width varchar(5),
    input_width varchar(5),
    news_publish integer DEFAULT 0 NOT NULL,
    image_publish integer DEFAULT 0 NOT NULL,
    album_publish integer DEFAULT 0 NOT NULL,
    cat_publish integer DEFAULT 0 NOT NULL,
    pic_publish integer
) WITHOUT OIDS;
--
-- Structure for table #####news_categories (OID = 16791) : 
--
CREATE TABLE public.#####news_categories (
    uid varchar(5) DEFAULT ''::character varying NOT NULL,
    name varchar(255) DEFAULT ''::character varying NOT NULL,
    "desc" text
) WITHOUT OIDS;
--
-- Structure for table #####newsletter_items (OID = 16798) : 
--
CREATE TABLE public.#####newsletter_items (
    uid varchar(6) DEFAULT ''::character varying NOT NULL,
    email varchar(255) DEFAULT ''::character varying NOT NULL,
    "user" varchar(255) NOT NULL
) WITHOUT OIDS;
--
-- Structure for table #####products (OID = 16805) : 
--
CREATE TABLE public.#####products (
    uid varchar(32) DEFAULT ''::character varying NOT NULL,
    name varchar(255) DEFAULT ''::character varying NOT NULL,
    product_number varchar(255),
    factory varchar(255),
    factory_url varchar(255),
    category varchar(32) DEFAULT ''::character varying NOT NULL,
    image1 varchar(255),
    image2 varchar(255),
    image3 varchar(255),
    image4 varchar(255),
    date varchar(16) DEFAULT ''::character varying NOT NULL,
    price varchar(50),
    price_tax varchar(50),
    status integer DEFAULT 0 NOT NULL,
    quantity bigint,
    weight varchar(50),
    sort integer DEFAULT 0 NOT NULL,
    "access" varchar(10),
    sql_type char(1) DEFAULT ''::bpchar NOT NULL,
    "desc" text,
    show_on_startpage integer,
    pub integer,
    parent varchar(32),
    "language" varchar(25)
) WITHOUT OIDS;
--
-- Structure for table #####session (OID = 16817) : 
--
CREATE TABLE public.#####session (
    uid varchar(32) DEFAULT ''::character varying NOT NULL,
    date varchar(20) DEFAULT ''::character varying NOT NULL,
    user_id varchar(32) DEFAULT ''::character varying NOT NULL,
    "user" varchar(255) NOT NULL
) WITHOUT OIDS;
--
-- Structure for table #####links (OID = 16822) : 
--
CREATE TABLE public.#####links (
    uid varchar(32) DEFAULT ''::character varying NOT NULL,
    "type" char(1) DEFAULT 'l'::bpchar NOT NULL,
    category varchar(32),
    sort integer,
    name varchar(255),
    link varchar(255),
    published integer DEFAULT 0 NOT NULL,
    target varchar(20),
    rss varchar(255),
    "access" varchar(10) DEFAULT ''::character varying NOT NULL,
    "desc" text,
    module integer
) WITHOUT OIDS;
--
-- Structure for table #####user (OID = 16831) : 
--
CREATE TABLE public.#####user (
    uid varchar(32) DEFAULT ''::character varying NOT NULL,
    name varchar(255) DEFAULT ''::character varying NOT NULL,
    username varchar(255) DEFAULT ''::character varying NOT NULL,
    "password" varchar(32) DEFAULT ''::character varying NOT NULL,
    email varchar(255) DEFAULT ''::character varying NOT NULL,
    join_date varchar(19) DEFAULT ''::character varying NOT NULL,
    birthday varchar(10),
    gender varchar(5) DEFAULT ''::character varying NOT NULL,
    occupation varchar(255),
    homepage varchar(255),
    icq varchar(20),
    aim varchar(20),
    yim varchar(20),
    msn varchar(20),
    enabled integer DEFAULT 0 NOT NULL,
    tcms_enabled integer DEFAULT 0 NOT NULL,
    static_value integer DEFAULT 0 NOT NULL,
    signature text,
    "location" varchar(255),
    hobby varchar(255),
    "group" varchar(32) NOT NULL,
    last_login varchar(19),
    skype varchar(100)
) WITHOUT OIDS;
--
-- Structure for table #####news_to_categories (OID = 16846) : 
--
CREATE TABLE public.#####news_to_categories (
    uid varchar(32),
    news_uid varchar(10),
    cat_uid varchar(5)
) WITHOUT OIDS;
--
-- Structure for table #####statistics (OID = 16848) : 
--
CREATE TABLE public.#####statistics (
    host varchar(255) NOT NULL,
    site_url varchar(255) NOT NULL,
    value integer,
    ip_uid varchar(32),
    referrer varchar(255),
    "timestamp" timestamp without time zone
) WITHOUT OIDS;
--
-- Structure for table #####statistics_ip (OID = 16853) : 
--
CREATE TABLE public.#####statistics_ip (
    uid varchar(32) NOT NULL,
    ip varchar(15) NOT NULL,
    value integer
) WITHOUT OIDS;
--
-- Structure for table #####statistics_os (OID = 16855) : 
--
CREATE TABLE public.#####statistics_os (
    uid varchar(32),
    browser varchar(255),
    os varchar(255),
    value integer
) WITHOUT OIDS;
--
-- Structure for table #####knowledgebase (OID = 16860) : 
--
CREATE TABLE public.#####knowledgebase (
    uid varchar(10) NOT NULL,
    category varchar(10),
    parent varchar(10),
    title varchar(255),
    subtitle varchar(255),
    content text,
    image varchar(255),
    "type" char(1) NOT NULL,
    date varchar(16) NOT NULL,
    last_update varchar(16) NOT NULL,
    "access" varchar(10) NOT NULL,
    autor varchar(255) NOT NULL,
    sort integer NOT NULL,
    publish_state integer NOT NULL
) WITHOUT OIDS;
--
-- Structure for table #####knowledgebase_config (OID = 16865) : 
--
CREATE TABLE public.#####knowledgebase_config (
    uid varchar(13) NOT NULL,
    id varchar(13) NOT NULL,
    title varchar(255),
    subtitle varchar(255),
    text text,
    enabled integer NOT NULL,
    autor_enabled integer NOT NULL,
    "access" varchar(10) NOT NULL
) WITHOUT OIDS;
--
-- Structure for table #####usergroup (OID = 16870) : 
--
CREATE TABLE public.#####usergroup (
    uid varchar(32) NOT NULL,
    name varchar(25) NOT NULL,
    "right" integer NOT NULL
) WITHOUT OIDS;
--
-- Structure for table #####content_languages (OID = 16872) : 
--
CREATE TABLE public.#####content_languages (
    uid varchar(5) NOT NULL,
    content_uid varchar(5),
    "language" varchar(25),
    title varchar(255),
    "key" varchar(255),
    content00 text,
    content01 text,
    foot varchar(255),
    autor varchar(255),
    db_layout varchar(50),
    "access" varchar(10),
    in_work integer DEFAULT 0,
    published integer DEFAULT 0
) WITHOUT OIDS;
--
-- Structure for table #####log (OID = 16888) : 
--
CREATE TABLE public.#####log (
    uid varchar(32) NOT NULL,
    user_uid varchar(32),
    stamp integer NOT NULL,
    ip varchar(40),
    module varchar(40),
    text text
);
--
-- Data for table public.#####contactform (OID = 16413) (LIMIT 0,1)
--
INSERT INTO #####contactform (uid, contact, show_contacts_in_sidebar, send_id, contacttitle, contactstamp, "access", enabled, use_adressbook, use_contact, show_contactemail, contacttext, "language")
VALUES ('contactform', 'info@toenda.com', 0, 'contactform', 'Contact Us and ...', '... send us a message.', 'Public', 1, NULL, NULL, 0, NULL, 'english_EN');

--
-- Data for table public.#####content (OID = 16436) (LIMIT 0,1)
--
INSERT INTO #####content (uid, title, "key", content00, content01, foot, db_layout, "access", published, in_work, autor, "language")
VALUES ('18e2a', 'License', 'toendaCMS &amp; GNU General Public License', '&lt;p align__________&quot;center&quot;&gt;
&lt;strong&gt;GNU General Public License&lt;/strong&gt;&lt;br /&gt;
&lt;em&gt;Version 2,  June 1991&lt;/em&gt;   1989,  1991 Free Software Foundation,  Inc. &lt;br /&gt;
Free Software Foundation,  Inc.,  59 Temple Place,  Suite 330,  Boston,  MA,  02111-1307,  USA &lt;br /&gt;
Everyone is permitted to copy and distribute verbatim copies of this license document,  but changing it is not allowed. &lt;br /&gt;
Version 2,  June 1991 
&lt;/p&gt;
&lt;p&gt;
&nbsp;
&lt;/p&gt;
&lt;h2&gt;GNU General Public License&lt;/h2&gt;
&lt;img align__________&quot;left&quot; border__________&quot;0&quot; height__________&quot;112&quot; hspace__________&quot;5&quot; src__________&quot;http://localhost/toendacms_svn/toendacms/data/images/Image/clock.jpg&quot; width__________&quot;150&quot; /&gt;&lt;strong&gt;Preamble&lt;/strong&gt;  The licenses for most software are designed to take away your freedom to share and change it. By contrast,  the GNU General Public License is intended to guarantee your freedom to share and changefree software - to make sure the software is free for all its users. This General Public License applies to most of the Free Software Foundation&amp;#39;s software and to any other program whose authors commit to using it. (Some other Free Software Foundation software is covered by the GNU Library General Public License instead.) You can apply it to your programs,  too. &lt;br /&gt;
&lt;br /&gt;
When we speak of free software,  we are referring to freedom,  not price. Our General Public Licenses are designed to make sure that you have the freedom to distribute copies of free software (and charge for this service if you wish),  that you receive source code or can get it if you want it,  that you can change the software or use pieces of it in new free programs; and that you know you can do these things. &lt;br /&gt;
&lt;br /&gt;
To protect your rights,  we need to make restrictions that forbid anyone to deny you these rights or to ask you to surrender the rights. These restrictions translate to certain responsibilities for you if you distribute copies of the software,  or if you modify it. &lt;br /&gt;
&lt;br /&gt;
For example,  if you distribute copies of such a program,  whether gratis or for a fee,  you must give the recipients all the rights that you have. You must make sure that they,  too,  receive or can get the source code. And you must show them these terms so they know their rights. &lt;br /&gt;
&lt;br /&gt;
We protect your rights with two steps: &lt;br /&gt;
&lt;ul&gt;
	&lt;li&gt;copyright the software,  and&lt;/li&gt;
	&lt;li&gt;offer you this license which gives you legal permission to copy,  distribute and/or modify the software.&lt;/li&gt;
&lt;/ul&gt;
Also,  for each author&amp;#39;s protection and ours,  we want to make certain that everyone understands that there is no warranty for this free software. If the software is modified by someone else and passed on,  we want its recipients to know that what they have is not the original,  so that any problems introduced by others will not reflect on the original authors&amp;#39; reputations. &lt;br /&gt;
&lt;br /&gt;
Finally,  any free program is threatened constantly by software patents. We wish to avoid the danger that redistributors of a free program will individually obtain patent licenses,  in effect making the program proprietary. To prevent this,  we have made it clear that any patent must be licensed for everyone&amp;#39;s free use or not licensed at all. &lt;br /&gt;
&lt;br /&gt;
The precise terms and conditions for copying,  distribution and modification follow. &lt;br /&gt;
{tcms_more}&lt;br /&gt;
&lt;strong&gt;TERMS AND CONDITIONS FOR COPYING,  DISTRIBUTION AND MODIFICATION&lt;/strong&gt;   &lt;strong&gt;Section 0&lt;/strong&gt;  This License applies to any program or other work which contains a notice placed by the copyright holder saying it may be distributed under the terms of this General Public License. The &quot;Program&quot;,  below,  refers to any such program or work,  and a work based on the Program means either the Program or any derivative work under copyright law: that is to say,  a work containing the Program or a portion of it,  either verbatim or with modifications and/or translated into another language. (Hereinafter,  translation is included without limitation in the term modification .) Each licensee is addressed as you. &lt;br /&gt;
&lt;br /&gt;
Activities other than copying,  distribution and modification are not covered by this License; they are outside its scope. The act of running the Program is not restricted,  and the output from the Program is covered only if its contents constitute a work based on the Program (independent of having been made by running the Program). Whether that is true depends on what the Program does. &lt;br /&gt;
&lt;br /&gt;
&lt;strong&gt;Section 1&lt;/strong&gt;  You may copy and distribute verbatim copies of the Program&amp;#39;s source code as you receive it,  in any medium,  provided that you conspicuously and appropriately publish on each copy an appropriate copyright notice and disclaimer of warranty; keep intact all the notices that refer to this License and to the absence of any warranty; and give any other recipients of the Program a copy of this License along with the Program. &lt;br /&gt;
&lt;br /&gt;
You may charge a fee for the physical act of transferring a copy,  and you may at your option offer warranty protection in exchange for a fee. &lt;br /&gt;
&lt;br /&gt;
&lt;strong&gt;Section 2&lt;/strong&gt;  You may modify your copy or copies of the Program or any portion of it,  thus forming a work based on the Program,  and copy and distribute such modifications or work under the terms of Section 1 above,  provided that you also meet all of these conditions: &lt;br /&gt;
&lt;br /&gt;
You must cause the modified files to carry prominent notices stating that you changed the files and the date of any change. &lt;br /&gt;
&lt;br /&gt;
You must cause any work that you distribute or publish,  that in whole or in part contains or is derived from the Program or any part thereof,  to be licensed as a whole at no charge to all third parties under the terms of this License. &lt;br /&gt;
&lt;br /&gt;
If the modified program normally reads commands interactively when run,  you must cause it,  when started running for such interactive use in the most ordinary way,  to print or display an announcement including an appropriate copyright notice and a notice that there is no warranty (or else,  saying that you provide a warranty) and that users may redistribute the program under these conditions,  and telling the user how to view a copy of this License. &lt;br /&gt;
&lt;br /&gt;
Exception: &lt;br /&gt;
&lt;br /&gt;
If the Program itself is interactive but does not normally print such an announcement,  your work based on the Program is not required to print an announcement.) &lt;br /&gt;
&lt;br /&gt;
These requirements apply to the modified work as a whole. If identifiable sections of that work are not derived from the Program,  and can be reasonably considered independent and separate works in themselves,  then this License,  and its terms,  do not apply to those sections when you distribute them as separate works. But when you distribute the same sections as part of a whole which is a work based on the Program,  the distribution of the whole must be on the terms of this License,  whose permissions for other licensees extend to the entire whole,  and thus to each and every part regardless of who wrote it. &lt;br /&gt;
&lt;br /&gt;
Thus,  it is not the intent of this section to claim rights or contest your rights to work written entirely by you; rather,  the intent is to exercise the right to control the distribution of derivative or collective works based on the Program. &lt;br /&gt;
&lt;br /&gt;
In addition,  mere aggregation of another work not based on the Program with the Program (or with a work based on the Program) on a volume of a storage or distribution medium does not bring the other work under the scope of this License. &lt;br /&gt;
&lt;br /&gt;
&lt;strong&gt;Section 3&lt;/strong&gt;  You may copy and distribute the Program (or a work based on it,  under Section 2 in object code or executable form under the terms of Sections 1 and 2 above provided that you also do one of the following: &lt;br /&gt;
&lt;br /&gt;
Accompany it with the complete corresponding machine-readable source code,  which must be distributed under the terms of Sections 1 and 2 above on a medium customarily used for software interchange; or,  &lt;br /&gt;
&lt;br /&gt;
Accompany it with a written offer,  valid for at least three years,  to give any third party,  for a charge no more than your cost of physically performing source distribution,  a complete machine-readable copy of the corresponding source code,  to be distributed under the terms of Sections 1 and 2 above on a medium customarily used for software interchange; or,  &lt;br /&gt;
&lt;br /&gt;
Accompany it with the information you received as to the offer to distribute corresponding source code. (This alternative is allowed only for noncommercial distribution and only if you received the program in object code or executable form with such an offer,  in accord with Subsection b above.) &lt;br /&gt;
&lt;br /&gt;
The source code for a work means the preferred form of the work for making modifications to it. For an executable work,  complete source code means all the source code for all modules it contains,  plus any associated interface definition files,  plus the scripts used to control compilation and installation of the executable. However,  as a special exception,  the source code distributed need not include anything that is normally distributed (in either source or binary form) with the major components (compiler,  kernel,  and so on) of the operating system on which the executable runs,  unless that component itself accompanies the executable. &lt;br /&gt;
&lt;br /&gt;
If distribution of executable or object code is made by offering access to copy from a designated place,  then offering equivalent access to copy the source code from the same place counts as distribution of the source code,  even though third parties are not compelled to copy the source along with the object code. &lt;br /&gt;
&lt;br /&gt;
&lt;strong&gt;Section 4&lt;/strong&gt;  You may not copy,  modify,  sublicense,  or distribute the Program except as expressly provided under this License. Any attempt otherwise to copy,  modify,  sublicense or distribute the Program is void,  and will automatically terminate your rights under this License. However,  parties who have received copies,  or rights,  from you under this License will not have their licenses terminated so long as such parties remain in full compliance. &lt;br /&gt;
&lt;br /&gt;
&lt;strong&gt;Section 5&lt;/strong&gt;  You are not required to accept this License,  since you have not signed it. However,  nothing else grants you permission to modify or distribute the Program or its derivative works. These actions are prohibited by law if you do not accept this License. Therefore,  by modifying or distributing the Program (or any work based on the Program),  you indicate your acceptance of this License to do so,  and all its terms and conditions for copying,  distributing or modifying the Program or works based on it. &lt;br /&gt;
&lt;br /&gt;
&lt;strong&gt;Section 6&lt;/strong&gt;  Each time you redistribute the Program (or any work based on the Program),  the recipient automatically receives a license from the original licensor to copy,  distribute or modify the Program subject to these terms and conditions. You may not impose any further restrictions on the recipients&amp;#39; exercise of the rights granted herein. You are not responsible for enforcing compliance by third parties to this License. &lt;br /&gt;
&lt;br /&gt;
&lt;strong&gt;Section 7&lt;/strong&gt;  If,  as a consequence of a court judgment or allegation of patent infringement or for any other reason (not limited to patent issues),  conditions are imposed on you (whether by court order,  agreement or otherwise) that contradict the conditions of this License,  they do not excuse you from the conditions of this License. If you cannot distribute so as to satisfy simultaneously your obligations under this License and any other pertinent obligations,  then as a consequence you may not distribute the Program at all. For example,  if a patent license would not permit royalty-free redistribution of the Program by all those who receive copies directly or indirectly through you,  then the only way you could satisfy both it and this License would be to refrain entirely from distribution of the Program. If any portion of this section is held invalid or unenforceable under any particular circumstance,  the balance of the section is intended to apply and the section as a whole is intended to apply in other circumstances. It is not the purpose of this section to induce you to infringe any patents or other property right claims or to contest validity of any such claims; this section has the sole purpose of protecting the integrity of the free software distribution system,  which is implemented by public license practices. Many people have made generous contributions to the wide range of software distributed through that system in reliance on consistent application of that system; it is up to the author/donor to decide if he or she is willing to distribute software through any other system and a licensee cannot impose that choice. This section is intended to make thoroughly clear what is believed to be a consequence of the rest of this License. &lt;br /&gt;
&lt;br /&gt;
&lt;strong&gt;Section 8&lt;/strong&gt;  If the distribution and/or use of the Program is restricted in certain countries either by patents or by copyrighted interfaces,  the original copyright holder who places the Program under this License may add an explicit geographical distribution limitation excluding those countries,  so that distribution is permitted only in or among countries not thus excluded. In such case,  this License incorporates the limitation as if written in the body of this License. &lt;br /&gt;
&lt;br /&gt;
&lt;strong&gt;Section 9&lt;/strong&gt;  The Free Software Foundation may publish revised and/or new versions of the General Public License from time to time. Such new versions will be similar in spirit to the present version,  but may differ in detail to address new problems or concerns. Each version is given a distinguishing version number. If the Program specifies a version number of this License which applies to it and &quot;any later version&quot;,  you have the option of following the terms and conditions either of that version or of any later version published by the Free Software Foundation. If the Program does not specify a version number of this License,  you may choose any version ever published by the Free Software Foundation. &lt;br /&gt;
&lt;br /&gt;
&lt;strong&gt;Section 10&lt;/strong&gt;  If you wish to incorporate parts of the Program into other free programs whose distribution conditions are different,  write to the author to ask for permission. For software which is copyrighted by the Free Software Foundation,  write to the Free Software Foundation; we sometimes make exceptions for this. Our decision will be guided by the two goals of preserving the free status of all derivatives of our free software and of promoting the sharing and reuse of software generally. &lt;br /&gt;
{tcms_more}&lt;br /&gt;
&lt;strong&gt;NO WARRANTY Section 11&lt;/strong&gt;  BECAUSE THE PROGRAM IS LICENSED FREE OF CHARGE,  THERE IS NO WARRANTY FOR THE PROGRAM,  TO THE EXTENT PERMITTED BY APPLICABLE LAW. EXCEPT WHEN OTHERWISE STATED IN WRITING THE COPYRIGHT HOLDERS AND/OR OTHER PARTIES PROVIDE THE PROGRAM &quot;AS IS&quot; WITHOUT WARRANTY OF ANY KIND,  EITHER EXPRESSED OR IMPLIED,  INCLUDING,  BUT NOT LIMITED TO,  THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE. THE ENTIRE RISK AS TO THE QUALITY AND PERFORMANCE OF THE PROGRAM IS WITH YOU. SHOULD THE PROGRAM PROVE DEFECTIVE,  YOU ASSUME THE COST OF ALL NECESSARY SERVICING,  REPAIR OR CORRECTION. &lt;br /&gt;
&lt;br /&gt;
&lt;strong&gt;Section 12&lt;/strong&gt;  IN NO EVENT UNLESS REQUIRED BY APPLICABLE LAW OR AGREED TO IN WRITING WILL ANY COPYRIGHT HOLDER,  OR ANY OTHER PARTY WHO MAY MODIFY AND/OR REDISTRIBUTE THE PROGRAM AS PERMITTED ABOVE,  BE LIABLE TO YOU FOR DAMAGES,  INCLUDING ANY GENERAL,  SPECIAL,  INCIDENTAL OR CONSEQUENTIAL DAMAGES ARISING OUT OF THE USE OR INABILITY TO USE THE PROGRAM (INCLUDING BUT NOT LIMITED TO LOSS OF DATA OR DATA BEING RENDERED INACCURATE OR LOSSES SUSTAINED BY YOU OR THIRD PARTIES OR A FAILURE OF THE PROGRAM TO OPERATE WITH ANY OTHER PROGRAMS),  EVEN IF SUCH HOLDER OR OTHER PARTY HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES. &lt;br /&gt;
&lt;br /&gt;
END OF TERMS AND CONDITIONS &lt;br /&gt;
&lt;br /&gt;
&lt;strong&gt;How to Apply These Terms to Your New Programs&lt;/strong&gt;  If you develop a new program,  and you want it to be of the greatest possible use to the public,  the best way to achieve this is to make it free software which everyone can redistribute and change under these terms. &lt;br /&gt;
&lt;br /&gt;
To do so,  attach the following notices to the program. It is safest to attach them to the start of each source file to most effectively convey the exclusion of warranty; and each file should have at least the &quot;copyright&quot; line and a pointer to where the full notice is found. &lt;br /&gt;
&lt;br /&gt;
&lt;strong&gt;toendaCMS - XML Content Management and Weblogging System&lt;/strong&gt;   toendaCMS is a professionall web based Content Management and Weblogging System with a XML or SQL Database. &lt;br /&gt;
&lt;strong&gt;Copyright (C) 2003 - 2005 Jonathan Naumann &lt;em&gt;Toenda Software Development&lt;/em&gt;&lt;/strong&gt;    This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License,  or (at your option) any later version. &lt;br /&gt;
&lt;br /&gt;
This program is distributed in the hope that it will be useful,  but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details. &lt;br /&gt;
&lt;br /&gt;
You should have received a copy of the GNU General Public License along with this program; if not,  write to the Free Software Foundation,  Inc.,  59 Temple Place,  Suite 330,  Boston,  MA 02111-1307 USA &lt;br /&gt;
&lt;br /&gt;
Also add information on how to contact you by electronic and paper mail. &lt;br /&gt;
&lt;br /&gt;
If the program is interactive,  make it output a short notice like this when it starts in an interactive mode: &lt;br /&gt;
&lt;br /&gt;
Gnomovision version 69,  Copyright (C) year name of author Gnomovision comes with ABSOLUTELY NO WARRANTY; for details type `show w&amp;#39;. This is free software,  and you are welcome to redistribute it under certain conditions; type `show c&amp;#39; for details. &lt;br /&gt;
&lt;br /&gt;
The hypothetical commands `show w&amp;#39; and `show c&amp;#39; should show the appropriate parts of the General Public License. Of course,  the commands you use may be called something other than `show w&amp;#39; and `show c&amp;#39;; they could even be mouse-clicks or menu items--whatever suits your program. &lt;br /&gt;
&lt;br /&gt;
You should also get your employer (if you work as a programmer) or your school,  if any,  to sign a &quot;copyright disclaimer&quot; for the program,  if necessary. Here is a sample; alter the names: &lt;br /&gt;
&lt;br /&gt;
Yoyodyne,  Inc.,  hereby disclaims all copyright interest in the program `Gnomovision&amp;#39; (which makes passes at compilers) written by James Hacker. &lt;br /&gt;
&lt;br /&gt;
(signature of Ty Coon),  1 April 1989 Ty Coon,  President of Vice &lt;br /&gt;
&lt;br /&gt;
This General Public License does not permit incorporating your program into proprietary programs. If your program is a subroutine library,  you may consider it more useful to permit linking proprietary applications with the library. If this is what you want to do,  use the GNU Library General Public License instead of this License. &lt;br /&gt;
&lt;br /&gt;
&lt;strong&gt;Toenda Software Development&lt;/strong&gt;
', '', '', 'db_content_default.php', 'Public', 1, 1, 'root', NULL);

--
-- Data for table public.#####downloads_config (OID = 16452) (LIMIT 0,1)
--
INSERT INTO #####downloads_config (uid, download_id, download_title, download_stamp, download_text)
VALUES ('download', 'download', 'Downloads and Software', 'Toenda Software Downloads', '');

--
-- Data for table public.#####frontpage (OID = 16459) (LIMIT 0,2)
--
INSERT INTO #####frontpage (uid, front_id, front_title, front_stamp, front_text, news_title, news_cut, module_use_0, sb_news_title, sb_news_amount, sb_news_chars, sb_news_enabled, sb_news_display, "language")
VALUES ('frontpage', 'frontpage', 'Welcome to the Home of toendaCMS', 'Content Management and Weblogging System', 'Welcome to the Samplesite of the free Open-Source XML content management and weblogging system toendaCMS. It is for enterprise purposes on the web. It offers full flexibility and extendability while featuring an accomplished set of ready-made interfaces,  function''s and modules.&lt;br /&gt;
This fronpagetext is completly formatted using toendaScript. Its a small stylesheet language.', 'Journal', 0, 5, NULL, NULL, NULL, NULL, NULL, 'english_EN');

INSERT INTO #####frontpage (uid, front_id, front_title, front_stamp, front_text, news_title, news_cut, module_use_0, sb_news_title, sb_news_amount, sb_news_chars, sb_news_enabled, sb_news_display, "language")
VALUES ('06f8e7ce4', 'frontpage', 'Willkommen auf der Demoseite von toendaCMS', 'Open Source Content Management Framework', 'werwerwer', 'Aktuelle Neuigkeiten', 0, 3, '', 0, 0, 0, 1, 'germany_DE');

--
-- Data for table public.#####guestbook (OID = 16468) (LIMIT 0,1)
--
INSERT INTO #####guestbook (uid, guest_id, booktitle, bookstamp, "access", enabled, clean_link, clean_script, convert_at, show_email, name_width, text_width, color_row_1, color_row_2)
VALUES ('guestbook', 'guestbook', 'Guestbook', 'Write me a comment', 'Public', 1, 1, 1, 1, 1, '140', '360', 'e8e7d7', 'cbcbb9');

--
-- Data for table public.#####imagegallery_config (OID = 16497) (LIMIT 0,1)
--
INSERT INTO #####imagegallery_config (uid, image_id, image_title, image_stamp, image_details, use_comments, "access", max_image, needle_image, show_lastimg, show_lastimg_title, align_image, size_image, image_sort, list_option)
VALUES ('imagegallery', 'imagegallery', 'Imagegallery', 'Picture i like', 0, 1, 'Public', 3, 'Last uploaded', 1, 0, 'center', 80, 'desc', NULL);

--
-- Data for table public.#####imprint (OID = 16507) (LIMIT 0,1)
--
INSERT INTO #####imprint (uid, imp_id, imp_title, imp_stamp, imp_contact, taxno, ustid, legal, "language")
VALUES ('impressum', 'impressum', 'Disclaimer / Legal', 'Information about this website', 'eabccon000', '123456789', '123123d', 'No portion of this web site may be reproduced without express written consent.<br />
Certain product and/or company names referenced on this site are trademarks or registered trademarks of their respective owners.<br />
This web site is created with a potion af caution but all that,  the owner assumes no responsibility for any damages arising from the use of information on this site or the accuracy of the information presented. Product features and specifications subject to change without notice. The owner takes no responsibility for information on external sites linked to from this site.', 'english_EN');

--
-- Data for table public.#####links_config (OID = 16515) (LIMIT 0,2)
--
INSERT INTO #####links_config (uid, link_use_side, link_use_side_desc, link_use_side_title, link_side_title, link_use_main_desc, link_main_title, link_main_subtitle, link_main_text, link_main_access)
VALUES ('links_config_side', 1, 1, 1, 'Blogroll', NULL, NULL, NULL, NULL, NULL);

INSERT INTO #####links_config (uid, link_use_side, link_use_side_desc, link_use_side_title, link_side_title, link_use_main_desc, link_main_title, link_main_subtitle, link_main_text, link_main_access)
VALUES ('links_config_main', 0, 0, 0, NULL, 1, 'myLinks', 'A list of all websites i like', '', 'Public');

--
-- Data for table public.#####news (OID = 16524) (LIMIT 0,2)
--
INSERT INTO #####news (uid, title, autor, date, "time", newstext, stamp, published, publish_date, comments_enabled, image, category, "access", show_on_frontpage, "language")
VALUES ('b5c1575a93', 'Hallo Welt!', 'root', '17.02.2007', '16:00', '&lt;strong&gt;Lorem ipsum dolor&lt;/strong&gt; sit amet,  consectetuer adipiscing
elit,  sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna
aliquam erat volutpat. Ut wisi enim ad minim veniam,  quis nostrud
exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea
commodo consequat. Duis autem vel eum iriure dolor in hendrerit in
vulputate velit esse molestie consequat,  vel illum dolore eu feugiat
nulla facilisis at vero et accumsan et iusto odio dignissim qui blandit
praesent luptatum zzril delenit augue duis dolore te feugait nulla
facilisi.&lt;br /&gt;
{tcms_more}&lt;br /&gt;
&lt;strong&gt;Lorem ipsum dolor&lt;/strong&gt; sit amet,  consectetuer adipiscing
elit,  sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna
aliquam erat volutpat. Ut wisi enim ad minim veniam,  quis nostrud
exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea
commodo consequat. Duis autem vel eum iriure dolor in hendrerit in
vulputate velit esse molestie consequat,  vel illum dolore eu feugiat
nulla facilisis at vero et accumsan et iusto odio dignissim qui blandit
praesent luptatum zzril delenit augue duis dolore te feugait nulla
facilisi.&lt;br /&gt;
', 200702171600, 1, '17.02.2007-16:00', 1, '', '', 'Public', 1, 'germany_DE');

INSERT INTO #####news (uid, title, autor, date, "time", newstext, stamp, published, publish_date, comments_enabled, image, category, "access", show_on_frontpage, "language")
VALUES ('5a12397d95', 'Hello World', 'root', '20.06.2005', '00:14', '&lt;strong&gt;Lorem ipsum dolor&lt;/strong&gt; sit amet,  consectetuer adipiscing elit,  sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam,  quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat,  vel illum dolore eu feugiat nulla facilisis at vero et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.&lt;br /&gt;
{tcms_more}&lt;br /&gt;
&lt;strong&gt;Lorem ipsum dolor&lt;/strong&gt; sit amet,  consectetuer adipiscing elit,  sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam,  quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat,  vel illum dolore eu feugiat nulla facilisis at vero et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum.
', 200506200014, 1, '20.06.2005-00:14', 1, '', 'erdf4', 'Public', 1, 'english_EN');

--
-- Data for table public.#####comments (OID = 16539) (LIMIT 0,2)
--
INSERT INTO #####comments (uid, "timestamp", name, email, web, msg, "time", module)
VALUES ('5a12397d95', '20050907214203', 'vandango', 'vandango@toenda.com', 'http://vandango.toenda.com', 'Testmessage,  you can delete me ...', '20050907214203', 'news');

INSERT INTO #####comments (uid, "timestamp", name, email, web, msg, "time", module)
VALUES ('5a12397d95', '20050907214203', 'vandango', 'vandango@toenda.com', 'http://vandango.toenda.com', 'Testmessage,  you can delete me ...', '20050907214203', 'news');

--
-- Data for table public.#####newsletter (OID = 16548) (LIMIT 0,2)
--
INSERT INTO #####newsletter (uid, use_newsletter, nl_title, nl_show_title, nl_text, nl_link)
VALUES ('newsletter', 0, 'Newsletter', 1, 'You want always know whats up,  subscribe now!', 'Submit');

INSERT INTO #####newsletter (uid, use_newsletter, nl_title, nl_show_title, nl_text, nl_link)
VALUES ('newsletter', 0, 'Newsletter', 1, 'You want always know whats up,  subscribe now!', 'Submit');

--
-- Data for table public.#####newsmanager (OID = 16559) (LIMIT 0,2)
--
INSERT INTO #####newsmanager (uid, news_id, news_title, news_stamp, news_image, use_comments, show_autor, show_autor_as_link, news_amount, "access", news_cut, use_gravatar, use_emoticons, use_rss091, use_rss10, use_rss20, use_atom03, use_opml, syn_amount, use_syn_title, def_feed, use_timesince, use_trackback, readmore_link, news_text, news_spacing, "language", use_rss091_img, rss091_text, use_rss10_img, rss10_text, use_rss20_img, rss20_feed, use_atom03_img, atom03_text, use_opml_img, opml_text, use_comment_feed, comment_feed_text, comment_feed_type, use_comment_feed_img, comments_feed_amount)
VALUES ('newsmanager', 'newsmanager', 'News', 'Current', '', 1, 0, 1, 1, 'Public', 0, 1, 1, 0, 0, 1, 0, 0, 25, 1, 'RSS2.0', 0, 0, 0, '', 0, 'english_EN', 0, '', 0, '', 0, 'Grap news feed', 0, '', 0, '', 1, 'Grap comments feed', 'RSS2.0', 0, 25);

INSERT INTO #####newsmanager (uid, news_id, news_title, news_stamp, news_image, use_comments, show_autor, show_autor_as_link, news_amount, "access", news_cut, use_gravatar, use_emoticons, use_rss091, use_rss10, use_rss20, use_atom03, use_opml, syn_amount, use_syn_title, def_feed, use_timesince, use_trackback, readmore_link, news_text, news_spacing, "language", use_rss091_img, rss091_text, use_rss10_img, rss10_text, use_rss20_img, rss20_feed, use_atom03_img, atom03_text, use_opml_img, opml_text, use_comment_feed, comment_feed_text, comment_feed_type, use_comment_feed_img, comments_feed_amount)
VALUES ('newsmanager', 'newsmanager', 'News', 'Current', '', 1, 0, 1, 1, 'Public', 0, 1, 1, 0, 0, 1, 0, 0, 25, 1, 'RSS2.0', 0, 0, 0, '', 0, 'english_EN', 0, '', 0, '', 0, 'Grap news feed', 0, '', 0, '', 1, 'Grap comments feed', 'RSS2.0', 0, 25);

--
-- Data for table public.#####poll_config (OID = 16696) (LIMIT 0,2)
--
INSERT INTO #####poll_config (uid, poll_title, allpoll_title, show_poll_title, use_poll_side, poll_side_width, poll_main_width, poll_sm_title, use_poll_sidemenu, poll_sidemenu_id, poll_tm_title, use_poll_topmenu, poll_topmenu_id)
VALUES ('poll', 'Poll', 'All Polls', 1, 0, 80, 80, 'Poll', 0, 2, 'Poll', 0, 4);

INSERT INTO #####poll_config (uid, poll_title, allpoll_title, show_poll_title, use_poll_side, poll_side_width, poll_main_width, poll_sm_title, use_poll_sidemenu, poll_sidemenu_id, poll_tm_title, use_poll_topmenu, poll_topmenu_id)
VALUES ('poll', 'Poll', 'All Polls', 1, 0, 80, 80, 'Poll', 0, 2, 'Poll', 0, 4);

--
-- Data for table public.#####polls (OID = 16714) (LIMIT 0,2)
--
INSERT INTO #####polls (uid, title, question1, question2, question3, question4, question5, question6, question7, question8, question9, question10, question11, question12)
VALUES ('55e14459521dc337d62aabd241139a67', 'This toendaCMS installation was ....', 'Absolutely simple', 'Reasonably easy', 'Not straight-forward but I worked it out', 'I had to install extra server stuff', 'I had no idea and got my friend to do it', 'My dog ran away with the README ...', NULL, NULL, NULL, NULL, NULL, NULL);

INSERT INTO #####polls (uid, title, question1, question2, question3, question4, question5, question6, question7, question8, question9, question10, question11, question12)
VALUES ('55e14459521dc337d62aabd241139a67', 'This toendaCMS installation was ....', 'Absolutely simple', 'Reasonably easy', 'Not straight-forward but I worked it out', 'I had to install extra server stuff', 'I had no idea and got my friend to do it', 'My dog ran away with the README ...', NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Data for table public.#####products_config (OID = 16721) (LIMIT 0,1)
--
INSERT INTO #####products_config (uid, products_id, products_title, products_stamp, products_text, category_state, category_title, use_category_title, "language", show_price_only_users, startpagetitle, use_sidebar_categories, max_latest_products)
VALUES ('products', 'products', 'Products', 'Toenda Software Products', 'Our software products.', 'software', 'Product Categories', 1, 'english_EN', 0, '', 0, 10);

--
-- Data for table public.#####sidebar (OID = 16733) (LIMIT 0,1)
--
INSERT INTO #####sidebar (uid, title, "key", content, foot, id)
VALUES ('frontpage', 'Wenn ich gross bin', '', 'Ich bin nur ein kleiner Blindtext
Wenn ich gross bin,  will ich Ulysses von James Joyce werden. Aber jetzt lohnt es sich noch nicht,  mich weiterzulesen. Denn vorerst bin ich nur ein kleiner Blindtext.', '', 'frontpage');

--
-- Data for table public.#####sidebar_extensions (OID = 16740) (LIMIT 0,1)
--
INSERT INTO #####sidebar_extensions (uid, sidemenu_title, sidemenu, sidebar_title, show_sidebar_title, sidebar, chooser_title, show_chooser_title, chooser, search_title, show_search_title, search_alignment, search_withbr, search, login_title, usermenu_title, login, nologin, reg_link, reg_user, reg_pass, login_user, usermenu, show_login_title, show_news_categories, search_withbutton, search_word, show_news_cat_amount, show_memberlist, lang)
VALUES ('sidebar_extensions', 'Sidemenu', 0, 'Sidebar', 1, 0, 'Showcase', 1, 0, 'Search', 0, 'left', 0, 1, 'Login', 'Usermenu', 1, 'No account yet?', 'Create one', 'Username', 'Password', 1, 1, 1, 1, 0, '', 1, 1, 'de;en;nl;');

--
-- Data for table public.#####sidemenu (OID = 16759) (LIMIT 0,6)
--
INSERT INTO #####sidemenu (uid, name, id, subid, parent, "type", link, published, "access", parent_lvl2, parent_lvl3, root, parent_lvl1, target, "language")
VALUES ('6738n', 'Pages', 0, '-', '-', 'title', '-', 1, 'Public', '-', '-', '-', '-', NULL, 'english_EN');

INSERT INTO #####sidemenu (uid, name, id, subid, parent, "type", link, published, "access", parent_lvl2, parent_lvl3, root, parent_lvl1, target, "language")
VALUES ('99bf3', 'Downloads', 2, '-', '-', 'link', 'download', 1, 'Public', '-', '-', '-', '-', NULL, 'english_EN');

INSERT INTO #####sidemenu (uid, name, id, subid, parent, "type", link, published, "access", parent_lvl2, parent_lvl3, root, parent_lvl1, target, "language")
VALUES ('r15tg', 'Home', 1, '-', '-', 'link', 'frontpage', 1, 'Public', '-', '-', '-', '-', NULL, 'english_EN');

INSERT INTO #####sidemenu (uid, name, id, subid, parent, "type", link, published, "access", parent_lvl2, parent_lvl3, root, parent_lvl1, target, "language")
VALUES ('52a92', 'Guestbook', 3, '-', '3', 'link', 'guestbook', 1, 'Public', '-', '-', '-', '-', NULL, 'english_EN');

INSERT INTO #####sidemenu (uid, name, id, subid, parent, "type", link, published, "access", parent_lvl2, parent_lvl3, root, parent_lvl1, target, "language")
VALUES ('9c615', 'License', 4, '-', '-', 'link', '18e2a', 1, 'Public', '-', '-', '-', '-', NULL, 'english_EN');

INSERT INTO #####sidemenu (uid, name, id, subid, parent, "type", link, published, "access", parent_lvl2, parent_lvl3, root, parent_lvl1, target, "language")
VALUES ('6fc6e', 'FAQ', 5, '-', '-', 'link', 'knowledgebase', 1, 'Public', '-', '-', '-', '-', NULL, 'english_EN');

--
-- Data for table public.#####topmenu (OID = 16775) (LIMIT 0,4)
--
INSERT INTO #####topmenu (uid, name, id, link, published, "access", "type", target, "language")
VALUES ('1fbae', 'Home', 0, 'frontpage', 1, 'Public', 'link', NULL, 'english_EN');

INSERT INTO #####topmenu (uid, name, id, link, published, "access", "type", target, "language")
VALUES ('3c6d9', 'News', 1, 'newsmanager', 1, 'Public', 'link', NULL, 'english_EN');

INSERT INTO #####topmenu (uid, name, id, link, published, "access", "type", target, "language")
VALUES ('9e502', 'Gallery', 2, 'imagegallery', 1, 'Public', 'link', NULL, 'english_EN');

INSERT INTO #####topmenu (uid, name, id, link, published, "access", "type", target, "language")
VALUES ('08db2', 'Contact Us', 3, 'contactform', 1, 'Public', 'link', NULL, 'english_EN');

--
-- Data for table public.#####userpage (OID = 16784) (LIMIT 0,1)
--
INSERT INTO #####userpage (uid, text_width, input_width, news_publish, image_publish, album_publish, cat_publish, pic_publish)
VALUES ('userpage', '150', '150', 1, 1, 1, 1, 1);

--
-- Data for table public.#####news_categories (OID = 16791) (LIMIT 0,1)
--
INSERT INTO #####news_categories (uid, name, "desc")
VALUES ('51fa1', 'Uncategorized', 'News without a category');

--
-- Data for table public.#####newsletter_items (OID = 16798) (LIMIT 0,2)
--
INSERT INTO #####newsletter_items (uid, email, "user")
VALUES ('223594', 'info@toenda.com', 'Mr. Toenda');

INSERT INTO #####newsletter_items (uid, email, "user")
VALUES ('f574da', 'info@toenda.com', 'Jonathan Naumann');

--
-- Data for table public.#####links (OID = 16822) (LIMIT 0,8)
--
INSERT INTO #####links (uid, "type", category, sort, name, link, published, target, rss, "access", "desc", module)
VALUES ('34dr567zhtzh876sgh48r68f44h5s8z4', 'l', 'sdf7sdf768sd7f78sdf6sd76fsdfsd7f', 0, 'Toenda Software Development', 'http://www.toenda.com', 1, '_blank', NULL, 'Public', 'Developer of toendaCMS', NULL);

INSERT INTO #####links (uid, "type", category, sort, name, link, published, target, rss, "access", "desc", module)
VALUES ('sdf7sdf768sd7f78sdf6sd76fsdfsd7f', 'c', NULL, 0, 'Toenda', NULL, 1, NULL, NULL, 'Public', 'Toenda Software Development Links', NULL);

INSERT INTO #####links (uid, "type", category, sort, name, link, published, target, rss, "access", "desc", module)
VALUES ('asdasdasdasdasd6786786as78d6as67', 'l', 'sdf7sdf768sd7f78sdf6sd76fsdfsd7f', 2, 'PHP.net', 'http://www.php.net', 1, '', '', 'Public', 'Officiell PHP webpage', NULL);

INSERT INTO #####links (uid, "type", category, sort, name, link, published, target, rss, "access", "desc", module)
VALUES ('50c3ef9ef90f608dd85ca31166b62e68', 'c', NULL, 1, 'Linux', '', 1, '', '', 'Public', 'Some Links about Linus free operating system', NULL);

INSERT INTO #####links (uid, "type", category, sort, name, link, published, target, rss, "access", "desc", module)
VALUES ('175b2bf8dd4a03d00038bb43ae06abf1', 'l', '50c3ef9ef90f608dd85ca31166b62e68', 0, 'Enlightenment', 'http://www.enlightenment.org', 1, '_blank', '', 'Public', 'The best Unix / Linux Window Manager', NULL);

INSERT INTO #####links (uid, "type", category, sort, name, link, published, target, rss, "access", "desc", module)
VALUES ('0ed410d081d20f1f5bac27566add3456', 'l', '50c3ef9ef90f608dd85ca31166b62e68', 1, 'Kernel.org', 'http://www.kernel.org', 1, '_blank', '', 'Public', 'The Linux Kernel Headquarter', NULL);

INSERT INTO #####links (uid, "type", category, sort, name, link, published, target, rss, "access", "desc", module)
VALUES ('d8f83e6e9acc6ad211104949db1285fd', 'l', 'sdf7sdf768sd7f78sdf6sd76fsdfsd7f', 3, 'vandango&#039;s weblog', 'http://vandango.toenda.com', 1, '', '', 'Public', 'toendaCMS maindeveloper weblog', NULL);

INSERT INTO #####links (uid, "type", category, sort, name, link, published, target, rss, "access", "desc", module)
VALUES ('dsf78578asdas7das76das7d67as67d6', 'l', 'sdf7sdf768sd7f78sdf6sd76fsdfsd7f', 1, 'toendaCMS Demosite', 'http://toendacms.toenda.com', 1, '', '', 'Public', 'The officiell toendaCMS Demosite.', NULL);

--
-- Data for table public.#####news_to_categories (OID = 16846) (LIMIT 0,2)
--
INSERT INTO #####news_to_categories (uid, news_uid, cat_uid)
VALUES ('841ce087c351998a2aa5cef1421f4701', '5a12397d95', '51fa1');

INSERT INTO #####news_to_categories (uid, news_uid, cat_uid)
VALUES ('e6d8b7005e5db3dbe8b7ec12aad1005c', 'b5c1575a93', '51fa1');

--
-- Data for table public.#####knowledgebase (OID = 16860) (LIMIT 0,3)
--
INSERT INTO #####knowledgebase (uid, category, parent, title, subtitle, content, image, "type", date, last_update, "access", autor, sort, publish_state)
VALUES ('b1a093575f', '', '', 'Base Category', 'A test category for the postgreSQL database', 'Lorem ipsum dolor sit amet,  consectetuer adipiscing elit,  sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam,  quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat,  vel illum dolore eu feugiat nulla facilisis at vero et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.', '', 'c', '13.03.2006-13:54', '13.03.2006-13:54', 'Public', 'gtdz87qw64qgahsdjkg789azwer8u0aw', 1, 2);

INSERT INTO #####knowledgebase (uid, category, parent, title, subtitle, content, image, "type", date, last_update, "access", autor, sort, publish_state)
VALUES ('d38a12ea64', '', '', 'Test entry', 'A test entry for the postgreSQL database', '&lt;p&gt;Lorem ipsum dolor sit amet,  consectetuer adipiscing elit,  sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam,  quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat,  vel illum dolore eu feugiat nulla facilisis at vero et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.&lt;/p&gt;&lt;p&gt;Lorem ipsum dolor sit amet,  consectetuer adipiscing elit,  sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam,  quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat,  vel illum dolore eu feugiat nulla facilisis at vero et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. &lt;br /&gt;&lt;/p&gt;', '', 'a', '13.03.2006-13:55', '13.03.2006-13:55', 'Public', 'gtdz87qw64qgahsdjkg789azwer8u0aw', 2, 2);

INSERT INTO #####knowledgebase (uid, category, parent, title, subtitle, content, image, "type", date, last_update, "access", autor, sort, publish_state)
VALUES ('5056adee72', 'b1a093575f', 'b1a093575f', 'Second test entry', 'A second test entry', '&lt;p&gt;Lorem ipsum dolor sit amet,  consectetuer adipiscing elit,  sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam,  quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat,  vel illum dolore eu feugiat nulla facilisis at vero et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.&lt;/p&gt;&lt;p&gt;Lorem ipsum dolor sit amet,  consectetuer adipiscing elit,  sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam,  quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat,  vel illum dolore eu feugiat nulla facilisis at vero et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. &lt;br /&gt;&lt;/p&gt;', '', 'a', '13.03.2006-13:55', '13.03.2006-13:56', 'Public', 'gtdz87qw64qgahsdjkg789azwer8u0aw', 3, 2);

--
-- Data for table public.#####knowledgebase_config (OID = 16865) (LIMIT 0,2)
--
INSERT INTO #####knowledgebase_config (uid, id, title, subtitle, text, enabled, autor_enabled, "access")
VALUES ('knowledgebase', 'knowledgebase', 'FAQs and Articles', 'A small knowledge database', 'Here you will find an example set of FAQs and Articles.', 1, 1, 'Public');

INSERT INTO #####knowledgebase_config (uid, id, title, subtitle, text, enabled, autor_enabled, "access")
VALUES ('knowledgebase', 'knowledgebase', 'FAQs and Articles', 'A small knowledge database', 'Here you will find an example set of FAQs and Articles.', 1, 1, 'Public');

--
-- Data for table public.#####usergroup (OID = 16870) (LIMIT 0,6)
--
INSERT INTO #####usergroup (uid, name, "right")
VALUES ('daf91e6be506252b897977537fa488c8', 'Developer', 0);

INSERT INTO #####usergroup (uid, name, "right")
VALUES ('8a318ecd72b639ceca72c87dbc6f241c', 'Administrator', 1);

INSERT INTO #####usergroup (uid, name, "right")
VALUES ('7f2a4a04ddeffc7caa029e289be712a1', 'Writer', 2);

INSERT INTO #####usergroup (uid, name, "right")
VALUES ('418aed8f001f0b88e36bc68013000794', 'Editor', 3);

INSERT INTO #####usergroup (uid, name, "right")
VALUES ('fcc0abe286b322744765b271c8ede1fd', 'Presenter', 4);

INSERT INTO #####usergroup (uid, name, "right")
VALUES ('c4e1aea1d163b0d3b3db90b667a2ba81', 'User', 5);

--
-- Data for table public.#####content_languages (OID = 16872) (LIMIT 0,1)
--
INSERT INTO #####content_languages (uid, content_uid, "language", title, "key", content00, content01, foot, autor, db_layout, "access", in_work, published)
VALUES ('ef980', '18e2a', 'germany_DE', 'Lizenzen', 'toendaCMS &amp; GNU General Public Lizenz', 'toendaCMS &amp; GNU General Public Lizenz
', '', '', 'root', 'db_content_image_right.php', 'Public', 1, 1);

--
-- Definition for index #####albums_pkey (OID = 16411) : 
--
ALTER TABLE ONLY #####albums
    ADD CONSTRAINT #####albums_pkey PRIMARY KEY (uid);
--
-- Definition for index #####log_pkey (OID = 16893) : 
--
ALTER TABLE ONLY #####log
    ADD CONSTRAINT #####log_pkey PRIMARY KEY (uid);
--
-- Comments
--
COMMENT ON SCHEMA public IS 'Standard public schema';
