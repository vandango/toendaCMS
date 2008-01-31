<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Bernab� Soli�o                                               |
+------------------------------------------------------------------------+
|
| Spanish Language
|
| File:	lang_spanish_ES.php
|
+
*/


/**
 * Spanish Language
 * 
 * @version 0.4.0
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS Backend
 */


// ADMIN
if(!defined('_TCMS_ADMIN_TITLE'))              define('_TCMS_ADMIN_TITLE', 'Administraci�n toendaCMS');
if(!defined('_TCMS_ADMIN_BACK'))               define('_TCMS_ADMIN_BACK', 'Atr�s');
if(!defined('_TCMS_ADMIN_FORWARD'))            define('_TCMS_ADMIN_FORWARD', 'Adelante');
if(!defined('_TCMS_ADMIN_CLOSE'))              define('_TCMS_ADMIN_CLOSE', 'Cerrar');
if(!defined('_TCMS_ADMIN_SAVE'))               define('_TCMS_ADMIN_SAVE', 'Guardar');
if(!defined('_TCMS_ADMIN_BACK_TO_PAGE'))       define('_TCMS_ADMIN_BACK_TO_PAGE', 'Volver a la web');
if(!defined('_TCMS_ADMIN_NO'))                 define('_TCMS_ADMIN_NO', 'No');
if(!defined('_TCMS_ADMIN_FTPUPLOAD'))          define('_TCMS_ADMIN_FTPUPLOAD', 'Crear �lbum desde la carpeta de im�genes subidas v�a FTP');
if(!defined('_TCMS_ADMIN_DELETE'))             define('_TCMS_ADMIN_DELETE', 'Borrar');
if(!defined('_TCMS_ADMIN_UPLOAD'))             define('_TCMS_ADMIN_UPLOAD', 'Subir');
if(!defined('_TCMS_ADMIN_INSTALL'))            define('_TCMS_ADMIN_INSTALL', 'Subir e Instalar');
if(!defined('_TCMS_ADMIN_SEND'))               define('_TCMS_ADMIN_SEND', 'Enviar');
if(!defined('_TCMS_ADMIN_VOTE'))               define('_TCMS_ADMIN_VOTE', '�Votar ahora!');
if(!defined('_TCMS_ADMIN_NEW'))                define('_TCMS_ADMIN_NEW', 'Nuevo');
if(!defined('_TCMS_ADMIN_CREATE'))             define('_TCMS_ADMIN_CREATE', 'A�adir nuevo Album...');
if(!defined('_TCMS_ADMIN_NEW_POLL'))           define('_TCMS_ADMIN_NEW_POLL', 'A�adir nueva Escuesta...');
if(!defined('_TCMS_ADMIN_NEW_ITEM'))           define('_TCMS_ADMIN_NEW_ITEM', 'A�adir nuevo Art�culo...');
if(!defined('_TCMS_ADMIN_NEW_USER'))           define('_TCMS_ADMIN_NEW_USER', 'A�adir nuevo Usuario...');
if(!defined('_TCMS_ADMIN_NEW_FTPALBUM'))       define('_TCMS_ADMIN_NEW_FTPALBUM', 'A�adir nuevo �lbum desde carpeta FTP...');
if(!defined('_TCMS_ADMIN_NEW_CATEGORY'))       define('_TCMS_ADMIN_NEW_CATEGORY', 'A�adir Nueva Categor�a...');
if(!defined('_TCMS_ADMIN_NEW_DIR'))            define('_TCMS_ADMIN_NEW_DIR', 'A�adir nuevo directorio...');
if(!defined('_TCMS_ADMIN_NEW_DIR_BUTTON'))     define('_TCMS_ADMIN_NEW_DIR_BUTTON', 'Crear Carpeta');
if(!defined('_TCMS_ADMIN_CONFIG'))             define('_TCMS_ADMIN_CONFIG', 'Configurar este m�dulo');
if(!defined('_TCMS_ADMIN_LIST'))               define('_TCMS_ADMIN_LIST', 'Listar art�culos');
if(!defined('_TCMS_ADMIN_NEWPAGE'))            define('_TCMS_ADMIN_NEWPAGE', 'ASISTENTE: Crear una nueva p�gina para tu p�gina web.');
if(!defined('_TCMS_ADMIN_UPDATE'))             define('_TCMS_ADMIN_UPDATE', 'Actualizar');
if(!defined('_TCMS_ADMIN_VER'))                define('_TCMS_ADMIN_VER', 'Versi�n');
if(!defined('_TCMS_ADMIN_DEV'))                define('_TCMS_ADMIN_DEV', 'desarrollada por');
if(!defined('_TCMS_ADMIN_RIGHT'))              define('_TCMS_ADMIN_RIGHT', 'Todos los derechos reservados.');
if(!defined('_TCMS_ADMIN_LOGED'))              define('_TCMS_ADMIN_LOGED', 'Abierta sesi�n como');
if(!defined('_TCMS_ADMIN_GOTOSITE'))           define('_TCMS_ADMIN_GOTOSITE', 'Visualizar la p�gina web');
if(!defined('_TCMS_TOP_OF_PAGE'))              define('_TCMS_TOP_OF_PAGE', 'Ir al principio de esta p�gina ...');
if(!defined('_TCMS_PRINT_PAGE'))               define('_TCMS_PRINT_PAGE', 'Imprimir esta p�gina ...');
if(!defined('_TCMS_PDF_PAGE'))                 define('_TCMS_PDF_PAGE', 'Generar un archivo PDF de esta p�gina ...');
if(!defined('_TCMS_PRINT_NOW'))                define('_TCMS_PRINT_NOW', 'Imprimir');
if(!defined('_TCMS_COLOR_CHOOSER'))            define('_TCMS_COLOR_CHOOSER', 'Selector Color');
if(!defined('_TCMS_MONTH_JANUARY'))            define('_TCMS_MONTH_JANUARY', 'Enero');
if(!defined('_TCMS_MONTH_FEBUARY'))            define('_TCMS_MONTH_FEBUARY', 'Febrero');
if(!defined('_TCMS_MONTH_MARCH'))              define('_TCMS_MONTH_MARCH', 'Marzo');
if(!defined('_TCMS_MONTH_APRIL'))              define('_TCMS_MONTH_APRIL', 'Abril');
if(!defined('_TCMS_MONTH_MAY'))                define('_TCMS_MONTH_MAY', 'Mayo');
if(!defined('_TCMS_MONTH_JUNE'))               define('_TCMS_MONTH_JUNE', 'Junio');
if(!defined('_TCMS_MONTH_JULY'))               define('_TCMS_MONTH_JULY', 'Julio');
if(!defined('_TCMS_MONTH_AUGUST'))             define('_TCMS_MONTH_AUGUST', 'Agosto');
if(!defined('_TCMS_MONTH_SEPTEMBER'))          define('_TCMS_MONTH_SEPTEMBER', 'Septiembre');
if(!defined('_TCMS_MONTH_OCTOBER'))            define('_TCMS_MONTH_OCTOBER', 'Octubre');
if(!defined('_TCMS_MONTH_NOVEMBER'))           define('_TCMS_MONTH_NOVEMBER', 'Noviembre');
if(!defined('_TCMS_MONTH_DECEMBER'))           define('_TCMS_MONTH_DECEMBER', 'Diciembre');
if(!defined('_TCMS_DAY_MONDAY'))               define('_TCMS_DAY_MONDAY', 'Lunes');
if(!defined('_TCMS_DAY_TUESDAY'))              define('_TCMS_DAY_TUESDAY', 'Martes');
if(!defined('_TCMS_DAY_WEDNESDAY'))            define('_TCMS_DAY_WEDNESDAY', 'M�ercoles');
if(!defined('_TCMS_DAY_THURSDAY'))             define('_TCMS_DAY_THURSDAY', 'Jueves');
if(!defined('_TCMS_DAY_FRIDAY'))               define('_TCMS_DAY_FRIDAY', 'Viernes');
if(!defined('_TCMS_DAY_SATURDAY'))             define('_TCMS_DAY_SATURDAY', 'S�bado');
if(!defined('_TCMS_DAY_SUNDAY'))               define('_TCMS_DAY_SUNDAY', 'Domingo');
if(!defined('_TCMS_DAY_MONDAY_XS'))            define('_TCMS_DAY_MONDAY_XS', 'Lun');
if(!defined('_TCMS_DAY_TUESDAY_XS'))           define('_TCMS_DAY_TUESDAY_XS', 'Mar');
if(!defined('_TCMS_DAY_WEDNESDAY_XS'))         define('_TCMS_DAY_WEDNESDAY_XS', 'Mer');
if(!defined('_TCMS_DAY_THURSDAY_XS'))          define('_TCMS_DAY_THURSDAY_XS', 'Jue');
if(!defined('_TCMS_DAY_FRIDAY_XS'))            define('_TCMS_DAY_FRIDAY_XS', 'Vie');
if(!defined('_TCMS_DAY_SATURDAY_XS'))          define('_TCMS_DAY_SATURDAY_XS', 'Sab');
if(!defined('_TCMS_DAY_SUNDAY_XS'))            define('_TCMS_DAY_SUNDAY_XS', 'Dom');
if(!defined('_TCMS_COLOR'))                    define('_TCMS_COLOR', 'Color');
if(!defined('_TCMS_TODAY'))                    define('_TCMS_TODAY', 'Hoy');
if(!defined('_TCMS_BACKGROUND'))               define('_TCMS_BACKGROUND', 'Fondo');
if(!defined('_TCMS_BORDER'))                   define('_TCMS_BORDER', 'Borde');
if(!defined('_TCMS_WEEKDAY'))                  define('_TCMS_WEEKDAY', 'D�a semana');
if(!defined('_TCMS_ADMIN_APPLY'))              define('_TCMS_ADMIN_APPLY', 'Aplicar');
if(!defined('_TCMS_ADMIN_DELETE_ALL'))         define('_TCMS_ADMIN_DELETE_ALL', 'Eliminar Todo');
if(!defined('_TCMS_THIS_PAGE_IN'))             define('_TCMS_THIS_PAGE_IN', 'Esta p�gina en');
if(!defined('_TCMS_ADMIN_EDIT_LANG'))          define('_TCMS_ADMIN_EDIT_LANG', 'Editar este idioma');
if(!defined('_TCMS_LANGUAGES'))                define('_TCMS_LANGUAGES', 'Idioma');
if(!defined('_TCMS_LANGUAGE'))                 define('_TCMS_LANGUAGE', 'Idioma');
if(!defined('_TCMS_TEST_ENVIRONMENT'))         define('_TCMS_TEST_ENVIRONMENT', 'ESTA ES UNA PRUEBA DE DESARROLLO!');
if(!defined('_TCMS_OPEN_ALL'))                 define('_TCMS_OPEN_ALL', 'Abrir Todo');
if(!defined('_TCMS_CLOSE_ALL'))                define('_TCMS_CLOSE_ALL', 'Cerrar Todo');
if(!defined('_TCMS_HELP'))                     define('_TCMS_HELP', 'Ayuda');
if(!defined('_TCMS_DOCU'))                     define('_TCMS_DOCU', 'Wiki');
if(!defined('_TCMS_TSCRIPT_SYNTAX_REF'))       define('_TCMS_TSCRIPT_SYNTAX_REF', 'S�ntaxis referencia - toendaScript');

// LANGUAGE LIST
if(!defined('_LANG_GERMAN'))                   define('_LANG_GERMAN', 'Germano');
if(!defined('_LANG_ENGLISH'))                  define('_LANG_ENGLISH', 'Ingl�s');
if(!defined('_LANG_BULGARIAN'))                define('_LANG_BULGARIAN', 'Bulgaro');
if(!defined('_LANG_DUTCH'))                    define('_LANG_DUTCH', 'Alem�n');
if(!defined('_LANG_FINNISH'))                  define('_LANG_FINNISH', 'Fin�s');
if(!defined('_LANG_ITALY'))                    define('_LANG_ITALY', 'Italiano');
if(!defined('_LANG_KOREAN'))                   define('_LANG_KOREAN', 'Coreano');
if(!defined('_LANG_NORWEGIAN'))                define('_LANG_NORWEGIAN', 'Noruego');
if(!defined('_LANG_PORTUGUES'))                define('_LANG_PORTUGUES', 'Portugues');
if(!defined('_LANG_ROMANIAN'))                 define('_LANG_ROMANIAN', 'Rumano');
if(!defined('_LANG_SLOVAK'))                   define('_LANG_SLOVAK', 'Eslovaco');
if(!defined('_LANG_SPANISH'))                  define('_LANG_SPANISH', 'Espanol');
if(!defined('_LANG_SWEDISH'))                  define('_LANG_SWEDISH', 'Sueco');



// BACKEND TOPMENU
if(!defined('_TCMS_TOPMENU_MAIN'))             define('_TCMS_TOPMENU_MAIN', 'Principal');
if(!defined('_TCMS_TOPMENU_MANAGE'))           define('_TCMS_TOPMENU_MANAGE', 'Gestor');
if(!defined('_TCMS_TOPMENU_NAVIGATION'))       define('_TCMS_TOPMENU_NAVIGATION', 'Navegaci�n');
if(!defined('_TCMS_TOPMENU_SETTINGS'))         define('_TCMS_TOPMENU_SETTINGS', 'Opciones');
if(!defined('_TCMS_TOPMENU_CONTENT'))          define('_TCMS_TOPMENU_CONTENT', 'Contenido');
if(!defined('_TCMS_TOPMENU_SIDEBAR'))          define('_TCMS_TOPMENU_SIDEBAR', 'Barra Lateral');
if(!defined('_TCMS_TOPMENU_EXTENSIONS'))       define('_TCMS_TOPMENU_EXTENSIONS', 'Extensiones');
if(!defined('_TCMS_TOPMENU_COMPONENTS'))       define('_TCMS_TOPMENU_COMPONENTS', 'Componentes');
if(!defined('_TCMS_TOPMENU_SITE'))             define('_TCMS_TOPMENU_SITE', 'Sitio');
if(!defined('_TCMS_TOPMENU_HELP'))             define('_TCMS_TOPMENU_HELP', 'Ayuda');


// TCMS
if(!defined('_TCMS_MENU_HOME'))                define('_TCMS_MENU_HOME', 'Inicio');
if(!defined('_TCMS_MENU_LOGOUT'))              define('_TCMS_MENU_LOGOUT', 'Cerrar sesi�n');
if(!defined('_TCMS_MENU_PAGE'))                define('_TCMS_MENU_PAGE', 'Escritorio');
if(!defined('_TCMS_MENU_FILE'))                define('_TCMS_MENU_FILE', 'Gestor de archivos');
if(!defined('_TCMS_MENU_MEDIA'))               define('_TCMS_MENU_MEDIA', 'Gestor multimedia');
if(!defined('_TCMS_MENU_NEWS_CATEGORIES'))     define('_TCMS_MENU_NEWS_CATEGORIES', 'Categor�as de noticias');
if(!defined('_TCMS_MENU_COMMENTS'))            define('_TCMS_MENU_COMMENTS', 'Comentarios');
if(!defined('_TCMS_MENU_GUESTBOOK'))           define('_TCMS_MENU_GUESTBOOK', 'Libro de visitas');
if(!defined('_TCMS_MENU_NOTE'))                define('_TCMS_MENU_NOTE', 'Bloc de notas');
if(!defined('_TCMS_MENU_SIDEMENU'))            define('_TCMS_MENU_SIDEMENU', 'Men� lateral');
if(!defined('_TCMS_MENU_TOPMENU'))             define('_TCMS_MENU_TOPMENU', 'Men� superior');
if(!defined('_TCMS_MENU_MENUTITLE'))           define('_TCMS_MENU_MENUTITLE', 'T�tulo del men�');
if(!defined('_TCMS_MENU_CONTENT'))             define('_TCMS_MENU_CONTENT', 'Documentos');
if(!defined('_TCMS_MENU_NEWS'))                define('_TCMS_MENU_NEWS', 'Noticias');
if(!defined('_TCMS_MENU_DOWN'))                define('_TCMS_MENU_DOWN', 'Descargas');
if(!defined('_TCMS_MENU_PRODUCTS'))            define('_TCMS_MENU_PRODUCTS', 'Productos');
if(!defined('_TCMS_MENU_FAQ'))                 define('_TCMS_MENU_FAQ', 'FAQ(Base Conocimento)');
if(!defined('_TCMS_MENU_SIDEEXT'))             define('_TCMS_MENU_SIDEEXT', 'Extensiones');
if(!defined('_TCMS_MENU_SIDE'))                define('_TCMS_MENU_SIDE', 'Barra lateral');
if(!defined('_TCMS_MENU_NEWSLETTER'))          define('_TCMS_MENU_NEWSLETTER', 'Bolet�n de noticias');
if(!defined('_TCMS_MENU_POLL'))                define('_TCMS_MENU_POLL', 'Encuesta');
if(!defined('_TCMS_MENU_EXT'))                 define('_TCMS_MENU_EXT', 'Extensiones');
if(!defined('_TCMS_MENU_FRONT'))               define('_TCMS_MENU_FRONT', 'P�gina principal');
if(!defined('_TCMS_MENU_GALLERY'))             define('_TCMS_MENU_GALLERY', 'Galer�a de im�genes');
if(!defined('_TCMS_MENU_LINK'))                define('_TCMS_MENU_LINK', 'Enlaces');
if(!defined('_TCMS_MENU_IMP'))                 define('_TCMS_MENU_IMP', 'Formulario de Impresi�n');
if(!defined('_TCMS_MENU_CONTACT'))             define('_TCMS_MENU_CONTACT', 'Gestor de contactos');
if(!defined('_TCMS_MENU_USER'))                define('_TCMS_MENU_USER', 'Gestor de usuarios');
if(!defined('_TCMS_MENU_USERPAGE'))            define('_TCMS_MENU_USERPAGE', 'P�ginas de los usuarios');
if(!defined('_TCMS_MENU_CFORM'))               define('_TCMS_MENU_CFORM', 'Formulario de contacto');
if(!defined('_TCMS_MENU_QBOOK'))               define('_TCMS_MENU_QBOOK', 'Libro de visitas');
if(!defined('_TCMS_MENU_CS'))                  define('_TCMS_MENU_CS', 'Componentes del sistema');
if(!defined('_TCMS_MENU_CS_UPLOAD'))           define('_TCMS_MENU_CS_UPLOAD', 'Componentes: instalar y editar');
if(!defined('_TCMS_MENU_GLOBAL'))              define('_TCMS_MENU_GLOBAL', 'Configuraci�n general');
if(!defined('_TCMS_MENU_DB'))                  define('_TCMS_MENU_DB', 'Configuraci�n de la base de datos');
if(!defined('_TCMS_MENU_STATS'))               define('_TCMS_MENU_STATS', 'Estad�sticas');
if(!defined('_TCMS_MENU_THEME'))               define('_TCMS_MENU_THEME', 'Gestor de plantillas');
if(!defined('_TCMS_MENU_THEME_UPLOAD'))        define('_TCMS_MENU_THEME_UPLOAD', 'Instalar plantilla y editar');
if(!defined('_TCMS_MENU_THEME_PREVIEW'))       define('_TCMS_MENU_THEME_PREVIEW', 'Visualizar');
if(!defined('_TCMS_MENU_COPY'))                define('_TCMS_MENU_COPY', 'Licencia');
if(!defined('_TCMS_MENU_CREDITS'))             define('_TCMS_MENU_CREDITS', 'Cr�ditos y Sistema');
if(!defined('_TCMS_MENU_DOCU'))                define('_TCMS_MENU_DOCU', 'Documentaci�n');
if(!defined('_TCMS_MENU_HELP'))                define('_TCMS_MENU_HELP', 'Ayuda');
if(!defined('_TCMS_MENU_SUPPORT'))             define('_TCMS_MENU_SUPPORT', 'Soporte');
if(!defined('_TCMS_MENU_ABOUT_MODULE'))        define('_TCMS_MENU_ABOUT_MODULE', 'Acerca del m�dulo');
if(!defined('_TCMS_MENU_ABOUT'))               define('_TCMS_MENU_ABOUT', 'Acerca de toendaCMS');
if(!defined('_TCMS_MENU_SEARCH'))              define('_TCMS_MENU_SEARCH', 'Buscar');
if(!defined('_TCMS_MENU_IMPORT'))              define('_TCMS_MENU_IMPORT', 'Importar');
if(!defined('_TCMS_MENU_CFORM'))               define('_TCMS_MENU_CFORM', 'Formulario Contacto');
if(!defined('_TCMS_MENU_BOOK'))                define('_TCMS_MENU_BOOK', 'Libro de visitas');


// MODULES
if(!defined('_MOD_HOME'))                      define('_MOD_HOME', 'Inicio');
if(!defined('_MOD_PAGE'))                      define('_MOD_PAGE', 'Escritorio');
if(!defined('_MOD_EXPLORE'))                   define('_MOD_EXPLORE', 'Gestor de archivos - Explorar tus archivos');
if(!defined('_MOD_MEDIA'))                     define('_MOD_MEDIA', 'Gestor multimedia - Administrar tus im�genes');
if(!defined('_MOD_NEWS_CATEGORIES'))           define('_MOD_NEWS_CATEGORIES', 'Administrar categor�as de noticias');
if(!defined('_MOD_COMMENTS'))                  define('_MOD_COMMENTS', 'Administrar comentarios');
if(!defined('_MOD_GUESTBOOK'))                 define('_MOD_GUESTBOOK', 'Administrar Libro de Visitas');
if(!defined('_MOD_NOTE'))                      define('_MOD_NOTE', 'Bloc de notas - Recuerda tus ideas');
if(!defined('_MOD_SIDEMENU'))                  define('_MOD_NEWPAGE', 'Crear una nueva p�gina');
if(!defined('_MOD_SIDEMENU'))                  define('_MOD_SIDEMENU', 'Gestor del men� lateral');
if(!defined('_MOD_TOPMENU'))                   define('_MOD_TOPMENU', 'Gestor del men� superior');
if(!defined('_MOD_USERMENU'))                  define('_MOD_USERMENU', 'Gestor del men� de usuarios');
if(!defined('_MOD_MENUTITLE'))                 define('_MOD_MENUTITLE', 'Gestor del t�tulo del men�');
if(!defined('_MOD_CONTENT'))                   define('_MOD_CONTENT', 'Gestor de documentos');
if(!defined('_MOD_NEWS'))                      define('_MOD_NEWS', 'Gestor de noticias');
if(!defined('_MOD_DOWN'))                      define('_MOD_DOWN', 'Gestor de descargas');
if(!defined('_MOD_PRODUCTS'))                  define('_MOD_PRODUCTS', 'Gestor de productos');
if(!defined('_MOD_SIDEBAR_EXTENSION'))         define('_MOD_SIDEBAR_EXTENSION', 'Configuraci�n de extensi�n de la barra lateral');
if(!defined('_MOD_SIDEBAR'))                   define('_MOD_SIDEBAR', 'Gestor del contenido de la barra lateral');
if(!defined('_MOD_NEWSLETTER'))                define('_MOD_NEWSLETTER', 'Gestor del bolet�n de noticias');
define('_MOD_POLL', 'Encuesta');
define('_MOD_EXTENSIONS', 'Configuraci�n de la extensi�n general');
define('_MOD_FRONTPAGE', 'Configuraci�n de la p�gina principal');
define('_MOD_IMPRESSUM', 'Configuraci�n del dise�ador de impresi�n');
define('_MOD_GALLERY', 'Configuraci�n de la galer�a de im�genes');
define('_MOD_LINK', 'Gestor de enlaces');
define('_MOD_KNOWLEDGEBASE', 'Base datos de Conocimento (FAQ)');
define('_MOD_CONTACT', 'Gestor de contactos');
define('_MOD_USER', 'Gestor de usuarios');
define('_MOD_USERPAGE', 'Configuraci�n de la p�gina de usuario');
define('_MOD_COMPONENTS', 'Sistema de componentes');
define('_MOD_COMPONENTS_UPLOAD', 'Instalar y Editar Componentes');
define('_MOD_GLOBAL', 'Configuraci�n general');
define('_MOD_IMPORT', 'Importar');
define('_MOD_DB', 'Configuraci�n de la base de datos');
define('_MOD_STATS', 'Estad�sticas de la p�gina web');
define('_MOD_TEMPLATE', 'Gestor de plantillas');
define('_MOD_TEMPLATE_UPLOAD', 'Gestor de subida y edici�n de plantillas');
define('_MOD_LICENSE', 'Licencia toendaCMS (GNU/GPL)');
define('_MOD_HELP', 'Ayuda para diferentes m�dulos y configuraciones');
define('_MOD_DOCU', 'Documentaci�n');
define('_MOD_CREDITS', 'Informaci�n y cr�ditos');
define('_MOD_ABOUT_MODULE', 'Descripci�n de los m�dulos de toendaCMS');
define('_MOD_ABOUT', 'Acerca de toendaCMS');
if(!defined('_MOD_CFORM'))                     define('_MOD_CFORM', 'Configuraci�n Formulario Contacto');
if(!defined('_MOD_BOOK'))                      define('_MOD_BOOK', 'Configuraci�n Libro de Visitas');


// TABLES
if(!defined('_TABLE_TITLE'))                   define('_TABLE_TITLE', 'T�tulo');
if(!defined('_TABLE_SUBTITLE'))                define('_TABLE_SUBTITLE', 'Subt�tulo');
if(!defined('_TABLE_PUBLISH'))                 define('_TABLE_PUBLISH', 'Informaci�n de la publicaci�n');
if(!defined('_TABLE_TEXT'))                    define('_TABLE_TEXT', 'Texto principal');
if(!defined('_TABLE_DEFAULT'))                 define('_TABLE_DEFAULT', 'Por defecto');
if(!defined('_TABLE_PUBLISHED'))               define('_TABLE_PUBLISHED', 'Publicado');
if(!defined('_TABLE_NOT_PUBLISHED'))           define('_TABLE_NOT_PUBLISHED', 'No Publicado');
if(!defined('_TABLE_PUBLISHING'))              define('_TABLE_PUBLISHING', 'Se publicar� el');
if(!defined('_TABLE_RSS'))                     define('_TABLE_RSS', 'Enlace RSS');
define('_TABLE_ENABLED', 'Activado');
define('_TABLE_NAME', 'Nombre');
define('_TABLE_USERNAME', 'Nombre de usuario');
define('_TABLE_GROUP', 'Grupo de usuario');
define('_TABLE_PERSON', 'Informaci�n personal');
define('_TABLE_SUBID', 'SUB ID');
define('_TABLE_ORDER', 'ID');
define('_TABLE_TARGET', 'Destino');
define('_TABLE_POS', 'Posici�n');
define('_TABLE_IN_WORK', 'Conclu�do');
define('_TABLE_IS_IN_WORK', 'En uso');
define('_TABLE_FUNCTIONS', 'Funciones');
define('_TABLE_PARENT', 'Elemento padre para el submen�');
define('_TABLE_PARENTC', 'Por favor, elije');
define('_TABLE_PARENTN', 'Sin submen�');
define('_TABLE_PARENTITEM', 'Elemento padre');
define('_TABLE_MENUINFO', 'Solamente puedes crear submen�s en el men� lateral.');
define('_TABLE_AUTOR', 'Autor');
define('_TABLE_CATEGORY', 'Categor�a');
define('_TABLE_FILE', 'Archivo');
define('_TABLE_FILE_EXISTS', 'Si el archivo existe, por favor, introduce el nombre completo. Por favor, comprueba esto antes de subirlo: Crea una carpeta con el nombre del archivo, pero sin extensiones como .zip, y los espacios tienen que ser guiones bajos (_). Esta carpeta ser� la utilizada.');
define('_TABLE_FILE_OTHERURL', 'Si el archivo est� en otro servidor, introduce aqu� la ruta completa y el nombre del archivo (se crear� una carpeta con ese nombre).');
define('_TABLE_FILE_EXISTS_NAME', 'El archivo ya existe');
define('_TABLE_FILE_OTHERURL_NAME', 'El archivo en otro servidor');
define('_TABLE_DATE', 'Fecha');
define('_TABLE_TIME', 'Hora');
define('_TABLE_EMAIL', 'E-mail');
define('_TABLE_OPTION', 'Opci�n');
define('_TABLE_INFO', 'Informaci�n');
define('_TABLE_ORDER_HELP', '(N�mero de identificaci�n)');
define('_TABLE_ALBUM', '�lbum');
define('_TABLE_DIR', 'Directorio');
define('_TABLE_BACKENDFILE', 'archivo Backend');
define('_TABLE_FRONTENDFILE', 'archivo Frontend');
define('_TABLE_SIDEBARFILE', 'archivo Barra Lateral');
define('_TABLE_SETTINGSFILE', 'Archivo de ajustes');
define('_TABLE_IMAGE', 'Im�gen');
define('_TABLE_USE', 'Usar');
define('_TABLE_DELETE', 'Borrar');
define('_TABLE_DESCRIPTION', 'Descripci�n');
define('_TABLE_NEW', 'Nueva entrada');
define('_TABLE_EDIT', 'Editar entrada');
define('_TABLE_DETAILS', 'Detalles de la entrada');
define('_TABLE_GENERAL', 'Informaci�n general');
define('_TABLE_FURTHER', 'M�s datos');
define('_TABLE_SETTINGS', 'Ajustes');
define('_TABLE_CONTACT', 'Informaci�n de contacto');
define('_TABLE_PRODUCTNO', 'N�mero de art�culo');
define('_TABLE_FACTORY', 'Fabricante');
define('_TABLE_URL', 'P�gina web');
define('_TABLE_STOCK', 'En Stock');
define('_TABLE_PRICE', 'Precio');
define('_TABLE_TAX', 'Con impuestos');
define('_TABLE_QUANTITY', 'Cantidad');
define('_TABLE_WEIGHT', 'Peso');
define('_TABLE_SAVEBUTTON', 'Guardar');
define('_TABLE_EDITBUTTON', 'Editar');
define('_TABLE_DELBUTTON', 'Borrar');
define('_TABLE_SETTINGSBUTTON', 'Ajustes');
define('_TABLE_ADMINBUTTON', 'Administrar');
define('_TABLE_ACCEPTBUTTON', 'Aceptar');
define('_TABLE_GOUPBUTTON', 'Ir arriba');
define('_TABLE_ACCESS', 'Nivel de acceso');
define('_TABLE_MACCESS', 'Acceso');
define('_TABLE_LINKTO', 'Enlace a');
define('_TABLE_COMMENTS', 'Comentarios activados');
define('_TABLE_LINK', 'CID');
define('_TABLE_PUBLIC', 'P�blico (Para todos los invitados)');
define('_TABLE_PROTECTED', 'Protegido (S�lo usuarios registrados)');
define('_TABLE_PRIVATE', 'Privado (Ni para usuarios ni invitados)');
define('_TABLE_WHICHMENU', '�En qu� men� quieres hacer la entrada?');
define('_TABLE_SIDEMENU', 'Men� lateral');
define('_TABLE_TOPMENU', 'Men� superior');
define('_TABLE_USERMENU', 'Men� de usuario');
define('_TABLE_CHARSET', 'Juego de car�cteres');
define('_TABLE_ALIAS', 'Alias');
define('_TABLE_LEFT', 'Izquierda');
define('_TABLE_RIGHT', 'Derecha');
define('_TABLE_CENTER', 'Centrado');
define('_TABLE_TYPE', 'Tipo');
define('_TABLE_MENUTITLE', 'T�tulo del men�');
define('_TABLE_MENULINK', 'Enlace');
define('_TABLE_MENUWEB', 'Enlace web');
define('_TABLE_REORDER', 'Reordenar');
define('_TABLE_DEFAULT_NEWS_CATEGORY', 'Categor�a de noticias por defecto');
define('_TABLE_MAIN_CS', 'Componente para la p�gina principal');
define('_TABLE_SIDE_CS', 'Componente para el men� lateral');
define('_TABLE_START', 'Empezar');
define('_TABLE_PREVIOUS', 'Anterior');
define('_TABLE_NEXT', 'Siguiente');
define('_TABLE_END', 'Fin');
define('_TABLE_DISPLAY', 'Mostrar');
define('_TABLE_A_PAGE', 'a la p�gina');
define('_TABLE_OF', 'de');
define('_TABLE_ENABLED_THIS', 'Activado');
define('_TABLE_DISABLED_THIS', 'Desactivado');
define('_TABLE_IP', 'IP');
define('_TABLE_DOMAIN', 'Dominio');
define('_TABLE_SIDEBAR', 'Men� lateral');
define('_TABLE_MAINCONTENT', 'P�gina principal');
define('_TABLE_BOTH', 'Ambos');
define('_TABLE_FILTER', 'Filtro y Opciones');
define('_TABLE_SORT_SIDE', 'Posici�n Barra Lateral');
define('_TABLE_LOCATION', 'Localizaci�n');
define('_TABLE_DATES', 'Fechas');
define('_TABLE_HELPBROWSER', 'Ayuda de toendaCSM');
define('_TABLE_LINKBROWSER', 'Navegador enlaces');
define('_TABLE_LINKBROWSER_TEXT', 'Clic en el bot�n para poner el enlace en el documento. Puedes poner un t�tulo en el campo de texto para ajustar el nombre del enlace.');
define('_TABLE_LINKBROWSER_TEXT_TINYMCE', '<strong>tinyMCE:</strong> Debes seleccionar un texto para cambiarlo dentro de un enlace.');
define('_TABLE_IMAGEBROWSER', 'Navegador Multimedia');
define('_TABLE_IMAGEBROWSER_TEXT', 'Clic en el bot�n para usar archivos multimedia en el documento.');
define('_TABLE_DIARY_RSS', 'Alimentaci�n Diario RSS');
define('_TABLE_DIARY_TICKET', 'Tickets');
define('_TABLE_IMPORT', 'Importar');
define('_TABLE_SORT', 'Ordenar');
define('_TABLE_SORT_DESC', 'Ordenar Descendente');
define('_TABLE_SORT_ASC', 'Ordenar Ascendente');
define('_TABLE_VIEW', 'Vista');
if(!defined('_TABLE_FRONTPAGE'))               define('_TABLE_FRONTPAGE', 'P�gina de Inicio');


// MESSAGES
define('_DIE_LOGIN', 'Por favor, introduce tu nombre de usuario y contrase�a<br /><a href="index.php">Entrar</a>');
define('_MSG_NOINFO', '[INFORMACI�N NO DISPONIBLE]');
define('_MSG_SAVED', 'Grabado con �xito.');
define('_MSG_SAVED_FAILED', 'No ha sido grabado.');
define('_MSG_SEND', 'Enviado con �xito.');
define('_MSG_NOTWRITABLE', '�NO ES ESCRIBIBLE!');
define('_MSG_NOINSTALL', '�Por favor, instala primero!');
define('_MSG_GOTOINSTALL', 'IR A INSTALACI�N');
define('_MSG_RM_INSTALLDIR', '�Por favor, elimina el directorio de instalaci�n!');
define('_MSG_PAGE_LOAD_1', 'P�gina generada en');
define('_MSG_PAGE_LOAD_2', 'segundos');
define('_MSG_NOIMAGE', 'No ha seleccionado ninguna im�gen.');
define('_MSG_IMAGE', 'Im�gen subida con �xito a');
define('_MSG_NONAME', 'Por favor, introduce tu nombre');
define('_MSG_NOCAPTCHA', 'Por favor introduce el c�digo de la im�gen');
define('_MSG_CAPTCHA_NOT_VALID', 'El c�digo escrito y el c�digo de la im�gen no concuerdan');
define('_MSG_FALSEPASSWORD', '�Contrase�a err�nea!');
define('_MSG_PASSWORDNOTVALID', '�Contrase�a no v�lida!');
define('_MSG_NOPASSWORD', '�Contrase�a no v�lida?');
define('_MSG_NOEMAIL', 'No has proporcionado ninguna direcci�n de correo electr�nico');
define('_MSG_EMAILVALID', 'Correo electr�nico no v�lido');
define('_MSG_DELETE', 'Borrado con �xito.');
define('_MSG_DELETE_SUBMIT', '�De verdad deseas borrar esta entrada?');
define('_MSG_DELETE_INACTIVE', 'Problemas al intentar borrar. La entrada no ha sido activada porque no has seleccionado la caja.');
define('_MSG_NOSUBJECT', 'Por favor, introduce tema');
define('_MSG_NOMSG', 'Por favor, introduce mensaje');
define('_MSG_NEWSLETTER', 'Te has suscrito correctamente a nuestro bolet�n de noticias.');
define('_MSG_POLL', 'Gracias por votar en esta encuesta.');
define('_MSG_UPLOAD', 'El archivo ha sido subido a');
define('_MSG_NOUPLOAD', 'El archivo no puede subirse.');
define('_MSG_REGNOTALLOWD', 'No se permite el registro.');
define('_MSG_NOACCOUNT', 'Sin cuenta.');
define('_MSG_NOCONTENT', 'Por favor, rellena todos los campos.');
define('_MSG_USERNOTEXISTS', 'El usuario no existe.');
define('_MSG_USEREXISTS', 'Este nombre de usuario ya existe. Por favor, escoge otro.');
define('_MSG_ERROR', 'Error');
define('_MSG_CODE', 'C�digo');
if(!defined('_MSG_PHP_UPLOAD_SETTINGS'))       define('_MSG_PHP_UPLOAD_SETTINGS', 'Los ajustes de subida de PHP no son suficientes para esta funci�n.');
if(!defined('_MSG_PHP_SAFE_MODE_SETTINGS'))    define('_MSG_PHP_SAFE_MODE_SETTINGS', 'La opci�n \'safe_mode\' en tu server est� \'on\' para PHP, no puedes usar esa caracter�stica.');
if(!defined('_MSG_MAX_FILE_SIZE'))             define('_MSG_MAX_FILE_SIZE', 'Tam�o M�ximo del archivo');
if(!defined('_MSG_FILE_UPLOADS'))              define('_MSG_FILE_UPLOADS', 'Subida de archivos');
if(!defined('_MSG_NOTENOUGH_USERRIGHTS'))      define('_MSG_NOTENOUGH_USERRIGHTS', 'No tienes suficiente autorizaci�n con este nivel de usuario.');
if(!defined('_MSG_SESSION_EXPIRED'))           define('_MSG_SESSION_EXPIRED', '<div align="center"><h1>�Tu tiempo de sesi�n ha finalizado!</h1><br /><strong>Por favor, autentif�cate de nuevo.</strong><br /><a href="index.php">Acceder</a></div>');
if(!defined('_MSG_NOT_FINALIZED'))             define('_MSG_NOT_FINALIZED', 'Tu documento no est� terminado. �Quieres publicarlo?');
if(!defined('_MSG_NOT_PUBLISHED'))             define('_MSG_NOT_PUBLISHED', 'El documento escogido no est� publicado todav�a. ��No puedes leerlo!!');
if(!defined('_MSG_DISABLED_MODUL'))            define('_MSG_DISABLED_MODUL', 'El m�dulo elegido est� deshabilitado. � No puedes usarlo!!');
if(!defined('_MSG_CHANGE_DATABASE_ENGINE'))    define('_MSG_CHANGE_DATABASE_ENGINE', '�Realmente quieres cambiar la base de datos?\nDeber�s desconectarte y no usar tus datos en otra base de datos.\nPerd�n, pero la importaci�n XML - SQL est� planeada...');
if(!defined('_MSG_IF_DOWNLOAD_DOES_NOT_START'))define('_MSG_IF_DOWNLOAD_DOES_NOT_START', 'Si la descarga no comienza, haz clic en el siguiente enlace');
if(!defined('_MSG_BACKUP_SUCCESSFULL'))        define('_MSG_BACKUP_SUCCESSFULL', 'Copia de seguridad de Base de datos realizada.\nTablas afectadas:');
if(!defined('_MSG_BACKUP_FAILED'))             define('_MSG_BACKUP_FAILED', '�Copia de seguridad de Base de datos fallida!');
if(!defined('_MSG_CHANGES'))                   define('_MSG_CHANGES', 'Has hecho cambios.');
if(!defined('_MSG_SAVE_NOW'))                  define('_MSG_SAVE_NOW', '�Deseas guardarlos ahora?');
if(!defined('_MSG_SEND_FAILED'))               define('_MSG_SEND_FAILED', '�Error enviando!');


// LOGIN
define('_LOGIN_MSG', 'Autentificaci�n para la administraci�n');
define('_LOGIN_USERNAME', 'Nombre de usuario');
define('_LOGIN_USERNAME_JS', '�Por favor, introduce tu nombre de usuario!');
define('_LOGIN_PASSWORD', 'Contrase�a');
define('_LOGIN_PASSWORD_JS', '�Por favor, introduce tu contrase�a!');
define('_LOGIN_FALSE', 'No v�lido: nombre de usuario, contrase�a o derechos de usuario (Grupo)');
define('_LOGIN_FALSE_LPW', 'Falso: nombre de usuario o E-mail');
define('_LOGIN_SUBMIT', 'Entrar');
define('_LOGIN_LOGOUT', 'Salir');
define('_LOGIN_PROFILE', 'Perfil');
 define('_LOGIN_LIST', 'Lista de Miembros');
define('_LOGIN_LIST_TEXT', 'Esta es la lista de todos los miembros. Haz clic en el nombre de usuario para ver su perfil.');
define('_LOGIN_ADMIN', 'Administraci�n');
define('_LOGIN_FORGOTPW', ' �Has olvidado tu contrase�a?');
define('_LOGIN_WELCOME', 'Bienvenido');
define('_LOGIN_SUBMIT_NEWS', 'Publicar noticias');
define('_LOGIN_SUBMIT_IMAGES', 'Publicar im�genes');
define('_LOGIN_CREATE_ALBUM', 'Crear �lbum');
define('_LOGIN_CREATE_CATEGORY', 'Crear categor�a');
define('_LOGIN_SUBMIT_MEDIA', 'Publicar archivos multimedia');


// REGISTRATION
define('_REG_TITLE', 'Registro');
define('_REG_LPW', '�Has perdido tu contrase�a?');
define('_REG_LPWTEXT', 'Por favor, introduce tu nombre de usuario y E-mail y haz clic en el bot�n de Enviar Contrase�a. Recibir�s en breve una nueva contrase�a. Utiliza esta nueva contrase�a para acceder al sitio.');
define('_REG_TEXT_1', 'Los campos marcados con un asterisco son obligatorios.');
define('_REG_TEXT_2', 'Los que no est�n marcados con un asterisco no son obligatorios.');
define('_REG_SUBMIT_LPW', 'Enviar contrase�a');
define('_REG_SUBMIT_SR', 'Enviar registro');
define('_REG_PWNOTAGREE', '�La contrase�a no concuerda!');
define('_REG_NAME_NG', '�No has introducido tu nombre!');
define('_REG_USERNAME_NG', '�No has introducido tu nombre de usuario!');
define('_REG_PASSWORD_NG', '�No has introducido tu contrase�a!');
define('_REG_EMAIL_NG', '�No has introducido tu E-mail!');
define('_REG_LPW_SUCCESS', 'Tu nueva contrase�a');
define('_REG_SUCCESS', 'Te has registrado con �xito');
define('_REG_NO_SUCCESS', 'El proceso de registro ha fallado');
define('_REG_SUCCESS_TEXT', 'Tu registro se ha realizado con �xito. Haz clic en el enlace y podr�s acceder al sitio con tu nombre de usuario.');
if(!defined('_REG_AUTO_MSG'))                  define('_REG_AUTO_MSG', 'Este es un mensaje autom�tico desde');
if(!defined('_REG_TEXT_LPW'))                  define('_REG_TEXT_LPW', 'Un usuario quiere obtener una nueva contrase�a. Esta es tu nueva contrase�a.');
if(!defined('_REG_VALIDATE'))                  define('_REG_VALIDATE', 'Enhorabuena, ahora est�s registrado. Introduce en los campos tu nombre de usuario y la contrase�a para tener acceso.');
if(!defined('_REG_NO_VALIDATE'))               define('_REG_NO_VALIDATE', 'Error, tu c�digo de validaci�n no es correcto.');
if(!defined('_REG_USERPROFILE'))               define('_REG_USERPROFILE', 'Truco: Puedes cambiar algunos ajustes como tu contrase�a, nombre de usuario y otros datos en tu perfil.');
if(!defined('_REG_EMAIL'))                     define('_REG_EMAIL', 'Se ha registrado un nuevo usuario.');
if(!defined('_REG_SUCCESS_MAIL'))              define('_REG_SUCCESS_MAIL', 'Se ha registrado un nuevo usuario en tu p�gina web.');


// PROFILE
if(!defined('_PROFILE_TITLE'))                 define('_PROFILE_TITLE', 'Viendo perfil de usuario');
if(!defined('_PROFILE_EDIT'))                  define('_PROFILE_EDIT', 'Editar perfil de usuario');


// USERPAGES
define('_USERPAGE', 'P�ginas de usuario');
define('_USERPAGE_TEXT', 'Puedes realizar ajustes en las p�ginas de usuario como tu perfil en la configuraci�n de la p�gina de usuario. Tambi�n podr�s tener la posibilidad de publicar noticias, im�genes y �lbumes.');
define('_USERPAGE_TEXT_WIDTH', 'Ancho del campo de texto');
define('_USERPAGE_INPUT_WIDTH', 'Ancho del campo de pregunta');
define('_USERPAGE_PUBLISH_NEWS', 'El usuario puede publicar noticias desde el frontpage');
define('_USERPAGE_PUBLISH_IMAGES', 'El usuario puede publicar im�genes desde el frontpage');
define('_USERPAGE_PUBLISH_ALBUMS', 'El usuario puede publicar �lbumes desde el frontpage');
define('_USERPAGE_CREATE_CATEGORIES', 'El usuario puede crear categor�as de noticias desde el frontpage');
define('_USERPAGE_PUBLISH_PICTURE', 'El usuario puede publicar im�genes al gestor multimedia desde el frontpage');


// START
define('_START_MSG', 'Bienvenido');
define('_START_QUESTION', '�Qu� vas a hacer hoy?');
define('_START_TEXT_0', '<strong>Echa un vistazo a tu escritorio.</strong> Puedes encontrar en tu escritorio todas las tareas pendientes, notas y una descripci�n de todos los documentos y noticias en los que tienes que trabajar.');
define('_START_TEXT_1', '<strong>Crear una p�gina.</strong> Para hacer esto, crea una entrada de men� y ed�tala a continuaci�n en la p�gina de contenido est�tico y en el contenido de la barra lateral.');
define('_START_TEXT_2', '<strong>Editar los ajustes del sistema.</strong> Puedes cambiar el nombre y el t�tulo de tu sitio, o puedes editar las metatags.');
define('_START_TEXT_3', '<strong>Escribir una noticia.</strong> Vete al gestor de noticias y escribe las noticias que te interesen.');
define('_START_TEXT_4', '<strong>Carga una im�gen en tu galer�a de imagenes.</strong> Y muestra a la gente tus opiniones de las situaciones m�s divertidas.');


// DESKTOP
define('_DESKTOP_TOP_TEXT', 'Si deseas editar el contenido de una p�gina, por favor, haz clic en el t�tulo de la p�gina en el �rbol de p�ginas a la izquierda.');
define('_DESKTOP_UNPUBLISHED_NEWS', 'Noticias no publicadas');
define('_DESKTOP_UNPUBLISHED_PAGES', 'Documentos no publicados');
define('_DESKTOP_UNFINISHED_PAGES', 'Documentos no terminados');


// SIDEMENU
if(!defined('_SIDEMENU_TITLE'))                define('_SIDEMENU_TITLE', 'Enlaces del men� lateral');
if(!defined('_SIDEMENU_TEXT'))                 define('_SIDEMENU_TEXT', 'Aqu� puedes crear tu men� principal. La ID muestra el orden de tu men�, las SUB ID muestra el orden de tu submen�, CID es la ID del contenido o extensi�n de las p�ginas a enlazar. Puedes editar cada entrada haciendo clic sobre ellas.');


// SIDEMENU
if(!defined('_CS_TITLE'))                      define('_CS_TITLE', 'Objetos del sistema de componentes');
if(!defined('_CS_TEXT'))                       define('_CS_TEXT', 'Esta es una lista de todos tus componentes instalados. Puedes cambiar sus ajustes.');


// TOPMENU
if(!defined('_TOPMENU_TITLE'))                 define('_TOPMENU_TITLE', 'Enlaces del men� superior');
if(!defined('_TOPMENU_TEXT'))                  define('_TOPMENU_TEXT', 'Aqu� puedes crear tu men� superior. La ID es el orden de tu men�, CID is la ID del contenido o extensi�n de las p�ginas a enlazar.');


// MENUTITLE
if(!defined('_MENUTITLE_TITLE'))               define('_MENUTITLE_TITLE', 'T�tulo del men�');
if(!defined('_MENUTITLE_TEXT'))                define('_MENUTITLE_TEXT', 'El N�mero-Posici�n marca el lugar en el men�.');


// CONTENT
define('_CONTENT_TITLE', 'Muestra las p�ginas de contenido est�tico');
define('_CONTENT_TEXT', 'El N�mero-ID es el n�mero que necesitas para enlazar todas las p�ginas.');
define('_CONTENT_TEXT_PAGE', 'Por favor, introduce todos los datos aqu�. T�tulo de la p�gina, el subt�tulo, el texto y, si quieres, una nota a pi� de p�gina.');
define('_CONTENT_TEMPLATE', 'Plantilla de contenido');
define('_CONTENT_SECOND', 'Segundo texto');
define('_CONTENT_OLDIMAGE', 'Im�gen vieja');
define('_CONTENT_IMAGEUNDER', 'Im�gen bajo el texto');
define('_CONTENT_IMAGERIGHT', 'Im�gen a la derecha del texto');
define('_CONTENT_FOOT', 'Pi� de p�gina');
define('_CONTENT_NEXT_PAGE', 'P�gina siquiente');
define('_CONTENT_LAST_PAGE', 'Ultima P�gina');
define('_CONTENT_BACK_PAGE', 'Una P�gina atr�s');
define('_CONTENT_FIRST_PAGE', 'Primera P�gina');
define('_CONTENT_LAST_UPDATE', 'Ultima Actualizada');
if(!defined('_CONTENT_NEW_LANG_DOCUMENT'))     define('_CONTENT_NEW_LANG_DOCUMENT', 'Nuevo documento en otro idioma');
if(!defined('_CONTENT_ORG_DOCUMENT'))          define('_CONTENT_ORG_DOCUMENT', 'Documento Original');



// IMPRESSUM
define('_IMPRESSUM_CONFIG', 'Configuraci�n de la impresi�n');
define('_IMPRESSUM_ID', 'ID');
define('_IMPRESSUM_TITLE', 'T�tulo de la impresi�n');
define('_IMPRESSUM_SUBTITLE', 'Subt�tulo de la impresi�n');
define('_IMPRESSUM_CONTACT', 'Persona de contacto');
define('_IMPRESSUM_NO_CONTACT', 'Sin Persona de contacto');
define('_IMPRESSUM_SELECT', 'Por favor, escoge');
define('_IMPRESSUM_TAX', 'N�mero de Fax');
define('_IMPRESSUM_UST', 'Ust. Id.');
define('_IMPRESSUM_LEGAL', 'Condiciones legales');
define('_IMPRESSUM_PHONE', 'Tel�fono');
define('_IMPRESSUM_FAX', 'Fax');
define('_IMPRESSUM_CONTACTPERSON', 'Persona de contacto');
define('_IMPRESSUM_OFFICE', 'Oficina');
define('_IMPRESSUM_EMAIL', 'E-mail');
define('_IMPRESSUM_COPY', 'Todos los derechos reservados.');
define('_IMPRESSUM_SITECOPY', 'El contenido de este sitio tiene copyright de');


// SIDEBAR
if(!defined('_SIDE_TEXT'))                     define('_SIDE_TEXT', 'El N�mero-ID es el n�mero que necesitas para enlazar todas las p�ginas.');
if(!defined('_SIDE_CONTACTS'))                 define('_SIDE_CONTACTS', 'Contactos');


// HELP
if(!defined('_HELP_SUPPORTED_CHARSETS'))       define('_HELP_SUPPORTED_CHARSETS', 'Caracteres soportados');


// GROUPS
if(!defined('_GROUP_DEV'))                     define('_GROUP_DEV', 'Desarrollo y mantenimiento');
if(!defined('_GROUP_ADMIN'))                   define('_GROUP_ADMIN', 'Administrador');
if(!defined('_GROUP_WRITER'))                  define('_GROUP_EDITOR', 'Editor');
if(!defined('_GROUP_EDITOR'))                  define('_GROUP_TESTER', 'Probador del sitio web');
if(!defined('_GROUP_PRESENTER'))               define('_GROUP_PRESENTER', 'Presentador del foro');
if(!defined('_GROUP_USER'))                    define('_GROUP_USER', 'Usuario del sitio');


// TCMS SCRIPT
if(!defined('_TCMSSCRIPT_BR'))                 define('_TCMSSCRIPT_BR', 'Salto de l�nea');
if(!defined('_TCMSSCRIPT_MORE'))               define('_TCMSSCRIPT_MORE', 'Parar noticias personalizadas para el frontpage');
if(!defined('_TCMSSCRIPT_IMAGES'))             define('_TCMSSCRIPT_IMAGES', 'Navegar por las im�genes');


// GLOBAL ID
if(!defined('_NEWPAGE_TITLE'))                 define('_NEWPAGE_TITLE', 'Crear una nueva p�gina');
if(!defined('_NEWPAGE_TEXT'))                  define('_NEWPAGE_TEXT', 'Con este di�logo podr�s crear una nueva p�gina. Escoge un t�tulo, el men�, tambi�n un submen� si quieres y el nivel de acceso.');


// EXPLORER
if(!defined('_EXPLORE_UP'))                    define('_EXPLORE_UP', 'Desplazar entrada hacia arriba.');
if(!defined('_EXPLORE_DOWN'))                  define('_EXPLORE_DOWN', 'Desplazar entrada hacia abajo.');


// NOTEBOOK
if(!defined('_NOTEBOOK_TITLE'))                define('_NOTEBOOK_TITLE', 'Bloc de notas personal');
if(!defined('_NOTEBOOK_TEXT'))                 define('_NOTEBOOK_TEXT', 'Este es tu bloc de notas personal. Aqu� puedes escribir tus ideas, proyectos de trabajo, etc. Solo lo puedes ver tu.');
if(!defined('_NOTEBOOK_DETAIL'))               define('_NOTEBOOK_DETAIL', 'Tu bloc de notas');
if(!defined('_NOTEBOOK_MSG'))                  define('_NOTEBOOK_MSG', 'Tu bloc de notas te necesita');


// EXTENSIONS
if(!defined('_EXT_NEWS'))                      define('_EXT_NEWS', 'Gestor de noticias');
if(!defined('_EXT_NEWS_NEWSAMOUNT'))           define('_EXT_NEWS_NEWSAMOUNT', 'Cantidad de noticias en el gestor de noticias (no en archivo)');
if(!defined('_EXT_NEWS_ID'))                   define('_EXT_NEWS_ID', 'ID');
if(!defined('_EXT_NEWS_TITLE'))                define('_EXT_NEWS_TITLE', 'T�tulo de la p�gina de noticias');
define('_EXT_NEWS_SUBTITLE', 'Subt�tulo de la p�gina de noticias');
define('_EXT_NEWS_IMAGE', 'Im�gen de la p�gina de noticias');
define('_EXT_NEWS_USE_COMMENTS', 'Utilizar comentarios');
define('_EXT_NEWS_USE_EMOTICONS', 'Utilizar emoticones en los comentarios');
define('_EXT_NEWS_USE_GRAVATAR', 'Utilizar avatar para los usuarios');
define('_EXT_NEWS_USE_AUTOR', 'Mostrar el autor de la noticia');
define('_EXT_NEWS_USE_AUTOR_LINK', 'Mostrar el autor de la noticia como enlace');
define('_EXT_NEWS_D_TIMESINCE', 'Desde hace');
define('_EXT_NEWS_D_DATE', 'Fecha Normal');
define('_EXT_NEWS_D_TEXT', 'Representaci�n Textual');
if(!defined('_EXT_NEWS_DISPLAY'))              define('_EXT_NEWS_DISPLAY', 'Representaci�n de la fecha');
if(!defined('_EXT_NEWS_DISPLAY_MORE'))         define('_EXT_NEWS_DISPLAY_MORE', 'Representaci�n del <em>leer m�s</em>-Enlace');
if(!defined('_EXT_NEWS_MORE_NL_LEFT'))         define('_EXT_NEWS_MORE_NL_LEFT', 'Nueva l�nea - alinear a la izquierda');
if(!defined('_EXT_NEWS_MORE_NL_RIGHT'))        define('_EXT_NEWS_MORE_NL_RIGHT', 'Nueva l�nea - alineaci�n a la derecha');
if(!defined('_EXT_NEWS_MORE_NL_DIRECT'))       define('_EXT_NEWS_MORE_NL_DIRECT', 'En l�nea - despu�s de texto');
if(!defined('_EXT_NEWS_NEWS_SPACING'))         define('_EXT_NEWS_NEWS_SPACING', 'Espaciado de noticias');
define('_EXT_NEWS_SELECT', 'Por favor, selecciona');
define('_EXT_NEWS_DESELECT', 'Sin imagen');
define('_EXT_NEWS_USE_FEEDS', 'Sindicar');
define('_EXT_NEWS_USE_RSS091', 'Usar RSS 0.91');
define('_EXT_NEWS_USE_RSS10', 'Usar RSS 1.0');
define('_EXT_NEWS_USE_RSS20', 'Usar RSS 2.0');
define('_EXT_NEWS_USE_ATOM03', 'Usar ATOM 0.3');
define('_EXT_NEWS_USE_OPML', 'Usar OPML');
define('_EXT_NEWS_SYN_AMOUNT', 'Cantidad de noticias en sindicar');
define('_EXT_NEWS_USE_SYN_TITLE', 'Usar t�tulo de sindicar en la barra lateral');
define('_EXT_NEWS_DEFAULT_FEED', 'Sindicaci�n por defecto');
define('_EXT_NEWS_USE_TRACKBACK', 'Usar Trackback');
define('_EXT_CFORM', 'Formulario de contacto');
define('_EXT_CFORM_SHOW_CONTACTS_IN_SIDEBAR', 'Mostrar contactos en la barra lateral');
define('_EXT_CFORM_USE_ADRESSBOOK', 'Usar Libro Direcciones');
define('_EXT_CFORM_USE_CONTACTPERSON', 'Mostrar persona contacto');
define('_EXT_CFORM_EMAIL', 'E-Mail');
define('_EXT_CFORM_ID', 'ID');
define('_EXT_CFORM_TITLE', 'T�tulo del formulario de contacto');
define('_EXT_CFORM_SUBTITLE', 'Subt�tulo del formulario de contacto');
if(!defined('_EXT_CFORM_SHOW_CONTACTEMAIL'))   define('_EXT_CFORM_SHOW_CONTACTEMAIL', 'Mostrar direcci�n correo de contacto');
define('_EXT_BOOK', 'Libro de visitas');
define('_EXT_BOOK_ID', 'ID');
define('_EXT_BOOK_TITLE', 'T�tulo del libro de visitas');
define('_EXT_BOOK_SUBTITLE', 'Subt�tulo del libro de visitas');
define('_EXT_BOOK_ADMINPASS', 'Contrase�a de administraci�n');
define('_EXT_BOOK_ADMINUSER', 'Nombre de usuario de administraci�n');
define('_EXT_BOOK_ADMINCOLOR', 'Color del texto de administraci�n');
define('_EXT_BOOK_ENTRYCOLOR', 'N�mero de entrada de color');
define('_EXT_DOWNLOAD', 'Configuraci�n del gestor de descargas');
define('_EXT_DOWNLOAD_ID', 'ID');
define('_EXT_DOWNLOAD_TITLE', 'T�tulo del gestor de descargas');
define('_EXT_DOWNLOAD_SUBTITLE', 'Subt�tulo del gestor de descargas');
define('_EXT_DOWNLOAD_TEXT', 'Texto del gestor de descarga');


// GALLERY
if(!defined('_GALLERY_CONFIG'))                define('_GALLERY_CONFIG', 'Configuraci�n de la galer�a de Im�genes');
if(!defined('_GALLERY_ID'))                    define('_GALLERY_ID', 'ID');
if(!defined('_GALLERY_COMMENTS'))              define('_GALLERY_COMMENTS', 'Usar comentarios');
define('_GALLERY_FRONT_TITLE', 'T�tulo de la galer�a');
define('_GALLERY_FRONT_SUBTITLE', 'Subt�tulo de la galer�a');
define('_GALLERY_CREATE', 'Crear un nuevo �lbum');
define('_GALLERY_NEW', 'Nuevo �lbum');
define('_GALLERY_DESCRIPTION', 'Descripci�n');
define('_GALLERY_TITLE', 'Galer�a');
define('_GALLERY_THISIS', 'Este es el');
define('_GALLERY_THISIS2', '�lbum');
define('_GALLERY_THISIS3', 'Carga aqu� tus im�genes, b�rralas o edita su descripci�n. Pero ten en cuenta grabar una descripci�n de imagen a la vez.');
define('_GALLERY_IMGTITLE', 'T�tulo');
define('_GALLERY_IMGSIZE', 'Tama�o del archivo');
define('_GALLERY_IMGRESOLUTION', 'Resoluci�n');
define('_GALLERY_AMOUNT', 'Cantidad');
define('_GALLERY_IMG_DETAILS', 'Usar detalles de la im�gen');
define('_GALLERY_FTP_UPLOAD', 'Todos los �lbumes disponibles');
define('_GALLERY_FTP_UPLOAD_TEXT', 'Si has subido las im�genes mediante un cliente FTP a la carpeta "data/images/albums/" puedes convertir ese �lbum en una galer�a de toendaCMS. Por favor, escoge un �lbum para convertirlo en una galeria de toendaCMS.');
define('_GALLERY_UPLOAD', 'Subir im�genes');
define('_GALLERY_TEXT', 'Si tienes un �lbum comprimido (.zip), puedes subirlo a la carpeta y luego convertirlo.');
define('_GALLERY_ZTITLE', 'Subir e instalar archivo comprimido');
define('_GALLERY_ZFILE', 'Archivo comprimido (.zip)');
define('_GALLERY_POSTED', 'Subido el');
define('_GALLERY_GRAVATAR', 'Aqu� puedes cambiar algunos ajustes de la galer�a de im�genes. Pero si quieres activar/desactivar avatares o emoticones, vete a <a href="admin.php?id_user='.$id_user.'&amp;site=mod_news&amp;todo=config">Opciones Gestor de Noticias</a>');
define('_GALLERY_LAST_SHOW', 'Mostrar im�genes m�s recientes en el men� lateral');
define('_GALLERY_LAST_SHOW_TITLE', 'Mostrar el t�tulo de las nuevas im�genes');
define('_GALLERY_LAST_MAX_IMG', 'Cuantas im�genes');
define('_GALLERY_LAST_SIZE', 'Tama�o de las im�genes');
define('_GALLERY_LAST_TEXT', 'Texto para las nuevas im�genes');
define('_GALLERY_LAST_ALIGN', 'Alineaci�n para las nuevas im�genes');
define('_GALLERY_LIST_NORMAL', 'Lista de im�genes Normal (una bajo la otra con informaci�n)');
define('_GALLERY_LIST_3_THUMB', '3 miniaturas por lado');
if(!defined('_GALLERY_MIMETYPE'))              define('_GALLERY_MIMETYPE', 'Mimetype');


// PERSON
define('_PERSON_NAME', 'Nombre');
define('_PERSON_USERNAME', 'Nombre de usuario');
define('_PERSON_POSITION', 'Cargo');
define('_PERSON_OCCUPATION', 'Ocupaci�n');
define('_PERSON_GROUP', 'Grupo de usuarios');
define('_PERSON_JOINDATE', 'Adherido');
define('_PERSON_RIGHTS', 'Derechos de usuario');
define('_PERSON_EMAIL', 'Correo electr�nico');
define('_PERSON_PASSWORD', 'Contrase�a');
define('_PERSON_AS_MD5', 'Serie MD5');
define('_PERSON_VPASSWORD', 'Verificar contrase�a');
define('_PERSON_STREET', 'Calle');
define('_PERSON_STATE', 'Provincia');
define('_PERSON_TOWN', 'Localidad');
define('_PERSON_COUNTRY', 'Pa�s');
define('_PERSON_POSTAL', 'C�digo postal');
define('_PERSON_PHONE', 'Tel�fono');
define('_PERSON_FAX', 'Fax');
define('_PERSON_DETAILS', 'Detalles');
define('_PERSON_WWW', 'P�gina de inicio');
define('_PERSON_ICQ', 'N�mero ICQ');
define('_PERSON_AIM', 'Nombre AIM');
define('_PERSON_YIM', 'YIM Messenger');
define('_PERSON_MSN', 'MSN Messenger');
define('_PERSON_SKYPE', 'Skype');
define('_PERSON_BIRTHDAY', 'Cumplea�os');
define('_PERSON_SEX', 'G�nero');
define('_PERSON_SEX_MAN', 'Hombre');
define('_PERSON_SEX_WOMAN', 'Mujer');
define('_PERSON_SEX_KA', 'Sin informaci�n');
define('_PERSON_TCMS_ENABLED', 'Script TCMS activado');
define('_PERSON_SIGNATURE', 'Firma');
define('_PERSON_HOBBY', 'Aficiones');
if(!defined('_PERSON_LOCATION'))               define('_PERSON_LOCATION', 'Residencia');
if(!defined('_PERSON_LASTLOGIN'))              define('_PERSON_LASTLOGIN', 'Ultima Autentificaci�n');


// SIDE EXTENSIONS
define('_SIDEEXT_SIDEMENU', 'Men� lateral');
define('_SIDEEXT_SIDEMENU_TITLE', 'T�tulo del men� lateral');
define('_SIDEEXT_SIDEMENU_SHOW', 'Mostrar t�tulo del men� lateral');
define('_SIDEEXT_SIDEBAR', 'Barra lateral');
define('_SIDEEXT_SIDEBAR_SHOW_TITLE', 'Mostrar t�tulo de la barra lateral');
define('_SIDEEXT_SIDEBAR_TITLE', 'T�tulo de la barra lateral');
define('_SIDEEXT_SIDEBAR_SHOW', 'Mostrar barra lateral');
define('_SIDEEXT_TC', 'Gestor de plantillas');
define('_SIDEEXT_TC_SHOW_TITLE', 'Mostrar t�tulo del gestor de plantillas');
define('_SIDEEXT_TC_TITLE', 'T�tulo del gestor de plantillas');
define('_SIDEEXT_TC_SHOW', 'Mostrar gestor de plantillas');
define('_SIDEEXT_SEARCH', 'B�squeda');
define('_SIDEEXT_SEARCH_SHOW_TITLE', 'Mostrar t�tulo de b�squeda');
define('_SIDEEXT_SEARCH_TITLE', 'T�tulo de b�squeda');
define('_SIDEEXT_SEARCH_RESULT_TITLE', 'T�tulo de resultados de la b�squeda');
define('_SIDEEXT_SEARCH_ALIGNMENT', 'Alineaci�n de la caja de b�squeda');
define('_SIDEEXT_SEARCH_WITH_BR', 'under bot�n de b�squeda');
define('_SIDEEXT_SEARCH_WITH_BUTTON', 'Mostrar bot�n de b�squeda');
define('_SIDEEXT_SEARCH_WORD', 'Palabra de b�squeda en campo de b�squeda');
define('_SIDEEXT_SEARCH_SHOW', 'Mostrar buscar');
define('_SIDEEXT_LOGIN', 'Acceso');
define('_SIDEEXT_LOGIN_TITLE', 'T�tulo de acceso');
define('_SIDEEXT_USERM_TITLE', 'T�tulo del men� de usuario');
define('_SIDEEXT_LOGIN_SHOW', 'Mostrar acceso');
define('_SIDEEXT_LOGIN_USER', 'Campo de acceso del nombre de usuario');
define('_SIDEEXT_LOGIN_PASS', 'Campo de acceso de contrase�a');
define('_SIDEEXT_LOGIN_ACCOUNT', 'Texto para SIN CUENTA');
define('_SIDEEXT_LOGIN_REG', 'Enlace de registro');
define('_SIDEEXT_LOGIN_MENU', 'Utilizar men� de usuario');
define('_SIDEEXT_LOGIN_ALLOW', 'Permitir registro');
define('_SIDEEXT_LOGIN_SHOW_TITLE', 'Mostrar t�tulo de acceso');
 define('_SIDEEXT_LOGIN_SHOW_MEMBERLIST', 'Mostrar lista de miembros');
define('_SIDEEXT_NEWS', 'Noticias');
define('_SIDEEXT_NEWS_CATEGORIES_SHOW', 'Mostrar categor�a de noticias');
define('_SIDEEXT_NEWS_ARCHIVES_SHOW', 'Mostrar Archivos de Noticias');
define('_SIDEEXT_NEWS_CATEGORIES_AMOUNT_SHOW', 'Mostrar cantidad de noticias en categor�as');
define('_SIDEEXT_MODUL', 'M�dulos');
if(!defined('_SIDEEXT_LANGUAGE_SELECTOR'))     define('_SIDEEXT_LANGUAGE_SELECTOR', 'Selector de Idioma');


// NEWSLETTER
define('_NL_CONFIG', 'Configuraci�n del bolet�n de noticias');
define('_NL_TITLE', 'T�tulo del bolet�n de noticias');
define('_NL_SHOW_TITLE', 'Mostrar t�tulo del bolet�n de noticias');
define('_NL_TEXT', 'Texto del bolet�n de noticias');
define('_NL_SUBMIT', 'Bot�n de enviar el bolet�n de noticias');
define('_NL_SHOW', 'Utilizar bolet�n de noticias');
define('_NL_SEND', 'Enviar bolet�n de noticias');
define('_NL_SUBJECT', 'Asunto');
define('_NL_MESSAGE', 'Mensaje');
define('_NL_USER', 'Mostrar todos los usuarios del bolet�n de noticias');
define('_NL_NEWUSER', 'Crear un nuevo usuario del bolet�n de noticias.');
define('_NL_EDITUSER', 'Editar usuario del bolet�n de noticias.');
define('_NL_USERNAME', 'tu nombre aqu�');
define('_NL_USEREMAIL', 'tu E-mail aqu�');
define('_NL_MAILMESSAGE', 'Si no deseas recibir el bolet�n de noticias en el futuro, contesta con');
define('_NL_CHECKSTRING', 'POR FAVOR, NO ENVIAR BOLET�N DE NOTICIAS');
define('_NL_CHECKFORUNSUBSCRIBE', 'Comprobar E-mails de los usuarios no suscritos');
define('_NL_CHECK', 'Verificar');
define('_NL_MAILSCHECKED', 'E-Mail verificado ...');
define('_NL_CHECKTITLE', 'Verificar E-mails de los usuarios que desean eliminar la suscripci�n');
define('_NL_CHECKTEXT', 'Ahora verificamos los E-mails en tu cuenta de correo, para los correos que tengan la cadena de no suscripci�n. Si alguno de ellos tiene esta cadena de no suscripci�n, se proceder� a comprobar que el usuario existe, y en ese caso, se borrar�.');


// USER
if(!defined('_USER_TITLE'))                    define('_USER_TITLE', 'Mostrar usuarios');
if(!defined('_USER_TEXT'))                     define('_USER_TEXT', 'Aqu� tienes una lista de todos los usuarios. Algunos de ellos son usuarios de administraci�n.');
if(!defined('_USER_SELF'))                     define('_USER_SELF', 'Nombre Usuario Conocido');
if(!defined('_USER_ALL'))                      define('_USER_ALL', 'Todos los usuarios');


// CONTACTS
if(!defined('_CONTACT_TITLE'))                 define('_CONTACT_TITLE', 'Mostrar Contactos');
if(!defined('_CONTACT_TEXT'))                  define('_CONTACT_TEXT', 'Aqu� tienes una lista de todos tus contactos. Algunos se muestran en la p�gina de contactos.');
if(!defined('_CONTACT_ADRESS_BOOK'))           define('_CONTACT_ADRESS_BOOK', 'Libro de Direcciones');
if(!defined('_CONTACT_ADRESS_EMAIL'))          define('_CONTACT_ADRESS_EMAIL', 'Email de Contacto');
if(!defined('_CONTACT_SEND_A_EMAIL'))          define('_CONTACT_SEND_A_EMAIL', 'Enviar un eMail');
if(!defined('_CONTACT_DETAIL'))                define('_CONTACT_DETAIL', 'Detalles Contacto');
if(!defined('_CONTACT_VCARD'))                 define('_CONTACT_VCARD', 'vCard');
if(!defined('_CONTACT_VCARD_IMPORT_TEXT'))     define('_CONTACT_VCARD_IMPORT_TEXT', 'Si tienes un archivo .vcf, s�belo y toendaCMS importar� el contacto autom�ticamente.');
if(!defined('_CONTACT_VCARD_VCF'))             define('_CONTACT_VCARD_VCF', 'Archivo vCard .vcf');
if(!defined('_CONTACT_VCARD_DOWNLOAD'))        define('_CONTACT_VCARD_DOWNLOAD', 'Descargar vCard');


// GLOBALS
if(!defined('_GLOBAL_CONFIG'))                 define('_GLOBAL_CONFIG', 'Config. sitio');
if(!defined('_GLOBAL_TITLE'))                  define('_GLOBAL_TITLE', 'T�tulo del sitio');
define('_GLOBAL_NAME', 'Nombre del sitio');
define('_GLOBAL_SUBTITLE', 'Subt�tulo del sitio');
define('_GLOBAL_LOGO', 'Logo del sitio');
define('_GLOBAL_OWNER', 'Due�o');
define('_GLOBAL_URL', 'URL');
define('_GLOBAL_TCMSLOGO', 'Mostrar el logo toendaCMS en el pi� de p�gina');
define('_GLOBAL_TCMSLOGO_IN_SITETITLE', 'Mostrar el nombre toendaCMS en el t�tulo del sitio');
define('_GLOBAL_PAGELOADINGTIME', 'Mostrar en tiempo de carga de la p�gina en el pi� de p�gina');
define('_GLOBAL_EMAIL', 'E-mail por defecto');
define('_GLOBAL_YEAR', 'A�o del Copyright');
define('_GLOBAL_CHARSET', 'Juego de car�cteres');
define('_GLOBAL_LANG', 'Lenguaje de administraci�n');
define('_GLOBAL_FRONT_LANG', 'Lenguaje del sitio');
define('_GLOBAL_WYSIWYG', 'Utilizar editor WYSIWYG');
define('_GLOBAL_SITE_NAVI', 'Navegaci�n');
define('_GLOBAL_SITE_NAVI_TOP', 'Men� superior');
define('_GLOBAL_SITE_NAVI_SIDE', 'Men� lateral');
define('_GLOBAL_META', 'Metadata para la cabeza HTML');
define('_GLOBAL_METATAGS', 'Etiquetas Meta');
define('_GLOBAL_DESCRIPTION', 'Descripci�n');
define('_GLOBAL_CURRENCY', 'Moneda');
define('_GLOBAL_LEGAL_LINK_IN_FOOTER', 'Mostrar enlace de t�rminos legales en el pi� de p�gina');
define('_GLOBAL_ADMIN_LINK_IN_FOOTER', 'Mostrar enlace de Administraci�n en el pi� de p�gina');
define('_GLOBAL_DEFAULT_FOOTER', 'Mostrar p�e por defecto de toendaCMS');
define('_GLOBAL_ACTIVE_TOPMENU_LINKS', 'Utilizar clases CSS para los enlaces activos del men� superior');
define('_GLOBAL_FOOTER_TEXT', 'Texto del pi� de p�gina personalizado');
define('_GLOBAL_MAIL_SETTINGS', 'Ajustes Servidor Correo');
if(!defined('_GLOBAL_MAIL_SERVER'))            define('_GLOBAL_MAIL_SERVER', 'Servidor de correo POP3');
define('_GLOBAL_MAIL_PORT', 'Puerto del servidor de correo');
define('_GLOBAL_MAIL_POP3', 'POP3');
define('_GLOBAL_MAIL_USER', 'Nombre de usuario del E-mail');
define('_GLOBAL_MAIL_PASSWORD', 'Contrase�a del E-mail');
define('_GLOBAL_USE_STATISTICS', 'Utilizar estad�sticas');
define('_GLOBAL_USE_NEW_ADMINMENU', 'Usar nuevo men� de administraci�n');
define('_GLOBAL_SEO', 'SEO URL');
define('_GLOBAL_SEO_ENABLED', 'SEO habilitado');
define('_GLOBAL_SEO_FOLDER', 'Directorio de toendaCMS en Servidor');
define('_GLOBAL_SEO_FORMAT', 'Formato SEO');
define('_GLOBAL_SITE_OFFLINE', 'Sitio Apagado');
define('_GLOBAL_SITE_OFFLINE_TEXT', 'Texto para sitio apagado');
define('_GLOBAL_PASTE_FOOTER_TEXT', 'Pegar texto de muestra');
define('_GLOBAL_SHOW_TOP_PAGES', 'Mostrar p�ginas en la parte superior de un documento');
define('_GLOBAL_CIPHER_EMAIL', 'Siempre cifrar direcciones de correo');
define('_GLOBAL_JS_BROWSER_DETECTION', 'Detectar navegador del usuario con JavaScript');
define('_GLOBAL_USE_CS', 'Usar componentes de sistema de toendaCMS');
define('_GLOBAL_SECURITY', 'Seguridad');
define('_GLOBAL_CAPTCHA', 'Usar captcha para los comentarios');
define('_GLOBAL_CAPTCHA_CLEAN', 'Tama�o de la cache captcha a limpiar');
define('_GLOBAL_SHOW_DOC_AUTOR', 'Mostar autor del documento');
define('_GLOBAL_PATHWAY_CHAR', 'Car�cter para la ruta');
define('_GLOBAL_ANTI_FRAME', 'Frame-Killer (toendaCMS no puede ser cargado dentro de un frame)');
if(!defined('_GLOBAL_MAIL_WITH_SMTP'))         define('_GLOBAL_MAIL_WITH_SMTP', 'Enviar emails con SMTP');
if(!defined('_GLOBAL_MAIL_AS_HTML'))           define('_GLOBAL_MAIL_AS_HTML', 'Enviar emails como HTML');
if(!defined('_GLOBAL_REVISIT_AFTER'))          define('_GLOBAL_REVISIT_AFTER', 'D�as para reindexaci�n por un motor de b�squeda');
if(!defined('_GLOBAL_ROBOTSFILE'))             define('_GLOBAL_ROBOTSFILE', 'URL para el archivo "robots.txt"');
if(!defined('_GLOBAL'))                        define('_GLOBAL', 'Sitio');
if(!defined('_GLOBAL_PDFLINK_IN_FOOTER'))      define('_GLOBAL_PDFLINK_IN_FOOTER', 'Mostrar enlace PDF en pie de p�gina');
if(!defined('_GLOBAL_CACHE_CONTROL'))          define('_GLOBAL_CACHE_CONTROL', 'Opciones m�quina busqueda-Chache');
if(!defined('_GLOBAL_PRAGMA'))                 define('_GLOBAL_PRAGMA', 'Searchmachine Pragma');
if(!defined('_GLOBAL_EXPIRES'))                define('_GLOBAL_EXPIRES', 'El sitio puede caducar');
if(!defined('_GLOBAL_ROBOTSSETTINGS'))         define('_GLOBAL_ROBOTSSETTINGS', 'Opciones para los robots del sitio (Webcrawler)');
if(!defined('_GLOBAL_LAST_CHANGES'))           define('_GLOBAL_LAST_CHANGES', '�ltimos cambios');
if(!defined('_GLOBAL_USE_CONTENT_LANG'))       define('_GLOBAL_USE_CONTENT_LANG', 'Usa este idioma en el contenido');
if(!defined('_GLOBAL_VALIDLINKS'))             define('_GLOBAL_VALIDLINKS', 'Mostrar enlaces web Estandar');

// POLL
if(!defined('_POLL_MAINTITLE'))                define('_POLL_MAINTITLE', 'M�dulo de encuestas');
if(!defined('_POLL_ALL_TITLE'))                define('_POLL_ALL_TITLE', 'Todas las encuestas');
define('_POLL_TITLE', 'T�tulo del m�dulo de encuentas');
define('_POLL_SHOW_TITLE', 'Mostrar t�tulo de la encuesta');
define('_POLL_ALLPOLL_TITLES', 'Todos los t�tulos de las encuestas');
define('_POLL_SHOW', 'Mostrar encuesta en la barra lateral');
define('_POLL_TITLE_SIDEMENU', 'Men� lateral');
define('_POLL_MENU_TITLE', 'Enlace del t�tulo de la encuesta');
define('_POLL_MENU_SHOW', 'Mostrar enlace de la encuesta');
define('_POLL_MENU_POS', 'Que lugar');
define('_POLL_TITLE_TOPMENU', 'Men� superior');
define('_POLL_VOTETEXT', '�Gracias por tu voto!');
define('_POLL_RESULTTEXT', 'Ya has votado en esta encuesta.');
define('_POLL_ALLPOLLS', 'Todas las encuestas');
define('_POLL_RESULT', 'Resultado');
define('_POLL_POLLS_INACTIVE', 'No hay ahora encuestas activas.');
define('_POLL_SIDE_WIDTH', 'Ancho de la encuesta en la barra lateral');
define('_POLL_MAIN_WIDTH', 'Ancho de la encuesta en contenido');
define('_POLL_ANSWERS', 'Respuestas');


// PATHWAY
if(!defined('_PATH_HOME'))                     define('_PATH_HOME', 'Inicio');
if(!defined('_PATH_REGISTRATION'))             define('_PATH_REGISTRATION', 'Registro');
if(!defined('_PATH_PROFILE'))                  define('_PATH_PROFILE', 'Perfil de usuario');
if(!defined('_PATH_POLLS'))                    define('_PATH_POLLS', 'Todas las encuestas');
if(!defined('_PATH_LOSTPW'))                   define('_PATH_LOSTPW', '�Has perdido tu contrase�a?');
if(!defined('_PATH_SEARCH'))                   define('_PATH_SEARCH', 'Buscar');
if(!defined('_PATH_LEGAL'))                    define('_PATH_LEGAL', 'Informaci�n legal');
if(!defined('_PATH_LINKS'))                    define('_PATH_LINKS', 'Enlaces');


// LAYOUT
if(!defined('_LAYOUT_SELECT'))                 define('_LAYOUT_SELECT', 'Seleccionar');
if(!defined('_LAYOUT_NO'))                     define('_LAYOUT_NO', 'No.');
if(!defined('_LAYOUT_PATH'))                   define('_LAYOUT_PATH', 'Ruta');
if(!defined('_LAYOUT_NAME'))                   define('_LAYOUT_NAME', 'Nombre');
if(!defined('_LAYOUT_AUTOR'))                  define('_LAYOUT_AUTOR', 'Autor');
if(!defined('_LAYOUT_URL'))                    define('_LAYOUT_URL', 'URL');
if(!defined('_LAYOUT_VERSION'))                define('_LAYOUT_VERSION', 'Versi�n');
if(!defined('_LAYOUT_PREVIEW'))                define('_LAYOUT_PREVIEW', 'Previsualizar');
if(!defined('_LAYOUT_CURRENT'))                define('_LAYOUT_CURRENT', 'Plantilla actual');
if(!defined('_LAYOUT_COUNT'))                  define('_LAYOUT_COUNT', 'Plantillas instaladas');
if(!defined('_LAYOUT_FRONTEND'))               define('_LAYOUT_FRONTEND', 'Plantillas P�gina Principal');
if(!defined('_LAYOUT_BACKEND'))                define('_LAYOUT_BACKEND', 'Plantillas Administraci�n');


// LAYOUT UPLOAD
define('_LU_TEXT', 'Si tienes un archivo en formato .zip, utiliza el archivo comprimido. Si no, copia el Tema completo (index.php, im�genes y la hoja de estilos CSS) al directorio de Temas. Si quieres, utiliza el asistente de subida de archivos. Si no hay una descripci�n del archivo, haz clic en el bot�n NUEVO.');
define('_LU_DIR', 'Nombre del directorio de la plantilla');
define('_LU_FILE', 'Archivo');
define('_LU_ZTITLE', 'Subir e instalar el archivo comprimido');
define('_LU_ZFILE', 'Archivo comprimido (.zip)');
define('_LU_UPLOAD', 'Subir');
define('_LU_UPLOAD_TEMPLATE', 'Subir los archivos de la plantilla en el directorio');
define('_LU_UPLOAD_IMAGE', 'Im�genes de la plantilla');
define('_LU_DESCRIPTION', 'Descripci�n, tiene que ser proporcionada.<br />Si no tienes descripci�n, cr�ala pulsando en NUEVO.');
define('_LU_THUMB', 'Anchura miniatura de la im�gen');
define('_LU_DES_TEXT', 'Por favor, rellena todos los campos con vi�etas.');
define('_LU_DES_DIR', 'Directorio donde guardar el archivo');
define('_LU_DES_NAME', 'Nombre de la plantilla');
define('_LU_DES_AUTOR', 'Autor');
define('_LU_DES_URL', 'URL de la web del autor');
define('_LU_DES_VERSION', 'Versi�n de tu plantilla');


// CREDITS
define('_CREDITS_SYSTEM', 'Sistema');
define('_CREDITS_RELEVANT', 'Relevante para el Sistema de Gesti�n de Contenidos');
define('_CREDITS_VERSION', 'versi�n toendaCMS');
define('_CREDITS_PLATFORM', 'Plataforma');
define('_CREDITS_PHP_VERSION', 'versi�n PHP');
define('_CREDITS_SERVER', 'Servidor');
define('_CREDITS_SERVER_FACE', 'Interface PHP del servidor');
define('_CREDITS_RELEVANT_SET', 'Ajustes PHP relevantes');
define('_CREDITS_SET_GLOBALS', 'Register Globals');
define('_CREDITS_SET', 'habilitado');
define('_CREDITS_PHP_MODULES', 'M�dulos PHP');


// ABOUT MOD
if(!defined('_ABOUTMOD_TITLE'))                define('_ABOUTMOD_TITLE', 'Esto es una peque�a descripci�n de los m�dulos');
if(!defined('_ABOUTMOD_MODULE'))               define('_ABOUTMOD_MODULE', 'Modulo');
if(!defined('_ABOUTMOD_DESCRIPTION'))          define('_ABOUTMOD_DESCRIPTION', 'Descripci�n');


// ABOUT
define('_ABOUT_TITLE', 'toendaCMS Gestor de Contenidos Web Profesional y Sistema Weblog');
define('_ABOUT_TEXT', 'toendaCMS es un Sistema de Gesti�n de Contenidos profesional y flexible basado en PHP4, PHP5, XML y varias bases de datos de servidor.');
define('_ABOUT_TEXT2', 'Vete a <a class="tcms_about" href="http://www.toenda.com/" target="_blank">http://www.toenda.com/</a> para m�s informaci�n. toendaCMS no ofrece NINGUNA GARANT�A en s� mismo. Es software libre, y est�s invitado a redistribuirlo bajo ciertas condiciones. Borrar la aparici�n de esta informaci�n est� prohibido por ley.');
define('_ABOUT_EMAIL_INFO', 'Informaci�n y Soporte T�cnico');
define('_ABOUT_EMAIL_BUG', 'Reporte de errores');
define('_ABOUT_URL_DEVELOPMENT', 'Desarrollo de toendaCMS');
define('_ABOUT_URL', 'El web oficial demostrativo de toendaCMS');
define('_ABOUT_URL_DOWNLOAD', 'Descargas y Parches');
define('_ABOUT_FREE_SOFTWARE', 'es Software Libre desarrollado bajo la Licencia GNU/GPL.');
define('_ABOUT_CODE_IS_POESIE', '<strong>Recuerda siempre:</strong> C�digo es poes�a.');
define('_ABOUT_POWERED_BY', 'Este sitio est� desarrollado por');
if(!defined('_ABOUT_SVN_REPO'))                define('_ABOUT_SVN_REPO', 'Repositorio SVN');


// CONTACTFORM
define('_FORM_NAME', 'Nombre');
define('_FORM_EMAIL', 'E-mail');
define('_FORM_MESSAGE', 'Mensaje');
define('_FORM_URL', 'Web');
define('_FORM_SUBJECT', 'Asunto');
define('_FORM_MSG', 'Mensaje');
define('_FORM_COPY', 'Por favor, env�ame una copia');
define('_FORM_SEND', 'Enviar');
define('_FORM_SUBMIT', 'Enviar');
define('_FORM_MSG_CONTENT', 'Mensaje de seguimiento enviado desde un formulario de contacto a');
define('_FORM_DEAR', 'Estimado');
define('_FORM_THANKYOU', '�Gracias por tu visita a nuestra web!');
define('_FORM_FOLLOWMSG', 'El mensaje es enviado desde el formulario de Contacto:');
define('_FORM_YOUR', 'Su');
define('_FORM_CFORM', 'Formulario de contacto');
define('_FORM_SYSTEM', 'este es un mensaje autom�tico, por favor, no respondas.');
define('_FORM_GREETS', 'Atentamente');
define('_FORM_FROM', 'Este bolet�n de noticias es de ');
if(!defined('_FORM_GO'))                       define('_FORM_GO', 'Ir');


// GUESTBOOK
if(!defined('_BOOK_SEND'))                     define('_BOOK_SEND', 'Enviar');
if(!defined('_BOOK_ENTRYS'))                   define('_BOOK_NOT_ADD', '�Tus datos no han sido a�adidos!');
define('_BOOK_ENTRY1', 'entradas');
define('_BOOK_ENTRY2', 'entrada');
define('_BOOK_E_NO', 'No.');
define('_BOOK_E_NAME', 'Nombre');
define('_BOOK_E_DATE', 'Fecha');
define('_BOOK_E_EMAIL', 'E-mail');
define('_BOOK_PAGE', 'P�gina');
define('_BOOK_ADD', 'A�adir un Entrada');
define('_BOOK_FILTER_LINKS', 'Enlaces (Enlaces Web, Direcciones eMail)');
define('_BOOK_FILTER_SCRIPT', 'Scripts (Javascript, PHP)');
define('_BOOK_FILTER_MAIL', 'Mostrar Direcciones eMail');
define('_BOOK_FILTER_SPAM', 'Convertir @ a __NO_SPAM__ en Direcciones eMail');
define('_BOOK_WIDTH_NAME', 'Ancho del Campo Nombre (en Pixeles)');
define('_BOOK_WIDTH_TEXT', 'Ancho del Campo Texto (en Pixeles)');
define('_BOOK_COLOR_ROW_1', 'Color de la columna uno');
define('_BOOK_COLOR_ROW_2', 'Color de la columna dos');
define('_BOOK_TITLE', 'Entradas libro de visitas');
define('_BOOK_TEXT', 'Aqu� puedes administrar la(s) entrada(s) del libro de visitas. Puedes editarlas o eliminarlas.');


// DOWNLOADS
define('_DOWNLOADS_TITLE', 'Descargas');
define('_DOWNLOADS_TEXT', 'Controlando todos tus archivos descargables.');
Define('_DOWNLOADS_NEW', 'Crear una nueva descarga para la categor�a');
Define('_DOWNLOADS_EDIT', 'Editar todas tus descargar en la categor�a');
Define('_DOWNLOADS_HELP', 'Si dejas en blanco el lugar de la imagen a subir, se crear� por defecto una imagen para este archivo.');
Define('_DOWNLOADS_NEW_CAT', 'Crear una nueva categor�a de descargas, para ordenarlas seg�n tu propio criterio.');
Define('_DOWNLOADS_SUBMIT_ON', 'Enviada el');
define('_DOWNLOADS_SAVE_AS_MIMITYPE', 'Guardar el mimetype como im�gen');


// PRODUCTS
define('_PRODUCTS_TITLE', 'Productos');
define('_PRODUCTS_ID', 'ID del producto');
define('_PRODUCTS_SITETITLE', 'T�tulo de la p�gina del producto');
define('_PRODUCTS_SITESUBTITLE', 'Subt�tulo de la p�gina del producto');
define('_PRODUCTS_SITETEXT', 'Texto del producto');
define('_PRODUCTS_MAINCATEGORY', 'Categor�a principal del producto');
define('_PRODUCTS_TEXT', 'Controlando todos tus productos.');
Define('_PRODUCTS_NEW', 'Crear una nueva entrada de producto para la categor�a');
Define('_PRODUCTS_EDIT', 'Editar todas las entradas de productos en la categor�a');
Define('_PRODUCTS_HELP', 'Si dejas en blanco el lugar de la imagen a subir, se crear� una im�gen vac�a para este archivo.');
Define('_PRODUCTS_NEW_CAT', 'Crear una nueva categor�a de productos, para ordenarlos seg�n su propio criterio.');
Define('_PRODUCTS_SUBMIT_ON', 'Enviado el');
define('_PRODUCTS_INC_TAX', 'Impuestos inclu�dos');
define('_PRODUCTS_EX_TAX', 'Impuestos no inclu�dos');
define('_PRODUCTS_CATEGORY_TITLE', 'T�tulo de la categor�a en la bara lateral');
define('_PRODUCTS_USE_CATEGORY_TITLE', 'Mostrar el t�tulo de la categor�a en la barra lateral');


// NEWS
define('_NEWS_WRITTEN', 'Enviada por');
define('_NEWS_CATEGORIE_IN', 'Categorizada');
define('_NEWS_TITLE', 'Mostrar todas las noticias');
define('_NEWS_TEXT', 'Aqu� est�n listadas todas tus noticias. Puedes editarlas o crear una nueva.');
define('_NEWS_EDIT_CURRENT', 'Editar esta noticia.');
define('_NEWS_NEW_CURRENT', 'Crear una nueva noticia.');
define('_NEWS_ID', 'ID de la noticia');
define('_NEWS_DATE', 'Fecha');
define('_NEWS_TIME', 'Hora');
define('_NEWS_SAMPLE', 'Ejemplo');
define('_NEWS_MAINTEXT', 'Texto de la noticia');
define('_NEWS_IMAGE_HELP', 'Haz clic en los botones de arriba para poner un stop en el frontpage de las noticias, una l�nea e im�genes al texto.');
define('_NEWS_TCMS_HELP', 'Copia estas etiquetas en el lugar del texto que quieras.');
define('_NEWS_IMAGES', 'Im�gen de la noticia');
define('_NEWS_IMAGE', 'Im�gen');
define('_NEWS_DIR', 'Directorio');
define('_NEWS_ARCHIVE', 'Ordenar');
define('_NEWS_ALL', 'Todo');
define('_NEWS_LAST', '�ltimos');
define('_NEWS_ORDER_BY_TIME', ' por fecha');
define('_NEWS_ORDER_BY_CAT', 'por categor�as');
define('_NEWS_CATEGORIES_TITLE', 'Categor�as de noticias');
define('_NEWS_ARCHIVES_TITLE', 'Archivos de noticias');
define('_NEWS_CATEGORIES_TEXT', 'Puedes crear y editar las categor�as de las noticias aqu�.');
define('_NEWS_IN', 'en');
define('_NEWS_CATEGORY_ARCHIV', 'Noticias de la categor�a');
define('_NEWS_ARCHIV_FOR', 'Archivar por');
define('_NEWS_SYNDICATION', 'Sindicaci�n');
define('_NEWS_TRACKBACK', 'Trackback');


// FRONTPAGE
define('_FRONTPAGE_CONFIG', 'Configuraci�n de la p�gina principal');
define('_FRONTPAGE_USE', 'Utilizar p�gina principal');
define('_FRONTPAGE_ID', 'ID (si usas la p�gina principal, la ID es 0)');
define('_FRONTPAGE_TITLE', 'T�tulo de la p�gina principal');
define('_FRONTPAGE_SUBTITLE', 'Subt�tulo de la p�gina principal');
define('_FRONTPAGE_TEXT', 'Texto de la p�gina principal');
define('_FRONTPAGE_NEWS', 'Noticia');
define('_FRONTPAGE_NEWS_TITLE', 'T�tulo de la noticia');
define('_FRONTPAGE_NEWS_MUCH', '�Cu�ntas noticias en la p�gina principal?');
define('_FRONTPAGE_NEWS_CHARS', '�Cu�ntos car�cteres en esta noticia?');
define('_FRONT_MORE', 'Leer m�s');
define('_FRONT_COMMENT', 'Comentario');
define('_FRONT_COMMENTS', 'Comentarios');
define('_FRONT_NOCOMMENT', '�No se han enviado comentarios!');
define('_FRONT_COMMENT_TITLE', 'Enviar un comentario');
define('_FRONT_COMMENT_NAME', 'Nombre');
define('_FRONT_COMMENT_EMAIL', 'E-mail');
define('_FRONT_COMMENT_WEB', 'Web');
define('_FRONT_COMMENT_TEXT', 'Mensaje');
define('_FRONT_COMMENT_POST', 'Enviado por');
define('_FRONT_OWN_TRACKBACK', 'URL Due�o Trackback');
define('_FRONT_TRACKBACK_URL', 'Etiqueta URL Trackback');
define('_FRONTPAGE_SIDEBAR_NEWS', 'Noticias en Barra lateral');
define('_FRONTPAGE_SIDEBAR_NEWS_USE', 'Muestra las noticias en la barra lateral');
define('_FRONTPAGE_SIDEBAR_NEWS_TITLE', 'T�tulo Noticias Barra lateral');
define('_FRONTPAGE_SIDEBAR_NEWS_MUCH', '�Cu�ntas noticias se mostrar�n en la barra lateral de la p�gina principal?');
define('_FRONTPAGE_NEWS_DISPLAY', '�Como mostrar las noticias en la barra lateral?');
define('_FRONTPAGE_TDT', 'T�tulo, Fecha y Hora, Texto');
define('_FRONTPAGE_TD', 'T�tulo, Fecha y Hora');
define('_FRONTPAGE_T', 'T�tulo');
if(!defined('_FRONTPAGE_DT'))                  define('_FRONTPAGE_DT', 'Fecha y Hora, T�tulo');
define('_FRONT_CAPTCHA', 'Introducir el siguiente c�digo');
if(!defined('_NEWS_SHOW_ON_FRONTPAGE'))        define('_NEWS_SHOW_ON_FRONTPAGE', 'Mostrar Noticias en p�gina de Inicio');



// DOCUMENTATION
if(!defined('_DOCU_TITLE'))                    define('_DOCU_TITLE', 'Documentaci�n');
if(!defined('_DOCU_TEXT'))                     define('_DOCU_TEXT', '�QUIERES ESCRIBIR A ALGUIEN?');


// SEARCH
if(!defined('_SEARCH_TITLE'))                  define('_SEARCH_TITLE', 'Buscar');
if(!defined('_SEARCH_SUBMIT'))                 define('_SEARCH_SUBMIT', 'Buscar');
if(!defined('_SEARCH_BOX'))                    define('_SEARCH_BOX', 'Palabra');
if(!defined('_SEARCH_TEXT_FOUND'))             define('_SEARCH_TEXT_FOUND', 'Resultado de la b�squeda:');
if(!defined('_SEARCH_EMPTY'))                  define('_SEARCH_EMPTY', 'Tienes que escribir algo en la b�squeda.');
if(!defined('_SEARCH_START'))                  define('_SEARCH_NOTFOUND_1', 'Tu palabra');
if(!defined('_SEARCH_NOTFOUND_1'))             define('_SEARCH_NOTFOUND_2', 'no fue encontrada.');
if(!defined('_SEARCH_NOTFOUND_2'))             define('_SEARCH_WITH_GOOGLE', 'Buscar con');
if(!defined('_SEARCH_WITH_GOOGLE'))            define('_SEARCH_WITH_GOOGLE', 'Buscar en la web con');


// FILESYSTEMS
if(!defined('_FOLDER_DEFAULT'))                define('_FOLDER_DEFAULT', 'Por defecto');
if(!defined('_FOLDER_HTML'))                   define('_FOLDER_HTML', 'HTML');
if(!defined('_FOLDER_IMAGES'))                 define('_FOLDER_IMAGES', 'Im�genes');
if(!defined('_FOLDER_LOCKED'))                 define('_FOLDER_LOCKED', 'Cerrado');
if(!defined('_FOLDER_PACK'))                   define('_FOLDER_PACK', 'Paquetes');
if(!defined('_FOLDER_PRINT'))                  define('_FOLDER_PRINT', 'Imprimir');
if(!defined('_FOLDER_SOUND'))                  define('_FOLDER_SOUND', 'Sonido');
if(!defined('_FOLDER_DOCU'))                   define('_FOLDER_DOCU', 'Documentos');
if(!defined('_FOLDER_VID'))                    define('_FOLDER_VID', 'V�deo');


// FILESYSTEMS
define('_DB_CHOOSE', 'Base de datos para toendaCMS');
define('_DB_USER', 'Nombre de usuario del servidor SQL');
define('_DB_PASSWORD', 'Contrase�a del servidor SQL');
define('_DB_HOST', 'Host Servidor SQL');
define('_DB_DATABASE', 'Servidor de bases de datos SQL');
define('_DB_PORT', 'Puerto del Servidor SQL (para Servidor PostgreSQL)');
define('_DB_PREFIX', 'Prefijo Base de datos MySQL');
define('_DB_XML', 'Base de datos XML');
define('_DB_MYSQL', 'Base de datos MySQL');
define('_DB_PGSQL', 'Base de datos PostgreSQL');
define('_DB_MSSQL', 'Base de Datos Microsoft SQL Server');
define('_DB_BACKUP', 'Copia de seguridad de la base de datos');
define('_DB_OPTIMIZATION', 'Optimizar Base de Datos');
define('_DB_RESTORE', 'Restaurar base de datos');
define('_DB_START_BACKUP', 'Hacer ahora copia de seguridad');
define('_DB_START_OPTIMIZATION', 'Realizar ahora la optimizaci�n');
define('_DB_START_RESTORE', 'Restaurar ahora');
define('_DB_CONFIG', 'Configuraci�n de la base de datos');
define('_DB_BACKUP_RESTORE', 'Copia de seguridad de la base de datos y Restaurar');
define('_DB_BACKUP_OPTIMIZATION', 'Optimizaci�n de la Base de datos');
define('_DB_DB', 'Base de datos');
define('_DB_BACKUP_AS_FILE', '�Guardar copia de seguridad como archivo?');
define('_DB_BACKUP_AS_STRUCTURE', '�S�lo estructura de la base de datos?');


// LINKS
define('_LINK_MODULE', 'Configuraci�n del gestor de enlaces');
define('_LINK_MODULE_TITLE', 'Gestor de enlaces');
define('_LINK_MODULE_DESC', 'Aqu� puede crear enlaces y categor�as de enlaces. Por favor, tenga en cuenta que cada enlace tiene que integrarse dentro de una categor�a..');
define('_LINK_USE_SIDELINKS', 'Mostrar enlaces en la barra lateral');
define('_LINK_USE_SIDELINKS_DESC', 'Mostrar descripci�n del enlace en la barra lateral');
define('_LINK_USE_SIDELINKS_TITLE', 'Mostrar t�tulo para los enlaces de la barra lateral');
define('_LINK_SIDELINKS_TITLE', 'T�tulo para los enlaces de la barra lateral');
define('_LINK_MAINLINKS_TITLE', 'T�tulo para la p�gina de contenido');
define('_LINK_MAINLINKS_SUBTITLE', 'Subt�tulo para la p�gina de contenido');
define('_LINK_MAINLINKS_TEXT', 'Texto para la p�gina de contenido');
define('_LINK_USE_MAINLINKS_DESC', 'Mostrar la descripci�n del enlace en la p�gina de contenido');
define('_LINK_WICH_MODULE', 'Mostrar enlace en este m�dulo');

// COMMENTS
if(!defined('_COMMENTS_TITLE'))                define('_COMMENTS_TITLE', 'Administrar comentarios');
if(!defined('_COMMENTS_TEXT'))                 define('_COMMENTS_TEXT', 'Puede administrar todos los comentarios de las noticias e im�genes aqu�. Si lo desea, puede editarlos o borrarlos. Tambi�n puede ver el E-mail, la direcci�n IP y los nombres de dominio de las personas que han hecho los comentarios.');


// STATS
if(!defined('_STATS_HOST'))                    define('_STATS_HOST', 'Host');
if(!defined('_STATS_REF'))                     define('_STATS_REF', 'Referencia');
if(!defined('_STATS_PAGE'))                    define('_STATS_PAGE', 'P�gina');
if(!defined('_STATS_COUNT'))                   define('_STATS_COUNT', 'Contador');
if(!defined('_STATS_SUM_CLICKS'))              define('_STATS_SUM_CLICKS', 'Suma de todos los hits');
if(!defined('_STATS_SUM_UNIQUE'))              define('_STATS_SUM_UNIQUE', 'Suma de todos los hits �nicos');
if(!defined('_STATS_SUM_IP'))                  define('_STATS_SUM_IP', 'Suma de las diferentes ips');
if(!defined('_STATS_BROWSER_OS'))              define('_STATS_BROWSER_OS', 'Navegador, Sistema Operativo');
if(!defined('_STATS_HITS'))                    define('_STATS_HITS', 'Hits, Impresiones, Referencias');
if(!defined('_STATS_BROWSER'))                 define('_STATS_BROWSER', 'Navegador');
if(!defined('_STATS_OS'))                      define('_STATS_OS', 'Sistema Operativo');
if(!defined('_STATS_RESET'))                   define('_STATS_RESET', 'Resetear estad�sticas');
if(!defined('_STATS_RESET_TEXT'))              define('_STATS_RESET_TEXT', 'Aqu� puedes resetear las estad�sticas. <strong>ATENCION!</strong> Despu�s de resetear, no se podr�n recuperar las estad�sticas.');
if(!defined('_STATS_RESET_SUCCESS'))           define('_STATS_RESET_SUCCESS', 'Estad�sticas reseteadas satisfactoriamente.');
if(!defined('_STATS_RESET_FAILED'))            define('_STATS_RESET_FAILED', 'Fallo al resetear las Estad�sticas.');


// FAQ's
if(!defined('_FAQ_TITLE'))                     define('_FAQ_TITLE', 'Mostrar todas las FAQ\'s y art�culos');
if(!defined('_FAQ_TEXT'))                      define('_FAQ_TEXT', 'Aqu� est�n listados todas las FAQ\'s y art�culos. Puedes editarlos o crear nuevos art�culos y/o categor�as.');
if(!defined('_FAQ_BASE_CATEGORY'))             define('_FAQ_BASE_CATEGORY', 'Categor�a Base');
if(!defined('_FAQ_CFG_TITLE'))                 define('_FAQ_CFG_TITLE', 'Configurar la Base de Conocimientos(FAQ)');


// IMPORT
if(!defined('_IMPORT_BLOGGER_FTP'))            define('_IMPORT_BLOGGER_FTP', 'Importar Blogger por FTP');
if(!defined('_IMPORT_BLOGGER_FTP_DESC'))       define('_IMPORT_BLOGGER_FTP_DESC', 'Importar noticias y comentarios desde una cuenta de Blogg teniendo en cuenta que el blog est� localizado en un servidor FTP propio (documentaci�n disponible en el wiki).');
if(!defined('_IMPORT_OOO2_DOCBOOK_XML'))       define('_IMPORT_OOO2_DOCBOOK_XML', 'OpenOffice.org 2.0 DockBook XML');
if(!defined('_IMPORT_OOO2_DOCBOOK_XML_DESC'))  define('_IMPORT_OOO2_DOCBOOK_XML_DESC', 'Importar documentos desde un <em>DocBook XML</em> guardados comos documentos OpenOffice.org 2.0.');


// COMPONENTS UPLOAD
if(!defined('_CS_UPLOAD_TEXT'))                define('_CS_UPLOAD_TEXT', 'Si tienes un archivo .zip, usa la opci�n Subir Archivo Comprimido. De lo contrario, copia el componente completo (la carpeta con todos los archivos necesarios) al directorio Componentes. Si quieres, usa la opci�n Subir Archivo.');
if(!defined('_CS_UPLOAD_ZTITLE'))              define('_CS_UPLOAD_ZTITLE', 'Subir e instalar archivo Comprimido');
if(!defined('_CS_UPLOAD_ZFILE'))               define('_CS_UPLOAD_ZFILE', 'Archivo Comprimido (.zip)');

// FOOTER
if(!defined('_FOOTER_VALID_TITLE'))            define('_FOOTER_VALID_TITLE', 'Este sitio cumple los siguientes standards');
if(!defined('_FOOTER_VALID_US_805'))           define('_FOOTER_VALID_US_805', 'Este sitio toendaCMS cumple con las pautas de accesibilidad del Gobierno de US Secci�n 508.');
if(!defined('_FOOTER_VALID_W3C_WAI'))          define('_FOOTER_VALID_W3C_WAI', 'Este sitio toendaCMS cumple con las pautas de accesibilidad del W3C-WAI.');
if(!defined('_FOOTER_VALID_XHTML'))            define('_FOOTER_VALID_XHTML', 'Este sitio toendaCMS es XHTML v�lidado.');
if(!defined('_FOOTER_VALID_CSS'))              define('_FOOTER_VALID_CSS', 'Este sitio toendaCMS fu� creado con un CSS v�lidado.');
if(!defined('_FOOTER_VALID_ANY_BROWSER'))      define('_FOOTER_VALID_ANY_BROWSER', 'Este sitio toendaCMS se ve perfectamente en cualquier navegador web.');


// COUNTRY LIST
if(!defined('_COUNTRY_AFGHANISTAN'))           define('_COUNTRY_AFGHANISTAN', 'Afghanistan');
if(!defined('_COUNTRY_ALBANIA'))               define('_COUNTRY_ALBANIA', 'Albania');
if(!defined('_COUNTRY_ALGERIA'))               define('_COUNTRY_ALGERIA', 'Algerien');
if(!defined('_COUNTRY_AMERICANSAMOA'))         define('_COUNTRY_AMERICANSAMOA', 'American Samoa Islands');
if(!defined('_COUNTRY_ANDORRA'))               define('_COUNTRY_ANDORRA', 'Andorra');
if(!defined('_COUNTRY_ANGOLA'))                define('_COUNTRY_ANGOLA', 'Angola');
if(!defined('_COUNTRY_ANQUILLA'))              define('_COUNTRY_ANQUILLA', 'Anguilla');
if(!defined('_COUNTRY_ANTARCTICA'))            define('_COUNTRY_ANTARCTICA', 'Antarctica');
if(!defined('_COUNTRY_ANTIQUAANDBARBUDA'))     define('_COUNTRY_ANTIQUAANDBARBUDA', 'Antigua and Barbuda');
if(!defined('_COUNTRY_ARGENTINA'))             define('_COUNTRY_ARGENTINA', 'Argentina');
if(!defined('_COUNTRY_ARMENIA'))               define('_COUNTRY_ARMENIA', 'Armenia');
if(!defined('_COUNTRY_ARUBA'))                 define('_COUNTRY_ARUBA', 'Aruba');
if(!defined('_COUNTRY_AZERBAIJAN'))            define('_COUNTRY_AZERBAIJAN', 'Azerbaijan');
if(!defined('_COUNTRY_EGYPT'))                 define('_COUNTRY_EGYPT', 'Egypt');
if(!defined('_COUNTRY_EQUATORIALGUINEA'))      define('_COUNTRY_EQUATORIALGUINEA', 'Equatorial Guinea');
if(!defined('_COUNTRY_ETHIOPIA'))              define('_COUNTRY_ETHIOPIA', 'Ethiopia');
if(!defined('_COUNTRY_AUSTRALIA'))             define('_COUNTRY_AUSTRALIA', 'Australia');
if(!defined('_COUNTRY_BAHAMAS'))               define('_COUNTRY_BAHAMAS', 'Bahamas');
if(!defined('_COUNTRY_BAHRAIN'))               define('_COUNTRY_BAHRAIN', 'Bahrain');
if(!defined('_COUNTRY_BANGLADESH'))            define('_COUNTRY_BANGLADESH', 'Bangladesh');
if(!defined('_COUNTRY_BARBADOS'))              define('_COUNTRY_BARBADOS', 'Barbados');
if(!defined('_COUNTRY_BELGIUM'))               define('_COUNTRY_BELGIUM', 'Belgium');
if(!defined('_COUNTRY_BELIZE'))                define('_COUNTRY_BELIZE', 'Belize');
if(!defined('_COUNTRY_BENIN'))                 define('_COUNTRY_BENIN', 'Benin');
if(!defined('_COUNTRY_BERMUDA'))               define('_COUNTRY_BERMUDA', 'Bermuda');
if(!defined('_COUNTRY_BHUTAN'))                define('_COUNTRY_BHUTAN', 'Bhutan');
if(!defined('_COUNTRY_BOLIVIA'))               define('_COUNTRY_BOLIVIA', 'Bolivia');
if(!defined('_COUNTRY_BOSNIAANDHERZEGOVINA'))  define('_COUNTRY_BOSNIAANDHERZEGOVINA', 'Bosnia and Herzegovina');
if(!defined('_COUNTRY_BOTSWANA'))              define('_COUNTRY_BOTSWANA', 'Botswana');
if(!defined('_COUNTRY_BOUVETISLAND'))          define('_COUNTRY_BOUVETISLAND', 'Bouvet Island');
if(!defined('_COUNTRY_BRAZIL'))                define('_COUNTRY_BRAZIL', 'Brazil');
if(!defined('_COUNTRY_BRITININDIAOCEAN'))      define('_COUNTRY_BRITININDIAOCEAN', 'Brit. Territy in the india ocean');
if(!defined('_COUNTRY_VIRGINISLANDS'))         define('_COUNTRY_VIRGINISLANDS', 'Virgin Islands');
if(!defined('_COUNTRY_BULGARIA'))              define('_COUNTRY_BULGARIA', 'Bulgaria');
if(!defined('_COUNTRY_BURKINAFASO'))           define('_COUNTRY_BURKINAFASO', 'Burkina Faso');
if(!defined('_COUNTRY_BURUNDI'))               define('_COUNTRY_BURUNDI', 'Burundi');
if(!defined('_COUNTRY_BRUNEI'))                define('_COUNTRY_BRUNEI', 'Brunei');
if(!defined('_COUNTRY_CAYMANISLAND'))          define('_COUNTRY_CAYMANISLAND', 'Cayman Islands');
if(!defined('_COUNTRY_CHILE'))                 define('_COUNTRY_CHILE', 'Chile');
if(!defined('_COUNTRY_CHINA'))                 define('_COUNTRY_CHINA', 'China');
if(!defined('_COUNTRY_COOKISLANDS'))           define('_COUNTRY_COOKISLANDS', 'Cook Islands');
if(!defined('_COUNTRY_COSTARICA'))             define('_COUNTRY_COSTARICA', 'Costa Rica');
if(!defined('_COUNTRY_GERMANY'))               define('_COUNTRY_GERMANY', 'Germany');
if(!defined('_COUNTRY_DJIBOUTI'))              define('_COUNTRY_DJIBOUTI', 'Djibouti');
if(!defined('_COUNTRY_DOMINICA'))              define('_COUNTRY_DOMINICA', 'Dominica');
if(!defined('_COUNTRY_DOMINICANREPUPLIC'))     define('_COUNTRY_DOMINICANREPUPLIC', 'Dominican Republic');
if(!defined('_COUNTRY_DENMARK'))               define('_COUNTRY_DENMARK', 'Denmark');
if(!defined('_COUNTRY_ELSALVADOR'))            define('_COUNTRY_ELSALVADOR', 'El Salvador');
if(!defined('_COUNTRY_IVORYCOAST'))            define('_COUNTRY_IVORYCOAST', 'Ivory Coast');
if(!defined('_COUNTRY_ECUADOR'))               define('_COUNTRY_ECUADOR', 'Ecuador');
if(!defined('_COUNTRY_ERITREA'))               define('_COUNTRY_ERITREA', 'Eritrea');
if(!defined('_COUNTRY_ESTONIA'))               define('_COUNTRY_ESTONIA', 'Estonia');
if(!defined('_COUNTRY_FALKLANDISLANDS'))       define('_COUNTRY_FALKLANDISLANDS', 'Falkland Islands (Malvinen)');
if(!defined('_COUNTRY_FIJI'))                  define('_COUNTRY_FIJI', 'Fiji');
if(!defined('_COUNTRY_FINLAND'))               define('_COUNTRY_FINLAND', 'Finland');
if(!defined('_COUNTRY_FRANCE'))                define('_COUNTRY_FRANCE', 'France');
if(!defined('_COUNTRY_FRENCHGUIANA'))          define('_COUNTRY_FRENCHGUIANA', 'French Guiana');
if(!defined('_COUNTRY_FRENCHPOLINESIA'))       define('_COUNTRY_FRENCHPOLINESIA', 'French Polynesia');
if(!defined('_COUNTRY_FRENCHSOUNTHTERITORIES'))define('_COUNTRY_FRENCHSOUNTHTERITORIES', 'French South Territories');
if(!defined('_COUNTRY_FAROEISLANDS'))          define('_COUNTRY_FAROEISLANDS', 'Faroe Islands');
if(!defined('_COUNTRY_GABUN'))                 define('_COUNTRY_GABUN', 'Gabun');
if(!defined('_COUNTRY_GAMBIA'))                define('_COUNTRY_GAMBIA', 'Gambia');
if(!defined('_COUNTRY_GEORGIA'))               define('_COUNTRY_GEORGIA', 'Georgia');
if(!defined('_COUNTRY_GHANA'))                 define('_COUNTRY_GHANA', 'Ghana');
if(!defined('_COUNTRY_GIBRALTAR'))             define('_COUNTRY_GIBRALTAR', 'Gibraltar');
if(!defined('_COUNTRY_GRENADA'))               define('_COUNTRY_GRENADA', 'Grenada');
if(!defined('_COUNTRY_GREECE'))                define('_COUNTRY_GREECE', 'Greece');
if(!defined('_COUNTRY_BRITANY'))               define('_COUNTRY_BRITANY', 'Great Britain');
if(!defined('_COUNTRY_GREENLAND'))             define('_COUNTRY_GREENLAND', 'Greenland');
if(!defined('_COUNTRY_GUADELOUPE'))            define('_COUNTRY_GUADELOUPE', 'Guadeloupe');
if(!defined('_COUNTRY_GUAM'))                  define('_COUNTRY_GUAM', 'Guam');
if(!defined('_COUNTRY_GUATEMALA'))             define('_COUNTRY_GUATEMALA', 'Guatemala');
if(!defined('_COUNTRY_GUINEA'))                define('_COUNTRY_GUINEA', 'Guinea');
if(!defined('_COUNTRY_GUINEABISSAU'))          define('_COUNTRY_GUINEABISSAU', 'Guinea - Bissau');
if(!defined('_COUNTRY_GUYANA'))                define('_COUNTRY_GUYANA', 'Guyana');
if(!defined('_COUNTRY_HAITI'))                 define('_COUNTRY_HAITI', 'Haiti');
if(!defined('_COUNTRY_HEARDMCDONALDISLANDS'))  define('_COUNTRY_HEARDMCDONALDISLANDS', 'Heard and McDonald - Islands');
if(!defined('_COUNTRY_HONDURAS'))              define('_COUNTRY_HONDURAS', 'Honduras');
if(!defined('_COUNTRY_HONGKONG'))              define('_COUNTRY_HONGKONG', 'Hong Kong');
if(!defined('_COUNTRY_INDIA'))                 define('_COUNTRY_INDIA', 'India');
if(!defined('_COUNTRY_INDONESIA'))             define('_COUNTRY_INDONESIA', 'Indonesia');
if(!defined('_COUNTRY_IRAQ'))                  define('_COUNTRY_IRAQ', 'Iraq');
if(!defined('_COUNTRY_IRAN'))                  define('_COUNTRY_IRAN', 'Iran');
if(!defined('_COUNTRY_IRELAND'))               define('_COUNTRY_IRELAND', 'Ireland');
if(!defined('_COUNTRY_ICELAND'))               define('_COUNTRY_ICELAND', 'Iceland');
if(!defined('_COUNTRY_ISRAEL'))                define('_COUNTRY_ISRAEL', 'Israel');
if(!defined('_COUNTRY_ITALY'))                 define('_COUNTRY_ITALY', 'Italy');
if(!defined('_COUNTRY_JAMAICA'))               define('_COUNTRY_JAMAICA', 'Jamaica');
if(!defined('_COUNTRY_JAPAN'))                 define('_COUNTRY_JAPAN', 'Japan');
if(!defined('_COUNTRY_YEMEN'))                 define('_COUNTRY_YEMEN', 'Yemen');

if(!defined('_COUNTRY_MALI'))                  define('_COUNTRY_MALI', 'Mali');
if(!defined('_COUNTRY_MALTA'))                 define('_COUNTRY_MALTA', 'Malta');
if(!defined('_COUNTRY_MAROCCO'))               define('_COUNTRY_MAROCCO', 'Marocco');
if(!defined('_COUNTRY_MARSHALLISLANDS'))       define('_COUNTRY_MARSHALLISLANDS', 'Marshall Islands');

if(!defined('_COUNTRY_SUDAN'))                 define('_COUNTRY_SUDAN', 'Sudan');

if(!defined('_COUNTRY_WESTERNSAHARA'))         define('_COUNTRY_WESTERNSAHARA', 'Western Sahahra');
if(!defined('_COUNTRY_ZAIRE'))                 define('_COUNTRY_ZAIRE', 'Zaire');
if(!defined('_COUNTRY_ZAMBIA'))                define('_COUNTRY_ZAMBIA', 'Zambia');
if(!defined('_COUNTRY_CENTRALAFRICANREPUBLIC'))define('_COUNTRY_CENTRALAFRICANREPUBLIC', 'Central African Republic');
if(!defined('_COUNTRY_CYPRUS'))                define('_COUNTRY_CYPRUS', 'Cyprus');


// SOME FORMATS
if(!function_exists(lang_date) && !function_exists('lang_date')){
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

/*
*
* If you translating this file into another language,
* you must decomment the following two line's of code.
* To do that, remove (or delete) the first two char's,
* the slash (/) char's.
*
*/

if(_TCMS_LANGUAGE_STARTPOINT == 'admin'){ include_once('../language/english_EN/lang_english_EN.php'); }
else{ include_once('engine/language/english_EN/lang_english_EN.php'); }


?>
