
         _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| README
|
+


This is the README file of the Content Management and Weblogging System
toendaCMS. toendaCMS is a professionell Content Management and Weblogging
System. On reading this, you gain information of the system, the settings
that are required and the CSS-Stylesheet tags that must be included in
your Stylesheet file of your Template.



		  System Reg.
**********************************************************************************
This are all modules with PHP must be compiled.

- 15 Megabyte free Webspace
- PHP Version 4 or 5 (at least 4.3.0)
    with GD
    with zLib
    at encoding problems:  with mbstring
    some newsletter usage: with imap
- register_global: OFF ( Not a MUSTBE, but for SECURITY REASON !!! )
- save_mode: OFF       ( Not a MUSTBE, but for USABILITY REASON !!! )

For the SQL database, on eof the follewing:
- MySQL Database
- postgreSQL Database
- Microsoft SQL Server 2000 / 2005


toendaCMS is developed for two ways of save data:
XML Flatfile System:
 Nothing is needed for this system. Only you free webspace is the barrier to your
 website. This system is perfect for small to normal website.

SQL Database System:
 You must have a MySQL database for this system. If you have many users and many data,
 so you should choose this system. Its better for great projects.

Please remember: You cannot change the database for a running website. I'm working
on a Import<->Export function



		  Warnings
**********************************************************************************
    NOTE FOR VERSIONS OLDER THAN --Development 0.9.9 Beta3--:
The old download manager is not compatible with the new one. Sorry, but the
old structure was too inflexible.

    NOTE FOR VERSIONS OLDER THAN --Development 0.5.7--:
With this release you cannot update your current toendaCMS site. We have
completly rewritten the most of the engine and extensions.

    XML DB WARNING:
If you want to update you currently site to toendaCMS 0.6.0 Beta3 you
cannot use your old XML Data. You can copy all content with the Administration
into your new site.




		  Installation
**********************************************************************************
Extract the package to an directory and start it using the url. For
example, write http://www.your-domain.com/ or http://www.your-domain.com/toendacms.
The press [Return] and you can see the toendaCMS startpage.
But, wheres your Website? Only the cms logo and a little text is visible.
Answer: The toendaCMS startpage has a link to its installer. Click on it and
follow the installation steps.

    

		  Update
**********************************************************************************

UPDATE FROM v1.0.2 TO v1.0.3
  If you cannot save user settings after update, execute the following SQL statement,
  but replace first the ##### with your database prefix:
  ALTER TABLE `#####user` CHANGE `group` `group` VARCHAR( 32 ) NOT NULL ;
  
  IF you cannot display the contactform and cannot save contactform settings after
  update, execute the following SQL statement, but replace first the ##### with
  your database prefix:
  ALTER TABLE `#####contactform` ADD `show_contactemail` INT( 1 ) DEFAULT '0' NOT NULL ;

ATTENTION: The version 1.0 does not support the old download table structure.
  For the update, you must delete all entrys (only the cms data entry, that means:
  the database data, not the files). You must re-create all your downloads.

XML Database:
  First: Back the data directory.
  Copy the complete engine folder, the cache folder and the .php files from the
  root directory in your installed toendaCMS folder. Then copy the setup folder
  into your installpath and start the install by typing
  "http://www.your-domain.com/setup/index.php".
  At the Installstep TWO choose "Update toendaCMS" and go next to finish all.
  Then copy all the saved directories from your backup into the new data folder,
  remember, it is impossible that the new version have some new folders created
  into the data directory.
  Finish.
  
  XML DB Warning: If you want to update you currently site to toendaCMS 0.6.0 Beta3 you
  cannot use your old XML Data. You can copy all content with the Administration
  into your new site.

SQL Database:
  First: Backup you "namen.xml", "var.xml", "footer.xml" and "database.php"! Then
  make a Backup of your database.
  Copy the complete engine folder, the cache folder and the .php files from the
  root directory in your installed toendaCMS folder. Then copy the setup folder
  into your installpath and start the install by typing
  "http://www.your-domain.com/setup/index.php".
  At the Installstep TWO choose "Update toendaCMS" and go next to finish all.
  Then restore your backups of "namen.xml", "var.xml", "footer.xml" and "database.php"
  to restore all your website name and owner settings.



		  After the installation
**********************************************************************************
After the installation of toendaCMS you must ensure if you have write rights
for the following folders on your webspace:

XML Database:
    data/
    data/*/                               - all subfolders in data/
    cache/                                - caching
    cache/captcha/                        - captcha image caching
    engine/admin/session/                 - the session folder

SQL Database:
    data/
    data/*/                               -- all subfolders in data/
    cache/                                - caching
    cache/captcha/                        - captcha image caching
  Finish.




          Known problems
**********************************************************************************
- The tinyMCE Editor cannot load text data to it's contentarea with the Internet
  Explorer 6 and 7.
- You have problems using toendaCMS with a XML database if safe_mode is 'on'
  on your server.



          Install Database
**********************************************************************************
This are all settings, that dont be in directory before installation

This files must exist in data/tcms_global folder before installation:
- data/tcms_global/index.html
- data/tcms_global/mail.php
- data/tcms_global/layout.xml



          Release titles
**********************************************************************************
 * not published * 1.2.0 - Osaka
 * not published * 1.1.0 - Yokohama
 1.0.0 - Shizouka
 0.7.0 - Sendai
 0.6.0 - Kanazawa
 0.5.6 - springtime
 0.5.4 - black cayenne pepper
 0.5.2 - a white byte
 0.5.0 - Relax Edition
 0.4.8 - Blue Moon
 
 



          CSS-Stylesheets
**********************************************************************************
This is the description af all CSS-Stylesheet classes we
need in this software for an template.

Content:
-----------------------------
body, html
form, input, textarea	- All inputs and textareas
.sitelogo				- Website logo



Sitetitle (top form)
------------------------------------
.title				- Site Title
a.index				- sitetitle link
.subtitle			- Site Subtitle



misc
------------------------------------
.hr_line			- HRule
.poll_sheet     	- Poll formating
.poll_sidebar       - POll sidebar formating
.download_top		- Download header
.contentFooter      - Footer



toendaForum classes
------------------------------------
.user_profile_title	- User Profile Title



Inputs
------------------------------------
.inputtext			- Input
.inputtextarea		- Textareas
.inputbutton		- Input button
.searchform			- Searchfield
.loginform			- Inputfields
.logintext			- Text at loginfields



Impressum
------------------------------------
.imptitle			- Impressum office title
.impoffice			- impressum office formation



Content
------------------------------------
.titleBG			- Title line for contents
.contentheading		- Title of content
.contentstamp		- Subtitle of content
.contentmain		- Content
.book_content		- Guestbook Content
.sideheading		- Title on sidebar
.sidemain			- Text on sidebar
.newsCategories     - news categories in sidebar
.gallery_text       - imagegallery text



Text format
------------------------------------
.text_small			- Text small
.text_normal		- Text normal
.text_big			- Text big
.text_huge			- Text huge



Images
------------------------------------
.image				- Image class



News and comments
------------------------------------
.news_title_bg 		- News and Imagegallery title background
.news_content_bg	- News and Imagegallery content background
.news_content_box	- News content box
.comment_title		- Comment title
.comment_text		- Comment text
.newsSubmit			- Textarea for publish news



Search
------------------------------------
.search_result_bar	- Search result bar
.search_result		- Search result



Products
------------------------------------
.products_top		- toendaSHOP layout classes
a.products_top		- toendaSHOP layout classes for links



Links and Navigation:
-----------------------------------
.pathway			- Pathway class
.menutitle			- Menutitle and module title
a.legal				- Footer
a.pathway			- Pathway
a.mainlevel			- Mainmenu
a.submenu   		- Submenu
a.toplevel			- Topmenu
a.toplevelActive	- Active Topmenu Link
a.main				- Default Link





