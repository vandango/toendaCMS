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
-- Data for table public.#####products_config (OID = 16721) (LIMIT 0,1)
--
INSERT INTO #####products_config (uid, products_id, products_title, products_stamp, products_text, category_state, category_title, use_category_title, "language", show_price_only_users, startpagetitle, use_sidebar_categories, max_latest_products)
VALUES ('products', 'products', 'Products', 'Toenda Software Products', 'Our software products.', 'software', 'Product Categories', 1, 'english_EN', 0, '', 0, 10);

--
-- Data for table public.#####sidebar_extensions (OID = 16740) (LIMIT 0,1)
--
INSERT INTO #####sidebar_extensions (uid, sidemenu_title, sidemenu, sidebar_title, show_sidebar_title, sidebar, chooser_title, show_chooser_title, chooser, search_title, show_search_title, search_alignment, search_withbr, search, login_title, usermenu_title, login, nologin, reg_link, reg_user, reg_pass, login_user, usermenu, show_login_title, show_news_categories, search_withbutton, search_word, show_news_cat_amount, show_memberlist, lang)
VALUES ('sidebar_extensions', 'Sidemenu', 0, 'Sidebar', 1, 0, 'Showcase', 1, 0, 'Search', 0, 'left', 0, 1, 'Login', 'Usermenu', 1, 'No account yet?', 'Create one', 'Username', 'Password', 1, 1, 1, 1, 0, '', 1, 1, 'de;en;nl;');

--
-- Data for table public.#####userpage (OID = 16784) (LIMIT 0,1)
--
INSERT INTO #####userpage (uid, text_width, input_width, news_publish, image_publish, album_publish, cat_publish, pic_publish)
VALUES ('userpage', '150', '150', 1, 1, 1, 1, 1);

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
