<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Admin Framework - Top Menu
|
| File:	admin_top_menu.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Admin Framework - Top Menu
 *
 * This is used as top menu.
 *
 * @version 1.0.5
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS-Backend
 */


if(isset($_GET['category'])){ $category = $_GET['category']; }
if(isset($_POST['category'])){ $category = $_POST['category']; }

if(isset($_GET['gg_albums'])){ $gg_albums = $_GET['gg_albums']; }
if(isset($_POST['gg_albums'])){ $gg_albums = $_POST['gg_albums']; }



if(!isset($adminTopmenu)) $adminTopmenu = 0;

$position_top = 62;
$position_help = 509;
?>

<table cellpadding="0" width="100%" cellspacing="0" border="0" class="tcms_top_menu_line" style="top: 42px; height: 24px;">

<tr>
	<td class="tcms_top_menu">
	<div id="tcmsMenuID"></div>
	<script language="JavaScript" type="text/javascript">
	<?
	switch($adminTopmenu){
		case 0: ?>
			var tcmsMenu = [
				[null,'&nbsp;<? echo _TCMS_TOPMENU_MAIN; ?>&nbsp;',null,null,null,
					['<img src="../images/home.png" />','<? echo _TCMS_MENU_HOME; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_start','_self',null], 
					['<img src="../images/editbook.png" />','<? echo _TCMS_MENU_NOTE; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_notebook','_self',null], 
					['<img src="../images/exit.png" />','<? echo _TCMS_MENU_LOGOUT; ?>','admin.php?todo=logout&id_user=<? echo $id_user; ?>','_self',null]
				], 
				
				
				[null,'&nbsp;<? echo _TCMS_TOPMENU_MANAGE; ?>&nbsp;',null,null,null,
					['<img src="../images/cat.png" />','<? echo _TCMS_MENU_NEWS_CATEGORIES; ?>', null, '_self',null, 
						['<img src="../images/cat.png" />','<? echo _TCMS_ADMIN_LIST; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_news_categories','_self',null], 
						['<img src="../images/cat_add.png" />','<? echo _TCMS_ADMIN_NEW_ITEM; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_news_categories&todo=edit','_self',null]
					], 
					['<img src="../images/media.png" />','<? echo _TCMS_MENU_MEDIA; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_media','_self',null], 
					['<img src="../images/comment.png" />','<? echo _TCMS_MENU_COMMENTS; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_comments','_self',null], 
				<? if($id_group == 'Developer' || $id_group == 'Administrator'){ ?>
					['<img src="../images/guests.png" />','<? echo _TCMS_MENU_GUESTBOOK; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_guestbook','_self',null], 
				<? } ?>
					['<img src="../images/desktop.png" />','<? echo _TCMS_MENU_PAGE; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_page','_self',null]
				], 
				
				
				<? if($id_group == 'Developer' || $id_group == 'Administrator'){ ?>
				[null,'&nbsp;<? echo _TCMS_TOPMENU_NAVIGATION; ?>&nbsp;',null,null,null,
					['<img src="../images/menu.png" />','<? echo _TCMS_MENU_TOPMENU; ?>', null, '_self',null,
						['<img src="../images/menu.png" />','<? echo _TCMS_ADMIN_LIST; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_topmenu','_self',null], 
						['<img src="../images/menu_add.png" />','<? echo _TCMS_ADMIN_NEW_ITEM; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_topmenu&todo=edit','_self',null]
					], 
					['<img src="../images/menu.png" />','<? echo _TCMS_MENU_SIDEMENU; ?>', null, '_self',null,
						['<img src="../images/menu.png" />','<? echo _TCMS_ADMIN_LIST; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_sidemenu','_self',null], 
						['<img src="../images/menu_add.png" />','<? echo _TCMS_ADMIN_NEW_ITEM; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_sidemenu&todo=edit','_self',null]
					]
				], 
				<? } ?>
				
				
				[null,'&nbsp;<? echo _TCMS_TOPMENU_CONTENT; ?>&nbsp;',null,null,null,
				<? if($id_group == 'Developer' || $id_group == 'Administrator' || $id_group == 'Writer'){ ?>
					['<img src="../images/page.png" />','<? echo _TCMS_MENU_CONTENT; ?>', null, '_self',null,
						['<img src="../images/page.png" />','<? echo _TCMS_ADMIN_LIST; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_content','_self',null], 
						['<img src="../images/page_add.png" />','<? echo _TCMS_ADMIN_NEW_ITEM; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_content&todo=edit','_self',null]
					], 
				<? } ?>
					['<img src="../images/news.png" />','<? echo _TCMS_MENU_NEWS; ?>', null, '_self',null,
						['<img src="../images/news.png" />','<? echo _TCMS_ADMIN_LIST; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_news','_self',null], 
						['<img src="../images/news_add.png" />','<? echo _TCMS_ADMIN_NEW_ITEM; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_news&todo=edit','_self',null], 
						['<img src="../images/config.png" />','<? echo _TCMS_ADMIN_CONFIG; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_news&todo=config','_self',null]
					], 
					['<img src="../images/link.png" />','<? echo _TCMS_MENU_LINK; ?>', null, '_self',null,
						['<img src="../images/link.png" />','<? echo _TCMS_ADMIN_LIST; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_links','_self',null], 
						['<img src="../images/link_add.png" />','<? echo _TCMS_ADMIN_NEW_ITEM; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_links&todo=edit','_self',null], 
						['<img src="../images/config.png" />','<? echo _TCMS_ADMIN_CONFIG; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_links&todo=config','_self',null]
					], 
					['<img src="../images/faq_db.png" />','<? echo _TCMS_MENU_FAQ; ?>', null, '_self',null,
						['<img src="../images/faq_db.png" />','<? echo _TCMS_ADMIN_LIST; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_knowledgebase','_self',null], 
						['<img src="../images/db_cat_add.png" />','<? echo _TCMS_ADMIN_NEW_CATEGORY; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_knowledgebase&todo=edit&type=c','_self',null],
						['<img src="../images/faq_db_add.png" />','<? echo _TCMS_ADMIN_NEW_ITEM; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_knowledgebase&todo=edit&type=a','_self',null], 
						['<img src="../images/config.png" />','<? echo _TCMS_ADMIN_CONFIG; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_knowledgebase&todo=config','_self',null]
					], 
				<? if($id_group == 'Developer' || $id_group == 'Administrator' || $id_group == 'Writer'){ ?>
					['<img src="../images/zip.png" />','<? echo _TCMS_MENU_DOWN; ?>', null, '_self',null,
						['<img src="../images/zip.png" />','<? echo _TCMS_ADMIN_LIST; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_download','_self',null], 
						['<img src="../images/db_cat_add.png" />','<? echo _TCMS_ADMIN_NEW_CATEGORY; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_download&todo=create','_self',null], 
						['<img src="../images/zip_add.png" />','<? echo _TCMS_ADMIN_NEW_ITEM; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_download&todo=edit','_self',null], 
						['<img src="../images/config.png" />','<? echo _TCMS_ADMIN_CONFIG; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_download&todo=config','_self',null]
					], 
				<? } ?>
					['<img src="../images/cart.png" />','<? echo _TCMS_MENU_PRODUCTS; ?>', null, '_self', null, 
						['<img src="../images/cart.png" />','<? echo _TCMS_ADMIN_LIST; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_products','_self',null], 
						['<img src="../images/db_cat_add.png" />','<? echo _TCMS_ADMIN_NEW_CATEGORY; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_products&todo=edit&type=c','_self',null], 
						['<img src="../images/cart_add.png" />','<? echo _TCMS_ADMIN_NEW_ITEM; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_products&todo=edit&type=a','_self',null], 
						['<img src="../images/config.png" />','<? echo _TCMS_ADMIN_CONFIG; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_products&todo=config','_self',null]
					], 
					['<img src="../images/image.png" />','<? echo _TCMS_MENU_GALLERY; ?>', null, '_self', null,
						['<img src="../images/image.png" />','<? echo _TCMS_ADMIN_LIST; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_gallery','_self',null], 
						['<img src="../images/image_album_add.png" />','<? echo _TCMS_ADMIN_CREATE; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_gallery&todo=createAlbum','_self',null],
						['<img src="../images/image_ftpalbum_add.png" />','<? echo _TCMS_ADMIN_NEW_FTPALBUM; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_gallery&gg_albums=createftp','_self',null],
						['<img src="../images/config.png" />','<? echo _TCMS_ADMIN_CONFIG; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_gallery&todo=config','_self',null]
					]
				], 
				
				
				<? if($id_group == 'Developer' || $id_group == 'Administrator' || $id_group == 'Writer'){ ?>
				[null,'&nbsp;<? echo _TCMS_TOPMENU_SIDEBAR; ?>&nbsp;',null,null,null,
					['<img src="../images/side.png" />','<? echo _TCMS_MENU_SIDE; ?>', null, '_self', null, 
						['<img src="../images/side.png" />','<? echo _TCMS_ADMIN_LIST; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_side','_self',null], 
						['<img src="../images/side_add.png" />','<? echo _TCMS_ADMIN_NEW_ITEM; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_side&todo=edit','_self',null]
					], 
					['<img src="../images/poll.png" />','<? echo _TCMS_MENU_POLL; ?>', null, '_self',null,
						['<img src="../images/poll.png" />','<? echo _TCMS_ADMIN_LIST; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_poll','_self',null], 
						['<img src="../images/poll_add.png" />','<? echo _TCMS_ADMIN_NEW_POLL; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_poll&todo=edit','_self',null]
					], 	
					['<img src="../images/letter.png" />','<? echo _TCMS_MENU_NEWSLETTER; ?>', null, null, null, 
						['<img src="../images/letter.png" />','<? echo _NL_SEND; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_newsletter','_self',null], 
						['<img src="../images/letter.png" />','<? echo _TCMS_ADMIN_LIST; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_newsletter&todo=listNL','_self',null], 
						['<img src="../images/letter_add.png" />','<? echo _TCMS_ADMIN_NEW_ITEM; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_newsletter&todo=edit','_self',null]
						<? if($id_group == 'Developer' || $id_group == 'Administrator'){ ?>
							, ['<img src="../images/config.png" />','<? echo _TCMS_ADMIN_CONFIG; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_newsletter&todo=config','_self',null]
						<? } ?>
					], 
					['<img src="../images/extensions.gif" />','<? echo _TCMS_MENU_SIDEEXT; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_side_extensions','_self',null]
				], 
				<? } ?>
				
				
				[null,'&nbsp;<? echo _TCMS_TOPMENU_EXTENSIONS; ?>&nbsp;',null,null,null,
					['<img src="../images/user.png" />','<? echo _TCMS_MENU_USER; ?>', null, '_self',null,
					<? if($id_group == 'Developer' || $id_group == 'Administrator'){ ?>
						['<img src="../images/user.png" />','<? echo _TCMS_ADMIN_LIST; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_user','_self',null], 
						['<img src="../images/user_add.png" />','<? echo _TCMS_ADMIN_NEW_USER; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_user&todo=edit','_self',null]
					<? } else { ?>
						['<img src="../images/user.png" />','<? echo _LOGIN_PROFILE; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_user&todo=edit&maintag=<? echo $id_uid; ?>','_self',null]
					<? } ?>
					],
				<? if($id_group == 'Developer' || $id_group == 'Administrator'){ ?>
					['<img src="../images/people.png" />','<? echo _TCMS_MENU_CONTACT; ?>', null, '_self',null, 
						['<img src="../images/people.png" />','<? echo _TCMS_ADMIN_LIST; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_contact','_self',null], 
						['<img src="../images/people_add.png" />','<? echo _TCMS_ADMIN_NEW_ITEM; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_contact&todo=edit','_self',null], 
						['<img src="../images/vcard.png" />','<? echo _TCMS_ADMIN_IMPORT.' '._CONTACT_VCARD; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_contact&todo=import','_self',null]
					], 
					['<img src="../images/front.png" />', '<? echo _TCMS_MENU_FRONT; ?>', 'admin.php?id_user=<? echo $id_user; ?>&site=mod_frontpage', '_self', null], 
					['<img src="../images/extensions.gif" />','<? echo _TCMS_MENU_CFORM; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_contactform','_self',null], 
					['<img src="../images/guests.gif" />','<? echo _TCMS_MENU_BOOK; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_guestbook_config','_self',null], 
					['<img src="../images/impressum.png" />','<? echo _TCMS_MENU_IMP; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_imprint','_self',null]
				<? } ?>
				], 
				
				
				<? if($id_group == 'Developer' || $id_group == 'Administrator'){ ?>
				[null,'&nbsp;<? echo _TCMS_TOPMENU_COMPONENTS; ?>&nbsp;',null,null,null,
					['<img src="../images/cs.gif" />','<? echo _TCMS_MENU_CS; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_components','_self',null], 
					['<img src="../images/cs_upload.png" />','<? echo _TCMS_MENU_CS_UPLOAD; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_upload_components','_self',null]
				], 
				[null,'&nbsp;<? echo _TCMS_TOPMENU_SITE; ?>&nbsp;',null,null,null,
					['<img src="../images/config.gif" />','<? echo _TCMS_MENU_GLOBAL; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_global','_self',null], 
					['<img src="../images/import.png" />','<? echo _TCMS_MENU_IMPORT; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_import','_self',null], 
					['<img src="../images/log.png" />','<? echo _TCMS_MENU_LOG; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_log','_self',null], 
					['<img src="../images/stats.png" />','<? echo _TCMS_MENU_STATS; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_stats','_self',null], 
					['<img src="../images/template.png" />','<? echo _TCMS_MENU_THEME; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_layout','_self',null], 
					['<img src="../images/template_upload.png" />','<? echo _TCMS_MENU_THEME_UPLOAD; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_upload_layout','_self',null], 
					['<img src="../images/preview.png" />','&raquo; <? echo _TCMS_MENU_THEME_PREVIEW; ?>','../../index.php','_self',null]
				], 
				<? } ?>
				
				
				[null,'&nbsp;<? echo _TCMS_TOPMENU_HELP; ?>&nbsp;',null,null,null,
					['<img src="../images/help.png" />','<? echo _TCMS_MENU_HELP; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_help','_self',null], 
					['<img src="../images/info.png" />','<? echo _TCMS_MENU_CREDITS; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_credits','_self',null], 
					['<img src="../images/about.png" />','<? echo _TCMS_MENU_ABOUT; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_about','_self',null]
				]
			];
			<?
			break;
		
		case 1:
			?>
			var tcmsMenu = [
				[null,'&nbsp;<? echo _TCMS_TOPMENU_MAIN; ?>&nbsp;',null,null,null,
					['<img src="../images/home.png" />','<? echo _TCMS_MENU_HOME; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_start','_self',null], 
					['<img src="../images/editbook.png" />','<? echo _TCMS_MENU_NOTE; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_notebook','_self',null], 
					['<img src="../images/exit.png" />','<? echo _TCMS_MENU_LOGOUT; ?>','admin.php?todo=logout&id_user=<? echo $id_user; ?>','_self',null]
				], 
				
				
				[null,'&nbsp;<? echo _TCMS_TOPMENU_MANAGE; ?>&nbsp;',null,null,null,
				<? if($id_group == 'Developer' || $id_group == 'Administrator'){ ?>
					['<img src="../images/template.png" />','<? echo _TCMS_TOPMENU_NAVIGATION; ?>',null,null,null,
						['<img src="../images/menu.png" />','<? echo _TCMS_MENU_TOPMENU; ?>', null, '_self',null,
							['<img src="../images/menu.png" />','<? echo _TCMS_ADMIN_LIST; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_topmenu','_self',null], 
							['<img src="../images/menu_add.png" />','<? echo _TCMS_ADMIN_NEW_ITEM; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_topmenu&todo=edit','_self',null]
						], 
						['<img src="../images/menu.png" />','<? echo _TCMS_MENU_SIDEMENU; ?>', null, '_self',null,
							['<img src="../images/menu.png" />','<? echo _TCMS_ADMIN_LIST; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_sidemenu','_self',null], 
							['<img src="../images/menu_add.png" />','<? echo _TCMS_ADMIN_NEW_ITEM; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_sidemenu&todo=edit','_self',null]
						]
					], 
					<? } ?>
					['<img src="../images/cat.png" />','<? echo _TCMS_MENU_NEWS_CATEGORIES; ?>', null, '_self',null, 
						['<img src="../images/cat.png" />','<? echo _TCMS_ADMIN_LIST; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_news_categories','_self',null], 
						['<img src="../images/cat_add.png" />','<? echo _TCMS_ADMIN_NEW_ITEM; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_news_categories&todo=edit','_self',null]
					], 
				<? if($id_group == 'Developer' || $id_group == 'Administrator' || $id_group == 'Writer'){ ?>
					['<img src="../images/poll.png" />','<? echo _TCMS_MENU_POLL; ?>', null, '_self',null,
						['<img src="../images/poll.png" />','<? echo _TCMS_ADMIN_LIST; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_poll','_self',null], 
						['<img src="../images/poll_add.png" />','<? echo _TCMS_ADMIN_NEW_POLL; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_poll&todo=edit','_self',null]
					], 
					['<img src="../images/letter.png" />','<? echo _TCMS_MENU_NEWSLETTER; ?>', null, null, null, 
						['<img src="../images/letter.png" />','<? echo _NL_SEND; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_newsletter','_self',null], 
						['<img src="../images/letter.png" />','<? echo _TCMS_ADMIN_LIST; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_newsletter&todo=listNL','_self',null], 
						['<img src="../images/letter_add.png" />','<? echo _TCMS_ADMIN_NEW_ITEM; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_newsletter&todo=edit','_self',null]
					], 
				<? } ?>
					['<img src="../images/media.png" />','<? echo _TCMS_MENU_MEDIA; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_media','_self',null], 
					['<img src="../images/comment.png" />','<? echo _TCMS_MENU_COMMENTS; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_comments','_self',null], 
				<? if($id_group == 'Developer' || $id_group == 'Administrator'){ ?>
					['<img src="../images/guests.png" />','<? echo _TCMS_MENU_GUESTBOOK; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_guestbook','_self',null], 
				<? } ?>
					['<img src="../images/desktop.png" />','<? echo _TCMS_MENU_PAGE; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_page','_self',null]
				], 
				
				
				[null,'&nbsp;<? echo _TCMS_TOPMENU_SETTINGS; ?>&nbsp;',null,null,null,
				<? if($id_group == 'Developer' || $id_group == 'Administrator'){ ?>
					['<img src="../images/config.png" />', '<? echo _TCMS_TOPMENU_CONF_MODULE; ?>', null, null, null,
						['<img src="../images/news.png" />','<? echo _TCMS_MENU_NEWS; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_news&todo=config','_self',null], 
						['<img src="../images/link.png" />','<? echo _TCMS_MENU_LINK; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_links&todo=config','_self',null], 
						['<img src="../images/faq_db.png" />','<? echo _TCMS_MENU_FAQ; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_knowledgebase&todo=config','_self',null], 
						['<img src="../images/zip.png" />','<? echo _TCMS_MENU_DOWN; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_download&todo=config','_self',null], 
						['<img src="../images/cart.png" />','<? echo _TCMS_MENU_PRODUCTS; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_products&todo=config','_self',null], 
						['<img src="../images/image.png" />','<? echo _TCMS_MENU_GALLERY; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_gallery&todo=config','_self',null], 
						['<img src="../images/letter.png" />','<? echo _TCMS_MENU_NEWSLETTER; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_newsletter&todo=config','_self',null]
					], 
				<? } ?>
					['<img src="../images/user.png" />','<? echo _TCMS_MENU_USER; ?>', null, '_self',null,
					<? if($id_group == 'Developer' || $id_group == 'Administrator'){ ?>
						['<img src="../images/user_add.png" />','<? echo _TCMS_ADMIN_NEW_USER; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_user&todo=edit','_self',null], 
						['<img src="../images/user.png" />','<? echo _TCMS_ADMIN_LIST; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_user','_self',null]
					<? } else { ?>
						['<img src="../images/user.png" />','<? echo _LOGIN_PROFILE; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_user&todo=edit&maintag=<? echo $id_uid; ?>','_self',null]
					<? } ?>
					],
				<? if($id_group == 'Developer' || $id_group == 'Administrator'){ ?>
					['<img src="../images/people.png" />','<? echo _TCMS_MENU_CONTACT; ?>', null, '_self',null, 
						['<img src="../images/people.png" />','<? echo _TCMS_ADMIN_LIST; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_contact','_self',null], 
						['<img src="../images/people_add.png" />','<? echo _TCMS_ADMIN_NEW_ITEM; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_contact&todo=edit','_self',null], 
						['<img src="../images/vcard.png" />','<? echo _TCMS_ADMIN_IMPORT.' '._CONTACT_VCARD; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_contact&todo=import','_self',null]
					],
					['<img src="../images/front.png" />', '<? echo _TCMS_MENU_FRONT; ?>', 'admin.php?id_user=<? echo $id_user; ?>&site=mod_frontpage', '_self', null], 
					['<img src="../images/extensions.gif" />','<? echo _TCMS_MENU_SIDE.' '._TCMS_MENU_SIDEEXT; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_side_extensions','_self',null], 
					['<img src="../images/extensions.gif" />','<? echo _TCMS_MENU_CFORM; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_contactform','_self',null], 
					['<img src="../images/guests.gif" />','<? echo _TCMS_MENU_BOOK; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_guestbook_config','_self',null], 
					['<img src="../images/impressum.png" />','<? echo _TCMS_MENU_IMP; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_imprint','_self',null],
				<? } ?>
					['<img src="../images/config.gif" />','<? echo _TCMS_MENU_GLOBAL; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_global','_self',null], 
				], 
				
				
				[null,'&nbsp;<? echo _TCMS_TOPMENU_CONTENT; ?>&nbsp;',null,null,null,
				<? if($id_group == 'Developer' || $id_group == 'Administrator' || $id_group == 'Writer'){ ?>
					['<img src="../images/page.png" />','<? echo _TCMS_MENU_CONTENT; ?>', null, '_self',null,
						['<img src="../images/page.png" />','<? echo _TCMS_ADMIN_LIST; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_content','_self',null], 
						['<img src="../images/page_add.png" />','<? echo _TCMS_ADMIN_NEW_ITEM; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_content&todo=edit','_self',null]
					], 
				<? } ?>
					['<img src="../images/news.png" />','<? echo _TCMS_MENU_NEWS; ?>', null, '_self',null,
						['<img src="../images/news.png" />','<? echo _TCMS_ADMIN_LIST; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_news','_self',null], 
						['<img src="../images/news_add.png" />','<? echo _TCMS_ADMIN_NEW_ITEM; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_news&todo=edit','_self',null]
					], 
					['<img src="../images/link.png" />','<? echo _TCMS_MENU_LINK; ?>', null, '_self',null,
						['<img src="../images/link.png" />','<? echo _TCMS_ADMIN_LIST; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_links','_self',null], 
						['<img src="../images/link_add.png" />','<? echo _TCMS_ADMIN_NEW_ITEM; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_links&todo=edit','_self',null]
					], 
					['<img src="../images/faq_db.png" />','<? echo _TCMS_MENU_FAQ; ?>', null, '_self',null,
						['<img src="../images/faq_db.png" />','<? echo _TCMS_ADMIN_LIST; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_knowledgebase','_self',null], 
						['<img src="../images/db_cat_add.png" />','<? echo _TCMS_ADMIN_NEW_CATEGORY; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_knowledgebase&todo=edit&type=c','_self',null],
						['<img src="../images/faq_db_add.png" />','<? echo _TCMS_ADMIN_NEW_ITEM; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_knowledgebase&todo=edit&type=a','_self',null]
					], 
				<? if($id_group == 'Developer' || $id_group == 'Administrator' || $id_group == 'Writer'){ ?>
					['<img src="../images/zip.png" />','<? echo _TCMS_MENU_DOWN; ?>', null, '_self',null,
						['<img src="../images/zip.png" />','<? echo _TCMS_ADMIN_LIST; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_download','_self',null], 
						['<img src="../images/db_cat_add.png" />','<? echo _TCMS_ADMIN_NEW_CATEGORY; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_download&todo=create','_self',null], 
						['<img src="../images/zip_add.png" />','<? echo _TCMS_ADMIN_NEW_ITEM; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_download&todo=edit','_self',null]
					], 
				<? } ?>
					['<img src="../images/cart.png" />','<? echo _TCMS_MENU_PRODUCTS; ?>', null, '_self', null, 
						['<img src="../images/cart.png" />','<? echo _TCMS_ADMIN_LIST; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_products','_self',null], 
						['<img src="../images/db_cat_add.png" />','<? echo _TCMS_ADMIN_NEW_CATEGORY; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_products&todo=edit&type=c', '_self', null], 
						['<img src="../images/cart_add.png" />','<? echo _TCMS_ADMIN_NEW_ITEM; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_products&todo=edit&type=a', '_self', null]
					], 
					['<img src="../images/image.png" />','<? echo _TCMS_MENU_GALLERY; ?>', null, '_self', null,
						['<img src="../images/image.png" />','<? echo _TCMS_ADMIN_LIST; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_gallery','_self',null], 
						['<img src="../images/image_album_add.png" />','<? echo _TCMS_ADMIN_CREATE; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_gallery&todo=createAlbum','_self',null],
						['<img src="../images/image_ftpalbum_add.png" />','<? echo _TCMS_ADMIN_NEW_FTPALBUM; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_gallery&gg_albums=createftp','_self',null]
					], 
				<? if($id_group == 'Developer' || $id_group == 'Administrator' || $id_group == 'Writer'){ ?>
					['<img src="../images/side.png" />','<? echo _TCMS_MENU_SIDE; ?>', null, '_self', null, 
						['<img src="../images/side.png" />','<? echo _TCMS_ADMIN_LIST; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_side','_self',null], 
						['<img src="../images/side_add.png" />','<? echo _TCMS_ADMIN_NEW_ITEM; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_side&todo=edit','_self',null]
					], 
				<? } ?>
				], 
				
				
				<? if($id_group == 'Developer' || $id_group == 'Administrator'){ ?>
				[null,'&nbsp;<? echo _TCMS_TOPMENU_COMPONENTS; ?>&nbsp;',null,null,null,
					['<img src="../images/cs.gif" />','<? echo _TCMS_MENU_CS; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_components','_self',null], 
					['<img src="../images/cs_upload.png" />','<? echo _TCMS_MENU_CS_UPLOAD; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_upload_components','_self',null]
				], 
				
				
				[null,'&nbsp;<? echo _TCMS_TOPMENU_SITE; ?>&nbsp;',null,null,null,
					['<img src="../images/import.png" />','<? echo _TCMS_MENU_IMPORT; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_import','_self',null], 
					['<img src="../images/stats.png" />','<? echo _TCMS_MENU_STATS; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_stats','_self',null], 
					['<img src="../images/log.png" />','<? echo _TCMS_MENU_LOG; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_log','_self',null], 
					['<img src="../images/template.png" />','<? echo _TCMS_MENU_THEME; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_layout','_self',null], 
					['<img src="../images/template_upload.png" />','<? echo _TCMS_MENU_THEME_UPLOAD; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_upload_layout','_self',null], 
					['<img src="../images/preview.png" />','&raquo; <? echo _TCMS_MENU_THEME_PREVIEW; ?>','../../index.php','_self',null]
				], 
				<? } ?>
				
				
				[null,'&nbsp;<? echo _TCMS_TOPMENU_HELP; ?>&nbsp;',null,null,null,
					['<img src="../images/help.png" />','<? echo _TCMS_MENU_HELP; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_help','_self',null], 
					['<img src="../images/info.png" />','<? echo _TCMS_MENU_CREDITS; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_credits','_self',null], 
					['<img src="../images/about.png" />','<? echo _TCMS_MENU_ABOUT; ?>','admin.php?id_user=<? echo $id_user; ?>&site=mod_about','_self',null]
				]
			];
			<?
			break;
	}
	?>
	
	var tmpClickOpen = cmThemeOffice.clickOpen;
	cmThemeOffice.clickOpen = 2;
	cmDraw('tcmsMenuID', tcmsMenu, 'hbr', cmThemeOffice, 'ThemeOffice');
	cmThemeOffice.clickOpen = tmpClickOpen;
	</script>
	</td>
	
	<td class="tcms_top_menu_tape" align="right"><?
		
		if($choosenDB == 'xml') {
			$strMore = '&amp;setXMLSession=1';
		}
		else{
			$strMore = '';
		}
		
		echo '( <a href="../../index.php?session='.$id_user.$strMore.'">'._TCMS_ADMIN_GOTOSITE.'</a> ) ';
		echo _TCMS_ADMIN_LOGED.': ';
		echo '<span class="tcms_top_menu_loged">'.$id_username.' ( '.$id_group.' )</span>&nbsp;';
	?></td>
</tr>
</table><?





/*
	Toolbar Loader
*/
echo '<table cellpadding="0" width="100%" cellspacing="0" class="tcms_top_menu_line" border="0">'
.'<tr style="background-color: #f5f5f5;">'
.'<td align="left" width="300" valign="middle" style="height: 36px !important; background-color: #f5f5f5;" class="tcms_toolbar">';


// buttons
echo '<a style="padding: 3px 3px 0 3px;" href="admin.php?id_user='.$id_user.'&amp;site=mod_start">'
.'<img title="'._TCMS_MENU_HOME.'" alt="'._TCMS_MENU_HOME.'" src="../images/admin_menu/gohome.png" border="0" />'
.'</a>';

echo '<a style="padding: 3px 3px 0 3px;" href="admin.php?id_user='.$id_user.'&amp;site=mod_page">'
.'<img title="'._TCMS_MENU_PAGE.'" alt="'._TCMS_MENU_PAGE.'" src="../images/admin_menu/desktop.png" border="0" />'
.'</a>';

if($id_group == 'Developer' || $id_group == 'Administrator'){
	echo '<a style="padding: 3px 3px 0 3px;" href="admin.php?id_user='.$id_user.'&amp;site=mod_newpage">'
	.'<img title="'._TCMS_ADMIN_NEWPAGE.'" alt="'._TCMS_ADMIN_NEWPAGE.'" src="../images/admin_menu/new_page.png" border="0" />'
	.'</a>';
}


// init
if(!isset($todo)) {
	$todo = 'show';
}

if(!isset($gg_albums)) {
	$gg_albums = 'show';
}



// include toolbar
if(file_exists('toolbars/'.$mod_title['show'][$site]) && $mod_title['show'][$site] != ''){
	include_once('toolbars/'.$mod_title['show'][$site]);
}


// rest
if($mod_title['show'][$site] == 1){
	echo '<img src="../images/admin_menu/line.gif" border="0" />';
	
	if($todo == 'config'){
		echo '<a style="padding: 3px 3px 0 3px;" href="admin.php?id_user='.$id_user.'&amp;site='.$site.'"><img title="'._TCMS_ADMIN_BACK.'" alt="'._TCMS_ADMIN_BACK.'" src="../images/admin_menu/back.png" border="0" /></a>';
		echo '<img src="../images/admin_menu/line.gif" border="0" />';
	}
	
	if($todo == 'edit' || $todo == 'admin'){
		echo '<a style="padding: 3px 3px 0 3px;" href="admin.php?id_user='.$id_user.'&amp;site='.$site.'"><img title="'._TCMS_ADMIN_BACK.'" alt="'._TCMS_ADMIN_BACK.'" src="../images/admin_menu/back.png" border="0" /></a>';
		echo '<img src="../images/admin_menu/line.gif" border="0" />';
	}
	if($site != 'mod_frontpage'){
		echo '<a style="padding: 3px 3px 0 3px;" href="javascript:save();"><img title="'._TCMS_ADMIN_SAVE.'" alt="'._TCMS_ADMIN_SAVE.'" src="../images/admin_menu/save.png" border="0" /></a>';
	}
	
	if($site == 'mod_gallery' && $albums != 'edit'){
		echo '<a style="padding: 3px 3px 0 3px;" href="javascript:save_id(\'new\');">'._TCMS_ADMIN_CREATE.'</a>';
		echo '<a style="padding: 3px 3px 0 3px;" href="javascript:save_id(\'upload\');"><img title="'._TCMS_ADMIN_UPLOAD.'" alt="'._TCMS_ADMIN_UPLOAD.'" src="../images/admin_menu/upload.png" border="0" /></a>';
	}
	
	if($show_wysiwyg == 'tinymce' && $site == 'mod_frontpage'){
		echo '<a style="padding: 3px 3px 0 3px;" href="javascript:tinyMCE.triggerSave();save();"><img title="'._TCMS_ADMIN_SAVE.'" alt="'._TCMS_ADMIN_SAVE.'" src="../images/admin_menu/save.png" border="0" /></a>';
	}
	if($show_wysiwyg != 'tinymce' && $site == 'mod_frontpage'){
		echo '<a style="padding: 3px 3px 0 3px;" href="javascript:save();"><img title="'._TCMS_ADMIN_SAVE.'" alt="'._TCMS_ADMIN_SAVE.'" src="../images/admin_menu/save.png" border="0" /></a>';
	}
}


//*************
//
// DEFAULT
//
if($mod_title['show'][$site] == 2){
	echo '<img src="../images/admin_menu/line.gif" border="0" />';
	
	// CONFIG NEWS
	if($site == 'mod_links' && $todo != 'config'){
		echo '<a style="padding: 3px 3px 0 3px;" href="admin.php?id_user='.$id_user.'&amp;site='.$site.'&amp;todo=config"><img title="'._TCMS_ADMIN_CONFIG.'" alt="'._TCMS_ADMIN_CONFIG.'" src="../images/admin_menu/config.png" border="0" /></a>';
		echo '<img src="../images/admin_menu/line.gif" border="0" />';
	}
	if($todo == 'config'){
		echo '<a style="padding: 3px 3px 0 3px;" href="admin.php?id_user='.$id_user.'&amp;site='.$site.'"><img title="'._TCMS_ADMIN_BACK.'" alt="'._TCMS_ADMIN_BACK.'" src="../images/admin_menu/back.png" border="0" /></a>';
		echo '<img src="../images/admin_menu/line.gif" border="0" />';
	}
	
	// DEFAULT EDIT
	if($todo == 'edit' || $todo == 'listNL' || $todo == 'alwaysCheck'){
		echo '<a style="padding: 3px 3px 0 3px;" href="admin.php?id_user='.$id_user.'&amp;site='.$site.'"><img title="'._TCMS_ADMIN_BACK.'" alt="'._TCMS_ADMIN_BACK.'" src="../images/admin_menu/back.png" border="0" /></a>';
		echo '<img src="../images/admin_menu/line.gif" border="0" />';
	}
	
	// DO NOT SHOW AT NEWSLETTER LIST
	if($todo != 'listNL' && $todo != 'alwaysCheck'){
		// ONLY ADMIN USERS CAN USER SETTINGS CHANGE
		if($site == 'mod_user'){
			if($id_group == 'Developer' || $id_group == 'Administrator' || $id_group == 'Tester'){
				echo '<a style="padding: 3px 3px 0 3px;" href="admin.php?id_user='.$id_user.'&amp;site='.$site.'&amp;todo=edit"><img title="'._TCMS_ADMIN_NEW.'" alt="'._TCMS_ADMIN_NEW.'" src="../images/admin_menu/new_file.png" border="0" /></a>';
			}
		}
		else{
			if($site != 'mod_comments'){
				echo '<a style="padding: 3px 3px 0 3px;" href="admin.php?id_user='.$id_user.'&amp;site='.$site.'&amp;todo=edit"><img title="'._TCMS_ADMIN_NEW.'" alt="'._TCMS_ADMIN_NEW.'" src="../images/admin_menu/new_file.png" border="0" /></a>';
			}
		}
		
		// WYSIWYG
		if($site == 'mod_comments'){
			if($todo == 'edit'){
				echo '<a style="padding: 3px 3px 0 3px;" href="javascript:save();"><img title="'._TCMS_ADMIN_SAVE.'" alt="'._TCMS_ADMIN_SAVE.'" src="../images/admin_menu/save.png" border="0" /></a>';
			}
		}
		else{
			echo '<a style="padding: 3px 3px 0 3px;" href="javascript:save();"><img title="'._TCMS_ADMIN_SAVE.'" alt="'._TCMS_ADMIN_SAVE.'" src="../images/admin_menu/save.png" border="0" /></a>';
		}
	}
}



// table middle
echo '</td>'
.'<td align="left" valign="middle" style="height: 36px !important; background-color: #f5f5f5;" class="tcms_toolbar">'
.'<strong class="tcms_ft_white">'.$mod_title['name'][$site].'</strong>'
.'</td>';


// table left
echo '<td align="right" valign="middle" style="height: 36px !important; background-color: #f5f5f5;" class="tcms_toolbar">'
.'<a style="padding: 3px 3px 0 3px; margin: 3px 3px 0 3px;" href="admin.php?todo=logout&id_user='.$id_user.'">'
.'<img border="0" title="'. _TCMS_MENU_LOGOUT.'" alt="'._TCMS_MENU_LOGOUT.'" src="../images/admin_menu/logout.png" />'
.'</a>'
.'</td>';


// table end
echo '</tr></table>';

?>
