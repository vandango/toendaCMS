<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Dervis Uyuducu                                                 |
+------------------------------------------------------------------------+
| 
| Norwegian Language
|
| File:		lang_norwegian_NO.php
| Version:	0.0.1
|
+
*/

/////////// VERSION 1.6.2
if(!defined('_GLOBAL_MM_VIEW_LIST'))           define('_GLOBAL_MM_VIEW_LIST', 'Liste visning');
if(!defined('_GLOBAL_MM_VIEW_ICON'))           define('_GLOBAL_MM_VIEW_ICON', 'Ikon visning');
if(!defined('_GLOBAL_MM_VIEW'))                define('_GLOBAL_MM_VIEW', 'Mediamanager objekt visning');
if(!defined('_GLOBAL_FOOTER'))                 define('_GLOBAL_FOOTER', 'Bunn');
if(!defined('_GLOBAL_SHOW_BOOKMARK_LINKS'))    define('_GLOBAL_SHOW_BOOKMARK_LINKS', 'Hvis bokmerke linker');

if(!defined('_PATH_CONTACTFORM'))              define('_PATH_CONTACTFORM', 'Kontaktskjema');

if(!defined('_MSG_COMMENT_FOR'))               define('_MSG_COMMENT_FOR', 'Kommenter til');

if(!defined('_EXT_NEWS_SYN_USE_RSS091_IMG'))   define('_EXT_NEWS_SYN_USE_RSS091_IMG', 'Bruk standard bilde for the RSS 0.91 link');
if(!defined('_EXT_NEWS_SYN_RSS091_TEXT'))      define('_EXT_NEWS_SYN_RSS091_TEXT', 'RSS 0.91 link tekst');
if(!defined('_EXT_NEWS_SYN_USE_RSS10_IMG'))    define('_EXT_NEWS_SYN_USE_RSS10_IMG', 'Bruk standard bilde for the RSS 1.0 link');
if(!defined('_EXT_NEWS_SYN_RSS10_TEXT'))       define('_EXT_NEWS_SYN_RSS10_TEXT', 'RSS 1.0 link tekst');
if(!defined('_EXT_NEWS_SYN_USE_RSS20_IMG'))    define('_EXT_NEWS_SYN_USE_RSS20_IMG', 'Bruk standard bilde for the RSS 2.0 link');
if(!defined('_EXT_NEWS_SYN_RSS20_TEXT'))       define('_EXT_NEWS_SYN_RSS20_TEXT', 'RSS 2.0 link tekst');
if(!defined('_EXT_NEWS_SYN_USE_ATOM03_IMG'))   define('_EXT_NEWS_SYN_USE_ATOM03_IMG', 'Bruk standard bilde for the Atom 0.3 link');
if(!defined('_EXT_NEWS_SYN_ATOM03_TEXT'))      define('_EXT_NEWS_SYN_ATOM03_TEXT', 'Atom 0.3 link tekst');
if(!defined('_EXT_NEWS_SYN_USE_OPML_IMG'))     define('_EXT_NEWS_SYN_USE_OPML_IMG', 'Bruk standard bilde for the Opml link');
if(!defined('_EXT_NEWS_SYN_OPML_TEXT'))        define('_EXT_NEWS_SYN_OPML_TEXT', 'Opml link tekst');
if(!defined('_EXT_NEWS_SYN_USE_CFEED'))        define('_EXT_NEWS_SYN_USE_CFEED', 'Bruk feed for the kommentarer');
if(!defined('_EXT_NEWS_SYN_USE_CFEED_IMG'))    define('_EXT_NEWS_SYN_USE_CFEED_IMG', 'Bruk et bilde for kommentar feed linken');
if(!defined('_EXT_NEWS_SYN_CFEED_TEXT'))       define('_EXT_NEWS_SYN_CFEED_TEXT', 'Kommentar feed link tekst');
if(!defined('_EXT_NEWS_SYN_CFEED_AMOUNT'))     define('_EXT_NEWS_SYN_CFEED_AMOUNT', 'Antall kommentarer i feed');
if(!defined('_EXT_NEWS_SYN_CFEED_TYPE'))       define('_EXT_NEWS_SYN_CFEED_TYPE', 'Feed type for kommentarene');

if(!defined('_TABLE_BOOKMARK'))                define('_TABLE_BOOKMARK', 'Bokmerke');
///////////


/////////// VERSION 1.6.0
if(!defined('_MSG_MAX_POST_SIZE'))             define('_MSG_MAX_POST_SIZE', 'Max POST-størrelse');

if(!defined('_MSG_NOUPLOAD_PHP'))              define('_MSG_NOUPLOAD_PHP', 'Filen kan ikke lastes opp. Enten er upload_max_size eller post_max_size INI instillingen for liten.');
if(!defined('_MSG_ACTIVATE_NEW_PW_FIRST'))     define('_MSG_ACTIVATE_NEW_PW_FIRST', 'Du må aktivere ditt nye passord ved å klikke på følgende link:');
if(!defined('_MSG_SUCCESSFULL_RETRIEVED'))     define('_MSG_SUCCESSFULL_RETRIEVED', 'Du har mottatt et nytt passord.');
if(!defined('_MSG_ERROR_ON_RETRIEVING'))       define('_MSG_ERROR_ON_RETRIEVING', 'Error i validering av nytt password!');

if(!defined('_GLOBAL_SEO_NEWS_TITLE'))         define('_GLOBAL_SEO_NEWS_TITLE', 'Konverter også nyhets-url til tittel');
if(!defined('_GLOBAL_SEO_CONTENT_TITLE'))      define('_GLOBAL_SEO_CONTENT_TITLE', 'Konverter også innholds-url til tittel');

if(!defined('_TABLE_IMAGES'))                  define('_TABLE_IMAGES', 'Bilder');
if(!defined('_TABLE_SHOWONMAINPAGE'))          define('_TABLE_SHOWONMAINPAGE', 'Hvis i hovedside');
if(!defined('_TABLE_PRODUCT'))                 define('_TABLE_PRODUCT', 'Produkt');
if(!defined('_TABLE_THUMBNAIL'))               define('_TABLE_THUMBNAIL', 'Miniatyr');
if(!defined('_TABLE_PRICE_ADD'))               define('_TABLE_PRICE_ADD', '(gross, for clear let Tax rate empty)');
if(!defined('_TABLE_BROWSE'))                  define('_TABLE_BROWSE', 'Utforsk');

if(!defined('_PRODUCTS_SHOW_PRICE_ONLY_USERS'))define('_PRODUCTS_SHOW_PRICE_ONLY_USERS', 'Hvis bare pris');
if(!defined('_PRODUCTS_STARTPAGETITLE'))       define('_PRODUCTS_STARTPAGETITLE', 'Startside tittel');
if(!defined('_PRODUCTS_ARTICLE'))              define('_PRODUCTS_ARTICLE', 'Artikkel');
if(!defined('_PRODUCTS_CATEGORY'))             define('_PRODUCTS_CATEGORY', 'Kategori');
if(!defined('_PRODUCTS_CATEGORIES'))           define('_PRODUCTS_CATEGORIES', 'Kategorier');
if(!defined('_PRODUCTS_CATALOGUE'))            define('_PRODUCTS_CATALOGUE', 'Katalog');
if(!defined('_PRODUCTS_USESIDEBARCATEGORIES')) define('_PRODUCTS_USESIDEBARCATEGORIES', 'Bruk sidelinje kategorier');
if(!defined('_PRODUCTS_LATEST'))               define('_PRODUCTS_LATEST', 'Seneste artikler');
if(!defined('_PRODUCTS_AMOUNT_OF_LATEST'))     define('_PRODUCTS_AMOUNT_OF_LATEST', 'Antall nye artikler på forside');
if(!defined('_PRODUCTS_ADD_TO_CART'))          define('_PRODUCTS_ADD_TO_CART', 'Legg til handlekurven');
///////////////

/////////// VERSION 1.5.5
if(!defined('_MSG_NO_ALBUM_WITH_THIS_ID'))     define('_MSG_NO_ALBUM_WITH_THIS_ID', 'Systemet fant ingen album med denne ID\'en!');
if(!defined('_MSG_CREATE_ALBUM_FIRST'))        define('_MSG_CREATE_ALBUM_FIRST', '* Opprett et album først *');
//////////////

/////////// VERSION 1.5.0
if(!defined('_TCMS_ADMIN_APPLY'))              define('_TCMS_ADMIN_APPLY', 'Bruk');
if(!defined('_TCMS_ADMIN_DELETE_ALL'))         define('_TCMS_ADMIN_DELETE_ALL', 'Slett alle');
if(!defined('_TCMS_THIS_PAGE_IN'))             define('_TCMS_THIS_PAGE_IN', 'Denne siden i');
if(!defined('_TCMS_ADMIN_EDIT_LANG'))          define('_TCMS_ADMIN_EDIT_LANG', 'Editer dette språket');
if(!defined('_TCMS_LANGUAGES'))                define('_TCMS_LANGUAGES', 'Språk');
if(!defined('_TCMS_LANGUAGE'))                 define('_TCMS_LANGUAGE', 'Språk');
if(!defined('_TCMS_TEST_ENVIRONMENT'))         define('_TCMS_TEST_ENVIRONMENT', 'DETTE ER ET TEST MILJØ!');
if(!defined('_TCMS_OPEN_ALL'))                 define('_TCMS_OPEN_ALL', 'Åpne alt');
if(!defined('_TCMS_CLOSE_ALL'))                define('_TCMS_CLOSE_ALL', 'Lukk alt');
if(!defined('_TCMS_HELP'))                     define('_TCMS_HELP', 'Hjelp');
if(!defined('_TCMS_DOCU'))                     define('_TCMS_DOCU', 'Wiki');
if(!defined('_TCMS_TSCRIPT_SYNTAX_REF'))       define('_TCMS_TSCRIPT_SYNTAX_REF', 'toendaScript - Syntax Referanse');

// LANGUAGE LIST
if(!defined('_LANG_GERMAN'))                   define('_LANG_GERMAN', 'Tysk');
if(!defined('_LANG_ENGLISH'))                  define('_LANG_ENGLISH', 'Engelsk');
if(!defined('_LANG_BULGARIAN'))                define('_LANG_BULGARIAN', 'Bulgarsk');
if(!defined('_LANG_DUTCH'))                    define('_LANG_DUTCH', 'Nederlansk');
if(!defined('_LANG_FINNISH'))                  define('_LANG_FINNISH', 'Finsk');
if(!defined('_LANG_ITALY'))                    define('_LANG_ITALY', 'Italiensk');
if(!defined('_LANG_KOREAN'))                   define('_LANG_KOREAN', 'Koreansk');
if(!defined('_LANG_NORWEGIAN'))                define('_LANG_NORWEGIAN', 'Norsk');
if(!defined('_LANG_PORTUGUES'))                define('_LANG_PORTUGUES', 'Portogisisk');
if(!defined('_LANG_ROMANIAN'))                 define('_LANG_ROMANIAN', 'Romensk');
if(!defined('_LANG_SLOVAK'))                   define('_LANG_SLOVAK', 'Slovakisk');
if(!defined('_LANG_SPANISH'))                  define('_LANG_SPANISH', 'Spansk');
if(!defined('_LANG_SWEDISH'))                  define('_LANG_SWEDISH', 'Svensk');

if(!defined('_CONTACT_VCARD'))                 define('_CONTACT_VCARD', 'vCard'); 
if(!defined('_CONTACT_VCARD_IMPORT_TEXT'))     define('_CONTACT_VCARD_IMPORT_TEXT', 'Hvis du har en .vcf fil, last den opp og toendaCMS vil importere kontakten automatisk.');
if(!defined('_CONTACT_VCARD_VCF'))             define('_CONTACT_VCARD_VCF', 'vCard .vcf fil');
if(!defined('_CONTACT_VCARD_DOWNLOAD'))        define('_CONTACT_VCARD_DOWNLOAD', 'Last ned vCard');

if(!defined('_GLOBAL'))                        define('_GLOBAL', 'Site');
if(!defined('_GLOBAL_PDFLINK_IN_FOOTER'))      define('_GLOBAL_PDFLINK_IN_FOOTER', 'Hvis PDF link i bunn');
if(!defined('_GLOBAL_CACHE_CONTROL'))          define('_GLOBAL_CACHE_CONTROL', 'Søkemotor-chache instillinger');
if(!defined('_GLOBAL_PRAGMA'))                 define('_GLOBAL_PRAGMA', 'Søkemotor Pragma');
if(!defined('_GLOBAL_EXPIRES'))                define('_GLOBAL_EXPIRES', 'Websiden kan utgå');
if(!defined('_GLOBAL_ROBOTSSETTINGS'))         define('_GLOBAL_ROBOTSSETTINGS', 'Instilling for søkerobots (Webcrawler)');
if(!defined('_GLOBAL_LAST_CHANGES'))           define('_GLOBAL_LAST_CHANGES', 'Siste endring');
if(!defined('_GLOBAL_USE_CONTENT_LANG'))       define('_GLOBAL_USE_CONTENT_LANG', 'Bruk innholdsspråk');
if(!defined('_GLOBAL_VALIDLINKS'))             define('_GLOBAL_VALIDLINKS', 'Hvis WebStandards link');

if(!defined('_NEWS_SHOW_ON_FRONTPAGE'))        define('_NEWS_SHOW_ON_FRONTPAGE', 'Hvis nyheter på forsiden');

if(!defined('_TABLE_FRONTPAGE'))               define('_TABLE_FRONTPAGE', 'Forside');

if(!defined('_SIDEEXT_LANGUAGE_SELECTOR'))     define('_SIDEEXT_LANGUAGE_SELECTOR', 'Språk velger');

if(!defined('_FORM_GO'))                       define('_FORM_GO', 'Gå til');

if(!defined('_CONTENT_NEW_LANG_DOCUMENT'))     define('_CONTENT_NEW_LANG_DOCUMENT', 'Nytt dokument i et annet språk');
if(!defined('_CONTENT_ORG_DOCUMENT'))          define('_CONTENT_ORG_DOCUMENT', 'Orginal dokument');

if(!defined('_ABOUT_SVN_REPO'))                define('_ABOUT_SVN_REPO', 'SVN Repository');

if(!defined('_TCMS_MENU_CFORM'))               define('_TCMS_MENU_CFORM', 'Kontaktskjema');
if(!defined('_TCMS_MENU_BOOK'))                define('_TCMS_MENU_BOOK', 'Gjestebok');

if(!defined('_MOD_CFORM'))                     define('_MOD_CFORM', 'Kontaktskjema konfigurasjon');
if(!defined('_MOD_BOOK'))                      define('_MOD_BOOK', 'Gjestebok konfigurasjon');

if(!defined('_FRONTPAGE_DT'))                  define('_FRONTPAGE_DT', 'Dato og tid, Tittel');

// FOOTER
if(!defined('_FOOTER_VALID_TITLE'))            define('_FOOTER_VALID_TITLE', 'Denne websiden er i henhold til følgende standarder');
if(!defined('_FOOTER_VALID_US_805'))           define('_FOOTER_VALID_US_805', 'Denne websiden er i henhold til 508 Accessibility retningslinjene.');
if(!defined('_FOOTER_VALID_W3C_WAI'))          define('_FOOTER_VALID_W3C_WAI', 'Denne websiden er i henhold til W3C-WAI Web Content Accessibility retningslinjene.');
if(!defined('_FOOTER_VALID_XHTML'))            define('_FOOTER_VALID_XHTML', 'Denne websiden er gyldig XHTML.');
if(!defined('_FOOTER_VALID_CSS'))              define('_FOOTER_VALID_CSS', 'Denne websiden er bygget med gyldig CSS.');
if(!defined('_FOOTER_VALID_ANY_BROWSER'))      define('_FOOTER_VALID_ANY_BROWSER', 'Denne websiden er brukbar i alle nettlesere.');
/////////////


///// VERSION 1.0.5
if(!defined('_TCMS_BASE_DIRECTORY'))           define('_TCMS_BASE_DIRECTORY', 'Rot mappe');
if(!defined('_TCMS_OPEN_DIRECTORY'))           define('_TCMS_OPEN_DIRECTORY', 'Åpne mappe');

if(!defined('_NL_NEWSLETTER'))                 define('_NL_NEWSLETTER', 'Nyhetsbrev');

if(!defined('_GLOBAL_MAIL_WITH_SMTP'))         define('_GLOBAL_MAIL_WITH_SMTP', 'Send mail med SMTP');
if(!defined('_GLOBAL_MAIL_AS_HTML'))           define('_GLOBAL_MAIL_AS_HTML', 'Send mail som HTML');
if(!defined('_GLOBAL_REVISIT_AFTER'))          define('_GLOBAL_REVISIT_AFTER', 'Dager til reindeksering av en søkemotor');
if(!defined('_GLOBAL_ROBOTSFILE'))             define('_GLOBAL_ROBOTSFILE', 'URL til "robots.txt" filen');

if(!defined('_MSG_SEND_FAILED'))               define('_MSG_SEND_FAILED', 'Error under sending!');
////////////


///// VERSION 1.0.4
if(!defined('_TCMS_ADMIN_BACK_TO_PAGE'))       define('_TCMS_ADMIN_BACK_TO_PAGE', 'Tilbake til websiden');

if(!defined('_EXT_CFORM_SHOW_CONTACTEMAIL'))   define('_EXT_CFORM_SHOW_CONTACTEMAIL', 'Vis kontaktens emailadress');

if(!defined('_MSG_CHANGES'))                   define('_MSG_CHANGES', 'Du har gjordt noen endringer.');
if(!defined('_MSG_SAVE_NOW'))                  define('_MSG_SAVE_NOW', 'Vil du lagre dem nå?');

if(!defined('_GALLERY_MIMETYPE'))              define('_GALLERY_MIMETYPE', 'Mimetype');

if(!defined('_EXT_NEWS_DISPLAY_MORE'))         define('_EXT_NEWS_DISPLAY_MORE', 'Representasjon av <em>Les mer</em>-Link');
if(!defined('_EXT_NEWS_MORE_NL_LEFT'))         define('_EXT_NEWS_MORE_NL_LEFT', 'Ny linje - venstre juster');
if(!defined('_EXT_NEWS_MORE_NL_RIGHT'))        define('_EXT_NEWS_MORE_NL_RIGHT', 'Ny linje - høyre juster');
if(!defined('_EXT_NEWS_MORE_NL_DIRECT'))       define('_EXT_NEWS_MORE_NL_DIRECT', 'Samme linje - etter teksten');
if(!defined('_EXT_NEWS_NEWS_SPACING'))         define('_EXT_NEWS_NEWS_SPACING', 'Nyhets spacing');
///////////

// ADMIN
if(!defined('_TCMS_ADMIN_TITLE'))              define('_TCMS_ADMIN_TITLE', 'toendaCMS Administrator');
if(!defined('_TCMS_ADMIN_BACK'))               define('_TCMS_ADMIN_BACK', 'Tilbake');
if(!defined('_TCMS_ADMIN_FORWARD'))            define('_TCMS_ADMIN_FORWARD', 'Frem');
if(!defined('_TCMS_ADMIN_CLOSE'))              define('_TCMS_ADMIN_CLOSE', 'Lukk');
if(!defined('_TCMS_ADMIN_SAVE'))               define('_TCMS_ADMIN_SAVE', 'Lagre');
if(!defined('_TCMS_ADMIN_NO'))                 define('_TCMS_ADMIN_NO', 'Nei');
if(!defined('_TCMS_ADMIN_FTPUPLOAD'))          define('_TCMS_ADMIN_FTPUPLOAD', 'Opprett album fra ftp-opplastet bildemappe');

if(!defined('_TCMS_ADMIN_DELETE'))          define('_TCMS_ADMIN_DELETE', 'Slett');
if(!defined('_TCMS_ADMIN_UPLOAD'))          define('_TCMS_ADMIN_UPLOAD', 'Last opp');
if(!defined('_TCMS_ADMIN_INSTALL'))          define('_TCMS_ADMIN_INSTALL', 'Last opp &amp Installer');
if(!defined('_TCMS_ADMIN_SEND'))          define('_TCMS_ADMIN_SEND', 'Send');
if(!defined('_TCMS_ADMIN_VOTE'))          define('_TCMS_ADMIN_VOTE', 'Stem nå!');
if(!defined('_TCMS_ADMIN_NEW'))          define('_TCMS_ADMIN_NEW', 'Ny');
if(!defined('_TCMS_ADMIN_CREATE'))          define('_TCMS_ADMIN_CREATE', 'Legg til ny Album...');
if(!defined('_TCMS_ADMIN_NEW_POLL'))          define('_TCMS_ADMIN_NEW_POLL', 'Legg til ny Avstemming...');
if(!defined('_TCMS_ADMIN_NEW_ITEM'))          define('_TCMS_ADMIN_NEW_ITEM', 'Legg til element...');
if(!defined('_TCMS_ADMIN_NEW_USER'))          define('_TCMS_ADMIN_NEW_USER', 'Legg til ny Bruker...');
if(!defined('_TCMS_ADMIN_NEW_FTPALBUM'))          define('_TCMS_ADMIN_NEW_FTPALBUM', 'Legg til Album fra FTP mappe...');
if(!defined('_TCMS_ADMIN_NEW_CATEGORY'))          define('_TCMS_ADMIN_NEW_CATEGORY', 'Legg til Kategori...');
if(!defined('_TCMS_ADMIN_CONFIG'))          define('_TCMS_ADMIN_CONFIG', 'Konfigurer denne modulen');
if(!defined('_TCMS_ADMIN_LIST'))          define('_TCMS_ADMIN_LIST', 'Vis elementer');
if(!defined('_TCMS_ADMIN_NEWPAGE'))          define('_TCMS_ADMIN_NEWPAGE', 'VEIVISER: Opprett ny side for din webside');
if(!defined('_TCMS_ADMIN_UPDATE'))          define('_TCMS_ADMIN_UPDATE', 'Oppdater');
if(!defined('_TCMS_ADMIN_VER'))          define('_TCMS_ADMIN_VER', 'Versjon');
if(!defined('_TCMS_ADMIN_DEV'))          define('_TCMS_ADMIN_DEV', 'utviklet av');
if(!defined('_TCMS_ADMIN_RIGHT'))          define('_TCMS_ADMIN_RIGHT', 'Alle rettigheter reservert.');
if(!defined('_TCMS_ADMIN_LOGED'))          define('_TCMS_ADMIN_LOGED', 'Logget inn som');
if(!defined('_TCMS_ADMIN_GOTOSITE'))          define('_TCMS_ADMIN_GOTOSITE', 'Gå til din webside');


if(!defined('_TCMS_TOP_OF_PAGE'))          define('_TCMS_TOP_OF_PAGE', 'Gå til toppen av denne siden ...');
if(!defined('_TCMS_PRINT_PAGE'))          define('_TCMS_PRINT_PAGE', 'Skriv ut denne siden ...');
if(!defined('_TCMS_PDF_PAGE'))          define('_TCMS_PDF_PAGE', 'Generer PDF av denne siden ...');
if(!defined('_TCMS_PRINT_NOW'))          define('_TCMS_PRINT_NOW', 'Skriv ut');
if(!defined('_TCMS_COLOR_CHOOSER'))          define('_TCMS_COLOR_CHOOSER', 'Fargevelger');
if(!defined('_TCMS_MONTH_JANUARY'))          define('_TCMS_MONTH_JANUARY', 'Januar');
if(!defined('_TCMS_MONTH_FEBUARY'))          define('_TCMS_MONTH_FEBUARY', 'Febuar');
if(!defined('_TCMS_MONTH_MARCH'))          define('_TCMS_MONTH_MARCH', 'Mars');
if(!defined('_TCMS_MONTH_APRIL'))          define('_TCMS_MONTH_APRIL', 'April');
if(!defined('_TCMS_MONTH_MAY'))          define('_TCMS_MONTH_MAY', 'Mai');
if(!defined('_TCMS_MONTH_JUNE'))          define('_TCMS_MONTH_JUNE', 'Juni');
if(!defined('_TCMS_MONTH_JULY'))          define('_TCMS_MONTH_JULY', 'Juli');
if(!defined('_TCMS_MONTH_AUGUST'))          define('_TCMS_MONTH_AUGUST', 'August');
if(!defined('_TCMS_MONTH_SEPTEMBER'))          define('_TCMS_MONTH_SEPTEMBER', 'September');
if(!defined('_TCMS_MONTH_OCTOBER'))          define('_TCMS_MONTH_OCTOBER', 'Oktober');
if(!defined('_TCMS_MONTH_NOVEMBER'))          define('_TCMS_MONTH_NOVEMBER', 'November');
if(!defined('_TCMS_MONTH_DECEMBER'))          define('_TCMS_MONTH_DECEMBER', 'Desember');
if(!defined('_TCMS_DAY_MONDAY'))          define('_TCMS_DAY_MONDAY', 'Mandag');
if(!defined('_TCMS_DAY_TUESDAY'))          define('_TCMS_DAY_TUESDAY', 'Tirsdag');
if(!defined('_TCMS_DAY_WEDNESDAY'))          define('_TCMS_DAY_WEDNESDAY', 'Onsdag');
if(!defined('_TCMS_DAY_THURSDAY'))          define('_TCMS_DAY_THURSDAY', 'Torsdag');
if(!defined('_TCMS_DAY_FRIDAY'))          define('_TCMS_DAY_FRIDAY', 'Fredag');
if(!defined('_TCMS_DAY_SATURDAY'))          define('_TCMS_DAY_SATURDAY', 'L&oslash;rdag');
if(!defined('_TCMS_DAY_SUNDAY'))          define('_TCMS_DAY_SUNDAY', 'S&oslash;ndag');
if(!defined('_TCMS_DAY_MONDAY_XS'))          define('_TCMS_DAY_MONDAY_XS', 'Man');
if(!defined('_TCMS_DAY_TUESDAY_XS'))          define('_TCMS_DAY_TUESDAY_XS', 'Tirs');
if(!defined('_TCMS_DAY_WEDNESDAY_XS'))          define('_TCMS_DAY_WEDNESDAY_XS', 'Ons');
if(!defined('_TCMS_DAY_THURSDAY_XS'))          define('_TCMS_DAY_THURSDAY_XS', 'Tors');
if(!defined('_TCMS_DAY_FRIDAY_XS'))          define('_TCMS_DAY_FRIDAY_XS', 'Fre');
if(!defined('_TCMS_DAY_SATURDAY_XS'))          define('_TCMS_DAY_SATURDAY_XS', 'L&oslash;r');
if(!defined('_TCMS_DAY_SUNDAY_XS'))          define('_TCMS_DAY_SUNDAY_XS', 'S&oslash;n');
if(!defined('_TCMS_COLOR'))          define('_TCMS_COLOR', 'Farge');
if(!defined('_TCMS_TODAY'))          define('_TCMS_TODAY', 'Idag');
if(!defined('_TCMS_BACKGROUND'))          define('_TCMS_BACKGROUND', 'Bakgrunn');
if(!defined('_TCMS_BORDER'))          define('_TCMS_BORDER', 'Kant');
if(!defined('_TCMS_WEEKDAY'))          define('_TCMS_WEEKDAY', 'Ukedag');



// BACKEND TOPMENU
if(!defined('_TCMS_TOPMENU_MAIN'))          define('_TCMS_TOPMENU_MAIN', 'Hjem');
if(!defined('_TCMS_TOPMENU_MANAGE'))          define('_TCMS_TOPMENU_MANAGE', 'Administrere');
if(!defined('_TCMS_TOPMENU_NAVIGATION'))          define('_TCMS_TOPMENU_NAVIGATION', 'Navigasjon');
if(!defined('_TCMS_TOPMENU_SETTINGS'))          define('_TCMS_TOPMENU_SETTINGS', 'Instillinger');
if(!defined('_TCMS_TOPMENU_CONTENT'))          define('_TCMS_TOPMENU_CONTENT', 'Innhold');
if(!defined('_TCMS_TOPMENU_SIDEBAR'))          define('_TCMS_TOPMENU_SIDEBAR', 'Sidelinje');
if(!defined('_TCMS_TOPMENU_EXTENSIONS'))          define('_TCMS_TOPMENU_EXTENSIONS', 'Utvidelser');
if(!defined('_TCMS_TOPMENU_COMPONENTS'))          define('_TCMS_TOPMENU_COMPONENTS', 'Komponenter');
if(!defined('_TCMS_TOPMENU_SITE'))          define('_TCMS_TOPMENU_SITE', 'Webside');
if(!defined('_TCMS_TOPMENU_HELP'))          define('_TCMS_TOPMENU_HELP', 'Hjelp');



// TCMS
if(!defined('_TCMS_MENU_HOME'))          define('_TCMS_MENU_HOME', 'Hjem');
if(!defined('_TCMS_MENU_LOGOUT'))          define('_TCMS_MENU_LOGOUT', 'Logg ut');
if(!defined('_TCMS_MENU_PAGE'))          define('_TCMS_MENU_PAGE', 'Skrivebord');
if(!defined('_TCMS_MENU_FILE'))          define('_TCMS_MENU_FILE', 'Fil administrasjon');
if(!defined('_TCMS_MENU_MEDIA'))          define('_TCMS_MENU_MEDIA', 'Media administrasjon');
if(!defined('_TCMS_MENU_NEWS_CATEGORIES'))          define('_TCMS_MENU_NEWS_CATEGORIES', 'Nyhets Kategorier');
if(!defined('_TCMS_MENU_COMMENTS'))          define('_TCMS_MENU_COMMENTS', 'Kommentarer');
if(!defined('_TCMS_MENU_GUESTBOOK'))          define('_TCMS_MENU_GUESTBOOK', 'Innlegg i gjesteboken');
if(!defined('_TCMS_MENU_NOTE'))          define('_TCMS_MENU_NOTE', 'Notisblokk');
if(!defined('_TCMS_MENU_SIDEMENU'))          define('_TCMS_MENU_SIDEMENU', 'Sidemeny');
if(!defined('_TCMS_MENU_TOPMENU'))          define('_TCMS_MENU_TOPMENU', 'Topmeny');
if(!defined('_TCMS_MENU_MENUTITLE'))          define('_TCMS_MENU_MENUTITLE', 'Menutittel');
if(!defined('_TCMS_MENU_CONTENT'))          define('_TCMS_MENU_CONTENT', 'Dokumenter');
if(!defined('_TCMS_MENU_NEWS'))          define('_TCMS_MENU_NEWS', 'Nyheter');
if(!defined('_TCMS_MENU_DOWN'))          define('_TCMS_MENU_DOWN', 'Nedlastninger');
if(!defined('_TCMS_MENU_PRODUCTS'))          define('_TCMS_MENU_PRODUCTS', 'Produkter');
if(!defined('_TCMS_MENU_FAQ'))          define('_TCMS_MENU_FAQ', 'Kunnskapsbase');
if(!defined('_TCMS_MENU_SIDEEXT'))          define('_TCMS_MENU_SIDEEXT', 'Utvidelser');
if(!defined('_TCMS_MENU_SIDE'))          define('_TCMS_MENU_SIDE', 'Sidelinje');
if(!defined('_TCMS_MENU_NEWSLETTER'))          define('_TCMS_MENU_NEWSLETTER', 'Nyhetsbrev');
if(!defined('_TCMS_MENU_POLL'))          define('_TCMS_MENU_POLL', 'Avstemming');
if(!defined('_TCMS_MENU_EXT'))          define('_TCMS_MENU_EXT', 'Utvidelser');
if(!defined('_TCMS_MENU_FRONT'))          define('_TCMS_MENU_FRONT', 'Forside');
if(!defined('_TCMS_MENU_GALLERY'))          define('_TCMS_MENU_GALLERY', 'Bildegalleri');
if(!defined('_TCMS_MENU_LINK'))          define('_TCMS_MENU_LINK', 'Linker');
if(!defined('_TCMS_MENU_IMP'))          define('_TCMS_MENU_IMP', 'Publiseringsskjema');
if(!defined('_TCMS_MENU_CONTACT'))          define('_TCMS_MENU_CONTACT', 'Kontakter Manager');
if(!defined('_TCMS_MENU_USER'))          define('_TCMS_MENU_USER', 'Bruker Manager');
if(!defined('_TCMS_MENU_USERPAGE'))          define('_TCMS_MENU_USERPAGE', 'Editorside');
if(!defined('_TCMS_MENU_CFORM'))          define('_TCMS_MENU_CFORM', 'Kontaktskjema');
if(!defined('_TCMS_MENU_QBOOK'))          define('_TCMS_MENU_QBOOK', 'Gjestebok');
if(!defined('_TCMS_MENU_CS'))          define('_TCMS_MENU_CS', 'Komponent System');
if(!defined('_TCMS_MENU_CS_UPLOAD'))          define('_TCMS_MENU_CS_UPLOAD', 'Installer &amp; editer komponenter');
if(!defined('_TCMS_MENU_GLOBAL'))          define('_TCMS_MENU_GLOBAL', 'Global Konfigurasjon');
if(!defined('_TCMS_MENU_DB'))          define('_TCMS_MENU_DB', 'Database Konfigurasjon');
if(!defined('_TCMS_MENU_STATS'))          define('_TCMS_MENU_STATS', 'Statistikk');
if(!defined('_TCMS_MENU_THEME'))          define('_TCMS_MENU_THEME', 'Mal Manager');
if(!defined('_TCMS_MENU_THEME_UPLOAD'))          define('_TCMS_MENU_THEME_UPLOAD', 'Installer &amp; editer maler');
if(!defined('_TCMS_MENU_THEME_PREVIEW'))          define('_TCMS_MENU_THEME_PREVIEW', 'Forhåndsvisining');
if(!defined('_TCMS_MENU_COPY'))          define('_TCMS_MENU_COPY', 'Lisens');
if(!defined('_TCMS_MENU_CREDITS'))          define('_TCMS_MENU_CREDITS', 'Credits &amp; System');
if(!defined('_TCMS_MENU_DOCU'))          define('_TCMS_MENU_DOCU', 'Dokumentasjon');
if(!defined('_TCMS_MENU_HELP'))          define('_TCMS_MENU_HELP', 'Hjelp');
if(!defined('_TCMS_MENU_SUPPORT'))          define('_TCMS_MENU_SUPPORT', 'Support');
if(!defined('_TCMS_MENU_ABOUT_MODULE'))          define('_TCMS_MENU_ABOUT_MODULE', 'Om Modulen');
if(!defined('_TCMS_MENU_ABOUT'))          define('_TCMS_MENU_ABOUT', 'Om toendaCMS');
if(!defined('_TCMS_MENU_SEARCH'))          define('_TCMS_MENU_SEARCH', 'Søk');
if(!defined('_TCMS_MENU_IMPORT'))          define('_TCMS_MENU_IMPORT', 'Importer');



// MODULES
if(!defined('_MOD_HOME'))          define('_MOD_HOME', 'Hjem');
if(!defined('_MOD_PAGE'))          define('_MOD_PAGE', 'Skrivebord');
if(!defined('_MOD_EXPLORE'))          define('_MOD_EXPLORE', 'Fil manager - Utforsk dine filer');
if(!defined('_MOD_MEDIA'))          define('_MOD_MEDIA', 'Media Manager - Administrer dine mediafiler');
if(!defined('_MOD_NEWS_CATEGORIES'))          define('_MOD_NEWS_CATEGORIES', 'Administrer nyhetskategorier');
if(!defined('_MOD_COMMENTS'))          define('_MOD_COMMENTS', 'Administrer kommentarer');
if(!defined('_MOD_GUESTBOOK'))          define('_MOD_GUESTBOOK', 'Administrer Gjestebok Innlegg');
if(!defined('_MOD_NOTE'))          define('_MOD_NOTE', 'Notisblokk - Husk dine ideer\'s');
if(!defined('_MOD_NEWPAGE'))          define('_MOD_NEWPAGE', 'Opprett en ny side');
if(!defined('_MOD_SIDEMENU'))          define('_MOD_SIDEMENU', 'Sidemeny Manager');
if(!defined('_MOD_TOPMENU'))          define('_MOD_TOPMENU', 'Topmeny Manager');
if(!defined('_MOD_USERMENU'))          define('_MOD_USERMENU', 'Brukermeny Manager');
if(!defined('_MOD_MENUTITLE'))          define('_MOD_MENUTITLE', 'Menutittel Manager');
if(!defined('_MOD_CONTENT'))          define('_MOD_CONTENT', 'Dokument Manager');
if(!defined('_MOD_NEWS'))          define('_MOD_NEWS', 'Nyhets Manager');
if(!defined('_MOD_DOWN'))          define('_MOD_DOWN', 'Nedlastnings Manager');
if(!defined('_MOD_PRODUCTS'))          define('_MOD_PRODUCTS', 'Produkt Manager');
if(!defined('_MOD_SIDEBAR_EXTENSION'))          define('_MOD_SIDEBAR_EXTENSION', 'Konfigurasjon av sidelinje utvidelser.');
if(!defined('_MOD_SIDEBAR'))          define('_MOD_SIDEBAR', 'Sidelinje Innholds Manager');
if(!defined('_MOD_NEWSLETTER'))          define('_MOD_NEWSLETTER', 'Nyhetsbrev Manager');
if(!defined('_MOD_POLL'))          define('_MOD_POLL', 'Avstemming');
if(!defined('_MOD_EXTENSIONS'))          define('_MOD_EXTENSIONS', 'Konfigurasjon av  globale utvidelser');
if(!defined('_MOD_FRONTPAGE'))          define('_MOD_FRONTPAGE', 'Forside konfigurasjon');
if(!defined('_MOD_IMPRESSUM'))          define('_MOD_IMPRESSUM', 'Impressum Designer konfigurasjon');
if(!defined('_MOD_GALLERY'))          define('_MOD_GALLERY', 'Bildegalleri konfigurasjon');
if(!defined('_MOD_LINK'))          define('_MOD_LINK', 'Link Manager');
if(!defined('_MOD_KNOWLEDGEBASE'))          define('_MOD_KNOWLEDGEBASE', 'Kunnskapsdatabse');
if(!defined('_MOD_CONTACT'))          define('_MOD_CONTACT', 'Kontakt Manager');
if(!defined('_MOD_USER'))          define('_MOD_USER', 'Bruker Manager');
if(!defined('_MOD_USERPAGE'))          define('_MOD_USERPAGE', 'Editorside konfigurasjon');
if(!defined('_MOD_COMPONENTS'))          define('_MOD_COMPONENTS', 'Komponent System');
if(!defined('_MOD_COMPONENTS_UPLOAD'))          define('_MOD_COMPONENTS_UPLOAD', 'Komponent Install og Edit Manager');
if(!defined('_MOD_GLOBAL'))          define('_MOD_GLOBAL', 'Global konfigurasjon');
if(!defined('_MOD_IMPORT'))          define('_MOD_IMPORT', 'Importer');
if(!defined('_MOD_DB'))          define('_MOD_DB', 'Database konfigurasjon');
if(!defined('_MOD_STATS'))          define('_MOD_STATS', 'Webside Statistikk');
if(!defined('_MOD_TEMPLATE'))          define('_MOD_TEMPLATE', 'Mal Manager');
if(!defined('_MOD_TEMPLATE_UPLOAD'))          define('_MOD_TEMPLATE_UPLOAD', 'Mal Installering and Editerings Manager');
if(!defined('_MOD_LICENSE'))          define('_MOD_LICENSE', 'toendaCMS Lisens (GNU/GPL)');
if(!defined('_MOD_HELP'))          define('_MOD_HELP', 'Hjelp for ulike moduler instillinger');
if(!defined('_MOD_DOCU'))          define('_MOD_DOCU', 'Dokumentasjon');
if(!defined('_MOD_CREDITS'))          define('_MOD_CREDITS', 'Credits og Systeminformasjon');
if(!defined('_MOD_ABOUT_MODULE'))          define('_MOD_ABOUT_MODULE', 'toendaCMS Modul Beskrivelser');
if(!defined('_MOD_ABOUT'))          define('_MOD_ABOUT', 'Om toendaCMS');



// TABLES
if(!defined('_TABLE_TITLE'))          define('_TABLE_TITLE', 'Tittel');
if(!defined('_TABLE_SUBTITLE'))          define('_TABLE_SUBTITLE', 'Subtittel');
if(!defined('_TABLE_PUBLISH'))          define('_TABLE_PUBLISH', 'Publiserings Info');
if(!defined('_TABLE_TEXT'))          define('_TABLE_TEXT', 'Hoved tekst');
if(!defined('_TABLE_DEFAULT'))          define('_TABLE_DEFAULT', 'Default');
if(!defined('_TABLE_PUBLISHED'))          define('_TABLE_PUBLISHED', 'Publisert');
if(!defined('_TABLE_NOT_PUBLISHED'))          define('_TABLE_NOT_PUBLISHED', 'Ikke publisert');
if(!defined('_TABLE_PUBLISHING'))          define('_TABLE_PUBLISHING', 'Publiserer');
if(!defined('_TABLE_RSS'))          define('_TABLE_RSS', 'RSS Feed Link');
if(!defined('_TABLE_ENABLED'))          define('_TABLE_ENABLED', 'Aktivert');
if(!defined('_TABLE_NAME'))          define('_TABLE_NAME', 'Navn');
if(!defined('_TABLE_USERNAME'))          define('_TABLE_USERNAME', 'Brukernavn');
if(!defined('_TABLE_GROUP'))          define('_TABLE_GROUP', 'Brukergruppe');
if(!defined('_TABLE_PERSON'))          define('_TABLE_PERSON', 'Personlig Informasjon');
if(!defined('_TABLE_SUBID'))          define('_TABLE_SUBID', 'SUB ID');
if(!defined('_TABLE_ORDER'))          define('_TABLE_ORDER', 'ID');
if(!defined('_TABLE_TARGET'))          define('_TABLE_TARGET', 'Mål');
if(!defined('_TABLE_POS'))          define('_TABLE_POS', 'Posisjon');
if(!defined('_TABLE_IN_WORK'))          define('_TABLE_IN_WORK', 'Avsluttet');
if(!defined('_TABLE_IS_IN_WORK'))          define('_TABLE_IS_IN_WORK', 'I arbeid');
if(!defined('_TABLE_FUNCTIONS'))          define('_TABLE_FUNCTIONS', 'Funksjoner');
if(!defined('_TABLE_PARENT'))          define('_TABLE_PARENT', 'Topp Element for Submeny');
if(!defined('_TABLE_PARENTC'))          define('_TABLE_PARENTC', 'Vennligst velg');
if(!defined('_TABLE_PARENTN'))          define('_TABLE_PARENTN', 'Ingen submeny');
if(!defined('_TABLE_PARENTITEM'))          define('_TABLE_PARENTITEM', 'Foreldre objekt');
if(!defined('_TABLE_MENUINFO'))          define('_TABLE_MENUINFO', 'Du kan kun opprette submenyer i sidemenyen.');
if(!defined('_TABLE_AUTOR'))          define('_TABLE_AUTOR', 'Eier');
if(!defined('_TABLE_CATEGORY'))          define('_TABLE_CATEGORY', 'Kategori');
if(!defined('_TABLE_FILE'))          define('_TABLE_FILE', 'Fil');
if(!defined('_TABLE_FILE_EXISTS'))          define('_TABLE_FILE_EXISTS', 'Hvis filen eksisterer, må du skrive det fulle filnavnet. Vennligst tenk over dette før opplastning: Opprett en mappe med det samme navnet som filen, men uten filendelser som .zip og mellomrom må være underlinjer (_). Denne mappen vil bli brukt.');
if(!defined('_TABLE_FILE_OTHERURL'))          define('_TABLE_FILE_OTHERURL', 'Hvis det er en fil på en annen server, skriv inn den fulle adressen og navnet på filen (en mappe med dette navnet vil bli opprettet).');
if(!defined('_TABLE_FILE_EXISTS_NAME'))          define('_TABLE_FILE_EXISTS_NAME', 'Filen eksisterer');
if(!defined('_TABLE_FILE_OTHERURL_NAME'))          define('_TABLE_FILE_OTHERURL_NAME', 'Fil på en annen server');
if(!defined('_TABLE_DATE'))          define('_TABLE_DATE', 'Dato');
if(!defined('_TABLE_TIME'))          define('_TABLE_TIME', 'Tid');
if(!defined('_TABLE_EMAIL'))          define('_TABLE_EMAIL', 'Email');
if(!defined('_TABLE_OPTION'))          define('_TABLE_OPTION', 'Alternativ');
if(!defined('_TABLE_INFO'))          define('_TABLE_INFO', 'Informasjon');
if(!defined('_TABLE_ORDER_HELP'))          define('_TABLE_ORDER_HELP', '(Identifikasjons Number)');
if(!defined('_TABLE_ALBUM'))          define('_TABLE_ALBUM', 'Album');
if(!defined('_TABLE_DIR'))          define('_TABLE_DIR', 'Directory');
if(!defined('_TABLE_BACKENDFILE'))          define('_TABLE_BACKENDFILE', 'Backend fil');
if(!defined('_TABLE_FRONTENDFILE'))          define('_TABLE_FRONTENDFILE', 'Frontend fil');
if(!defined('_TABLE_SIDEBARFILE'))          define('_TABLE_SIDEBARFILE', 'Sidelinjefil');
if(!defined('_TABLE_SETTINGSFILE'))          define('_TABLE_SETTINGSFILE', 'Instillingsfil');
if(!defined('_TABLE_IMAGE'))          define('_TABLE_IMAGE', 'Bilde');
if(!defined('_TABLE_USE'))          define('_TABLE_USE', 'Bruk');
if(!defined('_TABLE_DELETE'))          define('_TABLE_DELETE', 'Slett');
if(!defined('_TABLE_DESCRIPTION'))          define('_TABLE_DESCRIPTION', 'Beskrivelse');
if(!defined('_TABLE_NEW'))          define('_TABLE_NEW', 'Nytt Innlegg');
if(!defined('_TABLE_EDIT'))          define('_TABLE_EDIT', 'Editer Innlegg');
if(!defined('_TABLE_DETAILS'))          define('_TABLE_DETAILS', 'Detaljer om innlegg');
if(!defined('_TABLE_GENERAL'))          define('_TABLE_GENERAL', 'Generell Informasjon');
if(!defined('_TABLE_FURTHER'))          define('_TABLE_FURTHER', 'Mer data');
if(!defined('_TABLE_SETTINGS'))          define('_TABLE_SETTINGS', 'Instillinger');
if(!defined('_TABLE_CONTACT'))          define('_TABLE_CONTACT', 'Kontakt Informasjon');
if(!defined('_TABLE_PRODUCTNO'))          define('_TABLE_PRODUCTNO', 'Artikel Number');
if(!defined('_TABLE_FACTORY'))          define('_TABLE_FACTORY', 'Produsent');
if(!defined('_TABLE_URL'))          define('_TABLE_URL', 'Webside');
if(!defined('_TABLE_STOCK'))          define('_TABLE_STOCK', 'I lager');
if(!defined('_TABLE_PRICE'))          define('_TABLE_PRICE', 'Pris');
if(!defined('_TABLE_TAX'))          define('_TABLE_TAX', 'med skatt');
if(!defined('_TABLE_QUANTITY'))          define('_TABLE_QUANTITY', 'Antall');
if(!defined('_TABLE_WEIGHT'))          define('_TABLE_WEIGHT', 'Vekt');
if(!defined('_TABLE_SAVEBUTTON'))          define('_TABLE_SAVEBUTTON', 'Lagre');
if(!defined('_TABLE_EDITBUTTON'))          define('_TABLE_EDITBUTTON', 'Editer');
if(!defined('_TABLE_DELBUTTON'))          define('_TABLE_DELBUTTON', 'Slett');
if(!defined('_TABLE_SETTINGSBUTTON'))          define('_TABLE_SETTINGSBUTTON', 'Instillinger');
if(!defined('_TABLE_ADMINBUTTON'))          define('_TABLE_ADMINBUTTON', 'Administrer');
if(!defined('_TABLE_ACCEPTBUTTON'))          define('_TABLE_ACCEPTBUTTON', 'Aksepter');
if(!defined('_TABLE_GOUPBUTTON'))          define('_TABLE_GOUPBUTTON', 'Gå opp');
if(!defined('_TABLE_ACCESS'))          define('_TABLE_ACCESS', 'Tilgangsnivå');
if(!defined('_TABLE_MACCESS'))          define('_TABLE_MACCESS', 'Tilgang');
if(!defined('_TABLE_LINKTO'))          define('_TABLE_LINKTO', 'Link til');
if(!defined('_TABLE_COMMENTS'))          define('_TABLE_COMMENTS', 'Kommentarer');
if(!defined('_TABLE_LINK'))          define('_TABLE_LINK', 'CID');
if(!defined('_TABLE_PUBLIC'))          define('_TABLE_PUBLIC', 'Public (For alle gjester)');
if(!defined('_TABLE_PROTECTED'))          define('_TABLE_PROTECTED', 'Beskyttet (Kun for registrerte brukere)');
if(!defined('_TABLE_PRIVATE'))          define('_TABLE_PRIVATE', 'Privat (Ikke for brukere og gjester)');
if(!defined('_TABLE_WHICHMENU'))          define('_TABLE_WHICHMENU', 'Innlegg i hvilken meny?');
if(!defined('_TABLE_SIDEMENU'))          define('_TABLE_SIDEMENU', 'Sidemeny');
if(!defined('_TABLE_TOPMENU'))          define('_TABLE_TOPMENU', 'Toppmeny');
if(!defined('_TABLE_USERMENU'))          define('_TABLE_USERMENU', 'Brukermeny');
if(!defined('_TABLE_CHARSET'))          define('_TABLE_CHARSET', 'Tegnset');
if(!defined('_TABLE_ALIAS'))          define('_TABLE_ALIAS', 'Aliaser');
if(!defined('_TABLE_LEFT'))          define('_TABLE_LEFT', 'Venstre');
if(!defined('_TABLE_RIGHT'))          define('_TABLE_RIGHT', 'Høyre');
if(!defined('_TABLE_CENTER'))          define('_TABLE_CENTER', 'Midten');
if(!defined('_TABLE_TYPE'))          define('_TABLE_TYPE', 'Type');
if(!defined('_TABLE_MENUTITLE'))          define('_TABLE_MENUTITLE', 'Menytittel');
if(!defined('_TABLE_MENULINK'))          define('_TABLE_MENULINK', 'Link');
if(!defined('_TABLE_MENUWEB'))          define('_TABLE_MENUWEB', 'Weblink');
if(!defined('_TABLE_REORDER'))          define('_TABLE_REORDER', 'Sorter på nytt');
if(!defined('_TABLE_DEFAULT_NEWS_CATEGORY'))          define('_TABLE_DEFAULT_NEWS_CATEGORY', 'Standard nyhetskategori');
if(!defined('_TABLE_MAIN_CS'))          define('_TABLE_MAIN_CS', 'Komponent for Hovedside');
if(!defined('_TABLE_SIDE_CS'))          define('_TABLE_SIDE_CS', 'Komponent for Sidelinje');
if(!defined('_TABLE_START'))          define('_TABLE_START', 'Start');
if(!defined('_TABLE_PREVIOUS'))          define('_TABLE_PREVIOUS', 'Forrige');
if(!defined('_TABLE_NEXT'))          define('_TABLE_NEXT', 'Neste');
if(!defined('_TABLE_END'))          define('_TABLE_END', 'Slutt');
if(!defined('_TABLE_DISPLAY'))          define('_TABLE_DISPLAY', 'Vis');
if(!defined('_TABLE_A_PAGE'))          define('_TABLE_A_PAGE', 'en side');
if(!defined('_TABLE_OF'))          define('_TABLE_OF', 'av');
if(!defined('_TABLE_ENABLED_THIS'))          define('_TABLE_ENABLED_THIS', 'Aktiver');
if(!defined('_TABLE_DISABLED_THIS'))          define('_TABLE_DISABLED_THIS', 'Deaktiver');
if(!defined('_TABLE_IP'))          define('_TABLE_IP', 'IP');
if(!defined('_TABLE_DOMAIN'))          define('_TABLE_DOMAIN', 'Domene');
if(!defined('_TABLE_SIDEBAR'))          define('_TABLE_SIDEBAR', 'Sidelinje');
if(!defined('_TABLE_MAINCONTENT'))          define('_TABLE_MAINCONTENT', 'Hovedside');
if(!defined('_TABLE_BOTH'))          define('_TABLE_BOTH', 'Boegge');
if(!defined('_TABLE_FILTER'))          define('_TABLE_FILTER', 'Filter og instillinger');
if(!defined('_TABLE_SORT_SIDE'))          define('_TABLE_SORT_SIDE', 'Sidelinje Posisjon');
if(!defined('_TABLE_LOCATION'))          define('_TABLE_LOCATION', 'Lokalisjon');
if(!defined('_TABLE_DATES'))          define('_TABLE_DATES', 'Datoer');
if(!defined('_TABLE_HELPBROWSER'))          define('_TABLE_HELPBROWSER', 'toendaCSM Hjelp');
if(!defined('_TABLE_LINKBROWSER'))          define('_TABLE_LINKBROWSER', 'Linkutforsker');
if(!defined('_TABLE_LINKBROWSER_TEXT'))          define('_TABLE_LINKBROWSER_TEXT', 'Klikk på knappen for å bruke linken i dokumentet ditt. Du kan skrive inn en tittel i tekstboksen for å navngi linken.');
if(!defined('_TABLE_LINKBROWSER_TEXT_TINYMCE'))          define('_TABLE_LINKBROWSER_TEXT_TINYMCE', '<strong>tinyMCE:</strong> Du må ha markert en tekst for å endre det til en link.');
if(!defined('_TABLE_IMAGEBROWSER'))          define('_TABLE_IMAGEBROWSER', 'Mediautforsker');
if(!defined('_TABLE_IMAGEBROWSER_TEXT'))          define('_TABLE_IMAGEBROWSER_TEXT', 'Klikk på knappen for å bruke mediafilene i dokumentet ditt.');
if(!defined('_TABLE_DIARY_RSS'))          define('_TABLE_DIARY_RSS', 'Dagbok RSS feeds');
if(!defined('_TABLE_DIARY_TICKET'))          define('_TABLE_DIARY_TICKET', 'Tickets');
if(!defined('_TABLE_IMPORT'))          define('_TABLE_IMPORT', 'Importer');
if(!defined('_TABLE_SORT'))          define('_TABLE_SORT', 'Sortering');
if(!defined('_TABLE_SORT_DESC'))          define('_TABLE_SORT_DESC', 'Sorter synkende');
if(!defined('_TABLE_SORT_ASC'))          define('_TABLE_SORT_ASC', 'Sorter stigende');
if(!defined('_TABLE_VIEW'))          define('_TABLE_VIEW', 'Vis');


// MESSAGES
if(!defined('_DIE_LOGIN'))          define('_DIE_LOGIN', 'Du må logge deg inn!<br /><a href="index.php">Logg inn</a>');
if(!defined('_MSG_NOINFO'))          define('_MSG_NOINFO', '[INGEN INFORMASJON TILGJENGELIG]');
if(!defined('_MSG_SAVED'))          define('_MSG_SAVED', 'Lagring utført.');
if(!defined('_MSG_SAVED_FAILED'))          define('_MSG_SAVED_FAILED', 'Klart ikke å lagre.');
if(!defined('_MSG_SEND'))          define('_MSG_SEND', 'Sending utført.');
if(!defined('_MSG_NOTWRITABLE'))          define('_MSG_NOTWRITABLE', 'ER IKKE SKRIVBAR!');
if(!defined('_MSG_NOINSTALL'))          define('_MSG_NOINSTALL', 'Vennligst installer først!');
if(!defined('_MSG_GOTOINSTALL'))          define('_MSG_GOTOINSTALL', 'GÅ TIL INSTALLASJON');
if(!defined('_MSG_RM_INSTALLDIR'))          define('_MSG_RM_INSTALLDIR', 'Vennligst fjern installasjonsmappe!');
if(!defined('_MSG_PAGE_LOAD_1'))          define('_MSG_PAGE_LOAD_1', 'Siden generert på');
if(!defined('_MSG_PAGE_LOAD_2'))          define('_MSG_PAGE_LOAD_2', 'sekunder');
if(!defined('_MSG_NOIMAGE'))          define('_MSG_NOIMAGE', 'Ingen bilde er valgt.');
if(!defined('_MSG_IMAGE'))          define('_MSG_IMAGE', 'Bilde ble lastet opp til');
if(!defined('_MSG_NONAME'))          define('_MSG_NONAME', 'Vennligst skriv inn ditt navn');
if(!defined('_MSG_NOCAPTCHA'))          define('_MSG_NOCAPTCHA', 'Vennligst skriv inn koden i bildet');
if(!defined('_MSG_CAPTCHA_NOT_VALID'))          define('_MSG_CAPTCHA_NOT_VALID', 'Koden som ble skrevet inn er ikke den samme som koden i bildet');
if(!defined('_MSG_FALSEPASSWORD'))          define('_MSG_FALSEPASSWORD', 'Feil passord!');
if(!defined('_MSG_PASSWORDNOTVALID'))          define('_MSG_PASSWORDNOTVALID', 'Passordet er ikke gyldig!');
if(!defined('_MSG_NOPASSWORD'))          define('_MSG_NOPASSWORD', 'Passordene er ikke gyldig!');
if(!defined('_MSG_NOEMAIL'))          define('_MSG_NOEMAIL', 'Ingen email adresse ble oppgitt');
if(!defined('_MSG_EMAILVALID'))          define('_MSG_EMAILVALID', 'Email adresse er ikke gyldig');
if(!defined('_MSG_DELETE'))          define('_MSG_DELETE', 'Sletting utført.');
if(!defined('_MSG_DELETE_SUBMIT'))          define('_MSG_DELETE_SUBMIT', 'Er du sikker på at du vil slette dette innlegget?');
if(!defined('_MSG_DELETE_INACTIVE'))          define('_MSG_DELETE_INACTIVE', 'Sletting ble ikke utført. Innlegget var ikke aktivert ved å velge hakeboksen.');
if(!defined('_MSG_NOSUBJECT'))          define('_MSG_NOSUBJECT', 'Vennligst oppgi en overskrift');
if(!defined('_MSG_NOMSG'))          define('_MSG_NOMSG', 'Vennligst skriv inn beskjeden');
if(!defined('_MSG_NEWSLETTER'))          define('_MSG_NEWSLETTER', 'Du har med suksess abonnert på vårt nyhetsbrev.');
if(!defined('_MSG_POLL'))          define('_MSG_POLL', 'Takk for din stemme i denne avstemmingen.');
if(!defined('_MSG_UPLOAD'))          define('_MSG_UPLOAD', 'Filen lastet opp til');
if(!defined('_MSG_NOUPLOAD'))          define('_MSG_NOUPLOAD', 'Filen kan ikke lastes opp.');
if(!defined('_MSG_REGNOTALLOWD'))          define('_MSG_REGNOTALLOWD', 'Ingen registrering er tillatt.');
if(!defined('_MSG_NOACCOUNT'))          define('_MSG_NOACCOUNT', 'Ingen konto.');
if(!defined('_MSG_NOCONTENT'))          define('_MSG_NOCONTENT', 'Vennligst fyll ut alle feltene.');
if(!defined('_MSG_USERNOTEXISTS'))          define('_MSG_USERNOTEXISTS', 'Brukeren finnes ikke.');
if(!defined('_MSG_USEREXISTS'))          define('_MSG_USEREXISTS', 'Brukernavnet finnes fra før, venngligst velg en ny.');
if(!defined('_MSG_ERROR'))          define('_MSG_ERROR', 'Error');
if(!defined('_MSG_CODE'))          define('_MSG_CODE', 'Kode');
if(!defined('_MSG_PHP_UPLOAD_SETTINGS'))          define('_MSG_PHP_UPLOAD_SETTINGS', 'PHP opplastningsinstillinger er ikke tilstrekkelig for denne funksjonen.');
if(!defined('_MSG_PHP_SAFE_MODE_SETTINGS'))    define('_MSG_PHP_SAFE_MODE_SETTINGS', 'PHP bruker \'safe_mode\' på din server, du kan ikke bruke denne funksjonen.');
if(!defined('_MSG_MAX_FILE_SIZE'))          define('_MSG_MAX_FILE_SIZE', 'Max filstørrelse');
if(!defined('_MSG_FILE_UPLOADS'))          define('_MSG_FILE_UPLOADS', 'Fil opplastninger');
if(!defined('_MSG_NOTENOUGH_USERRIGHTS'))          define('_MSG_NOTENOUGH_USERRIGHTS', 'Du har ikke tilstrekkelig rettigheter til å bruke denne side.');
if(!defined('_MSG_SESSION_EXPIRED'))          define('_MSG_SESSION_EXPIRED', '<div align="center"><h1>Din session er utløpt!</h1><br /><strong>Vennligst logg inn på nytt.</strong><br /><a href="index.php">Logg inn</a></div>');
if(!defined('_MSG_NOT_FINALIZED'))          define('_MSG_NOT_FINALIZED', 'Dokumentet ditt er ikke avsluttet. Vil du publisere den også?');
if(!defined('_MSG_NOT_PUBLISHED'))          define('_MSG_NOT_PUBLISHED', 'Det valgte dokumentet er ikke publisert. Du kan ikke lese den!!');
if(!defined('_MSG_DISABLED_MODUL'))          define('_MSG_DISABLED_MODUL', 'Den valgte modulen er deaktivert. Du kan ikke bruke den!!');
if(!defined('_MSG_CHANGE_DATABASE_ENGINE'))          define('_MSG_CHANGE_DATABASE_ENGINE', 'Er du sikker på at du vil endre databasen?\nDu bør være logget av og kan ikke bruke dataene dine i en annen database.\nBeklager, en XML - SQL Import funksjon er planlagt...');
if(!defined('_MSG_IF_DOWNLOAD_DOES_NOT_START'))          define('_MSG_IF_DOWNLOAD_DOES_NOT_START', 'Hvis nedlastningen ikke starter, klikk følgende link');
if(!defined('_MSG_BACKUP_SUCCESSFULL'))          define('_MSG_BACKUP_SUCCESSFULL', 'Backup av databasen var vellykket.\nPåvirkede tabeller:');
if(!defined('_MSG_BACKUP_FAILED'))          define('_MSG_BACKUP_FAILED', 'Det oppsto en feil under backup av databasen!');



// LOGIN
if(!defined('_LOGIN_MSG'))          define('_LOGIN_MSG', 'Innlogging');
if(!defined('_LOGIN_USERNAME'))          define('_LOGIN_USERNAME', 'Brukernavn');
if(!defined('_LOGIN_USERNAME_JS'))          define('_LOGIN_USERNAME_JS', 'Vennligst skriv inn ditt brukernavn!');
if(!defined('_LOGIN_PASSWORD'))          define('_LOGIN_PASSWORD', 'Passord');
if(!defined('_LOGIN_PASSWORD_JS'))          define('_LOGIN_PASSWORD_JS', 'Vennligst skriv inn ditt passord!');
if(!defined('_LOGIN_FALSE'))          define('_LOGIN_FALSE', 'Feil brukernavn, passord eller brukerrettigheter (Gruppe)');
if(!defined('_LOGIN_FALSE_LPW'))          define('_LOGIN_FALSE_LPW', 'Feil brukernavn eller email');
if(!defined('_LOGIN_SUBMIT'))          define('_LOGIN_SUBMIT', 'Logg inn');
if(!defined('_LOGIN_LOGOUT'))          define('_LOGIN_LOGOUT', 'Logg ut');
if(!defined('_LOGIN_PROFILE'))          define('_LOGIN_PROFILE', 'Profil');
if(!defined('_LOGIN_LIST'))          define('_LOGIN_LIST', 'Medlemsliste');
if(!defined('_LOGIN_LIST_TEXT'))          define('_LOGIN_LIST_TEXT', 'Dette er listen med alle medlemmene. Du kan klikke brukernavnet for å vise profilen.');
if(!defined('_LOGIN_ADMIN'))          define('_LOGIN_ADMIN', 'Administrasjon');
if(!defined('_LOGIN_FORGOTPW'))          define('_LOGIN_FORGOTPW', 'Glemt passordet?');
if(!defined('_LOGIN_WELCOME'))          define('_LOGIN_WELCOME', 'Velkommen');
if(!defined('_LOGIN_SUBMIT_NEWS'))          define('_LOGIN_SUBMIT_NEWS', 'Send nyheter');
if(!defined('_LOGIN_SUBMIT_IMAGES'))          define('_LOGIN_SUBMIT_IMAGES', 'Send bilder');
if(!defined('_LOGIN_CREATE_ALBUM'))          define('_LOGIN_CREATE_ALBUM', 'Opprett album');
if(!defined('_LOGIN_CREATE_CATEGORY'))          define('_LOGIN_CREATE_CATEGORY', 'Opprett kategori');
if(!defined('_LOGIN_SUBMIT_MEDIA'))          define('_LOGIN_SUBMIT_MEDIA', 'Send media');


// REGISTRATION
if(!defined('_REG_TITLE'))          define('_REG_TITLE', 'Registrering');
if(!defined('_REG_LPW'))          define('_REG_LPW', 'Mistet passordet?');
if(!defined('_REG_LPWTEXT'))          define('_REG_LPWTEXT', 'Vennligst skriv inn ditt brukernavn og emailadresse og klikk på Send Passord knappen. Du vil bli tilsendt et nytt passord straks. Bruk det nye passordet til å få adgang til websiden.');
if(!defined('_REG_TEXT_1'))          define('_REG_TEXT_1', 'Felter med punkt er obligatoriske.');
if(!defined('_REG_TEXT_2'))          define('_REG_TEXT_2', 'Felter uten punkt er opsjonale');
if(!defined('_REG_SUBMIT_LPW'))          define('_REG_SUBMIT_LPW', 'Send Passord');
if(!defined('_REG_SUBMIT_SR'))          define('_REG_SUBMIT_SR', 'Send Registrering');
if(!defined('_REG_PWNOTAGREE'))          define('_REG_PWNOTAGREE', 'Passordene stemmer ikke!');
if(!defined('_REG_NAME_NG'))          define('_REG_NAME_NG', 'Navn er ikke oppgitt!');
if(!defined('_REG_USERNAME_NG'))          define('_REG_USERNAME_NG', 'Brukernavn er ikke oppgitt!');
if(!defined('_REG_PASSWORD_NG'))          define('_REG_PASSWORD_NG', 'Passord er ikke oppgitt!');
if(!defined('_REG_EMAIL_NG'))          define('_REG_EMAIL_NG', 'Email er ikke oppgitt!');
if(!defined('_REG_LPW_SUCCESS'))          define('_REG_LPW_SUCCESS', 'Ditt nye passord');
if(!defined('_REG_SUCCESS'))          define('_REG_SUCCESS', 'Din registrering var vellykket');
if(!defined('_REG_NO_SUCCESS'))          define('_REG_NO_SUCCESS', 'Din registrering var ikke vellykket');
if(!defined('_REG_SUCCESS_TEXT'))          define('_REG_SUCCESS_TEXT', 'Din registrering var vellykket. Klikk på linken og du vil ha tilgang til websiden.');
if(!defined('_REG_AUTO_MSG'))                  define('_REG_AUTO_MSG', 'Dette er en automatisk beskjed fra');
if(!defined('_REG_TEXT_LPW'))                  define('_REG_TEXT_LPW', 'Du har bedt om et nytt passord. Her er den nye.');
if(!defined('_REG_VALIDATE'))                  define('_REG_VALIDATE', 'Gratulerer, du er nå registrert. Du kan logge inn på websiden med ditt brukernavn og passord.');
if(!defined('_REG_NO_VALIDATE'))          define('_REG_NO_VALIDATE', 'Valideringskoden din er ugyldig.');
if(!defined('_REG_USERPROFILE'))          define('_REG_USERPROFILE', 'Tips: Du kan endre instillinger som passord, brukernavn og annet i profilen din.');
if(!defined('_REG_EMAIL'))          define('_REG_EMAIL', 'En ny bruker er blitt registrert.');
if(!defined('_REG_SUCCESS_MAIL'))          define('_REG_SUCCESS_MAIL', 'En ny bruker er blitt registrert på din webside.');



// PROFILE
if(!defined('_PROFILE_TITLE'))                 define('_PROFILE_TITLE', 'Viser brukerprofil');
if(!defined('_PROFILE_EDIT'))                  define('_PROFILE_EDIT', 'Endre brukerprofil');


// USERPAGES
if(!defined('_USERPAGE'))          define('_USERPAGE', 'Editorsider');
if(!defined('_USERPAGE_TEXT'))          define('_USERPAGE_TEXT', 'Du kan sette opp instillinger for brukersider som profiler fra editorside konfigurasjonen. Du kan også gjøre det mulig å publisere nyheter, bilder og galleri albumer.');
if(!defined('_USERPAGE_TEXT_WIDTH'))          define('_USERPAGE_TEXT_WIDTH', 'Tekstfelt bredde');
if(!defined('_USERPAGE_INPUT_WIDTH'))          define('_USERPAGE_INPUT_WIDTH', 'Inputfelt bredde');
if(!defined('_USERPAGE_PUBLISH_NEWS'))          define('_USERPAGE_PUBLISH_NEWS', 'Bruker kan publisere nyheter fra forsiden');
if(!defined('_USERPAGE_PUBLISH_IMAGES'))          define('_USERPAGE_PUBLISH_IMAGES', 'Bruker kan publisere bilder fra forsiden');
if(!defined('_USERPAGE_PUBLISH_ALBUMS'))          define('_USERPAGE_PUBLISH_ALBUMS', 'Bruker kan publisere album fra forsiden');
if(!defined('_USERPAGE_CREATE_CATEGORIES'))          define('_USERPAGE_CREATE_CATEGORIES', 'Bruker kan opprette nyhetskategorier fra forsiden');
if(!defined('_USERPAGE_PUBLISH_PICTURE'))          define('_USERPAGE_PUBLISH_PICTURE', 'Bruker kan publisere bilder til media manager fra forsiden');


// START
if(!defined('_START_MSG'))          define('_START_MSG', 'Velkommen');
if(!defined('_START_QUESTION'))          define('_START_QUESTION', 'Hva vil du gjøre idag?');
if(!defined('_START_TEXT_0'))          define('_START_TEXT_0', '<strong>Ta en titt på skrivebordet</strong> På skrivebordet kan du se alle åpne oppgaver, notater og en overblikk over alle dokumenter og nyheter som er uferdige.');
if(!defined('_START_TEXT_1'))          define('_START_TEXT_1', '<strong>Opprett en side.</strong> For å gjøre dette, opprett et menyinnlegg og editer det statiske innholdet og sidelinje innholdet.');
if(!defined('_START_TEXT_2'))          define('_START_TEXT_2', '<strong>Editer systeminstillinger.</strong> Du kan endre navn og tittelen til websiden din og editere metatager.');
if(!defined('_START_TEXT_3'))          define('_START_TEXT_3', '<strong>Skriv nyheter.</strong> Gå til nyhetsmanageren og skriv nyheter om deg selv eller ditt firma.');
if(!defined('_START_TEXT_4'))          define('_START_TEXT_4', '<strong>Last opp et bilde til bildegalleriet.</strong> Vis folk dine meninger og morro &oslash;yeblikk.');


// DESKTOP
if(!defined('_DESKTOP_TOP_TEXT'))          define('_DESKTOP_TOP_TEXT', 'Hvis du vil endre innholdet i en side, så klikk sidetittelen i menytreet til venstre.');
if(!defined('_DESKTOP_UNPUBLISHED_NEWS'))          define('_DESKTOP_UNPUBLISHED_NEWS', 'Upubliserte nyheter');
if(!defined('_DESKTOP_UNPUBLISHED_PAGES'))          define('_DESKTOP_UNPUBLISHED_PAGES', 'Upubliserte dokumenter');
if(!defined('_DESKTOP_UNFINISHED_PAGES'))          define('_DESKTOP_UNFINISHED_PAGES', 'Uferdige dokumenter');


// SIDEMENU
if(!defined('_SIDEMENU_TITLE'))                define('_SIDEMENU_TITLE', 'Sidemeny-linker');
if(!defined('_SIDEMENU_TEXT'))                 define('_SIDEMENU_TEXT', 'Her kan du opprette hovedmenyen. ID-en er sorteringsordningen i menyen, SUB ID er ordningen i undermenyen og CID identifiserer innholdet eller utvidelsessider å lenke til. Du kan endre hvert enkelt innlegg ved å klikke på dem.');


// COMPONENTS SYSTEM
if(!defined('_CS_TITLE'))                      define('_CS_TITLE', 'Systemkomponenter');
if(!defined('_CS_TEXT'))                       define('_CS_TEXT', 'Denne listen viser alle dine installerte komponenter. Herfra kan du endre deres instillinger.');


// TOPMENU
if(!defined('_TOPMENU_TITLE'))                 define('_TOPMENU_TITLE', 'Toppmenylinker');
if(!defined('_TOPMENU_TEXT'))                  define('_TOPMENU_TEXT', 'Her kan du opprette en toppmeny. ID-en er sorteringsordningen på menyen, CID identifiserer innholdet eller utvidelsessider å lenke til.');


// MENUTITLE
if(!defined('_MENUTITLE_TITLE'))               define('_MENUTITLE_TITLE', 'Menytittel');
if(!defined('_MENUTITLE_TEXT'))                define('_MENUTITLE_TEXT', 'Posisjonsnummeret bestemmer plasseringen på menyen.');


// CONTENT
if(!defined('_CONTENT_TITLE'))          define('_CONTENT_TITLE', 'Vis sider med statisk innhold');
if(!defined('_CONTENT_TEXT'))          define('_CONTENT_TEXT', 'ID-nummeret er det nummeret du trenger for å linke til siden.');
if(!defined('_CONTENT_TEXT_PAGE'))          define('_CONTENT_TEXT_PAGE', 'Skriv innholdet her. Tittel på siden, en eventuell undertittel, selve teksten og en fotnote om det &oslash;nskes.');
if(!defined('_CONTENT_TEMPLATE'))          define('_CONTENT_TEMPLATE', 'Innholdsmal');
if(!defined('_CONTENT_SECOND'))          define('_CONTENT_SECOND', 'Sekunder tekst');
if(!defined('_CONTENT_OLDIMAGE'))          define('_CONTENT_OLDIMAGE', 'Gammel bilde');
if(!defined('_CONTENT_IMAGEUNDER'))          define('_CONTENT_IMAGEUNDER', 'Bildet under teksten');
if(!defined('_CONTENT_IMAGERIGHT'))          define('_CONTENT_IMAGERIGHT', 'Bilde til høyre for teksten');
if(!defined('_CONTENT_FOOT'))          define('_CONTENT_FOOT', 'Fotnote');
if(!defined('_CONTENT_NEXT_PAGE'))          define('_CONTENT_NEXT_PAGE', 'Neste side');
if(!defined('_CONTENT_LAST_PAGE'))          define('_CONTENT_LAST_PAGE', 'Siste side');
if(!defined('_CONTENT_BACK_PAGE'))          define('_CONTENT_BACK_PAGE', 'En side tilbake');
if(!defined('_CONTENT_FIRST_PAGE'))          define('_CONTENT_FIRST_PAGE', 'Første side');
if(!defined('_CONTENT_LAST_UPDATE'))          define('_CONTENT_LAST_UPDATE', 'Sist oppdatert');


// IMPRESSUM
if(!defined('_IMPRESSUM_CONFIG'))          define('_IMPRESSUM_CONFIG', 'Impressum konfigurasjon');
if(!defined('_IMPRESSUM_ID'))          define('_IMPRESSUM_ID', 'ID');
if(!defined('_IMPRESSUM_TITLE'))          define('_IMPRESSUM_TITLE', 'Impressum tittel');
if(!defined('_IMPRESSUM_SUBTITLE'))          define('_IMPRESSUM_SUBTITLE', 'Impressum undertittel');
if(!defined('_IMPRESSUM_CONTACT'))          define('_IMPRESSUM_CONTACT', 'Kontaktperson');
if(!defined('_IMPRESSUM_NO_CONTACT'))          define('_IMPRESSUM_NO_CONTACT', 'Ingen kontaktperson');
if(!defined('_IMPRESSUM_SELECT'))          define('_IMPRESSUM_SELECT', 'Vennligst velg');
if(!defined('_IMPRESSUM_TAX'))          define('_IMPRESSUM_TAX', 'Skatt');
if(!defined('_IMPRESSUM_UST'))          define('_IMPRESSUM_UST', 'Ust. Id.');
if(!defined('_IMPRESSUM_LEGAL'))          define('_IMPRESSUM_LEGAL', 'Lovlig');
if(!defined('_IMPRESSUM_PHONE'))          define('_IMPRESSUM_PHONE', 'Telefon');
if(!defined('_IMPRESSUM_FAX'))          define('_IMPRESSUM_FAX', 'Fax');
if(!defined('_IMPRESSUM_CONTACTPERSON'))          define('_IMPRESSUM_CONTACTPERSON', 'Kontakt person');
if(!defined('_IMPRESSUM_OFFICE'))          define('_IMPRESSUM_OFFICE', 'Kontor');
if(!defined('_IMPRESSUM_EMAIL'))          define('_IMPRESSUM_EMAIL', 'Email');
if(!defined('_IMPRESSUM_COPY'))          define('_IMPRESSUM_COPY', 'Alle rettigheter reservert.');
if(!defined('_IMPRESSUM_SITECOPY'))          define('_IMPRESSUM_SITECOPY', 'Websidens innhold beskyttet i henhold til opphavslov. Copyright (C)');


// SIDEBAR
if(!defined('_SIDE_TEXT'))                     define('_SIDE_TEXT', 'ID-nummeret brukes til å lenke alle sidene.');
if(!defined('_SIDE_CONTACTS'))                 define('_SIDE_CONTACTS', 'Kontakter');


// HELP
if(!defined('_HELP_SUPPORTED_CHARSETS'))       define('_HELP_SUPPORTED_CHARSETS', 'Støttede tegnsett');


// GROUPS
if(!defined('_GROUP_DEV'))                     define('_GROUP_DEV', 'Utvikler og vedlikeholder');
if(!defined('_GROUP_ADMIN'))                   define('_GROUP_ADMIN', 'Administrator');
if(!defined('_GROUP_EDITOR'))                  define('_GROUP_EDITOR', 'Redigerere');
if(!defined('_GROUP_PRESENTER'))               define('_GROUP_PRESENTER', 'Forum ansvarlig');
if(!defined('_GROUP_USER'))                    define('_GROUP_USER', 'Bruker av websiden');


// TCMS SCRIPT
if(!defined('_TCMSSCRIPT_BR'))                 define('_TCMSSCRIPT_BR', 'Linjeskift');
if(!defined('_TCMSSCRIPT_MORE'))               define('_TCMSSCRIPT_MORE', 'Egendefinert nyhetsstop for forsiden');
if(!defined('_TCMSSCRIPT_IMAGES'))             define('_TCMSSCRIPT_IMAGES', 'Utforsk bilder');


// GLOBAL ID
if(!defined('_NEWPAGE_TITLE'))                 define('_NEWPAGE_TITLE', 'Opprett en ny side');
if(!defined('_NEWPAGE_TEXT'))                  define('_NEWPAGE_TEXT', 'Med denne dialogen kan du opprette en ny side. Velg en tittel, meny, hvis du vil, en undermeny og tilgangsnivå.');


// EXPLORER
if(!defined('_EXPLORE_UP'))                    define('_EXPLORE_UP', 'Flytt innlegg opp.');
if(!defined('_EXPLORE_DOWN'))                  define('_EXPLORE_DOWN', 'Flytt innlegg ned.');


// NOTEBOOK
if(!defined('_NOTEBOOK_TITLE'))          define('_NOTEBOOK_TITLE', 'Personlig Notatblokk');
if(!defined('_NOTEBOOK_TEXT'))          define('_NOTEBOOK_TEXT', 'Dette er din personlige notatblokk. Her kan du skrive din arbeidsplan og dine ideer fremover. Dette er det bare du som ser.');
if(!defined('_NOTEBOOK_DETAIL'))          define('_NOTEBOOK_DETAIL', 'Din notatblokk');
if(!defined('_NOTEBOOK_MSG'))          define('_NOTEBOOK_MSG', 'Din personlige notatblokk trenger oppsyn');


// EXTENSIONS
if(!defined('_EXT_NEWS'))          define('_EXT_NEWS', 'Nyhetsmanager');
if(!defined('_EXT_NEWS_NEWSAMOUNT'))          define('_EXT_NEWS_NEWSAMOUNT', 'Antall nyheter i nyhetsmanageren (ikke i arkiv)');
if(!defined('_EXT_NEWS_ID'))          define('_EXT_NEWS_ID', 'ID');
if(!defined('_EXT_NEWS_TITLE'))          define('_EXT_NEWS_TITLE', 'Nyhetsside tittel');
if(!defined('_EXT_NEWS_SUBTITLE'))          define('_EXT_NEWS_SUBTITLE', 'Nyhetsside undertittel');
if(!defined('_EXT_NEWS_IMAGE'))          define('_EXT_NEWS_IMAGE', 'Nyhetsside bilde');
if(!defined('_EXT_NEWS_USE_COMMENTS'))          define('_EXT_NEWS_USE_COMMENTS', 'Bruk nyhetskommentar');
if(!defined('_EXT_NEWS_USE_EMOTICONS'))          define('_EXT_NEWS_USE_EMOTICONS', 'Bruk smileys i kommentarer');
if(!defined('_EXT_NEWS_USE_GRAVATAR'))          define('_EXT_NEWS_USE_GRAVATAR', 'Bruk gravatar for brukere');
if(!defined('_EXT_NEWS_USE_AUTOR'))          define('_EXT_NEWS_USE_AUTOR', 'Vis nyhetsforfatter');
if(!defined('_EXT_NEWS_USE_AUTOR_LINK'))          define('_EXT_NEWS_USE_AUTOR_LINK', 'Vis nyhetsforfatter som en link');
if(!defined('_EXT_NEWS_D_TIMESINCE'))          define('_EXT_NEWS_D_TIMESINCE', 'Tid siden');
if(!defined('_EXT_NEWS_D_DATE'))          define('_EXT_NEWS_D_DATE', 'Normal Dato');
if(!defined('_EXT_NEWS_D_TEXT'))          define('_EXT_NEWS_D_TEXT', 'Tekst representasjon');
if(!defined('_EXT_NEWS_DISPLAY'))          define('_EXT_NEWS_DISPLAY', 'Representasjon av datoen');
if(!defined('_EXT_NEWS_SELECT'))          define('_EXT_NEWS_SELECT', 'Vennligst velg');
if(!defined('_EXT_NEWS_DESELECT'))          define('_EXT_NEWS_DESELECT', 'Ingen bilde');
if(!defined('_EXT_NEWS_USE_FEEDS'))          define('_EXT_NEWS_USE_FEEDS', 'Bruk Syndication (Feeds)');
if(!defined('_EXT_NEWS_USE_RSS091'))          define('_EXT_NEWS_USE_RSS091', 'Bruk RSS 0.91');
if(!defined('_EXT_NEWS_USE_RSS10'))          define('_EXT_NEWS_USE_RSS10', 'Bruk RSS 1.0');
if(!defined('_EXT_NEWS_USE_RSS20'))          define('_EXT_NEWS_USE_RSS20', 'Bruk RSS 2.0');
if(!defined('_EXT_NEWS_USE_ATOM03'))          define('_EXT_NEWS_USE_ATOM03', 'Bruk ATOM 0.3');
if(!defined('_EXT_NEWS_USE_OPML'))          define('_EXT_NEWS_USE_OPML', 'Bruk OPML');
if(!defined('_EXT_NEWS_SYN_AMOUNT'))          define('_EXT_NEWS_SYN_AMOUNT', 'Antall nyheter i feed');
if(!defined('_EXT_NEWS_USE_SYN_TITLE'))          define('_EXT_NEWS_USE_SYN_TITLE', 'Bruk Syndication tittel i sidelinje');
if(!defined('_EXT_NEWS_DEFAULT_FEED'))          define('_EXT_NEWS_DEFAULT_FEED', 'Standard syndication feed');
if(!defined('_EXT_NEWS_USE_TRACKBACK'))          define('_EXT_NEWS_USE_TRACKBACK', 'Bruk trackback');
if(!defined('_EXT_CFORM'))          define('_EXT_CFORM', 'Kontakt skjema');
if(!defined('_EXT_CFORM_SHOW_CONTACTS_IN_SIDEBAR'))          define('_EXT_CFORM_SHOW_CONTACTS_IN_SIDEBAR', 'Vis kontakter i sidelinje');
if(!defined('_EXT_CFORM_USE_ADRESSBOOK'))          define('_EXT_CFORM_USE_ADRESSBOOK', 'Bruk adressebok');
if(!defined('_EXT_CFORM_USE_CONTACTPERSON'))          define('_EXT_CFORM_USE_CONTACTPERSON', 'Vis kontaktperson');
if(!defined('_EXT_CFORM_EMAIL'))          define('_EXT_CFORM_EMAIL', 'Email');
if(!defined('_EXT_CFORM_ID'))          define('_EXT_CFORM_ID', 'ID');
if(!defined('_EXT_CFORM_TITLE'))          define('_EXT_CFORM_TITLE', 'Kontaktskjema tittel');
if(!defined('_EXT_CFORM_SUBTITLE'))          define('_EXT_CFORM_SUBTITLE', 'Kontaktskjema undertittel');
if(!defined('_EXT_BOOK'))          define('_EXT_BOOK', 'Gjestebok');
if(!defined('_EXT_BOOK_ID'))          define('_EXT_BOOK_ID', 'ID');
if(!defined('_EXT_BOOK_TITLE'))          define('_EXT_BOOK_TITLE', 'Gjestebok tittel');
if(!defined('_EXT_BOOK_SUBTITLE'))          define('_EXT_BOOK_SUBTITLE', 'Gjestebok undertittel');
if(!defined('_EXT_BOOK_ADMINPASS'))          define('_EXT_BOOK_ADMINPASS', 'Administrasjons Passord');
if(!defined('_EXT_BOOK_ADMINUSER'))          define('_EXT_BOOK_ADMINUSER', 'Administrasjons Brukernavn');
if(!defined('_EXT_BOOK_ADMINCOLOR'))          define('_EXT_BOOK_ADMINCOLOR', 'Administration Textcolor');
if(!defined('_EXT_BOOK_ENTRYCOLOR'))          define('_EXT_BOOK_ENTRYCOLOR', 'Farge på innleggsnummer');
if(!defined('_EXT_DOWNLOAD'))          define('_EXT_DOWNLOAD', 'Nedlastningsmanager konfigurasjon');
if(!defined('_EXT_DOWNLOAD_ID'))          define('_EXT_DOWNLOAD_ID', 'ID');
if(!defined('_EXT_DOWNLOAD_TITLE'))          define('_EXT_DOWNLOAD_TITLE', 'Nedlastningsmanager tittel');
if(!defined('_EXT_DOWNLOAD_SUBTITLE'))          define('_EXT_DOWNLOAD_SUBTITLE', 'Nedlastningsmanager undertittel');
if(!defined('_EXT_DOWNLOAD_TEXT'))          define('_EXT_DOWNLOAD_TEXT', 'Nedlastningsmanager text');


// GALLERY
if(!defined('_GALLERY_CONFIG'))          define('_GALLERY_CONFIG', 'Konfigurasjon av bildegalleri');
if(!defined('_GALLERY_ID'))          define('_GALLERY_ID', 'ID');
if(!defined('_GALLERY_COMMENTS'))          define('_GALLERY_COMMENTS', 'Bruk kommentarer');
if(!defined('_GALLERY_FRONT_TITLE'))          define('_GALLERY_FRONT_TITLE', 'Galleri tittel');
if(!defined('_GALLERY_FRONT_SUBTITLE'))          define('_GALLERY_FRONT_SUBTITLE', 'Galleri undertittel');
if(!defined('_GALLERY_CREATE'))          define('_GALLERY_CREATE', 'Opprett et nytt album');
if(!defined('_GALLERY_NEW'))          define('_GALLERY_NEW', 'Ny album');
if(!defined('_GALLERY_DESCRIPTION'))          define('_GALLERY_DESCRIPTION', 'Beskrivelse');
if(!defined('_GALLERY_TITLE'))          define('_GALLERY_TITLE', 'Galleri');
if(!defined('_GALLERY_THISIS'))          define('_GALLERY_THISIS', 'Dette er');
if(!defined('_GALLERY_THISIS2'))          define('_GALLERY_THISIS2', 'album');
if(!defined('_GALLERY_THISIS3'))          define('_GALLERY_THISIS3', 'Last opp eller slett bildene dine eller editer beskrivelser. Men lagre kun en beskrivelse om gangen.');
if(!defined('_GALLERY_IMGTITLE'))          define('_GALLERY_IMGTITLE', 'Tittel');
if(!defined('_GALLERY_IMGSIZE'))          define('_GALLERY_IMGSIZE', 'Filstørrelse');
if(!defined('_GALLERY_IMGRESOLUTION'))          define('_GALLERY_IMGRESOLUTION', 'Oppløsning');
if(!defined('_GALLERY_AMOUNT'))          define('_GALLERY_AMOUNT', 'Antall');
if(!defined('_GALLERY_IMG_DETAILS'))          define('_GALLERY_IMG_DETAILS', 'Bruk bildedetaljer');
if(!defined('_GALLERY_FTP_UPLOAD'))          define('_GALLERY_FTP_UPLOAD', 'Alle tilgjengelige album');
if(!defined('_GALLERY_FTP_UPLOAD_TEXT'))          define('_GALLERY_FTP_UPLOAD_TEXT', 'Om du har lastet opp ett bildgalleri med din FTP klient til "data/images/albums/" kan du konvertere det til et toendaCMS galleri. Velg et album å konvertere til et toendaCMS galleri');
if(!defined('_GALLERY_UPLOAD'))          define('_GALLERY_UPLOAD', 'Last opp bilder');
if(!defined('_GALLERY_TEXT'))          define('_GALLERY_TEXT', 'Om du har et pakket album (.zip) kan du laste det opp og senere konvertere det.');
if(!defined('_GALLERY_ZTITLE'))          define('_GALLERY_ZTITLE', 'Last opp og installer kabinettfil.');
if(!defined('_GALLERY_ZFILE'))          define('_GALLERY_ZFILE', 'Kabinett fil (.zip)');
if(!defined('_GALLERY_POSTED'))          define('_GALLERY_POSTED', 'Lastet opp den');
if(!defined('_GALLERY_GRAVATAR'))          define('_GALLERY_GRAVATAR', 'Her kan du endre instillingene for bildegalleriet. Men hvis du vil aktivere / deaktivere gravatar ikon eller støtte for smilys, gå til <a href="admin.php?id_user='.( isset($id_user) ? $id_user : '' ).'&amp;site=mod_news&amp;todo=config">nyhetsmanager instillinger</a>');
if(!defined('_GALLERY_LAST_SHOW'))          define('_GALLERY_LAST_SHOW', 'Vis nyeste bilder i sidemeny');
if(!defined('_GALLERY_LAST_SHOW_TITLE'))          define('_GALLERY_LAST_SHOW_TITLE', 'Vis tittel på nye bilder');
if(!defined('_GALLERY_LAST_MAX_IMG'))          define('_GALLERY_LAST_MAX_IMG', 'Hvor mange bilder');
if(!defined('_GALLERY_LAST_SIZE'))          define('_GALLERY_LAST_SIZE', 'Størrelse på bildene');
if(!defined('_GALLERY_LAST_TEXT'))          define('_GALLERY_LAST_TEXT', 'Tekst for nye bilder');
if(!defined('_GALLERY_LAST_ALIGN'))          define('_GALLERY_LAST_ALIGN', 'Justering av nye bilder');
if(!defined('_GALLERY_LIST_NORMAL'))          define('_GALLERY_LIST_NORMAL', 'Normal bildeliste (en under den andre, med informasjonen)');
if(!defined('_GALLERY_LIST_3_THUMB'))          define('_GALLERY_LIST_3_THUMB', 'Miniatyrbilder side ved side');


// PERSON
if(!defined('_PERSON_NAME'))          define('_PERSON_NAME', 'Navn');
if(!defined('_PERSON_USERNAME'))          define('_PERSON_USERNAME', 'Brukernavn');
if(!defined('_PERSON_POSITION'))          define('_PERSON_POSITION', 'Posisjon');
if(!defined('_PERSON_OCCUPATION'))          define('_PERSON_OCCUPATION', 'Jobb');
if(!defined('_PERSON_GROUP'))          define('_PERSON_GROUP', 'Brukergruppe');
if(!defined('_PERSON_JOINDATE'))          define('_PERSON_JOINDATE', 'Ble medlem');
if(!defined('_PERSON_RIGHTS'))          define('_PERSON_RIGHTS', 'Brukerrettigheter');
if(!defined('_PERSON_EMAIL'))          define('_PERSON_EMAIL', 'Email Adresse');
if(!defined('_PERSON_PASSWORD'))          define('_PERSON_PASSWORD', 'Passord');
if(!defined('_PERSON_AS_MD5'))          define('_PERSON_AS_MD5', 'MD5 Streng');
if(!defined('_PERSON_VPASSWORD'))          define('_PERSON_VPASSWORD', 'Bekreft Passord');
if(!defined('_PERSON_STREET'))          define('_PERSON_STREET', 'Gate');
if(!defined('_PERSON_STATE'))          define('_PERSON_STATE', 'Stat');
if(!defined('_PERSON_TOWN'))          define('_PERSON_TOWN', 'By');
if(!defined('_PERSON_COUNTRY'))          define('_PERSON_COUNTRY', 'Land');
if(!defined('_PERSON_POSTAL'))          define('_PERSON_POSTAL', 'Zip kode');
if(!defined('_PERSON_PHONE'))          define('_PERSON_PHONE', 'Telefon');
if(!defined('_PERSON_FAX'))          define('_PERSON_FAX', 'Fax');
if(!defined('_PERSON_DETAILS'))          define('_PERSON_DETAILS', 'Dine detaljer');
if(!defined('_PERSON_WWW'))          define('_PERSON_WWW', 'Hjemmeside');
if(!defined('_PERSON_ICQ'))          define('_PERSON_ICQ', 'ICQ Number');
if(!defined('_PERSON_AIM'))          define('_PERSON_AIM', 'AIM Name');
if(!defined('_PERSON_YIM'))          define('_PERSON_YIM', 'YIM Messenger');
if(!defined('_PERSON_MSN'))          define('_PERSON_MSN', 'MSN Messenger');
if(!defined('_PERSON_BIRTHDAY'))          define('_PERSON_BIRTHDAY', 'Fødelsesdag');
if(!defined('_PERSON_SEX'))          define('_PERSON_SEX', 'Kjønn');
if(!defined('_PERSON_SEX_MAN'))          define('_PERSON_SEX_MAN', 'Mann');
if(!defined('_PERSON_SEX_WOMAN'))          define('_PERSON_SEX_WOMAN', 'Kvinne');
if(!defined('_PERSON_SEX_KA'))          define('_PERSON_SEX_KA', 'Ingen informasjon');
if(!defined('_PERSON_TCMS_ENABLED'))          define('_PERSON_TCMS_ENABLED', 'toendaScript aktivert');
if(!defined('_PERSON_SIGNATURE'))          define('_PERSON_SIGNATURE', 'Underskrift');
if(!defined('_PERSON_HOBBY'))          define('_PERSON_HOBBY', 'Interesser');
if(!defined('_PERSON_LOCATION'))          define('_PERSON_LOCATION', 'Bosted');
if(!defined('_PERSON_LASTLOGIN'))          define('_PERSON_LASTLOGIN', 'Siste innlogging');



// SIDE EXTENSIONS
if(!defined('_SIDEEXT_SIDEMENU'))          define('_SIDEEXT_SIDEMENU', 'Sidemenyu');
if(!defined('_SIDEEXT_SIDEMENU_TITLE'))          define('_SIDEEXT_SIDEMENU_TITLE', 'Sidemeny Tittel');
if(!defined('_SIDEEXT_SIDEMENU_SHOW'))          define('_SIDEEXT_SIDEMENU_SHOW', 'Vis Sidemeny Tittel');
if(!defined('_SIDEEXT_SIDEBAR'))          define('_SIDEEXT_SIDEBAR', 'Sidelinje');
if(!defined('_SIDEEXT_SIDEBAR_SHOW_TITLE'))          define('_SIDEEXT_SIDEBAR_SHOW_TITLE', 'Vis sidelinje tittel');
if(!defined('_SIDEEXT_SIDEBAR_TITLE'))          define('_SIDEEXT_SIDEBAR_TITLE', 'Sidelinje tittel');
if(!defined('_SIDEEXT_SIDEBAR_SHOW'))          define('_SIDEEXT_SIDEBAR_SHOW', 'Vis sidelinje');
if(!defined('_SIDEEXT_TC'))          define('_SIDEEXT_TC', 'Mal velger');
if(!defined('_SIDEEXT_TC_SHOW_TITLE'))          define('_SIDEEXT_TC_SHOW_TITLE', 'Vis Mal Velger tittel');
if(!defined('_SIDEEXT_TC_TITLE'))          define('_SIDEEXT_TC_TITLE', 'Mal Vegler tittel');
if(!defined('_SIDEEXT_TC_SHOW'))          define('_SIDEEXT_TC_SHOW', 'Vis Mal Velger');
if(!defined('_SIDEEXT_SEARCH'))          define('_SIDEEXT_SEARCH', 'Søk');
if(!defined('_SIDEEXT_SEARCH_SHOW_TITLE'))          define('_SIDEEXT_SEARCH_SHOW_TITLE', 'Vis Søk tittel');
if(!defined('_SIDEEXT_SEARCH_TITLE'))          define('_SIDEEXT_SEARCH_TITLE', 'Søk tittel');
if(!defined('_SIDEEXT_SEARCH_RESULT_TITLE'))          define('_SIDEEXT_SEARCH_RESULT_TITLE', 'Søkeresultat tittel');
if(!defined('_SIDEEXT_SEARCH_ALIGNMENT'))          define('_SIDEEXT_SEARCH_ALIGNMENT', 'Søkeboks justering');
if(!defined('_SIDEEXT_SEARCH_WITH_BR'))          define('_SIDEEXT_SEARCH_WITH_BR', 'Søkeknapp under');
if(!defined('_SIDEEXT_SEARCH_WITH_BUTTON'))          define('_SIDEEXT_SEARCH_WITH_BUTTON', 'Vis søkeknapp');
if(!defined('_SIDEEXT_SEARCH_WORD'))          define('_SIDEEXT_SEARCH_WORD', 'Søkeord i søkefelt');
if(!defined('_SIDEEXT_SEARCH_SHOW'))          define('_SIDEEXT_SEARCH_SHOW', 'Vis Søk');
if(!defined('_SIDEEXT_LOGIN'))          define('_SIDEEXT_LOGIN', 'Innlogging');
if(!defined('_SIDEEXT_LOGIN_TITLE'))          define('_SIDEEXT_LOGIN_TITLE', 'Innlogging tittel');
if(!defined('_SIDEEXT_USERM_TITLE'))          define('_SIDEEXT_USERM_TITLE', 'Brukermeny tittel');
if(!defined('_SIDEEXT_LOGIN_SHOW'))          define('_SIDEEXT_LOGIN_SHOW', 'Vis innlogging');
if(!defined('_SIDEEXT_LOGIN_USER'))          define('_SIDEEXT_LOGIN_USER', 'Innlogging felt brukernavn');
if(!defined('_SIDEEXT_LOGIN_PASS'))          define('_SIDEEXT_LOGIN_PASS', 'Innlogging felt passord');
if(!defined('_SIDEEXT_LOGIN_ACCOUNT'))          define('_SIDEEXT_LOGIN_ACCOUNT', 'Tekst for INGEN KONTO');
if(!defined('_SIDEEXT_LOGIN_REG'))          define('_SIDEEXT_LOGIN_REG', 'Registrering link');
if(!defined('_SIDEEXT_LOGIN_MENU'))          define('_SIDEEXT_LOGIN_MENU', 'Bruk brukermeny');
if(!defined('_SIDEEXT_LOGIN_ALLOW'))          define('_SIDEEXT_LOGIN_ALLOW', 'Tillat registrering');
if(!defined('_SIDEEXT_LOGIN_SHOW_TITLE'))          define('_SIDEEXT_LOGIN_SHOW_TITLE', 'Vis innloggingstittel');
if(!defined('_SIDEEXT_LOGIN_SHOW_MEMBERLIST'))          define('_SIDEEXT_LOGIN_SHOW_MEMBERLIST', 'Vis medlemsliste');
if(!defined('_SIDEEXT_NEWS'))          define('_SIDEEXT_NEWS', 'Nyheter');
if(!defined('_SIDEEXT_NEWS_CATEGORIES_SHOW'))          define('_SIDEEXT_NEWS_CATEGORIES_SHOW', 'Vis nyhetskategorier');
if(!defined('_SIDEEXT_NEWS_ARCHIVES_SHOW'))          define('_SIDEEXT_NEWS_ARCHIVES_SHOW', 'Vis nyhetsarkiver');
if(!defined('_SIDEEXT_NEWS_CATEGORIES_AMOUNT_SHOW'))          define('_SIDEEXT_NEWS_CATEGORIES_AMOUNT_SHOW', 'Vis antall nyheter i kategorier');
if(!defined('_SIDEEXT_MODUL'))          define('_SIDEEXT_MODUL', 'Moduler');


// NEWSLETTER
if(!defined('_NL_CONFIG'))          define('_NL_CONFIG', 'Nyhetsbrev Konfigurasjon');
if(!defined('_NL_TITLE'))          define('_NL_TITLE', 'Nyhetsbrev tittel');
if(!defined('_NL_SHOW_TITLE'))          define('_NL_SHOW_TITLE', 'Vis nyhetsbrev tittel');
if(!defined('_NL_TEXT'))          define('_NL_TEXT', 'Nyhetsbrev tekst');
if(!defined('_NL_SUBMIT'))          define('_NL_SUBMIT', 'Nyhetsbrev send knapp');
if(!defined('_NL_SHOW'))          define('_NL_SHOW', 'Bruk byhetsbrev');
if(!defined('_NL_SEND'))          define('_NL_SEND', 'Send nyhetsbrevr');
if(!defined('_NL_SUBJECT'))          define('_NL_SUBJECT', 'Emne');
if(!defined('_NL_MESSAGE'))          define('_NL_MESSAGE', 'Beskjed');
if(!defined('_NL_USER'))          define('_NL_USER', 'Vis alle nyhetsbrev brukere');
if(!defined('_NL_NEWUSER'))          define('_NL_NEWUSER', 'Opprett en ny nyhetsbrev bruker.');
if(!defined('_NL_EDITUSER'))          define('_NL_EDITUSER', 'Rediger nyhetsbrev bruker.');
if(!defined('_NL_USERNAME'))          define('_NL_USERNAME', 'ditt navn her');
if(!defined('_NL_USEREMAIL'))          define('_NL_USEREMAIL', 'din@email.her');
if(!defined('_NL_MAILMESSAGE'))          define('_NL_MAILMESSAGE', 'Hvis du ikke vil ha nyhetsbrevet i fremtiden, svar med');
if(!defined('_NL_CHECKSTRING'))          define('_NL_CHECKSTRING', 'INGEN NYHETSBREV TAKK');
if(!defined('_NL_CHECKFORUNSUBSCRIBE'))          define('_NL_CHECKFORUNSUBSCRIBE', 'Sjekk email for abonnementer som har sagt opp');
if(!defined('_NL_CHECK'))          define('_NL_CHECK', 'Sjekk');
if(!defined('_NL_MAILSCHECKED'))          define('_NL_MAILSCHECKED', 'email er sjekket ...');
if(!defined('_NL_CHECKTITLE'))          define('_NL_CHECKTITLE', 'Sjekk email for ');
if(!defined('_NL_CHECKTEXT'))          define('_NL_CHECKTEXT', 'Din emailkonto blir nå sjekket for emner som har strengen for å si opp abonnementet. Hvis det blir funnet en slik mail og brukeren finnes, blir brukeren fjernet fra listen.');

// USER
if(!defined('_USER_TITLE'))                    define('_USER_TITLE', 'Vis brukere');
if(!defined('_USER_TEXT'))                     define('_USER_TEXT', 'Her er alle dine brukere listet, administratorer i tillegg.');
if(!defined('_USER_SELF'))                     define('_USER_SELF', 'Eget brukernavn');
if(!defined('_USER_ALL'))                      define('_USER_ALL', 'Alle brukere');


// CONTACTS
if(!defined('_CONTACT_TITLE'))          define('_CONTACT_TITLE', 'Vis kontakter');
if(!defined('_CONTACT_TEXT'))          define('_CONTACT_TEXT', 'Her er alle dine kontakter listet. Noen av disse vises på kontakt siden.');
if(!defined('_CONTACT_ADRESS_BOOK'))          define('_CONTACT_ADRESS_BOOK', 'Adresse Bok');
if(!defined('_CONTACT_ADRESS_EMAIL'))          define('_CONTACT_ADRESS_EMAIL', 'Kontakt email');
if(!defined('_CONTACT_SEND_A_EMAIL'))          define('_CONTACT_SEND_A_EMAIL', 'Send en email');
if(!defined('_CONTACT_DETAIL'))          define('_CONTACT_DETAIL', 'Kontakt detaljer');


// GLOBALS
if(!defined('_GLOBAL_CONFIG'))          define('_GLOBAL_CONFIG', 'Webside konfigurasjon');
if(!defined('_GLOBAL_TITLE'))          define('_GLOBAL_TITLE', 'Webside tittel');
if(!defined('_GLOBAL_NAME'))          define('_GLOBAL_NAME', 'Webside navn');
if(!defined('_GLOBAL_SUBTITLE'))          define('_GLOBAL_SUBTITLE', 'Webside undertittel');
if(!defined('_GLOBAL_LOGO'))          define('_GLOBAL_LOGO', 'Webside logo');
if(!defined('_GLOBAL_OWNER'))          define('_GLOBAL_OWNER', 'Webside eier');
if(!defined('_GLOBAL_URL'))          define('_GLOBAL_URL', 'Webside URL');
if(!defined('_GLOBAL_TCMSLOGO'))          define('_GLOBAL_TCMSLOGO', 'Vis toendaCMS Logo i fotnote');
if(!defined('_GLOBAL_TCMSLOGO_IN_SITETITLE'))          define('_GLOBAL_TCMSLOGO_IN_SITETITLE', 'Vis toendaCMS navn i sidetittel');
if(!defined('_GLOBAL_PAGELOADINGTIME'))          define('_GLOBAL_PAGELOADINGTIME', 'Vis tid brukt til å laste opp en side i fotnoten');
if(!defined('_GLOBAL_EMAIL'))          define('_GLOBAL_EMAIL', 'Standard emailadresse');
if(!defined('_GLOBAL_YEAR'))          define('_GLOBAL_YEAR', 'Copyright år');
if(!defined('_GLOBAL_CHARSET'))          define('_GLOBAL_CHARSET', 'Tegnsett');
if(!defined('_GLOBAL_LANG'))          define('_GLOBAL_LANG', 'Språk for administrasjonsrammeverk');
if(!defined('_GLOBAL_FRONT_LANG'))          define('_GLOBAL_FRONT_LANG', 'Webside språk');
if(!defined('_GLOBAL_WYSIWYG'))          define('_GLOBAL_WYSIWYG', 'Bruk WYSIWYG-Editor');
if(!defined('_GLOBAL_SITE_NAVI'))          define('_GLOBAL_SITE_NAVI', 'Navigering');
if(!defined('_GLOBAL_SITE_NAVI_TOP'))          define('_GLOBAL_SITE_NAVI_TOP', 'Topp Meny');
if(!defined('_GLOBAL_SITE_NAVI_SIDE'))          define('_GLOBAL_SITE_NAVI_SIDE', 'Side Meny');
if(!defined('_GLOBAL_META'))          define('_GLOBAL_META', 'Metadata for HTML hode');
if(!defined('_GLOBAL_METATAGS'))          define('_GLOBAL_METATAGS', 'Metadata');
if(!defined('_GLOBAL_DESCRIPTION'))          define('_GLOBAL_DESCRIPTION', 'Beskrivelse');
if(!defined('_GLOBAL_CURRENCY'))          define('_GLOBAL_CURRENCY', 'Valuta');
if(!defined('_GLOBAL_LEGAL_LINK_IN_FOOTER'))          define('_GLOBAL_LEGAL_LINK_IN_FOOTER', 'Vis legal link i fotnote');
if(!defined('_GLOBAL_ADMIN_LINK_IN_FOOTER'))          define('_GLOBAL_ADMIN_LINK_IN_FOOTER', 'Vis admin link i fotnote');
if(!defined('_GLOBAL_DEFAULT_FOOTER'))          define('_GLOBAL_DEFAULT_FOOTER', 'Vis toendaCMS standard fotnote');
if(!defined('_GLOBAL_ACTIVE_TOPMENU_LINKS'))          define('_GLOBAL_ACTIVE_TOPMENU_LINKS', 'Bruk CSS classer for aktive toppmeny linker');
if(!defined('_GLOBAL_FOOTER_TEXT'))          define('_GLOBAL_FOOTER_TEXT', 'Egen webside fotnote tekst');
if(!defined('_GLOBAL_MAIL_SETTINGS'))          define('_GLOBAL_MAIL_SETTINGS', 'Email');
if(!defined('_GLOBAL_MAIL_SERVER'))          define('_GLOBAL_MAIL_SERVER', 'Mailserver POP3');
if(!defined('_GLOBAL_MAIL_PORT'))          define('_GLOBAL_MAIL_PORT', 'Mailserver port');
if(!defined('_GLOBAL_MAIL_POP3'))          define('_GLOBAL_MAIL_POP3', 'POP3');
if(!defined('_GLOBAL_MAIL_USER'))          define('_GLOBAL_MAIL_USER', 'Email brukernavn');
if(!defined('_GLOBAL_MAIL_PASSWORD'))          define('_GLOBAL_MAIL_PASSWORD', 'Email passord');
if(!defined('_GLOBAL_USE_STATISTICS'))          define('_GLOBAL_USE_STATISTICS', 'Bruk statistikk');
if(!defined('_GLOBAL_USE_NEW_ADMINMENU'))          define('_GLOBAL_USE_NEW_ADMINMENU', 'Bruk ny adminmeny');
if(!defined('_GLOBAL_SEO'))          define('_GLOBAL_SEO', 'SEO URL');
if(!defined('_GLOBAL_SEO_ENABLED'))          define('_GLOBAL_SEO_ENABLED', 'SEO aktivert');
if(!defined('_GLOBAL_SEO_FOLDER'))          define('_GLOBAL_SEO_FOLDER', 'toendaCMS mappe på server');
if(!defined('_GLOBAL_SEO_FORMAT'))          define('_GLOBAL_SEO_FORMAT', 'SEO Format');
if(!defined('_GLOBAL_SITE_OFFLINE'))          define('_GLOBAL_SITE_OFFLINE', 'Websiden offline?');
if(!defined('_GLOBAL_SITE_OFFLINE_TEXT'))          define('_GLOBAL_SITE_OFFLINE_TEXT', 'Offline Tekst');
if(!defined('_GLOBAL_PASTE_FOOTER_TEXT'))          define('_GLOBAL_PASTE_FOOTER_TEXT', 'Lim inn eksempel tekst');
if(!defined('_GLOBAL_SHOW_TOP_PAGES'))          define('_GLOBAL_SHOW_TOP_PAGES', 'Vis sider ovenfor et dokument');
if(!defined('_GLOBAL_CIPHER_EMAIL'))          define('_GLOBAL_CIPHER_EMAIL', 'Alltid krypter emailadresser');
if(!defined('_GLOBAL_JS_BROWSER_DETECTION'))          define('_GLOBAL_JS_BROWSER_DETECTION', 'Finn brukerens nettleser med JavaScript');
if(!defined('_GLOBAL_USE_CS'))          define('_GLOBAL_USE_CS', 'Bruk toendaCMS komponentsystem');
if(!defined('_GLOBAL_SECURITY'))          define('_GLOBAL_SECURITY', 'Sikkerhet');
if(!defined('_GLOBAL_CAPTCHA'))          define('_GLOBAL_CAPTCHA', 'Bruke captcha for kommentarer');
if(!defined('_GLOBAL_CAPTCHA_CLEAN'))          define('_GLOBAL_CAPTCHA_CLEAN', 'Størrelsen på captcha cache til rensing');
if(!defined('_GLOBAL_SHOW_DOC_AUTOR'))          define('_GLOBAL_SHOW_DOC_AUTOR', 'Vis dokumentets forfatter');



// POLL
if(!defined('_POLL_MAINTITLE'))          define('_POLL_MAINTITLE', 'Avstemmingsmodul');
if(!defined('_POLL_ALL_TITLE'))          define('_POLL_ALL_TITLE', 'Alle avsteminger');
if(!defined('_POLL_TITLE'))          define('_POLL_TITLE', 'Avstemming tittel');
if(!defined('_POLL_SHOW_TITLE'))          define('_POLL_SHOW_TITLE', 'Vis avstemming tittel');
if(!defined('_POLL_ALLPOLL_TITLES'))          define('_POLL_ALLPOLL_TITLES', 'Alle avstemmingstittler');
if(!defined('_POLL_SHOW'))          define('_POLL_SHOW', 'Vis avstemming i sidelinjen');
if(!defined('_POLL_TITLE_SIDEMENU'))          define('_POLL_TITLE_SIDEMENU', 'Sidemeny');
if(!defined('_POLL_MENU_TITLE'))          define('_POLL_MENU_TITLE', 'Tittel på lenke til avstemming');
if(!defined('_POLL_MENU_SHOW'))          define('_POLL_MENU_SHOW', 'Vis link til avstemming');
if(!defined('_POLL_MENU_POS'))          define('_POLL_MENU_POS', 'Hvilken posisjon');
if(!defined('_POLL_TITLE_TOPMENU'))          define('_POLL_TITLE_TOPMENU', 'Toppmeny');
if(!defined('_POLL_VOTETEXT'))          define('_POLL_VOTETEXT', 'Takk for at du stemte.');
if(!defined('_POLL_RESULTTEXT'))          define('_POLL_RESULTTEXT', 'Du har en stemme i denne avstemming');
if(!defined('_POLL_ALLPOLLS'))          define('_POLL_ALLPOLLS', 'Alle avstemminger');
if(!defined('_POLL_RESULT'))          define('_POLL_RESULT', 'Resultat');
if(!defined('_POLL_POLLS_INACTIVE'))          define('_POLL_POLLS_INACTIVE', 'Det finnes ingen aktive avstemminger for &oslash;yeblikket');
if(!defined('_POLL_SIDE_WIDTH'))          define('_POLL_SIDE_WIDTH', 'Bredden til avstemmingen i sidelinjen');
if(!defined('_POLL_MAIN_WIDTH'))          define('_POLL_MAIN_WIDTH', 'Bredden til innholdet i avstemmingen');
if(!defined('_POLL_ANSWERS'))          define('_POLL_ANSWERS', 'Svar');


// PATHWAY
if(!defined('_PATH_HOME'))          define('_PATH_HOME', 'Hjem');
if(!defined('_PATH_REGISTRATION'))          define('_PATH_REGISTRATION', 'Registrering');
if(!defined('_PATH_PROFILE'))          define('_PATH_PROFILE', 'Bruker Profile');
if(!defined('_PATH_POLLS'))          define('_PATH_POLLS', 'Alle avstemminger');
if(!defined('_PATH_LOSTPW'))          define('_PATH_LOSTPW', 'Mistet passordet?');
if(!defined('_PATH_SEARCH'))          define('_PATH_SEARCH', 'S&oslash;k');
if(!defined('_PATH_LEGAL'))          define('_PATH_LEGAL', 'Legal');
if(!defined('_PATH_LINKS'))          define('_PATH_LINKS', 'Linker');


// LAYOUT
if(!defined('_LAYOUT_SELECT'))          define('_LAYOUT_SELECT', 'Velg');
if(!defined('_LAYOUT_NO'))          define('_LAYOUT_NO', 'Nei.');
if(!defined('_LAYOUT_PATH'))          define('_LAYOUT_PATH', 'Sti');
if(!defined('_LAYOUT_NAME'))          define('_LAYOUT_NAME', 'Navn');
if(!defined('_LAYOUT_AUTOR'))          define('_LAYOUT_AUTOR', 'Forfatter');
if(!defined('_LAYOUT_URL'))          define('_LAYOUT_URL', 'URL');
if(!defined('_LAYOUT_VERSION'))          define('_LAYOUT_VERSION', 'Versjon');
if(!defined('_LAYOUT_PREVIEW'))          define('_LAYOUT_PREVIEW', 'Forhåndsvisning');
if(!defined('_LAYOUT_CURRENT'))          define('_LAYOUT_CURRENT', 'Aktiv mal');
if(!defined('_LAYOUT_COUNT'))          define('_LAYOUT_COUNT', 'Installerte maler');
if(!defined('_LAYOUT_FRONTEND'))          define('_LAYOUT_FRONTEND', 'Frontend maler');
if(!defined('_LAYOUT_BACKEND'))          define('_LAYOUT_BACKEND', 'Administrator maler');


// LAYOUT UPLOAD
if(!defined('_LU_TEXT'))          define('_LU_TEXT', 'Hvis du har en .zip, bruk pakkeopplastning. Ellers, kopier hele temaet (index.php, Bilder og CSS-stilark) til Theme mappen. Om du vil kan du bruke Last opp fil dialogen. Hvis du ikke har en Description fil, klikk Ny knappen.');
if(!defined('_LU_DIR'))          define('_LU_DIR', 'Navnet på template (maler) mappen');
if(!defined('_LU_FILE'))          define('_LU_FILE', 'Fil');
if(!defined('_LU_ZTITLE'))          define('_LU_ZTITLE', 'Last opp og installer pakkefil');
if(!defined('_LU_ZFILE'))          define('_LU_ZFILE', 'Pakkefil (.zip)');
if(!defined('_LU_UPLOAD'))          define('_LU_UPLOAD', '');
if(!defined('_LU_UPLOAD_TEMPLATE'))          define('_LU_UPLOAD_TEMPLATE', 'Last opp malfiler i mappe');
if(!defined('_LU_UPLOAD_IMAGE'))          define('_LU_UPLOAD_IMAGE', 'Mal bilder');
if(!defined('_LU_DESCRIPTION'))          define('_LU_DESCRIPTION', 'En beskrivelse må oppgis.<br />Hvis du ikke har en, kan du klikke Ny for å opprette en.');
if(!defined('_LU_THUMB'))          define('_LU_THUMB', 'Screenshot med bredde');
if(!defined('_LU_DES_TEXT'))          define('_LU_DES_TEXT', 'Felter med punkt er obligatoriske.');
if(!defined('_LU_DES_DIR'))          define('_LU_DES_DIR', 'Mappe til å lagre filen');
if(!defined('_LU_DES_NAME'))          define('_LU_DES_NAME', 'Navn på mal');
if(!defined('_LU_DES_AUTOR'))          define('_LU_DES_AUTOR', 'Navn på forfatter');
if(!defined('_LU_DES_URL'))          define('_LU_DES_URL', 'URL til forfatterens webside');
if(!defined('_LU_DES_VERSION'))          define('_LU_DES_VERSION', 'Version av din mal');


// CREDITS
if(!defined('_CREDITS_SYSTEM'))          define('_CREDITS_SYSTEM', 'Systeminformasjon');
if(!defined('_CREDITS_RELEVANT'))          define('_CREDITS_RELEVANT', 'Relevant for Content Management Systemet');
if(!defined('_CREDITS_VERSION'))          define('_CREDITS_VERSION', 'toendaCMS versjon');
if(!defined('_CREDITS_PLATFORM'))          define('_CREDITS_PLATFORM', 'Plattform');
if(!defined('_CREDITS_PHP_VERSION'))          define('_CREDITS_PHP_VERSION', 'PHP versjon');
if(!defined('_CREDITS_SERVER'))          define('_CREDITS_SERVER', 'Webserver');
if(!defined('_CREDITS_SERVER_FACE'))          define('_CREDITS_SERVER_FACE', 'Webserver for PHP grensesnitt');
if(!defined('_CREDITS_RELEVANT_SET'))          define('_CREDITS_RELEVANT_SET', 'Relevante PHP innstillinger');
if(!defined('_CREDITS_SET_GLOBALS'))          define('_CREDITS_SET_GLOBALS', 'Register Globals');
if(!defined('_CREDITS_SET'))          define('_CREDITS_SET', 'aktivert');
if(!defined('_CREDITS_PHP_MODULES'))          define('_CREDITS_PHP_MODULES', 'PHP Moduler');


// ABOUT MOD
if(!defined('_ABOUTMOD_TITLE'))          define('_ABOUTMOD_TITLE', 'Dette er en liten beskrivelse av modulene');
if(!defined('_ABOUTMOD_MODULE'))          define('_ABOUTMOD_MODULE', 'Modul');
if(!defined('_ABOUTMOD_DESCRIPTION'))          define('_ABOUTMOD_DESCRIPTION', 'Beskrivelse');


// ABOUT
if(!defined('_ABOUT_TITLE'))          define('_ABOUT_TITLE', 'toendaCMS Proffesjonell Web Content Management og Webloggingssystem');
if(!defined('_ABOUT_TEXT'))          define('_ABOUT_TEXT', 'toendaCMS er en fleksibel og proffesjonell Web Content Management and Webloggingssystem basert på PHP4, PHP5, XML og forskjellige database servere.');
if(!defined('_ABOUT_TEXT2'))          define('_ABOUT_TEXT2', 'Gå til <a class="tcms_about" href="http://www.toenda.com/" target="_blank">http://www.toenda.com</a> for detaljer. toendaCMS kommer UTEN GARANTI. Dette er gratis progamvare og du er velkommen til å redistributere den under visse vilkår. Det er straffbart å fjerne denne meldingen.');
if(!defined('_ABOUT_EMAIL_INFO'))          define('_ABOUT_EMAIL_INFO', 'Informasjon and teknisk support');
if(!defined('_ABOUT_EMAIL_BUG'))          define('_ABOUT_EMAIL_BUG', 'Feil rapportering');
if(!defined('_ABOUT_URL_DEVELOPMENT'))          define('_ABOUT_URL_DEVELOPMENT', 'Utviklingen av toendaCMS');
if(!defined('_ABOUT_URL'))          define('_ABOUT_URL', 'Den ofisielle demonstrasjonssiden av toendaCMS');
if(!defined('_ABOUT_URL_DOWNLOAD'))          define('_ABOUT_URL_DOWNLOAD', 'Nedlastninger og oppdateringer');
if(!defined('_ABOUT_FREE_SOFTWARE'))          define('_ABOUT_FREE_SOFTWARE', 'er gratis programvare utgitt under GNU/GPL Lisensen.');
if(!defined('_ABOUT_CODE_IS_POESIE'))          define('_ABOUT_CODE_IS_POESIE', '<strong>Husk for alltid:</strong> Code is poetry.');
if(!defined('_ABOUT_POWERED_BY'))          define('_ABOUT_POWERED_BY', 'Powered by');



// CONTACTFORM
if(!defined('_FORM_NAME'))          define('_FORM_NAME', 'Navn');
if(!defined('_FORM_EMAIL'))          define('_FORM_EMAIL', 'Email');
if(!defined('_FORM_MESSAGE'))          define('_FORM_MESSAGE', 'Beskjed');
if(!defined('_FORM_URL'))          define('_FORM_URL', 'Webside');
if(!defined('_FORM_SUBJECT'))          define('_FORM_SUBJECT', 'Emne');
if(!defined('_FORM_MSG'))          define('_FORM_MSG', 'Beskjed');
if(!defined('_FORM_COPY'))          define('_FORM_COPY', 'Send meg en kopi');
if(!defined('_FORM_SEND'))          define('_FORM_SEND', 'Send');
if(!defined('_FORM_SUBMIT'))          define('_FORM_SUBMIT', 'Send');
if(!defined('_FORM_MSG_CONTENT'))          define('_FORM_MSG_CONTENT', 'F&oslash;lgende beskjed sendt fra kontaktskjema');
if(!defined('_FORM_DEAR'))          define('_FORM_DEAR', 'Kjære');
if(!defined('_FORM_THANKYOU'))          define('_FORM_THANKYOU', 'takk for at du bes&oslash;kte siden v&aring;r!');
if(!defined('_FORM_FOLLOWMSG'))          define('_FORM_FOLLOWMSG', 'F&oslash;lgende beskjed er sendt fra kontaktskjema:');
if(!defined('_FORM_YOUR'))          define('_FORM_YOUR', 'Din');
if(!defined('_FORM_CFORM'))          define('_FORM_CFORM', 'Kontaktskjema');
if(!defined('_FORM_SYSTEM'))          define('_FORM_SYSTEM', 'Dette er en system generert beskjed, vennligst ikke svar på denne meldingen.');
if(!defined('_FORM_GREETS'))          define('_FORM_GREETS', 'Med vennlig hilsen');
if(!defined('_FORM_FROM'))          define('_FORM_FROM', 'Dette nyhetsbrevet er fra ');


// GUESTBOOK
if(!defined('_BOOK_SEND'))                     define('_BOOK_SEND', 'Send');
if(!defined('_BOOK_ENTRYS'))                   define('_BOOK_ENTRYS', 'Gjestebok innlegg');
if(!defined('_BOOK_ENTRY1'))          define('_BOOK_ENTRY1', 'innlegg');
if(!defined('_BOOK_ENTRY2'))          define('_BOOK_ENTRY2', 'innlegg');
if(!defined('_BOOK_E_NO'))          define('_BOOK_E_NO', 'Nei.');
if(!defined('_BOOK_E_NAME'))          define('_BOOK_E_NAME', 'Navn');
if(!defined('_BOOK_E_DATE'))          define('_BOOK_E_DATE', 'Dato');
if(!defined('_BOOK_E_EMAIL'))          define('_BOOK_E_EMAIL', 'Email');
if(!defined('_BOOK_PAGE'))          define('_BOOK_PAGE', 'Side');
if(!defined('_BOOK_ADD'))          define('_BOOK_ADD', 'Skriv et innlegg');
if(!defined('_BOOK_FILTER_LINKS'))          define('_BOOK_FILTER_LINKS', 'Linker (Weblinker, emailadresser)');
if(!defined('_BOOK_FILTER_SCRIPT'))          define('_BOOK_FILTER_SCRIPT', 'Script (Javascript, PHP)');
if(!defined('_BOOK_FILTER_MAIL'))          define('_BOOK_FILTER_MAIL', 'Vis emailadressen');
if(!defined('_BOOK_FILTER_SPAM'))          define('_BOOK_FILTER_SPAM', 'Konverter @ til __NO_SPAM__ i emailadresser');
if(!defined('_BOOK_WIDTH_NAME'))          define('_BOOK_WIDTH_NAME', 'Bredden til navnefelt (i Pixel)');
if(!defined('_BOOK_WIDTH_TEXT'))          define('_BOOK_WIDTH_TEXT', 'Bredden til tekstfelt (i Pixel)');
if(!defined('_BOOK_COLOR_ROW_1'))          define('_BOOK_COLOR_ROW_1', 'Fargen til rad en');
if(!defined('_BOOK_COLOR_ROW_2'))          define('_BOOK_COLOR_ROW_2', 'Fargen til rad to');
if(!defined('_BOOK_TITLE'))          define('_BOOK_TITLE', 'Gjestebok innleggene');
if(!defined('_BOOK_TEXT'))          define('_BOOK_TEXT', 'Her kan du administrere innleggene i gjesteboken. Du kan editere eller slette dem.');


// DOWNLOADS
if(!defined('_DOWNLOADS_TITLE'))          define('_DOWNLOADS_TITLE', 'Nedlastninger');
if(!defined('_DOWNLOADS_TEXT'))          define('_DOWNLOADS_TEXT', 'Kontroller alle dine nedlastbare filer.');
if(!defined('_DOWNLOADS_NEW'))          define('_DOWNLOADS_NEW', 'Opprett et nytt nedlastnings-element.');
if(!defined('_DOWNLOADS_EDIT'))          define('_DOWNLOADS_EDIT', 'Editer alle dine nedlastnings-innlegg i denne kategorien');
if(!defined('_DOWNLOADS_HELP'))          define('_DOWNLOADS_HELP', 'Hvis du lar bilde opplastningsfeltet forbli tomt, så blir en mimetype bilde opprettet for denne filen.');
if(!defined('_DOWNLOADS_NEW_CAT'))          define('_DOWNLOADS_NEW_CAT', 'Opprett en ny nedlastningskategori for å sortere nedlastningene etter ditt eget &oslash;nske.');
if(!defined('_DOWNLOADS_SUBMIT_ON'))          define('_DOWNLOADS_SUBMIT_ON', 'Sendt');
if(!defined('_DOWNLOADS_SAVE_AS_MIMITYPE'))          define('_DOWNLOADS_SAVE_AS_MIMITYPE', 'Lagre mimetypen som bilde');


// PRODUCTS
if(!defined('_PRODUCTS_TITLE'))          define('_PRODUCTS_TITLE', 'Produkter');
if(!defined('_PRODUCTS_ID'))          define('_PRODUCTS_ID', 'Produkt ID');
if(!defined('_PRODUCTS_SITETITLE'))          define('_PRODUCTS_SITETITLE', 'Tittel på produkt side');
if(!defined('_PRODUCTS_SITESUBTITLE'))          define('_PRODUCTS_SITESUBTITLE', 'Undertittel på produkt side');
if(!defined('_PRODUCTS_SITETEXT'))          define('_PRODUCTS_SITETEXT', 'Tekst på product side');
if(!defined('_PRODUCTS_MAINCATEGORY'))          define('_PRODUCTS_MAINCATEGORY', 'Produkt hovedkategori');
if(!defined('_PRODUCTS_TEXT'))          define('_PRODUCTS_TEXT', 'Kontrollerer alle dine produkter.');
if(!defined('_PRODUCTS_NEW'))          define('_PRODUCTS_NEW', 'Opprett en ny produkt innlegg for denne kategorien');
if(!defined('_PRODUCTS_EDIT'))          define('_PRODUCTS_EDIT', 'Editer alle diner produkt i denne kategorien');
if(!defined('_PRODUCTS_HELP'))          define('_PRODUCTS_HELP', 'Hvis du lar bilde opplastningsfeltet forbli tomt, så blir et tomt bilde opprettet for denne filen.');
if(!defined('_PRODUCTS_NEW_CAT'))          define('_PRODUCTS_NEW_CAT', 'Opprett et nytt produktkategori for å sortere produktene etter eget &oslash;nske.');
if(!defined('_PRODUCTS_SUBMIT_ON'))          define('_PRODUCTS_SUBMIT_ON', 'Sendt');
if(!defined('_PRODUCTS_INC_TAX'))          define('_PRODUCTS_INC_TAX', 'ink. skatt');
if(!defined('_PRODUCTS_EX_TAX'))          define('_PRODUCTS_EX_TAX', 'eks. skatt');
if(!defined('_PRODUCTS_CATEGORY_TITLE'))          define('_PRODUCTS_CATEGORY_TITLE', 'Kategoritittel i sidelinje');
if(!defined('_PRODUCTS_USE_CATEGORY_TITLE'))          define('_PRODUCTS_USE_CATEGORY_TITLE', 'Vis kategoritittel i sidelinje');


// NEWS
if(!defined('_NEWS_WRITTEN'))          define('_NEWS_WRITTEN', 'Skrevet av');
if(!defined('_NEWS_CATEGORIE_IN'))          define('_NEWS_CATEGORIE_IN', 'Kategorisert');
if(!defined('_NEWS_TITLE'))          define('_NEWS_TITLE', 'Vis alle nyheter');
if(!defined('_NEWS_TEXT'))          define('_NEWS_TEXT', 'Her er alle dine nyheter listet. Du kan editere eller opprette en ny en.');
if(!defined('_NEWS_EDIT_CURRENT'))          define('_NEWS_EDIT_CURRENT', 'Editer gjeldende nyhet.');
if(!defined('_NEWS_NEW_CURRENT'))          define('_NEWS_NEW_CURRENT', 'Opprett en ny nyhet.');
if(!defined('_NEWS_ID'))          define('_NEWS_ID', 'Nyhets ID');
if(!defined('_NEWS_DATE'))          define('_NEWS_DATE', 'Dato');
if(!defined('_NEWS_TIME'))          define('_NEWS_TIME', 'Tid');
if(!defined('_NEWS_SAMPLE'))          define('_NEWS_SAMPLE', 'Eksempel');
if(!defined('_NEWS_MAINTEXT'))          define('_NEWS_MAINTEXT', 'Nyhetstekst');
if(!defined('_NEWS_IMAGE_HELP'))          define('_NEWS_IMAGE_HELP', 'Klikk på knappene over for å sette inn en nyhetsstop, linjeskift og bilder inn i teksten din.');
if(!defined('_NEWS_TCMS_HELP'))          define('_NEWS_TCMS_HELP', 'Kopier disse taggene til ønsket sted i teksten.');
if(!defined('_NEWS_IMAGES'))          define('_NEWS_IMAGES', 'Nyhetsbilde');
if(!defined('_NEWS_IMAGE'))          define('_NEWS_IMAGE', 'Bilde');
if(!defined('_NEWS_DIR'))          define('_NEWS_DIR', 'Mappe');
if(!defined('_NEWS_ARCHIVE'))          define('_NEWS_ARCHIVE', 'Arkiv');
if(!defined('_NEWS_ALL'))          define('_NEWS_ALL', 'Alle');
if(!defined('_NEWS_LAST'))          define('_NEWS_LAST', 'siste');
if(!defined('_NEWS_ORDER_BY_TIME'))          define('_NEWS_ORDER_BY_TIME', 'sorter etter tid');
if(!defined('_NEWS_ORDER_BY_CAT'))          define('_NEWS_ORDER_BY_CAT', 'sorter etter kategori');
if(!defined('_NEWS_CATEGORIES_TITLE'))          define('_NEWS_CATEGORIES_TITLE', 'Nyhetskategorier');
if(!defined('_NEWS_ARCHIVES_TITLE'))          define('_NEWS_ARCHIVES_TITLE', 'Nyhetsarkiv');
if(!defined('_NEWS_CATEGORIES_TEXT'))          define('_NEWS_CATEGORIES_TEXT', 'Her kan du opprette eller editere nyhetskategorier.');
if(!defined('_NEWS_IN'))          define('_NEWS_IN', 'i');
if(!defined('_NEWS_CATEGORY_ARCHIV'))          define('_NEWS_CATEGORY_ARCHIV', 'Arkiv for denne kategorien');
if(!defined('_NEWS_ARCHIV_FOR'))          define('_NEWS_ARCHIV_FOR', 'Arkiv for');
if(!defined('_NEWS_SYNDICATION'))          define('_NEWS_SYNDICATION', 'Syndication');
if(!defined('_NEWS_TRACKBACK'))          define('_NEWS_TRACKBACK', 'Trackback');


// FRONTPAGE
if(!defined('_FRONTPAGE_CONFIG'))          define('_FRONTPAGE_CONFIG', 'Forside konfigurasjon');
if(!defined('_FRONTPAGE_USE'))          define('_FRONTPAGE_USE', 'Bruk forside');
if(!defined('_FRONTPAGE_ID'))          define('_FRONTPAGE_ID', 'ID (Hvis du bruker forsiden er ID lik 0)');
if(!defined('_FRONTPAGE_TITLE'))          define('_FRONTPAGE_TITLE', 'Forside tittel');
if(!defined('_FRONTPAGE_SUBTITLE'))          define('_FRONTPAGE_SUBTITLE', 'Forside undertittel');
if(!defined('_FRONTPAGE_TEXT'))          define('_FRONTPAGE_TEXT', 'Forside tekst');
if(!defined('_FRONTPAGE_NEWS'))          define('_FRONTPAGE_NEWS', 'Nyheter');
if(!defined('_FRONTPAGE_NEWS_TITLE'))          define('_FRONTPAGE_NEWS_TITLE', 'Nyhetstittel');
if(!defined('_FRONTPAGE_NEWS_MUCH'))          define('_FRONTPAGE_NEWS_MUCH', 'Hvor mange nyheter på forsiden?');
if(!defined('_FRONTPAGE_NEWS_CHARS'))          define('_FRONTPAGE_NEWS_CHARS', 'Hvor mange tegn kan nyhetene inneholde?');
if(!defined('_FRONT_MORE'))          define('_FRONT_MORE', 'Les mer');
if(!defined('_FRONT_COMMENT'))          define('_FRONT_COMMENT', 'Kommentar');
if(!defined('_FRONT_COMMENTS'))          define('_FRONT_COMMENTS', 'Kommentar');
if(!defined('_FRONT_NOCOMMENT'))          define('_FRONT_NOCOMMENT', 'Ingen kommentarer er lagt til!');
if(!defined('_FRONT_COMMENT_TITLE'))          define('_FRONT_COMMENT_TITLE', 'Skriv en kommentar');
if(!defined('_FRONT_COMMENT_NAME'))          define('_FRONT_COMMENT_NAME', 'Navn');
if(!defined('_FRONT_COMMENT_EMAIL'))          define('_FRONT_COMMENT_EMAIL', 'Email');
if(!defined('_FRONT_COMMENT_WEB'))          define('_FRONT_COMMENT_WEB', 'Webside');
if(!defined('_FRONT_COMMENT_TEXT'))          define('_FRONT_COMMENT_TEXT', 'Beskjed');
if(!defined('_FRONT_COMMENT_POST'))          define('_FRONT_COMMENT_POST', 'Skrevet av');
if(!defined('_FRONT_OWN_TRACKBACK'))          define('_FRONT_OWN_TRACKBACK', 'Egen Trackback URL');
if(!defined('_FRONT_TRACKBACK_URL'))          define('_FRONT_TRACKBACK_URL', 'Trackback m&aring;l URL');
if(!defined('_FRONTPAGE_SIDEBAR_NEWS'))          define('_FRONTPAGE_SIDEBAR_NEWS', 'Sidelinje nyheter');
if(!defined('_FRONTPAGE_SIDEBAR_NEWS_USE'))          define('_FRONTPAGE_SIDEBAR_NEWS_USE', 'Vis nyheter i sidelinje');
if(!defined('_FRONTPAGE_SIDEBAR_NEWS_TITLE'))          define('_FRONTPAGE_SIDEBAR_NEWS_TITLE', 'Tittel på nyheter i sidelinje');
if(!defined('_FRONTPAGE_SIDEBAR_NEWS_MUCH'))          define('_FRONTPAGE_SIDEBAR_NEWS_MUCH', 'Hvor mange nyheter i sidelinjen p&aring; forsiden?');
if(!defined('_FRONTPAGE_NEWS_DISPLAY'))          define('_FRONTPAGE_NEWS_DISPLAY', 'Hvordan skal nyhetene vises i sidelinjen?');
if(!defined('_FRONTPAGE_TDT'))          define('_FRONTPAGE_TDT', 'Tittel, dato og tid, tekst');
if(!defined('_FRONTPAGE_TD'))          define('_FRONTPAGE_TD', 'Tittel, dato og tid');
if(!defined('_FRONTPAGE_T'))          define('_FRONTPAGE_T', 'Tittel');
if(!defined('_FRONT_CAPTCHA'))          define('_FRONT_CAPTCHA', 'Skriv inn følgende kode');


// DOCUMENTATION
if(!defined('_DOCU_TITLE'))          define('_DOCU_TITLE', 'Dokumentasjon');
if(!defined('_DOCU_TEXT'))          define('_DOCU_TEXT', 'Vil du skrive til noen?');


// SEARCH
if(!defined('_SEARCH_TITLE'))          define('_SEARCH_TITLE', 'S&oslash;k');
if(!defined('_SEARCH_SUBMIT'))          define('_SEARCH_SUBMIT', 'S&oslash;k');
if(!defined('_SEARCH_BOX'))          define('_SEARCH_BOX', 'S&oslash;keord');
if(!defined('_SEARCH_TEXT_FOUND'))          define('_SEARCH_TEXT_FOUND', 'S&oslash;keresultat:');
if(!defined('_SEARCH_EMPTY'))          define('_SEARCH_EMPTY', 'Du kan ikke s&oslash;ke for ingenting. Vennligst skriv inn et s&oslash;keord.');
if(!defined('_SEARCH_START'))          define('_SEARCH_START', 'Skriv inn ditt s&oslash;keord.');
if(!defined('_SEARCH_NOTFOUND_1'))          define('_SEARCH_NOTFOUND_1', 'Ditt s&oslash;keord');
if(!defined('_SEARCH_NOTFOUND_2'))          define('_SEARCH_NOTFOUND_2', 'ble ikke funnet.');
if(!defined('_SEARCH_WITH_GOOGLE'))          define('_SEARCH_WITH_GOOGLE', 'Webs&oslash;k med');


// FILESYSTEMS
if(!defined('_FOLDER_DEFAULT'))          define('_FOLDER_DEFAULT', 'Standard');
if(!defined('_FOLDER_HTML'))          define('_FOLDER_HTML', 'HTML');
if(!defined('_FOLDER_IMAGES'))          define('_FOLDER_IMAGES', 'Bilder');
if(!defined('_FOLDER_LOCKED'))          define('_FOLDER_LOCKED', 'Lukket');
if(!defined('_FOLDER_PACK'))          define('_FOLDER_PACK', 'Pakker');
if(!defined('_FOLDER_PRINT'))          define('_FOLDER_PRINT', 'Skriv ut');
if(!defined('_FOLDER_SOUND'))          define('_FOLDER_SOUND', 'Lyd');
if(!defined('_FOLDER_DOCU'))          define('_FOLDER_DOCU', 'Dokumenter');
if(!defined('_FOLDER_VID'))          define('_FOLDER_VID', 'Video');


// FILESYSTEMS
if(!defined('_DB_CHOOSE'))          define('_DB_CHOOSE', 'Database for toendaCMS');
if(!defined('_DB_USER'))          define('_DB_USER', 'SQL Server brukernavn');
if(!defined('_DB_PASSWORD'))          define('_DB_PASSWORD', 'SQL Server passord');
if(!defined('_DB_HOST'))          define('_DB_HOST', 'SQL Server');
if(!defined('_DB_DATABASE'))          define('_DB_DATABASE', 'SQL Server Database');
if(!defined('_DB_PORT'))          define('_DB_PORT', 'SQL Server port (relatert for PostgreSQL Server)');
if(!defined('_DB_PREFIX'))          define('_DB_PREFIX', 'SQL Server Database Prefix');
if(!defined('_DB_XML'))          define('_DB_XML', 'XML Database');
if(!defined('_DB_MYSQL'))          define('_DB_MYSQL', 'MySQL Database');
if(!defined('_DB_PGSQL'))          define('_DB_PGSQL', 'PostgreSQL Database');
if(!defined('_DB_MSSQL'))          define('_DB_MSSQL', 'Microsoft SQL Server Database');
if(!defined('_DB_BACKUP'))          define('_DB_BACKUP', 'Backup Database');
if(!defined('_DB_OPTIMIZATION'))          define('_DB_OPTIMIZATION', 'Optimaliser Database');
if(!defined('_DB_RESTORE'))          define('_DB_RESTORE', 'Gjennopprett Database');
if(!defined('_DB_START_BACKUP'))          define('_DB_START_BACKUP', 'Start backup');
if(!defined('_DB_START_OPTIMIZATION'))          define('_DB_START_OPTIMIZATION', 'Start optimalisering');
if(!defined('_DB_START_RESTORE'))          define('_DB_START_RESTORE', 'Start gjennoppretting');
if(!defined('_DB_CONFIG'))          define('_DB_CONFIG', 'Konfigurer database');
if(!defined('_DB_BACKUP_RESTORE'))          define('_DB_BACKUP_RESTORE', 'Database Backup &amp; Gjennoppretting');
if(!defined('_DB_BACKUP_OPTIMIZATION'))          define('_DB_BACKUP_OPTIMIZATION', 'Database Optimalisering');
if(!defined('_DB_DB'))          define('_DB_DB', 'Database');
if(!defined('_DB_BACKUP_AS_FILE'))          define('_DB_BACKUP_AS_FILE', 'Lagre backup som en fil?');
if(!defined('_DB_BACKUP_AS_STRUCTURE'))          define('_DB_BACKUP_AS_STRUCTURE', 'Bare database strukturen?');


// LINKS
if(!defined('_LINK_MODULE'))          define('_LINK_MODULE', 'Link Manager konfigurasjon');
if(!defined('_LINK_MODULE_TITLE'))          define('_LINK_MODULE_TITLE', 'Link Manager');
if(!defined('_LINK_MODULE_DESC'))          define('_LINK_MODULE_DESC', 'Du kan opprette linker og link-kategorier her. Vennligst ta til betraktning at hver link må kunne plasseres i en kategori..');
if(!defined('_LINK_USE_SIDELINKS'))          define('_LINK_USE_SIDELINKS', 'Vis linker i sidelinje');
if(!defined('_LINK_USE_SIDELINKS_DESC'))          define('_LINK_USE_SIDELINKS_DESC', 'Vis beskrivelser av linker i sidelinje');
if(!defined('_LINK_USE_SIDELINKS_TITLE'))          define('_LINK_USE_SIDELINKS_TITLE', 'Vis tittel for sidelinje linker');
if(!defined('_LINK_SIDELINKS_TITLE'))          define('_LINK_SIDELINKS_TITLE', 'Tittel for sidelinje linker');
if(!defined('_LINK_MAINLINKS_TITLE'))          define('_LINK_MAINLINKS_TITLE', 'Tittel for innholdsiden');
if(!defined('_LINK_MAINLINKS_SUBTITLE'))          define('_LINK_MAINLINKS_SUBTITLE', 'Undertittel for innholdsiden');
if(!defined('_LINK_MAINLINKS_TEXT'))          define('_LINK_MAINLINKS_TEXT', 'Tekst for innholdsiden');
if(!defined('_LINK_USE_MAINLINKS_DESC'))          define('_LINK_USE_MAINLINKS_DESC', 'Vis beskrivelser av linker i innholdsiden');
if(!defined('_LINK_WICH_MODULE'))          define('_LINK_WICH_MODULE', 'Vis linker i denne modulen');


// COMMENTS
if(!defined('_COMMENTS_TITLE'))                define('_COMMENTS_TITLE', 'Administer Comments');
if(!defined('_COMMENTS_TEXT'))                 define('_COMMENTS_TEXT', 'Her kan du administrere alle kommentarene til nyhetene og bildene dine. Hvis du vil kan du editere eller slette dem, videre kan duse alle email-adressene, IP-adressene og domenenavnene til de som har kommentert.');


// STATS
if(!defined('_STATS_HOST'))          define('_STATS_HOST', 'Host');
if(!defined('_STATS_REF'))          define('_STATS_REF', 'Refererer');
if(!defined('_STATS_PAGE'))          define('_STATS_PAGE', 'Side');
if(!defined('_STATS_COUNT'))          define('_STATS_COUNT', 'Teller');
if(!defined('_STATS_SUM_CLICKS'))          define('_STATS_SUM_CLICKS', 'Summen av alle treff');
if(!defined('_STATS_SUM_UNIQUE'))          define('_STATS_SUM_UNIQUE', 'Summen av alle unike treff');
if(!defined('_STATS_SUM_IP'))          define('_STATS_SUM_IP', 'Summen av forskjellige ip-adresser');
if(!defined('_STATS_BROWSER_OS'))          define('_STATS_BROWSER_OS', 'Nettleser, OS');
if(!defined('_STATS_HITS'))          define('_STATS_HITS', 'Treff, Side Impressions, Referere');
if(!defined('_STATS_BROWSER'))          define('_STATS_BROWSER', 'nettleser');
if(!defined('_STATS_OS'))          define('_STATS_OS', 'Operativ System');
if(!defined('_STATS_RESET'))          define('_STATS_RESET', 'Tilbakestill statistikken');
if(!defined('_STATS_RESET_TEXT'))          define('_STATS_RESET_TEXT', 'Her kan du tilbakestille statistikken. <strong>VARSEL!</strong> DU kan ikke gjennopprette statistkken etter tilbakestillingen.');
if(!defined('_STATS_RESET_SUCCESS'))          define('_STATS_RESET_SUCCESS', 'Tilbakestilling av statistikken var vellykket.');
if(!defined('_STATS_RESET_FAILED'))          define('_STATS_RESET_FAILED', 'Tilbakestilling av statistikken feilet.');



// FAQ's
if(!defined('_FAQ_TITLE'))                     define('_FAQ_TITLE', 'Vis alle FAQ\'er og artikler');
if(!defined('_FAQ_TEXT'))                      define('_FAQ_TEXT', 'Her er alle dine FAQ\'er og artikler listet. Du kan editere eller opprette et nytt element og/eller kategori.');
if(!defined('_FAQ_BASE_CATEGORY'))             define('_FAQ_BASE_CATEGORY', 'Hovedkategori');
if(!defined('_FAQ_CFG_TITLE'))                 define('_FAQ_CFG_TITLE', 'Konfigurer kunnskapsbasen');


// IMPORT
if(!defined('_IMPORT_BLOGGER_FTP'))            define('_IMPORT_BLOGGER_FTP', 'Blogger FTP');
if(!defined('_IMPORT_BLOGGER_FTP_DESC'))       define('_IMPORT_BLOGGER_FTP_DESC', 'Importer nyheter og kommentarer fra en Blogger konto der bloggen ligger på en egen server (documentert i wiki).');
if(!defined('_IMPORT_OOO2_DOCBOOK_XML'))       define('_IMPORT_OOO2_DOCBOOK_XML', 'OpenOffice.org 2.0 DockBook XML');
if(!defined('_IMPORT_OOO2_DOCBOOK_XML_DESC'))  define('_IMPORT_OOO2_DOCBOOK_XML_DESC', 'Importer OpenOffice.org 2.0 dokumenter som er lagret som <em>DocBook XML</em>.');


// COMPONENTS UPLOAD
if(!defined('_CS_UPLOAD_TEXT'))                define('_CS_UPLOAD_TEXT', 'Hvis du har en .zip, bruk pakkeopplastning. Ellers, kopier hele komponenten (mappen med alle filer som trengs) til components mappen. Om du vil kan du bruke Last opp fil dialogen');
if(!defined('_CS_UPLOAD_ZTITLE'))              define('_CS_UPLOAD_ZTITLE', 'Last opp og installer pakkefil');
if(!defined('_CS_UPLOAD_ZFILE'))               define('_CS_UPLOAD_ZFILE', 'Pakkefil (.zip)');


// SOME FORMATS
if(!function_exists(lang_date)){
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
		
		return $str1.$str3.$str2.( trim($str3) != '' ? ' h' : '');
	}
}


// INCLUDE DEFAULT LANGUAGE
if($language_stage == 'admin'){ include_once('../language/english_EN/lang_english_EN.php'); }
else{ include_once('engine/language/english_EN/lang_english_EN.php'); }
// END INCLUDE

?>
