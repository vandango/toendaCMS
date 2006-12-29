
CREATE TABLE [dbo].[#####comments](
	[uid] [varchar](10) NOT NULL DEFAULT (''),
	[module] [varchar](5) NOT NULL DEFAULT (''),
	[timestamp] [varchar](14) NOT NULL DEFAULT (''),
	[name] [varchar](255) NOT NULL DEFAULT (''),
	[email] [varchar](255) NULL DEFAULT (NULL),
	[web] [varchar](255) NULL DEFAULT (NULL),
	[msg] [text] NULL,
	[time] [varchar](14) NOT NULL DEFAULT (''),
	[ip] [varchar](15) NULL DEFAULT (NULL),
	[domain] [varchar](255) NULL DEFAULT (NULL),
 CONSTRAINT [PK_tcms_comments] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (IGNORE_DUP_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]


CREATE TABLE [dbo].[#####knowledgebase_config](
	[uid] [varchar](13) NOT NULL DEFAULT (''),
	[id] [varchar](13) NOT NULL DEFAULT (''),
	[title] [varchar](255) NULL DEFAULT (NULL),
	[subtitle] [varchar](255) NULL DEFAULT (NULL),
	[text] [text] NULL,
	[enabled] [int] NOT NULL DEFAULT ('0'),
	[autor_enabled] [int] NOT NULL DEFAULT ('0'),
	[access] [varchar](10) NOT NULL DEFAULT (''),
 CONSTRAINT [PK_tcms_knowledgebase_config] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (IGNORE_DUP_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]


CREATE TABLE [dbo].[#####products_config](
	[uid] [varchar](8) NOT NULL DEFAULT (''),
	[products_id] [varchar](8) NOT NULL DEFAULT (''),
	[products_title] [varchar](255) NOT NULL DEFAULT (''),
	[products_stamp] [varchar](255) NOT NULL DEFAULT (''),
	[products_text] [text] NOT NULL,
	[category_state] [varchar](255) NOT NULL DEFAULT (''),
	[category_title] [varchar](255) NOT NULL DEFAULT (''),
	[use_category_title] [int] NOT NULL DEFAULT ('0'),
 CONSTRAINT [PK_tcms_products_config] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (IGNORE_DUP_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]


CREATE TABLE [dbo].[#####contactform](
	[uid] [varchar](11) NOT NULL DEFAULT (''),
	[contact] [varchar](255) NOT NULL DEFAULT (''),
	[show_contacts_in_sidebar] [int] NOT NULL DEFAULT ('0'),
	[send_id] [varchar](11) NOT NULL DEFAULT (''),
	[contacttitle] [varchar](255) NOT NULL DEFAULT (''),
	[contactstamp] [varchar](255) NOT NULL DEFAULT (''),
	[access] [varchar](10) NOT NULL DEFAULT (''),
	[enabled] [int] NULL DEFAULT (NULL),
	[use_adressbook] [int] NULL DEFAULT (NULL),
	[use_contact] [int] NULL DEFAULT (NULL),
	[show_contactemail] [int] NOT NULL DEFAULT ((0)),
	[contacttext] [text] NOT NULL DEFAULT (''),
 CONSTRAINT [PK_tcms_contactform] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (IGNORE_DUP_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]


CREATE TABLE [dbo].[#####links](
	[uid] [varchar](32) NOT NULL DEFAULT (''),
	[type] [char](1) NOT NULL DEFAULT ('l'),
	[category] [varchar](32) NULL DEFAULT (NULL),
	[sort] [int] NULL DEFAULT (NULL),
	[name] [varchar](255) NULL DEFAULT (NULL),
	[desc] [text] NULL,
	[link] [varchar](255) NULL DEFAULT (NULL),
	[published] [int] NOT NULL DEFAULT ('0'),
	[target] [varchar](20) NULL DEFAULT (NULL),
	[rss] [varchar](255) NULL DEFAULT (NULL),
	[access] [varchar](10) NOT NULL DEFAULT (''),
	[module] [int] NULL DEFAULT (NULL),
 CONSTRAINT [PK_tcms_links] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (IGNORE_DUP_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]


CREATE TABLE [dbo].[#####session](
	[uid] [varchar](32) NOT NULL DEFAULT (''),
	[date] [varchar](20) NOT NULL DEFAULT (''),
	[user] [varchar](255) NOT NULL DEFAULT (''),
	[user_id] [varchar](32) NOT NULL DEFAULT (''),
 CONSTRAINT [PK_tcms_session] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (IGNORE_DUP_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]


CREATE TABLE [dbo].[#####sidebar](
	[uid] [varchar](32) NOT NULL DEFAULT (''),
	[title] [varchar](255) NULL DEFAULT (NULL),
	[key] [varchar](255) NULL DEFAULT (NULL),
	[content] [text] NULL,
	[foot] [varchar](255) NULL DEFAULT (NULL),
	[id] [varchar](255) NOT NULL DEFAULT (''),
 CONSTRAINT [PK_tcms_sidebar] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (IGNORE_DUP_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]


CREATE TABLE [dbo].[#####contacts](
	[uid] [varchar](10) NOT NULL DEFAULT (''),
	[default_con] [int] NOT NULL DEFAULT ('0'),
	[published] [int] NOT NULL DEFAULT ('0'),
	[name] [varchar](255) NOT NULL DEFAULT (''),
	[position] [varchar](255) NULL DEFAULT (NULL),
	[email] [varchar](255) NOT NULL DEFAULT (''),
	[street] [varchar](255) NULL DEFAULT (NULL),
	[country] [varchar](255) NULL DEFAULT (NULL),
	[state] [varchar](255) NULL DEFAULT (NULL),
	[town] [varchar](255) NULL DEFAULT (NULL),
	[postal] [int] NULL DEFAULT (NULL),
	[phone] [varchar](40) NULL DEFAULT (NULL),
	[fax] [varchar](40) NULL DEFAULT (NULL),
 CONSTRAINT [PK_tcms_contacts] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (IGNORE_DUP_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]


CREATE TABLE [dbo].[#####links_config](
	[uid] [varchar](17) NOT NULL DEFAULT (''),
	[link_use_side_desc] [int] NULL DEFAULT (NULL),
	[link_use_side_title] [int] NULL DEFAULT (NULL),
	[link_side_title] [varchar](255) NULL DEFAULT (NULL),
	[link_use_main_desc] [int] NULL DEFAULT (NULL),
	[link_main_title] [varchar](255) NULL DEFAULT (NULL),
	[link_main_subtitle] [varchar](255) NULL DEFAULT (NULL),
	[link_main_text] [text] NULL,
	[link_main_access] [varchar](10) NULL DEFAULT (NULL),
 CONSTRAINT [PK_tcms_links_config] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (IGNORE_DUP_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]


CREATE TABLE [dbo].[#####sidebar_extensions](
	[uid] [varchar](18) NOT NULL DEFAULT (''),
	[sidemenu_title] [varchar](255) NULL DEFAULT (NULL),
	[sidemenu] [int] NOT NULL DEFAULT ('0'),
	[sidebar_title] [varchar](255) NULL DEFAULT (NULL),
	[show_sidebar_title] [int] NOT NULL DEFAULT ('0'),
	[chooser_title] [varchar](255) NULL DEFAULT (NULL),
	[show_chooser_title] [int] NOT NULL DEFAULT ('0'),
	[search_title] [varchar](255) NULL DEFAULT (NULL),
	[show_search_title] [int] NOT NULL DEFAULT ('0'),
	[search_alignment] [varchar](10) NULL DEFAULT (NULL),
	[search_withbr] [int] NOT NULL DEFAULT ('0'),
	[search_withbutton] [int] NULL DEFAULT (NULL),
	[search_word] [varchar](255) NULL DEFAULT (NULL),
	[login_title] [varchar](255) NULL DEFAULT (NULL),
	[usermenu_title] [varchar](255) NULL DEFAULT (NULL),
	[nologin] [varchar](255) NULL DEFAULT (NULL),
	[reg_link] [varchar](255) NULL DEFAULT (NULL),
	[reg_user] [varchar](255) NULL DEFAULT (NULL),
	[reg_pass] [varchar](255) NULL DEFAULT (NULL),
	[login_user] [int] NOT NULL DEFAULT ('0'),
	[usermenu] [int] NOT NULL DEFAULT ('0'),
	[show_login_title] [int] NOT NULL DEFAULT ('0'),
	[show_news_cat_amount] [int] NULL DEFAULT ('0'),
	[show_memberlist] [int] NOT NULL DEFAULT ((0)),
 CONSTRAINT [PK_tcms_sidebar_extensions] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (IGNORE_DUP_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]


CREATE TABLE [dbo].[#####user](
	[uid] [varchar](32) NOT NULL CONSTRAINT [DF__tcms_user__uid__51EF2864]  DEFAULT (''),
	[name] [varchar](255) NOT NULL CONSTRAINT [DF__tcms_user__name__52E34C9D]  DEFAULT (''),
	[username] [varchar](255) NOT NULL CONSTRAINT [DF__tcms_user__usern__53D770D6]  DEFAULT (''),
	[password] [varchar](32) NOT NULL CONSTRAINT [DF__tcms_user__passw__54CB950F]  DEFAULT (''),
	[email] [varchar](255) NOT NULL CONSTRAINT [DF__tcms_user__email__55BFB948]  DEFAULT (''),
	[group] [varchar](32) NOT NULL CONSTRAINT [DF__tcms_user__group__56B3DD81]  DEFAULT (''),
	[join_date] [varchar](19) NOT NULL CONSTRAINT [DF__tcms_user__join___57A801BA]  DEFAULT (''),
	[last_login] [varchar](19) NULL CONSTRAINT [DF__tcms_user__last___589C25F3]  DEFAULT (NULL),
	[birthday] [varchar](10) NULL CONSTRAINT [DF__tcms_user__birth__59904A2C]  DEFAULT (NULL),
	[gender] [varchar](5) NOT NULL CONSTRAINT [DF__tcms_user__gende__5A846E65]  DEFAULT (''),
	[occupation] [varchar](255) NULL CONSTRAINT [DF__tcms_user__occup__5B78929E]  DEFAULT (NULL),
	[homepage] [varchar](255) NULL CONSTRAINT [DF__tcms_user__homep__5C6CB6D7]  DEFAULT (NULL),
	[icq] [varchar](20) NULL CONSTRAINT [DF__tcms_user__icq__5D60DB10]  DEFAULT (NULL),
	[aim] [varchar](20) NULL CONSTRAINT [DF__tcms_user__aim__5E54FF49]  DEFAULT (NULL),
	[yim] [varchar](20) NULL CONSTRAINT [DF__tcms_user__yim__5F492382]  DEFAULT (NULL),
	[msn] [varchar](20) NULL CONSTRAINT [DF__tcms_user__msn__603D47BB]  DEFAULT (NULL),
	[skype] [varchar](100) NULL CONSTRAINT [DF_tcms_user_skype]  DEFAULT (''),
	[enabled] [int] NOT NULL CONSTRAINT [DF__tcms_user__enabl__61316BF4]  DEFAULT ('0'),
	[tcms_enabled] [int] NOT NULL CONSTRAINT [DF__tcms_user__tcms___6225902D]  DEFAULT ('0'),
	[static_value] [int] NOT NULL CONSTRAINT [DF__tcms_user__stati__6319B466]  DEFAULT ('0'),
	[signature] [text] NULL,
	[location] [varchar](255) NULL CONSTRAINT [DF__tcms_user__locat__640DD89F]  DEFAULT (NULL),
	[hobby] [varchar](255) NULL CONSTRAINT [DF__tcms_user__hobby__6501FCD8]  DEFAULT (NULL),
 CONSTRAINT [PK_tcms_user] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (IGNORE_DUP_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]


CREATE TABLE [dbo].[#####news](
	[uid] [varchar](10) NOT NULL DEFAULT (''),
	[title] [varchar](255) NULL DEFAULT (NULL),
	[autor] [varchar](255) NOT NULL DEFAULT (''),
	[date] [varchar](10) NOT NULL DEFAULT (''),
	[time] [varchar](5) NOT NULL DEFAULT (''),
	[newstext] [text] NULL,
	[stamp] [float] NOT NULL DEFAULT ('0'),
	[published] [int] NOT NULL DEFAULT ('0'),
	[publish_date] [varchar](16) NOT NULL DEFAULT (''),
	[comments_enabled] [int] NOT NULL DEFAULT ('1'),
	[image] [varchar](255) NULL DEFAULT (NULL),
	[access] [varchar](10) NOT NULL DEFAULT (''),
PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (IGNORE_DUP_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]


CREATE TABLE [dbo].[#####content](
	[uid] [varchar](5) NOT NULL DEFAULT (''),
	[title] [varchar](255) NULL DEFAULT (NULL),
	[key] [varchar](255) NULL DEFAULT (NULL),
	[content00] [text] NULL,
	[content01] [text] NULL,
	[foot] [varchar](255) NULL DEFAULT (NULL),
	[db_layout] [varchar](50) NULL DEFAULT (NULL),
	[access] [varchar](10) NOT NULL DEFAULT (''),
	[in_work] [int] NOT NULL DEFAULT ('0'),
	[published] [int] NOT NULL DEFAULT ('0'),
	[autor] [varchar](255) NULL DEFAULT (NULL),
 CONSTRAINT [PK_tcms_content] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (IGNORE_DUP_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]


CREATE TABLE [dbo].[#####news_categories](
	[uid] [varchar](5) NOT NULL DEFAULT (''),
	[name] [varchar](255) NOT NULL DEFAULT (''),
	[desc] [text] NULL,
 CONSTRAINT [PK_tcms_news_categories] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (IGNORE_DUP_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]


CREATE TABLE [dbo].[#####news_to_categories](
	[uid] [varchar](5) NOT NULL DEFAULT (''),
	[news_uid] [varchar](10) NOT NULL DEFAULT (''),
	[cat_uid] [varchar](5) NOT NULL DEFAULT (''),
 CONSTRAINT [PK_tcms_news_to_categories] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (IGNORE_DUP_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]


CREATE TABLE [dbo].[#####sidemenu](
	[uid] [varchar](5) NOT NULL DEFAULT (''),
	[name] [varchar](255) NULL DEFAULT (NULL),
	[id] [int] NOT NULL DEFAULT ('0'),
	[subid] [char](3) NOT NULL DEFAULT (''),
	[parent] [char](3) NOT NULL DEFAULT (''),
	[type] [varchar](10) NOT NULL DEFAULT (''),
	[link] [varchar](255) NULL DEFAULT (NULL),
	[published] [int] NOT NULL DEFAULT ('0'),
	[access] [varchar](10) NOT NULL DEFAULT (''),
	[parent_lvl2] [varchar](5) NULL DEFAULT ('-'),
	[parent_lvl3] [varchar](5) NULL DEFAULT ('-'),
	[root] [varchar](5) NULL DEFAULT ('-'),
	[parent_lvl1] [varchar](5) NULL DEFAULT ('-'),
 CONSTRAINT [PK_tcms_sidemenu] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (IGNORE_DUP_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]


CREATE TABLE [dbo].[#####newsletter](
	[uid] [varchar](10) NOT NULL DEFAULT (''),
	[nl_title] [varchar](255) NOT NULL DEFAULT (''),
	[nl_show_title] [int] NOT NULL DEFAULT ('0'),
	[nl_text] [varchar](255) NOT NULL DEFAULT (''),
	[nl_link] [varchar](255) NOT NULL DEFAULT (''),
 CONSTRAINT [PK_tcms_newsletter] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (IGNORE_DUP_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]


CREATE TABLE [dbo].[#####newsletter_items](
	[uid] [varchar](6) NOT NULL DEFAULT (''),
	[user] [varchar](255) NOT NULL DEFAULT (''),
	[email] [varchar](255) NOT NULL DEFAULT (''),
 CONSTRAINT [PK_tcms_newsletter_items] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (IGNORE_DUP_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]


CREATE TABLE [dbo].[#####downloads_config](
	[uid] [varchar](8) NOT NULL DEFAULT (''),
	[download_id] [varchar](8) NOT NULL DEFAULT (''),
	[download_title] [varchar](255) NULL DEFAULT (NULL),
	[download_stamp] [varchar](255) NULL DEFAULT (NULL),
	[download_text] [text] NULL,
 CONSTRAINT [PK_tcms_downloads_config] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (IGNORE_DUP_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]


CREATE TABLE [dbo].[#####usergroup](
	[uid] [varchar](32) NOT NULL,
	[name] [varchar](25) NOT NULL,
	[right] [int] NOT NULL,
 CONSTRAINT [PK_tcms_usergroup] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (IGNORE_DUP_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]


CREATE TABLE [dbo].[#####statistics](
	[host] [varchar](255) NOT NULL DEFAULT (''),
	[site_url] [varchar](255) NOT NULL DEFAULT (''),
	[value] [int] NULL DEFAULT ('0'),
	[ip_uid] [varchar](32) NULL DEFAULT (NULL),
	[referrer] [varchar](255) NULL DEFAULT (NULL),
	[timestamp] [datetime] NULL DEFAULT (NULL)
) ON [PRIMARY]


CREATE TABLE [dbo].[#####newsmanager](
	[uid] [varchar](11) NOT NULL CONSTRAINT [DF__tcms_newsma__uid__3D2915A8]  DEFAULT (''),
	[news_id] [varchar](11) NOT NULL CONSTRAINT [DF__tcms_news__news___3E1D39E1]  DEFAULT (''),
	[news_title] [varchar](255) NULL CONSTRAINT [DF__tcms_news__news___3F115E1A]  DEFAULT (NULL),
	[news_stamp] [varchar](255) NULL CONSTRAINT [DF__tcms_news__news___40058253]  DEFAULT (NULL),
	[news_image] [varchar](255) NULL CONSTRAINT [DF__tcms_news__news___40F9A68C]  DEFAULT (NULL),
	[use_comments] [int] NOT NULL CONSTRAINT [DF__tcms_news__use_c__41EDCAC5]  DEFAULT ('0'),
	[show_autor] [int] NOT NULL CONSTRAINT [DF__tcms_news__show___42E1EEFE]  DEFAULT ('0'),
	[show_autor_as_link] [int] NOT NULL CONSTRAINT [DF__tcms_news__show___43D61337]  DEFAULT ('0'),
	[news_amount] [int] NOT NULL CONSTRAINT [DF__tcms_news__news___44CA3770]  DEFAULT ('0'),
	[access] [varchar](10) NOT NULL CONSTRAINT [DF__tcms_news__acces__45BE5BA9]  DEFAULT (''),
	[news_cut] [int] NOT NULL CONSTRAINT [DF__tcms_news__news___46B27FE2]  DEFAULT ('0'),
	[use_gravatar] [int] NOT NULL CONSTRAINT [DF__tcms_news__use_g__47A6A41B]  DEFAULT ('0'),
	[use_emoticons] [int] NOT NULL CONSTRAINT [DF__tcms_news__use_e__489AC854]  DEFAULT ('0'),
	[use_rss091] [int] NULL CONSTRAINT [DF__tcms_news__use_r__498EEC8D]  DEFAULT (NULL),
	[use_rss10] [int] NULL CONSTRAINT [DF__tcms_news__use_r__4A8310C6]  DEFAULT (NULL),
	[use_rss20] [int] NULL CONSTRAINT [DF__tcms_news__use_r__4B7734FF]  DEFAULT (NULL),
	[use_atom03] [int] NULL CONSTRAINT [DF__tcms_news__use_a__4C6B5938]  DEFAULT (NULL),
	[use_opml] [int] NULL CONSTRAINT [DF__tcms_news__use_o__4D5F7D71]  DEFAULT (NULL),
	[syn_amount] [int] NULL CONSTRAINT [DF__tcms_news__syn_a__4E53A1AA]  DEFAULT (NULL),
	[use_syn_title] [int] NULL CONSTRAINT [DF__tcms_news__use_s__4F47C5E3]  DEFAULT (NULL),
	[def_feed] [varchar](7) NULL CONSTRAINT [DF__tcms_news__def_f__503BEA1C]  DEFAULT (NULL),
	[use_trackback] [int] NULL CONSTRAINT [DF__tcms_news__use_t__51300E55]  DEFAULT (NULL),
	[use_timesince] [int] NOT NULL CONSTRAINT [DF__tcms_news__use_t__5224328E]  DEFAULT ('0'),
	[news_text] [text] NULL CONSTRAINT [DF__tcms_news__news___3AD6B8E2]  DEFAULT (''),
	[readmore_link] [int] NOT NULL CONSTRAINT [DF_tcms_newsmanager_readmore_link]  DEFAULT ((0)),
	[news_spacing] [int] NULL CONSTRAINT [DF_tcms_newsmanager_news_spacing]  DEFAULT ((0)),
 CONSTRAINT [PK_tcms_newsmanager] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (IGNORE_DUP_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]


CREATE TABLE [dbo].[#####frontpage](
	[uid] [varchar](9) NOT NULL DEFAULT (''),
	[front_id] [varchar](9) NOT NULL DEFAULT (''),
	[front_title] [varchar](255) NULL DEFAULT (NULL),
	[front_stamp] [varchar](255) NULL DEFAULT (NULL),
	[front_text] [text] NULL,
	[news_title] [varchar](255) NULL DEFAULT (NULL),
	[news_cut] [int] NOT NULL DEFAULT ('0'),
	[module_use_0] [int] NOT NULL DEFAULT ('0'),
	[sb_news_title] [varchar](255) NULL DEFAULT (NULL),
	[sb_news_amount] [int] NULL DEFAULT (NULL),
	[sb_news_chars] [int] NULL DEFAULT (NULL),
	[sb_news_enabled] [int] NOT NULL DEFAULT ('0'),
	[sb_news_display] [int] NOT NULL DEFAULT ('0'),
 CONSTRAINT [PK_tcms_frontpage] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (IGNORE_DUP_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]


CREATE TABLE [dbo].[#####statistics_ip](
	[uid] [varchar](32) NOT NULL DEFAULT (''),
	[ip] [varchar](15) NOT NULL DEFAULT (''),
	[value] [int] NULL DEFAULT (NULL),
 CONSTRAINT [PK_tcms_statistics_ip] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (IGNORE_DUP_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]


CREATE TABLE [dbo].[#####statistics_os](
	[uid] [varchar](32) NOT NULL DEFAULT (''),
	[browser] [varchar](255) NULL DEFAULT (NULL),
	[os] [varchar](255) NULL DEFAULT (NULL),
	[value] [int] NULL DEFAULT (NULL),
 CONSTRAINT [PK_tcms_statistics_os] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (IGNORE_DUP_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]


CREATE TABLE [dbo].[#####topmenu](
	[uid] [varchar](5) NOT NULL DEFAULT (''),
	[name] [varchar](255) NULL DEFAULT (NULL),
	[id] [int] NOT NULL DEFAULT ('0'),
	[type] [varchar](10) NULL DEFAULT (NULL),
	[link] [varchar](255) NULL DEFAULT (NULL),
	[published] [int] NOT NULL DEFAULT ('0'),
	[access] [varchar](10) NOT NULL DEFAULT (''),
 CONSTRAINT [PK_tcms_topmenu] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (IGNORE_DUP_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]


CREATE TABLE [dbo].[#####guestbook](
	[uid] [varchar](9) NOT NULL DEFAULT (''),
	[guest_id] [varchar](9) NULL DEFAULT (NULL),
	[booktitle] [varchar](255) NULL DEFAULT (NULL),
	[bookstamp] [varchar](255) NULL DEFAULT (NULL),
	[access] [varchar](10) NULL DEFAULT (NULL),
	[enabled] [int] NULL DEFAULT (NULL),
	[clean_link] [int] NOT NULL DEFAULT ('0'),
	[clean_script] [int] NOT NULL DEFAULT ('0'),
	[convert_at] [int] NOT NULL DEFAULT ('0'),
	[show_email] [int] NOT NULL DEFAULT ('0'),
	[name_width] [varchar](4) NULL DEFAULT (NULL),
	[text_width] [varchar](4) NULL DEFAULT (NULL),
	[color_row_1] [varchar](6) NULL DEFAULT (NULL),
	[color_row_2] [varchar](6) NULL DEFAULT (NULL),
 CONSTRAINT [PK_tcms_guestbook] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (IGNORE_DUP_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]


CREATE TABLE [dbo].[#####notepad](
	[uid] [varchar](32) NOT NULL DEFAULT (''),
	[name] [varchar](200) NOT NULL DEFAULT (''),
	[note] [text] NULL,
PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (IGNORE_DUP_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]


CREATE TABLE [dbo].[#####poll_config](
	[uid] [varchar](4) NOT NULL DEFAULT (''),
	[poll_title] [varchar](30) NULL DEFAULT (NULL),
	[allpoll_title] [varchar](30) NULL DEFAULT (NULL),
	[show_poll_title] [int] NOT NULL DEFAULT ('0'),
	[poll_side_width] [int] NOT NULL DEFAULT ('0'),
	[poll_main_width] [int] NOT NULL DEFAULT ('0'),
	[poll_sm_title] [varchar](30) NULL DEFAULT (NULL),
	[use_poll_sidemenu] [int] NOT NULL DEFAULT ('0'),
	[poll_sidemenu_id] [int] NOT NULL DEFAULT ('0'),
	[poll_tm_title] [varchar](30) NULL DEFAULT (NULL),
	[use_poll_topmenu] [int] NOT NULL DEFAULT ('0'),
	[poll_topmenu_id] [int] NOT NULL DEFAULT ('0'),
 CONSTRAINT [PK_tcms_poll_config] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (IGNORE_DUP_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]


CREATE TABLE [dbo].[#####guestbook_items](
	[uid] [varchar](32) NOT NULL DEFAULT (''),
	[name] [varchar](255) NULL DEFAULT (NULL),
	[email] [varchar](255) NULL DEFAULT (NULL),
	[text] [text] NULL,
	[date] [varchar](8) NULL DEFAULT (NULL),
	[time] [varchar](5) NULL DEFAULT (NULL),
 CONSTRAINT [PK_tcms_guestbook_items] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (IGNORE_DUP_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]


CREATE TABLE [dbo].[#####imagegallery](
	[uid] [varchar](10) NOT NULL DEFAULT (''),
	[album] [varchar](6) NOT NULL DEFAULT (''),
	[image] [varchar](255) NOT NULL DEFAULT (''),
	[text] [text] NULL,
	[date] [varchar](14) NOT NULL DEFAULT (''),
 CONSTRAINT [PK_tcms_imagegallery] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (IGNORE_DUP_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]


CREATE TABLE [dbo].[#####poll_items](
	[uid] [varchar](8) NOT NULL DEFAULT (''),
	[poll_uid] [varchar](32) NOT NULL DEFAULT (''),
	[ip] [varchar](15) NOT NULL DEFAULT (''),
	[domain] [varchar](255) NOT NULL DEFAULT (''),
	[answer] [int] NOT NULL DEFAULT ('0'),
 CONSTRAINT [PK_tcms_poll_items] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (IGNORE_DUP_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]


CREATE TABLE [dbo].[#####imagegallery_config](
	[uid] [varchar](12) NOT NULL DEFAULT (''),
	[image_id] [varchar](12) NOT NULL DEFAULT (''),
	[image_title] [varchar](255) NULL DEFAULT (NULL),
	[image_stamp] [text] NULL,
	[image_details] [int] NOT NULL DEFAULT ('0'),
	[use_comments] [int] NOT NULL DEFAULT ('0'),
	[access] [varchar](10) NOT NULL DEFAULT (''),
	[max_image] [int] NULL DEFAULT (NULL),
	[needle_image] [varchar](255) NULL DEFAULT (NULL),
	[show_lastimg_title] [int] NULL DEFAULT (NULL),
	[align_image] [varchar](6) NULL DEFAULT (NULL),
	[size_image] [int] NULL DEFAULT (NULL),
	[image_sort] [varchar](4) NOT NULL DEFAULT ('desc'),
	[list_option] [int] NOT NULL DEFAULT ((0)),
 CONSTRAINT [PK_tcms_imagegallery_config] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (IGNORE_DUP_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]


CREATE TABLE [dbo].[#####userpage](
	[uid] [varchar](8) NOT NULL DEFAULT (''),
	[text_width] [varchar](5) NULL DEFAULT (NULL),
	[input_width] [varchar](5) NULL DEFAULT (NULL),
	[news_publish] [int] NOT NULL DEFAULT ('0'),
	[image_publish] [int] NOT NULL DEFAULT ('0'),
	[album_publish] [int] NOT NULL DEFAULT ('0'),
	[cat_publish] [int] NOT NULL DEFAULT ('0'),
	[pic_publish] [char](1) NULL DEFAULT (NULL),
 CONSTRAINT [PK_tcms_userpage] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (IGNORE_DUP_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]


CREATE TABLE [dbo].[#####polls](
	[uid] [varchar](32) NOT NULL DEFAULT (''),
	[title] [varchar](255) NOT NULL DEFAULT (''),
	[question1] [varchar](255) NULL DEFAULT (NULL),
	[question2] [varchar](255) NULL DEFAULT (NULL),
	[question3] [varchar](255) NULL DEFAULT (NULL),
	[question4] [varchar](255) NULL DEFAULT (NULL),
	[question5] [varchar](255) NULL DEFAULT (NULL),
	[question6] [varchar](255) NULL DEFAULT (NULL),
	[question7] [varchar](255) NULL DEFAULT (NULL),
	[question8] [varchar](255) NULL DEFAULT (NULL),
	[question9] [varchar](255) NULL DEFAULT (NULL),
	[question10] [varchar](255) NULL DEFAULT (NULL),
	[question11] [varchar](255) NULL DEFAULT (NULL),
	[question12] [varchar](255) NULL DEFAULT (NULL),
 CONSTRAINT [PK_tcms_polls] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (IGNORE_DUP_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]


CREATE TABLE [dbo].[#####impressum](
	[uid] [varchar](9) NOT NULL DEFAULT (''),
	[imp_id] [varchar](9) NOT NULL DEFAULT (''),
	[imp_title] [varchar](255) NULL DEFAULT (NULL),
	[imp_stamp] [varchar](255) NULL DEFAULT (NULL),
	[imp_contact] [varchar](10) NOT NULL DEFAULT (''),
	[taxno] [varchar](50) NULL DEFAULT (NULL),
	[ustid] [varchar](50) NULL DEFAULT (NULL),
	[legal] [text] NULL,
 CONSTRAINT [PK_tcms_impressum] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (IGNORE_DUP_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]


CREATE TABLE [dbo].[#####knowledgebase](
	[uid] [varchar](10) NOT NULL DEFAULT (''),
	[category] [varchar](10) NULL DEFAULT (NULL),
	[parent] [varchar](10) NULL DEFAULT (NULL),
	[title] [varchar](255) NULL DEFAULT (NULL),
	[subtitle] [varchar](255) NULL DEFAULT (NULL),
	[content] [text] NULL,
	[image] [varchar](255) NULL DEFAULT (NULL),
	[type] [char](1) NOT NULL DEFAULT (''),
	[date] [varchar](16) NOT NULL DEFAULT (''),
	[last_update] [varchar](16) NOT NULL DEFAULT (''),
	[access] [varchar](10) NOT NULL DEFAULT (''),
	[autor] [varchar](32) NOT NULL DEFAULT (''),
	[sort] [int] NOT NULL DEFAULT ('0'),
	[publish_state] [int] NOT NULL DEFAULT ('0'),
 CONSTRAINT [PK_tcms_knowledgebase] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (IGNORE_DUP_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]


CREATE TABLE [dbo].[#####products](
	[uid] [varchar](32) NOT NULL DEFAULT (''),
	[name] [varchar](255) NOT NULL DEFAULT (''),
	[product_number] [varchar](255) NULL DEFAULT (NULL),
	[factory] [varchar](255) NULL DEFAULT (NULL),
	[factory_url] [varchar](255) NULL DEFAULT (NULL),
	[desc] [text] NULL,
	[category] [varchar](255) NOT NULL DEFAULT (''),
	[image] [varchar](255) NULL DEFAULT (NULL),
	[date] [varchar](16) NOT NULL DEFAULT (''),
	[price] [varchar](50) NULL DEFAULT (NULL),
	[price_tax] [varchar](50) NULL DEFAULT (NULL),
	[status] [int] NOT NULL DEFAULT ('0'),
	[quantity] [int] NULL DEFAULT (NULL),
	[weight] [varchar](50) NULL DEFAULT (NULL),
	[sort] [int] NOT NULL DEFAULT ('0'),
	[access] [varchar](10) NULL DEFAULT (NULL),
	[sql_type] [char](1) NOT NULL DEFAULT (''),
 CONSTRAINT [PK_tcms_products] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (IGNORE_DUP_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]


CREATE TABLE [dbo].[#####downloads](
	[uid] [varchar](10) NOT NULL CONSTRAINT [DF__tcms_downlo__uid__2D27B809]  DEFAULT (''),
	[name] [varchar](255) NULL CONSTRAINT [DF__tcms_downl__name__2E1BDC42]  DEFAULT (NULL),
	[date] [varchar](16) NOT NULL CONSTRAINT [DF__tcms_downl__date__2F10007B]  DEFAULT (''),
	[desc] [text] NULL,
	[type] [varchar](255) NOT NULL CONSTRAINT [DF__tcms_downl__type__300424B4]  DEFAULT (''),
	[sort] [int] NULL CONSTRAINT [DF__tcms_downl__sort__30F848ED]  DEFAULT (NULL),
	[mirror] [int] NOT NULL,
	[pub] [int] NULL CONSTRAINT [DF__tcms_downlo__pub__32E0915F]  DEFAULT (NULL),
	[access] [varchar](10) NULL CONSTRAINT [DF__tcms_down__acces__33D4B598]  DEFAULT (NULL),
	[image] [varchar](255) NULL CONSTRAINT [DF__tcms_down__image__34C8D9D1]  DEFAULT (NULL),
	[file] [varchar](255) NULL CONSTRAINT [DF__tcms_downl__file__35BCFE0A]  DEFAULT (NULL),
	[cat] [varchar](10) NULL CONSTRAINT [DF__tcms_downlo__cat__36B12243]  DEFAULT (NULL),
	[sql_type] [char](1) NOT NULL CONSTRAINT [DF__tcms_down__sql_t__37A5467C]  DEFAULT (''),
	[parent] [varchar](10) NULL,
 CONSTRAINT [PK_tcms_downloads] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (IGNORE_DUP_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]


CREATE TABLE [dbo].[#####albums](
	[uid] [varchar](12) NOT NULL DEFAULT (''),
	[title] [varchar](255) NULL DEFAULT (NULL),
	[album_id] [varchar](6) NOT NULL DEFAULT (''),
	[published] [int] NOT NULL DEFAULT ('0'),
	[desc] [text] NULL,
	[image] [varchar](255) NULL DEFAULT (NULL),
 CONSTRAINT [PK_tcms_albums] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (IGNORE_DUP_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]


INSERT INTO [dbo].[#####albums] ([uid], [title], [album_id], [published], [desc], [image])
VALUES ('051059625106', 'Wallpaper', '625106', 1, 'Some wallpaper for your desktop.', 'Hillside.jpg')


INSERT INTO [dbo].[#####content] ([uid], [title], [key], [content00], [content01], [foot], [db_layout], [access], [in_work], [published], [autor])
VALUES ('18e2a', 'License', 'toendaCMS &amp; GNU General Public License', '&lt;div align__________&quot;center&quot;&gt;&lt;strong&gt;GNU General Public License&lt;/strong&gt;&lt;/div&gt; &lt;div align__________&quot;center&quot;&gt;     &lt;em&gt;Version 2, June 1991&lt;/em&gt;     1989, 1991 Free Software Foundation, Inc. &lt;br /&gt;  Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA, 02111-1307, USA &lt;br /&gt;  Everyone is permitted to copy and distribute verbatim copies of this license document, but changing it is not allowed. &lt;br /&gt;  Version 2, June 1991&lt;/div&gt; &lt;br /&gt; &lt;h2&gt;GNU General Public License&lt;/h2&gt; &lt;br /&gt; &lt;p&gt;&lt;img src__________&quot;/toendacms/data/images/Image/osi-certified-120x100.png&quot; border__________&quot;0&quot; alt__________&quot;osi-certified-120x100.png&quot; title__________&quot;osi-certified-120x100.png&quot; align__________&quot;left&quot; /&gt;&lt;strong&gt;Preamble&lt;/strong&gt; The licenses for most software are designed to take away your freedom to share and change it. By contrast, the GNU General Public License is [int]ended to guarantee your freedom to share and changefree software - to make sure the software is free for all its users. This General Public License applies to most of the Free Software Foundation&amp;#39;s software and to any other program whose authors commit to using it. (Some other Free Software Foundation software is covered by the GNU Library General Public License instead.) You can apply it to your programs, too. &lt;br /&gt;  &lt;br /&gt;  When we speak of free software, we are referring to freedom, not price. Our General Public Licenses are designed to make sure that you have the freedom to distribute copies of free software (and charge for this service if you wish), that you receive source code or can get it if you want it, that you can change the software or use pieces of it in new free programs; and that you know you can do these things. &lt;br /&gt;  &lt;br /&gt;  To protect your rights, we need to make restrictions that forbid anyone to deny you these rights or to ask you to surrender the rights. These restrictions translate to certain responsibilities for you if you distribute copies of the software, or if you modify it. &lt;br /&gt;  &lt;br /&gt;  For example, if you distribute copies of such a program, whether gratis or for a fee, you must give the recipients all the rights that you have. You must make sure that they, too, receive or can get the source code. And you must show them these terms so they know their rights. &lt;br /&gt;  &lt;br /&gt;  We protect your rights with two steps: &lt;br /&gt;  &lt;/p&gt; &lt;ul&gt;     &lt;li&gt;copyright the software, and&lt;/li&gt;     &lt;li&gt;offer you this license which gives you legal permission to copy, distribute and/or modify the software.&lt;/li&gt; &lt;/ul&gt; Also, for each author&amp;#39;s protection and ours, we want to make certain that everyone understands that there is no warranty for this free software. If the software is modified by someone else and passed on, we want its recipients to know that what they have is not the original, so that any problems [int]roduced by others will not reflect on the original authors&amp;#39; reputations. &lt;br /&gt;  &lt;br /&gt;  Finally, any free program is threatened constantly by software patents. We wish to avoid the danger that redistributors of a free program will individually obtain patent licenses, in effect making the program proprietary. To prevent this, we have made it clear that any patent must be licensed for everyone&amp;#39;s free use or not licensed at all. &lt;br /&gt;  &lt;br /&gt;  The precise terms and conditions for copying, distribution and modification follow. &lt;br /&gt;  {tcms_more}&lt;br /&gt;  &lt;strong&gt;TERMS AND CONDITIONS FOR COPYING, DISTRIBUTION AND MODIFICATION&lt;/strong&gt;    &lt;strong&gt;Section 0&lt;/strong&gt; This License applies to any program or other work which contains a notice placed by the copyright holder saying it may be distributed under the terms of this General Public License. The &quot;Program&quot;, below, refers to any such program or work, and a work based on the Program means either the Program or any derivative work under copyright law: that is to say, a work containing the Program or a portion of it, either verbatim or with modifications and/or translated INTO another language. (Hereinafter, translation is included without limitation in the term modification .) Each licensee is addressed as you. &lt;br /&gt;  &lt;br /&gt;  Activities other than copying, distribution and modification are not covered by this License; they are outside its scope. The act of running the Program is not restricted, and the output from the Program is covered only if its contents constitute a work based on the Program (independent of having been made by running the Program). Whether that is true depends on what the Program does. &lt;br /&gt;  &lt;br /&gt;  &lt;strong&gt;Section 1&lt;/strong&gt; You may copy and distribute verbatim copies of the Program&amp;#39;s source code as you receive it, in any medium, provided that you conspicuously and appropriately publish on each copy an appropriate copyright notice and disclaimer of warranty; keep [int]act all the notices that refer to this License and to the absence of any warranty; and give any other recipients of the Program a copy of this License along with the Program. &lt;br /&gt;  &lt;br /&gt;  You may charge a fee for the physical act of transferring a copy, and you may at your option offer warranty protection in exchange for a fee. &lt;br /&gt;  &lt;br /&gt;  &lt;strong&gt;Section 2&lt;/strong&gt; You may modify your copy or copies of the Program or any portion of it, thus forming a work based on the Program, and copy and distribute such modifications or work under the terms of Section 1 above, provided that you also meet all of these conditions: &lt;br /&gt;  &lt;br /&gt;  You must cause the modified files to carry prominent notices stating that you changed the files and the date of any change. &lt;br /&gt;  &lt;br /&gt;  You must cause any work that you distribute or publish, that in whole or in part contains or is derived from the Program or any part thereof, to be licensed as a whole at no charge to all third parties under the terms of this License. &lt;br /&gt;  &lt;br /&gt;  If the modified program normally reads commands [int]eractively when run, you must cause it, when started running for such [int]eractive use in the most ordinary way, to pr[int] or display an announcement including an appropriate copyright notice and a notice that there is no warranty (or else, saying that you provide a warranty) and that users may redistribute the program under these conditions, and telling the user how to view a copy of this License. &lt;br /&gt;  &lt;br /&gt;  Exception: &lt;br /&gt;  &lt;br /&gt;  If the Program itself is [int]eractive but does not normally pr[int] such an announcement, your work based on the Program is not required to pr[int] an announcement.) &lt;br /&gt;  &lt;br /&gt;  These requirements apply to the modified work as a whole. If identifiable sections of that work are not derived from the Program, and can be reasonably considered independent and separate works in themselves, then this License, and its terms, do not apply to those sections when you distribute them as separate works. But when you distribute the same sections as part of a whole which is a work based on the Program, the distribution of the whole must be on the terms of this License, whose permissions for other licensees extend to the entire whole, and thus to each and every part regardless of who wrote it. &lt;br /&gt;  &lt;br /&gt;  Thus, it is not the [int]ent of this section to claim rights or contest your rights to work written entirely by you; rather, the [int]ent is to exercise the right to control the distribution of derivative or collective works based on the Program. &lt;br /&gt;  &lt;br /&gt;  In addition, mere aggregation of another work not based on the Program with the Program (or with a work based on the Program) on a volume of a storage or distribution medium does not bring the other work under the scope of this License. &lt;br /&gt;  &lt;br /&gt;  &lt;strong&gt;Section 3&lt;/strong&gt; You may copy and distribute the Program (or a work based on it, under Section 2 in object code or executable form under the terms of Sections 1 and 2 above provided that you also do one of the following: &lt;br /&gt;  &lt;br /&gt;  Accompany it with the complete corresponding machine-readable source code, which must be distributed under the terms of Sections 1 and 2 above on a medium customarily used for software [int]erchange; or, &lt;br /&gt;  &lt;br /&gt;  Accompany it with a written offer, valid for at least three years, to give any third party, for a charge no more than your cost of physically performing source distribution, a complete machine-readable copy of the corresponding source code, to be distributed under the terms of Sections 1 and 2 above on a medium customarily used for software [int]erchange; or, &lt;br /&gt;  &lt;br /&gt;  Accompany it with the information you received as to the offer to distribute corresponding source code. (This alternative is allowed only for noncommercial distribution and only if you received the program in object code or executable form with such an offer, in accord with Subsection b above.) &lt;br /&gt;  &lt;br /&gt;  The source code for a work means the preferred form of the work for making modifications to it. For an executable work, complete source code means all the source code for all modules it contains, plus any associated [int]erface definition files, plus the scripts used to control compilation and installation of the executable. However, as a special exception, the source code distributed need not include anything that is normally distributed (in either source or binary form) with the major components (compiler, kernel, and so on) of the operating system on which the executable runs, unless that component itself accompanies the executable. &lt;br /&gt;  &lt;br /&gt;  If distribution of executable or object code is made by offering access to copy from a designated place, then offering equivalent access to copy the source code from the same place counts as distribution of the source code, even though third parties are not compelled to copy the source along with the object code. &lt;br /&gt;  &lt;br /&gt;  &lt;strong&gt;Section 4&lt;/strong&gt; You may not copy, modify, sublicense, or distribute the Program except as expressly provided under this License. Any attempt otherwise to copy, modify, sublicense or distribute the Program is void, and will automatically terminate your rights under this License. However, parties who have received copies, or rights, from you under this License will not have their licenses terminated so long as such parties remain in full compliance. &lt;br /&gt;  &lt;br /&gt;  &lt;strong&gt;Section 5&lt;/strong&gt; You are not required to accept this License, since you have not signed it. However, nothing else grants you permission to modify or distribute the Program or its derivative works. These actions are prohibited by law if you do not accept this License. Therefore, by modifying or distributing the Program (or any work based on the Program), you indicate your acceptance of this License to do so, and all its terms and conditions for copying, distributing or modifying the Program or works based on it. &lt;br /&gt;  &lt;br /&gt;  &lt;strong&gt;Section 6&lt;/strong&gt; Each time you redistribute the Program (or any work based on the Program), the recipient automatically receives a license from the original licensor to copy, distribute or modify the Program subject to these terms and conditions. You may not impose any further restrictions on the recipients&amp;#39; exercise of the rights granted herein. You are not responsible for enforcing compliance by third parties to this License. &lt;br /&gt;  {tcms_more}&lt;br /&gt;  &lt;strong&gt;Section 7&lt;/strong&gt; If, as a consequence of a court judgment or allegation of patent infringement or for any other reason (not limited to patent issues), conditions are imposed on you (whether by court order, agreement or otherwise) that contradict the conditions of this License, they do not excuse you from the conditions of this License. If you cannot distribute so as to satisfy simultaneously your obligations under this License and any other pertinent obligations, then as a consequence you may not distribute the Program at all. For example, if a patent license would not permit royalty-free redistribution of the Program by all those who receive copies directly or indirectly through you, then the only way you could satisfy both it and this License would be to refrain entirely from distribution of the Program. If any portion of this section is held invalid or unenforceable under any particular circumstance, the balance of the section is [int]ended to apply and the section as a whole is [int]ended to apply in other circumstances. It is not the purpose of this section to induce you to infringe any patents or other property right claims or to contest validity of any such claims; this section has the sole purpose of protecting the [int]egrity of the free software distribution system, which is implemented by public license practices. Many people have made generous contributions to the wide range of software distributed through that system in reliance on consistent application of that system; it is up to the author/donor to decide if he or she is willing to distribute software through any other system and a licensee cannot impose that choice. This section is [int]ended to make thoroughly clear what is believed to be a consequence of the rest of this License. &lt;br /&gt;  &lt;br /&gt;  &lt;strong&gt;Section 8&lt;/strong&gt; If the distribution and/or use of the Program is restricted in certain countries either by patents or by copyrighted [int]erfaces, the original copyright holder who places the Program under this License may add an explicit geographical distribution limitation excluding those countries, so that distribution is permitted only in or among countries not thus excluded. In such case, this License incorporates the limitation as if written in the body of this License. &lt;br /&gt;  &lt;br /&gt;  &lt;strong&gt;Section 9&lt;/strong&gt; The Free Software Foundation may publish revised and/or new versions of the General Public License from time to time. Such new versions will be similar in spirit to the present version, but may differ in detail to address new problems or concerns. Each version is given a distinguishing version number. If the Program specifies a version number of this License which applies to it and &quot;any later version&quot;, you have the option of following the terms and conditions either of that version or of any later version published by the Free Software Foundation. If the Program does not specify a version number of this License, you may choose any version ever published by the Free Software Foundation. &lt;br /&gt;  &lt;br /&gt;  &lt;strong&gt;Section 10&lt;/strong&gt; If you wish to incorporate parts of the Program INTO other free programs whose distribution conditions are different, write to the author to ask for permission. For software which is copyrighted by the Free Software Foundation, write to the Free Software Foundation; we sometimes make exceptions for this. Our decision will be guided by the two goals of preserving the free status of all derivatives of our free software and of promoting the sharing and reuse of software generally. &lt;br /&gt;  &lt;br /&gt;  &lt;strong&gt;NO WARRANTY Section 11&lt;/strong&gt; BECAUSE THE PROGRAM IS LICENSED FREE OF CHARGE, THERE IS NO WARRANTY FOR THE PROGRAM, TO THE EXTENT PERMITTED BY APPLICABLE LAW. EXCEPT WHEN OTHERWISE STATED IN WRITING THE COPYRIGHT HOLDERS AND/OR OTHER PARTIES PROVIDE THE PROGRAM &quot;AS IS&quot; WITHOUT WARRANTY OF ANY KIND, EITHER EXPRESSED OR IMPLIED, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE. THE ENTIRE RISK AS TO THE QUALITY AND PERFORMANCE OF THE PROGRAM IS WITH YOU. SHOULD THE PROGRAM PROVE DEFECTIVE, YOU ASSUME THE COST OF ALL NECESSARY SERVICING, REPAIR OR CORRECTION. &lt;br /&gt;  &lt;br /&gt;  &lt;strong&gt;Section 12&lt;/strong&gt; IN NO EVENT UNLESS REQUIRED BY APPLICABLE LAW OR AGREED TO IN WRITING WILL ANY COPYRIGHT HOLDER, OR ANY OTHER PARTY WHO MAY MODIFY AND/OR REDISTRIBUTE THE PROGRAM AS PERMITTED ABOVE, BE LIABLE TO YOU FOR DAMAGES, INCLUDING ANY GENERAL, SPECIAL, INCIDENTAL OR CONSEQUENTIAL DAMAGES ARISING OUT OF THE USE OR INABILITY TO USE THE PROGRAM (INCLUDING BUT NOT LIMITED TO LOSS OF DATA OR DATA BEING RENDERED INACCURATE OR LOSSES SUSTAINED BY YOU OR THIRD PARTIES OR A FAILURE OF THE PROGRAM TO OPERATE WITH ANY OTHER PROGRAMS), EVEN IF SUCH HOLDER OR OTHER PARTY HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES. &lt;br /&gt;  &lt;br /&gt;  END OF TERMS AND CONDITIONS &lt;br /&gt;  {tcms_more}&lt;br /&gt;  &lt;strong&gt;How to Apply These Terms to Your New Programs&lt;/strong&gt; If you develop a new program, and you want it to be of the greatest possible use to the public, the best way to achieve this is to make it free software which everyone can redistribute and change under these terms. &lt;br /&gt;  &lt;br /&gt;  To do so, attach the following notices to the program. It is safest to attach them to the start of each source file to most effectively convey the exclusion of warranty; and each file should have at least the &quot;copyright&quot; line and a po[int]er to where the full notice is found. &lt;br /&gt;  &lt;br /&gt;  &lt;strong&gt;toendaCMS - XML Content Management and Weblogging System&lt;/strong&gt;    toendaCMS is a professionall web based Content Management and Weblogging System with a XML or SQL Database. &lt;br /&gt;  &lt;strong&gt;Copyright (C) 2003 - 2005 Jonathan Naumann &lt;em&gt;Toenda Software Development&lt;/em&gt;&lt;/strong&gt; This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version. &lt;br /&gt;  &lt;br /&gt;  This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details. &lt;br /&gt;  &lt;br /&gt;  You should have received a copy of the GNU General Public License along with this program; if not, write to the Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA &lt;br /&gt;  &lt;br /&gt;  Also add information on how to contact you by electronic and paper mail. &lt;br /&gt;  &lt;br /&gt;  If the program is [int]eractive, make it output a short notice like this when it starts in an [int]eractive mode: &lt;br /&gt;  &lt;br /&gt;  Gnomovision version 69, Copyright (C) year name of author Gnomovision comes with ABSOLUTELY NO WARRANTY; for details type [show w&amp;#39;. This is free software, and you are welcome to redistribute it under certain conditions; type [show c&amp;#39; for details. &lt;br /&gt;  &lt;br /&gt;  The hypothetical commands [show w&amp;#39; and [show c&amp;#39; should show the appropriate parts of the General Public License. Of course, the commands you use may be called something other than [show w&amp;#39; and [show c&amp;#39;; they could even be mouse-clicks or menu items--whatever suits your program. &lt;br /&gt;  &lt;br /&gt;  You should also get your employer (if you work as a programmer) or your school, if any, to sign a &quot;copyright disclaimer&quot; for the program, if necessary. Here is a sample; alter the names: &lt;br /&gt;  &lt;br /&gt;  Yoyodyne, Inc., hereby disclaims all copyright [int]erest in the program [Gnomovision&amp;#39; (which makes passes at compilers) written by James Hacker. &lt;br /&gt;  &lt;br /&gt;  (signature of Ty Coon), 1 April 1989 Ty Coon, President of Vice &lt;br /&gt;  &lt;br /&gt;  This General Public License does not permit incorporating your program INTO proprietary programs. If your program is a subroutine library, you may consider it more useful to permit linking proprietary applications with the library. If this is what you want to do, use the GNU Library General Public License instead of this License. &lt;br /&gt;  &lt;br /&gt;  &lt;strong&gt;Toenda Software Development&lt;/strong&gt;&lt;img src__________&quot;/toendacms/data/images/Image/osi-certified-120x100.png&quot; border__________&quot;0&quot; alt__________&quot;osi-certified-120x100.png&quot; title__________&quot;osi-certified-120x100.png&quot; /&gt;', '', '', 'db_content_image.php', 'Public', 1, 1, 'root')


INSERT INTO [dbo].[#####contacts] ([uid], [default_con], [published], [name], [position], [email], [street], [country], [state], [town], [postal], [phone], [fax])
VALUES ('10a1b5f6ab', 1, 1, 'Max Musterman', 'CEO', 'max@musterman.com', 'Musterstrasse 123', 'Germany', '', 'Musterstadt', 28203, '', '')


INSERT INTO [dbo].[#####contactform] ([uid], [contact], [show_contacts_in_sidebar], [send_id], [contacttitle], [contactstamp], [access], [enabled], [use_adressbook], [use_contact], [show_contactemail], [contacttext])
VALUES ('contactform', 'info@toenda.com', 1, 'contactform', 'Contact Us and ...', '... send us a message.', 'Public', 1, 0, 0, 0, '')


INSERT INTO [dbo].[#####comments] ([uid], [module], [timestamp], [name], [email], [web], [msg], [time], [ip], [domain])
VALUES ('4aac0e2d1a', 'news', '40051003001714', 'vandango', 'vandango@toenda.com', 'http://vandango.toenda.com', 'This is a testcomment to test the new gravatar  icon<br />and the new emoticon feature. ;) B) :| %(|)', '20050612234225', NULL, NULL)


INSERT INTO [dbo].[#####comments] ([uid], [module], [timestamp], [name], [email], [web], [msg], [time], [ip], [domain])
VALUES ('5a12397d95', 'news', '20050621005209', 'toendaProgrammer', 'info@toenda.com', 'http://www.toenda.com', 'Wow ... toendaCMS with a SQL database server.', '20050621005209', NULL, NULL)


INSERT INTO [dbo].[#####comments] ([uid], [module], [timestamp], [name], [email], [web], [msg], [time], [ip], [domain])
VALUES ('c4c846e167', 'news', '20051126005016', 'vandango', 'vandango@toenda.com', 'http://vandango.org', 'This is a test comment ...', '20051126005016', '127.0.0.1', 'localhost')


INSERT INTO [dbo].[#####downloads_config] ([uid], [download_id], [download_title], [download_stamp], [download_text])
VALUES ('download', 'download', 'Downloads and Software', 'Toenda Software Downloads', 'Our software downloads.')


INSERT INTO [dbo].[#####frontpage] ([uid], [front_id], [front_title], [front_stamp], [front_text], [news_title], [news_cut], [module_use_0], [sb_news_title], [sb_news_amount], [sb_news_chars], [sb_news_enabled], [sb_news_display])
VALUES ('frontpage', 'frontpage', 'Welcome to the Home of toendaCMS', 'Content Management and Weblogging System', 'Welcome to the Samplesite of the free Open-Source content management and weblogging system toendaCMS.&lt;br /&gt;\r\nIt is for enterprise purposes and/or private uses on the web. It offers full flexibility and extendability while featuring an accomplished set of ready-made [int]erfaces, function''s and modules.', 'Journal', 0, 3, ' Latest News', 5, 100, 1, 3)

INSERT INTO [dbo].[#####guestbook] ([uid], [guest_id], [booktitle], [bookstamp], [access], [enabled], [clean_link], [clean_script], [convert_at], [show_email], [name_width], [text_width], [color_row_1], [color_row_2])
VALUES ('guestbook', 'guestbook', 'My Guests', 'of this beautiful website', 'Public', 1, 1, 1, 1, 1, '140', '360', 'ffffff', 'f4f7fd')

INSERT INTO [dbo].[#####guestbook_items] ([uid], [name], [email], [text], [date], [time])
VALUES ('55cb02d7477921bb0091b9ba7ae91b85', 'vandango', 'vandango@toenda.com', 'Wow, whats a new and cool guestbook.', '20051124', '12:33')


INSERT INTO [dbo].[#####imagegallery] ([uid], [album], [image], [text], [date])
VALUES ('2ee2445015', '625106', 'Hillside.jpg', 'Hillside Wallpaper', '20051209003909')


INSERT INTO [dbo].[#####imagegallery] ([uid], [album], [image], [text], [date])
VALUES ('868c08617c', '625106', 'Silence.jpg', 'Silence Wallpaper', '20051209003514')


INSERT INTO [dbo].[#####imagegallery] ([uid], [album], [image], [text], [date])
VALUES ('b0e936666d', '625106', 'Boulders.jpg', 'Boulders Wallpaper', '20051209003539')

INSERT INTO [dbo].[#####imagegallery_config] ([uid], [image_id], [image_title], [image_stamp], [image_details], [use_comments], [access], [max_image], [needle_image], [show_lastimg_title], [align_image], [size_image], [image_sort], [list_option])
VALUES ('imagegallery', 'imagegallery', 'Imagegallery', 'Picture i like', 0, 1, 'Public', 5, 'Last uploaded', 1, 'center', 100, 'desc', 0)

INSERT INTO [dbo].[#####impressum] ([uid], [imp_id], [imp_title], [imp_stamp], [imp_contact], [taxno], [ustid], [legal])
VALUES ('impressum', 'impressum', 'Disclaimer', 'Information about this website', '10a1b5f6ab', '123456789', '123123d', 'No portion of this web site may be reproduced without express written consent from its owner.')

INSERT INTO [dbo].[#####knowledgebase] ([uid], [category], [parent], [title], [subtitle], [content], [image], [type], [date], [last_update], [access], [autor], [sort], [publish_state])
VALUES ('26190cb562', '', '', 'Base', 'Base Category', 'dfasdasdasd', '', 'c', '07.01.2006-15:30', '27.01.2006-13:19', 'Public', 'gtdz87qw64qgahsdjkg789azwer8u0aw', 0, 2)


INSERT INTO [dbo].[#####knowledgebase] ([uid], [category], [parent], [title], [subtitle], [content], [image], [type], [date], [last_update], [access], [autor], [sort], [publish_state])
VALUES ('44490cb562', '26190cb562', '26190cb562', 'Base Class 2', 'asdas das  dasd asd', 'asdasdasdasdas asdasd asd asd asas da  asd asd ', NULL, 'c', '07.01.2006-15:30', '07.01.2006-15:30', 'Public', 'gtdz87qw64qgahsdjkg789azwer8u0aw', 0, 2)


INSERT INTO [dbo].[#####knowledgebase] ([uid], [category], [parent], [title], [subtitle], [content], [image], [type], [date], [last_update], [access], [autor], [sort], [publish_state])
VALUES ('4679cd7d6f', '', '', 'What is the knowledgebase?', 'A short description of the FAQ and article manager - the knowledgebase.', 'The knowledgebase is a manager module to manage FAQ''s or articles. You can give each item an image. That''s adjuvant for a database for music albums, you can allocate the music album cover for each album description.<br />Furthermore has the knowledgebase a 3-step publishing mode.', '', 'a', '28.01.2006-01:11', '28.01.2006-01:24', 'Public', 'gtdz87qw64qgahsdjkg789azwer8u0aw', 2, 2)


INSERT INTO [dbo].[#####knowledgebase] ([uid], [category], [parent], [title], [subtitle], [content], [image], [type], [date], [last_update], [access], [autor], [sort], [publish_state])
VALUES ('cd56226190', '26190cb562', '26190cb562', 'Second Item', 'A second FAQ test content item', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', NULL, 'a', '07.01.2006-15:45', '08.01.2006-15:30', 'Public', 'gtdz87qw64qgahsdjkg789azwer8u0aw', 0, 2)


INSERT INTO [dbo].[#####knowledgebase] ([uid], [category], [parent], [title], [subtitle], [content], [image], [type], [date], [last_update], [access], [autor], [sort], [publish_state])
VALUES ('gh56226190', '44490cb562', '44490cb562', 'Second Item 4', 'A second FAQ test content item 4', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', NULL, 'a', '07.01.2006-15:45', '08.01.2006-15:30', 'Public', 'gtdz87qw64qgahsdjkg789azwer8u0aw', 1, 2)

INSERT INTO [dbo].[#####knowledgebase_config] ([uid], [id], [title], [subtitle], [text], [enabled], [autor_enabled], [access])
VALUES ('knowledgebase', 'knowledgebase', 'FAQs and Articles', 'A small knowledge database', 'Here you will find an example set of FAQs and Articles.', 1, 0, 'Public')

INSERT INTO [dbo].[#####links_config] ([uid], [link_use_side_desc], [link_use_side_title], [link_side_title], [link_use_main_desc], [link_main_title], [link_main_subtitle], [link_main_text], [link_main_access])
VALUES ('links_config_main', NULL, NULL, NULL, 1, 'myLinks', 'A list of all websites i like', 'This is a example [text] for the [text]link page.', 'Public')


INSERT INTO [dbo].[#####links_config] ([uid], [link_use_side_desc], [link_use_side_title], [link_side_title], [link_use_main_desc], [link_main_title], [link_main_subtitle], [link_main_text], [link_main_access])
VALUES ('links_config_side', 0, 1, 'Blogroll', NULL, NULL, NULL, NULL, NULL)

INSERT INTO [dbo].[#####links] ([uid], [type], [category], [sort], [name], [desc], [link], [published], [target], [rss], [access], [module])
VALUES ('175b2bf8dd4a03d00038bb43ae06abf1', 'l', '50c3ef9ef90f608dd85ca31166b62e68', 0, 'Enlightenment', 'The best Unix / Linux Window Manager', 'http://www.enlightenment.org', 1, '_blank', '', 'Public', 3)


INSERT INTO [dbo].[#####links] ([uid], [type], [category], [sort], [name], [desc], [link], [published], [target], [rss], [access], [module])
VALUES ('34dr567zhtzh876sgh48r68f44h5s8z4', 'l', 'sdf7sdf768sd7f78sdf6sd76fsdfsd7f', 0, 'Toenda Software Development', 'Developer of toendaCMS', 'http://www.toenda.com', 1, '_blank', '', 'Public', 3)


INSERT INTO [dbo].[#####links] ([uid], [type], [category], [sort], [name], [desc], [link], [published], [target], [rss], [access], [module])
VALUES ('43b59b86aa69a67ea020ead9e3ce54e1', 'l', '50c3ef9ef90f608dd85ca31166b62e68', 1, 'Kernel.org', 'The Linux Kernel', 'http://www.kernel.org', 1, '_blank', '', 'Public', 3)


INSERT INTO [dbo].[#####links] ([uid], [type], [category], [sort], [name], [desc], [link], [published], [target], [rss], [access], [module])
VALUES ('50c3ef9ef90f608dd85ca31166b62e68', 'c', NULL, 1, 'Linux', 'Some Links about Linus free operating system', '', 1, '', '', 'Public', 3)


INSERT INTO [dbo].[#####links] ([uid], [type], [category], [sort], [name], [desc], [link], [published], [target], [rss], [access], [module])
VALUES ('asdasdasdasdasd6786786as78d6as67', 'l', 'sdf7sdf768sd7f78sdf6sd76fsdfsd7f', 2, 'PHP.net', 'Officiell PHP webpage', 'http://www.php.net', 1, '_blank', '', 'Public', 2)


INSERT INTO [dbo].[#####links] ([uid], [type], [category], [sort], [name], [desc], [link], [published], [target], [rss], [access], [module])
VALUES ('d8f83e6e9acc6ad211104949db1285fd', 'l', 'sdf7sdf768sd7f78sdf6sd76fsdfsd7f', 3, 'vandango | creative coding', 'toendaCMS maindeveloper weblog', 'http://vandango.org', 1, '_blank', '', 'Public', 1)


INSERT INTO [dbo].[#####links] ([uid], [type], [category], [sort], [name], [desc], [link], [published], [target], [rss], [access], [module])
VALUES ('dsf78578asdas7das76das7d67as67d6', 'l', 'sdf7sdf768sd7f78sdf6sd76fsdfsd7f', 1, 'toendaCMS Demonstration Site', 'The officiell demonstration site of the content management and weblogging system toendaCMS.', 'http://toendacms.toenda.com', 1, '_blank', NULL, 'Public', 3)


INSERT INTO [dbo].[#####links] ([uid], [type], [category], [sort], [name], [desc], [link], [published], [target], [rss], [access], [module])
VALUES ('sdf7sdf768sd7f78sdf6sd76fsdfsd7f', 'c', '', 0, 'Toenda', 'Toenda Software Development Links', '', 1, '', '', 'Public', 3)

INSERT INTO [dbo].[#####news_categories] ([uid], [name], [desc])
VALUES ('51fa1', 'toendaCMS', 'News about the web content management and weblogging system toendaCMS and the development about it.')


INSERT INTO [dbo].[#####news_categories] ([uid], [name], [desc])
VALUES ('erdf4', 'Uncategorized', 'News without a category.')

INSERT INTO [dbo].[#####newsletter] ([uid], [nl_title], [nl_show_title], [nl_text], [nl_link])
VALUES ('newsletter', 'Newsletter', 1, 'You want always know whats up, subscribe now!', 'Submit')

INSERT INTO [dbo].[#####newsletter_items] ([uid], [user], [email])
VALUES ('223594', 'Mr. Toenda', 'info@toenda.com')


INSERT INTO [dbo].[#####newsletter_items] ([uid], [user], [email])
VALUES ('f574da', 'Jonathan Naumann', 'info@toenda.com')

INSERT INTO [dbo].[#####newsmanager] ([uid], [news_id], [news_title], [news_stamp], [news_image], [use_comments], [show_autor], [show_autor_as_link], [news_amount], [access], [news_cut], [use_gravatar], [use_emoticons], [use_rss091], [use_rss10], [use_rss20], [use_atom03], [use_opml], [syn_amount], [use_syn_title], [def_feed], [use_trackback], [use_timesince], [news_text], [readmore_link], [news_spacing])
VALUES ('newsmanager', 'newsmanager', 'News', 'Current', ' ', 1, 0, 0, 20, 'Public', 0, 0, 1, 1, 1, 1, 1, 1, 5, 1, 'RSS2.0', 0, 0, 'testext ', 0, 25)

INSERT INTO [dbo].[#####news] ([uid], [title], [autor], [date], [time], [newstext], [stamp], [published], [publish_date], [comments_enabled], [image], [access])
VALUES ('c4c846e167', 'Hello world!', 'root', '04.02.2006', '00:00', 'Hello world. This is Dolly and you reading my first post. If you want you can delete it, but you can edit it too. Or you write a new one and let this where it is. It&amp;#39;s your choice.&lt;br /&gt;&lt;br /&gt;Lorem ipsum dolor sit amet, consectetuer adipiscing elit. integer tellus libero, euismod sed, gravida nec, tincidunt vitae, urna. Nam feugiat nulla ac quam. Nulla tincidunt, nulla quis luctus ornare, odio mauris lobortis velit, ut eleifend ligula risus a purus. integer mauris dolor, suscipit sit amet, interdum vel, laoreet id, pede. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.', 200602040000, 1, '04.02.2006-00:00', 1, '', 'Public')

INSERT INTO [dbo].[#####news_to_categories] ([uid], [news_uid], [cat_uid])
VALUES ('3691e', 'c4c846e167', 'erdf4')


INSERT INTO [dbo].[#####news_to_categories] ([uid], [news_uid], [cat_uid])
VALUES ('8836a', 'c4c846e167', '51fa1')

INSERT INTO [dbo].[#####poll_config] ([uid], [poll_title], [allpoll_title], [show_poll_title], [poll_side_width], [poll_main_width], [poll_sm_title], [use_poll_sidemenu], [poll_sidemenu_id], [poll_tm_title], [use_poll_topmenu], [poll_topmenu_id])
VALUES ('poll', 'Poll', 'All Polls', 1, 110, 700, 'Poll', 1, 2, 'Poll', 0, 4)

INSERT INTO [dbo].[#####poll_items] ([uid], [poll_uid], [ip], [domain], [answer])
VALUES ('f2e874a9', '1386d1eb56f76a14a507f64a63617309', '127.0.0.1', 'localhost', 1)

INSERT INTO [dbo].[#####polls] ([uid], [title], [question1], [question2], [question3], [question4], [question5], [question6], [question7], [question8], [question9], [question10], [question11], [question12])
VALUES ('1386d1eb56f76a14a507f64a63617309', 'This toendaCMS installation was ....', 'Absolutely simple', 'Reasonably easy', 'Not straight-forward but I worked it out', 'I had to install extra server stuff', 'I had no idea and got my friend to do it', 'My dog ran away with the README ...', NULL, NULL, NULL, NULL, NULL, NULL)

INSERT INTO [dbo].[#####products_config] ([uid], [products_id], [products_title], [products_stamp], [products_text], [category_state], [category_title], [use_category_title])
VALUES ('products', 'products', 'Products', 'Toenda Software Products', 'Our software products.', 'software', 'Product Categories', 1)

INSERT INTO [dbo].[#####sidebar_extensions] ([uid], [sidemenu_title], [sidemenu], [sidebar_title], [show_sidebar_title], [chooser_title], [show_chooser_title], [search_title], [show_search_title], [search_alignment], [search_withbr], [search_withbutton], [search_word], [login_title], [usermenu_title], [nologin], [reg_link], [reg_user], [reg_pass], [login_user], [usermenu], [show_login_title], [show_news_cat_amount], [show_memberlist])
VALUES ('sidebar_extensions', 'Sidemenu', 0, 'Sidebar', 0, 'Showcase', 1, 'Search our website', 0, 'left', 0, 0, 'Search website', 'Login', 'Usermenu', 'No account yet?', 'Create one', 'Username', 'Password', 1, 1, 1, 1, 0)

INSERT INTO [dbo].[#####sidebar] ([uid], [title], [key], [content], [foot], [id])
VALUES ('frontpage', 'Wenn ich gross bin', '', 'Ich bin nur ein kleiner Blind[text]\r\nWenn ich gross bin, will ich Ulysses von James Joyce werden. Aber jetzt lohnt es sich noch nicht, mich weiterzulesen. Denn vorerst bin ich nur ein kleiner Blind[text].', '', 'frontpage')

INSERT INTO [dbo].[#####sidemenu] ([uid], [name], [id], [subid], [parent], [type], [link], [published], [access], [parent_lvl2], [parent_lvl3], [root], [parent_lvl1])
VALUES ('51272', 'Contact Me', 4, '-  ', '-  ', 'link', 'contactform', 1, 'Public', NULL, NULL, NULL, NULL)


INSERT INTO [dbo].[#####sidemenu] ([uid], [name], [id], [subid], [parent], [type], [link], [published], [access], [parent_lvl2], [parent_lvl3], [root], [parent_lvl1])
VALUES ('52d28', 'Guestbook', 3, '-  ', '-  ', 'link', 'guestbook', 1, 'Public', NULL, NULL, NULL, NULL)


INSERT INTO [dbo].[#####sidemenu] ([uid], [name], [id], [subid], [parent], [type], [link], [published], [access], [parent_lvl2], [parent_lvl3], [root], [parent_lvl1])
VALUES ('6738n', 'Pages', 0, '-  ', '-  ', 'title', '-', 1, 'Public', NULL, NULL, NULL, NULL)


INSERT INTO [dbo].[#####sidemenu] ([uid], [name], [id], [subid], [parent], [type], [link], [published], [access], [parent_lvl2], [parent_lvl3], [root], [parent_lvl1])
VALUES ('dc688', 'License', 2, '-  ', '-  ', 'link', '18e2a', 1, 'Public', NULL, NULL, NULL, NULL)


INSERT INTO [dbo].[#####sidemenu] ([uid], [name], [id], [subid], [parent], [type], [link], [published], [access], [parent_lvl2], [parent_lvl3], [root], [parent_lvl1])
VALUES ('r15tg', 'Home', 1, '-  ', '-  ', 'link', 'frontpage', 1, 'Public', NULL, NULL, NULL, NULL)

INSERT INTO [dbo].[#####topmenu] ([uid], [name], [id], [type], [link], [published], [access])
VALUES ('10f16', 'FAQ', 2, 'link', 'knowledgebase', 1, 'Public')


INSERT INTO [dbo].[#####topmenu] ([uid], [name], [id], [type], [link], [published], [access])
VALUES ('1fbae', 'Home', 0, 'link', 'frontpage', 1, 'Public')


INSERT INTO [dbo].[#####topmenu] ([uid], [name], [id], [type], [link], [published], [access])
VALUES ('3c6d9', 'News', 1, 'link', 'newsmanager', 1, 'Public')


INSERT INTO [dbo].[#####topmenu] ([uid], [name], [id], [type], [link], [published], [access])
VALUES ('4a69d', 'Search', 4, 'link', 'search', 1, 'Public')


INSERT INTO [dbo].[#####topmenu] ([uid], [name], [id], [type], [link], [published], [access])
VALUES ('89666', 'Gallery', 3, 'link', 'imagegallery', 1, 'Public')

INSERT INTO [dbo].[#####usergroup] ([uid], [name], [right])
VALUES ('418aed8f001f0b88e36bc68013000794', 'Editor', 3)


INSERT INTO [dbo].[#####usergroup] ([uid], [name], [right])
VALUES ('7f2a4a04ddeffc7caa029e289be712a1', 'Writer', 2)


INSERT INTO [dbo].[#####usergroup] ([uid], [name], [right])
VALUES ('8a318ecd72b639ceca72c87dbc6f241c', 'Administrator', 1)


INSERT INTO [dbo].[#####usergroup] ([uid], [name], [right])
VALUES ('c4e1aea1d163b0d3b3db90b667a2ba81', 'User', 5)


INSERT INTO [dbo].[#####usergroup] ([uid], [name], [right])
VALUES ('daf91e6be506252b897977537fa488c8', 'Developer', 0)


INSERT INTO [dbo].[#####usergroup] ([uid], [name], [right])
VALUES ('fcc0abe286b322744765b271c8ede1fd', 'Presenter', 4)

INSERT INTO [dbo].[#####userpage] ([uid], [text_width], [input_width], [news_publish], [image_publish], [album_publish], [cat_publish], [pic_publish])
VALUES ('userpage', '150', '150', 1, 1, 1, 1, '1')
