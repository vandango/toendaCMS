<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| German Language
|
| File:	lang_germany_DE.php
|
+
*/


/**
 * German Language
 * 
 * @version 0.6.0
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS Backend
 */


// ADMIN
if(!defined('_TCMS_ADMIN_TITLE'))              define('_TCMS_ADMIN_TITLE', 'toendaCMS Administrator');
if(!defined('_TCMS_ADMIN_BACK'))               define('_TCMS_ADMIN_BACK', 'Zur&#252;ck');
if(!defined('_TCMS_ADMIN_FORWARD'))            define('_TCMS_ADMIN_FORWARD', 'Vorw&#228;rts');
if(!defined('_TCMS_ADMIN_CLOSE'))              define('_TCMS_ADMIN_CLOSE', 'Schliessen');
if(!defined('_TCMS_ADMIN_SAVE'))               define('_TCMS_ADMIN_SAVE', 'Speichern');
if(!defined('_TCMS_ADMIN_APPLY'))              define('_TCMS_ADMIN_APPLY', '&#220;bernehmen');
if(!defined('_TCMS_ADMIN_BACK_TO_PAGE'))       define('_TCMS_ADMIN_BACK_TO_PAGE', 'Zur&#252;ck zur Webseite');
if(!defined('_TCMS_ADMIN_NO'))                 define('_TCMS_ADMIN_NO', 'Kein');
if(!defined('_TCMS_ADMIN_FTPUPLOAD'))          define('_TCMS_ADMIN_FTPUPLOAD', 'Erstellen Sie ein Album aus einem per FTP hochgeladenem Bilderordner');
if(!defined('_TCMS_ADMIN_DELETE'))             define('_TCMS_ADMIN_DELETE', 'L&#246;schen');
if(!defined('_TCMS_ADMIN_DELETE_ALL'))         define('_TCMS_ADMIN_DELETE_ALL', 'Alle L&#246;schen');
if(!defined('_TCMS_ADMIN_UPLOAD'))             define('_TCMS_ADMIN_UPLOAD', 'Hochladen');
if(!defined('_TCMS_ADMIN_INSTALL'))            define('_TCMS_ADMIN_INSTALL', 'Hochladen &amp installieren');
if(!defined('_TCMS_ADMIN_SEND'))               define('_TCMS_ADMIN_SEND', 'Senden');
if(!defined('_TCMS_ADMIN_VOTE'))               define('_TCMS_ADMIN_VOTE', 'Jetzt abstimmen!');
if(!defined('_TCMS_ADMIN_NEW'))                define('_TCMS_ADMIN_NEW', 'Neu');
if(!defined('_TCMS_ADMIN_IMPORT'))             define('_TCMS_ADMIN_IMPORT', 'Import');
if(!defined('_TCMS_ADMIN_CREATE'))             define('_TCMS_ADMIN_CREATE', 'Neues Album erstellen...');
if(!defined('_TCMS_ADMIN_NEW_POLL'))           define('_TCMS_ADMIN_NEW_POLL', 'Neue Umfrage erstellen...');
if(!defined('_TCMS_ADMIN_NEW_ITEM'))           define('_TCMS_ADMIN_NEW_ITEM', 'Neuen Eintrag erstellen...');
if(!defined('_TCMS_ADMIN_NEW_USER'))           define('_TCMS_ADMIN_NEW_USER', 'Neuen Benutzer erstellen...');
if(!defined('_TCMS_ADMIN_NEW_CATEGORY'))       define('_TCMS_ADMIN_NEW_CATEGORY', 'Neue Kategorie erstellen...');
if(!defined('_TCMS_ADMIN_NEW_FTPALBUM'))       define('_TCMS_ADMIN_NEW_FTPALBUM', 'Neues Album aus FTP Ordner...');
if(!defined('_TCMS_ADMIN_NEW_DIR'))            define('_TCMS_ADMIN_NEW_DIR', 'Neuen Ordner erstellen...');
if(!defined('_TCMS_ADMIN_NEW_DIR_BUTTON'))     define('_TCMS_ADMIN_NEW_DIR_BUTTON', 'Ordner erstellen');
if(!defined('_TCMS_ADMIN_NEW_FILE_BUTTON'))    define('_TCMS_ADMIN_NEW_FILE_BUTTON', 'Datei erstellen');
if(!defined('_TCMS_ADMIN_LIST'))               define('_TCMS_ADMIN_LIST', 'Eintr&#228;ge auflisten');
if(!defined('_TCMS_ADMIN_CONFIG'))             define('_TCMS_ADMIN_CONFIG', 'Konfigurieren Sie dieses Modul');
if(!defined('_TCMS_ADMIN_NEWPAGE'))            define('_TCMS_ADMIN_NEWPAGE', 'Neue Seite f&#252;r Ihre Webseite erstellen.');
if(!defined('_TCMS_ADMIN_UPDATE'))             define('_TCMS_ADMIN_UPDATE', 'Update');
if(!defined('_TCMS_ADMIN_VER'))                define('_TCMS_ADMIN_VER', 'Version');
if(!defined('_TCMS_ADMIN_DEV'))                define('_TCMS_ADMIN_DEV', 'Entwickelt von');
if(!defined('_TCMS_ADMIN_RIGHT'))              define('_TCMS_ADMIN_RIGHT', 'Alle Rechte vorbehalten.');
if(!defined('_TCMS_ADMIN_LOGED'))              define('_TCMS_ADMIN_LOGED', 'Angemeldet als');
if(!defined('_TCMS_ADMIN_GOTOSITE'))           define('_TCMS_ADMIN_GOTOSITE', 'Zur Frontseite wechseln');
if(!defined('_TCMS_ADMIN_EDIT_LANG'))          define('_TCMS_ADMIN_EDIT_LANG', 'Diese Sprache bearbeiten');
if(!defined('_TCMS_TOP_OF_PAGE'))              define('_TCMS_TOP_OF_PAGE', 'Zum Anfang der Seite');
if(!defined('_TCMS_PRINT_PAGE'))               define('_TCMS_PRINT_PAGE', 'Diese Seite drucken');
if(!defined('_TCMS_PDF_PAGE'))                 define('_TCMS_PDF_PAGE', 'F&#252;r diese Seite ein PDF Dokument erstellen');
if(!defined('_TCMS_PRINT_NOW'))                define('_TCMS_PRINT_NOW', 'Drucken');
if(!defined('_TCMS_COLOR_CHOOSER'))            define('_TCMS_COLOR_CHOOSER', 'Farbw&#228;hler');
if(!defined('_TCMS_MONTH_JANUARY'))            define('_TCMS_MONTH_JANUARY', 'Januar');
if(!defined('_TCMS_MONTH_FEBUARY'))            define('_TCMS_MONTH_FEBUARY', 'Februar');
if(!defined('_TCMS_MONTH_MARCH'))              define('_TCMS_MONTH_MARCH', 'M&#228;rz');
if(!defined('_TCMS_MONTH_APRIL'))              define('_TCMS_MONTH_APRIL', 'April');
if(!defined('_TCMS_MONTH_MAY'))                define('_TCMS_MONTH_MAY', 'Mai');
if(!defined('_TCMS_MONTH_JUNE'))               define('_TCMS_MONTH_JUNE', 'Juni');
if(!defined('_TCMS_MONTH_JULY'))               define('_TCMS_MONTH_JULY', 'Juli');
if(!defined('_TCMS_MONTH_AUGUST'))             define('_TCMS_MONTH_AUGUST', 'August');
if(!defined('_TCMS_MONTH_SEPTEMBER'))          define('_TCMS_MONTH_SEPTEMBER', 'September');
if(!defined('_TCMS_MONTH_OCTOBER'))            define('_TCMS_MONTH_OCTOBER', 'Oktober');
if(!defined('_TCMS_MONTH_NOVEMBER'))           define('_TCMS_MONTH_NOVEMBER', 'November');
if(!defined('_TCMS_MONTH_DECEMBER'))           define('_TCMS_MONTH_DECEMBER', 'Dezember');
if(!defined('_TCMS_DAY_MONDAY'))               define('_TCMS_DAY_MONDAY', 'Montag');
if(!defined('_TCMS_DAY_TUESDAY'))              define('_TCMS_DAY_TUESDAY', 'Dienstag');
if(!defined('_TCMS_DAY_WEDNESDAY'))            define('_TCMS_DAY_WEDNESDAY', 'Mittwoch');
if(!defined('_TCMS_DAY_THURSDAY'))             define('_TCMS_DAY_THURSDAY', 'Donnerstag');
if(!defined('_TCMS_DAY_FRIDAY'))               define('_TCMS_DAY_FRIDAY', 'Freitag');
if(!defined('_TCMS_DAY_SATURDAY'))             define('_TCMS_DAY_SATURDAY', 'Samstag');
if(!defined('_TCMS_DAY_SUNDAY'))               define('_TCMS_DAY_SUNDAY', 'Sonntag');
if(!defined('_TCMS_DAY_MONDAY_XS'))            define('_TCMS_DAY_MONDAY_XS', 'Mon');
if(!defined('_TCMS_DAY_TUESDAY_XS'))           define('_TCMS_DAY_TUESDAY_XS', 'Die');
if(!defined('_TCMS_DAY_WEDNESDAY_XS'))         define('_TCMS_DAY_WEDNESDAY_XS', 'Mit');
if(!defined('_TCMS_DAY_THURSDAY_XS'))          define('_TCMS_DAY_THURSDAY_XS', 'Don');
if(!defined('_TCMS_DAY_FRIDAY_XS'))            define('_TCMS_DAY_FRIDAY_XS', 'Fri');
if(!defined('_TCMS_DAY_SATURDAY_XS'))          define('_TCMS_DAY_SATURDAY_XS', 'Sam');
if(!defined('_TCMS_DAY_SUNDAY_XS'))            define('_TCMS_DAY_SUNDAY_XS', 'Son');
if(!defined('_TCMS_COLOR'))                    define('_TCMS_COLOR', 'Farbe');
if(!defined('_TCMS_TODAY'))                    define('_TCMS_TODAY', 'Heute');
if(!defined('_TCMS_BACKGROUND'))               define('_TCMS_BACKGROUND', 'Hintergrund');
if(!defined('_TCMS_BORDER'))                   define('_TCMS_BORDER', 'Rahmen');
if(!defined('_TCMS_WEEKDAY'))                  define('_TCMS_WEEKDAY', 'Wochentag');
if(!defined('_TCMS_BASE_DIRECTORY'))           define('_TCMS_BASE_DIRECTORY', 'Basisverzeichnis');
if(!defined('_TCMS_OPEN_DIRECTORY'))           define('_TCMS_OPEN_DIRECTORY', 'Ordner &#246;ffnen');
if(!defined('_TCMS_TEST_ENVIRONMENT'))         define('_TCMS_TEST_ENVIRONMENT', 'DIES IST EINE TESTUMGEBUNG!');
if(!defined('_TCMS_THIS_PAGE_IN'))             define('_TCMS_THIS_PAGE_IN', 'Diese Seite in');
if(!defined('_TCMS_LANGUAGES'))                define('_TCMS_LANGUAGES', 'Sprachen');
if(!defined('_TCMS_LANGUAGE'))                 define('_TCMS_LANGUAGE', 'Sprache');
if(!defined('_TCMS_OPEN_ALL'))                 define('_TCMS_OPEN_ALL', 'Alle &#246;ffnen');
if(!defined('_TCMS_CLOSE_ALL'))                define('_TCMS_CLOSE_ALL', 'Alle schliessen');
if(!defined('_TCMS_HELP'))                     define('_TCMS_HELP', 'Hilfe');
if(!defined('_TCMS_DOCU'))                     define('_TCMS_DOCU', 'Wiki');
if(!defined('_TCMS_TSCRIPT_SYNTAX_REF'))       define('_TCMS_TSCRIPT_SYNTAX_REF', 'toendaScript - Syntax Referenz');


// BACKEND TOPMENU
if(!defined('_TCMS_TOPMENU_MAIN'))             define('_TCMS_TOPMENU_MAIN', 'Main');
if(!defined('_TCMS_TOPMENU_MANAGE'))           define('_TCMS_TOPMENU_MANAGE', 'Verwaltung');
if(!defined('_TCMS_TOPMENU_NAVIGATION'))       define('_TCMS_TOPMENU_NAVIGATION', 'Navigation');
if(!defined('_TCMS_TOPMENU_SETTINGS'))         define('_TCMS_TOPMENU_SETTINGS', 'Einstellungen');
if(!defined('_TCMS_TOPMENU_CONTENT'))          define('_TCMS_TOPMENU_CONTENT', 'Inhalte');
if(!defined('_TCMS_TOPMENU_SIDEBAR'))          define('_TCMS_TOPMENU_SIDEBAR', 'Seitenleiste');
if(!defined('_TCMS_TOPMENU_EXTENSIONS'))       define('_TCMS_TOPMENU_EXTENSIONS', 'Erweiterungen');
if(!defined('_TCMS_TOPMENU_COMPONENTS'))       define('_TCMS_TOPMENU_COMPONENTS', 'Komponenten');
if(!defined('_TCMS_TOPMENU_SITE'))             define('_TCMS_TOPMENU_SITE', 'Seite');
if(!defined('_TCMS_TOPMENU_HELP'))             define('_TCMS_TOPMENU_HELP', 'Hilfe');
if(!defined('_TCMS_TOPMENU_CONF_MODULE'))      define('_TCMS_TOPMENU_CONF_MODULE', 'Modul Konfiguration');


// TCMS
if(!defined('_TCMS_MENU_HOME'))                define('_TCMS_MENU_HOME', 'Home');
if(!defined('_TCMS_MENU_LOGOUT'))              define('_TCMS_MENU_LOGOUT', 'Abmelden');
if(!defined('_TCMS_MENU_PAGE'))                define('_TCMS_MENU_PAGE', 'Schreibtisch');
if(!defined('_TCMS_MENU_FILE'))                define('_TCMS_MENU_FILE', 'Dateimanager');
if(!defined('_TCMS_MENU_MEDIA'))               define('_TCMS_MENU_MEDIA', 'Medienmanager');
if(!defined('_TCMS_MENU_NEWS_CATEGORIES'))     define('_TCMS_MENU_NEWS_CATEGORIES', 'Neuigkeiten-Kategorien');
if(!defined('_TCMS_MENU_COMMENTS'))            define('_TCMS_MENU_COMMENTS', 'Kommentare');
if(!defined('_TCMS_MENU_GUESTBOOK'))           define('_TCMS_MENU_GUESTBOOK', 'G&#228;stebuch Eintr&#228;ge');
if(!defined('_TCMS_MENU_NOTE'))                define('_TCMS_MENU_NOTE', 'Notizblock');
if(!defined('_TCMS_MENU_SIDEMENU'))            define('_TCMS_MENU_SIDEMENU', 'Seitenmenu');
if(!defined('_TCMS_MENU_TOPMENU'))             define('_TCMS_MENU_TOPMENU', 'Topmenu');
if(!defined('_TCMS_MENU_MENUTITLE'))           define('_TCMS_MENU_MENUTITLE', 'Menutitel');
if(!defined('_TCMS_MENU_CONTENT'))             define('_TCMS_MENU_CONTENT', 'Dokumente');
if(!defined('_TCMS_MENU_NEWS'))                define('_TCMS_MENU_NEWS', 'Neuigkeiten');
if(!defined('_TCMS_MENU_DOWN'))                define('_TCMS_MENU_DOWN', 'Downloads');
if(!defined('_TCMS_MENU_PRODUCTS'))            define('_TCMS_MENU_PRODUCTS', 'Produkte');
if(!defined('_TCMS_MENU_FAQ'))                 define('_TCMS_MENU_FAQ', 'Artikel und FAQs');
if(!defined('_TCMS_MENU_SIDEEXT'))             define('_TCMS_MENU_SIDEEXT', 'Erweiterungen');
if(!defined('_TCMS_MENU_SIDE'))                define('_TCMS_MENU_SIDE', 'Seitenleiste');
if(!defined('_TCMS_MENU_NEWSLETTER'))          define('_TCMS_MENU_NEWSLETTER', 'Newsletter');
if(!defined('_TCMS_MENU_POLL'))                define('_TCMS_MENU_POLL', 'Umfrage');
if(!defined('_TCMS_MENU_EXT'))                 define('_TCMS_MENU_EXT', 'Erweiterungen');
if(!defined('_TCMS_MENU_FRONT'))               define('_TCMS_MENU_FRONT', 'Startseite');
if(!defined('_TCMS_MENU_GALLERY'))             define('_TCMS_MENU_GALLERY', 'Bildergalerie');
if(!defined('_TCMS_MENU_LINK'))                define('_TCMS_MENU_LINK', 'Links');
if(!defined('_TCMS_MENU_IMP'))                 define('_TCMS_MENU_IMP', 'Impressum');
if(!defined('_TCMS_MENU_CONTACT'))             define('_TCMS_MENU_CONTACT', 'Kontaktmanager');
if(!defined('_TCMS_MENU_USER'))                define('_TCMS_MENU_USER', 'Benutzermanager');
if(!defined('_TCMS_MENU_USERPAGE'))            define('_TCMS_MENU_USERPAGE', 'Editorseiten');
if(!defined('_TCMS_MENU_CFORM'))               define('_TCMS_MENU_CFORM', 'Kontaktformular');
if(!defined('_TCMS_MENU_QBOOK'))               define('_TCMS_MENU_QBOOK', 'G&#228;stebuch');
if(!defined('_TCMS_MENU_CS'))                  define('_TCMS_MENU_CS', 'Komponentensystem');
if(!defined('_TCMS_MENU_CS_UPLOAD'))           define('_TCMS_MENU_CS_UPLOAD', 'Komponenten Install&amp;edit');
if(!defined('_TCMS_MENU_GLOBAL'))              define('_TCMS_MENU_GLOBAL', 'Systemeinstellungen');
if(!defined('_TCMS_MENU_DB'))                  define('_TCMS_MENU_DB', 'Datenbankeinstellungen');
if(!defined('_TCMS_MENU_STATS'))               define('_TCMS_MENU_STATS', 'Statistik');
if(!defined('_TCMS_MENU_THEME'))               define('_TCMS_MENU_THEME', 'Vorlagenmanager');
if(!defined('_TCMS_MENU_THEME_UPLOAD'))        define('_TCMS_MENU_THEME_UPLOAD', 'Vorlagen Install&amp;edit');
if(!defined('_TCMS_MENU_THEME_PREVIEW'))       define('_TCMS_MENU_THEME_PREVIEW', 'Vorschau');
if(!defined('_TCMS_MENU_COPY'))                define('_TCMS_MENU_COPY', 'Lizenz');
if(!defined('_TCMS_MENU_CREDITS'))             define('_TCMS_MENU_CREDITS', 'Credits &amp; System');
if(!defined('_TCMS_MENU_DOCU'))                define('_TCMS_MENU_DOCU', 'Dokumentation');
if(!defined('_TCMS_MENU_HELP'))                define('_TCMS_MENU_HELP', 'Hilfe');
if(!defined('_TCMS_MENU_SUPPORT'))             define('_TCMS_MENU_SUPPORT', 'Support');
if(!defined('_TCMS_MENU_ABOUT_MODULE'))        define('_TCMS_MENU_ABOUT_MODULE', 'Modulbeschreibung');
if(!defined('_TCMS_MENU_ABOUT'))               define('_TCMS_MENU_ABOUT', '&#220;ber toendaCMS');
if(!defined('_TCMS_MENU_SEARCH'))              define('_TCMS_MENU_SEARCH', 'Suche');
if(!defined('_TCMS_MENU_IMPORT'))              define('_TCMS_MENU_IMPORT', 'Import');
if(!defined('_TCMS_MENU_CFORM'))               define('_TCMS_MENU_CFORM', 'Kontaktformular');
if(!defined('_TCMS_MENU_BOOK'))                define('_TCMS_MENU_BOOK', 'G&#228;stebuch');


// MODULE
if(!defined('_MOD_HOME'))                      define('_MOD_HOME', 'Home');
if(!defined('_MOD_PAGE'))                      define('_MOD_PAGE', 'Webseiten Modul');
if(!defined('_MOD_EXPLORE'))                   define('_MOD_EXPLORE', 'Dateimanager - Verwalten Sie Ihren erstellten Datenbestand');
if(!defined('_MOD_MEDIA'))                     define('_MOD_MEDIA', 'Medienmanager - Verwalten Sie Ihre Multimedia Dateien');
if(!defined('_MOD_NEWS_CATEGORIES'))           define('_MOD_NEWS_CATEGORIES', 'Neuigkeiten-Kategorien verwalten');
if(!defined('_MOD_COMMENTS'))                  define('_MOD_COMMENTS', 'Kommentare verwalten');
if(!defined('_MOD_GUESTBOOK'))                 define('_MOD_GUESTBOOK', 'G&#228;stebuch Eintr&#228;ge verwalten');
if(!defined('_MOD_NOTE'))                      define('_MOD_NOTE', 'Notizblock - Schreiben Sie Ihre Ideen und Notizen nieder.');
if(!defined('_MOD_NEWPAGE'))                   define('_MOD_NEWPAGE', 'Eine neue Seite erstellen');
if(!defined('_MOD_SIDEMENU'))                  define('_MOD_SIDEMENU', 'Seitenmenu verwalten');
if(!defined('_MOD_TOPMENU'))                   define('_MOD_TOPMENU', 'Topmenu verwalten');
if(!defined('_MOD_USERMENU'))                  define('_MOD_USERMENU', 'Benutzermenu verwalten');
if(!defined('_MOD_MENUTITLE'))                 define('_MOD_MENUTITLE', 'Menutitel verwalten');
if(!defined('_MOD_CONTENT'))                   define('_MOD_CONTENT', 'Dokumente verwalten');
if(!defined('_MOD_NEWS'))                      define('_MOD_NEWS', 'Neuigkeiten verwalten');
if(!defined('_MOD_DOWN'))                      define('_MOD_DOWN', 'Downloads verwalten');
if(!defined('_MOD_PRODUCTS'))                  define('_MOD_PRODUCTS', 'Produkte verwalten');
if(!defined('_MOD_SIDEBAR_EXTENSION'))         define('_MOD_SIDEBAR_EXTENSION', 'Konfiguration der Erweiterungen');
if(!defined('_MOD_SIDEBAR'))                   define('_MOD_SIDEBAR', 'Statische Inhalte der Seitenleiste verwalten');
if(!defined('_MOD_NEWSLETTER'))                define('_MOD_NEWSLETTER', 'Newsletter verwalten');
if(!defined('_MOD_POLL'))                      define('_MOD_POLL', 'Umfrage');
if(!defined('_MOD_EXTENSIONS'))                define('_MOD_EXTENSIONS', 'Konfiguration der globalen Erweiterungen');
if(!defined('_MOD_CFORM'))                     define('_MOD_CFORM', 'Kontaktformular Konfiguration');
if(!defined('_MOD_BOOK'))                      define('_MOD_BOOK', 'G&#228;stebuch Konfiguration');
if(!defined('_MOD_FRONTPAGE'))                 define('_MOD_FRONTPAGE', 'Startseiten Konfiguration');
if(!defined('_MOD_IMPRESSUM'))                 define('_MOD_IMPRESSUM', 'Impressum Konfiguration');
if(!defined('_MOD_GALLERY'))                   define('_MOD_GALLERY', 'Bildergalerie Konfiguration');
if(!defined('_MOD_LINK'))                      define('_MOD_LINK', 'Links verwalten');
if(!defined('_MOD_KNOWLEDGEBASE'))             define('_MOD_KNOWLEDGEBASE', 'Artikel und FAQ\'s verwalten');
if(!defined('_MOD_CONTACT'))                   define('_MOD_CONTACT', 'Kontakte verwalten');
if(!defined('_MOD_USER'))                      define('_MOD_USER', 'Benutzer verwalten');
if(!defined('_MOD_USERPAGE'))                  define('_MOD_USERPAGE', 'Editorseiten Konfiguration');
if(!defined('_MOD_COMPONENTS'))                define('_MOD_COMPONENTS', 'Komponentensystem');
if(!defined('_MOD_COMPONENTS_UPLOAD'))         define('_MOD_COMPONENTS_UPLOAD', 'Komponenten Installations und Bearbeitungs Manager');
if(!defined('_MOD_GLOBAL'))                    define('_MOD_GLOBAL', 'Systemeinstellungen');
if(!defined('_MOD_IMPORT'))                    define('_MOD_IMPORT', 'Import');
if(!defined('_MOD_DB'))                        define('_MOD_DB', 'Datenbankeinstellungen');
if(!defined('_MOD_STATS'))                     define('_MOD_STATS', 'Webseiten Statistiken');
if(!defined('_MOD_TEMPLATE'))                  define('_MOD_TEMPLATE', 'Vorlagenmanager');
if(!defined('_MOD_TEMPLATE_UPLOAD'))           define('_MOD_TEMPLATE_UPLOAD', 'Vorlagen Installations und Bearbeitungs Manager');
if(!defined('_MOD_LICENSE'))                   define('_MOD_LICENSE', 'toendaCMS Lizenz (GNU/GPL)');
if(!defined('_MOD_HELP'))                      define('_MOD_HELP', 'Hilfe zu verschiedenen Modulen und Einstellungen');
if(!defined('_MOD_DOCU'))                      define('_MOD_DOCU', 'Dokumentation');
if(!defined('_MOD_CREDITS'))                   define('_MOD_CREDITS', 'Credits und System Informationen');
if(!defined('_MOD_ABOUT_MODULE'))              define('_MOD_ABOUT_MODULE', 'toendaCMS Modul Beschreibung');
if(!defined('_MOD_ABOUT'))                     define('_MOD_ABOUT', '&#220;ber toendaCMS');


// TABLE
if(!defined('_TABLE_TITLE'))                   define('_TABLE_TITLE', 'Titel');
if(!defined('_TABLE_SUBTITLE'))                define('_TABLE_SUBTITLE', 'Untertitel');
if(!defined('_TABLE_PUBLISH'))                 define('_TABLE_PUBLISH', 'Ver&#246;ffentlichungsinformationen');
if(!defined('_TABLE_TEXT'))                    define('_TABLE_TEXT', 'Haupttext');
if(!defined('_TABLE_DEFAULT'))                 define('_TABLE_DEFAULT', 'Standard');
if(!defined('_TABLE_PUBLISHED'))               define('_TABLE_PUBLISHED', 'Ver&#246;ffentlicht');
if(!defined('_TABLE_NOT_PUBLISHED'))           define('_TABLE_NOT_PUBLISHED', 'Nicht Ver&#246;ffentlicht');
if(!defined('_TABLE_PUBLISHED_ON'))            define('_TABLE_PUBLISHED_ON', 'Ver&#246;ffentlicht am');
if(!defined('_TABLE_PUBLISHING'))              define('_TABLE_PUBLISHING', 'Ver&#246;ffentlichung');
if(!defined('_TABLE_RSS'))                     define('_TABLE_RSS', 'RSS Feed Link');
if(!defined('_TABLE_ENABLED'))                 define('_TABLE_ENABLED', 'Aktiviert');
if(!defined('_TABLE_NAME'))                    define('_TABLE_NAME', 'Name');
if(!defined('_TABLE_USERNAME'))                define('_TABLE_USERNAME', 'Benutzername');
if(!defined('_TABLE_GROUP'))                   define('_TABLE_GROUP', 'Benutzergruppe');
if(!defined('_TABLE_PERSON'))                  define('_TABLE_PERSON', 'Pers&#246;nliche Informationen');
if(!defined('_TABLE_SUBID'))                   define('_TABLE_SUBID', 'SUB ID');
if(!defined('_TABLE_ORDER'))                   define('_TABLE_ORDER', 'ID');
if(!defined('_TABLE_TARGET'))                  define('_TABLE_TARGET', 'Ziel');
if(!defined('_TABLE_POS'))                     define('_TABLE_POS', 'Position');
if(!defined('_TABLE_IN_WORK'))                 define('_TABLE_IN_WORK', 'Fertiggestellt');
if(!defined('_TABLE_IS_IN_WORK'))              define('_TABLE_IS_IN_WORK', 'In Arbeit');
if(!defined('_TABLE_FUNCTIONS'))               define('_TABLE_FUNCTIONS', 'Funktion');
if(!defined('_TABLE_PARENT'))                  define('_TABLE_PARENT', 'Eltern Element f&#252;r Submenu');
if(!defined('_TABLE_PARENTC'))                 define('_TABLE_PARENTC', 'Bitte w&#228;hlen');
if(!defined('_TABLE_PARENTN'))                 define('_TABLE_PARENTN', 'Kein Submenu');
if(!defined('_TABLE_PARENTITEM'))              define('_TABLE_PARENTITEM', 'Eltern Element');
if(!defined('_TABLE_MENUINFO'))                define('_TABLE_MENUINFO', 'Sie k&#246;nnen nur im Seitenmenu ein Submenu erstellen.');
if(!defined('_TABLE_AUTOR'))                   define('_TABLE_AUTOR', 'Autor');
if(!defined('_TABLE_CATEGORY'))                define('_TABLE_CATEGORY', 'Kategorie');
if(!defined('_TABLE_PRODUCT'))                 define('_TABLE_PRODUCT', 'Produkt');
if(!defined('_TABLE_FILE'))                    define('_TABLE_FILE', 'Datei');
if(!defined('_TABLE_FILE_EXISTS'))             define('_TABLE_FILE_EXISTS', 'Wenn Sie die Datei schon hochgeladen haben, geben Sie bitte den genauen Dateinamen an. Bedenken Sie vor dem hochladen, das Sie einen Ordner pro Datei erstellen mit dem Namen der Datei, ohne Erweiterungen wie z.B. zip oder exe. Ersetzten Sie dabei vorhandene Leerzeichen mit einem Unterstrich (_). Dieser Odner wird benutzt.');
if(!defined('_TABLE_FILE_OTHERURL'))           define('_TABLE_FILE_OTHERURL', 'Wenn die Datei auf einem anderem Server liegt, geben Sie bitte hier die genaue Adresse an und die Dateibezeichnung (daraus wird dann ein Ordner erstellt).');
if(!defined('_TABLE_FILE_EXISTS_NAME'))        define('_TABLE_FILE_EXISTS_NAME', 'Vorhandene Datei');
if(!defined('_TABLE_FILE_OTHERURL_NAME'))      define('_TABLE_FILE_OTHERURL_NAME', 'Datei auf anderem Server');
if(!defined('_TABLE_DATE'))                    define('_TABLE_DATE', 'Datum');
if(!defined('_TABLE_TIME'))                    define('_TABLE_TIME', 'Zeit');
if(!defined('_TABLE_EMAIL'))                   define('_TABLE_EMAIL', 'eMail');
if(!defined('_TABLE_OPTION'))                  define('_TABLE_OPTION', 'Option');
if(!defined('_TABLE_INFO'))                    define('_TABLE_INFO', 'Informationen');
if(!defined('_TABLE_ORDER_HELP'))              define('_TABLE_ORDER_HELP', '(Identifikations Nummer)');
if(!defined('_TABLE_ALBUM'))                   define('_TABLE_ALBUM', 'Album');
if(!defined('_TABLE_DIR'))                     define('_TABLE_DIR', 'Ordner');
if(!defined('_TABLE_BACKENDFILE'))             define('_TABLE_BACKENDFILE', 'Administrationsdatei');
if(!defined('_TABLE_FRONTENDFILE'))            define('_TABLE_FRONTENDFILE', 'Webseitendatei');
if(!defined('_TABLE_SIDEBARFILE'))             define('_TABLE_SIDEBARFILE', 'Seitenleistendatei');
if(!defined('_TABLE_SETTINGSFILE'))            define('_TABLE_SETTINGSFILE', 'Einstellungsdatei');
if(!defined('_TABLE_IMAGE'))                   define('_TABLE_IMAGE', 'Bild');
if(!defined('_TABLE_IMAGES'))                  define('_TABLE_IMAGES', 'Bilder');
if(!defined('_TABLE_USE'))                     define('_TABLE_USE', 'Benutzen');
if(!defined('_TABLE_DELETE'))                  define('_TABLE_DELETE', 'L&#246;schen');
if(!defined('_TABLE_DESCRIPTION'))             define('_TABLE_DESCRIPTION', 'Beschreibung');
if(!defined('_TABLE_NEW'))                     define('_TABLE_NEW', 'Neuer Datensatz');
if(!defined('_TABLE_EDIT'))                    define('_TABLE_EDIT', 'Bearbeiten');
if(!defined('_TABLE_DETAILS'))                 define('_TABLE_DETAILS', 'Details des Datensatzes');
if(!defined('_TABLE_GENERAL'))                 define('_TABLE_GENERAL', 'Allgemeine Informationen');
if(!defined('_TABLE_FURTHER'))                 define('_TABLE_FURTHER', 'Weitere Angaben');
if(!defined('_TABLE_SETTINGS'))                define('_TABLE_SETTINGS', 'Einstellungen');
if(!defined('_TABLE_CONTACT'))                 define('_TABLE_CONTACT', 'Kontakt Informationen');
if(!defined('_TABLE_PRODUCTNO'))               define('_TABLE_PRODUCTNO', 'Artikelnummer');
if(!defined('_TABLE_FACTORY'))                 define('_TABLE_FACTORY', 'Hersteller');
if(!defined('_TABLE_URL'))                     define('_TABLE_URL', 'Internetadresse');
if(!defined('_TABLE_STOCK'))                   define('_TABLE_STOCK', 'Auf Lager');
if(!defined('_TABLE_PRICE'))                   define('_TABLE_PRICE', 'Preis');
if(!defined('_TABLE_PRICE_ADD'))               define('_TABLE_PRICE_ADD', '(Brutto, f&#252;r Netto MwSt. leer lassen)');
if(!defined('_TABLE_TAX'))                     define('_TABLE_TAX', 'Mehrwertsteuersatz');
if(!defined('_TABLE_QUANTITY'))                define('_TABLE_QUANTITY', 'Menge');
if(!defined('_TABLE_WEIGHT'))                  define('_TABLE_WEIGHT', 'Gewicht');
if(!defined('_TABLE_SAVEBUTTON'))              define('_TABLE_SAVEBUTTON', 'Speichern');
if(!defined('_TABLE_EDITBUTTON'))              define('_TABLE_EDITBUTTON', 'Bearbeiten');
if(!defined('_TABLE_DELBUTTON'))               define('_TABLE_DELBUTTON', 'Entfernen');
if(!defined('_TABLE_SETTINGSBUTTON'))          define('_TABLE_SETTINGSBUTTON', 'Einstellungen');
if(!defined('_TABLE_ADMINBUTTON'))             define('_TABLE_ADMINBUTTON', 'Verwalten');
if(!defined('_TABLE_ACCEPTBUTTON'))            define('_TABLE_ACCEPTBUTTON', '&#220;bernehmen');
if(!defined('_TABLE_THUMBNAIL'))               define('_TABLE_THUMBNAIL', 'Thumbnail');
if(!defined('_TABLE_GOUPBUTTON'))              define('_TABLE_GOUPBUTTON', 'Aufw&#228;rts');
if(!defined('_TABLE_ACCESS'))                  define('_TABLE_ACCESS', 'Zugriffsberechtigung');
if(!defined('_TABLE_MACCESS'))                 define('_TABLE_MACCESS', 'Zugang');
if(!defined('_TABLE_LINKTO'))                  define('_TABLE_LINKTO', 'Mit welcher Seite verlinken?');
if(!defined('_TABLE_COMMENTS'))                define('_TABLE_COMMENTS', 'Kommentare'); //aktiviert
if(!defined('_TABLE_LINK'))                    define('_TABLE_LINK', 'CID');
if(!defined('_TABLE_PUBLIC'))                  define('_TABLE_PUBLIC', 'Public (F&#252;r alle Besucher)');
if(!defined('_TABLE_PROTECTED'))               define('_TABLE_PROTECTED', 'Protected (F&#252;r registrierte Benutzer)');
if(!defined('_TABLE_PRIVATE'))                 define('_TABLE_PRIVATE', 'Private (Nicht f&#252;r Benutzer und Besucher)');
if(!defined('_TABLE_WHICHMENU'))               define('_TABLE_WHICHMENU', 'Eintragen in welchem Menu?');
if(!defined('_TABLE_SIDEMENU'))                define('_TABLE_SIDEMENU', 'Seitenmenu');
if(!defined('_TABLE_TOPMENU'))                 define('_TABLE_TOPMENU', 'Topmenu');
if(!defined('_TABLE_USERMENU'))                define('_TABLE_USERMENU', 'Benutzermenu');
if(!defined('_TABLE_SUBMENU'))                 define('_TABLE_SUBMENU', 'Submenu');
if(!defined('_TABLE_CHARSET'))                 define('_TABLE_CHARSET', 'Zeichensatz');
if(!defined('_TABLE_ALIAS'))                   define('_TABLE_ALIAS', 'Alias');
if(!defined('_TABLE_LEFT'))                    define('_TABLE_LEFT', 'Links');
if(!defined('_TABLE_RIGHT'))                   define('_TABLE_RIGHT', 'Rechts');
if(!defined('_TABLE_CENTER'))                  define('_TABLE_CENTER', 'Zentriert');
if(!defined('_TABLE_TYPE'))                    define('_TABLE_TYPE', 'Typ/Art');
if(!defined('_TABLE_MENUTITLE'))               define('_TABLE_MENUTITLE', 'Menutitel');
if(!defined('_TABLE_MENULINK'))                define('_TABLE_MENULINK', 'Link');
if(!defined('_TABLE_MENUWEB'))                 define('_TABLE_MENUWEB', 'Internetlink');
if(!defined('_TABLE_REORDER'))                 define('_TABLE_REORDER', 'Verschieben');
if(!defined('_TABLE_DEFAULT_NEWS_CATEGORY'))   define('_TABLE_DEFAULT_NEWS_CATEGORY', 'Voreingestellte Neuigkeiten-Kategorie');
if(!defined('_TABLE_MAIN_CS'))                 define('_TABLE_MAIN_CS', 'Komponente f&#252;r die Hauptseite');
if(!defined('_TABLE_SIDE_CS'))                 define('_TABLE_SIDE_CS', 'Komponente f&#252;r die Seitenleiste');
if(!defined('_TABLE_START'))                   define('_TABLE_START', 'Start');
if(!defined('_TABLE_PREVIOUS'))                define('_TABLE_PREVIOUS', 'Vorherige');
if(!defined('_TABLE_NEXT'))                    define('_TABLE_NEXT', 'N&#228;chste');
if(!defined('_TABLE_END'))                     define('_TABLE_END', 'Ende');
if(!defined('_TABLE_DISPLAY'))                 define('_TABLE_DISPLAY', 'Zeige');
if(!defined('_TABLE_A_PAGE'))                  define('_TABLE_A_PAGE', 'pro Seite');
if(!defined('_TABLE_OF'))                      define('_TABLE_OF', 'von');
if(!defined('_TABLE_ENABLED_THIS'))            define('_TABLE_ENABLED_THIS', 'Aktivieren');
if(!defined('_TABLE_DISABLED_THIS'))           define('_TABLE_DISABLED_THIS', 'Deaktivieren');
if(!defined('_TABLE_IP'))                      define('_TABLE_IP', 'IP');
if(!defined('_TABLE_DOMAIN'))                  define('_TABLE_DOMAIN', 'Domain');
if(!defined('_TABLE_SIDEBAR'))                 define('_TABLE_SIDEBAR', 'Seitenleiste');
if(!defined('_TABLE_MAINCONTENT'))             define('_TABLE_MAINCONTENT', 'Hauptseite');
if(!defined('_TABLE_BOTH'))                    define('_TABLE_BOTH', 'Beide');
if(!defined('_TABLE_FILTER'))                  define('_TABLE_FILTER', 'Filter und Einstellungen');
if(!defined('_TABLE_SORT_SIDE'))               define('_TABLE_SORT_SIDE', 'Position Seitenleiste');
if(!defined('_TABLE_LOCATION'))                define('_TABLE_LOCATION', 'Ort');
if(!defined('_TABLE_DATES'))                   define('_TABLE_DATES', 'Termine');
if(!defined('_TABLE_HELPBROWSER'))             define('_TABLE_HELPBROWSER', 'toendaCMS Hilfe');
if(!defined('_TABLE_LINKBROWSER'))             define('_TABLE_LINKBROWSER', 'Linkbrowser');
if(!defined('_TABLE_LINKBROWSER_TEXT'))        define('_TABLE_LINKBROWSER_TEXT', 'Klick auf den Button um den Link in ihrem Dokument zu nutzen. Sie k&#246;nnen einen Titel f&#252;r den Link im Textfeld eingeben, dieser wird dann im Dokument erscheinen.');
if(!defined('_TABLE_LINKBROWSER_TEXT_TINYMCE'))define('_TABLE_LINKBROWSER_TEXT_TINYMCE', '<strong>tinyMCE:</strong> Sie m&#252;ssen einen Text selektiert haben um ihn in einen Link zu verwandeln.');
if(!defined('_TABLE_IMAGEBROWSER'))            define('_TABLE_IMAGEBROWSER', 'Medienbrowser');
if(!defined('_TABLE_IMAGEBROWSER_TEXT'))       define('_TABLE_IMAGEBROWSER_TEXT', 'Klick auf den Button um die Mediale Datei in ihrem Dokument zu nutzen.');
if(!defined('_TABLE_DIARY_RSS'))               define('_TABLE_DIARY_RSS', 'Termine als RSS Feeds');
if(!defined('_TABLE_DIARY_TICKET'))            define('_TABLE_DIARY_TICKET', 'Kartenverkauf');
if(!defined('_TABLE_IMPORT'))                  define('_TABLE_IMPORT', 'Import');
if(!defined('_TABLE_SORT'))                    define('_TABLE_SORT', 'Sortierung');
if(!defined('_TABLE_SORT_DESC'))               define('_TABLE_SORT_DESC', 'Absteigende Sortierung');
if(!defined('_TABLE_SORT_ASC'))                define('_TABLE_SORT_ASC', 'Aufsteigende Sortierung');
if(!defined('_TABLE_VIEW'))                    define('_TABLE_VIEW', 'Ansicht');
if(!defined('_TABLE_FRONTPAGE'))               define('_TABLE_FRONTPAGE', 'Startseite');
if(!defined('_TABLE_SHOWONMAINPAGE'))          define('_TABLE_SHOWONMAINPAGE', 'Auf Hauptseite anzeigen');
if(!defined('_TABLE_BROWSE'))                  define('_TABLE_BROWSE', 'St&#246;bern');
if(!defined('_TABLE_BOOKMARK'))                define('_TABLE_BOOKMARK', 'Bookmark');
if(!defined('_TABLE_SYS_INFO'))                define('_TABLE_SYS_INFO', 'System Informationen');
if(!defined('_TABLE_YOU_ARE_RUNNING'))         define('_TABLE_YOU_ARE_RUNNING', 'Aktuelle Version: ');
if(!defined('_TABLE_SITE_STATS'))              define('_TABLE_SITE_STATS', 'Interne Statistik');
if(!defined('_TABLE_NUM_OF_NEWS'))             define('_TABLE_NUM_OF_NEWS', 'Neuigkeiten Insgesamt');
if(!defined('_TABLE_NUM_OF_YOUR_NEWS'))        define('_TABLE_NUM_OF_YOUR_NEWS', 'Eigene Neuigkeiten');
if(!defined('_TABLE_NUM_OF_COMMENTS'))         define('_TABLE_NUM_OF_COMMENTS', 'Kommentare Insgesamt');


// MESSAGES
if(!defined('_DIE_LOGIN'))                     define('_DIE_LOGIN', 'Sie m&#252;ssen sich erst anmelden!<br /><a href="index.php">Log in</a>');
if(!defined('_MSG_NOINFO'))                    define('_MSG_NOINFO', '[KEINE INFORMATIONEN VERF&#220;GBAR]');
if(!defined('_MSG_SAVED'))                     define('_MSG_SAVED', 'Erfolgreich gespeichert.');
if(!defined('_MSG_SAVED_FAILED'))              define('_MSG_SAVED_FAILED', 'Speichern fehlgeschlagen.');
if(!defined('_MSG_SEND'))                      define('_MSG_SEND', 'Erfolgreich versendet.');
if(!defined('_MSG_SEND_FAILED'))               define('_MSG_SEND_FAILED', 'Fehler beim Versenden!');
if(!defined('_MSG_NOTWRITABLE'))               define('_MSG_NOTWRITABLE', 'IST NICHT BESCHREIBBAR!');
if(!defined('_MSG_NOINSTALL'))                 define('_MSG_NOINSTALL', 'Bitte erst installieren!');
if(!defined('_MSG_GOTOINSTALL'))               define('_MSG_GOTOINSTALL', 'ZUR INSTALLATION');
if(!defined('_MSG_RM_INSTALLDIR'))             define('_MSG_RM_INSTALLDIR', 'Bitte entfernen Sie den Installationsordner!');
if(!defined('_MSG_PAGE_LOAD_1'))               define('_MSG_PAGE_LOAD_1', 'Seite in');
if(!defined('_MSG_PAGE_LOAD_2'))               define('_MSG_PAGE_LOAD_2', 'Sekunden erstellt');
if(!defined('_MSG_NOIMAGE'))                   define('_MSG_NOIMAGE', 'Kein Bild ausgewaehlt.');
if(!defined('_MSG_IMAGE'))                     define('_MSG_IMAGE', 'Bild erfolgreich hochgeladen in Pfad:');
if(!defined('_MSG_NONAME'))                    define('_MSG_NONAME', 'Keinen Namen eingegeben');
if(!defined('_MSG_NOCAPTCHA'))                 define('_MSG_NOCAPTCHA', 'Bitte geben Sie den angezeigten Code aus dem Bild ein');
if(!defined('_MSG_CAPTCHA_NOT_VALID'))         define('_MSG_CAPTCHA_NOT_VALID', 'Ihr eingegebener Code und der Code im Bild stimmen nicht ueberein.');
if(!defined('_MSG_FALSEPASSWORD'))             define('_MSG_FALSEPASSWORD', 'Falsches Passwort eingegeben!');
if(!defined('_MSG_PASSWORDNOTVALID'))          define('_MSG_PASSWORDNOTVALID', 'Passwoerter stimmen nicht ueberein!');
if(!defined('_MSG_NOPASSWORD'))                define('_MSG_NOPASSWORD', 'Kein Passwort eingegeben!');
if(!defined('_MSG_NOEMAIL'))                   define('_MSG_NOEMAIL', 'Keine eMail Adresse eingegeben');
if(!defined('_MSG_EMAILVALID'))                define('_MSG_EMAILVALID', 'eMail Adresse nicht vollstaendig');
if(!defined('_MSG_DELETE'))                    define('_MSG_DELETE', 'Erfolgreich geloescht.');
if(!defined('_MSG_DELETE_ERROR'))              define('_MSG_DELETE_ERROR', 'Es konnte nicht geloescht werden.');
if(!defined('_MSG_DELETE_SUBMIT'))             define('_MSG_DELETE_SUBMIT', 'Wollen Sie diesen Eintrag wirklich loeschen?');
if(!defined('_MSG_DELETE_INACTIVE'))           define('_MSG_DELETE_INACTIVE', 'Es konnte nicht geloescht werden. Der entsprechende Eintrag wurde nicht mit der Checkbox aktiviert.');
if(!defined('_MSG_NOSUBJECT'))                 define('_MSG_NOSUBJECT', 'Bitte geben Sie den Betreff ein');
if(!defined('_MSG_NOMSG'))                     define('_MSG_NOMSG', 'Bitte geben Sie die Nachricht ein');
if(!defined('_MSG_NEWSLETTER'))                define('_MSG_NEWSLETTER', 'Sie haben sich erfolgreich zum Newsletter angemeldet');
if(!defined('_MSG_POLL'))                      define('_MSG_POLL', 'Vielen Dank, dass Sie an dieser Umfrage teilgenommen haben.');
if(!defined('_MSG_UPLOAD'))                    define('_MSG_UPLOAD', 'Die Datei wurde erfolgreich hochgeladen, nach ');
if(!defined('_MSG_NOUPLOAD'))                  define('_MSG_NOUPLOAD', 'Die Datei konnte nicht hochgeladen werden.');
if(!defined('_MSG_NOUPLOAD_PHP'))              define('_MSG_NOUPLOAD_PHP', 'Die Datei konnte nicht hochgeladen werden. Entweder ist die <upload_max_size> oder die <post_max_size> Einstellung in der <php.ini> zu klein.');
if(!defined('_MSG_ERROR'))                     define('_MSG_ERROR', 'Fehler');
if(!defined('_MSG_CODE'))                      define('_MSG_CODE', 'Nummer');
if(!defined('_MSG_REGNOTALLOWD'))              define('_MSG_REGNOTALLOWD', 'Zur Zeit ist leider keine Registrierung moeglich.');
if(!defined('_MSG_NOACCOUNT'))                 define('_MSG_NOACCOUNT', 'Sie haben noch keinen Account.');
if(!defined('_MSG_NOCONTENT'))                 define('_MSG_NOCONTENT', 'Sie haben nicht alle benoetigten Felder ausgefuellt.');
if(!defined('_MSG_USERNOTEXISTS'))             define('_MSG_USERNOTEXISTS', 'Der Benutzer existiert nicht.');
if(!defined('_MSG_USEREXISTS'))                define('_MSG_USEREXISTS', 'Der Benutzer ist bereits vorhanden. Bitte waehlen Sie einen anderen Benutzernamen.');
if(!defined('_MSG_PHP_UPLOAD_SETTINGS'))       define('_MSG_PHP_UPLOAD_SETTINGS', 'Ihre PHP Hochladeeinstellungen reichen fuer diese Funktion nicht aus.');
if(!defined('_MSG_PHP_SAFE_MODE_SETTINGS'))    define('_MSG_PHP_SAFE_MODE_SETTINGS', 'Auf Ihrem Server ist f&#252;r PHP \'safe_mode\' auf \'on\' geschaltet, dadurch k&#246;nnen Sie gewisse Funktionen nicht nutzen.');
if(!defined('_MSG_MAX_FILE_SIZE'))             define('_MSG_MAX_FILE_SIZE', 'Maximale Dateigr&#246;&#223;e');
if(!defined('_MSG_MAX_POST_SIZE'))             define('_MSG_MAX_POST_SIZE', 'Maximale POST-Gr&#246;&#223;e');
if(!defined('_MSG_FILE_UPLOADS'))              define('_MSG_FILE_UPLOADS', 'Dateien hochladen');
if(!defined('_MSG_NOTENOUGH_USERRIGHTS'))      define('_MSG_NOTENOUGH_USERRIGHTS', 'Ihre Benutzerrechte erlauben Ihnen die Benutzung dieser Seite nicht.');
if(!defined('_MSG_SESSION_EXPIRED'))           define('_MSG_SESSION_EXPIRED', '<div align="center"><h1>Ihre Session ist abgelaufen!</h1><br /><strong>Bitte melden Sie sich erneut an.</strong><br /><a href="index.php">Einloggen</a></div>');
if(!defined('_MSG_NOT_FINALIZED'))             define('_MSG_NOT_FINALIZED', 'Ihr Dokument ist noch nicht fertiggestellt. Wollen Sie es trotzdem veroeffentlichen?');
if(!defined('_MSG_NOT_PUBLISHED'))             define('_MSG_NOT_PUBLISHED', 'Das gew&#252;nschte Dokument wird zur Zeit bearbeitet. Es steht Ihnen in K&#252;rze wieder zur Verf&#252;gung!');
if(!defined('_MSG_DISABLED_MODUL'))            define('_MSG_DISABLED_MODUL', 'Die gew&#252;nschte Funktion ist zur Zeit deaktiviert. Bitte versuchen Sie es zu einem sp&#228;tern Zeitpunkt noch einmal.');
if(!defined('_MSG_CHANGE_DATABASE_ENGINE'))    define('_MSG_CHANGE_DATABASE_ENGINE', 'Wollen Sie wirklich die Datenbank Engine wechseln?\nSie werden ausgeloggt und koennen Ihre alten Daten nicht in der neuen Datenbank benutzen.\nEin XML-SQL Import ist in Planung.');
if(!defined('_MSG_IF_DOWNLOAD_DOES_NOT_START'))define('_MSG_IF_DOWNLOAD_DOES_NOT_START', 'Falls der Download nicht automatisch starten sollte, klicken Sie bitte den folgenden Link');
if(!defined('_MSG_BACKUP_SUCCESSFULL'))        define('_MSG_BACKUP_SUCCESSFULL', 'Das Datenbank Backup ist erfolgreich abgeschlossen.\nBetroffene Tabellen:');
if(!defined('_MSG_BACKUP_FAILED'))             define('_MSG_BACKUP_FAILED', 'Das Datenbank Backup ist fehlgeschlagen!');
if(!defined('_MSG_CHANGES'))                   define('_MSG_CHANGES', 'Sie haben einige AEnderungen noch nicht gespeichert.');
if(!defined('_MSG_SAVE_NOW'))                  define('_MSG_SAVE_NOW', 'Moechten sie jetzt speichern?');
if(!defined('_MSG_NO_ALBUM_WITH_THIS_ID'))     define('_MSG_NO_ALBUM_WITH_THIS_ID', 'Es konnte kein Album zu dieser ID gefunden werden!');
if(!defined('_MSG_CREATE_ALBUM_FIRST'))        define('_MSG_CREATE_ALBUM_FIRST', '* Erst ein Album erstellen *');
if(!defined('_MSG_ACTIVATE_NEW_PW_FIRST'))     define('_MSG_ACTIVATE_NEW_PW_FIRST', 'Sie m&#252;ssen Ihr neues Passwort erst aktivieren, nutzen Sie dazu bitte folgenden Link:');
if(!defined('_MSG_SUCCESSFULL_RETRIEVED'))     define('_MSG_SUCCESSFULL_RETRIEVED', 'Das Passwort wurde erfolgreich aktiviert.');
if(!defined('_MSG_ERROR_ON_RETRIEVING'))       define('_MSG_ERROR_ON_RETRIEVING', 'Fehler beim aktivieren des Passwortes!');
if(!defined('_MSG_COMMENT_FOR'))               define('_MSG_COMMENT_FOR', 'Kommentar zu');


// LOGIN
if(!defined('_LOGIN_MSG'))                     define('_LOGIN_MSG', 'Login');
if(!defined('_LOGIN_USERNAME'))                define('_LOGIN_USERNAME', 'Benutzername');
if(!defined('_LOGIN_USERNAME_JS'))             define('_LOGIN_USERNAME_JS', 'Bitte geben Sie Ihren Benutzernamen ein!');
if(!defined('_LOGIN_PASSWORD'))                define('_LOGIN_PASSWORD', 'Passwort');
if(!defined('_LOGIN_PASSWORD_JS'))             define('_LOGIN_PASSWORD_JS', 'Bitte geben Sie Ihr Passwort ein!');
if(!defined('_LOGIN_FALSE'))                   define('_LOGIN_FALSE', 'Falsche Eingabe: Benutzername, Passwort oder Benutzerrechte (Gruppe)');
if(!defined('_LOGIN_FALSE_LPW'))               define('_LOGIN_FALSE_LPW', 'Falsche Eingabe: Benutzername oder eMail');
if(!defined('_LOGIN_SUBMIT'))                  define('_LOGIN_SUBMIT', 'Login');
if(!defined('_LOGIN_LOGOUT'))                  define('_LOGIN_LOGOUT', 'Ausloggen');
if(!defined('_LOGIN_PROFILE'))                 define('_LOGIN_PROFILE', 'Profil');
if(!defined('_LOGIN_LIST'))                    define('_LOGIN_LIST', 'Mitgliederliste');
if(!defined('_LOGIN_LIST_TEXT'))               define('_LOGIN_LIST_TEXT', 'Dies ist die Liste aller Mitglieder. Sie k&#246;nnen auf einen Benutzernamen klicken um sich dessen Profil anzuschauen.');
if(!defined('_LOGIN_ADMIN'))                   define('_LOGIN_ADMIN', 'Administration');
if(!defined('_LOGIN_FORGOTPW'))                define('_LOGIN_FORGOTPW', 'Das Passwort vergessen?');
if(!defined('_LOGIN_WELCOME'))                 define('_LOGIN_WELCOME', 'Willkommen');
if(!defined('_LOGIN_SUBMIT_NEWS'))             define('_LOGIN_SUBMIT_NEWS', 'Neuigkeit schreiben');
if(!defined('_LOGIN_SUBMIT_IMAGES'))           define('_LOGIN_SUBMIT_IMAGES', 'Bilder hochladen');
if(!defined('_LOGIN_CREATE_ALBUM'))            define('_LOGIN_CREATE_ALBUM', 'Album erstellen');
if(!defined('_LOGIN_CREATE_CATEGORY'))         define('_LOGIN_CREATE_CATEGORY', 'Kategorie erstellen');
if(!defined('_LOGIN_SUBMIT_MEDIA'))            define('_LOGIN_SUBMIT_MEDIA', 'Medien hochladen');


// REGISTRATION
if(!defined('_REG_TITLE'))                     define('_REG_TITLE', 'Registrierung');
if(!defined('_REG_LPW'))                       define('_REG_LPW', 'Das Passwort vergessen?');
if(!defined('_REG_LPWTEXT'))                   define('_REG_LPWTEXT', 'Bitte geben Sie Ihren Benutzernamen und Ihre eMail Adresse ein und klicken auf den Senden Button. Sie werden in K&#252;rze ein neues Passwort per eMail erhalten. Benutzen Sie das zugestellte Passwort um Zugang zu unseren Seiten zu erhalten.');
if(!defined('_REG_TEXT_1'))                    define('_REG_TEXT_1', 'Felder mit einem gef&#252;llten Punkt, m&#252;ssen ausgef&#252;llt werden.');
if(!defined('_REG_TEXT_2'))                    define('_REG_TEXT_2', 'Leere Felder sind optionale Angaben und muessen nicht ausgefuellt werden.');
if(!defined('_REG_SUBMIT_LPW'))                define('_REG_SUBMIT_LPW', 'Passwort zusenden');
if(!defined('_REG_SUBMIT_SR'))                 define('_REG_SUBMIT_SR', 'Registrierung abschlie&#223;en');
if(!defined('_REG_PWNOTAGREE'))                define('_REG_PWNOTAGREE', 'Die Passw&#246;rter stimmen nicht &#252;berein!');
if(!defined('_REG_NAME_NG'))                   define('_REG_NAME_NG', 'Keinen Namen eingegeben!');
if(!defined('_REG_USERNAME_NG'))               define('_REG_USERNAME_NG', 'Keinen Benutzernamen eingegeben!');
if(!defined('_REG_PASSWORD_NG'))               define('_REG_PASSWORD_NG', 'Kein Passwort eingegeben!');
if(!defined('_REG_EMAIL_NG'))                  define('_REG_EMAIL_NG', 'Keine eMail eingegeben!');
if(!defined('_REG_LPW_SUCCESS'))               define('_REG_LPW_SUCCESS', 'Ihr neues Passwort');
if(!defined('_REG_SUCCESS'))                   define('_REG_SUCCESS', 'Ihre Registrierung war erfolgreich.');
if(!defined('_REG_NO_SUCCESS'))                define('_REG_NO_SUCCESS', 'Ihre Registrierung war NICHT erfolgreich.');
if(!defined('_REG_SUCCESS_TEXT'))              define('_REG_SUCCESS_TEXT', 'Ihre Registrierung war erfolgreich. Bitte aktivieren Sie Ihren Account ueber den angegeben Link, um vollen Zugriff auf geschuetzte Bereiche zu erhalten.');
if(!defined('_REG_AUTO_MSG'))                  define('_REG_AUTO_MSG', 'Diese Nachricht wurde automatisch versendet von');
if(!defined('_REG_TEXT_LPW'))                  define('_REG_TEXT_LPW', 'Ein Benutzer hat ein neues Passwort f&#252;r diesen Benutzeraccount verlangt. Hiermit erhalten Sie Ihr neues Passwort.');
if(!defined('_REG_VALIDATE'))                  define('_REG_VALIDATE', 'Gratulation, Sie sind nun registriert. In die Login Felder k&#246;nnen Sie Ihren Benutzernamen und das Passwort eingeben.');
if(!defined('_REG_NO_VALIDATE'))               define('_REG_NO_VALIDATE', 'Fehler! Ihr Validierungcode ist nicht korrekt.');
if(!defined('_REG_USERPROFILE'))               define('_REG_USERPROFILE', 'Tip: Sie k&#246;nnen Ihre Daten unter dem Menupunkt Profil &#228;ndern.');
if(!defined('_REG_EMAIL'))                     define('_REG_EMAIL', 'Ein neuer Benutzer hat sich angemeldet.');
if(!defined('_REG_SUCCESS_MAIL'))              define('_REG_SUCCESS_MAIL', 'Ein neuer Benutzer hat sich &#252;ber ihre Webseite angemeldet.');


// PROFILE
if(!defined('_PROFILE_TITLE'))                 define('_PROFILE_TITLE', 'Benutzerprofil anschauen');
if(!defined('_PROFILE_EDIT'))                  define('_PROFILE_EDIT', 'Benutzerprofil bearbeiten');


// USERPAGES
if(!defined('_USERPAGE'))                      define('_USERPAGE', 'Editorseiten');
if(!defined('_USERPAGE_TEXT'))                 define('_USERPAGE_TEXT', 'Sie k&#246;nnen einige Einstellungen f&#252;r die Editorseiten anpassen. Zum Beispiel die Breite der Eingabefelder in den Benutzerprofilen und f&#252;r die Redaktionsseiten. Die M&#246;glichkeit Neuigkeiten zu schreiben, Kategorien und Bilderalben zu erstellen und Bilder hochzuladen kann hier auch aktiviert und deaktiviert werden.');
if(!defined('_USERPAGE_TEXT_WIDTH'))           define('_USERPAGE_TEXT_WIDTH', 'Breite der Textfelder');
if(!defined('_USERPAGE_INPUT_WIDTH'))          define('_USERPAGE_INPUT_WIDTH', 'Breite der Eingabefelder');
if(!defined('_USERPAGE_PUBLISH_NEWS'))         define('_USERPAGE_PUBLISH_NEWS', 'Benutzer d&#252;rfen Neuigkeiten schreiben');
if(!defined('_USERPAGE_PUBLISH_IMAGES'))       define('_USERPAGE_PUBLISH_IMAGES', 'Benutzer d&#252;rfen Bilder hochladen');
if(!defined('_USERPAGE_PUBLISH_ALBUMS'))       define('_USERPAGE_PUBLISH_ALBUMS', 'Benutzer d&#252;rfen Alben erstellen');
if(!defined('_USERPAGE_CREATE_CATEGORIES'))    define('_USERPAGE_CREATE_CATEGORIES', 'Benutzer d&#252;rfen Neuigkeiten-Kategorien erstellen');
if(!defined('_USERPAGE_PUBLISH_PICTURE'))      define('_USERPAGE_PUBLISH_PICTURE', 'Benutzer d&#252;rfen Bilder in den Medien-Manager hochladen');


// STARTPAGE
if(!defined('_START_MSG'))                     define('_START_MSG', 'Willkommen');
if(!defined('_START_QUESTION'))                define('_START_QUESTION', 'Was m&#246;chten Sie heute tun?');
if(!defined('_START_TEXT_0'))                  define('_START_TEXT_0', '<strong>Schauen Sie sich ihren Schreibtisch an.</strong> Auf Ihrem Schreibtisch finden Sie Ihre Aufgaben, Notizen und eine &#220;bersicht &#252;ber noch zu bearbeitende Dokumente und Neuigkeiten.');
if(!defined('_START_TEXT_1'))                  define('_START_TEXT_1', '<strong>Eine neue Seite erstellen.</strong> Dazu erstellen Sie einen Menueintrag und editieren danach den Artikel und die Seitenleiste.');
if(!defined('_START_TEXT_2'))                  define('_START_TEXT_2', '<strong>Ihre Systemeinstellungen bearbeiten.</strong> Ver&#228;ndern Sie Name und Titel der Webseite oder bearbeiten Sie ihre Metatags.');
if(!defined('_START_TEXT_3'))                  define('_START_TEXT_3', '<strong>Eine Neuigkeit ver&#246;ffentlichen.</strong> Schreiben Sie Ihre neuste Nachricht und ver&#246;ffentlichen Sie sie.');
if(!defined('_START_TEXT_4'))                  define('_START_TEXT_4', '<strong>Laden Sie ein Bild in Ihre Bildergalerie.</strong> Zeigen Sie Ihren Freunden Ihre besten Ansichten oder lustigsten Erlebnisse.');



// DESKTOP
if(!defined('_DESKTOP_TOP_TEXT'))              define('_DESKTOP_TOP_TEXT', 'Wenn Sie den Inhalt dieser Seite bearbeiten wollen, klicken Sie bitte auf den Seitentitel im Seitenbaum auf der linken Seite.');
if(!defined('_DESKTOP_UNPUBLISHED_NEWS'))      define('_DESKTOP_UNPUBLISHED_NEWS', 'Noch nicht ver&#246;ffentlichte Neuigkeiten');
if(!defined('_DESKTOP_UNPUBLISHED_PAGES'))     define('_DESKTOP_UNPUBLISHED_PAGES', 'Noch nicht ver&#246;ffentlichte Dokumente');
if(!defined('_DESKTOP_UNFINISHED_PAGES'))      define('_DESKTOP_UNFINISHED_PAGES', 'Noch nicht fertiggestellte Dokumente');


// SIDEMENU
if(!defined('_SIDEMENU_TITLE'))                define('_SIDEMENU_TITLE', 'Seitenmenu Links');
if(!defined('_SIDEMENU_TEXT'))                 define('_SIDEMENU_TEXT', 'Hier k&#246;nnen Sie ihr Hauptmenu erstellen. Die ID ist die Reihenfolge der Links, die SUB ID ist die Reihenfolge des Submenus und die CID ist die ID des Dokuments oder der Erweiterung zu der der Link f&#252;hren soll. Jeden Eintrag k&#246;nnen Sie per Klick auf den jeweiligen Eintrag bearbeiten.');


// SIDEMENU
if(!defined('_CS_TITLE'))                      define('_CS_TITLE', 'Komponentensystem-Objekte');
if(!defined('_CS_TEXT'))                       define('_CS_TEXT', 'Dies ist die Liste aller installierten Komponenten. Hier k&#246;nnen Sie die jeweiligen Einstellungen &#228;ndern.');


// TOPMENU
if(!defined('_TOPMENU_TITLE'))                 define('_TOPMENU_TITLE', 'Topmenu Links');
if(!defined('_TOPMENU_TEXT'))                  define('_TOPMENU_TEXT', 'Hier k&#246;nnen Sie Ihr Topmenu erstellen. Die ID ist die Reihenfolge der Links und die CID ist die ID der statischen Seite oder der Erweiterung zu der der Link f&#252;hren soll.');


// MENUTITLE
if(!defined('_MENUTITLE_TITLE'))               define('_MENUTITLE_TITLE', 'Menutitel');
if(!defined('_MENUTITLE_TEXT'))                define('_MENUTITLE_TEXT', 'Die Positions-Nummer bestimmt die Stelle im Menu.');


// CONTENT
if(!defined('_CONTENT_TITLE'))                 define('_CONTENT_TITLE', 'Statische Seiten');
if(!defined('_CONTENT_TEXT'))                  define('_CONTENT_TEXT', 'Die ID-Nummer ist die Nummer die Sie zum verkn&#252;pfen der einzelnen Seiten ben&#246;tigen.');
if(!defined('_CONTENT_TEXT_PAGE'))             define('_CONTENT_TEXT_PAGE', 'Bitte tragen Sie hier alle Daten wie den Titel der Seite, einen kleinen Untertitel, nat&#252;rlich den Text selbst und vielleicht noch eine kleine Fussnote ein.');
if(!defined('_CONTENT_TEMPLATE'))              define('_CONTENT_TEMPLATE', 'Seiten Template');
if(!defined('_CONTENT_SECOND'))                define('_CONTENT_SECOND', 'Zweiter Text');
if(!defined('_CONTENT_OLDIMAGE'))              define('_CONTENT_OLDIMAGE', 'Vorheriges Bild');
if(!defined('_CONTENT_IMAGEUNDER'))            define('_CONTENT_IMAGEUNDER', 'Das Bild unter dem Text');
if(!defined('_CONTENT_IMAGERIGHT'))            define('_CONTENT_IMAGERIGHT', 'Das Bild rechts vom Text');
if(!defined('_CONTENT_FOOT'))                  define('_CONTENT_FOOT', 'Fu&#223;note');
if(!defined('_CONTENT_NEXT_PAGE'))             define('_CONTENT_NEXT_PAGE', 'N&#228;chste Seite');
if(!defined('_CONTENT_BACK_PAGE'))             define('_CONTENT_BACK_PAGE', 'Vorherige Seite');
if(!defined('_CONTENT_LAST_PAGE'))             define('_CONTENT_LAST_PAGE', 'Letzte Seite');
if(!defined('_CONTENT_FIRST_PAGE'))            define('_CONTENT_FIRST_PAGE', 'Letzte Seite');
if(!defined('_CONTENT_LAST_UPDATE'))           define('_CONTENT_LAST_UPDATE', 'Letzte &#196;nderung am');
if(!defined('_CONTENT_NEW_LANG_DOCUMENT'))     define('_CONTENT_NEW_LANG_DOCUMENT', 'Neues Dokument mit einer anderen Sprache');
if(!defined('_CONTENT_ORG_DOCUMENT'))          define('_CONTENT_ORG_DOCUMENT', 'Original Dokument');



// IMPRESSUM
if(!defined('_IMPRESSUM_CONFIG'))              define('_IMPRESSUM_CONFIG', 'Impressum Konfiguration');
if(!defined('_IMPRESSUM_ID'))                  define('_IMPRESSUM_ID', 'ID');
if(!defined('_IMPRESSUM_TITLE'))               define('_IMPRESSUM_TITLE', 'Impressum Titel');
if(!defined('_IMPRESSUM_SUBTITLE'))            define('_IMPRESSUM_SUBTITLE', 'Impressum Untertitel');
if(!defined('_IMPRESSUM_CONTACT'))             define('_IMPRESSUM_CONTACT', 'Kontaktperson');
if(!defined('_IMPRESSUM_NO_CONTACT'))          define('_IMPRESSUM_NO_CONTACT', 'Keine Kontaktperson angeben');
if(!defined('_IMPRESSUM_SELECT'))              define('_IMPRESSUM_SELECT', 'Bitte w&#228;hlen');
if(!defined('_IMPRESSUM_TAX'))                 define('_IMPRESSUM_TAX', 'Steuernummer / Steuergericht');
if(!defined('_IMPRESSUM_UST'))                 define('_IMPRESSUM_UST', 'UST ID Nr.');
if(!defined('_IMPRESSUM_LEGAL'))               define('_IMPRESSUM_LEGAL', 'AGB / Rechtliches');
if(!defined('_IMPRESSUM_PHONE'))               define('_IMPRESSUM_PHONE', 'Telefon');
if(!defined('_IMPRESSUM_FAX'))                 define('_IMPRESSUM_FAX', 'Telefax');
if(!defined('_IMPRESSUM_CONTACTPERSON'))       define('_IMPRESSUM_CONTACTPERSON', 'Ansprechpartner');
if(!defined('_IMPRESSUM_OFFICE'))              define('_IMPRESSUM_OFFICE', 'Anschrift');
if(!defined('_IMPRESSUM_EMAIL'))               define('_IMPRESSUM_EMAIL', 'eMail');
if(!defined('_IMPRESSUM_COPY'))                define('_IMPRESSUM_COPY', 'Alle Rechte vorbehalten.');
if(!defined('_IMPRESSUM_SITECOPY'))            define('_IMPRESSUM_SITECOPY', 'Der Inhalt dieser Seite unterliegt dem Copyright von');


// SIDEBAR
if(!defined('_SIDE_TEXT'))                     define('_SIDE_TEXT', 'Die ID-Nummer ist die Nummer die Sie zum verkn&#252;pfen der einzelnen Seiten brauchen.');
if(!defined('_SIDE_CONTACTS'))                 define('_SIDE_CONTACTS', 'Kontakte');


// HELP
if(!defined('_HELP_SUPPORTED_CHARSETS'))       define('_HELP_SUPPORTED_CHARSETS', 'Unterst&#252;zte Zeichens&#228;tze');


// GROUPS
if(!defined('_GROUP_DEV'))                     define('_GROUP_DEV', 'Entwickler und Betreiber');
if(!defined('_GROUP_ADMIN'))                   define('_GROUP_ADMIN', 'Administrator');
if(!defined('_GROUP_WRITER'))                  define('_GROUP_WRITER', 'Erweiterter Redakteur');
if(!defined('_GROUP_EDITOR'))                  define('_GROUP_EDITOR', 'Einfacher Redakteur');
if(!defined('_GROUP_PRESENTER'))               define('_GROUP_PRESENTER', 'Moderator des Forums');
if(!defined('_GROUP_USER'))                    define('_GROUP_USER', 'Benutzer der Seite');


// TCMS SCRIPT
if(!defined('_TCMSSCRIPT_BR'))                 define('_TCMSSCRIPT_BR', 'Zeilenumbruch');
if(!defined('_TCMSSCRIPT_MORE'))               define('_TCMSSCRIPT_MORE', 'Eigene Neuigkeiten Ende');
if(!defined('_TCMSSCRIPT_IMAGES'))             define('_TCMSSCRIPT_IMAGES', 'Bilder suchen');


// GLOBAL ID
if(!defined('_NEWPAGE_TITLE'))                 define('_NEWPAGE_TITLE', 'Eine neue Seite erstellen');
if(!defined('_NEWPAGE_TEXT'))                  define('_NEWPAGE_TEXT', 'Mit diesem Dialog k&#246;nnen Sie eine neue Seite erstellen. W&#228;hlen Sie dazu den Titel, ein Menu, wenn Sie wollen auch ein Untermenu und die Zugriffsberechtigung.');


// EXPLORER
if(!defined('_EXPLORE_UP'))                    define('_EXPLORE_UP', 'Eintrag nach oben verschieben.');
if(!defined('_EXPLORE_DOWN'))                  define('_EXPLORE_DOWN', 'Eintrag nach unten verschieben.');


// NOTEPAD
if(!defined('_NOTEBOOK_TITLE'))                define('_NOTEBOOK_TITLE', 'Pers&#246;nlicher Notizblock');
if(!defined('_NOTEBOOK_TEXT'))                 define('_NOTEBOOK_TEXT', 'Dies ist Ihr pers&#246;nlicher Notzblock. Sie k&#246;nnen hier alle Ihre Arbeitsschritte und offenen Ideen aufschreiben. Es ist ausschlie&#223;lich f&#252;r ihre Augen gedacht.');
if(!defined('_NOTEBOOK_DETAIL'))               define('_NOTEBOOK_DETAIL', 'Ihr Notizblock');
if(!defined('_NOTEBOOK_MSG'))                  define('_NOTEBOOK_MSG', 'Ihr Notizblock braucht Sie');


// EXTENSION
if(!defined('_EXT_NEWS'))                      define('_EXT_NEWS', 'Neuigkeiten Manager');
if(!defined('_EXT_NEWS_NEWSAMOUNT'))           define('_EXT_NEWS_NEWSAMOUNT', 'Anzahl der Neuigkeiten im Manager (nicht im Archiv)');
if(!defined('_EXT_NEWS_ID'))                   define('_EXT_NEWS_ID', 'ID');
if(!defined('_EXT_NEWS_TITLE'))                define('_EXT_NEWS_TITLE', 'Neuigkeit Titel');
if(!defined('_EXT_NEWS_SUBTITLE'))             define('_EXT_NEWS_SUBTITLE', 'Neuigkeit Untertitel');
if(!defined('_EXT_NEWS_IMAGE'))                define('_EXT_NEWS_IMAGE', 'Neuigkeit Bild');
if(!defined('_EXT_NEWS_USE_COMMENTS'))         define('_EXT_NEWS_USE_COMMENTS', 'Kommentare zu Neuigkeiten zulassen');
if(!defined('_EXT_NEWS_USE_EMOTICONS'))        define('_EXT_NEWS_USE_EMOTICONS', 'Grafik-Smileys in den Kommentaren zulassen');
if(!defined('_EXT_NEWS_D_TIMESINCE'))          define('_EXT_NEWS_D_TIMESINCE', 'Timesince');
if(!defined('_EXT_NEWS_D_DATE'))               define('_EXT_NEWS_D_DATE', 'Normales Datum');
if(!defined('_EXT_NEWS_D_TEXT'))               define('_EXT_NEWS_D_TEXT', 'Darstellung als Text');
if(!defined('_EXT_NEWS_DISPLAY'))              define('_EXT_NEWS_DISPLAY', 'Darstellung des Datums');
if(!defined('_EXT_NEWS_DISPLAY_MORE'))         define('_EXT_NEWS_DISPLAY_MORE', 'Darstellung des <em>Weiter lesen</em>-Links');
if(!defined('_EXT_NEWS_MORE_NL_LEFT'))         define('_EXT_NEWS_MORE_NL_LEFT', 'Neuen Zeile - Linksb&#252;ndig');
if(!defined('_EXT_NEWS_MORE_NL_RIGHT'))        define('_EXT_NEWS_MORE_NL_RIGHT', 'Neuen Zeile - Rechtsb&#252;ndig');
if(!defined('_EXT_NEWS_MORE_NL_DIRECT'))       define('_EXT_NEWS_MORE_NL_DIRECT', 'Gleiche Zeile - Nach dem Text');
if(!defined('_EXT_NEWS_NEWS_SPACING'))         define('_EXT_NEWS_NEWS_SPACING', 'Abstand zwischen den Neuigkeiten');
if(!defined('_EXT_NEWS_USE_GRAVATAR'))         define('_EXT_NEWS_USE_GRAVATAR', 'Gravatare der Kommentierenden anzeigen');
if(!defined('_EXT_NEWS_USE_AUTOR'))            define('_EXT_NEWS_USE_AUTOR', 'Autor anzeigen');
if(!defined('_EXT_NEWS_USE_AUTOR_LINK'))       define('_EXT_NEWS_USE_AUTOR_LINK', 'Autor als Link anzeigen');
if(!defined('_EXT_NEWS_SELECT'))               define('_EXT_NEWS_SELECT', 'Bitte w&#228;hlen');
if(!defined('_EXT_NEWS_DESELECT'))             define('_EXT_NEWS_DESELECT', 'Kein Bild');
if(!defined('_EXT_NEWS_USE_FEEDS'))            define('_EXT_NEWS_USE_FEEDS', 'Syndication anbieten');
if(!defined('_EXT_NEWS_USE_RSS091'))           define('_EXT_NEWS_USE_RSS091', 'RSS 0.91 verwenden');
if(!defined('_EXT_NEWS_USE_RSS10'))            define('_EXT_NEWS_USE_RSS10', 'RSS 1.0 verwenden');
if(!defined('_EXT_NEWS_USE_RSS20'))            define('_EXT_NEWS_USE_RSS20', 'RSS 2.0 verwenden');
if(!defined('_EXT_NEWS_USE_ATOM03'))           define('_EXT_NEWS_USE_ATOM03', 'ATOM 0.3 verwenden');
if(!defined('_EXT_NEWS_USE_OPML'))             define('_EXT_NEWS_USE_OPML', 'OPML verwenden');
if(!defined('_EXT_NEWS_SYN_AMOUNT'))           define('_EXT_NEWS_SYN_AMOUNT', 'Wie viele Neuigkeiten in den Feeds?');
if(!defined('_EXT_NEWS_USE_SYN_TITLE'))        define('_EXT_NEWS_USE_SYN_TITLE', 'Syndication Titel in Seitenleiste ');
if(!defined('_EXT_NEWS_DEFAULT_FEED'))         define('_EXT_NEWS_DEFAULT_FEED', 'Voreingestellter Syndication Feed');
if(!defined('_EXT_NEWS_USE_TRACKBACK'))        define('_EXT_NEWS_USE_TRACKBACK', 'Trackback benutzen');
if(!defined('_EXT_CFORM'))                     define('_EXT_CFORM', 'Kontaktformular');
if(!defined('_EXT_CFORM_SHOW_CONTACTS_IN_SIDEBAR'))define('_EXT_CFORM_SHOW_CONTACTS_IN_SIDEBAR', 'Kontakte in Seitenleiste anzeigen');
if(!defined('_EXT_CFORM_USE_ADRESSBOOK'))      define('_EXT_CFORM_USE_ADRESSBOOK', 'Adressbuch benutzen');
if(!defined('_EXT_CFORM_USE_CONTACTPERSON'))   define('_EXT_CFORM_USE_CONTACTPERSON', 'Kontaktperson anzeigen');
if(!defined('_EXT_CFORM_EMAIL'))               define('_EXT_CFORM_EMAIL', 'eMail');
if(!defined('_EXT_CFORM_ID'))                  define('_EXT_CFORM_ID', 'ID');
if(!defined('_EXT_CFORM_TITLE'))               define('_EXT_CFORM_TITLE', 'Kontaktformular Titel');
if(!defined('_EXT_CFORM_SUBTITLE'))            define('_EXT_CFORM_SUBTITLE', 'Kontaktformular Untertitel');
if(!defined('_EXT_CFORM_SHOW_CONTACTEMAIL'))   define('_EXT_CFORM_SHOW_CONTACTEMAIL', 'Kontaktemailadresse anzeigen');
if(!defined('_EXT_BOOK'))                      define('_EXT_BOOK', 'G&#228;stebuch');
if(!defined('_EXT_BOOK_ID'))                   define('_EXT_BOOK_ID', 'ID');
if(!defined('_EXT_BOOK_TITLE'))                define('_EXT_BOOK_TITLE', 'G&#228;stebuch Titel');
if(!defined('_EXT_BOOK_SUBTITLE'))             define('_EXT_BOOK_SUBTITLE', 'G&#228;stebuch Untertitel');
if(!defined('_EXT_BOOK_ADMINPASS'))            define('_EXT_BOOK_ADMINPASS', 'Administrationspasswort');
if(!defined('_EXT_BOOK_ADMINUSER'))            define('_EXT_BOOK_ADMINUSER', 'Administrationsbenutzername');
if(!defined('_EXT_BOOK_ADMINCOLOR'))           define('_EXT_BOOK_ADMINCOLOR', 'Farbe Administrationstext');
if(!defined('_EXT_BOOK_ENTRYCOLOR'))           define('_EXT_BOOK_ENTRYCOLOR', 'Farbe Eintr&#228;ge');
if(!defined('_EXT_DOWNLOAD'))                  define('_EXT_DOWNLOAD', 'Download Manager Konfiguration');
if(!defined('_EXT_DOWNLOAD_ID'))               define('_EXT_DOWNLOAD_ID', 'ID');
if(!defined('_EXT_DOWNLOAD_TITLE'))            define('_EXT_DOWNLOAD_TITLE', 'Download Manager Titel');
if(!defined('_EXT_DOWNLOAD_SUBTITLE'))         define('_EXT_DOWNLOAD_SUBTITLE', 'Download Manager Untertitel');
if(!defined('_EXT_DOWNLOAD_TEXT'))             define('_EXT_DOWNLOAD_TEXT', 'Download Manager Text');
if(!defined('_EXT_NEWS_SYN_USE_RSS091_IMG'))   define('_EXT_NEWS_SYN_USE_RSS091_IMG', 'F&#252;r den RSS 0.91 Link Standard Bild verwenden?');
if(!defined('_EXT_NEWS_SYN_RSS091_TEXT'))      define('_EXT_NEWS_SYN_RSS091_TEXT', 'RSS 0.91 Link Text');
if(!defined('_EXT_NEWS_SYN_USE_RSS10_IMG'))    define('_EXT_NEWS_SYN_USE_RSS10_IMG', 'F&#252;r den RSS 1.0 Link Standard Bild verwenden?');
if(!defined('_EXT_NEWS_SYN_RSS10_TEXT'))       define('_EXT_NEWS_SYN_RSS10_TEXT', 'RSS 1.0 Link Text');
if(!defined('_EXT_NEWS_SYN_USE_RSS20_IMG'))    define('_EXT_NEWS_SYN_USE_RSS20_IMG', 'F&#252;r den RSS 2.0 Link Standard Bild verwenden?');
if(!defined('_EXT_NEWS_SYN_RSS20_TEXT'))       define('_EXT_NEWS_SYN_RSS20_TEXT', 'RSS 2.0 Link Text');
if(!defined('_EXT_NEWS_SYN_USE_ATOM03_IMG'))   define('_EXT_NEWS_SYN_USE_ATOM03_IMG', 'F&#252;r den Atom 0.3 Link Standard Bild verwenden?');
if(!defined('_EXT_NEWS_SYN_ATOM03_TEXT'))      define('_EXT_NEWS_SYN_ATOM03_TEXT', 'Atom 0.3 Link Text');
if(!defined('_EXT_NEWS_SYN_USE_OPML_IMG'))     define('_EXT_NEWS_SYN_USE_OPML_IMG', 'F&#252;r den Opml Link Standard Bild verwenden?');
if(!defined('_EXT_NEWS_SYN_OPML_TEXT'))        define('_EXT_NEWS_SYN_OPML_TEXT', 'Opml Link Text');
if(!defined('_EXT_NEWS_SYN_USE_CFEED'))        define('_EXT_NEWS_SYN_USE_CFEED', 'Syndication f&#252;r Kommentare verwenden?');
if(!defined('_EXT_NEWS_SYN_USE_CFEED_IMG'))    define('_EXT_NEWS_SYN_USE_CFEED_IMG', 'F&#252;r Kommentar Feed Link Standard Bild verwenden?');
if(!defined('_EXT_NEWS_SYN_CFEED_TEXT'))       define('_EXT_NEWS_SYN_CFEED_TEXT', 'Kommentar Feed Link Text');
if(!defined('_EXT_NEWS_SYN_CFEED_AMOUNT'))     define('_EXT_NEWS_SYN_CFEED_AMOUNT', 'Wieviele Kommentare im Kommentar Feed?');
if(!defined('_EXT_NEWS_SYN_CFEED_TYPE'))       define('_EXT_NEWS_SYN_CFEED_TYPE', 'Syndication Feed f&#252;r Kommentare');


// IMAGEGALLERY
if(!defined('_GALLERY_CONFIG'))                define('_GALLERY_CONFIG', 'Bildergalerie Konfiguration');
if(!defined('_GALLERY_ID'))                    define('_GALLERY_ID', 'ID');
if(!defined('_GALLERY_COMMENTS'))              define('_GALLERY_COMMENTS', 'Kommentare benutzen');
if(!defined('_GALLERY_FRONT_TITLE'))           define('_GALLERY_FRONT_TITLE', 'Galerie Titel');
if(!defined('_GALLERY_FRONT_SUBTITLE'))        define('_GALLERY_FRONT_SUBTITLE', 'Galerie Untertitel');
if(!defined('_GALLERY_CREATE'))                define('_GALLERY_CREATE', 'Erstelle ein neues Album');
if(!defined('_GALLERY_NEW'))                   define('_GALLERY_NEW', 'Neues Album');
if(!defined('_GALLERY_DESCRIPTION'))           define('_GALLERY_DESCRIPTION', 'Beschreibung');
if(!defined('_GALLERY_TITLE'))                 define('_GALLERY_TITLE', 'Galerie');
if(!defined('_GALLERY_THISIS'))                define('_GALLERY_THISIS', 'Dies ist das');
if(!defined('_GALLERY_THISIS2'))               define('_GALLERY_THISIS2', 'Album');
if(!defined('_GALLERY_THISIS3'))               define('_GALLERY_THISIS3', 'Laden Sie hier Bilder hoch, l&#246;schen Sie Ihre Bilder oder bearbeiten Sie die Beschreibung. Achtung: Bitte speichern Sie immer nur eine Bildbeschreibung gleichzeitig ab.');
if(!defined('_GALLERY_IMGTITLE'))              define('_GALLERY_IMGTITLE', 'Titel');
if(!defined('_GALLERY_IMGSIZE'))               define('_GALLERY_IMGSIZE', 'Gr&#246;&#223;e');
if(!defined('_GALLERY_IMGRESOLUTION'))         define('_GALLERY_IMGRESOLUTION', 'Aufl&#246;sung');
if(!defined('_GALLERY_AMOUNT'))                define('_GALLERY_AMOUNT', 'Anzahl');
if(!defined('_GALLERY_IMG_DETAILS'))           define('_GALLERY_IMG_DETAILS', 'Benutze Bilder Details');
if(!defined('_GALLERY_FTP_UPLOAD'))            define('_GALLERY_FTP_UPLOAD', 'Alle verf&#252;gbaren Alben');
if(!defined('_GALLERY_FTP_UPLOAD_TEXT'))       define('_GALLERY_FTP_UPLOAD_TEXT', 'Wenn Sie Ihr Bilderalbum mit einem FTP Client nach "data/images/albums/" hochgeladen haben, k&#246;nnen Sie es hier in ein toendaCMS Album konvertieren. Bitte w&#228;hlen Sie ein Album aus, das Sie in ein toendaCMS Album konvertieren wollen.');
if(!defined('_GALLERY_UPLOAD'))                define('_GALLERY_UPLOAD', 'Bilder hochladen');
if(!defined('_GALLERY_TEXT'))                  define('_GALLERY_TEXT', 'Wenn Sie ein gepacktes Album (.zip) haben, k&#246;nnen Sie es hochladen und danach konvertieren.');
if(!defined('_GALLERY_ZTITLE'))                define('_GALLERY_ZTITLE', 'Gepackte Datei hochladen und installieren');
if(!defined('_GALLERY_ZFILE'))                 define('_GALLERY_ZFILE', 'Gepackte Datei (.zip)');
if(!defined('_GALLERY_POSTED'))                define('_GALLERY_POSTED', 'Hochgeladen am');
if(!defined('_GALLERY_GRAVATAR'))              define('_GALLERY_GRAVATAR', 'Sie k&#246;nnen hier einige Bildergalerie Einstellungen vornehmen. Aber wenn Sie das Gravatar Icon oder die Smiley Icon Unterst&#252;tzung ein- / ausschalten m&#246;chten, k&#246;nnen Sie es in den <a href="admin.php?id_user='.$id_user.'&amp;site=mod_news&amp;todo=config">Neuigkeitenmanager Einstellungen</a> tun.');
if(!defined('_GALLERY_LAST_SHOW'))             define('_GALLERY_LAST_SHOW', 'Neue Bilder in der Seitenleiste anzeigen');
if(!defined('_GALLERY_LAST_SHOW_TITLE'))       define('_GALLERY_LAST_SHOW_TITLE', 'Neue Bilder Titel anzeigen');
if(!defined('_GALLERY_LAST_MAX_IMG'))          define('_GALLERY_LAST_MAX_IMG', 'Wieviele Bilder anzeigen');
if(!defined('_GALLERY_LAST_SIZE'))             define('_GALLERY_LAST_SIZE', 'Gr&#246;&#223;e der Bilder');
if(!defined('_GALLERY_LAST_TEXT'))             define('_GALLERY_LAST_TEXT', 'Text der neusten Bilder');
if(!defined('_GALLERY_LAST_ALIGN'))            define('_GALLERY_LAST_ALIGN', 'Ausrichtung der neusten Bilder');
if(!defined('_GALLERY_LIST_NORMAL'))           define('_GALLERY_LIST_NORMAL', 'Normale Auflistung (untereinander, mit Informationen)');
if(!defined('_GALLERY_LIST_3_THUMB'))          define('_GALLERY_LIST_3_THUMB', 'Thumbnail Bilder nebeneinander');
if(!defined('_GALLERY_MIMETYPE'))              define('_GALLERY_MIMETYPE', 'Mimetyp');


// PERSON
if(!defined('_PERSON_NAME'))                   define('_PERSON_NAME', 'Name');
if(!defined('_PERSON_USERNAME'))               define('_PERSON_USERNAME', 'Benutzername');
if(!defined('_PERSON_POSITION'))               define('_PERSON_POSITION', 'Position');
if(!defined('_PERSON_OCCUPATION'))             define('_PERSON_OCCUPATION', 'Beruf');
if(!defined('_PERSON_GROUP'))                  define('_PERSON_GROUP', 'Benutzergruppe');
if(!defined('_PERSON_JOINDATE'))               define('_PERSON_JOINDATE', 'Angemeldet am');
if(!defined('_PERSON_RIGHTS'))                 define('_PERSON_RIGHTS', 'Benutzerrechte');
if(!defined('_PERSON_EMAIL'))                  define('_PERSON_EMAIL', 'eMail Adresse');
if(!defined('_PERSON_PASSWORD'))               define('_PERSON_PASSWORD', 'Passwort');
if(!defined('_PERSON_AS_MD5'))                 define('_PERSON_AS_MD5', 'MD5 Zeichenkette');
if(!defined('_PERSON_VPASSWORD'))              define('_PERSON_VPASSWORD', 'Passwort wiederholen');
if(!defined('_PERSON_STREET'))                 define('_PERSON_STREET', 'Strasse');
if(!defined('_PERSON_STATE'))                  define('_PERSON_STATE', 'Bundesland');
if(!defined('_PERSON_TOWN'))                   define('_PERSON_TOWN', 'Stadt');
if(!defined('_PERSON_COUNTRY'))                define('_PERSON_COUNTRY', 'Land');
if(!defined('_PERSON_POSTAL'))                 define('_PERSON_POSTAL', 'Postleitzahl');
if(!defined('_PERSON_PHONE'))                  define('_PERSON_PHONE', 'Telefon');
if(!defined('_PERSON_FAX'))                    define('_PERSON_FAX', 'Telefax');
if(!defined('_PERSON_DETAILS'))                define('_PERSON_DETAILS', 'Ihre Details');
if(!defined('_PERSON_WWW'))                    define('_PERSON_WWW', 'Homepage');
if(!defined('_PERSON_ICQ'))                    define('_PERSON_ICQ', 'ICQ Nummer');
if(!defined('_PERSON_AIM'))                    define('_PERSON_AIM', 'AIM Name');
if(!defined('_PERSON_YIM'))                    define('_PERSON_YIM', 'YIM Messenger');
if(!defined('_PERSON_MSN'))                    define('_PERSON_MSN', 'MSN Messenger');
if(!defined('_PERSON_SKYPE'))                  define('_PERSON_SKYPE', 'Skype');
if(!defined('_PERSON_BIRTHDAY'))               define('_PERSON_BIRTHDAY', 'Geburtstag');
if(!defined('_PERSON_SEX'))                    define('_PERSON_SEX', 'Geschlecht');
if(!defined('_PERSON_SEX_MAN'))                define('_PERSON_SEX_MAN', 'm&#228;nnlich');
if(!defined('_PERSON_SEX_WOMAN'))              define('_PERSON_SEX_WOMAN', 'weiblich');
if(!defined('_PERSON_SEX_KA'))                 define('_PERSON_SEX_KA', 'Keine Angaben');
if(!defined('_PERSON_TCMS_ENABLED'))           define('_PERSON_TCMS_ENABLED', 'toendaScript aktiviert');
if(!defined('_PERSON_SIGNATURE'))              define('_PERSON_SIGNATURE', 'Signatur');
if(!defined('_PERSON_HOBBY'))                  define('_PERSON_HOBBY', 'Interessen');
if(!defined('_PERSON_LOCATION'))               define('_PERSON_LOCATION', 'Wohnort');
if(!defined('_PERSON_LASTLOGIN'))              define('_PERSON_LASTLOGIN', 'Letzter Besuch');


// SIDEBAR EXTENSION
if(!defined('_SIDEEXT_SIDEMENU'))              define('_SIDEEXT_SIDEMENU', 'Seitenmenu');
if(!defined('_SIDEEXT_SIDEMENU_TITLE'))        define('_SIDEEXT_SIDEMENU_TITLE', 'Seitenmenu Titel');
if(!defined('_SIDEEXT_SIDEMENU_SHOW'))         define('_SIDEEXT_SIDEMENU_SHOW', 'Seitenmenu Titel anzeigen');
if(!defined('_SIDEEXT_SIDEBAR'))               define('_SIDEEXT_SIDEBAR', 'Seitenleiste');
if(!defined('_SIDEEXT_SIDEBAR_SHOW_TITLE'))    define('_SIDEEXT_SIDEBAR_SHOW_TITLE', 'Seitenleisten Titel anzeigen');
if(!defined('_SIDEEXT_SIDEBAR_TITLE'))         define('_SIDEEXT_SIDEBAR_TITLE', 'Seitenleisten Titel');
if(!defined('_SIDEEXT_SIDEBAR_SHOW'))          define('_SIDEEXT_SIDEBAR_SHOW', 'Seitenleiste anzeigen');
if(!defined('_SIDEEXT_TC'))                    define('_SIDEEXT_TC', 'Vorlagenw&#228;hler');
if(!defined('_SIDEEXT_TC_SHOW_TITLE'))         define('_SIDEEXT_TC_SHOW_TITLE', 'Titel Vorlagenw&#228;hler anzeigen');
if(!defined('_SIDEEXT_TC_TITLE'))              define('_SIDEEXT_TC_TITLE', 'Vorlagenw&#228;hler Titel');
if(!defined('_SIDEEXT_TC_SHOW'))               define('_SIDEEXT_TC_SHOW', 'Vorlagenw&#228;hler anzeigen');
if(!defined('_SIDEEXT_SEARCH'))                define('_SIDEEXT_SEARCH', 'Suchfunktion');
if(!defined('_SIDEEXT_SEARCH_TITLE'))          define('_SIDEEXT_SEARCH_TITLE', 'Suche Titel');
if(!defined('_SIDEEXT_SEARCH_SHOW_TITLE'))     define('_SIDEEXT_SEARCH_SHOW_TITLE', 'Suche Titel zeigen');
if(!defined('_SIDEEXT_SEARCH_RESULT_TITLE'))   define('_SIDEEXT_SEARCH_RESULT_TITLE', 'Suchergebnis Titel');
if(!defined('_SIDEEXT_SEARCH_ALIGNMENT'))      define('_SIDEEXT_SEARCH_ALIGNMENT', 'Suchbox Ausrichtung');
if(!defined('_SIDEEXT_SEARCH_WITH_BR'))        define('_SIDEEXT_SEARCH_WITH_BR', 'Suchbutton darunter');
if(!defined('_SIDEEXT_SEARCH_WITH_BUTTON'))    define('_SIDEEXT_SEARCH_WITH_BUTTON', 'Suchbutton anzeigen');
if(!defined('_SIDEEXT_SEARCH_WORD'))           define('_SIDEEXT_SEARCH_WORD', 'Suchwort im Suchfeld');
if(!defined('_SIDEEXT_SEARCH_SHOW'))           define('_SIDEEXT_SEARCH_SHOW', 'Suche anzeigen');
if(!defined('_SIDEEXT_LOGIN'))                 define('_SIDEEXT_LOGIN', 'Login');
if(!defined('_SIDEEXT_LOGIN_TITLE'))           define('_SIDEEXT_LOGIN_TITLE', 'Login Titel');
if(!defined('_SIDEEXT_USERM_TITLE'))           define('_SIDEEXT_USERM_TITLE', 'Benutzermenu Titel');
if(!defined('_SIDEEXT_LOGIN_SHOW'))            define('_SIDEEXT_LOGIN_SHOW', 'Login anzeigen');
if(!defined('_SIDEEXT_LOGIN_USER'))            define('_SIDEEXT_LOGIN_USER', 'Login Feld Benutzername');
if(!defined('_SIDEEXT_LOGIN_PASS'))            define('_SIDEEXT_LOGIN_PASS', 'Login Feld Passwort');
if(!defined('_SIDEEXT_LOGIN_ACCOUNT'))         define('_SIDEEXT_LOGIN_ACCOUNT', 'Text f&#252;r Benutzer ohne Account');
if(!defined('_SIDEEXT_LOGIN_REG'))             define('_SIDEEXT_LOGIN_REG', 'Registrationslink');
if(!defined('_SIDEEXT_LOGIN_MENU'))            define('_SIDEEXT_LOGIN_MENU', 'Benutze Benutzermenu');
if(!defined('_SIDEEXT_LOGIN_ALLOW'))           define('_SIDEEXT_LOGIN_ALLOW', 'Erlaube Registrierung');
if(!defined('_SIDEEXT_LOGIN_SHOW_TITLE'))      define('_SIDEEXT_LOGIN_SHOW_TITLE', 'Login Titel zeigen');
if(!defined('_SIDEEXT_LOGIN_SHOW_MEMBERLIST')) define('_SIDEEXT_LOGIN_SHOW_MEMBERLIST', 'Mitgliederliste anzeigen');
if(!defined('_SIDEEXT_NEWS'))                  define('_SIDEEXT_NEWS', 'Neuigkeiten');
if(!defined('_SIDEEXT_NEWS_CATEGORIES_SHOW'))  define('_SIDEEXT_NEWS_CATEGORIES_SHOW', 'Neuigkeiten Kategorien anzeigen');
if(!defined('_SIDEEXT_NEWS_ARCHIVES_SHOW'))    define('_SIDEEXT_NEWS_ARCHIVES_SHOW', 'Neuigkeiten Archiv anzeigen');
if(!defined('_SIDEEXT_NEWS_CATEGORIES_AMOUNT_SHOW'))define('_SIDEEXT_NEWS_CATEGORIES_AMOUNT_SHOW', 'Anzahl Neuigkeiten in Kategorien anzeigen');
if(!defined('_SIDEEXT_MODUL'))                 define('_SIDEEXT_MODUL', 'Module');
if(!defined('_SIDEEXT_LANGUAGE_SELECTOR'))     define('_SIDEEXT_LANGUAGE_SELECTOR', 'Sprach W&#228;hler');


// NEWSLETTER
if(!defined('_NL_CONFIG'))                     define('_NL_CONFIG', 'Newsletter Konfiguration');
if(!defined('_NL_TITLE'))                      define('_NL_TITLE', 'Newsletter Titel');
if(!defined('_NL_SHOW_TITLE'))                 define('_NL_SHOW_TITLE', 'Newsletter Titel anzeigen');
if(!defined('_NL_TEXT'))                       define('_NL_TEXT', 'Newsletter Text');
if(!defined('_NL_SUBMIT'))                     define('_NL_SUBMIT', 'Newsletter Absenden-Knopf');
if(!defined('_NL_SHOW'))                       define('_NL_SHOW', 'Zeige Newsletter');
if(!defined('_NL_SEND'))                       define('_NL_SEND', 'Sende einen Newsletter');
if(!defined('_NL_SUBJECT'))                    define('_NL_SUBJECT', 'Betreff');
if(!defined('_NL_MESSAGE'))                    define('_NL_MESSAGE', 'Nachricht');
if(!defined('_NL_USER'))                       define('_NL_USER', 'Zeige alle Newsletter Benutzer');
if(!defined('_NL_NEWUSER'))                    define('_NL_NEWUSER', 'Erstelle einen neuen Newsletter Benutzer.');
if(!defined('_NL_EDITUSER'))                   define('_NL_EDITUSER', 'Bearbeite Newsletter Benutzer.');
if(!defined('_NL_USERNAME'))                   define('_NL_USERNAME', 'Ihr Name');
if(!defined('_NL_USEREMAIL'))                  define('_NL_USEREMAIL', 'Name@eMail.eintragen');
if(!defined('_NL_MAILMESSAGE'))                define('_NL_MAILMESSAGE', 'Wenn Sie in Zukunft keinen Newsletter mehr erhalten moechten, antworten Sie im Betreff mit ');
if(!defined('_NL_CHECKSTRING'))                define('_NL_CHECKSTRING', 'BITTE KEINEN NEWSLETTER');
if(!defined('_NL_CHECKFORUNSUBSCRIBE'))        define('_NL_CHECKFORUNSUBSCRIBE', 'eMails nach Abmelde-eMails abfragen');
if(!defined('_NL_CHECK'))                      define('_NL_CHECK', 'Abfragen');
if(!defined('_NL_MAILSCHECKED'))               define('_NL_MAILSCHECKED', 'eMails abgefragt ...');
if(!defined('_NL_CHECKTITLE'))                 define('_NL_CHECKTITLE', 'eMails abfragen nach eMail mit dem Abmeldecode');
if(!defined('_NL_CHECKTEXT'))                  define('_NL_CHECKTEXT', 'Wir fragen jetzt die eMails von Ihrem eMailaccount ab und testen sie nach dem Abmeldestring. Wenn eMails mit dem Code vorgefunden werden, testen wir ob dieser Newsletter-Benutzer existiert und l&#246;schen ihn dann.');
if(!defined('_NL_NEWSLETTER'))                 define('_NL_NEWSLETTER', 'Newsletter');


// USER
if(!defined('_USER_TITLE'))                    define('_USER_TITLE', 'Benutzer anzeigen');
if(!defined('_USER_TEXT'))                     define('_USER_TEXT', 'Hier sehen Sie alle verfuegbaren Benutzer. Einige von ihnen sind Administratoren.');
if(!defined('_USER_SELF'))                     define('_USER_SELF', 'Eigener Benutzername');
if(!defined('_USER_ALL'))                      define('_USER_ALL', 'Alle Benutzer');


// CONTACTS
if(!defined('_CONTACT_TITLE'))                 define('_CONTACT_TITLE', 'Kontakte anzeigen');
if(!defined('_CONTACT_TEXT'))                  define('_CONTACT_TEXT', 'Hier sehen Sie Ihre eingetragenen Kontaktadressen. Einige von ihnen sind auf der Kontaktseite einsehbar.');
if(!defined('_CONTACT_ADRESS_BOOK'))           define('_CONTACT_ADRESS_BOOK', 'Adressbuch');
if(!defined('_CONTACT_ADRESS_EMAIL'))          define('_CONTACT_ADRESS_EMAIL', 'Kontakt Mailadresse');
if(!defined('_CONTACT_SEND_A_EMAIL'))          define('_CONTACT_SEND_A_EMAIL', 'Eine eMail senden');
if(!defined('_CONTACT_DETAIL'))                define('_CONTACT_DETAIL', 'Kontakt Informationen');
if(!defined('_CONTACT_VCARD'))                 define('_CONTACT_VCARD', 'vCard');
if(!defined('_CONTACT_VCARD_IMPORT_TEXT'))     define('_CONTACT_VCARD_IMPORT_TEXT', 'Wenn sie eine .vcf Datei haben, laden sie diese hier hoch. toendaCMS wird den neuen Kontakt dann automatisch importieren.');
if(!defined('_CONTACT_VCARD_VCF'))             define('_CONTACT_VCARD_VCF', 'vCard .vcf Datei');
if(!defined('_CONTACT_VCARD_DOWNLOAD'))        define('_CONTACT_VCARD_DOWNLOAD', 'vCard herunterladen');


// GLOBALS
if(!defined('_GLOBAL'))                        define('_GLOBAL', 'Seite');
if(!defined('_GLOBAL_CONFIG'))                 define('_GLOBAL_CONFIG', 'Seiten Konfiguration');
if(!defined('_GLOBAL_TITLE'))                  define('_GLOBAL_TITLE', 'Webseiten Titel');
if(!defined('_GLOBAL_NAME'))                   define('_GLOBAL_NAME', 'Webseiten Name');
if(!defined('_GLOBAL_SUBTITLE'))               define('_GLOBAL_SUBTITLE', 'Webseiten Untertitel');
if(!defined('_GLOBAL_LOGO'))                   define('_GLOBAL_LOGO', 'Webseiten Logo (aus dem Mediamanager)');
if(!defined('_GLOBAL_OWNER'))                  define('_GLOBAL_OWNER', 'Webseiten Inhaber');
if(!defined('_GLOBAL_URL'))                    define('_GLOBAL_URL', 'Internetadresse (nur die Domain)');
if(!defined('_GLOBAL_TCMSLOGO'))               define('_GLOBAL_TCMSLOGO', 'toendaCMS Logo im Footer anzeigen');
if(!defined('_GLOBAL_TCMSLOGO_IN_SITETITLE'))  define('_GLOBAL_TCMSLOGO_IN_SITETITLE', 'toendaCMS Name im Seitentitel anzeigen');
if(!defined('_GLOBAL_PAGELOADINGTIME'))        define('_GLOBAL_PAGELOADINGTIME', 'Seitenladezeit im Footer anzeigen');
if(!defined('_GLOBAL_EMAIL'))                  define('_GLOBAL_EMAIL', 'Standard eMail');
if(!defined('_GLOBAL_YEAR'))                   define('_GLOBAL_YEAR', 'Copyright Jahr');
if(!defined('_GLOBAL_CHARSET'))                define('_GLOBAL_CHARSET', 'Zeichensatz');
if(!defined('_GLOBAL_LANG'))                   define('_GLOBAL_LANG', 'Administrations Backend Sprache');
if(!defined('_GLOBAL_FRONT_LANG'))             define('_GLOBAL_FRONT_LANG', 'Webseiten Sprache');
if(!defined('_GLOBAL_WYSIWYG'))                define('_GLOBAL_WYSIWYG', 'WYSIWYG-Editor benutzen');
if(!defined('_GLOBAL_SITE_NAVI'))              define('_GLOBAL_SITE_NAVI', 'Navigation');
if(!defined('_GLOBAL_SITE_NAVI_TOP'))          define('_GLOBAL_SITE_NAVI_TOP', 'Top Menu');
if(!defined('_GLOBAL_SITE_NAVI_SIDE'))         define('_GLOBAL_SITE_NAVI_SIDE', 'Seiten Menu');
if(!defined('_GLOBAL_META'))                   define('_GLOBAL_META', 'Metadaten f&#252;r den HTML Kopf');
if(!defined('_GLOBAL_METATAGS'))               define('_GLOBAL_METATAGS', 'Metadaten');
if(!defined('_GLOBAL_DESCRIPTION'))            define('_GLOBAL_DESCRIPTION', 'Beschreibung');
if(!defined('_GLOBAL_CURRENCY'))               define('_GLOBAL_CURRENCY', 'W&#228;hrung');
if(!defined('_GLOBAL_LEGAL_LINK_IN_FOOTER'))   define('_GLOBAL_LEGAL_LINK_IN_FOOTER', 'Impressum Link im Footer anzeigen');
if(!defined('_GLOBAL_ADMIN_LINK_IN_FOOTER'))   define('_GLOBAL_ADMIN_LINK_IN_FOOTER', 'Administrationslink im Footer anzeigen');
if(!defined('_GLOBAL_DEFAULT_FOOTER'))         define('_GLOBAL_DEFAULT_FOOTER', 'toendaCMS Standardseitenfu&#223; anzeigen');
if(!defined('_GLOBAL_ACTIVE_TOPMENU_LINKS'))   define('_GLOBAL_ACTIVE_TOPMENU_LINKS', 'CSS Klassen f&#252;r aktive Topmenulinks benutzen');
if(!defined('_GLOBAL_FOOTER_TEXT'))            define('_GLOBAL_FOOTER_TEXT', 'Eigener Text im Webseitenfu&szlig');
if(!defined('_GLOBAL_MAIL_SETTINGS'))          define('_GLOBAL_MAIL_SETTINGS', 'eMail');
if(!defined('_GLOBAL_MAIL_WITH_SMTP'))         define('_GLOBAL_MAIL_WITH_SMTP', 'eMails per SMTP versenden');
if(!defined('_GLOBAL_MAIL_AS_HTML'))           define('_GLOBAL_MAIL_AS_HTML', 'eMails als HTML versenden');
if(!defined('_GLOBAL_MAIL_SERVER'))            define('_GLOBAL_MAIL_SERVER', 'eMailserver POP3');
if(!defined('_GLOBAL_MAIL_SERVER_SMTP'))       define('_GLOBAL_MAIL_SERVER_SMTP', 'eMailserver SMTP');
if(!defined('_GLOBAL_MAIL_PORT'))              define('_GLOBAL_MAIL_PORT', 'eMailserver Port');
if(!defined('_GLOBAL_MAIL_POP3'))              define('_GLOBAL_MAIL_POP3', 'POP3');
if(!defined('_GLOBAL_MAIL_USER'))              define('_GLOBAL_MAIL_USER', 'eMail Benutzername');
if(!defined('_GLOBAL_MAIL_PASSWORD'))          define('_GLOBAL_MAIL_PASSWORD', 'eMail Passwort');
if(!defined('_GLOBAL_USE_STATISTICS'))         define('_GLOBAL_USE_STATISTICS', 'Statistiken benutzen');
if(!defined('_GLOBAL_USE_NEW_ADMINMENU'))      define('_GLOBAL_USE_NEW_ADMINMENU', 'Neues Administrationsmenu verwenden');
if(!defined('_GLOBAL_SEO'))                    define('_GLOBAL_SEO', 'SEO URL');
if(!defined('_GLOBAL_SEO_ENABLED'))            define('_GLOBAL_SEO_ENABLED', 'SEO aktivieren');
if(!defined('_GLOBAL_SEO_FOLDER'))             define('_GLOBAL_SEO_FOLDER', 'toendaCMS Verzeichnis auf dem Server');
if(!defined('_GLOBAL_SEO_FORMAT'))             define('_GLOBAL_SEO_FORMAT', 'SEO Format');
if(!defined('_GLOBAL_SEO_NEWS_TITLE'))         define('_GLOBAL_SEO_NEWS_TITLE', 'Auch Neuigeiten-URL zu Titel konvertieren');
if(!defined('_GLOBAL_SEO_CONTENT_TITLE'))      define('_GLOBAL_SEO_CONTENT_TITLE', 'Auch Dokument-URL zu Titel konvertieren');
if(!defined('_GLOBAL_SITE_OFFLINE'))           define('_GLOBAL_SITE_OFFLINE', 'Seite Offline schalten');
if(!defined('_GLOBAL_SITE_OFFLINE_TEXT'))      define('_GLOBAL_SITE_OFFLINE_TEXT', 'Offline Text');
if(!defined('_GLOBAL_PASTE_FOOTER_TEXT'))      define('_GLOBAL_PASTE_FOOTER_TEXT', 'Beispieltext einf&#252;gen');
if(!defined('_GLOBAL_SHOW_TOP_PAGES'))         define('_GLOBAL_SHOW_TOP_PAGES', 'Zeige die Seiten eines Dokuments an dessen Kopf an');
if(!defined('_GLOBAL_CIPHER_EMAIL'))           define('_GLOBAL_CIPHER_EMAIL', 'eMailadressen immer verschl&#252;sseln');
if(!defined('_GLOBAL_JS_BROWSER_DETECTION'))   define('_GLOBAL_JS_BROWSER_DETECTION', 'Browser des Benutzers mit JavaScript ermitteln');
if(!defined('_GLOBAL_USE_CS'))                 define('_GLOBAL_USE_CS', 'toendaCMS Komponenten System benutzen');
if(!defined('_GLOBAL_SECURITY'))               define('_GLOBAL_SECURITY', 'Sicherheit');
if(!defined('_GLOBAL_FOOTER'))                 define('_GLOBAL_FOOTER', 'Fu&#223;leiste');
if(!defined('_GLOBAL_SHOW_BOOKMARK_LINKS'))    define('_GLOBAL_SHOW_BOOKMARK_LINKS', 'Zeige Bookmark Links');
if(!defined('_GLOBAL_CAPTCHA'))                define('_GLOBAL_CAPTCHA', 'Captcha f&#252;r Kommentare benutzen');
if(!defined('_GLOBAL_CAPTCHA_CLEAN'))          define('_GLOBAL_CAPTCHA_CLEAN', 'Gr&#246;&#223;e des Captcha Zwischenspeichers bei dem er geleert werden soll');
if(!defined('_GLOBAL_SHOW_DOC_AUTOR'))         define('_GLOBAL_SHOW_DOC_AUTOR', 'Zeige den Autor eines Dokuments an');
if(!defined('_GLOBAL_PATHWAY_CHAR'))           define('_GLOBAL_PATHWAY_CHAR', 'Trennzeichen in der Pfadangabe');
if(!defined('_GLOBAL_ANTI_FRAME'))             define('_GLOBAL_ANTI_FRAME', 'Frame-Killer (toendaCMS kann nicht in einem Frame geladen werden)');
if(!defined('_GLOBAL_REVISIT_AFTER'))          define('_GLOBAL_REVISIT_AFTER', 'Tage bis die Suchmaschinen neu indizieren');
if(!defined('_GLOBAL_ROBOTSFILE'))             define('_GLOBAL_ROBOTSFILE', 'URL zur "robots.txt" Datei');
if(!defined('_GLOBAL_PDFLINK_IN_FOOTER'))      define('_GLOBAL_PDFLINK_IN_FOOTER', 'PDF Link im Footer anzeigen');
if(!defined('_GLOBAL_CACHE_CONTROL'))          define('_GLOBAL_CACHE_CONTROL', 'Suchmaschinen-Cache Einstellungen');
if(!defined('_GLOBAL_PRAGMA'))                 define('_GLOBAL_PRAGMA', 'Suchmaschinen Pragma');
if(!defined('_GLOBAL_EXPIRES'))                define('_GLOBAL_EXPIRES', 'Webseite kann ablaufen?');
if(!defined('_GLOBAL_ROBOTSSETTINGS'))         define('_GLOBAL_ROBOTSSETTINGS', 'Einstellungen f&#252;r den Webseiten Bot');
if(!defined('_GLOBAL_LAST_CHANGES'))           define('_GLOBAL_LAST_CHANGES', 'Letzte &#196;nderung an der Webseite');
if(!defined('_GLOBAL_USE_CONTENT_LANG'))       define('_GLOBAL_USE_CONTENT_LANG', 'Multible Sprachen verwenden');
if(!defined('_GLOBAL_VALIDLINKS'))             define('_GLOBAL_VALIDLINKS', 'Webstandards-Links anzeigen');
if(!defined('_GLOBAL_MM_VIEW_LIST'))           define('_GLOBAL_MM_VIEW_LIST', 'Listenansicht');
if(!defined('_GLOBAL_MM_VIEW_ICON'))           define('_GLOBAL_MM_VIEW_ICON', 'Symbolansicht');
if(!defined('_GLOBAL_MM_VIEW'))                define('_GLOBAL_MM_VIEW', 'Mediamanager Item Ansicht');


// POLL
if(!defined('_POLL_MAINTITLE'))                define('_POLL_MAINTITLE', 'Umfragemodul');
if(!defined('_POLL_ALL_TITLE'))                define('_POLL_ALL_TITLE', 'Alle Umfragen');
if(!defined('_POLL_TITLE'))                    define('_POLL_TITLE', 'Umfragemodul Titel');
if(!defined('_POLL_SHOW_TITLE'))               define('_POLL_SHOW_TITLE', 'Umfragetitel anzeigen');
if(!defined('_POLL_ALLPOLL_TITLES'))           define('_POLL_ALLPOLL_TITLES', 'Alle Umfragen Titel');
if(!defined('_POLL_SHOW'))                     define('_POLL_SHOW', 'Zeige Umfrage in Seitenleiste');
if(!defined('_POLL_TITLE_SIDEMENU'))           define('_POLL_TITLE_SIDEMENU', 'Seitenmenu');
if(!defined('_POLL_MENU_TITLE'))               define('_POLL_MENU_TITLE', 'Link Titel');
if(!defined('_POLL_MENU_SHOW'))                define('_POLL_MENU_SHOW', 'Zeige Link');
if(!defined('_POLL_MENU_POS'))                 define('_POLL_MENU_POS', 'An welcher Stelle');
if(!defined('_POLL_TITLE_TOPMENU'))            define('_POLL_TITLE_TOPMENU', 'Topmenu');
if(!defined('_POLL_VOTETEXT'))                 define('_POLL_VOTETEXT', 'Danke das Sie abgestimmt haben.');
if(!defined('_POLL_RESULTTEXT'))               define('_POLL_RESULTTEXT', 'Sie haben bereits an dieser Umfrage teilgenommen.');
if(!defined('_POLL_ALLPOLLS'))                 define('_POLL_ALLPOLLS', 'Alle Umfragen');
if(!defined('_POLL_RESULT'))                   define('_POLL_RESULT', 'Ergebnis');
if(!defined('_POLL_POLLS_INACTIVE'))           define('_POLL_POLLS_INACTIVE', 'Es sind zur Zeit keine Umfragen eingetragen.');
if(!defined('_POLL_SIDE_WIDTH'))               define('_POLL_SIDE_WIDTH', 'Breite der Umfrage in der Seitenbar');
if(!defined('_POLL_MAIN_WIDTH'))               define('_POLL_MAIN_WIDTH', 'Breite der Umfrage im Hauptbereich');
if(!defined('_POLL_ANSWERS'))                  define('_POLL_ANSWERS', 'Stimmen');


// PATHWAY
if(!defined('_PATH_HOME'))                     define('_PATH_HOME', 'Home');
if(!defined('_PATH_REGISTRATION'))             define('_PATH_REGISTRATION', 'Registrierung');
if(!defined('_PATH_PROFILE'))                  define('_PATH_PROFILE', 'Benutzer-Profil');
if(!defined('_PATH_POLLS'))                    define('_PATH_POLLS', 'Umfragen');
if(!defined('_PATH_LOSTPW'))                   define('_PATH_LOSTPW', 'Passwort vergessen');
if(!defined('_PATH_SEARCH'))                   define('_PATH_SEARCH', 'Suche');
if(!defined('_PATH_LINKS'))                    define('_PATH_LINKS', 'Links');
if(!defined('_PATH_LEGAL'))                    define('_PATH_LEGAL', 'Impressum');
if(!defined('_PATH_CONTACTFORM'))              define('_PATH_CONTACTFORM', 'Kontaktformular');


// LAYOUT
if(!defined('_LAYOUT_SELECT'))                 define('_LAYOUT_SELECT', 'W&#228;hle');
if(!defined('_LAYOUT_NO'))                     define('_LAYOUT_NO', 'Nr.');
if(!defined('_LAYOUT_PATH'))                   define('_LAYOUT_PATH', 'Pfad');
if(!defined('_LAYOUT_NAME'))                   define('_LAYOUT_NAME', 'Name');
if(!defined('_LAYOUT_AUTOR'))                  define('_LAYOUT_AUTOR', 'Autor');
if(!defined('_LAYOUT_URL'))                    define('_LAYOUT_URL', 'URL');
if(!defined('_LAYOUT_VERSION'))                define('_LAYOUT_VERSION', 'Version');
if(!defined('_LAYOUT_PREVIEW'))                define('_LAYOUT_PREVIEW', 'Vorschau');
if(!defined('_LAYOUT_CURRENT'))                define('_LAYOUT_CURRENT', 'Aktuelles Template');
if(!defined('_LAYOUT_COUNT'))                  define('_LAYOUT_COUNT', 'Installierte Templates');
if(!defined('_LAYOUT_FRONTEND'))               define('_LAYOUT_FRONTEND', 'Frontend Templates');
if(!defined('_LAYOUT_BACKEND'))                define('_LAYOUT_BACKEND', 'Administrator Templates');


// LAYOUT UPLOAD
if(!defined('_LU_TEXT'))                       define('_LU_TEXT', 'Wenn Sie eine .zip Datei haben, benutzen Sie den Installationsdialog f&#252;r gepackte Dateien. Ansonsten kopieren Sie das komplette Template (index.php, Bilder und CSS-Stylesheets) in den Theme Ordner. Wenn Sie keine Beschreibungsdatei haben, klicken Sie den NEU Button.');
if(!defined('_LU_DIR'))                        define('_LU_DIR', 'Name des Template Ordners');
if(!defined('_LU_FILE'))                       define('_LU_FILE', 'Datei');
if(!defined('_LU_ZTITLE'))                     define('_LU_ZTITLE', 'Gepackte Datei hochladen und installieren');
if(!defined('_LU_ZFILE'))                      define('_LU_ZFILE', 'Gepackte Datei (.zip)');
if(!defined('_LU_UPLOAD_TEMPLATE'))            define('_LU_UPLOAD_TEMPLATE', 'Template Dateien in ein Verzeichnis hochladen');
if(!defined('_LU_UPLOAD_IMAGE'))               define('_LU_UPLOAD_IMAGE', 'Template Bilder');
if(!defined('_LU_DESCRIPTION'))                define('_LU_DESCRIPTION', 'Eine Beschreibung MUSS vorhanden sein.<br />Wenn Sie keine haben, klicken sie auf NEU.');
if(!defined('_LU_THUMB'))                      define('_LU_THUMB', 'Screenshot mit Breite');
if(!defined('_LU_DES_TEXT'))                   define('_LU_DES_TEXT', 'Bitte alle Felder mit einem gef&#252;llten Punkt ausf&#252;llen.');
if(!defined('_LU_DES_DIR'))                    define('_LU_DES_DIR', 'Ordner Name, um die Datei zu speichern');
if(!defined('_LU_DES_NAME'))                   define('_LU_DES_NAME', 'Template Name');
if(!defined('_LU_DES_AUTOR'))                  define('_LU_DES_AUTOR', 'Name des Autors');
if(!defined('_LU_DES_URL'))                    define('_LU_DES_URL', 'Webseite des Autors');
if(!defined('_LU_DES_VERSION'))                define('_LU_DES_VERSION', 'Version des Templates');
if(!defined('_LU_TEMPLATE_FILE'))              define('_LU_TEMPLATE_FILE', 'Template Datei');
if(!defined('_LU_TEMPLATE_EDITOR'))            define('_LU_TEMPLATE_EDITOR', 'Template Editor');
if(!defined('_LU_TEMPLATE_CREATE'))            define('_LU_TEMPLATE_CREATE', 'Datei erstellen');


// CREDITS
if(!defined('_CREDITS_SYSTEM'))                define('_CREDITS_SYSTEM', 'System');
if(!defined('_CREDITS_RELEVANT'))              define('_CREDITS_RELEVANT', 'Relevant f&#252;r das Content Management System');
if(!defined('_CREDITS_VERSION'))               define('_CREDITS_VERSION', 'toendaCMS Version');
if(!defined('_CREDITS_PLATFORM'))              define('_CREDITS_PLATFORM', 'Plattform');
if(!defined('_CREDITS_PHP_VERSION'))           define('_CREDITS_PHP_VERSION', 'PHP Version');
if(!defined('_CREDITS_SERVER'))                define('_CREDITS_SERVER', 'Web Server');
if(!defined('_CREDITS_SERVER_FACE'))           define('_CREDITS_SERVER_FACE', 'PHP/Webserver Interface');
if(!defined('_CREDITS_RELEVANT_SET'))          define('_CREDITS_RELEVANT_SET', 'Wichtige PHP Einstellungen');
if(!defined('_CREDITS_SET_GLOBALS'))           define('_CREDITS_SET_GLOBALS', 'Register Globals');
if(!defined('_CREDITS_SET'))                   define('_CREDITS_SET', 'installiert');
if(!defined('_CREDITS_PHP_MODULES'))           define('_CREDITS_PHP_MODULES', 'PHP Module');


// ABOUT MODULE
if(!defined('_ABOUTMOD_TITLE'))                define('_ABOUTMOD_TITLE', 'Dies ist eine kurze Beschreibung der vorhandenen Module');
if(!defined('_ABOUTMOD_MODULE'))               define('_ABOUTMOD_MODULE', 'Modul');
if(!defined('_ABOUTMOD_DESCRIPTION'))          define('_ABOUTMOD_DESCRIPTION', 'Beschreibung');


// ABOUT
if(!defined('_ABOUT_TITLE'))                   define('_ABOUT_TITLE', 'toendaCMS - Your ideas ahead! - Open Source Content Management Framework');
if(!defined('_ABOUT_TEXT'))                    define('_ABOUT_TEXT', 'toendaCMS ist ein freies Open Source Content Management Framework basierend auf PHP4, PHP5, XML und verschiedenen Datenbank Servern.');
if(!defined('_ABOUT_TEXT2'))                   define('_ABOUT_TEXT2', 'Lesen Sie sich f&#252;r n&#228;here Informationen <a class="tcms_about" href="http://www.toendacms.org/">http://www.toendacms.org/</a> an. toendaCMS wird mit ABSOLUT KEINER GARANTIE ver&#246;ffentlicht. Dies ist freie Software und Sie haben die Freiheit es unter bestimmten Bedingungen zu verteilen. Diese Nachricht darf nicht entfernt werden, dies ist per Gesetz verboten.');
if(!defined('_ABOUT_EMAIL_INFO'))              define('_ABOUT_EMAIL_INFO', 'Information und Technischer Support');
if(!defined('_ABOUT_EMAIL_BUG'))               define('_ABOUT_EMAIL_BUG', 'Bugs melden');
if(!defined('_ABOUT_URL_DEVELOPMENT'))         define('_ABOUT_URL_DEVELOPMENT', 'toendaCMS Entwicklung');
if(!defined('_ABOUT_URL'))                     define('_ABOUT_URL', 'Die offizielle Demonstrationsseite');
if(!defined('_ABOUT_URL_DOWNLOAD'))            define('_ABOUT_URL_DOWNLOAD', 'Downloads und Patches');
if(!defined('_ABOUT_SVN_REPO'))                define('_ABOUT_SVN_REPO', 'SVN Repository');
if(!defined('_ABOUT_FREE_SOFTWARE'))           define('_ABOUT_FREE_SOFTWARE', 'ist Freie Software und wurde unter der GNU/GPL Lizenz ver&#246;ffentlicht.');
if(!defined('_ABOUT_CODE_IS_POESIE'))          define('_ABOUT_CODE_IS_POESIE', '<strong>Immer daran denken:</strong> Programmieren ist Poesie.');
if(!defined('_ABOUT_POWERED_BY'))              define('_ABOUT_POWERED_BY', 'Site is proudly powered by');


// CONTACT FORM
if(!defined('_FORM_NAME'))                     define('_FORM_NAME', 'Name');
if(!defined('_FORM_EMAIL'))                    define('_FORM_EMAIL', 'eMail');
if(!defined('_FORM_MESSAGE'))                  define('_FORM_MESSAGE', 'Nachricht');
if(!defined('_FORM_URL'))                      define('_FORM_URL', 'Webseite');
if(!defined('_FORM_SUBJECT'))                  define('_FORM_SUBJECT', 'Betreff');
if(!defined('_FORM_MSG'))                      define('_FORM_MSG', 'Nachricht');
if(!defined('_FORM_COPY'))                     define('_FORM_COPY', 'Mir bitte eine Kopie zusenden');
if(!defined('_FORM_SEND'))                     define('_FORM_SEND', 'Absenden');
if(!defined('_FORM_SUBMIT'))                   define('_FORM_SUBMIT', 'Eintragen');
if(!defined('_FORM_MSG_CONTENT'))              define('_FORM_MSG_CONTENT', 'Folgende Nachricht wurde ueber unser Kontaktformular versendet um');
if(!defined('_FORM_DEAR'))                     define('_FORM_DEAR', 'Sehr geehrte(r) Herr/Frau ');
if(!defined('_FORM_THANKYOU'))                 define('_FORM_THANKYOU', 'Wir danken fuer Ihren Besuch auf unserer Webseite!');
if(!defined('_FORM_FOLLOWMSG'))                define('_FORM_FOLLOWMSG', 'Folgende Nachricht wurde ueber unser Kontaktformular an uns versendet:');
if(!defined('_FORM_YOUR'))                     define('_FORM_YOUR', 'Ihr');
if(!defined('_FORM_CFORM'))                    define('_FORM_CFORM', 'Kontaktformular');
if(!defined('_FORM_SYSTEM'))                   define('_FORM_SYSTEM', 'Diese Nachricht wurde automatisch von unserem System generiert. Bitte antworten Sie nicht auf diese eMail.');
if(!defined('_FORM_GREETS'))                   define('_FORM_GREETS', 'Mit freundlichem Gruss ');
if(!defined('_FORM_FROM'))                     define('_FORM_FROM', 'Dies ist ein Newsletter von ');
if(!defined('_FORM_GO'))                       define('_FORM_GO', 'Anzeigen');


// GUESTBOOK
if(!defined('_BOOK_SEND'))                     define('_BOOK_SEND', 'Absenden');
if(!defined('_BOOK_ENTRYS'))                   define('_BOOK_ENTRYS', 'G&#228;stebuch Eintr&#228;ge');
if(!defined('_BOOK_ENTRY1'))                   define('_BOOK_ENTRY1', 'Eintr&#228;ge');
if(!defined('_BOOK_ENTRY2'))                   define('_BOOK_ENTRY2', 'Eintrag');
if(!defined('_BOOK_E_NO'))                     define('_BOOK_E_NO', 'Nr.');
if(!defined('_BOOK_E_NAME'))                   define('_BOOK_E_NAME', 'Name');
if(!defined('_BOOK_E_DATE'))                   define('_BOOK_E_DATE', 'Datum');
if(!defined('_BOOK_E_EMAIL'))                  define('_BOOK_E_EMAIL', 'eMail');
if(!defined('_BOOK_PAGE'))                     define('_BOOK_PAGE', 'Seite');
if(!defined('_BOOK_ADD'))                      define('_BOOK_ADD', 'Eintrag hinzuf&#252;gen');
if(!defined('_BOOK_FILTER_LINKS'))             define('_BOOK_FILTER_LINKS', 'Links (Internetlinks, eMailadressen)');
if(!defined('_BOOK_FILTER_SCRIPT'))            define('_BOOK_FILTER_SCRIPT', 'Scripte (Javascript, PHP)');
if(!defined('_BOOK_FILTER_MAIL'))              define('_BOOK_FILTER_MAIL', 'eMailadresse anzeigen');
if(!defined('_BOOK_FILTER_SPAM'))              define('_BOOK_FILTER_SPAM', '@-Zeichen in eMailadressen zu [at] konvertieren');
if(!defined('_BOOK_WIDTH_NAME'))               define('_BOOK_WIDTH_NAME', 'Breite des Namenfeldes (in Pixel)');
if(!defined('_BOOK_WIDTH_TEXT'))               define('_BOOK_WIDTH_TEXT', 'Breite des Textfeldes (in Pixel)');
if(!defined('_BOOK_COLOR_ROW_1'))              define('_BOOK_COLOR_ROW_1', 'Farbe der 1. Zeile');
if(!defined('_BOOK_COLOR_ROW_2'))              define('_BOOK_COLOR_ROW_2', 'Farbe der 2. Zeile');
if(!defined('_BOOK_TITLE'))                    define('_BOOK_TITLE', 'G&#228;stebuch Eintr&#228;ge');
if(!defined('_BOOK_TEXT'))                     define('_BOOK_TEXT', 'Hier k&#246;nnen Sie die Eintr&#228;ge in Ihrem G&#228;stebuch verwalten. Sie k&#246;nnen sie bearbeiten oder auch l&#246;schen.');


// DOWNLOADS
if(!defined('_DOWNLOADS_TITLE'))               define('_DOWNLOADS_TITLE', 'Downloads');
if(!defined('_DOWNLOADS_TEXT'))                define('_DOWNLOADS_TEXT', 'Kontrollieren und verwalten Sie ihre Downloads.');
if(!defined('_DOWNLOADS_NEW'))                 define('_DOWNLOADS_NEW', 'Erstelle einen neuen Download.');
if(!defined('_DOWNLOADS_EDIT'))                define('_DOWNLOADS_EDIT', 'Bearbeiten Sie Ihre Downloadeintraege in der Kategorie');
if(!defined('_DOWNLOADS_HELP'))                define('_DOWNLOADS_HELP', 'Wenn Sie kein eigenes Bild hochladen m&#246;chten, k&#246;nnen Sie das Feld einfach leer lassen. In diesem Fall wird f&#252;r den Dateityp ein Mimetyp Icon erstellt.');
if(!defined('_DOWNLOADS_NEW_CAT'))             define('_DOWNLOADS_NEW_CAT', 'Erstelle eine neue Download Kategorie. Damit koennen Sie Ihre Downloads ganz nach Belieben sortieren.');
if(!defined('_DOWNLOADS_SUBMIT_ON'))           define('_DOWNLOADS_SUBMIT_ON', 'Ver&#246;ffentlicht am');
if(!defined('_DOWNLOADS_SAVE_AS_MIMITYPE'))    define('_DOWNLOADS_SAVE_AS_MIMITYPE', 'Bild durch Mimetype Icon ersetzen');


// PRODUCTS
if(!defined('_PRODUCTS_TITLE'))                define('_PRODUCTS_TITLE', 'Produkte');
if(!defined('_PRODUCTS_ID'))                   define('_PRODUCTS_ID', 'Produktseiten ID');
if(!defined('_PRODUCTS_SITETITLE'))            define('_PRODUCTS_SITETITLE', 'Produktseiten Titel');
if(!defined('_PRODUCTS_SITESUBTITLE'))         define('_PRODUCTS_SITESUBTITLE', 'Produktseiten Untertitel');
if(!defined('_PRODUCTS_SITETEXT'))             define('_PRODUCTS_SITETEXT', 'Produktseiten Text');
if(!defined('_PRODUCTS_MAINCATEGORY'))         define('_PRODUCTS_MAINCATEGORY', 'Produkt Hauptkategorie');
if(!defined('_PRODUCTS_TEXT'))                 define('_PRODUCTS_TEXT', 'Kontrollieren und verwalten Sie Ihre Produkte.');
if(!defined('_PRODUCTS_NEW'))                  define('_PRODUCTS_NEW', 'Erstelle ein neues Produkt f&#252; die Kategorie');
if(!defined('_PRODUCTS_EDIT'))                 define('_PRODUCTS_EDIT', 'Bearbeiten Sie Ihre Produkteintraege in der Kategorie');
if(!defined('_PRODUCTS_HELP'))                 define('_PRODUCTS_HELP', 'Wenn Sie das Feld zum Thumbnail (Preview) hochladen leer lassen, wird f&#252;r dieses Produkt ein Platzhalter erstellt.');
if(!defined('_PRODUCTS_NEW_CAT'))              define('_PRODUCTS_NEW_CAT', 'Erstellen Sie eine neue Produkt-Kategorie. Damit koennen Sie Ihre Produkte ganz nach Belieben sortieren.');
if(!defined('_PRODUCTS_SUBMIT_ON'))            define('_PRODUCTS_SUBMIT_ON', 'Ver&#246;ffentlicht am');
if(!defined('_PRODUCTS_INC_TAX'))              define('_PRODUCTS_INC_TAX', 'inkl. Mwst.');
if(!defined('_PRODUCTS_EX_TAX'))               define('_PRODUCTS_EX_TAX', 'exkl. Mwst.');
if(!defined('_PRODUCTS_CATEGORY_TITLE'))       define('_PRODUCTS_CATEGORY_TITLE', 'Kategorien Titel in der Seitenleiste');
if(!defined('_PRODUCTS_USE_CATEGORY_TITLE'))   define('_PRODUCTS_USE_CATEGORY_TITLE', 'Kategorien Titel in der Seitenleiste anzeigen');
if(!defined('_PRODUCTS_SHOW_PRICE_ONLY_USERS'))define('_PRODUCTS_SHOW_PRICE_ONLY_USERS', 'Zeige Preise nur angemeldeten Benutzern');
if(!defined('_PRODUCTS_STARTPAGETITLE'))       define('_PRODUCTS_STARTPAGETITLE', 'Startseiten Titel');
if(!defined('_PRODUCTS_ARTICLE'))              define('_PRODUCTS_ARTICLE', 'Artikel');
if(!defined('_PRODUCTS_CATEGORY'))             define('_PRODUCTS_CATEGORY', 'Kategorie');
if(!defined('_PRODUCTS_CATEGORIES'))           define('_PRODUCTS_CATEGORIES', 'Kategorien');
if(!defined('_PRODUCTS_CATALOGUE'))            define('_PRODUCTS_CATALOGUE', 'Katalog');
if(!defined('_PRODUCTS_USESIDEBARCATEGORIES')) define('_PRODUCTS_USESIDEBARCATEGORIES', 'Kategorien in der Seitenleiste anzeigen');
if(!defined('_PRODUCTS_LATEST'))               define('_PRODUCTS_LATEST', 'Neuste Artikel');
if(!defined('_PRODUCTS_AMOUNT_OF_LATEST'))     define('_PRODUCTS_AMOUNT_OF_LATEST', 'Anzahl an neusten Artikeln im Frontend');
if(!defined('_PRODUCTS_ADD_TO_CART'))          define('_PRODUCTS_ADD_TO_CART', 'In den Einkaufswagen');


// NEWS
if(!defined('_NEWS_WRITTEN'))                  define('_NEWS_WRITTEN', 'Geschrieben von');
if(!defined('_NEWS_CATEGORIE_IN'))             define('_NEWS_CATEGORIE_IN', 'Kategorisiert');
if(!defined('_NEWS_TITLE'))                    define('_NEWS_TITLE', 'Zeige alle Neuigkeiten');
if(!defined('_NEWS_TEXT'))                     define('_NEWS_TEXT', 'Hier sind Ihre Neuigkeiten aufgelistet. Sie k&#246;nnen diese bearbeiten oder auch neue erstellen.');
if(!defined('_NEWS_EDIT_CURRENT'))             define('_NEWS_EDIT_CURRENT', 'Bearbeite diese Neuigkeit.');
if(!defined('_NEWS_NEW_CURRENT'))              define('_NEWS_NEW_CURRENT', 'Erstelle eine neue Neuigkeit.');
if(!defined('_NEWS_ID'))                       define('_NEWS_ID', 'News ID');
if(!defined('_NEWS_DATE'))                     define('_NEWS_DATE', 'Datum');
if(!defined('_NEWS_TIME'))                     define('_NEWS_TIME', 'Uhrzeit');
if(!defined('_NEWS_SAMPLE'))                   define('_NEWS_SAMPLE', 'Bsp.');
if(!defined('_NEWS_MAINTEXT'))                 define('_NEWS_MAINTEXT', 'Neuigkeit');
if(!defined('_NEWS_IMAGE_HELP'))               define('_NEWS_IMAGE_HELP', 'Um Bilder in Neuigkeiten einzuf&#252;gen, markieren Sie die gew&#252;nschte Stelle in der Nachricht und klicken Sie auf den <em>Button Bilder suchen</em> und dann, nachdem Sie das Bild gefunden haben, auf <em>&#220;bernehmen</em>.');
if(!defined('_NEWS_TCMS_HELP'))                define('_NEWS_TCMS_HELP', 'Kopieren Sie diese Markierung an die Stellen im Text, an der sie erscheinen sollen.');
if(!defined('_NEWS_IMAGES'))                   define('_NEWS_IMAGES', 'Neuigkeiten Bild');
if(!defined('_NEWS_IMAGE'))                    define('_NEWS_IMAGE', 'Bild');
if(!defined('_NEWS_DIR'))                      define('_NEWS_DIR', 'Ordner');
if(!defined('_NEWS_ARCHIVE'))                  define('_NEWS_ARCHIVE', 'Archiv');
if(!defined('_NEWS_ALL'))                      define('_NEWS_ALL', 'Alle');
if(!defined('_NEWS_LAST'))                     define('_NEWS_LAST', 'Letzten');
if(!defined('_NEWS_ORDER_BY_TIME'))            define('_NEWS_ORDER_BY_TIME', 'Chronologisch sortiert');
if(!defined('_NEWS_ORDER_BY_CAT'))             define('_NEWS_ORDER_BY_CAT', 'Kategorisch sortiert');
if(!defined('_NEWS_CATEGORIES_TITLE'))         define('_NEWS_CATEGORIES_TITLE', 'News Kategorien');
if(!defined('_NEWS_ARCHIVES_TITLE'))           define('_NEWS_ARCHIVES_TITLE', 'Neuigkeiten Archiv');
if(!defined('_NEWS_CATEGORIES_TEXT'))          define('_NEWS_CATEGORIES_TEXT', 'Hier k&#246;nnen Sie ihre Neuigkeiten Kategorien erstellen und bearbeiten.');
if(!defined('_NEWS_IN'))                       define('_NEWS_IN', 'in');
if(!defined('_NEWS_CATEGORY_ARCHIV'))          define('_NEWS_CATEGORY_ARCHIV', 'Archiv f&#252;r die Kategorie');
if(!defined('_NEWS_ARCHIV_FOR'))               define('_NEWS_ARCHIV_FOR', 'Archiv f&#252;r');
if(!defined('_NEWS_SYNDICATION'))              define('_NEWS_SYNDICATION', 'Syndication');
if(!defined('_NEWS_TRACKBACK'))                define('_NEWS_TRACKBACK', 'Trackback');
if(!defined('_NEWS_SHOW_ON_FRONTPAGE'))        define('_NEWS_SHOW_ON_FRONTPAGE', 'News auf der Startseite anzeigen');


// FRONTAPAGE
if(!defined('_FRONTPAGE_CONFIG'))              define('_FRONTPAGE_CONFIG', 'Startseiten Konfiguration');
if(!defined('_FRONTPAGE_USE'))                 define('_FRONTPAGE_USE', 'Benutze Startseite');
if(!defined('_FRONTPAGE_ID'))                  define('_FRONTPAGE_ID', 'ID (wenn Sie die Startseite benutzen, ist ID 0)');
if(!defined('_FRONTPAGE_TITLE'))               define('_FRONTPAGE_TITLE', 'Startseiten Titel');
if(!defined('_FRONTPAGE_SUBTITLE'))            define('_FRONTPAGE_SUBTITLE', 'Startseiten Untertitel');
if(!defined('_FRONTPAGE_TEXT'))                define('_FRONTPAGE_TEXT', 'Startseiten Text');
if(!defined('_FRONTPAGE_NEWS'))                define('_FRONTPAGE_NEWS', 'Neuigkeiten');
if(!defined('_FRONTPAGE_NEWS_TITLE'))          define('_FRONTPAGE_NEWS_TITLE', 'Neuigkeiten Titel');
if(!defined('_FRONTPAGE_NEWS_MUCH'))           define('_FRONTPAGE_NEWS_MUCH', 'Wie viele Neuigkeiten sollen auf der Startseite angezeigt werden?');
if(!defined('_FRONTPAGE_NEWS_CHARS'))          define('_FRONTPAGE_NEWS_CHARS', 'Wie viele Zeichen sollen von den Neuigkeiten vorab angezeigt werden?');
if(!defined('_FRONT_MORE'))                    define('_FRONT_MORE', 'Weiterlesen');
if(!defined('_FRONT_COMMENT'))                 define('_FRONT_COMMENT', 'Kommentar');
if(!defined('_FRONT_COMMENTS'))                define('_FRONT_COMMENTS', 'Kommentare');
if(!defined('_FRONT_NOCOMMENT'))               define('_FRONT_NOCOMMENT', 'Keine Kommentare eingetragen.');
if(!defined('_FRONT_COMMENT_TITLE'))           define('_FRONT_COMMENT_TITLE', 'Schreiben Sie einen neuen Kommentar');
if(!defined('_FRONT_COMMENT_NAME'))            define('_FRONT_COMMENT_NAME', 'Name');
if(!defined('_FRONT_COMMENT_EMAIL'))           define('_FRONT_COMMENT_EMAIL', 'eMail');
if(!defined('_FRONT_COMMENT_WEB'))             define('_FRONT_COMMENT_WEB', 'Webseite');
if(!defined('_FRONT_COMMENT_TEXT'))            define('_FRONT_COMMENT_TEXT', 'Nachricht');
if(!defined('_FRONT_COMMENT_POST'))            define('_FRONT_COMMENT_POST', 'Geschrieben von');
if(!defined('_FRONT_OWN_TRACKBACK'))           define('_FRONT_OWN_TRACKBACK', 'Eigene Trackback URL');
if(!defined('_FRONT_TRACKBACK_URL'))           define('_FRONT_TRACKBACK_URL', 'Trackback Ziel URL');
if(!defined('_FRONTPAGE_SIDEBAR_NEWS'))        define('_FRONTPAGE_SIDEBAR_NEWS', 'Neuigkeiten in der Seitenleiste');
if(!defined('_FRONTPAGE_SIDEBAR_NEWS_USE'))    define('_FRONTPAGE_SIDEBAR_NEWS_USE', 'Zeige Neuigkeiten in der Seitenleiste');
if(!defined('_FRONTPAGE_SIDEBAR_NEWS_TITLE'))  define('_FRONTPAGE_SIDEBAR_NEWS_TITLE', 'Titel der Neuigkeiten in der Seitenleiste');
if(!defined('_FRONTPAGE_SIDEBAR_NEWS_MUCH'))   define('_FRONTPAGE_SIDEBAR_NEWS_MUCH', 'Wie viele Neuigkeiten sollen in der Seitenleiste angezeigt werden?');
if(!defined('_FRONTPAGE_NEWS_DISPLAY'))        define('_FRONTPAGE_NEWS_DISPLAY', 'Wie sollen die Neuigkeiten in der Seitenleiste dargestellt werden?');
if(!defined('_FRONTPAGE_TDT'))                 define('_FRONTPAGE_TDT', 'Titel, Datum und Uhrzeit, Text');
if(!defined('_FRONTPAGE_TD'))                  define('_FRONTPAGE_TD', 'Titel, Datum und Uhrzeit');
if(!defined('_FRONTPAGE_T'))                   define('_FRONTPAGE_T', 'Titel');
if(!defined('_FRONTPAGE_DT'))                  define('_FRONTPAGE_DT', 'Datum und Uhrzeit, Titel');
if(!defined('_FRONT_CAPTCHA'))                 define('_FRONT_CAPTCHA', 'Bitte geben sie folgenden Code ein');


// DOCUMENTATION
if(!defined('_DOCU_TITLE'))                    define('_DOCU_TITLE', 'Dokumentation');
if(!defined('_DOCU_TEXT'))                     define('_DOCU_TEXT', 'Wollen auch Sie Ihren Beitrag f&#252;er diese freie Software leisten? Schreiben Sie eine Dokumentation um auch anderen Benutzern den Einstieg zu erleichtern.');


// SEARCH
if(!defined('_SEARCH_TITLE'))                  define('_SEARCH_TITLE', 'Suche');
if(!defined('_SEARCH_SUBMIT'))                 define('_SEARCH_SUBMIT', 'Suchen');
if(!defined('_SEARCH_BOX'))                    define('_SEARCH_BOX', 'Suchwort');
if(!defined('_SEARCH_TEXT_FOUND'))             define('_SEARCH_TEXT_FOUND', 'Suchergebnis:');
if(!defined('_SEARCH_EMPTY'))                  define('_SEARCH_EMPTY', 'Sie k&#246;nnen nicht nach &quot;nichts&quot; suchen. Bitte geben Sie Ihren Suchbegriff ein.');
if(!defined('_SEARCH_START'))                  define('_SEARCH_START', 'Bitte geben Sie Ihren Suchbegriff ein.');
if(!defined('_SEARCH_NOTFOUND_1'))             define('_SEARCH_NOTFOUND_1', 'Es konnte kein passender Eintrag zu Ihrem Suchwort');
if(!defined('_SEARCH_NOTFOUND_2'))             define('_SEARCH_NOTFOUND_2', 'gefunden werden.');
if(!defined('_SEARCH_WITH_GOOGLE'))            define('_SEARCH_WITH_GOOGLE', 'Internetsuche mit');
if(!defined('_SEARCH_WEBSEARCH'))              define('_SEARCH_WEBSEARCH', 'Internetsuche');


// FILESYSTEMS
if(!defined('_FOLDER_DEFAULT'))                define('_FOLDER_DEFAULT', 'Standard');
if(!defined('_FOLDER_HTML'))                   define('_FOLDER_HTML', 'HTML');
if(!defined('_FOLDER_IMAGES'))                 define('_FOLDER_IMAGES', 'Bilder');
if(!defined('_FOLDER_LOCKED'))                 define('_FOLDER_LOCKED', 'Geschlossen');
if(!defined('_FOLDER_PACK'))                   define('_FOLDER_PACK', 'Software/Pakete');
if(!defined('_FOLDER_PRINT'))                  define('_FOLDER_PRINT', 'Druck');
if(!defined('_FOLDER_SOUND'))                  define('_FOLDER_SOUND', 'Musik');
if(!defined('_FOLDER_DOCU'))                   define('_FOLDER_DOCU', 'Dokumente');
if(!defined('_FOLDER_VID'))                    define('_FOLDER_VID', 'Video');


// FILESYSTEMS
if(!defined('_DB_CHOOSE'))                     define('_DB_CHOOSE', 'Datenbanktreiber f&#252;r toendaCMS');
if(!defined('_DB_USER'))                       define('_DB_USER', 'SQL Server Benutzername');
if(!defined('_DB_PASSWORD'))                   define('_DB_PASSWORD', 'SQL Server Passwort');
if(!defined('_DB_HOST'))                       define('_DB_HOST', 'SQL Server Host');
if(!defined('_DB_DATABASE'))                   define('_DB_DATABASE', 'SQL Server Datenbank');
if(!defined('_DB_PORT'))                       define('_DB_PORT', 'SQL Server Port (Wichtig f&#252;r den PostgreSQL Server)');
if(!defined('_DB_PREFIX'))                     define('_DB_PREFIX', 'SQL Server Datenbank Prefix');
if(!defined('_DB_XML'))                        define('_DB_XML', 'XML Datenbank');
if(!defined('_DB_MYSQL'))                      define('_DB_MYSQL', 'MySQL Datenbank');
if(!defined('_DB_PGSQL'))                      define('_DB_PGSQL', 'PostgreSQL Datenbank');
if(!defined('_DB_MSSQL'))                      define('_DB_MSSQL', 'Microsoft SQL Server Datenbank');
if(!defined('_DB_BACKUP'))                     define('_DB_BACKUP', 'Datenbank sichern');
if(!defined('_DB_OPTIMIZATION'))               define('_DB_OPTIMIZATION', 'Datenbank optimieren');
if(!defined('_DB_RESTORE'))                    define('_DB_RESTORE', 'Datenbank wiederherstellen');
if(!defined('_DB_START_BACKUP'))               define('_DB_START_BACKUP', 'Jetzt sichern');
if(!defined('_DB_START_OPTIMIZATION'))         define('_DB_START_OPTIMIZATION', 'Jetzt optimieren');
if(!defined('_DB_START_RESTORE'))              define('_DB_START_RESTORE', 'Jetzt wiederherstellen');
if(!defined('_DB_CONFIG'))                     define('_DB_CONFIG', 'Datenbank Konfiguration');
if(!defined('_DB_BACKUP_RESTORE'))             define('_DB_BACKUP_RESTORE', 'Datenbank Sicherung &amp; Wiederherstellung');
if(!defined('_DB_BACKUP_OPTIMIZATION'))        define('_DB_BACKUP_OPTIMIZATION', 'Database Optimierung');
if(!defined('_DB_DB'))                         define('_DB_DB', 'Datenbank');
if(!defined('_DB_BACKUP_AS_FILE'))             define('_DB_BACKUP_AS_FILE', 'Backup als Datei speichern?');
if(!defined('_DB_BACKUP_AS_STRUCTURE'))        define('_DB_BACKUP_AS_STRUCTURE', 'Nur die Datenbankstruktur?');
if(!defined('_DB_CLEAN_UP'))                   define('_DB_CLEAN_UP', 'Datenbank aufr&#228;umen');
if(!defined('_DB_START_CLEAN_UP'))             define('_DB_START_CLEAN_UP', 'Jetzt aufr&#228;umen');



// LINKS
if(!defined('_LINK_MODULE'))                   define('_LINK_MODULE', 'Link Manager Einstellungen');
if(!defined('_LINK_MODULE_TITLE'))             define('_LINK_MODULE_TITLE', 'Link Manager');
if(!defined('_LINK_MODULE_DESC'))              define('_LINK_MODULE_DESC', 'Hier k&#246;nnen Sie Links und Linkkategorien erstellen. Bitte beachten Sie, dass jeder Link zu einer bestimmten Kategorie geh&#246;ren muss.');
if(!defined('_LINK_USE_SIDELINKS'))            define('_LINK_USE_SIDELINKS', 'Links in der Seitenleiste anzeigen');
if(!defined('_LINK_USE_SIDELINKS_DESC'))       define('_LINK_USE_SIDELINKS_DESC', 'Beschreibung f&#252;r die Links in der Seitenleiste anzeigen');
if(!defined('_LINK_USE_SIDELINKS_TITLE'))      define('_LINK_USE_SIDELINKS_TITLE', 'Titel f&#252;r die Links in der Seitenleiste anzeigen');
if(!defined('_LINK_SIDELINKS_TITLE'))          define('_LINK_SIDELINKS_TITLE', 'Titel f&#252;r die Links in der Seitenleiste');
if(!defined('_LINK_MAINLINKS_TITLE'))          define('_LINK_MAINLINKS_TITLE', 'Titel f&#252;r die Hauptseite');
if(!defined('_LINK_MAINLINKS_SUBTITLE'))       define('_LINK_MAINLINKS_SUBTITLE', 'Untertitel f&#252;r die Hauptseite');
if(!defined('_LINK_MAINLINKS_TEXT'))           define('_LINK_MAINLINKS_TEXT', 'Text f&#252;r die Hauptseite');
if(!defined('_LINK_USE_MAINLINKS_DESC'))       define('_LINK_USE_MAINLINKS_DESC', 'Beschreibung f&#252;r die Links in der Hauptseite anzeigen');
if(!defined('_LINK_WICH_MODULE'))              define('_LINK_WICH_MODULE', 'Zeige Link in diesem Modul');


// COMMENTS
if(!defined('_COMMENTS_TITLE'))                define('_COMMENTS_TITLE', 'Kommentare verwalten');
if(!defined('_COMMENTS_TEXT'))                 define('_COMMENTS_TEXT', 'Hier k&#246;nnen Sie die Kommentare zu ihren Neuigkeiten und Bildern verwalten. Sie k&#246;nnen sie bei Bedarf bearbeiten oder auch l&#246;schen. Zudem werden hier die eMail-Adressen, IP-Adressen und die jeweiligen Herkunftsdomains der Kommentierenden aufgelistet.');


// STATS
if(!defined('_STATS_HOST'))                    define('_STATS_HOST', 'Host');
if(!defined('_STATS_REF'))                     define('_STATS_REF', 'Referrer');
if(!defined('_STATS_PAGE'))                    define('_STATS_PAGE', 'Seite');
if(!defined('_STATS_COUNT'))                   define('_STATS_COUNT', 'Anzahl');
if(!defined('_STATS_SUM_CLICKS'))              define('_STATS_SUM_CLICKS', 'Gesamtanzahl Hits');
if(!defined('_STATS_SUM_UNIQUE'))              define('_STATS_SUM_UNIQUE', 'Gesamtanzahl echte Hits');
if(!defined('_STATS_SUM_IP'))                  define('_STATS_SUM_IP', 'Gesamtanzahl verschiedener IP Adressen');
if(!defined('_STATS_BROWSER_OS'))              define('_STATS_BROWSER_OS', 'Browser, Betriebssysteme');
if(!defined('_STATS_HITS'))                    define('_STATS_HITS', 'Hits, Klicks,  Referrers');
if(!defined('_STATS_BROWSER'))                 define('_STATS_BROWSER', 'Browser');
if(!defined('_STATS_OS'))                      define('_STATS_OS', 'Betriebssystem');
if(!defined('_STATS_RESET'))                   define('_STATS_RESET', 'Zur&#252;cksetzen');
if(!defined('_STATS_RESET_TEXT'))              define('_STATS_RESET_TEXT', 'Hier k&#246;nnen sie ihre Statistiken zur&#252;cksetzen. <strong>WARNUNG!</strong> Nach dem Reset k&#246;nnen Sie die Statistiken nicht wiederherstellen.');
if(!defined('_STATS_RESET_SUCCESS'))           define('_STATS_RESET_SUCCESS', 'Ihre Statistiken wurden erfolgreich zurueckgesetzt.');
if(!defined('_STATS_RESET_FAILED'))            define('_STATS_RESET_FAILED', 'Ihre Statistiken konnten nicht zurueckgesetzt werden.');
if(!defined('_STATS_DATA_DIR_SIZE'))           define('_STATS_DATA_DIR_SIZE', 'Datenverzeichnis-Gr&#246;&#223;e');


// FAQ's
if(!defined('_FAQ_TITLE'))                     define('_FAQ_TITLE', 'Alle FAQ\'s und Artikel anzeigen');
if(!defined('_FAQ_TEXT'))                      define('_FAQ_TEXT', 'Hier sind Ihre FAQ\'s und Artikel aufgelistet. Sie k&#246;nnen sie hier bearbeiten und/oder neue Eintr&#228;ge und Kategorien erstellen.');
if(!defined('_FAQ_BASE_CATEGORY'))             define('_FAQ_BASE_CATEGORY', 'Grundkategorie');
if(!defined('_FAQ_CFG_TITLE'))                 define('_FAQ_CFG_TITLE', 'Konfigurieren Sie die Wissensdatenbank');


// IMPORT
if(!defined('_IMPORT_BLOGGER_FTP'))            define('_IMPORT_BLOGGER_FTP', 'Blogger FTP');
if(!defined('_IMPORT_BLOGGER_FTP_DESC'))       define('_IMPORT_BLOGGER_FTP_DESC', 'Importiert Neuigkeiten und Kommentare von einem Blogger Account der auf einem eigenem FTP Server liegt (Anleitung siehe Wiki).');
if(!defined('_IMPORT_OOO2_DOCBOOK_XML'))       define('_IMPORT_OOO2_DOCBOOK_XML', 'OpenDocument');
if(!defined('_IMPORT_OOO2_DOCBOOK_XML_DESC'))  define('_IMPORT_OOO2_DOCBOOK_XML_DESC', 'Importiert Dokumente mit dem OpenDocument Dateiformat.');


// COMPONENTS UPLOAD
if(!defined('_CS_UPLOAD_TEXT'))                define('_CS_UPLOAD_TEXT', 'Wenn Sie eine .zip Datei haben, benutzen Sie den Installationsdialog f&#252;r gepackte Dateien. Ansonsten kopieren Sie die komplette Komponente (Ordner mit allen ben&#246;tigten Dateien) in den Komponenten Ordner (data/components).');
if(!defined('_CS_UPLOAD_ZTITLE'))              define('_CS_UPLOAD_ZTITLE', 'Gepackte Datei hochladen und installieren');
if(!defined('_CS_UPLOAD_ZFILE'))               define('_CS_UPLOAD_ZFILE', 'Gepackte Datei (.zip)');


// LANGUAGE LIST
if(!defined('_LANG_GERMAN'))                   define('_LANG_GERMAN', 'Deutsch');
if(!defined('_LANG_ENGLISH'))                  define('_LANG_ENGLISH', 'Englisch');
if(!defined('_LANG_BULGARIAN'))                define('_LANG_BULGARIAN', 'Bulgarisch');
if(!defined('_LANG_DUTCH'))                    define('_LANG_DUTCH', 'Niederl&#228;ndisch');
if(!defined('_LANG_FINNISH'))                  define('_LANG_FINNISH', 'Finisch');
if(!defined('_LANG_ITALY'))                    define('_LANG_ITALY', 'Italienisch');
if(!defined('_LANG_KOREAN'))                   define('_LANG_KOREAN', 'Koreanisch');
if(!defined('_LANG_NORWEGIAN'))                define('_LANG_NORWEGIAN', 'Norwegisch');
if(!defined('_LANG_PORTUGUES'))                define('_LANG_PORTUGUES', 'Portugisisch');
if(!defined('_LANG_ROMANIAN'))                 define('_LANG_ROMANIAN', 'Rum&#228;nisch');
if(!defined('_LANG_SLOVAK'))                   define('_LANG_SLOVAK', 'Slovenisch');
if(!defined('_LANG_SPANISH'))                  define('_LANG_SPANISH', 'Spanisch');
if(!defined('_LANG_SWEDISH'))                  define('_LANG_SWEDISH', 'Swedisch');


// FOOTER
if(!defined('_FOOTER_VALID_TITLE'))            define('_FOOTER_VALID_TITLE', 'Diese Website erf&#252;llt folgende Standards');
if(!defined('_FOOTER_VALID_US_805'))           define('_FOOTER_VALID_US_805', 'Diese toendaCMS-Website entspricht den Section-508-Barrierefreiheitsrichtlinien der US-Regierung.');
if(!defined('_FOOTER_VALID_W3C_WAI'))          define('_FOOTER_VALID_W3C_WAI', 'Diese toendaCMS-Website entspricht den W3C-WAI-Richtlinien zur Barrierefreiheit von Websites.');
if(!defined('_FOOTER_VALID_XHTML'))            define('_FOOTER_VALID_XHTML', 'Diese toendaCMS-Website enth&#228;lt valides XHTML.');
if(!defined('_FOOTER_VALID_CSS'))              define('_FOOTER_VALID_CSS', 'Diese toendaCMS-Website wurde mit g&#252;ltigem CSS erstellt.');
if(!defined('_FOOTER_VALID_ANY_BROWSER'))      define('_FOOTER_VALID_ANY_BROWSER', 'Diese toendaCMS-Website unterst&#252;zt jeden Web Browser.');


// COUNTRY LIST
if(!defined('_COUNTRY_AFGHANISTAN'))           define('_COUNTRY_AFGHANISTAN', 'Afghanistan');
if(!defined('_COUNTRY_ALBANIA'))               define('_COUNTRY_ALBANIA', 'Albanien');
if(!defined('_COUNTRY_ALGERIA'))               define('_COUNTRY_ALGERIA', 'Algerien');
if(!defined('_COUNTRY_AMERICANSAMOA'))         define('_COUNTRY_AMERICANSAMOA', 'Amerikanische Samoa Inseln');
if(!defined('_COUNTRY_ANDORRA'))               define('_COUNTRY_ANDORRA', 'Andorra');
if(!defined('_COUNTRY_ANGOLA'))                define('_COUNTRY_ANGOLA', 'Angola');
if(!defined('_COUNTRY_ANQUILLA'))              define('_COUNTRY_ANQUILLA', 'Anguilla');
if(!defined('_COUNTRY_ANTARCTICA'))            define('_COUNTRY_ANTARCTICA', 'Antarktis');
if(!defined('_COUNTRY_ANTIQUAANDBARBUDA'))     define('_COUNTRY_ANTIQUAANDBARBUDA', 'Antigua und Barbuda');
if(!defined('_COUNTRY_ARGENTINA'))             define('_COUNTRY_ARGENTINA', 'Argentinien');
if(!defined('_COUNTRY_ARMENIA'))               define('_COUNTRY_ARMENIA', 'Armenien');
if(!defined('_COUNTRY_ARUBA'))                 define('_COUNTRY_ARUBA', 'Aruba');
if(!defined('_COUNTRY_AZERBAIJAN'))            define('_COUNTRY_AZERBAIJAN', 'Aserbeidschan');
if(!defined('_COUNTRY_EGYPT'))                 define('_COUNTRY_EGYPT', '&#196;gypten');
if(!defined('_COUNTRY_EQUATORIALGUINEA'))      define('_COUNTRY_EQUATORIALGUINEA', '&#196;quatorialguinea');
if(!defined('_COUNTRY_ETHIOPIA'))              define('_COUNTRY_ETHIOPIA', '&#196;thiopien');
if(!defined('_COUNTRY_AUSTRALIA'))             define('_COUNTRY_AUSTRALIA', 'Australien');
if(!defined('_COUNTRY_BAHAMAS'))               define('_COUNTRY_BAHAMAS', 'Bahamas');
if(!defined('_COUNTRY_BAHRAIN'))               define('_COUNTRY_BAHRAIN', 'Bahrein');
if(!defined('_COUNTRY_BANGLADESH'))            define('_COUNTRY_BANGLADESH', 'Bangladesch');
if(!defined('_COUNTRY_BARBADOS'))              define('_COUNTRY_BARBADOS', 'Barbados');
if(!defined('_COUNTRY_BELGIUM'))               define('_COUNTRY_BELGIUM', 'Belgien');
if(!defined('_COUNTRY_BELIZE'))                define('_COUNTRY_BELIZE', 'Belize');
if(!defined('_COUNTRY_BENIN'))                 define('_COUNTRY_BENIN', 'Benin');
if(!defined('_COUNTRY_BERMUDA'))               define('_COUNTRY_BERMUDA', 'Bermuda');
if(!defined('_COUNTRY_BHUTAN'))                define('_COUNTRY_BHUTAN', 'Bhutan');
if(!defined('_COUNTRY_BOLIVIA'))               define('_COUNTRY_BOLIVIA', 'Bolivien');
if(!defined('_COUNTRY_BOSNIAANDHERZEGOVINA'))  define('_COUNTRY_BOSNIAANDHERZEGOVINA', 'Bosnien und Herzegowina');
if(!defined('_COUNTRY_BOTSWANA'))              define('_COUNTRY_BOTSWANA', 'Botswana');
if(!defined('_COUNTRY_BOUVETISLAND'))          define('_COUNTRY_BOUVETISLAND', 'Bouvet Insel');
if(!defined('_COUNTRY_BRAZIL'))                define('_COUNTRY_BRAZIL', 'Brasilien');
if(!defined('_COUNTRY_BRITININDIAOCEAN'))      define('_COUNTRY_BRITININDIAOCEAN', 'Brit. Territorium im Indischen Ozean');
if(!defined('_COUNTRY_VIRGINISLANDS'))         define('_COUNTRY_VIRGINISLANDS', 'Virgin Islands');
if(!defined('_COUNTRY_BULGARIA'))              define('_COUNTRY_BULGARIA', 'Bulgarien');
if(!defined('_COUNTRY_BURKINAFASO'))           define('_COUNTRY_BURKINAFASO', 'Burkina Faso');
if(!defined('_COUNTRY_BURUNDI'))               define('_COUNTRY_BURUNDI', 'Burundi');
if(!defined('_COUNTRY_BRUNEI'))                define('_COUNTRY_BRUNEI', 'Brunei');
if(!defined('_COUNTRY_CAYMANISLAND'))          define('_COUNTRY_CAYMANISLAND', 'Cayman Inseln');
if(!defined('_COUNTRY_CHILE'))                 define('_COUNTRY_CHILE', 'Chile');
if(!defined('_COUNTRY_CHINA'))                 define('_COUNTRY_CHINA', 'China');
if(!defined('_COUNTRY_COOKISLANDS'))           define('_COUNTRY_COOKISLANDS', 'Cook Inseln');
if(!defined('_COUNTRY_COSTARICA'))             define('_COUNTRY_COSTARICA', 'Costa Rica');
if(!defined('_COUNTRY_GERMANY'))               define('_COUNTRY_GERMANY', 'Deutschland');
if(!defined('_COUNTRY_DJIBOUTI'))              define('_COUNTRY_DJIBOUTI', 'Djibouti');
if(!defined('_COUNTRY_DOMINICA'))              define('_COUNTRY_DOMINICA', 'Dominica');
if(!defined('_COUNTRY_DOMINICANREPUPLIC'))     define('_COUNTRY_DOMINICANREPUPLIC', 'Dominikanische Republik');
if(!defined('_COUNTRY_DENMARK'))               define('_COUNTRY_DENMARK', 'D&#228;nemark');
if(!defined('_COUNTRY_ELSALVADOR'))            define('_COUNTRY_ELSALVADOR', 'El Salvador');
if(!defined('_COUNTRY_IVORYCOAST'))            define('_COUNTRY_IVORYCOAST', 'Elfenbeink&#252;ste');
if(!defined('_COUNTRY_ECUADOR'))               define('_COUNTRY_ECUADOR', 'Equador');
if(!defined('_COUNTRY_ERITREA'))               define('_COUNTRY_ERITREA', 'Eritrea');
if(!defined('_COUNTRY_ESTONIA'))               define('_COUNTRY_ESTONIA', 'Estland');
if(!defined('_COUNTRY_FALKLANDISLANDS'))       define('_COUNTRY_FALKLANDISLANDS', 'Falkland Inseln (Malvinen)');
if(!defined('_COUNTRY_FIJI'))                  define('_COUNTRY_FIJI', 'Fiji');
if(!defined('_COUNTRY_FINLAND'))               define('_COUNTRY_FINLAND', 'Finnland');
if(!defined('_COUNTRY_FRANCE'))                define('_COUNTRY_FRANCE', 'Frankreich');
if(!defined('_COUNTRY_FRENCHGUIANA'))          define('_COUNTRY_FRENCHGUIANA', 'Franz&#246;sisch Guayna');
if(!defined('_COUNTRY_FRENCHPOLINESIA'))       define('_COUNTRY_FRENCHPOLINESIA', 'Franz&#246;sisch Polynesien');
if(!defined('_COUNTRY_FRENCHSOUNTHTERITORIES'))define('_COUNTRY_FRENCHSOUNTHTERITORIES', 'Franz&#246;sische S&#252;dliche Territorien');
if(!defined('_COUNTRY_FAROEISLANDS'))          define('_COUNTRY_FAROEISLANDS', 'F&#228;r&#246;er Inseln');
if(!defined('_COUNTRY_GABUN'))                 define('_COUNTRY_GABUN', 'Gabun');
if(!defined('_COUNTRY_GAMBIA'))                define('_COUNTRY_GAMBIA', 'Gambia');
if(!defined('_COUNTRY_GEORGIA'))               define('_COUNTRY_GEORGIA', 'Georgien');
if(!defined('_COUNTRY_GHANA'))                 define('_COUNTRY_GHANA', 'Ghana');
if(!defined('_COUNTRY_GIBRALTAR'))             define('_COUNTRY_GIBRALTAR', 'Gibraltar');
if(!defined('_COUNTRY_GRENADA'))               define('_COUNTRY_GRENADA', 'Grenada');
if(!defined('_COUNTRY_GREECE'))                define('_COUNTRY_GREECE', 'Griechenland');
if(!defined('_COUNTRY_BRITANY'))               define('_COUNTRY_BRITANY', 'Gro&#223;britannien');
if(!defined('_COUNTRY_GREENLAND'))             define('_COUNTRY_GREENLAND', 'Gr&#246;nland');
if(!defined('_COUNTRY_GUADELOUPE'))            define('_COUNTRY_GUADELOUPE', 'Guadeloupe');
if(!defined('_COUNTRY_GUAM'))                  define('_COUNTRY_GUAM', 'Guam');
if(!defined('_COUNTRY_GUATEMALA'))             define('_COUNTRY_GUATEMALA', 'Guatemala');
if(!defined('_COUNTRY_GUINEA'))                define('_COUNTRY_GUINEA', 'Guinea');
if(!defined('_COUNTRY_GUINEABISSAU'))          define('_COUNTRY_GUINEABISSAU', 'Guinea - Bissau');
if(!defined('_COUNTRY_GUYANA'))                define('_COUNTRY_GUYANA', 'Guyana');
if(!defined('_COUNTRY_HAITI'))                 define('_COUNTRY_HAITI', 'Haiti');
if(!defined('_COUNTRY_HEARDMCDONALDISLANDS'))  define('_COUNTRY_HEARDMCDONALDISLANDS', 'Heard und McDonald - Inseln');
if(!defined('_COUNTRY_HONDURAS'))              define('_COUNTRY_HONDURAS', 'Honduras');
if(!defined('_COUNTRY_HONGKONG'))              define('_COUNTRY_HONGKONG', 'Hong Kong');
if(!defined('_COUNTRY_INDIA'))                 define('_COUNTRY_INDIA', 'Indien');
if(!defined('_COUNTRY_INDONESIA'))             define('_COUNTRY_INDONESIA', 'Indonesien');
if(!defined('_COUNTRY_IRAQ'))                  define('_COUNTRY_IRAQ', 'Irak');
if(!defined('_COUNTRY_IRAN'))                  define('_COUNTRY_IRAN', 'Iran');
if(!defined('_COUNTRY_IRELAND'))               define('_COUNTRY_IRELAND', 'Irland');
if(!defined('_COUNTRY_ICELAND'))               define('_COUNTRY_ICELAND', 'Island');
if(!defined('_COUNTRY_ISRAEL'))                define('_COUNTRY_ISRAEL', 'Israel');
if(!defined('_COUNTRY_ITALY'))                 define('_COUNTRY_ITALY', 'Italien');
if(!defined('_COUNTRY_JAMAICA'))               define('_COUNTRY_JAMAICA', 'Jamaika');
if(!defined('_COUNTRY_JAPAN'))                 define('_COUNTRY_JAPAN', 'Japan');
if(!defined('_COUNTRY_YEMEN'))                 define('_COUNTRY_YEMEN', 'Jemen');
if(!defined('_COUNTRY_JORDAN'))                define('_COUNTRY_JORDAN', 'Jordanien');
if(!defined('_COUNTRY_YUGOSLAVIA'))            define('_COUNTRY_YUGOSLAVIA', 'Jugoslawien (ehem.)');
if(!defined('_COUNTRY_VIRGINISLANDS'))         define('_COUNTRY_VIRGINISLANDS', 'Jungferninseln');
if(!defined('_COUNTRY_CAMBODIA'))              define('_COUNTRY_CAMBODIA', 'Kambodscha');
if(!defined('_COUNTRY_CAMEROON'))              define('_COUNTRY_CAMEROON', 'Kamerun');
if(!defined('_COUNTRY_CANADA'))                define('_COUNTRY_CANADA', 'Kanada');
if(!defined('_COUNTRY_CAPEVERDEISLANDS'))      define('_COUNTRY_CAPEVERDEISLANDS', 'Kapverdische Inseln');
if(!defined('_COUNTRY_KAZAKHSTAN'))            define('_COUNTRY_KAZAKHSTAN', 'Kasachstan');
if(!defined('_COUNTRY_KATAR'))                 define('_COUNTRY_KATAR', 'Katar');
if(!defined('_COUNTRY_KENYA'))                 define('_COUNTRY_KENYA', 'Kenia');
if(!defined('_COUNTRY_KYRGYZSTAN'))            define('_COUNTRY_KYRGYZSTAN', 'Kirgisien');
if(!defined('_COUNTRY_KIRIBATI'))              define('_COUNTRY_KIRIBATI', 'Kiribati');
if(!defined('_COUNTRY_COCOSISLANDS'))          define('_COUNTRY_COCOSISLANDS', 'Kokosinseln');
if(!defined('_COUNTRY_COLOMBIA'))              define('_COUNTRY_COLOMBIA', 'Kolumbien');
if(!defined('_COUNTRY_COMOROS'))               define('_COUNTRY_COMOROS', 'Komoren');
if(!defined('_COUNTRY_CONGO'))                 define('_COUNTRY_CONGO', 'Kongo');
if(!defined('_COUNTRY_CROATIA'))               define('_COUNTRY_CROATIA', 'Kroatien');
if(!defined('_COUNTRY_CUBA'))                  define('_COUNTRY_CUBA', 'Kuba');
if(!defined('_COUNTRY_KUWAIT'))                define('_COUNTRY_KUWAIT', 'Kuwait');
if(!defined('_COUNTRY_LAOS'))                  define('_COUNTRY_LAOS', 'Laos');
if(!defined('_COUNTRY_LESOTHO'))               define('_COUNTRY_LESOTHO', 'Lesotho');
if(!defined('_COUNTRY_LATVIA'))                define('_COUNTRY_LATVIA', 'Lettland');
if(!defined('_COUNTRY_LEBANON'))               define('_COUNTRY_LEBANON', 'Libanon');
if(!defined('_COUNTRY_LIBERIA'))               define('_COUNTRY_LIBERIA', 'Liberia');
if(!defined('_COUNTRY_LIBYA'))                 define('_COUNTRY_LIBYA', 'Libyen');
if(!defined('_COUNTRY_LIECHTENSTEIN'))         define('_COUNTRY_LIECHTENSTEIN', 'Liechtenstein');
if(!defined('_COUNTRY_LITHUANIA'))             define('_COUNTRY_LITHUANIA', 'Litauen');
if(!defined('_COUNTRY_LUXEMBOURG'))            define('_COUNTRY_LUXEMBOURG', 'Luxemburg');
if(!defined('_COUNTRY_MACAO'))                 define('_COUNTRY_MACAO', 'Macao');
if(!defined('_COUNTRY_MADAGASCAR'))            define('_COUNTRY_MADAGASCAR', 'Madagaskar');
if(!defined('_COUNTRY_MALAWI'))                define('_COUNTRY_MALAWI', 'Malawi');
if(!defined('_COUNTRY_MALAYSIA'))              define('_COUNTRY_MALAYSIA', 'Malaysia');
if(!defined('_COUNTRY_MALDIVEISLANDS'))        define('_COUNTRY_MALDIVEISLANDS', 'Malediven');
if(!defined('_COUNTRY_MALI'))                  define('_COUNTRY_MALI', 'Mali');
if(!defined('_COUNTRY_MALTA'))                 define('_COUNTRY_MALTA', 'Malta');
if(!defined('_COUNTRY_MAROCCO'))               define('_COUNTRY_MAROCCO', 'Marokko');
if(!defined('_COUNTRY_MARSHALLISLANDS'))       define('_COUNTRY_MARSHALLISLANDS', 'Marshall Inseln');
if(!defined('_COUNTRY_MARTINIQUE'))            define('_COUNTRY_MARTINIQUE', 'Martinique');

if(!defined('_COUNTRY_SUDAN'))                 define('_COUNTRY_SUDAN', 'Sudan');
if(!defined('_COUNTRY_SURINAME'))              define('_COUNTRY_SURINAME', 'Surinam');
if(!defined('_COUNTRY_SVALBARD'))              define('_COUNTRY_SVALBARD', 'Svalbard und Jan Mayen (Spitzbergen)');
if(!defined('_COUNTRY_SWAZILAND'))             define('_COUNTRY_SWAZILAND', 'Swasiland');
if(!defined('_COUNTRY_SWEDEN'))                define('_COUNTRY_SWEDEN', 'Schweden');
if(!defined('_COUNTRY_SOUTHAFRICA'))           define('_COUNTRY_SOUTHAFRICA', 'S&#252;dafrika');
if(!defined('_COUNTRY_SOUTHKOREA'))            define('_COUNTRY_SOUTHKOREA', 'S&#252;dkorea');
if(!defined('_COUNTRY_SYRIA'))                 define('_COUNTRY_SYRIA', 'Syrien');
if(!defined('_COUNTRY_TADZHIKISTAN'))          define('_COUNTRY_TADZHIKISTAN', 'Tadschikistan');
if(!defined('_COUNTRY_TAIWAN'))                define('_COUNTRY_TAIWAN', 'Taiwan');
if(!defined('_COUNTRY_TANZANIA'))              define('_COUNTRY_TANZANIA', 'Tansania');
if(!defined('_COUNTRY_THAILAND'))              define('_COUNTRY_THAILAND', 'Thailand');
if(!defined('_COUNTRY_TOGO'))                  define('_COUNTRY_TOGO', 'Togo');
if(!defined('_COUNTRY_TOKELAU'))               define('_COUNTRY_TOKELAU', 'Tokelau');
if(!defined('_COUNTRY_TONGA'))                 define('_COUNTRY_TONGA', 'Tonga');
if(!defined('_COUNTRY_TRINIDATANDTOBAGO'))     define('_COUNTRY_TRINIDATANDTOBAGO', 'Trinidad und Tobago');
if(!defined('_COUNTRY_CHAD'))                  define('_COUNTRY_CHAD', 'Tschad');
if(!defined('_COUNTRY_CZECHREPUBLIC'))         define('_COUNTRY_CZECHREPUBLIC', 'Tschechien');
if(!defined('_COUNTRY_TUNISIA'))               define('_COUNTRY_TUNISIA', 'Tunesien');
if(!defined('_COUNTRY_TURKSANDCAICOSISLANDS')) define('_COUNTRY_TURKSANDCAICOSISLANDS', 'Turk und Caicos Inseln');
if(!defined('_COUNTRY_TUVALU'))                define('_COUNTRY_TUVALU', 'Tuvalu');
if(!defined('_COUNTRY_TURKEY'))                define('_COUNTRY_TURKEY', 'T&#252;rkei');
if(!defined('_COUNTRY_USMINOROUTLYINGISLANDS'))define('_COUNTRY_USMINOROUTLYINGISLANDS', 'U.S. Minor Outlying Inseln');
if(!defined('_COUNTRY_UGANDA'))                define('_COUNTRY_UGANDA', 'Uganda');
if(!defined('_COUNTRY_UKRAINA'))               define('_COUNTRY_UKRAINA', 'Ukraine');
if(!defined('_COUNTRY_HUNGARY'))               define('_COUNTRY_HUNGARY', 'Ungarn');
if(!defined('_COUNTRY_URUGUAY'))               define('_COUNTRY_URUGUAY', 'Uruguay');
if(!defined('_COUNTRY_UZBEKISTAN'))            define('_COUNTRY_UZBEKISTAN', 'Usbekistan');
if(!defined('_COUNTRY_USA'))                   define('_COUNTRY_USA', 'Vereinigte Staaten von Amerika');
if(!defined('_COUNTRY_VANUATA'))               define('_COUNTRY_VANUATA', 'Vanuatu');
if(!defined('_COUNTRY_VATICANCITY'))           define('_COUNTRY_VATICANCITY', 'Vatikanstaat');
if(!defined('_COUNTRY_VENEZUELA'))             define('_COUNTRY_VENEZUELA', 'Venezuela');
if(!defined('_COUNTRY_UAE'))                   define('_COUNTRY_UAE', 'Vereinigte Arabische Emirate');
if(!defined('_COUNTRY_VIETNAM'))               define('_COUNTRY_VIETNAM', 'Vietnam');
if(!defined('_COUNTRY_VALAISANDFUTUNAISLANDS'))define('_COUNTRY_VALAISANDFUTUNAISLANDS', 'Wallis und Futuna Inseln');
if(!defined('_COUNTRY_CHRISTMASISLANDS'))      define('_COUNTRY_CHRISTMASISLANDS', 'Weihnachtsinsel');
if(!defined('_COUNTRY_BELARUS'))               define('_COUNTRY_BELARUS', 'Wei&#223;ru&#223;land');
if(!defined('_COUNTRY_WESTERNSAHARA'))         define('_COUNTRY_WESTERNSAHARA', 'Westsahahra');
if(!defined('_COUNTRY_ZAIRE'))                 define('_COUNTRY_ZAIRE', 'Zaire');
if(!defined('_COUNTRY_ZAMBIA'))                define('_COUNTRY_ZAMBIA', 'Zambia');
if(!defined('_COUNTRY_CENTRALAFRICANREPUBLIC'))define('_COUNTRY_CENTRALAFRICANREPUBLIC', 'Zentralafrikanische Republik');
if(!defined('_COUNTRY_CYPRUS'))                define('_COUNTRY_CYPRUS', 'Zypern');


/*

UTF-8 HTML Entities
--------------------

&Auml; = &#196;
&Ouml; = &#214;
&Uuml; = &#220;
&szlig; = &#223;
&auml; = &#228;
&ouml; = &#246;
&uuml; = &#252;

*/


// SOME FORMATS
function lang_date($day, $month, $year, $hour, $min, $sec){
	if(trim($day) != '' && trim($month) != '' && trim($year) != ''){
		$str1 = $day.'.'.$month.'.'.$year;
	}
	else{ $str1 = ''; }
	
	if(trim($hour) != '' && trim($min) != ''){
		if(trim($str1) != ''){ $str3 = ' - '.$hour.':'.$min; }
		else{ $str3 = $hour.':'.$min; }
	}
	else{ $str3 = ''; }
	
	if(trim($sec) != ''){ $str2 = ':'.$sec; }
	else{ $str2 = ''; }
	
	return $str1.$str3.$str2.( trim($str3) != '' ? ' Uhr' : '');
}


// INCLUDE DEFAULT LANGUAGE
if(_TCMS_LANGUAGE_STARTPOINT == 'admin'){ include_once('../language/english_EN/lang_english_EN.php'); }
else{ include_once('engine/language/english_EN/lang_english_EN.php'); }
// END INCLUDE


?>
