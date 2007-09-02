USE [tcms]
GO
/****** Objekt:  Table [#####comments]    Skriptdatum: 09/02/2007 18:07:15 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [#####comments](
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
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Objekt:  Table [#####knowledgebase_config]    Skriptdatum: 09/02/2007 18:09:43 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [#####knowledgebase_config](
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
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Objekt:  Table [#####products_config]    Skriptdatum: 09/02/2007 18:12:12 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [#####products_config](
	[uid] [varchar](8) NOT NULL DEFAULT (''),
	[products_id] [varchar](8) NOT NULL DEFAULT (''),
	[products_title] [varchar](255) NOT NULL DEFAULT (''),
	[products_stamp] [varchar](255) NOT NULL DEFAULT (''),
	[products_text] [text] NOT NULL,
	[category_state] [varchar](255) NOT NULL DEFAULT (''),
	[category_title] [varchar](255) NOT NULL DEFAULT (''),
	[use_category_title] [int] NOT NULL DEFAULT ('0'),
	[language] [varchar](25) NULL,
	[show_price_only_users] [tinyint] NULL,
	[startpagetitle] [varchar](255) NULL,
	[use_sidebar_categories] [tinyint] NOT NULL DEFAULT ('1'),
	[max_latest_products] [int] NOT NULL DEFAULT ('15'),
 CONSTRAINT [PK_tcms_products_config] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Objekt:  Table [#####contactform]    Skriptdatum: 09/02/2007 18:07:27 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [#####contactform](
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
	[language] [varchar](25) NOT NULL DEFAULT (''),
 CONSTRAINT [PK_tcms_contactform] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Objekt:  Table [#####links]    Skriptdatum: 09/02/2007 18:09:54 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [#####links](
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
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Objekt:  Table [#####session]    Skriptdatum: 09/02/2007 18:12:15 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [#####session](
	[uid] [varchar](32) NOT NULL DEFAULT (''),
	[date] [varchar](20) NOT NULL DEFAULT (''),
	[user] [varchar](255) NOT NULL DEFAULT (''),
	[user_id] [varchar](32) NOT NULL DEFAULT (''),
 CONSTRAINT [PK_tcms_session] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Objekt:  Table [#####sidebar]    Skriptdatum: 09/02/2007 18:12:22 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [#####sidebar](
	[uid] [varchar](32) NOT NULL DEFAULT (''),
	[title] [varchar](255) NULL DEFAULT (NULL),
	[key] [varchar](255) NULL DEFAULT (NULL),
	[content] [text] NULL,
	[foot] [varchar](255) NULL DEFAULT (NULL),
	[id] [varchar](255) NOT NULL DEFAULT (''),
 CONSTRAINT [PK_tcms_sidebar] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Objekt:  Table [#####contacts]    Skriptdatum: 09/02/2007 18:07:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [#####contacts](
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
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Objekt:  Table [#####links_config]    Skriptdatum: 09/02/2007 18:10:03 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [#####links_config](
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
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Objekt:  Table [#####sidebar_extensions]    Skriptdatum: 09/02/2007 18:12:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [#####sidebar_extensions](
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
	[lang] [varchar](255) NOT NULL DEFAULT (''),
 CONSTRAINT [PK_tcms_sidebar_extensions] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Objekt:  Table [#####user]    Skriptdatum: 09/02/2007 18:13:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [#####user](
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
	[#####enabled] [int] NOT NULL CONSTRAINT [DF__tcms_user__tcms___6225902D]  DEFAULT ('0'),
	[static_value] [int] NOT NULL CONSTRAINT [DF__tcms_user__stati__6319B466]  DEFAULT ('0'),
	[signature] [text] NULL,
	[location] [varchar](255) NULL CONSTRAINT [DF__tcms_user__locat__640DD89F]  DEFAULT (NULL),
	[hobby] [varchar](255) NULL CONSTRAINT [DF__tcms_user__hobby__6501FCD8]  DEFAULT (NULL),
 CONSTRAINT [PK_tcms_user] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Objekt:  Table [#####news]    Skriptdatum: 09/02/2007 18:10:19 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [#####news](
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
	[show_on_frontpage] [int] NOT NULL DEFAULT ((1)),
	[language] [varchar](25) NOT NULL DEFAULT (''),
PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Objekt:  Table [#####content]    Skriptdatum: 09/02/2007 18:07:51 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [#####content](
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
	[language] [varchar](25) NULL,
 CONSTRAINT [PK_tcms_content] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Objekt:  Table [#####news_categories]    Skriptdatum: 09/02/2007 18:10:22 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [#####news_categories](
	[uid] [varchar](5) NOT NULL DEFAULT (''),
	[name] [varchar](255) NOT NULL DEFAULT (''),
	[desc] [text] NULL,
 CONSTRAINT [PK_tcms_news_categories] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Objekt:  Table [#####news_to_categories]    Skriptdatum: 09/02/2007 18:10:26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [#####news_to_categories](
	[uid] [varchar](5) NOT NULL DEFAULT (''),
	[news_uid] [varchar](10) NOT NULL DEFAULT (''),
	[cat_uid] [varchar](5) NOT NULL DEFAULT (''),
 CONSTRAINT [PK_tcms_news_to_categories] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Objekt:  Table [#####sidemenu]    Skriptdatum: 09/02/2007 18:12:59 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [#####sidemenu](
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
	[target] [varchar](20) NULL DEFAULT (''),
	[language] [varchar](25) NOT NULL DEFAULT (''),
 CONSTRAINT [PK_tcms_sidemenu] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Objekt:  Table [#####newsletter]    Skriptdatum: 09/02/2007 18:10:34 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [#####newsletter](
	[uid] [varchar](10) NOT NULL DEFAULT (''),
	[nl_title] [varchar](255) NOT NULL DEFAULT (''),
	[nl_show_title] [int] NOT NULL DEFAULT ('0'),
	[nl_text] [varchar](255) NOT NULL DEFAULT (''),
	[nl_link] [varchar](255) NOT NULL DEFAULT (''),
 CONSTRAINT [PK_tcms_newsletter] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Objekt:  Table [#####newsletter_items]    Skriptdatum: 09/02/2007 18:10:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [#####newsletter_items](
	[uid] [varchar](6) NOT NULL DEFAULT (''),
	[user] [varchar](255) NOT NULL DEFAULT (''),
	[email] [varchar](255) NOT NULL DEFAULT (''),
 CONSTRAINT [PK_tcms_newsletter_items] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Objekt:  Table [#####downloads_config]    Skriptdatum: 09/02/2007 18:08:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [#####downloads_config](
	[uid] [varchar](8) NOT NULL DEFAULT (''),
	[download_id] [varchar](8) NOT NULL DEFAULT (''),
	[download_title] [varchar](255) NULL DEFAULT (NULL),
	[download_stamp] [varchar](255) NULL DEFAULT (NULL),
	[download_text] [text] NULL,
 CONSTRAINT [PK_tcms_downloads_config] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Objekt:  Table [#####usergroup]    Skriptdatum: 09/02/2007 18:13:42 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [#####usergroup](
	[uid] [varchar](32) NOT NULL,
	[name] [varchar](25) NOT NULL,
	[right] [int] NOT NULL,
 CONSTRAINT [PK_tcms_usergroup] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Objekt:  Table [#####statistics]    Skriptdatum: 09/02/2007 18:13:05 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [#####statistics](
	[host] [varchar](255) NOT NULL DEFAULT (''),
	[site_url] [varchar](255) NOT NULL DEFAULT (''),
	[value] [int] NULL DEFAULT ('0'),
	[ip_uid] [varchar](32) NULL DEFAULT (NULL),
	[referrer] [varchar](255) NULL DEFAULT (NULL),
	[timestamp] [datetime] NULL DEFAULT (NULL)
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Objekt:  Table [#####newsmanager]    Skriptdatum: 09/02/2007 18:11:05 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [#####newsmanager](
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
	[language] [varchar](25) NOT NULL DEFAULT (''),
 CONSTRAINT [PK_tcms_newsmanager] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Objekt:  Table [#####frontpage]    Skriptdatum: 09/02/2007 18:08:34 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [#####frontpage](
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
	[language] [varchar](25) NOT NULL DEFAULT (''),
 CONSTRAINT [PK_tcms_frontpage] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Objekt:  Table [#####statistics_ip]    Skriptdatum: 09/02/2007 18:13:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [#####statistics_ip](
	[uid] [varchar](32) NOT NULL DEFAULT (''),
	[ip] [varchar](15) NOT NULL DEFAULT (''),
	[value] [int] NULL DEFAULT (NULL),
 CONSTRAINT [PK_tcms_statistics_ip] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Objekt:  Table [#####statistics_os]    Skriptdatum: 09/02/2007 18:13:11 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [#####statistics_os](
	[uid] [varchar](32) NOT NULL DEFAULT (''),
	[browser] [varchar](255) NULL DEFAULT (NULL),
	[os] [varchar](255) NULL DEFAULT (NULL),
	[value] [int] NULL DEFAULT (NULL),
 CONSTRAINT [PK_tcms_statistics_os] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Objekt:  Table [#####topmenu]    Skriptdatum: 09/02/2007 18:13:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [#####topmenu](
	[uid] [varchar](5) NOT NULL DEFAULT (''),
	[name] [varchar](255) NULL DEFAULT (NULL),
	[id] [int] NOT NULL DEFAULT ('0'),
	[type] [varchar](10) NULL DEFAULT (NULL),
	[link] [varchar](255) NULL DEFAULT (NULL),
	[published] [int] NOT NULL DEFAULT ('0'),
	[access] [varchar](10) NOT NULL DEFAULT (''),
	[target] [varchar](20) NULL DEFAULT (''),
	[language] [varchar](25) NOT NULL DEFAULT (''),
 CONSTRAINT [PK_tcms_topmenu] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Objekt:  Table [#####guestbook]    Skriptdatum: 09/02/2007 18:08:49 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [#####guestbook](
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
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Objekt:  Table [#####notepad]    Skriptdatum: 09/02/2007 18:11:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [#####notepad](
	[uid] [varchar](32) NOT NULL DEFAULT (''),
	[name] [varchar](200) NOT NULL DEFAULT (''),
	[note] [text] NULL,
PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Objekt:  Table [#####poll_config]    Skriptdatum: 09/02/2007 18:11:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [#####poll_config](
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
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Objekt:  Table [#####guestbook_items]    Skriptdatum: 09/02/2007 18:08:54 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [#####guestbook_items](
	[uid] [varchar](32) NOT NULL DEFAULT (''),
	[name] [varchar](255) NULL DEFAULT (NULL),
	[email] [varchar](255) NULL DEFAULT (NULL),
	[text] [text] NULL,
	[date] [varchar](8) NULL DEFAULT (NULL),
	[time] [varchar](5) NULL DEFAULT (NULL),
 CONSTRAINT [PK_tcms_guestbook_items] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Objekt:  Table [#####imagegallery]    Skriptdatum: 09/02/2007 18:08:58 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [#####imagegallery](
	[uid] [varchar](10) NOT NULL DEFAULT (''),
	[album] [varchar](6) NOT NULL DEFAULT (''),
	[image] [varchar](255) NOT NULL DEFAULT (''),
	[text] [text] NULL,
	[date] [varchar](14) NOT NULL DEFAULT (''),
 CONSTRAINT [PK_tcms_imagegallery] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Objekt:  Table [#####poll_items]    Skriptdatum: 09/02/2007 18:11:25 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [#####poll_items](
	[uid] [varchar](8) NOT NULL DEFAULT (''),
	[poll_uid] [varchar](32) NOT NULL DEFAULT (''),
	[ip] [varchar](15) NOT NULL DEFAULT (''),
	[domain] [varchar](255) NOT NULL DEFAULT (''),
	[answer] [int] NOT NULL DEFAULT ('0'),
 CONSTRAINT [PK_tcms_poll_items] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Objekt:  Table [#####imagegallery_config]    Skriptdatum: 09/02/2007 18:09:13 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [#####imagegallery_config](
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
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Objekt:  Table [#####userpage]    Skriptdatum: 09/02/2007 18:13:49 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [#####userpage](
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
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Objekt:  Table [#####polls]    Skriptdatum: 09/02/2007 18:11:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [#####polls](
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
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Objekt:  Table [#####impressum]    Skriptdatum: 09/02/2007 18:09:21 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [#####impressum](
	[uid] [varchar](9) NOT NULL DEFAULT (''),
	[imp_id] [varchar](9) NOT NULL DEFAULT (''),
	[imp_title] [varchar](255) NULL DEFAULT (NULL),
	[imp_stamp] [varchar](255) NULL DEFAULT (NULL),
	[imp_contact] [varchar](10) NOT NULL DEFAULT (''),
	[taxno] [varchar](50) NULL DEFAULT (NULL),
	[ustid] [varchar](50) NULL DEFAULT (NULL),
	[legal] [text] NULL,
	[language] [varchar](25) NOT NULL DEFAULT (''),
 CONSTRAINT [PK_tcms_impressum] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Objekt:  Table [#####knowledgebase]    Skriptdatum: 09/02/2007 18:09:35 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [#####knowledgebase](
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
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Objekt:  Table [#####products]    Skriptdatum: 09/02/2007 18:12:01 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [#####products](
	[uid] [varchar](32) NOT NULL DEFAULT (''),
	[name] [varchar](255) NOT NULL DEFAULT (''),
	[product_number] [varchar](255) NULL DEFAULT (NULL),
	[factory] [varchar](255) NULL DEFAULT (NULL),
	[factory_url] [varchar](255) NULL DEFAULT (NULL),
	[desc] [text] NULL,
	[category] [varchar](32) NULL DEFAULT (''),
	[image1] [varchar](255) NULL DEFAULT (NULL),
	[date] [varchar](16) NOT NULL DEFAULT (''),
	[price] [varchar](50) NULL DEFAULT (NULL),
	[price_tax] [varchar](50) NULL DEFAULT (NULL),
	[status] [int] NOT NULL DEFAULT ('0'),
	[quantity] [int] NULL DEFAULT (NULL),
	[weight] [varchar](50) NULL DEFAULT (NULL),
	[sort] [int] NOT NULL DEFAULT ('0'),
	[access] [varchar](10) NULL DEFAULT (NULL),
	[sql_type] [char](1) NOT NULL DEFAULT (''),
	[image2] [varchar](255) NULL,
	[image3] [varchar](255) NULL,
	[image4] [varchar](255) NULL,
	[show_on_startpage] [tinyint] NOT NULL DEFAULT ('0'),
	[pub] [tinyint] NOT NULL DEFAULT ('0'),
	[parent] [varchar](32) NULL,
	[language] [varchar](25) NOT NULL DEFAULT ('english_EN'),
 CONSTRAINT [PK_tcms_products] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Objekt:  Table [#####downloads]    Skriptdatum: 09/02/2007 18:08:14 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [#####downloads](
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
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Objekt:  Table [#####albums]    Skriptdatum: 09/02/2007 18:07:05 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [#####albums](
	[uid] [varchar](12) NOT NULL DEFAULT (''),
	[title] [varchar](255) NULL DEFAULT (NULL),
	[album_id] [varchar](6) NOT NULL DEFAULT (''),
	[published] [int] NOT NULL DEFAULT ('0'),
	[desc] [text] NULL,
	[image] [varchar](255) NULL DEFAULT (NULL),
 CONSTRAINT [PK_tcms_albums] PRIMARY KEY CLUSTERED 
(
	[uid] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Objekt:  Table [#####content_languages]    Skriptdatum: 09/02/2007 18:08:01 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [#####content_languages](
	[uid] [varchar](5) NOT NULL,
	[content_uid] [varchar](5) NOT NULL,
	[language] [varchar](25) NOT NULL,
	[title] [varchar](255) NULL,
	[key] [varchar](255) NULL,
	[content00] [text] NULL,
	[content01] [text] NULL,
	[foot] [varchar](255) NULL,
	[autor] [varchar](255) NULL,
	[db_layout] [varchar](50) NOT NULL,
	[access] [varchar](10) NOT NULL,
	[in_work] [int] NOT NULL DEFAULT ('0'),
	[published] [int] NOT NULL DEFAULT ('0')
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO


ALTER TABLE [#####content_languages]
ADD CONSTRAINT pk_#####content_languages PRIMARY KEY ([uid]);






INSERT INTO [#####contactform] ([uid], [contact], [show_contacts_in_sidebar], [send_id], [contacttitle], [contactstamp], [access], [enabled], [use_adressbook], [use_contact], [show_contactemail], [contacttext])
VALUES ('contactform', '', 1, 'contactform', '', '', 'Public', 1, 0, 0, 0, '');



INSERT INTO [#####usergroup] ([uid], [name], [right])
VALUES ('418aed8f001f0b88e36bc68013000794', 'Editor', 3);


INSERT INTO [#####usergroup] ([uid], [name], [right])
VALUES ('7f2a4a04ddeffc7caa029e289be712a1', 'Writer', 2);


INSERT INTO [#####usergroup] ([uid], [name], [right])
VALUES ('8a318ecd72b639ceca72c87dbc6f241c', 'Administrator', 1)


INSERT INTO [#####usergroup] ([uid], [name], [right])
VALUES ('c4e1aea1d163b0d3b3db90b667a2ba81', 'User', 5);


INSERT INTO [#####usergroup] ([uid], [name], [right])
VALUES ('daf91e6be506252b897977537fa488c8', 'Developer', 0);


INSERT INTO [#####usergroup] ([uid], [name], [right])
VALUES ('fcc0abe286b322744765b271c8ede1fd', 'Presenter', 4);

INSERT INTO [#####userpage] ([uid], [text_width], [input_width], [news_publish], [image_publish], [album_publish], [cat_publish], [pic_publish])
VALUES ('userpage', '150', '150', 1, 1, 1, 1, '1');


INSERT INTO [#####downloads_config] ([uid], [download_id], [download_title], [download_stamp], [download_text])
VALUES ('download', 'download', 'Downloads and Software', 'Toenda Software Downloads', 'Our software downloads.');

INSERT INTO [#####guestbook] ([uid], [guest_id], [booktitle], [bookstamp], [access], [enabled], [clean_link], [clean_script], [convert_at], [show_email], [name_width], [text_width], [color_row_1], [color_row_2])
VALUES ('guestbook', 'guestbook', 'My Guests', 'of this beautiful website', 'Public', 1, 1, 1, 1, 1, '140', '360', 'ffffff', 'f4f7fd'):


INSERT INTO [#####imagegallery_config] ([uid], [image_id], [image_title], [image_stamp], [image_details], [use_comments], [access], [max_image], [needle_image], [show_lastimg_title], [align_image], [size_image], [image_sort], [list_option])
VALUES ('imagegallery', 'imagegallery', 'Imagegallery', 'Picture i like', 0, 1, 'Public', 5, 'Last uploaded', 1, 'center', 100, 'desc', 0);

INSERT INTO [#####knowledgebase_config] ([uid], [id], [title], [subtitle], [text], [enabled], [autor_enabled], [access])
VALUES ('knowledgebase', 'knowledgebase', 'FAQs and Articles', 'A small knowledge database', 'Here you will find an example set of FAQs and Articles.', 1, 0, 'Public');


INSERT INTO [#####links_config] ([uid], [link_use_side_desc], [link_use_side_title], [link_side_title], [link_use_main_desc], [link_main_title], [link_main_subtitle], [link_main_text], [link_main_access])
VALUES ('links_config_main', NULL, NULL, NULL, 1, 'myLinks', 'A list of all websites i like', 'This is a example [text] for the [text]link page.', 'Public');


INSERT INTO [#####links_config] ([uid], [link_use_side_desc], [link_use_side_title], [link_side_title], [link_use_main_desc], [link_main_title], [link_main_subtitle], [link_main_text], [link_main_access])
VALUES ('links_config_side', 0, 1, 'Blogroll', NULL, NULL, NULL, NULL, NULL);


INSERT INTO [#####news_categories] ([uid], [name], [desc])
VALUES ('erdf4', 'Uncategorized', 'News without a category.');

INSERT INTO [#####newsletter] ([uid], [nl_title], [nl_show_title], [nl_text], [nl_link])
VALUES ('newsletter', '', 1, '', 'Submit');


INSERT INTO [#####poll_config] ([uid], [poll_title], [allpoll_title], [show_poll_title], [poll_side_width], [poll_main_width], [poll_sm_title], [use_poll_sidemenu], [poll_sidemenu_id], [poll_tm_title], [use_poll_topmenu], [poll_topmenu_id])
VALUES ('poll', 'Poll', 'All Polls', 1, 110, 700, 'Poll', 1, 2, 'Poll', 0, 4);

UPDATE [#####products_config] SET 
[products_id] = 'products', [products_title] = 'Products', [products_stamp] = '', [products_text] = '', [category_state] = 'software', [category_title] = 'Product Categories', [use_category_title] = 1, [language] = 'english_EN', [show_price_only_users] = NULL, [startpagetitle] = NULL, [use_sidebar_categories] = 1, [max_latest_products] = 15 WHERE [uid] = 'products';




INSERT INTO [#####sidebar_extensions] ([uid], [sidemenu_title], [sidemenu], [sidebar_title], [show_sidebar_title], [chooser_title], [show_chooser_title], [search_title], [show_search_title], [search_alignment], [search_withbr], [search_withbutton], [search_word], [login_title], [usermenu_title], [nologin], [reg_link], [reg_user], [reg_pass], [login_user], [usermenu], [show_login_title], [show_news_cat_amount], [show_memberlist])
VALUES ('sidebar_extensions', 'Sidemenu', 0, 'Sidebar', 0, 'Showcase', 1, 'Search our website', 0, 'left', 0, 0, 'Search website', 'Login', 'Usermenu', 'No account yet?', 'Create one', 'Username', 'Password', 1, 1, 1, 1, 0);

INSERT INTO [#####frontpage] ([uid], [front_id], [front_title], [front_stamp], [front_text], [news_title], [news_cut], [module_use_0], [sb_news_title], [sb_news_amount], [sb_news_chars], [sb_news_enabled], [sb_news_display], [language]) 
VALUES ('frontpage', 'frontpage', '', '', '', '', 0, 3, '', 5, 100, 1, 3, 'english_EN');

INSERT INTO [#####impressum] ([uid], [imp_id], [imp_title], [imp_stamp], [imp_contact], [taxno], [ustid], [legal], [language]) 
VALUES ('impressum', 'impressum', 'Disclaimer', '', '10a1b5f6ab', '', '', '', 'english_EN');

INSERT INTO [#####newsmanager] ([uid], [news_id], [news_title], [news_stamp], [news_image], [use_comments], [show_autor], [show_autor_as_link], [news_amount], [access], [news_cut], [use_gravatar], [use_emoticons], [use_rss091], [use_rss10], [use_rss20], [use_atom03], [use_opml], [syn_amount], [use_syn_title], [def_feed], [use_trackback], [use_timesince], [news_text], [readmore_link], [news_spacing], [language]) 
VALUES ('newsmanager', 'newsmanager', 'News', 'Current', ' ', 1, 0, 0, 20, 'Public', 0, 0, 1, 1, 1, 1, 1, 1, 5, 1, 'RSS2.0', 0, 0, 'testext ', 0, 25, 'english_EN');

