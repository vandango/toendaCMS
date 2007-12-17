<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| German language
|
| File:	de_DE.php
|
+
*/


/**
 * German language
 *
 * This file is used for the german language.
 *
 * @version 0.1.4
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS Installer
 *
 */



$frame_title['de']['error']    = 'Fehlerseite';
$frame_title['de']['language'] = 'Sprachwahl';
$frame_title['de']['check']    = 'Systemtest f&uuml;r die Installation';
$frame_title['de']['license']  = 'GNU/GPL Lizenz';
$frame_title['de']['database'] = 'Datenbank Einstellungen';
$frame_title['de']['site']     = 'Globale Seiteneinstellungen';
$frame_title['de']['user']     = 'Benutzer f&uuml;r Systemadministration anlegen';
$frame_title['de']['finish']   = 'toendaCMS Installation abschliessen';


//
// global
//
define('_TCMS_BACK', 'Zur&uuml;ck');
define('_TCMS_NEXT', 'Weiter');
define('_TCMS_RELOAD', 'Neuladen');
define('_TCMS_FINISH', 'Abschlie&szlig;en');
define('_TCMS_START', 'Start');


//
// error
//
define('_TCMS_ERROR', 'Error');
define('_TCMS_ERROR_INFO', 'Fehler Informationen');
define('_TCMS_ERROR_UNDEFINED', 'Ein unbekannter Fehler trat auf. Bitte starten sie die Installation neu.');
define('_TCMS_ERROR_XML_SAFE_MODE', 'Sie habe versucht toendaCMS mit einer XML Datenbank zu installieren. Da ihr Hoster aber den \'safe_mode\' in den PHP Einstellungen auf \'on\' gestellt hat, k&ouml;nnen sie toendaCMS leider nicht nutzen.<br />Sie sollten ihren Hoster wechseln, da der \'safe_mode\' heutzutage nicht mehr ben&ouml;tigt wird.');


//
// check.php
//
define('_TCMS_SYSTEM', 'System');
define('_TCMS_SYSTEM_INFO', 'System Informationen');
define('_TCMS_RELEVANT', 'Relevant f&uuml;r toendaCMS Version');
define('_TCMS_PLATFORM', 'Plattform');
define('_TCMS_SYSTEM_USER', 'Systembenutzer');
define('_TCMS_PHP_VERSION', 'PHP Version');
define('_TCMS_ZEND_VERSION', 'Zend Version');
define('_TCMS_WEB_SERVER', 'Web Server');
define('_TCMS_IMPORTENT_SETTINGS', 'Wichtige Einstellungen und Installierte Module');
define('_TCMS_MODULES_LOAD', 'Modul geladen');
define('_TCMS_LOADED', 'Geladen');
define('_TCMS_NOT_LOADED', 'Nicht geladen!');
define('_TCMS_WRITE_RIGHTS', 'Schreibrechte');
define('_TCMS_WRITEABLE', 'Beschreibbar');
define('_TCMS_NOT_WRITEABLE', 'Schreibgesch&uuml;tzt!');


//
// license.php
//
define('_TCMS_LICENSE', 'Lizenz');
define('_TCMS_NOT_AGREE', 'Ich lehne ab');
define('_TCMS_AGREE', 'Ich stimme zu');


//
// database.php
//
define('_TCMS_DB_CHOOSE', 'Datenbank ausw&auml;hlen');
define('_TCMS_DB_SYSTEMS', 'MySQL, PostgreSQL, Microsoft SQL oder XML Datenbank');
define('_TCMS_DB_NEWINSTALL', 'toendaCMS Neuinstallation');
define('_TCMS_DB_PG_NOT', 'PostgresSQL is in 1.0 Beta2 not supported');
define('_TCMS_DB_UPDATE', 'toendaCMS Aktualisieren');
define('_TCMS_DB_MYSQL_UPDATE', 'MySQL Installation updaten');
define('_TCMS_DB_PGSQL_UPDATE', 'PostgreSQL Installation updaten');
define('_TCMS_DB_XML_UPDATE', 'XML Installation updaten');
define('_TCMS_DB_MSSQL_UPDATE', 'MSSQL Installation uüdaten');
define('_TCMS_DB_UPDATE_TEXT', 'W&auml;hlen sie die gew&uuml;nschte Datenbank aus und klicken sie auf das jeweilige Logo.<br />Um eine bestehende Installation zu Aktualisieren w&auml;hlen sie den Typ ihrer Installation und klicken sie auf den daf&uuml;r vorgesehenen Link.');
define('_TCMS_DB_UPDATE_TITLE', 'Datenbank aktualisieren');
define('_TCMS_DB_UPDATE_DB1', 'toendaCMS Aktualisierung mit einer');
define('_TCMS_DB_UPDATE_DB2', 'Datenbank');
define('_TCMS_DB_UPDATE_TEXT', 'Dieser Dialog wird ihre toendaCMS Installation aktualisieren und ihre Datenbank auf den neusten Stand bringen.');

define('_TCMS_DB_UPDATE_VERSION_107', 'Version 1.0.7 aktualisieren');
define('_TCMS_DB_UPDATE_VERSION_156', 'Version 1.5.6 aktualisieren');
define('_TCMS_DB_UPDATE_VERSION_160', 'Version 1.6.0 aktualisieren');

define('_TCMS_DB_NEWINSTALL_TITLE', 'Datenbank Konfiguration einstellen');
define('_TCMS_DB_NEWINSTALL_DB1', 'toendaCMS Neuinstallation mit einer');
define('_TCMS_DB_NEWINSTALL_DB2', 'Datenbank');
define('_TCMS_DB_NEWINSTALL_TEXT', 'Dieser Dialog wird ihre Datenbank Einstellungen speichern und die Datenbank mit den Tabellen f&uuml;llen.<br />Der Server Port ist nur f&uuml;r Microsoft SQL und postgreSQL Server wichtig. Sie k&ouml;nnen ihn leer lassen.');
define('_TCMS_DB_PG_CREATEDB', 'Bitte erstellen sie zuerst ihre Datenbank!');
define('_TCMS_DB_HOST', 'SQL Server Host Name');
define('_TCMS_DB_USERNAME', 'SQL Server Benutzername');
define('_TCMS_DB_PASSWORD', 'SQL Server Passwort');
define('_TCMS_DB_DATABASE', 'SQL Server Datenbank');
define('_TCMS_DB_TABLEPREFIX', 'SQL Server Tabellenpr&auml;fix');
define('_TCMS_DB_PORT', 'SQL Server Port');
define('_TCMS_DB_CREATEDB', 'Datenbank erstellen lassen?');
define('_TCMS_DB_DELETEDBBEFORECREATE', 'Vorhandene Datenbank vorher l&ouml;schen?');
define('_TCMS_DB_SAVE_SAMPLE_DATA', 'Beispiel Daten anlegen?');
define('_TCMS_DB_UPDATE_NOT_SUCCESSFULL', 'Das Update war nicht erfolgreich!');
define('_TCMS_DB_CHECK_WRITERIGHTS', 'Bitte überprüfen sie ihre Schreibrechte!');
define('_TCMS_DB_SETTINGS', 'Die Datenbank Einstellungen konnten nicht gespeichert werden!');
define('_TCMS_DB_CONNECTION', 'Es konnte keine Verbindung zur Datenbank aufgebaut werden. Bitte pruefen sie ihre Angaben.');


//
// site.php
//
define('_TCMS_SITE_TITLE', 'Globale Seiteneinstellungen');
define('_TCMS_SITE_TEXT', 'Dieser Dialog wird ihren Seitentitel speichern und wichtigsten Einstellungen vornehmen.');
define('_TCMS_SITE_WEBSITE_SETTINGS', 'Webseiten Einstellungen');
define('_TCMS_SITE_SITETITLE', 'Seitentitel');
define('_TCMS_SITE_NAME', 'Name');
define('_TCMS_SITE_SUBTITLE', 'Untertitel');
define('_TCMS_SITE_OWNER', 'Eigent&uuml;mer');
define('_TCMS_SITE_URL', 'URL');
define('_TCMS_SITE_COPYRIGHT_YEARS', 'Copyright Jahre');
define('_TCMS_SITE_CHARSET', 'Zeichensatz');
define('_TCMS_SITE_LANGUAGE', 'Sprache');
define('_TCMS_SITE_EMAIL', 'eMail');
define('_TCMS_SITE_GLOBAL_EMAIL', 'Globale eMailadresse');
define('_TCMS_SITE_NAVIGATION', 'Menu &amp; Navigation');
define('_TCMS_SITE_USE_TOPMENU', 'Topmenu benutzen');
define('_TCMS_SITE_USE_SIDEMENU', 'Seitenmenu benutzen');
define('_TCMS_SITE_METADATA', 'Metadaten');
define('_TCMS_SITE_METATAGS', 'Metatags, Schl&uuml;sselw&ouml;rter');
define('_TCMS_SITE_DESCRIPTION', 'Beschreibung');
define('_TCMS_SITE_ERROR', 'Die Globalen Einstellungen konnten nicht gespeichert werden!\nBitte ueberpruefen sie ihre Schreibrechte!');


//
// user.php
//
define('_TCMS_USER_TITLE', 'Systemadministrator anlegen');
define('_TCMS_USER_TEXT', 'Dieser Dialog wird nun einen Systemadministrator anlegen.');
define('_TCMS_USER_CREATE_USER', 'Benutzer erstellen');
define('_TCMS_USER_FULLNAME', 'Vollst&auml;ndiger Name');
define('_TCMS_USER_USERNAME', 'Benutzername');
define('_TCMS_USER_PASSWORD', 'Passwort');
define('_TCMS_USER_PASSWORD_RETYPE', 'Passwort wiederholen');
define('_TCMS_USER_EMAIL', 'eMailadresse des Benutzers');
define('_TCMS_USER_PASSWORD_ERROR', 'Die Passwoerter sind nicht identisch!\nBitte wiederholen sie den Vorgang.');
define('_TCMS_USER_NOTEBOOK', 'Dieses Notizbuch hat Super-Kuh Kr&auml;fte ...');
define('_TCMS_USER_ERROR', 'Der Benutzer konnte nicht angelegt werden!\nUeberpruefen sie ihre Schreibrechte (Verzeichniss: "data/tcms_user") und versuchen sie es erneut.');


//
// finish.php
//
define('_TCMS_FINISH_TITLE', 'Installation abschlie&szlig;en');
define('_TCMS_FINISH_TEXT1', 'Die Installation ist erfolgreich abgeschlossen.');
define('_TCMS_FINISH_TEXT2', 'Sie k&ouml;nnen nun einen ersten Blick auf ihre neue Internetseite werfen oder direkt in die Systemadministration gehen.');
define('_TCMS_FINISH_YOUR_NEW_WEBSITE', 'Ihre neue Internetseite');
define('_TCMS_FINISH_FRONTPAGE', 'Startseite');
define('_TCMS_FINISH_ADMINISTRATION', 'Administration');
define('_TCMS_FINISH_TEXT3', 'Bitte denken sie daran, die Ordner im "data/" Verzeichniss auf volle Schreibrechte zu &uuml;berpr&uuml;fen.');
define('_TCMS_FINISH_TEXT4', 'Die Automation konnte eventuell nicht voll funktioniert haben.');
define('_TCMS_FINISH_TEXT5', 'Diese Verzeichnisse sind dabei wichtig:');
define('_TCMS_FINISH_ERROR', 'Bitte &auml;ndern sie die Schreibrechte im Verzeichniss "data/" mit allen Unterordnern und Dateien!');


?>
