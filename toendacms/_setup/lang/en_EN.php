<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| English language
|
| File:		en_EN.php
| Version:	0.0.8
|
+
*/



$frame_title['de']['error']    = 'Errorpage';
$frame_title['en']['language'] = 'Language Choice';
$frame_title['en']['check']    = 'Check System for Installation';
$frame_title['en']['license']  = 'GNU/GPL License';
$frame_title['en']['database'] = 'Database Settings';
$frame_title['en']['site']     = 'Global Pagesettings';
$frame_title['en']['user']     = 'Create System Administration';
$frame_title['en']['finish']   = 'Finish toendaCMS Installation';


//
// global
//
define('_TCMS_BACK', 'Back');
define('_TCMS_NEXT', 'Next');
define('_TCMS_RELOAD', 'Reload');
define('_TCMS_FINISH', 'Finish');
define('_TCMS_START', 'Start');


//
// error
//
define('_TCMS_ERROR', 'Error');
define('_TCMS_ERROR_INFO', 'Error information');
define('_TCMS_ERROR_UNDEFINED', 'The installation has an undefined error. Please restart setup.');


//
// check.php
//
define('_TCMS_SYSTEM', 'System');
define('_TCMS_SYSTEM_INFO', 'System Information');
define('_TCMS_RELEVANT', 'Relevant for toendaCMS Version');
define('_TCMS_PLATFORM', 'Platform');
define('_TCMS_SYSTEM_USER', 'System user');
define('_TCMS_PHP_VERSION', 'PHP Version');
define('_TCMS_ZEND_VERSION', 'Zend Version');
define('_TCMS_WEB_SERVER', 'Web Server');
define('_TCMS_IMPORTENT_SETTINGS', 'Important settings and installed modules');
define('_TCMS_MODULES_LOAD', 'Module loaded');
define('_TCMS_LOADED', 'Loaded');
define('_TCMS_NOT_LOADED', 'Not loaded!');
define('_TCMS_WRITE_RIGHTS', 'Writerights');
define('_TCMS_WRITEABLE', 'Writable');
define('_TCMS_NOT_WRITEABLE', 'Not writable!');


//
// license.php
//
define('_TCMS_LICENSE', 'License');
define('_TCMS_NOT_AGREE', 'I don\'t agree');
define('_TCMS_AGREE', 'I agree');


//
// database.php
//
define('_TCMS_DB_CHOOSE', 'Choose Database');
define('_TCMS_DB_SYSTEMS', 'MySQL, PostgreSQL, Microsoft SQL or XML Database');
define('_TCMS_DB_NEWINSTALL', 'toendaCMS New Installation');
define('_TCMS_DB_PG_NOT', 'PostgresSQL is in 1.0 Beta2 not supported');
define('_TCMS_DB_UPDATE', 'Update toendaCMS');
define('_TCMS_DB_MYSQL_UPDATE', 'Update MySQL Installation');
define('_TCMS_DB_PGSQL_UPDATE', 'Update PostgreSQL Installation');
define('_TCMS_DB_XML_UPDATE', 'Update XML Installation');
define('_TCMS_DB_UPDATE_TEXT', 'Please choose your prefered database and click on the logo.<br />To update your toendaCMS installation choose the type of your installation and click on the link.');
define('_TCMS_DB_UPDATE_TITLE', 'Update Database');
define('_TCMS_DB_UPDATE_DB1', 'toendaCMS Update with a');
define('_TCMS_DB_UPDATE_DB2', 'database');
define('_TCMS_DB_UPDATE_TEXT', 'This dialog will update your toendaCMS installation and your database.');
define('_TCMS_DB_UPDATE_VERSION_107', 'Update Version 1.0.7');
define('_TCMS_DB_UPDATE_VERSION_103', 'Update Version 1.0.3');
define('_TCMS_DB_UPDATE_VERSION_102', 'Update Version 1.0.2');
define('_TCMS_DB_UPDATE_VERSION_100', 'Update Version 1.0.0 (and 1.0.1)');
define('_TCMS_DB_UPDATE_VERSION_100_XML', 'Update Version 1.0.0 and newer');
define('_TCMS_DB_UPDATE_VERSION_100RC1', 'Update Version 1.0.0 RC1');
define('_TCMS_DB_UPDATE_VERSION_070', 'Update Version 0.7.0');
define('_TCMS_DB_NEWINSTALL_TITLE', 'Creating database configuration');
define('_TCMS_DB_NEWINSTALL_DB1', 'toendaCMS new installation with a');
define('_TCMS_DB_NEWINSTALL_DB2', 'database');
define('_TCMS_DB_NEWINSTALL_TEXT', 'This dialog will save your database settings and fill the database with all needed tables.<br />The Server Port is only important for Microsoft SQL and postgreSQL Server. You can leave it empty.');
define('_TCMS_DB_PG_CREATEDB', 'Please create your database first!');
define('_TCMS_DB_HOST', 'SQL Server Host Name');
define('_TCMS_DB_USERNAME', 'SQL Server Username');
define('_TCMS_DB_PASSWORD', 'SQL Server Password');
define('_TCMS_DB_DATABASE', 'SQL Server Database');
define('_TCMS_DB_TABLEPREFIX', 'SQL Server Tableprefix');
define('_TCMS_DB_PORT', 'SQL Server Port');
define('_TCMS_DB_CREATEDB', 'Create database?');
define('_TCMS_DB_DELETEDBBEFORECREATE', 'Drop existing database?');
define('_TCMS_DB_SAVE_SAMPLE_DATA', 'Install sample data?');
define('_TCMS_DB_UPDATE_NOT_SUCCESSFULL', 'The update was not successfull!');
define('_TCMS_DB_CHECK_WRITERIGHTS', 'Please check your writerights!');
define('_TCMS_DB_SETTINGS', 'We could not save the database settings!');
define('_TCMS_DB_CONNECTION', 'We could not connect to the database. Please check your settings.');


//
// site.php
//
define('_TCMS_SITE_TITLE', 'Global website settings');
define('_TCMS_SITE_TEXT', 'This dialog will save your page title and other importent settings.');
define('_TCMS_SITE_WEBSITE_SETTINGS', 'Website Settings');
define('_TCMS_SITE_SITETITLE', 'Sitetitle');
define('_TCMS_SITE_NAME', 'Name');
define('_TCMS_SITE_SUBTITLE', 'Subtitle');
define('_TCMS_SITE_OWNER', 'Website owner');
define('_TCMS_SITE_URL', 'URL');
define('_TCMS_SITE_COPYRIGHT_YEARS', 'Copyright Years');
define('_TCMS_SITE_CHARSET', 'Charset');
define('_TCMS_SITE_LANGUAGE', 'Language');
define('_TCMS_SITE_EMAIL', 'eMail');
define('_TCMS_SITE_GLOBAL_EMAIL', 'Global eMailadress');
define('_TCMS_SITE_NAVIGATION', 'Menu &amp; Navigation');
define('_TCMS_SITE_USE_TOPMENU', 'Use Topmenu');
define('_TCMS_SITE_USE_SIDEMENU', 'Use Sitemenu');
define('_TCMS_SITE_METADATA', 'Metadata');
define('_TCMS_SITE_METATAGS', 'Metatags, Keywords');
define('_TCMS_SITE_DESCRIPTION', 'Description');
define('_TCMS_SITE_ERROR', 'We could not save the global settings!\nPlease check your writerights!');


//
// user.php
//
define('_TCMS_USER_TITLE', 'Create Systemadministrator');
define('_TCMS_USER_TEXT', 'This dialog will create a systemadministrator.');
define('_TCMS_USER_CREATE_USER', 'Create user');
define('_TCMS_USER_FULLNAME', 'Fullname');
define('_TCMS_USER_USERNAME', 'Username');
define('_TCMS_USER_PASSWORD', 'Password');
define('_TCMS_USER_PASSWORD_RETYPE', 'Retype Password');
define('_TCMS_USER_EMAIL', 'Your eMailadress');
define('_TCMS_USER_PASSWORD_ERROR', 'The passwords are not the same!\nPlease try again.');
define('_TCMS_USER_NOTEBOOK', 'This notebook has super-cow power ...');
define('_TCMS_USER_ERROR', 'The user could not create!\nCheck your writerights (Directory: "data/tcms_user") and try again.');


//
// finish.php
//
define('_TCMS_FINISH_TITLE', 'Finish installation');
define('_TCMS_FINISH_TEXT1', 'The installation has finished successfully.');
define('_TCMS_FINISH_TEXT2', 'You can now take a look at your new website or go direct into the administration.');
define('_TCMS_FINISH_YOUR_NEW_WEBSITE', 'Your new webpage');
define('_TCMS_FINISH_FRONTPAGE', 'Frontpage');
define('_TCMS_FINISH_ADMINISTRATION', 'Administration');
define('_TCMS_FINISH_TEXT3', 'Please remember that you check the "data/" directory for it\'s writerights.');
define('_TCMS_FINISH_TEXT4', 'Maybe the automation has not finished complete.');
define('_TCMS_FINISH_TEXT5', 'This directorys are important:');
define('_TCMS_FINISH_ERROR', 'Please change the writerights of all folders and files in "data/" to complete writeright!');


?>

