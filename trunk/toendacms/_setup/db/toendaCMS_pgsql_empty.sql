-- SQL Manager 2005 Lite for PostgreSQL 3.5.0.1
-- ---------------------------------------
-- Host       : localhost
-- Datenbank  : tcms_blog
-- Version:   : PostgreSQL 8.0.3 on i686-pc-mingw32, compiled by GCC gcc.exe (GCC) 3.4.2 (mingw-special)


--
-- Structure for table tcms_albums (OID = 17254) : 
--
CREATE TABLE #####albums (
    uid character varying(12) DEFAULT ''::character varying NOT NULL,
    title character varying(255),
    album_id character varying(6) DEFAULT ''::character varying NOT NULL,
    published integer DEFAULT 0 NOT NULL,
    image character varying(255),
    "desc" text
);
--
-- Structure for table tcms_contactform (OID = 17262) : 
--
CREATE TABLE #####contactform (
    uid character varying(11) DEFAULT ''::character varying NOT NULL,
    contact character varying(255) DEFAULT ''::character varying NOT NULL,
    show_contacts_in_sidebar integer DEFAULT 0 NOT NULL,
    send_id character varying(11) DEFAULT ''::character varying NOT NULL,
    contacttitle character varying(255) DEFAULT ''::character varying NOT NULL,
    contactstamp character varying(255) DEFAULT ''::character varying NOT NULL,
    "access" character varying(10) DEFAULT ''::character varying NOT NULL,
    enabled integer,
    use_adressbook integer,
    use_contact integer,
    show_contactemail integer DEFAULT 0 NOT NULL
);
--
-- Structure for table tcms_contacts (OID = 17271) : 
--
CREATE TABLE #####contacts (
    uid character varying(10) DEFAULT ''::character varying NOT NULL,
    default_con integer DEFAULT 0 NOT NULL,
    published integer DEFAULT 0 NOT NULL,
    name character varying(255) DEFAULT ''::character varying NOT NULL,
    "position" character varying(255),
    email character varying(255) DEFAULT ''::character varying NOT NULL,
    street character varying(255),
    country character varying(255),
    state character varying(255),
    town character varying(255),
    postal integer,
    phone character varying(40),
    fax character varying(40)
);
--
-- Structure for table tcms_content (OID = 17278) : 
--
CREATE TABLE #####content (
    uid character varying(5) DEFAULT ''::character varying NOT NULL,
    title character varying(255),
    "key" character varying(255),
    content00 text,
    content01 text,
    foot character varying(255),
    db_layout character varying(50),
    "access" character varying(10) DEFAULT ''::character varying NOT NULL,
    published integer,
    in_work integer,
    autor character varying(255)
);
--
-- Structure for table tcms_downloads (OID = 17285) : 
--
CREATE TABLE #####downloads (
    uid character varying(10) DEFAULT ''::character varying NOT NULL,
    name character varying(255),
    date character varying(16) DEFAULT ''::character varying NOT NULL,
    "type" character varying(255) DEFAULT ''::character varying NOT NULL,
    sort integer,
    pub integer,
    "access" character varying(10),
    image character varying(255),
    file character varying(255),
    cat character varying(10),
    sql_type character(1) DEFAULT ''::bpchar NOT NULL,
    "desc" text,
    parent character varying(10),
    mirror integer
);
--
-- Structure for table tcms_downloads_config (OID = 17294) : 
--
CREATE TABLE #####downloads_config (
    uid character varying(8) DEFAULT ''::character varying NOT NULL,
    download_id character varying(8) DEFAULT ''::character varying NOT NULL,
    download_title character varying(255),
    download_stamp character varying(255),
    download_text text
);
--
-- Structure for table tcms_frontpage (OID = 17301) : 
--
CREATE TABLE #####frontpage (
    uid character varying(9) DEFAULT ''::character varying NOT NULL,
    front_id character varying(9) DEFAULT ''::character varying NOT NULL,
    front_title character varying(255),
    front_stamp character varying(255),
    front_text text,
    news_title character varying(255),
    news_cut integer DEFAULT 0 NOT NULL,
    module_use_0 integer DEFAULT 0 NOT NULL,
    sb_news_title character varying(255),
    sb_news_amount integer,
    sb_news_chars integer,
    sb_news_enabled integer,
    sb_news_display integer
);
--
-- Structure for table tcms_guestbook (OID = 17310) : 
--
CREATE TABLE #####guestbook (
    uid character varying(9) DEFAULT ''::character varying NOT NULL,
    guest_id character varying(9) DEFAULT ''::character varying,
    booktitle character varying(255) DEFAULT ''::character varying,
    bookstamp character varying(255) DEFAULT ''::character varying,
    "access" character varying(10) DEFAULT ''::character varying,
    enabled integer,
    clean_link integer DEFAULT 0 NOT NULL,
    clean_script integer DEFAULT 0 NOT NULL,
    convert_at integer DEFAULT 0 NOT NULL,
    show_email integer DEFAULT 0 NOT NULL,
    name_width character varying(4),
    text_width character varying(4),
    color_row_1 character varying(6),
    color_row_2 character varying(6)
);
--
-- Structure for table tcms_guestbook_items (OID = 17321) : 
--
CREATE TABLE #####guestbook_items (
    uid character varying(32) DEFAULT ''::character varying NOT NULL,
    name character varying(255),
    email character varying(255),
    text text,
    date character varying(8),
    "time" character varying(5)
);
--
-- Structure for table tcms_imagegallery (OID = 17327) : 
--
CREATE TABLE #####imagegallery (
    uid character varying(10) DEFAULT ''::character varying NOT NULL,
    album character varying(6) DEFAULT ''::character varying NOT NULL,
    image character varying(255) DEFAULT ''::character varying NOT NULL,
    text text,
    date character varying(14) DEFAULT ''::character varying NOT NULL
);
--
-- Structure for table tcms_imagegallery_config (OID = 17336) : 
--
CREATE TABLE #####imagegallery_config (
    uid character varying(12) DEFAULT ''::character varying NOT NULL,
    image_id character varying(12) DEFAULT ''::character varying NOT NULL,
    image_title character varying(255),
    image_stamp text,
    image_details integer DEFAULT 0 NOT NULL,
    use_comments integer DEFAULT 0 NOT NULL,
    "access" character varying(10) DEFAULT ''::character varying NOT NULL,
    max_image integer,
    needle_image character varying(255),
    show_lastimg integer,
    show_lastimg_title integer,
    align_image character varying(6),
    size_image integer,
    image_sort character varying(4),
    list_option integer
);
--
-- Structure for table tcms_impressum (OID = 17346) : 
--
CREATE TABLE #####impressum (
    uid character varying(9) DEFAULT ''::character varying NOT NULL,
    imp_id character varying(9) DEFAULT ''::character varying NOT NULL,
    imp_title character varying(255),
    imp_stamp character varying(255),
    imp_contact character varying(10) DEFAULT ''::character varying NOT NULL,
    taxno character varying(50),
    ustid character varying(50),
    legal text
);
--
-- Structure for table tcms_links_config (OID = 17354) : 
--
CREATE TABLE #####links_config (
    uid character varying(17) DEFAULT ''::character varying NOT NULL,
    link_use_side integer DEFAULT 0 NOT NULL,
    link_use_side_desc integer DEFAULT 0 NOT NULL,
    link_use_side_title integer DEFAULT 0 NOT NULL,
    link_side_title character varying(255),
    link_use_main_desc integer,
    link_main_title character varying(255),
    link_main_subtitle character varying(255),
    link_main_text text,
    link_main_access character varying(10)
);
--
-- Structure for table tcms_news (OID = 17363) : 
--
CREATE TABLE #####news (
    uid character varying(10) DEFAULT ''::character varying NOT NULL,
    title character varying(255),
    autor character varying(255) DEFAULT ''::character varying NOT NULL,
    date character varying(10) DEFAULT ''::character varying NOT NULL,
    "time" character varying(5) DEFAULT ''::character varying NOT NULL,
    newstext text,
    stamp bigint DEFAULT (0)::bigint NOT NULL,
    published integer DEFAULT 0 NOT NULL,
    publish_date character varying(16) DEFAULT ''::character varying NOT NULL,
    comments_enabled integer DEFAULT 1 NOT NULL,
    image character varying(255),
    category character varying(5) DEFAULT ''::character varying NOT NULL,
    "access" character varying(10) DEFAULT ''::character varying NOT NULL
);
--
-- Structure for table tcms_comments (OID = 17378) : 
--
CREATE TABLE #####comments (
    uid character varying(10) DEFAULT ''::character varying NOT NULL,
    "timestamp" character varying(14) DEFAULT ''::character varying NOT NULL,
    name character varying(255) DEFAULT ''::character varying NOT NULL,
    email character varying(255),
    web character varying(255),
    msg text,
    "time" character varying(14) DEFAULT ''::character varying NOT NULL,
    module character varying(5)
);
--
-- Structure for table tcms_newsletter (OID = 17387) : 
--
CREATE TABLE #####newsletter (
    uid character varying(10) DEFAULT ''::character varying NOT NULL,
    use_newsletter integer DEFAULT 0 NOT NULL,
    nl_title character varying(255) DEFAULT ''::character varying NOT NULL,
    nl_show_title integer DEFAULT 0 NOT NULL,
    nl_text character varying(255) DEFAULT ''::character varying NOT NULL,
    nl_link character varying(255) DEFAULT ''::character varying NOT NULL
);
--
-- Structure for table tcms_newsmanager (OID = 17395) : 
--
CREATE TABLE #####newsmanager (
    uid character varying(11) DEFAULT ''::character varying NOT NULL,
    news_id character varying(11) DEFAULT ''::character varying NOT NULL,
    news_title character varying(255),
    news_stamp character varying(255),
    news_image character varying(255),
    use_comments integer DEFAULT 0 NOT NULL,
    show_autor integer DEFAULT 0 NOT NULL,
    show_autor_as_link integer DEFAULT 0 NOT NULL,
    news_amount integer DEFAULT 0 NOT NULL,
    "access" character varying(10) DEFAULT ''::character varying NOT NULL,
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
    def_feed character varying(7),
    use_timesince integer,
    use_trackback integer
);
--
-- Structure for table tcms_notepad (OID = 17405) : 
--
CREATE TABLE #####notepad (
    uid character varying(32) DEFAULT ''::character varying NOT NULL,
    name character varying(200) DEFAULT ''::character varying NOT NULL,
    note text
);
--
-- Structure for table tcms_poll_config (OID = 17412) : 
--
CREATE TABLE #####poll_config (
    uid character varying(4) DEFAULT ''::character varying NOT NULL,
    poll_title character varying(30),
    allpoll_title character varying(30),
    show_poll_title integer DEFAULT 0 NOT NULL,
    use_poll_side integer DEFAULT 0 NOT NULL,
    poll_side_width integer DEFAULT 0 NOT NULL,
    poll_main_width integer DEFAULT 0 NOT NULL,
    poll_sm_title character varying(30),
    use_poll_sidemenu integer DEFAULT 0 NOT NULL,
    poll_sidemenu_id integer DEFAULT 0 NOT NULL,
    poll_tm_title character varying(30),
    use_poll_topmenu integer DEFAULT 0 NOT NULL,
    poll_topmenu_id integer DEFAULT 0 NOT NULL
);
--
-- Structure for table tcms_poll_items (OID = 17423) : 
--
CREATE TABLE #####poll_items (
    uid character varying(8) DEFAULT ''::character varying NOT NULL,
    poll_uid character varying(8) DEFAULT ''::character varying NOT NULL,
    ip character varying(15) DEFAULT ''::character varying NOT NULL,
    "domain" character varying(255) DEFAULT ''::character varying NOT NULL,
    answer integer DEFAULT 0 NOT NULL
);
--
-- Structure for table tcms_polls (OID = 17430) : 
--
CREATE TABLE #####polls (
    uid character varying(32) DEFAULT ''::character varying NOT NULL,
    title character varying(255) DEFAULT ''::character varying NOT NULL,
    question1 character varying(255),
    question2 character varying(255),
    question3 character varying(255),
    question4 character varying(255),
    question5 character varying(255),
    question6 character varying(255),
    question7 character varying(255),
    question8 character varying(255),
    question9 character varying(255),
    question10 character varying(255),
    question11 character varying(255),
    question12 character varying(255)
);
--
-- Structure for table tcms_products_config (OID = 17437) : 
--
CREATE TABLE #####products_config (
    uid character varying(8) DEFAULT ''::character varying NOT NULL,
    products_id character varying(8) DEFAULT ''::character varying NOT NULL,
    products_title character varying(255) DEFAULT ''::character varying NOT NULL,
    products_stamp character varying(255) DEFAULT ''::character varying NOT NULL,
    products_text text NOT NULL,
    category_state character varying(255) DEFAULT ''::character varying NOT NULL,
    category_title character varying(255) DEFAULT ''::character varying NOT NULL,
    use_category_title integer DEFAULT 0 NOT NULL
);
--
-- Structure for table tcms_sidebar (OID = 17449) : 
--
CREATE TABLE #####sidebar (
    uid character varying(32) DEFAULT ''::character varying NOT NULL,
    title character varying(255),
    "key" character varying(255),
    content text,
    foot character varying(255),
    id character varying(255) DEFAULT ''::character varying NOT NULL
);
--
-- Structure for table tcms_sidebar_extensions (OID = 17456) : 
--
CREATE TABLE #####sidebar_extensions (
    uid character varying(18) DEFAULT ''::character varying NOT NULL,
    sidemenu_title character varying(255),
    sidemenu integer DEFAULT 0 NOT NULL,
    sidebar_title character varying(255),
    show_sidebar_title integer DEFAULT 0 NOT NULL,
    sidebar integer DEFAULT 0 NOT NULL,
    chooser_title character varying(255),
    show_chooser_title integer DEFAULT 0 NOT NULL,
    chooser integer DEFAULT 0 NOT NULL,
    search_title character varying(255),
    show_search_title integer DEFAULT 0 NOT NULL,
    search_alignment character varying(10),
    search_withbr integer DEFAULT 0 NOT NULL,
    search integer DEFAULT 0 NOT NULL,
    login_title character varying(255),
    usermenu_title character varying(255),
    login integer DEFAULT 0 NOT NULL,
    nologin character varying(255),
    reg_link character varying(255),
    reg_user character varying(255),
    reg_pass character varying(255),
    login_user integer DEFAULT 0 NOT NULL,
    usermenu integer DEFAULT 0 NOT NULL,
    show_login_title integer DEFAULT 0 NOT NULL,
    show_news_categories integer DEFAULT 0 NOT NULL,
    search_withbutton integer,
    search_word character varying(255),
    show_news_cat_amount integer,
    show_memberlist integer
);
--
-- Structure for table tcms_sidemenu (OID = 17475) : 
--
CREATE TABLE #####sidemenu (
    uid character varying(5) DEFAULT ''::character varying NOT NULL,
    name character varying(255),
    id integer DEFAULT 0 NOT NULL,
    subid character(3) DEFAULT ''::bpchar NOT NULL,
    parent character(3) DEFAULT ''::bpchar NOT NULL,
    "type" character varying(10) DEFAULT ''::character varying NOT NULL,
    link character varying(255),
    published integer DEFAULT 0 NOT NULL,
    "access" character varying(10) DEFAULT ''::character varying NOT NULL,
    parent_lvl2 character varying(5) DEFAULT '-'::character varying,
    parent_lvl3 character varying(5) DEFAULT '-'::character varying,
    root character varying(5) DEFAULT '-'::character varying,
    parent_lvl1 character varying(5) DEFAULT '-'::character varying
);
--
-- Structure for table tcms_topmenu (OID = 17484) : 
--
CREATE TABLE #####topmenu (
    uid character varying(5) DEFAULT ''::character varying NOT NULL,
    name character varying(255),
    id integer DEFAULT 0 NOT NULL,
    link character varying(255),
    published integer DEFAULT 0 NOT NULL,
    "access" character varying(10) DEFAULT ''::character varying NOT NULL,
    "type" character varying(10)
);
--
-- Structure for table tcms_userpage (OID = 17490) : 
--
CREATE TABLE #####userpage (
    uid character varying(8) DEFAULT ''::character varying NOT NULL,
    text_width character varying(5),
    input_width character varying(5),
    news_publish integer DEFAULT 0 NOT NULL,
    image_publish integer DEFAULT 0 NOT NULL,
    album_publish integer DEFAULT 0 NOT NULL,
    cat_publish integer DEFAULT 0 NOT NULL,
    pic_publish integer
);
--
-- Structure for table tcms_news_categories (OID = 17497) : 
--
CREATE TABLE #####news_categories (
    uid character varying(5) DEFAULT ''::character varying NOT NULL,
    name character varying(255) DEFAULT ''::character varying NOT NULL,
    "desc" text
);
--
-- Structure for table tcms_newsletter_items (OID = 17504) : 
--
CREATE TABLE #####newsletter_items (
    uid character varying(6) DEFAULT ''::character varying NOT NULL,
    email character varying(255) DEFAULT ''::character varying NOT NULL,
    "user" character varying(255) NOT NULL
);
--
-- Structure for table tcms_products (OID = 17508) : 
--
CREATE TABLE #####products (
    uid character varying(32) DEFAULT ''::character varying NOT NULL,
    name character varying(255) DEFAULT ''::character varying NOT NULL,
    product_number character varying(255),
    factory character varying(255),
    factory_url character varying(255),
    category character varying(255) DEFAULT ''::character varying NOT NULL,
    image character varying(255),
    date character varying(16) DEFAULT ''::character varying NOT NULL,
    price character varying(50),
    price_tax character varying(50),
    status integer DEFAULT 0 NOT NULL,
    quantity bigint,
    weight character varying(50),
    sort integer DEFAULT 0 NOT NULL,
    "access" character varying(10),
    sql_type character(1) DEFAULT ''::bpchar NOT NULL,
    "desc" text
);
--
-- Structure for table tcms_session (OID = 17520) : 
--
CREATE TABLE #####session (
    uid character varying(32) DEFAULT ''::character varying NOT NULL,
    date character varying(20) DEFAULT ''::character varying NOT NULL,
    user_id character varying(32) DEFAULT ''::character varying NOT NULL,
    "user" character varying(255) NOT NULL
);
--
-- Structure for table tcms_links (OID = 17525) : 
--
CREATE TABLE #####links (
    uid character varying(32) DEFAULT ''::character varying NOT NULL,
    "type" character(1) DEFAULT 'l'::bpchar NOT NULL,
    category character varying(32),
    sort integer,
    name character varying(255),
    link character varying(255),
    published integer DEFAULT 0 NOT NULL,
    target character varying(20),
    rss character varying(255),
    "access" character varying(10) DEFAULT ''::character varying NOT NULL,
    "desc" text,
    module integer
);
--
-- Structure for table tcms_user (OID = 17534) : 
--
CREATE TABLE #####user (
    uid character varying(32) DEFAULT ''::character varying NOT NULL,
    name character varying(255) DEFAULT ''::character varying NOT NULL,
    username character varying(255) DEFAULT ''::character varying NOT NULL,
    "password" character varying(32) DEFAULT ''::character varying NOT NULL,
    email character varying(255) DEFAULT ''::character varying NOT NULL,
    join_date character varying(19) DEFAULT ''::character varying NOT NULL,
    birthday character varying(10),
    gender character varying(5) DEFAULT ''::character varying NOT NULL,
    occupation character varying(255),
    homepage character varying(255),
    icq character varying(20),
    aim character varying(20),
    yim character varying(20),
    msn character varying(20),
    enabled integer DEFAULT 0 NOT NULL,
    tcms_enabled integer DEFAULT 0 NOT NULL,
    static_value integer DEFAULT 0 NOT NULL,
    signature text,
    "location" character varying(255),
    hobby character varying(255),
    "group" character varying(32) NOT NULL,
    last_login character varying(19),
    skype character varying(100)
);
--
-- Structure for table tcms_news_to_categories (OID = 17549) : 
--
CREATE TABLE #####news_to_categories (
    uid character varying(32),
    news_uid character varying(10),
    cat_uid character varying(5)
);
--
-- Structure for table tcms_statistics (OID = 17551) : 
--
CREATE TABLE #####statistics (
    host character varying(255) NOT NULL,
    site_url character varying(255) NOT NULL,
    value integer,
    ip_uid character varying(32),
    referrer character varying(255),
    "timestamp" timestamp without time zone
);
--
-- Structure for table tcms_statistics_ip (OID = 17553) : 
--
CREATE TABLE #####statistics_ip (
    uid character varying(32) NOT NULL,
    ip character varying(15) NOT NULL,
    value integer
);
--
-- Structure for table tcms_statistics_os (OID = 17555) : 
--
CREATE TABLE #####statistics_os (
    uid character varying(32),
    browser character varying(255),
    os character varying(255),
    value integer
);
--
-- Structure for table tcms_knowledgebase (OID = 17557) : 
--
CREATE TABLE #####knowledgebase (
    uid character varying(10) NOT NULL,
    category character varying(10),
    parent character varying(10),
    title character varying(255),
    subtitle character varying(255),
    content text,
    image character varying(255),
    "type" character(1) NOT NULL,
    date character varying(16) NOT NULL,
    last_update character varying(16) NOT NULL,
    "access" character varying(10) NOT NULL,
    autor character varying(255) NOT NULL,
    sort integer NOT NULL,
    publish_state integer NOT NULL
);
--
-- Structure for table tcms_knowledgebase_config (OID = 17562) : 
--
CREATE TABLE #####knowledgebase_config (
    uid character varying(13) NOT NULL,
    id character varying(13) NOT NULL,
    title character varying(255),
    subtitle character varying(255),
    text text,
    enabled integer NOT NULL,
    autor_enabled integer NOT NULL,
    "access" character varying(10) NOT NULL
);
--
-- Structure for table tcms_usergroup (OID = 17872) : 
--
CREATE TABLE #####usergroup (
    uid character varying(32) NOT NULL,
    name character varying(25) NOT NULL,
    "right" integer NOT NULL
);
--
-- Data for blobs (OID = 17254) (LIMIT 0,1)
--
-- Data for blobs (OID = 17262) (LIMIT 0,1)
--
INSERT INTO #####contactform (uid, contact, show_contacts_in_sidebar, send_id, contacttitle, contactstamp, "access", enabled, use_adressbook, use_contact, show_contactemail) VALUES ('contactform', 'info@toenda.com', 0, 'contactform', 'Contact Us and ...', '... send us a message.', 'Public', 1, NULL, NULL, 0);
--
-- Data for blobs (OID = 17271) (LIMIT 0,1)
--
-- Data for blobs (OID = 17278) (LIMIT 0,1)
--
-- Data for blobs (OID = 17294) (LIMIT 0,1)
--
INSERT INTO #####downloads_config (uid, download_id, download_title, download_stamp, download_text) VALUES ('download', 'download', 'Downloads and Software', 'Toenda Software Downloads', '');
--
-- Data for blobs (OID = 17301) (LIMIT 0,1)
--
INSERT INTO #####frontpage (uid, front_id, front_title, front_stamp, front_text, news_title, news_cut, module_use_0, sb_news_title, sb_news_amount, sb_news_chars, sb_news_enabled, sb_news_display) VALUES ('frontpage', 'frontpage', 'Welcome to the Home of toendaCMS', 'Content Management and Weblogging System', 'Welcome to the Samplesite of the free Open-Source XML content management and weblogging system toendaCMS. It is for enterprise purposes on the web. It offers full flexibility and extendability while featuring an accomplished set of ready-made interfaces, function''s and modules.&lt;br /&gt;
This fronpagetext is completly formatted using toendaScript. Its a small stylesheet language.', 'Journal', 0, 5, NULL, NULL, NULL, NULL, NULL);
--
-- Data for blobs (OID = 17310) (LIMIT 0,1)
--
INSERT INTO #####guestbook (uid, guest_id, booktitle, bookstamp, "access", enabled, clean_link, clean_script, convert_at, show_email, name_width, text_width, color_row_1, color_row_2) VALUES ('guestbook', 'guestbook', 'Guestbook', 'Write me a comment', 'Public', 1, 1, 1, 1, 1, '140', '360', 'e8e7d7', 'cbcbb9');
--
-- Data for blobs (OID = 173
-- Data for blobs (OID = 17327) (LIMIT 0,3)
--
-- Data for blobs (OID = 17336) (LIMIT 0,1)
--
INSERT INTO #####imagegallery_config (uid, image_id, image_title, image_stamp, image_details, use_comments, "access", max_image, needle_image, show_lastimg, show_lastimg_title, align_image, size_image, image_sort, list_option) VALUES ('imagegallery', 'imagegallery', 'Imagegallery', 'Picture i like', 0, 1, 'Public', 3, 'Last uploaded', 1, 0, 'center', 80, 'desc', NULL);
--
-- Data for blobs (OID = 17346) (LIMIT 0,1)
--
-- Data for blobs (OID = 17354) (LIMIT 0,2)
--
INSERT INTO #####links_config (uid, link_use_side, link_use_side_desc, link_use_side_title, link_side_title, link_use_main_desc, link_main_title, link_main_subtitle, link_main_text, link_main_access) VALUES ('links_config_side', 1, 1, 1, 'Blogroll', NULL, NULL, NULL, NULL, NULL);
INSERT INTO #####links_config (uid, link_use_side, link_use_side_desc, link_use_side_title, link_side_title, link_use_main_desc, link_main_title, link_main_subtitle, link_main_text, link_main_access) VALUES ('links_config_main', 0, 0, 0, NULL, 1, 'myLinks', 'A list of all websites i like', '', 'Public');
--
-- Data for blobs (OID = 17363) (LIMIT 0,1)
--
INSERT INTO #####news (uid, title, autor, date, "time", newstext, stamp, published, publish_date, comments_enabled, image, category, "access") VALUES ('5a12397d95', 'Hello World', 'root', '20.06.2005', '00:14', '&lt;strong&gt;Lorem ipsum dolor&lt;/strong&gt; sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.&lt;br /&gt;{tcms_more}&lt;br /&gt; &lt;br /&gt; &lt;strong&gt;Lorem ipsum dolor&lt;/strong&gt; sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum.', 200506200014, 1, '20.06.2005-00:14', 1, '', 'erdf4', 'Public');
--
-- Data for blobs (OID = 17378) (LIMIT 0,1)
--
INSERT INTO #####comments (uid, "timestamp", name, email, web, msg, "time", module) VALUES ('5a12397d95', '20050907214203', 'vandango', 'vandango@toenda.com', 'http://vandango.toenda.com', 'Testmessage, you can delete me ...', '20050907214203', 'news');
--
-- Data for blobs (OID = 17387) (LIMIT 0,1)
--
INSERT INTO #####newsletter (uid, use_newsletter, nl_title, nl_show_title, nl_text, nl_link) VALUES ('newsletter', 0, 'Newsletter', 1, 'You want always know whats up, subscribe now!', 'Submit');
--
-- Data for blobs (OID = 17395) (LIMIT 0,1)
--
INSERT INTO #####newsmanager (uid, news_id, news_title, news_stamp, news_image, use_comments, show_autor, show_autor_as_link, news_amount, "access", news_cut, use_gravatar, use_emoticons, use_rss091, use_rss10, use_rss20, use_atom03, use_opml, syn_amount, use_syn_title, def_feed, use_timesince, use_trackback) VALUES ('newsmanager', 'newsmanager', 'News', 'Current', '', 1, 0, 1, 1, 'Public', 0, 1, 1, 1, 1, 1, 1, 1, 5, 1, 'RSS2.0', 0, 0);
--
-- Data for blobs (OID = 17412) (LIMIT 0,1)
--
INSERT INTO #####poll_config (uid, poll_title, allpoll_title, show_poll_title, use_poll_side, poll_side_width, poll_main_width, poll_sm_title, use_poll_sidemenu, poll_sidemenu_id, poll_tm_title, use_poll_topmenu, poll_topmenu_id) VALUES ('poll', 'Poll', 'All Polls', 1, 0, 80, 80, 'Poll', 0, 2, 'Poll', 0, 4);
--
-- Data for blobs (OID = 17430) (LIMIT 0,1)
--
INSERT INTO #####polls (uid, title, question1, question2, question3, question4, question5, question6, question7, question8, question9, question10, question11, question12) VALUES ('55e14459521dc337d62aabd241139a67', 'This toendaCMS installation was ....', 'Absolutely simple', 'Reasonably easy', 'Not straight-forward but I worked it out', 'I had to install extra server stuff', 'I had no idea and got my friend to do it', 'My dog ran away with the README ...', NULL, NULL, NULL, NULL, NULL, NULL);
--
-- Data for blobs (OID = 17437) (LIMIT 0,1)
--
INSERT INTO #####products_config (uid, products_id, products_title, products_stamp, products_text, category_state, category_title, use_category_title) VALUES ('products', 'products', 'Products', 'Toenda Software Products', 'Our software products.', 'software', 'Product Categories', 1);
--
-- Data for blobs (OID = 17449) (LIMIT 0,1)
--
INSERT INTO #####sidebar (uid, title, "key", content, foot, id) VALUES ('frontpage', 'Wenn ich gross bin', '', 'Ich bin nur ein kleiner Blindtext
Wenn ich gross bin, will ich Ulysses von James Joyce werden. Aber jetzt lohnt es sich noch nicht, mich weiterzulesen. Denn vorerst bin ich nur ein kleiner Blindtext.', '', 'frontpage');
--
-- Data for blobs (OID = 17456) (LIMIT 0,1)
--
INSERT INTO #####sidebar_extensions (uid, sidemenu_title, sidemenu, sidebar_title, show_sidebar_title, sidebar, chooser_title, show_chooser_title, chooser, search_title, show_search_title, search_alignment, search_withbr, search, login_title, usermenu_title, login, nologin, reg_link, reg_user, reg_pass, login_user, usermenu, show_login_title, show_news_categories, search_withbutton, search_word, show_news_cat_amount, show_memberlist) VALUES ('sidebar_extensions', 'Sidemenu', 0, 'Sidebar', 1, 0, 'Showcase', 1, 0, 'Search', 0, 'left', 0, 1, 'Login', 'Usermenu', 1, 'No account yet?', 'Create one', 'Username', 'Password', 1, 1, 1, 1, 0, '', 1, 1);
--
-- Data for blobs (OID = 17475) (LIMIT 0,6)
--
-- Data for blobs (OID = 17484) (LIMIT 0,4)
--
-- Data for blobs (OID = 17490) (LIMIT 0,1)
--
INSERT INTO #####userpage (uid, text_width, input_width, news_publish, image_publish, album_publish, cat_publish, pic_publish) VALUES ('userpage', '150', '150', 1, 1, 1, 1, NULL);
--
-- Data for blobs (OID = 17497) (LIMIT 0,1)
--
INSERT INTO #####news_categories (uid, name, "desc") VALUES ('51fa1', 'Uncategorized', 'News without a category');
--
-- Data for blobs (OID = 17504) (LIMIT 0,2)
--
-- Data for blobs (OID = 17520) (LIMIT 0,2)
--
-- Data for blobs (OID = 17525) (LIMIT 0,8)
--
-- Data for blobs (OID = 17534) (LIMIT 0,1)
--
INSERT INTO #####news_to_categories (uid, news_uid, cat_uid) VALUES ('fdbaa7c0a2a855806f0e464a78756a62', '5a12397d95', '51fa1');
--
-- Data for blobs (OID = 17557) (LIMIT 0,3)
--
INSERT INTO #####knowledgebase (uid, category, parent, title, subtitle, content, image, "type", date, last_update, "access", autor, sort, publish_state) VALUES ('b1a093575f', '', '', 'Base Category', 'A test category for the postgreSQL database', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.', '', 'c', '13.03.2006-13:54', '13.03.2006-13:54', 'Public', 'gtdz87qw64qgahsdjkg789azwer8u0aw', 1, 2);
INSERT INTO #####knowledgebase (uid, category, parent, title, subtitle, content, image, "type", date, last_update, "access", autor, sort, publish_state) VALUES ('d38a12ea64', '', '', 'Test entry', 'A test entry for the postgreSQL database', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.&lt;/p&gt;&lt;p&gt;Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. &lt;br /&gt;&lt;/p&gt;', '', 'a', '13.03.2006-13:55', '13.03.2006-13:55', 'Public', 'gtdz87qw64qgahsdjkg789azwer8u0aw', 2, 2);
INSERT INTO #####knowledgebase (uid, category, parent, title, subtitle, content, image, "type", date, last_update, "access", autor, sort, publish_state) VALUES ('5056adee72', 'b1a093575f', 'b1a093575f', 'Second test entry', 'A second test entry', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.&lt;/p&gt;&lt;p&gt;Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. &lt;br /&gt;&lt;/p&gt;', '', 'a', '13.03.2006-13:55', '13.03.2006-13:56', 'Public', 'gtdz87qw64qgahsdjkg789azwer8u0aw', 3, 2);
--
-- Data for blobs (OID = 17562) (LIMIT 0,2)
--
INSERT INTO #####knowledgebase_config (uid, id, title, subtitle, text, enabled, autor_enabled, "access") VALUES ('knowledgebase', 'knowledgebase', 'FAQs and Articles', 'A small knowledge database', 'Here you will find an example set of FAQs and Articles.', 1, 1, 'Public');
INSERT INTO #####knowledgebase_config (uid, id, title, subtitle, text, enabled, autor_enabled, "access") VALUES ('knowledgebase', 'knowledgebase', 'FAQs and Articles', 'A small knowledge database', 'Here you will find an example set of FAQs and Articles.', 1, 1, 'Public');
--
-- Data for blobs (OID = 17872) (LIMIT 0,6)
--
INSERT INTO #####usergroup (uid, name, "right") VALUES ('daf91e6be506252b897977537fa488c8', 'Developer', 0);
INSERT INTO #####usergroup (uid, name, "right") VALUES ('8a318ecd72b639ceca72c87dbc6f241c', 'Administrator', 1);
INSERT INTO #####usergroup (uid, name, "right") VALUES ('7f2a4a04ddeffc7caa029e289be712a1', 'Writer', 2);
INSERT INTO #####usergroup (uid, name, "right") VALUES ('418aed8f001f0b88e36bc68013000794', 'Editor', 3);
INSERT INTO #####usergroup (uid, name, "right") VALUES ('fcc0abe286b322744765b271c8ede1fd', 'Presenter', 4);
INSERT INTO #####usergroup (uid, name, "right") VALUES ('c4e1aea1d163b0d3b3db90b667a2ba81', 'User', 5);
--
-- Comments
--
COMMENT ON SCHEMA public IS 'Standard public schema';