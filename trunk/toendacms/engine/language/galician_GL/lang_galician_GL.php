<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Galician Language
|
| File:	lang_galician_GL.php
|
+
*/


/**
 * Galician Language
 * 
 * @version 0.1
 * @author	Tomás Vilariño <vifito@gmail.com>
 * @package toendaCMS
 * @subpackage toendaCMS Backend
 */


// ADMIN
if(!defined('_TCMS_ADMIN_TITLE'))              define('_TCMS_ADMIN_TITLE', 'Administración de toendaCMS');
if(!defined('_TCMS_ADMIN_BACK'))               define('_TCMS_ADMIN_BACK', 'Atrás');
if(!defined('_TCMS_ADMIN_FORWARD'))            define('_TCMS_ADMIN_FORWARD', 'Adiante');
if(!defined('_TCMS_ADMIN_CLOSE'))              define('_TCMS_ADMIN_CLOSE', 'Pechar');
if(!defined('_TCMS_ADMIN_SAVE'))               define('_TCMS_ADMIN_SAVE', 'Gardar');
if(!defined('_TCMS_ADMIN_APPLY'))              define('_TCMS_ADMIN_APPLY', 'Aplicar');
if(!defined('_TCMS_ADMIN_BACK_TO_PAGE'))       define('_TCMS_ADMIN_BACK_TO_PAGE', 'Voltar á web');
if(!defined('_TCMS_ADMIN_NO'))                 define('_TCMS_ADMIN_NO', 'Non');
if(!defined('_TCMS_ADMIN_FTPUPLOAD'))          define('_TCMS_ADMIN_FTPUPLOAD', 'Crear un álbume desde a carpeta de imaxes subidas vía FTP');
if(!defined('_TCMS_ADMIN_DELETE'))             define('_TCMS_ADMIN_DELETE', 'Eliminar');
if(!defined('_TCMS_ADMIN_DELETE_ALL'))         define('_TCMS_ADMIN_DELETE_ALL', 'Eliminar todo');
if(!defined('_TCMS_ADMIN_UPLOAD'))             define('_TCMS_ADMIN_UPLOAD', 'Subir');
if(!defined('_TCMS_ADMIN_INSTALL'))            define('_TCMS_ADMIN_INSTALL', 'Subir e Instalar');
if(!defined('_TCMS_ADMIN_SEND'))               define('_TCMS_ADMIN_SEND', 'Enviar');
if(!defined('_TCMS_ADMIN_VOTE'))               define('_TCMS_ADMIN_VOTE', 'Votar agora!');
if(!defined('_TCMS_ADMIN_NEW'))                define('_TCMS_ADMIN_NEW', 'Novo');
if(!defined('_TCMS_ADMIN_IMPORT'))             define('_TCMS_ADMIN_IMPORT', 'Importar');
if(!defined('_TCMS_ADMIN_CREATE'))             define('_TCMS_ADMIN_CREATE', 'Engadir novo Álbume...');
if(!defined('_TCMS_ADMIN_NEW_POLL'))           define('_TCMS_ADMIN_NEW_POLL', 'Engadir nova Enquisa...');
if(!defined('_TCMS_ADMIN_NEW_ITEM'))           define('_TCMS_ADMIN_NEW_ITEM', 'Engadir novo Ítem...');
if(!defined('_TCMS_ADMIN_NEW_USER'))           define('_TCMS_ADMIN_NEW_USER', 'Engadir novo Usuario...');
if(!defined('_TCMS_ADMIN_NEW_FTPALBUM'))       define('_TCMS_ADMIN_NEW_FTPALBUM', 'Engadir novo Álbume desde carpeta FTP...');
if(!defined('_TCMS_ADMIN_NEW_CATEGORY'))       define('_TCMS_ADMIN_NEW_CATEGORY', 'Engadir nova Categoría...');
if(!defined('_TCMS_ADMIN_NEW_DIR'))            define('_TCMS_ADMIN_NEW_DIR', 'Engadir novo directorio...');
if(!defined('_TCMS_ADMIN_NEW_DIR_BUTTON'))     define('_TCMS_ADMIN_NEW_DIR_BUTTON', 'Crear Carpeta');
if(!defined('_TCMS_ADMIN_NEW_FILE_BUTTON'))    define('_TCMS_ADMIN_NEW_FILE_BUTTON', 'Crear Ficheiro');
if(!defined('_TCMS_ADMIN_CONFIG'))             define('_TCMS_ADMIN_CONFIG', 'Configurar este módulo');
if(!defined('_TCMS_ADMIN_LIST'))               define('_TCMS_ADMIN_LIST', 'Listar ítems');
if(!defined('_TCMS_ADMIN_NEWPAGE'))            define('_TCMS_ADMIN_NEWPAGE', 'ASISTENTE: Crear unha nova páxina para o teu sitio.');
if(!defined('_TCMS_ADMIN_UPDATE'))             define('_TCMS_ADMIN_UPDATE', 'Actualizar');
if(!defined('_TCMS_ADMIN_VER'))                define('_TCMS_ADMIN_VER', 'Versión');
if(!defined('_TCMS_ADMIN_DEV'))                define('_TCMS_ADMIN_DEV', 'desenvolvido por');
if(!defined('_TCMS_ADMIN_RIGHT'))              define('_TCMS_ADMIN_RIGHT', 'Todos os dereitos reservados.');
if(!defined('_TCMS_ADMIN_LOGED'))              define('_TCMS_ADMIN_LOGED', 'Aberta unha sesión como');
if(!defined('_TCMS_ADMIN_GOTOSITE'))           define('_TCMS_ADMIN_GOTOSITE', 'Ir ao teu sitio web');
if(!defined('_TCMS_ADMIN_EDIT_LANG'))          define('_TCMS_ADMIN_EDIT_LANG', 'Editar este idioma');
if(!defined('_TCMS_TOP_OF_PAGE'))              define('_TCMS_TOP_OF_PAGE', 'Ir ao comenzo desta páxina ...');
if(!defined('_TCMS_PRINT_PAGE'))               define('_TCMS_PRINT_PAGE', 'Imprimir esta páxina ...');
if(!defined('_TCMS_PDF_PAGE'))                 define('_TCMS_PDF_PAGE', 'Xerar PDF desta páxina...');
if(!defined('_TCMS_PRINT_NOW'))                define('_TCMS_PRINT_NOW', 'Imprimir');
if(!defined('_TCMS_COLOR_CHOOSER'))            define('_TCMS_COLOR_CHOOSER', 'Selector de cor');
if(!defined('_TCMS_MONTH_JANUARY'))            define('_TCMS_MONTH_JANUARY', 'Xaneiro');
if(!defined('_TCMS_MONTH_FEBUARY'))            define('_TCMS_MONTH_FEBUARY', 'Febreiro');
if(!defined('_TCMS_MONTH_MARCH'))              define('_TCMS_MONTH_MARCH', 'Marzo');
if(!defined('_TCMS_MONTH_APRIL'))              define('_TCMS_MONTH_APRIL', 'Abril');
if(!defined('_TCMS_MONTH_MAY'))                define('_TCMS_MONTH_MAY', 'Maio');
if(!defined('_TCMS_MONTH_JUNE'))               define('_TCMS_MONTH_JUNE', 'Xuño');
if(!defined('_TCMS_MONTH_JULY'))               define('_TCMS_MONTH_JULY', 'Xullo');
if(!defined('_TCMS_MONTH_AUGUST'))             define('_TCMS_MONTH_AUGUST', 'Agosto');
if(!defined('_TCMS_MONTH_SEPTEMBER'))          define('_TCMS_MONTH_SEPTEMBER', 'Setembro');
if(!defined('_TCMS_MONTH_OCTOBER'))            define('_TCMS_MONTH_OCTOBER', 'Outubro');
if(!defined('_TCMS_MONTH_NOVEMBER'))           define('_TCMS_MONTH_NOVEMBER', 'Novembro');
if(!defined('_TCMS_MONTH_DECEMBER'))           define('_TCMS_MONTH_DECEMBER', 'Decembro');
if(!defined('_TCMS_DAY_MONDAY'))               define('_TCMS_DAY_MONDAY', 'Luns');
if(!defined('_TCMS_DAY_TUESDAY'))              define('_TCMS_DAY_TUESDAY', 'Martes');
if(!defined('_TCMS_DAY_WEDNESDAY'))            define('_TCMS_DAY_WEDNESDAY', 'Mércores');
if(!defined('_TCMS_DAY_THURSDAY'))             define('_TCMS_DAY_THURSDAY', 'Xoves');
if(!defined('_TCMS_DAY_FRIDAY'))               define('_TCMS_DAY_FRIDAY', 'Venres');
if(!defined('_TCMS_DAY_SATURDAY'))             define('_TCMS_DAY_SATURDAY', 'Sábado');
if(!defined('_TCMS_DAY_SUNDAY'))               define('_TCMS_DAY_SUNDAY', 'Domingo');
if(!defined('_TCMS_DAY_MONDAY_XS'))            define('_TCMS_DAY_MONDAY_XS', 'Lun');
if(!defined('_TCMS_DAY_TUESDAY_XS'))           define('_TCMS_DAY_TUESDAY_XS', 'Mar');
if(!defined('_TCMS_DAY_WEDNESDAY_XS'))         define('_TCMS_DAY_WEDNESDAY_XS', 'Mér');
if(!defined('_TCMS_DAY_THURSDAY_XS'))          define('_TCMS_DAY_THURSDAY_XS', 'Xov');
if(!defined('_TCMS_DAY_FRIDAY_XS'))            define('_TCMS_DAY_FRIDAY_XS', 'Ven');
if(!defined('_TCMS_DAY_SATURDAY_XS'))          define('_TCMS_DAY_SATURDAY_XS', 'Sáb');
if(!defined('_TCMS_DAY_SUNDAY_XS'))            define('_TCMS_DAY_SUNDAY_XS', 'Dom');
if(!defined('_TCMS_COLOR'))                    define('_TCMS_COLOR', 'Cor');
if(!defined('_TCMS_TODAY'))                    define('_TCMS_TODAY', 'Hoxe');
if(!defined('_TCMS_BACKGROUND'))               define('_TCMS_BACKGROUND', 'Fondo');
if(!defined('_TCMS_BORDER'))                   define('_TCMS_BORDER', 'Borde');
if(!defined('_TCMS_WEEKDAY'))                  define('_TCMS_WEEKDAY', 'Día semana');
if(!defined('_TCMS_BASE_DIRECTORY'))           define('_TCMS_BASE_DIRECTORY', 'Directorio base');
if(!defined('_TCMS_OPEN_DIRECTORY'))           define('_TCMS_OPEN_DIRECTORY', 'Abrir cartafol');
if(!defined('_TCMS_TEST_ENVIRONMENT'))         define('_TCMS_TEST_ENVIRONMENT', 'ESTA É UNHA PROBA DE DESENVOLVEMENTO!');
if(!defined('_TCMS_THIS_PAGE_IN'))             define('_TCMS_THIS_PAGE_IN', 'Esta páxina en');
if(!defined('_TCMS_LANGUAGES'))                define('_TCMS_LANGUAGES', 'Idiomas');
if(!defined('_TCMS_LANGUAGE'))                 define('_TCMS_LANGUAGE', 'Idioma');
if(!defined('_TCMS_OPEN_ALL'))                 define('_TCMS_OPEN_ALL', 'Abrir todo');
if(!defined('_TCMS_CLOSE_ALL'))                define('_TCMS_CLOSE_ALL', 'Pechar todo');
if(!defined('_TCMS_HELP'))                     define('_TCMS_HELP', 'Axuda');
if(!defined('_TCMS_DOCU'))                     define('_TCMS_DOCU', 'Wiki');
if(!defined('_TCMS_TSCRIPT_SYNTAX_REF'))       define('_TCMS_TSCRIPT_SYNTAX_REF', 'toendaScript - Referencia de sintaxe');


// BACKEND TOPMENU
if(!defined('_TCMS_TOPMENU_MAIN'))             define('_TCMS_TOPMENU_MAIN', 'Principal');
if(!defined('_TCMS_TOPMENU_MANAGE'))           define('_TCMS_TOPMENU_MANAGE', 'Xestionar');
if(!defined('_TCMS_TOPMENU_NAVIGATION'))       define('_TCMS_TOPMENU_NAVIGATION', 'Navegación');
if(!defined('_TCMS_TOPMENU_SETTINGS'))         define('_TCMS_TOPMENU_SETTINGS', 'Opcións');
if(!defined('_TCMS_TOPMENU_CONTENT'))          define('_TCMS_TOPMENU_CONTENT', 'Contido');
if(!defined('_TCMS_TOPMENU_SIDEBAR'))          define('_TCMS_TOPMENU_SIDEBAR', 'Barra lateral');
if(!defined('_TCMS_TOPMENU_EXTENSIONS'))       define('_TCMS_TOPMENU_EXTENSIONS', 'Extensións');
if(!defined('_TCMS_TOPMENU_COMPONENTS'))       define('_TCMS_TOPMENU_COMPONENTS', 'Compoñentes');
if(!defined('_TCMS_TOPMENU_SITE'))             define('_TCMS_TOPMENU_SITE', 'Sitio');
if(!defined('_TCMS_TOPMENU_HELP'))             define('_TCMS_TOPMENU_HELP', 'Axuda');
if(!defined('_TCMS_TOPMENU_CONF_MODULE'))      define('_TCMS_TOPMENU_CONF_MODULE', 'Configuración do Módulo');


// TCMS
if(!defined('_TCMS_MENU_HOME'))                define('_TCMS_MENU_HOME', 'Inicio');
if(!defined('_TCMS_MENU_LOGOUT'))              define('_TCMS_MENU_LOGOUT', 'Pechar sesión');
if(!defined('_TCMS_MENU_PAGE'))                define('_TCMS_MENU_PAGE', 'Escritorio');
if(!defined('_TCMS_MENU_FILE'))                define('_TCMS_MENU_FILE', 'Xestor de ficheiros');
if(!defined('_TCMS_MENU_MEDIA'))               define('_TCMS_MENU_MEDIA', 'Xestor Multimedia');
if(!defined('_TCMS_MENU_NEWS_CATEGORIES'))     define('_TCMS_MENU_NEWS_CATEGORIES', 'Categorías das Novas');
if(!defined('_TCMS_MENU_COMMENTS'))            define('_TCMS_MENU_COMMENTS', 'Comentarios');
if(!defined('_TCMS_MENU_GUESTBOOK'))           define('_TCMS_MENU_GUESTBOOK', 'Entradas do Libro de Visitas');
if(!defined('_TCMS_MENU_NOTE'))                define('_TCMS_MENU_NOTE', 'Libreta');
if(!defined('_TCMS_MENU_SIDEMENU'))            define('_TCMS_MENU_SIDEMENU', 'Menú lateral');
if(!defined('_TCMS_MENU_TOPMENU'))             define('_TCMS_MENU_TOPMENU', 'Menú superior');
if(!defined('_TCMS_MENU_MENUTITLE'))           define('_TCMS_MENU_MENUTITLE', 'Título do menú');
if(!defined('_TCMS_MENU_CONTENT'))             define('_TCMS_MENU_CONTENT', 'Documentos');
if(!defined('_TCMS_MENU_NEWS'))                define('_TCMS_MENU_NEWS', 'Novas');
if(!defined('_TCMS_MENU_DOWN'))                define('_TCMS_MENU_DOWN', 'Descargas');
if(!defined('_TCMS_MENU_PRODUCTS'))            define('_TCMS_MENU_PRODUCTS', 'Produtos');
if(!defined('_TCMS_MENU_FAQ'))                 define('_TCMS_MENU_FAQ', 'Base de coñecemento');
if(!defined('_TCMS_MENU_SIDEEXT'))             define('_TCMS_MENU_SIDEEXT', 'Extensións');
if(!defined('_TCMS_MENU_SIDE'))                define('_TCMS_MENU_SIDE', 'Barra lateral');
if(!defined('_TCMS_MENU_NEWSLETTER'))          define('_TCMS_MENU_NEWSLETTER', 'Boletín de novas');
if(!defined('_TCMS_MENU_POLL'))                define('_TCMS_MENU_POLL', 'Enquisa');
if(!defined('_TCMS_MENU_EXT'))                 define('_TCMS_MENU_EXT', 'Extensións');
if(!defined('_TCMS_MENU_FRONT'))               define('_TCMS_MENU_FRONT', 'Páxina principal');
if(!defined('_TCMS_MENU_GALLERY'))             define('_TCMS_MENU_GALLERY', 'Galería de imaxes');
if(!defined('_TCMS_MENU_LINK'))                define('_TCMS_MENU_LINK', 'Ligazóns');
if(!defined('_TCMS_MENU_IMP'))                 define('_TCMS_MENU_IMP', 'Formulario de publicación');
if(!defined('_TCMS_MENU_CONTACT'))             define('_TCMS_MENU_CONTACT', 'Xestor de contactos');
if(!defined('_TCMS_MENU_USER'))                define('_TCMS_MENU_USER', 'Xestor de usuarios');
if(!defined('_TCMS_MENU_USERPAGE'))            define('_TCMS_MENU_USERPAGE', 'Editor de páxinas');
if(!defined('_TCMS_MENU_QBOOK'))               define('_TCMS_MENU_QBOOK', 'Libro de visitas');
if(!defined('_TCMS_MENU_CS'))                  define('_TCMS_MENU_CS', 'Sistema de compoñentes');
if(!defined('_TCMS_MENU_CS_UPLOAD'))           define('_TCMS_MENU_CS_UPLOAD', 'Editar e instalar compoñentes');
if(!defined('_TCMS_MENU_GLOBAL'))              define('_TCMS_MENU_GLOBAL', 'Configuración Global');
if(!defined('_TCMS_MENU_DB'))                  define('_TCMS_MENU_DB', 'Configuración da base de datos');
if(!defined('_TCMS_MENU_STATS'))               define('_TCMS_MENU_STATS', 'Estatísticas');
if(!defined('_TCMS_MENU_THEME'))               define('_TCMS_MENU_THEME', 'Xestor de plantillas');
if(!defined('_TCMS_MENU_THEME_UPLOAD'))        define('_TCMS_MENU_THEME_UPLOAD', 'Editar e instalar plantillas');
if(!defined('_TCMS_MENU_THEME_PREVIEW'))       define('_TCMS_MENU_THEME_PREVIEW', 'Previsualizar');
if(!defined('_TCMS_MENU_COPY'))                define('_TCMS_MENU_COPY', 'Licenza');
if(!defined('_TCMS_MENU_CREDITS'))             define('_TCMS_MENU_CREDITS', 'Créditos e Sistema');
if(!defined('_TCMS_MENU_DOCU'))                define('_TCMS_MENU_DOCU', 'Documentación');
if(!defined('_TCMS_MENU_HELP'))                define('_TCMS_MENU_HELP', 'Axuda');
if(!defined('_TCMS_MENU_SUPPORT'))             define('_TCMS_MENU_SUPPORT', 'Soporte');
if(!defined('_TCMS_MENU_ABOUT_MODULE'))        define('_TCMS_MENU_ABOUT_MODULE', 'Módulo Acerca de');
if(!defined('_TCMS_MENU_ABOUT'))               define('_TCMS_MENU_ABOUT', 'Acerca de toendaCMS');
if(!defined('_TCMS_MENU_SEARCH'))              define('_TCMS_MENU_SEARCH', 'Procurar');
if(!defined('_TCMS_MENU_IMPORT'))              define('_TCMS_MENU_IMPORT', 'Importar');
if(!defined('_TCMS_MENU_CFORM'))               define('_TCMS_MENU_CFORM', 'Formulario de contacto');
if(!defined('_TCMS_MENU_BOOK'))                define('_TCMS_MENU_BOOK', 'Libro de visitas');
if(!defined('_TCMS_MENU_LOG'))                 define('_TCMS_MENU_LOG', 'Visor do rexistro');
if(!defined('_TCMS_MENU_SITEMAP'))             define('_TCMS_MENU_SITEMAP', 'Mapa do sitio');


// MODULES
if(!defined('_MOD_HOME'))                      define('_MOD_HOME', 'Inicio');
if(!defined('_MOD_PAGE'))                      define('_MOD_PAGE', 'Escritorio');
if(!defined('_MOD_EXPLORE'))                   define('_MOD_EXPLORE', 'Xestor de ficheiros - Explorar os teus ficheiros');
if(!defined('_MOD_MEDIA'))                     define('_MOD_MEDIA', 'Xestor Multimedia - Administrar os teus ficheiros');
if(!defined('_MOD_NEWS_CATEGORIES'))           define('_MOD_NEWS_CATEGORIES', 'Administrar as Categorías de Novas');
if(!defined('_MOD_COMMENTS'))                  define('_MOD_COMMENTS', 'Administrar Comentarios');
if(!defined('_MOD_GUESTBOOK'))                 define('_MOD_GUESTBOOK', 'Administrar Libro de Visitas');
if(!defined('_MOD_NOTE'))                      define('_MOD_NOTE', 'Notebook - Remember your idea\'s');
if(!defined('_MOD_SIDEMENU'))                  define('_MOD_NEWPAGE', 'Crear unha páxina nova');
if(!defined('_MOD_SIDEMENU'))                  define('_MOD_SIDEMENU', 'Xestor do menú lateral');
if(!defined('_MOD_TOPMENU'))                   define('_MOD_TOPMENU', 'Xestor do Menú superior');
if(!defined('_MOD_USERMENU'))                  define('_MOD_USERMENU', 'Xestor do menú de usuario');
if(!defined('_MOD_MENUTITLE'))                 define('_MOD_MENUTITLE', 'Xestor do menú de título');
if(!defined('_MOD_CONTENT'))                   define('_MOD_CONTENT', 'Xestor de documentos');
if(!defined('_MOD_NEWS'))                      define('_MOD_NEWS', 'Xestor de Novas');
if(!defined('_MOD_DOWN'))                      define('_MOD_DOWN', 'Xestor de descargas');
if(!defined('_MOD_PRODUCTS'))                  define('_MOD_PRODUCTS', 'Xestor de Produtos');
if(!defined('_MOD_SIDEBAR_EXTENSION'))         define('_MOD_SIDEBAR_EXTENSION', 'Configuración de extensión da barra lateral');
if(!defined('_MOD_SIDEBAR'))                   define('_MOD_SIDEBAR', 'Xestor de contidos da barra lateral');
if(!defined('_MOD_NEWSLETTER'))                define('_MOD_NEWSLETTER', 'Xestor do boletín de novas');
if(!defined('_MOD_POLL'))                      define('_MOD_POLL', 'Enquisa');
if(!defined('_MOD_EXTENSIONS'))                define('_MOD_EXTENSIONS', 'Configuración global de extensións');
if(!defined('_MOD_CFORM'))                     define('_MOD_CFORM', 'Configuración do formulario de contacto');
if(!defined('_MOD_BOOK'))                      define('_MOD_BOOK', 'Configuración do Libro de Visitas');
if(!defined('_MOD_FRONTPAGE'))                 define('_MOD_FRONTPAGE', 'Configuración da páxina de inicio');
if(!defined('_MOD_IMPRESSUM'))                 define('_MOD_IMPRESSUM', 'Configuración do deseñador de impresións');
if(!defined('_MOD_GALLERY'))                   define('_MOD_GALLERY', 'Configuración da galería de imaxes');
if(!defined('_MOD_LINK'))                      define('_MOD_LINK', 'Xestor de ligazóns');
if(!defined('_MOD_KNOWLEDGEBASE'))             define('_MOD_KNOWLEDGEBASE', 'Base de datos de coñecemento');
if(!defined('_MOD_CONTACT'))                   define('_MOD_CONTACT', 'Xestor de contactos');
if(!defined('_MOD_USER'))                      define('_MOD_USER', 'Xestor de usuarios');
if(!defined('_MOD_USERPAGE'))                  define('_MOD_USERPAGE', 'configuración do editor de páxinas');
if(!defined('_MOD_COMPONENTS'))                define('_MOD_COMPONENTS', 'Sistema de compoñentes');
if(!defined('_MOD_COMPONENTS_UPLOAD'))         define('_MOD_COMPONENTS_UPLOAD', 'Instalar e Editar Compoñentes');
if(!defined('_MOD_GLOBAL'))                    define('_MOD_GLOBAL', 'Configuración Global');
if(!defined('_MOD_IMPORT'))                    define('_MOD_IMPORT', 'Importar');
if(!defined('_MOD_DB'))                        define('_MOD_DB', 'Configuración da base de datos');
if(!defined('_MOD_STATS'))                     define('_MOD_STATS', 'Estatísticas do sitio web');
if(!defined('_MOD_TEMPLATE'))                  define('_MOD_TEMPLATE', 'Xestor de plantillas');
if(!defined('_MOD_TEMPLATE_UPLOAD'))           define('_MOD_TEMPLATE_UPLOAD', 'Xestor de edición e instalación de plantillas');
if(!defined('_MOD_LICENSE'))                   define('_MOD_LICENSE', 'Licenza de toendaCMS (GNU/GPL)');
if(!defined('_MOD_HELP'))                      define('_MOD_HELP', 'Axuda para diferentes módulos e configuracións');
if(!defined('_MOD_DOCU'))                      define('_MOD_DOCU', 'Documentación');
if(!defined('_MOD_CREDITS'))                   define('_MOD_CREDITS', 'Créditos e Sistema de Información');
if(!defined('_MOD_ABOUT_MODULE'))              define('_MOD_ABOUT_MODULE', 'Descrición dos módulos de toendaCMS');
if(!defined('_MOD_ABOUT'))                     define('_MOD_ABOUT', 'Acerca de toendaCMS');
if(!defined('_MOD_LOG'))                       define('_MOD_LOG', 'Visor do rexistro');


// TABLES
if(!defined('_TABLE_TITLE'))                   define('_TABLE_TITLE', 'Título');
if(!defined('_TABLE_SUBTITLE'))                define('_TABLE_SUBTITLE', 'Subtítulo');
if(!defined('_TABLE_PUBLISH'))                 define('_TABLE_PUBLISH', 'Información da publicación');
if(!defined('_TABLE_TEXT'))                    define('_TABLE_TEXT', 'Texto principal');
if(!defined('_TABLE_DEFAULT'))                 define('_TABLE_DEFAULT', 'Por defecto');
if(!defined('_TABLE_PUBLISHED'))               define('_TABLE_PUBLISHED', 'Publicado');
if(!defined('_TABLE_NOT_PUBLISHED'))           define('_TABLE_NOT_PUBLISHED', 'Non publicado');
if(!defined('_TABLE_PUBLISHED_ON'))            define('_TABLE_PUBLISHED_ON', 'Publicado o');
if(!defined('_TABLE_PUBLISHING'))              define('_TABLE_PUBLISHING', 'Publicarase o');
if(!defined('_TABLE_RSS'))                     define('_TABLE_RSS', 'Ligazóns RSS');
if(!defined('_TABLE_ENABLED'))                 define('_TABLE_ENABLED', 'Habilitado');
if(!defined('_TABLE_NAME'))                    define('_TABLE_NAME', 'Nome');
if(!defined('_TABLE_USERNAME'))                define('_TABLE_USERNAME', 'Nome de usuario');
if(!defined('_TABLE_GROUP'))                   define('_TABLE_GROUP', 'Grupo de usuario');
if(!defined('_TABLE_PERSON'))                  define('_TABLE_PERSON', 'Información persoal');
if(!defined('_TABLE_SUBID'))                   define('_TABLE_SUBID', 'SUB ID');
if(!defined('_TABLE_ORDER'))                   define('_TABLE_ORDER', 'ID');
if(!defined('_TABLE_TARGET'))                  define('_TABLE_TARGET', 'Destino');
if(!defined('_TABLE_POS'))                     define('_TABLE_POS', 'Posición');
if(!defined('_TABLE_IN_WORK'))                 define('_TABLE_IN_WORK', 'Rematado');
if(!defined('_TABLE_IS_IN_WORK'))              define('_TABLE_IS_IN_WORK', 'En Uso');
if(!defined('_TABLE_FUNCTIONS'))               define('_TABLE_FUNCTIONS', 'Funcións');
if(!defined('_TABLE_PARENT'))                  define('_TABLE_PARENT', 'Elemento pai para o submenú');
if(!defined('_TABLE_PARENTC'))                 define('_TABLE_PARENTC', 'Escolla');
if(!defined('_TABLE_PARENTN'))                 define('_TABLE_PARENTN', 'Sen submenú');
if(!defined('_TABLE_PARENTITEM'))              define('_TABLE_PARENTITEM', 'Elemento pai');
if(!defined('_TABLE_MENUINFO'))                define('_TABLE_MENUINFO', 'Soamente podes crear submenús no menú lateral.');
if(!defined('_TABLE_AUTOR'))                   define('_TABLE_AUTOR', 'Autor');
if(!defined('_TABLE_CATEGORY'))                define('_TABLE_CATEGORY', 'Categoría');
if(!defined('_TABLE_PRODUCT'))                 define('_TABLE_PRODUCT', 'Produto');
if(!defined('_TABLE_FILE'))                    define('_TABLE_FILE', 'Ficheiro');
if(!defined('_TABLE_FILE_EXISTS'))             define('_TABLE_FILE_EXISTS', 'Si o ficheiro existe introduce o nome completo. Comprueba isto antes de subilo: Crea unha carpeta co  nome do ficheiro, pero sen extensión como .zip, e os espazos teñen que ser guións baixos (_). Esta será a carpeta empregada.');
if(!defined('_TABLE_FILE_OTHERURL'))           define('_TABLE_FILE_OTHERURL', 'Se o ficheiro está noutro servidor, introduce aquí a ruta completa e o nome do ficheiro (crearase un cartafol con ese nome).');
if(!defined('_TABLE_FILE_EXISTS_NAME'))        define('_TABLE_FILE_EXISTS_NAME', 'O ficheiro xa existe');
if(!defined('_TABLE_FILE_OTHERURL_NAME'))      define('_TABLE_FILE_OTHERURL_NAME', 'Ficheiro noutro Servidor');
if(!defined('_TABLE_DATE'))                    define('_TABLE_DATE', 'Data');
if(!defined('_TABLE_TIME'))                    define('_TABLE_TIME', 'Hora');
if(!defined('_TABLE_EMAIL'))                   define('_TABLE_EMAIL', 'Correo-e');
if(!defined('_TABLE_OPTION'))                  define('_TABLE_OPTION', 'Opción');
if(!defined('_TABLE_INFO'))                    define('_TABLE_INFO', 'Información');
if(!defined('_TABLE_ORDER_HELP'))              define('_TABLE_ORDER_HELP', '(Número de Identificación)');
if(!defined('_TABLE_ALBUM'))                   define('_TABLE_ALBUM', 'Álbume');
if(!defined('_TABLE_DIR'))                     define('_TABLE_DIR', 'Directorio');
if(!defined('_TABLE_BACKENDFILE'))             define('_TABLE_BACKENDFILE', 'Ficheiro do backend');
if(!defined('_TABLE_FRONTENDFILE'))            define('_TABLE_FRONTENDFILE', 'Ficheiro do Frontend');
if(!defined('_TABLE_SIDEBARFILE'))             define('_TABLE_SIDEBARFILE', 'Ficheiro da barra lateral');
if(!defined('_TABLE_SETTINGSFILE'))            define('_TABLE_SETTINGSFILE', 'Ficheiro de configuracións');
if(!defined('_TABLE_IMAGE'))                   define('_TABLE_IMAGE', 'Imaxe');
if(!defined('_TABLE_IMAGES'))                  define('_TABLE_IMAGES', 'Imaxes');
if(!defined('_TABLE_USE'))                     define('_TABLE_USE', 'Empregar');
if(!defined('_TABLE_DELETE'))                  define('_TABLE_DELETE', 'Eliminar');
if(!defined('_TABLE_DESCRIPTION'))             define('_TABLE_DESCRIPTION', 'Descrición');
if(!defined('_TABLE_NEW'))                     define('_TABLE_NEW', 'Nova entrada');
if(!defined('_TABLE_EDIT'))                    define('_TABLE_EDIT', 'Editar entrada');
if(!defined('_TABLE_DETAILS'))                 define('_TABLE_DETAILS', 'Detalles da entrada');
if(!defined('_TABLE_GENERAL'))                 define('_TABLE_GENERAL', 'Información xeral');
if(!defined('_TABLE_FURTHER'))                 define('_TABLE_FURTHER', 'Máis datos');
if(!defined('_TABLE_SETTINGS'))                define('_TABLE_SETTINGS', 'Configuracións');
if(!defined('_TABLE_CONTACT'))                 define('_TABLE_CONTACT', 'Información de contacto');
if(!defined('_TABLE_PRODUCTNO'))               define('_TABLE_PRODUCTNO', 'Número de artigo');
if(!defined('_TABLE_FACTORY'))                 define('_TABLE_FACTORY', 'Fabricante');
if(!defined('_TABLE_URL'))                     define('_TABLE_URL', 'Sitio web');
if(!defined('_TABLE_STOCK'))                   define('_TABLE_STOCK', 'En stock');
if(!defined('_TABLE_PRICE'))                   define('_TABLE_PRICE', 'Prezo');
if(!defined('_TABLE_PRICE_ADD'))               define('_TABLE_PRICE_ADD', '(en bruto, para deixar en limpo poñer a tasa baleira)');
if(!defined('_TABLE_TAX'))                     define('_TABLE_TAX', 'Con impostos');
if(!defined('_TABLE_QUANTITY'))                define('_TABLE_QUANTITY', 'Cantidade');
if(!defined('_TABLE_WEIGHT'))                  define('_TABLE_WEIGHT', 'Peso');
if(!defined('_TABLE_SAVEBUTTON'))              define('_TABLE_SAVEBUTTON', 'Gardar');
if(!defined('_TABLE_EDITBUTTON'))              define('_TABLE_EDITBUTTON', 'Editar');
if(!defined('_TABLE_DELBUTTON'))               define('_TABLE_DELBUTTON', 'Eliminar');
if(!defined('_TABLE_SETTINGSBUTTON'))          define('_TABLE_SETTINGSBUTTON', 'Configuracións');
if(!defined('_TABLE_ADMINBUTTON'))             define('_TABLE_ADMINBUTTON', 'Administrar');
if(!defined('_TABLE_ACCEPTBUTTON'))            define('_TABLE_ACCEPTBUTTON', 'Aceptar');
if(!defined('_TABLE_THUMBNAIL'))               define('_TABLE_THUMBNAIL', 'Miniatura');
if(!defined('_TABLE_GOUPBUTTON'))              define('_TABLE_GOUPBUTTON', 'Ir enriba');
if(!defined('_TABLE_ACCESS'))                  define('_TABLE_ACCESS', 'Nivel de acceso');
if(!defined('_TABLE_MACCESS'))                 define('_TABLE_MACCESS', 'Acceso');
if(!defined('_TABLE_LINKTO'))                  define('_TABLE_LINKTO', 'Ligazón a ');
if(!defined('_TABLE_COMMENTS'))                define('_TABLE_COMMENTS', 'Comentarios');
if(!defined('_TABLE_LINK'))                    define('_TABLE_LINK', 'CID');
if(!defined('_TABLE_PUBLIC'))                  define('_TABLE_PUBLIC', 'Público (Para todos os convidados)');
if(!defined('_TABLE_PROTECTED'))               define('_TABLE_PROTECTED', 'Protexido (Só usuarios rexistrados)');
if(!defined('_TABLE_PRIVATE'))                 define('_TABLE_PRIVATE', 'Privado (Nengún usuario nen convidado)');
if(!defined('_TABLE_WHICHMENU'))               define('_TABLE_WHICHMENU', 'En que menú inserir a entrada?');
if(!defined('_TABLE_SIDEMENU'))                define('_TABLE_SIDEMENU', 'Menú lateral');
if(!defined('_TABLE_TOPMENU'))                 define('_TABLE_TOPMENU', 'Menú superior');
if(!defined('_TABLE_USERMENU'))                define('_TABLE_USERMENU', 'Menú de usuario');
if(!defined('_TABLE_CHARSET'))                 define('_TABLE_CHARSET', 'Xogo de caracteres');
if(!defined('_TABLE_ALIAS'))                   define('_TABLE_ALIAS', 'Alias');
if(!defined('_TABLE_LEFT'))                    define('_TABLE_LEFT', 'Esquerda');
if(!defined('_TABLE_RIGHT'))                   define('_TABLE_RIGHT', 'Dereita');
if(!defined('_TABLE_CENTER'))                  define('_TABLE_CENTER', 'Centro');
if(!defined('_TABLE_TYPE'))                    define('_TABLE_TYPE', 'Tipo');
if(!defined('_TABLE_MENUTITLE'))               define('_TABLE_MENUTITLE', 'Título do menú');
if(!defined('_TABLE_MENULINK'))                define('_TABLE_MENULINK', 'Ligazón');
if(!defined('_TABLE_MENUWEB'))                 define('_TABLE_MENUWEB', 'Ligazón web');
if(!defined('_TABLE_REORDER'))                 define('_TABLE_REORDER', 'Reordear');
if(!defined('_TABLE_DEFAULT_NEWS_CATEGORY'))   define('_TABLE_DEFAULT_NEWS_CATEGORY', 'Categoría de novas por defecto');
if(!defined('_TABLE_MAIN_CS'))                 define('_TABLE_MAIN_CS', 'Compoñente para a páxina principal');
if(!defined('_TABLE_SIDE_CS'))                 define('_TABLE_SIDE_CS', 'Compoñente para a barra lateral');
if(!defined('_TABLE_START'))                   define('_TABLE_START', 'Comezar');
if(!defined('_TABLE_PREVIOUS'))                define('_TABLE_PREVIOUS', 'Previo');
if(!defined('_TABLE_NEXT'))                    define('_TABLE_NEXT', 'Seguinte');
if(!defined('_TABLE_END'))                     define('_TABLE_END', 'Fin');
if(!defined('_TABLE_DISPLAY'))                 define('_TABLE_DISPLAY', 'Amosar');
if(!defined('_TABLE_A_PAGE'))                  define('_TABLE_A_PAGE', 'unha páxina');
if(!defined('_TABLE_OF'))                      define('_TABLE_OF', 'de');
if(!defined('_TABLE_ENABLED_THIS'))            define('_TABLE_ENABLED_THIS', 'Habilitado');
if(!defined('_TABLE_DISABLED_THIS'))           define('_TABLE_DISABLED_THIS', 'Deshabilitado');
if(!defined('_TABLE_IP'))                      define('_TABLE_IP', 'IP');
if(!defined('_TABLE_DOMAIN'))                  define('_TABLE_DOMAIN', 'Dominio');
if(!defined('_TABLE_SIDEBAR'))                 define('_TABLE_SIDEBAR', 'Barra lateral');
if(!defined('_TABLE_MAINCONTENT'))             define('_TABLE_MAINCONTENT', 'Páxina principal');
if(!defined('_TABLE_BOTH'))                    define('_TABLE_BOTH', 'Ambos');
if(!defined('_TABLE_FILTER'))                  define('_TABLE_FILTER', 'Filtro e Configuracións');
if(!defined('_TABLE_SORT_SIDE'))               define('_TABLE_SORT_SIDE', 'Posición da barra lateral');
if(!defined('_TABLE_LOCATION'))                define('_TABLE_LOCATION', 'Localización');
if(!defined('_TABLE_DATES'))                   define('_TABLE_DATES', 'Datas');
if(!defined('_TABLE_HELPBROWSER'))             define('_TABLE_HELPBROWSER', 'Axuda de toendaCMS');
if(!defined('_TABLE_LINKBROWSER'))             define('_TABLE_LINKBROWSER', 'Navegador ligazóns');
if(!defined('_TABLE_LINKBROWSER_TEXT'))        define('_TABLE_LINKBROWSER_TEXT', 'Prema no botón para empregar a ligazón no documento. Podes inserir un título no campo de texto para establecer o nome da ligazón.');
if(!defined('_TABLE_LINKBROWSER_TEXT_TINYMCE'))define('_TABLE_LINKBROWSER_TEXT_TINYMCE', 'tinyMCE: Debes seleccionar un texto para cambialo dentro dunha ligazón.');
if(!defined('_TABLE_IMAGEBROWSER'))            define('_TABLE_IMAGEBROWSER', 'Navegador multimedia');
if(!defined('_TABLE_IMAGEBROWSER_TEXT'))       define('_TABLE_IMAGEBROWSER_TEXT', 'Preme no botón para empregar os ficheiros multimedia no documento.');
if(!defined('_TABLE_DIARY_RSS'))               define('_TABLE_DIARY_RSS', 'Diario RSS');
if(!defined('_TABLE_DIARY_TICKET'))            define('_TABLE_DIARY_TICKET', 'Tickets');
if(!defined('_TABLE_IMPORT'))                  define('_TABLE_IMPORT', 'Importar');
if(!defined('_TABLE_SORT'))                    define('_TABLE_SORT', 'Clasificación');
if(!defined('_TABLE_SORT_DESC'))               define('_TABLE_SORT_DESC', 'Clasificación descendente');
if(!defined('_TABLE_SORT_ASC'))                define('_TABLE_SORT_ASC', 'Clasificación ascendente');
if(!defined('_TABLE_VIEW'))                    define('_TABLE_VIEW', 'Vista');
if(!defined('_TABLE_FRONTPAGE'))               define('_TABLE_FRONTPAGE', 'Páxina de inicio');
if(!defined('_TABLE_SHOWONMAINPAGE'))          define('_TABLE_SHOWONMAINPAGE', 'Amosar na páxina de inicio');
if(!defined('_TABLE_BROWSE'))                  define('_TABLE_BROWSE', 'Navegar');
if(!defined('_TABLE_BOOKMARK'))                define('_TABLE_BOOKMARK', 'Marcador');
if(!defined('_TABLE_SYS_INFO'))                define('_TABLE_SYS_INFO', 'Información do sistema');
if(!defined('_TABLE_YOU_ARE_RUNNING'))         define('_TABLE_YOU_ARE_RUNNING', 'Estás executando');
if(!defined('_TABLE_SITE_STATS'))              define('_TABLE_SITE_STATS', 'Estatísticas do sitio');
if(!defined('_TABLE_NUM_OF_NEWS'))             define('_TABLE_NUM_OF_NEWS', 'Total Posts');
if(!defined('_TABLE_NUM_OF_YOUR_NEWS'))        define('_TABLE_NUM_OF_YOUR_NEWS', 'Número de Posts propios');
if(!defined('_TABLE_NUM_OF_COMMENTS'))         define('_TABLE_NUM_OF_COMMENTS', 'Número de comentarios');
if(!defined('_TABLE_MODULE'))                  define('_TABLE_MODULE', 'Módulo');


// MESSAGES
if(!defined('_DIE_LOGIN'))                     define('_DIE_LOGIN', 'Inicie sesión!Iniciar sesión');
if(!defined('_MSG_NOINFO'))                    define('_MSG_NOINFO', '[NENGUNHA INFORMACIÓN DISPOÑIBLE]');
if(!defined('_MSG_SAVED'))                     define('_MSG_SAVED', 'Gardado con éxito.');
if(!defined('_MSG_SAVED_FAILED'))              define('_MSG_SAVED_FAILED', 'Non foi gardado con éxito.');
if(!defined('_MSG_SEND'))                      define('_MSG_SEND', 'Enviado con éxito.');
if(!defined('_MSG_SEND_FAILED'))               define('_MSG_SEND_FAILED', 'Erro no envío!');
if(!defined('_MSG_NOTWRITABLE'))               define('_MSG_NOTWRITABLE', 'NON SE PODE ESCRIBIR!');
if(!defined('_MSG_NOINSTALL'))                 define('_MSG_NOINSTALL', 'Por favor instala primeiro!');
if(!defined('_MSG_GOTOINSTALL'))               define('_MSG_GOTOINSTALL', 'IR Á INSTALACIÓN');
if(!defined('_MSG_RM_INSTALLDIR'))             define('_MSG_RM_INSTALLDIR', 'Por favor, elimina o directorio de instalación!');
if(!defined('_MSG_PAGE_LOAD_1'))               define('_MSG_PAGE_LOAD_1', 'Páxina xerada en');
if(!defined('_MSG_PAGE_LOAD_2'))               define('_MSG_PAGE_LOAD_2', 'segundos');
if(!defined('_MSG_NOIMAGE'))                   define('_MSG_NOIMAGE', 'Nengunha imaxe seleccionada.');
if(!defined('_MSG_IMAGE'))                     define('_MSG_IMAGE', 'Imaxe subida con éxito a');
if(!defined('_MSG_NONAME'))                    define('_MSG_NONAME', 'Porfavor insira o seu nome');
if(!defined('_MSG_NOCAPTCHA'))                 define('_MSG_NOCAPTCHA', 'Por favor insira o código da imaxe');
if(!defined('_MSG_CAPTCHA_NOT_VALID'))         define('_MSG_CAPTCHA_NOT_VALID', 'O código introducido e o código da imaxe non son o mesmo');
if(!defined('_MSG_FALSEPASSWORD'))             define('_MSG_FALSEPASSWORD', 'Contrasinal errado!');
if(!defined('_MSG_PASSWORDNOTVALID'))          define('_MSG_PASSWORDNOTVALID', 'Contrasinal non válido!');
if(!defined('_MSG_NOPASSWORD'))                define('_MSG_NOPASSWORD', 'Contrasinais non válidos!');
if(!defined('_MSG_NOEMAIL'))                   define('_MSG_NOEMAIL', 'Non se proporcionou un enderezo de correo');
if(!defined('_MSG_EMAILVALID'))                define('_MSG_EMAILVALID', 'Enderezo de correo non válido');
if(!defined('_MSG_DELETE'))                    define('_MSG_DELETE', 'Eliminado satisfactoriamente.');
if(!defined('_MSG_DELETE_ERROR'))              define('_MSG_DELETE_ERROR', 'Erro ao eliminar!');
if(!defined('_MSG_DELETE_SUBMIT'))             define('_MSG_DELETE_SUBMIT', 'Estás seguro de querer eliminar esta entrada?');
if(!defined('_MSG_DELETE_INACTIVE'))           define('_MSG_DELETE_INACTIVE', 'Erro ao eliminar. A entrada non foi activada porque non se seleccionou a caixa de verificación.');
if(!defined('_MSG_NOSUBJECT'))                 define('_MSG_NOSUBJECT', 'Insire un tema');
if(!defined('_MSG_NOMSG'))                     define('_MSG_NOMSG', 'Insire unha mensaxe');
if(!defined('_MSG_NEWSLETTER'))                define('_MSG_NEWSLETTER', 'Subscribícheste correctamente ao noso boletín de novas.');
if(!defined('_MSG_POLL'))                      define('_MSG_POLL', 'Grazas por votar nesta enquisa.');
if(!defined('_MSG_UPLOAD'))                    define('_MSG_UPLOAD', 'O ficheiro foi subido a');
if(!defined('_MSG_NOUPLOAD'))                  define('_MSG_NOUPLOAD', 'O ficheiro non pode ser subido.');
if(!defined('_MSG_NOUPLOAD_PHP'))              define('_MSG_NOUPLOAD_PHP', 'O ficheiro non pode ser subido. As configuracións no INI de upload_max_size ou post_max_size son pequenas.');
if(!defined('_MSG_REGNOTALLOWD'))              define('_MSG_REGNOTALLOWD', 'Non se permite o rexistro.');
if(!defined('_MSG_NOACCOUNT'))                 define('_MSG_NOACCOUNT', 'Sen conta.');
if(!defined('_MSG_NOCONTENT'))                 define('_MSG_NOCONTENT', 'Por favor cumprimenta todos os campos.');
if(!defined('_MSG_USERNOTEXISTS'))             define('_MSG_USERNOTEXISTS', 'O usuario non existe.');
if(!defined('_MSG_USEREXISTS'))                define('_MSG_USEREXISTS', 'O nome de usuario xa existe, Escolle outro.');
if(!defined('_MSG_ERROR'))                     define('_MSG_ERROR', 'Erro');
if(!defined('_MSG_CODE'))                      define('_MSG_CODE', 'Código');
if(!defined('_MSG_PHP_UPLOAD_SETTINGS'))       define('_MSG_PHP_UPLOAD_SETTINGS', 'Os axustes de subida de PHP non son suficientes para esta función.');
if(!defined('_MSG_PHP_SAFE_MODE_SETTINGS'))    define('_MSG_PHP_SAFE_MODE_SETTINGS', 'The \'safe_mode\' option is on your server \'on\' for PHP, you cannot use this feature.');
if(!defined('_MSG_MAX_FILE_SIZE'))             define('_MSG_MAX_FILE_SIZE', 'Tamaño máximo de ficheiro');
if(!defined('_MSG_MAX_POST_SIZE'))             define('_MSG_MAX_POST_SIZE', 'Tamaño máximo de envío vía POST');
if(!defined('_MSG_FILE_UPLOADS'))              define('_MSG_FILE_UPLOADS', 'Subida de ficheiros');
if(!defined('_MSG_NOTENOUGH_USERRIGHTS'))      define('_MSG_NOTENOUGH_USERRIGHTS', 'Non dispós de suficiente autorización para usar esta páxina.');
if(!defined('_MSG_SESSION_EXPIRED'))           define('_MSG_SESSION_EXPIRED', 'A túa sesión expirou!Accede de novo.Acceso');
if(!defined('_MSG_NOT_FINALIZED'))             define('_MSG_NOT_FINALIZED', 'O teu documento non está finalizado. Queres publicalo de todos modos?');
if(!defined('_MSG_NOT_PUBLISHED'))             define('_MSG_NOT_PUBLISHED', 'O documento escollido non está publicado todavía. Non podes leelo!');
if(!defined('_MSG_DISABLED_MODUL'))            define('_MSG_DISABLED_MODUL', 'O módulo escollido está deshabilitado. Non podes usalo!');
if(!defined('_MSG_CHANGE_DATABASE_ENGINE'))    define('_MSG_CHANGE_DATABASE_ENGINE', 'Desexas cambiar de base de datos?Deberás desconectarte e non poderás usar os teus datos noutra base de datos.Desculpas, pero a importación XML - SQL inda está en fase de desenvolvemento...');
if(!defined('_MSG_IF_DOWNLOAD_DOES_NOT_START'))define('_MSG_IF_DOWNLOAD_DOES_NOT_START', 'Se a túa descarga non comenza, preme na seguinte ligazón');
if(!defined('_MSG_BACKUP_SUCCESSFULL'))        define('_MSG_BACKUP_SUCCESSFULL', 'Copia de seguranza da base de datos.Táboas afectadas:');
if(!defined('_MSG_BACKUP_FAILED'))             define('_MSG_BACKUP_FAILED', 'Erro na copia da base de datos!');
if(!defined('_MSG_CHANGES'))                   define('_MSG_CHANGES', 'Fixeches cambios.');
if(!defined('_MSG_SAVE_NOW'))                  define('_MSG_SAVE_NOW', 'Desexas gardalos agora?');
if(!defined('_MSG_NO_ALBUM_WITH_THIS_ID'))     define('_MSG_NO_ALBUM_WITH_THIS_ID', 'O sistema non atopou un álbume con este ID!');
if(!defined('_MSG_CREATE_ALBUM_FIRST'))        define('_MSG_CREATE_ALBUM_FIRST', '* Crear o primeiro álbume *');
if(!defined('_MSG_ACTIVATE_NEW_PW_FIRST'))     define('_MSG_ACTIVATE_NEW_PW_FIRST', 'Para activar o teu novo contrasinal preme na seguinte ligazón:');
if(!defined('_MSG_SUCCESSFULL_RETRIEVED'))     define('_MSG_SUCCESSFULL_RETRIEVED', 'Recuperaches o novo contrasinal con éxito.');
if(!defined('_MSG_ERROR_ON_RETRIEVING'))       define('_MSG_ERROR_ON_RETRIEVING', 'Erro validando o novo contrasinal!');
if(!defined('_MSG_COMMENT_FOR'))               define('_MSG_COMMENT_FOR', 'Comentar a');


// LOGIN
if(!defined('_LOGIN_MSG'))                     define('_LOGIN_MSG', 'Acceso');
if(!defined('_LOGIN_USERNAME'))                define('_LOGIN_USERNAME', 'Nome de usuario');
if(!defined('_LOGIN_USERNAME_JS'))             define('_LOGIN_USERNAME_JS', 'Introduce o teu nome de usuario!');
if(!defined('_LOGIN_PASSWORD'))                define('_LOGIN_PASSWORD', 'Contrasinal');
if(!defined('_LOGIN_PASSWORD_JS'))             define('_LOGIN_PASSWORD_JS', 'Introduce o teu contrasinal!');
if(!defined('_LOGIN_FALSE'))                   define('_LOGIN_FALSE', 'Falso: Nome de usuario, contrasinal ou dereitos de usuario (Grupo)');
if(!defined('_LOGIN_FALSE_LPW'))               define('_LOGIN_FALSE_LPW', 'Falso: Nome de usuario ou Correo-e');
if(!defined('_LOGIN_SUBMIT'))                  define('_LOGIN_SUBMIT', 'Acceso');
if(!defined('_LOGIN_LOGOUT'))                  define('_LOGIN_LOGOUT', 'Saír');
if(!defined('_LOGIN_PROFILE'))                 define('_LOGIN_PROFILE', 'Perfil');
if(!defined('_LOGIN_LIST'))                    define('_LOGIN_LIST', 'Lista de membros');
if(!defined('_LOGIN_LIST_TEXT'))               define('_LOGIN_LIST_TEXT', 'Esta é a lista de todos os membros. Preme no nome de usuario para ver este perfil.');
if(!defined('_LOGIN_ADMIN'))                   define('_LOGIN_ADMIN', 'Administración');
if(!defined('_LOGIN_FORGOTPW'))                define('_LOGIN_FORGOTPW', 'Esqueciches o teu contrasinal?');
if(!defined('_LOGIN_WELCOME'))                 define('_LOGIN_WELCOME', 'Benvido');
if(!defined('_LOGIN_SUBMIT_NEWS'))             define('_LOGIN_SUBMIT_NEWS', 'Publicar novas');
if(!defined('_LOGIN_SUBMIT_IMAGES'))           define('_LOGIN_SUBMIT_IMAGES', 'Enviar imaxes');
if(!defined('_LOGIN_CREATE_ALBUM'))            define('_LOGIN_CREATE_ALBUM', 'Crear álbume');
if(!defined('_LOGIN_CREATE_CATEGORY'))         define('_LOGIN_CREATE_CATEGORY', 'Crear categoría');
if(!defined('_LOGIN_SUBMIT_MEDIA'))            define('_LOGIN_SUBMIT_MEDIA', 'Enviar ficheiro multimedia');


// REGISTRATION
if(!defined('_REG_TITLE'))                     define('_REG_TITLE', 'Rexistro');
if(!defined('_REG_LPW'))                       define('_REG_LPW', 'Perdiches o teu contrasinal?');
if(!defined('_REG_LPWTEXT'))                   define('_REG_LPWTEXT', 'Introduce o teu nome de usuario e correo-e, preme no botón de Enviar Contrasinal. Recibirás o novo contrasinal en breve. Poderás empregar este contrasinal para acceder ao sitio.');
if(!defined('_REG_TEXT_1'))                    define('_REG_TEXT_1', 'Os campos marcador con un asterisco son obrigatorios.');
if(!defined('_REG_TEXT_2'))                    define('_REG_TEXT_2', 'Sen asterisco non son obrigatorios.');
if(!defined('_REG_SUBMIT_LPW'))                define('_REG_SUBMIT_LPW', 'Enviar contrasinal');
if(!defined('_REG_SUBMIT_SR'))                 define('_REG_SUBMIT_SR', 'Enviar rexistro');
if(!defined('_REG_PWNOTAGREE'))                define('_REG_PWNOTAGREE', 'Contrasinais non concordan!');
if(!defined('_REG_NAME_NG'))                   define('_REG_NAME_NG', 'Non introduciches o nome!');
if(!defined('_REG_USERNAME_NG'))               define('_REG_USERNAME_NG', 'Non introduciche o nome de usuario!');
if(!defined('_REG_PASSWORD_NG'))               define('_REG_PASSWORD_NG', 'non introduciches o teu contrasinal!');
if(!defined('_REG_EMAIL_NG'))                  define('_REG_EMAIL_NG', 'Non introduciche o correo-e!');
if(!defined('_REG_LPW_SUCCESS'))               define('_REG_LPW_SUCCESS', 'O teu novo contrasinal');
if(!defined('_REG_SUCCESS'))                   define('_REG_SUCCESS', 'Rexistrácheste satisfactoriamente');
if(!defined('_REG_NO_SUCCESS'))                define('_REG_NO_SUCCESS', 'Erro no rexistro');
if(!defined('_REG_SUCCESS_TEXT'))              define('_REG_SUCCESS_TEXT', 'O teu rexistro fíxose con éxito. Preme na ligazón e poderás acceder ao sitio co teu nome de usuario.');
if(!defined('_REG_AUTO_MSG'))                  define('_REG_AUTO_MSG', 'Esta é unha mensaxe automática dende');
if(!defined('_REG_TEXT_LPW'))                  define('_REG_TEXT_LPW', 'Un usuario quere obter un novo contrasinal. Este é o teu novo contrasinal.');
if(!defined('_REG_VALIDATE'))                  define('_REG_VALIDATE', 'Noraboa, estás rexistrado. Agora podes iniciar unha sesión empregando o nome de usuario e contrasinal seleccionados.');
if(!defined('_REG_NO_VALIDATE'))               define('_REG_NO_VALIDATE', 'Erro, o teu código de validación non é válido.');
if(!defined('_REG_USERPROFILE'))               define('_REG_USERPROFILE', 'Truco: Podes cambiar algúns axustes como o teu contrasinal, nome de usuario e outros axustes no teu perfil.');
if(!defined('_REG_EMAIL'))                     define('_REG_EMAIL', 'Rexistrouse un novo usuario.');
if(!defined('_REG_SUCCESS_MAIL'))              define('_REG_SUCCESS_MAIL', 'Rexistrouse un novo usuario na túa páxina.');


// PROFILE
if(!defined('_PROFILE_TITLE'))                 define('_PROFILE_TITLE', 'Vendo o perfil de usuario');
if(!defined('_PROFILE_EDIT'))                  define('_PROFILE_EDIT', 'Editar o perfil de usuario');


// USERPAGES
if(!defined('_USERPAGE'))                      define('_USERPAGE', 'Editor de páxinas');
if(!defined('_USERPAGE_TEXT'))                 define('_USERPAGE_TEXT', 'Podes realizar axustes nas páginas de usuario como o teu perfil na configuración da páxina de usuario. Tamén poderás ter a posibilidade de publicar novas, imaxes e álbumes.');
if(!defined('_USERPAGE_TEXT_WIDTH'))           define('_USERPAGE_TEXT_WIDTH', 'Anchura do campo de texto');
if(!defined('_USERPAGE_INPUT_WIDTH'))          define('_USERPAGE_INPUT_WIDTH', 'Anchura do campo');
if(!defined('_USERPAGE_PUBLISH_NEWS'))         define('_USERPAGE_PUBLISH_NEWS', 'O usuario pode publicar novas dende o frontend');
if(!defined('_USERPAGE_PUBLISH_IMAGES'))       define('_USERPAGE_PUBLISH_IMAGES', 'O usuario pode publicar imaxes dende o frontend');
if(!defined('_USERPAGE_PUBLISH_ALBUMS'))       define('_USERPAGE_PUBLISH_ALBUMS', 'O usuario pode publicar álbumes dende o frontpage');
if(!defined('_USERPAGE_CREATE_CATEGORIES'))    define('_USERPAGE_CREATE_CATEGORIES', 'O usuario pode crear novas categorías de novas dende o frontpage');
if(!defined('_USERPAGE_PUBLISH_PICTURE'))      define('_USERPAGE_PUBLISH_PICTURE', 'O usuario pode publicar imaxes ao xestor multimedia dende o frontpage');


// START
if(!defined('_START_MSG'))                     define('_START_MSG', 'Benvido');
if(!defined('_START_QUESTION'))                define('_START_QUESTION', 'Que vas facer hoxe?');
if(!defined('_START_TEXT_0'))                  define('_START_TEXT_0', 'Bota un vistazo ao teu escritorio. Podes atopar no teu escritorio todas as tarefas pendentes, notas e unha descrición de todos os documentos e novas nos que tes que traballar.');
if(!defined('_START_TEXT_1'))                  define('_START_TEXT_1', 'Crear unha páxina. Para facer isto, crea unha entrada de menú e edítaa a continuación na páxina de contido estático e no contido da barra lateral.');
if(!defined('_START_TEXT_2'))                  define('_START_TEXT_2', 'Editar os axustes do sistema. Podes cambiar o nome e o título do teu sitio, e podes editar as metatags.');
if(!defined('_START_TEXT_3'))                  define('_START_TEXT_3', 'Escribir novas. Vai ao xestor de novas e escribe as túas novas.');
if(!defined('_START_TEXT_4'))                  define('_START_TEXT_4', 'Cargar unha imaxe na túa galería. E amosar a toda a xente as túas opinións ou as situación máis divertidas.');


// DESKTOP
if(!defined('_DESKTOP_TOP_TEXT'))              define('_DESKTOP_TOP_TEXT', 'Se desexas editar o contido da páxina, preme no título da páxina na árbore do lado esquerdo.');
if(!defined('_DESKTOP_UNPUBLISHED_NEWS'))      define('_DESKTOP_UNPUBLISHED_NEWS', 'Novas sen publicar');
if(!defined('_DESKTOP_UNPUBLISHED_PAGES'))     define('_DESKTOP_UNPUBLISHED_PAGES', 'Documentos sen publicar');
if(!defined('_DESKTOP_UNFINISHED_PAGES'))      define('_DESKTOP_UNFINISHED_PAGES', 'Documentos non rematados');


// SIDEMENU
if(!defined('_SIDEMENU_TITLE'))                define('_SIDEMENU_TITLE', 'Ligazóns do menú lateral');
if(!defined('_SIDEMENU_TEXT'))                 define('_SIDEMENU_TEXT', 'Aquí poder crear o teu menú principal. O ID indica a orde do teu menú, SUB ID é o orde do teu submenú, CID é o ID do contido ou extensión a enlazar. Podes editar cada entrada premendo nelas.');


// COMPONENTS SYSTEM
if(!defined('_CS_TITLE'))                      define('_CS_TITLE', 'Obxectos do Sistema de Compoñentes');
if(!defined('_CS_TEXT'))                       define('_CS_TEXT', 'Esta é a lista de todos os compoñentes instalados. Podes cambiar os seus axustes.');


// TOPMENU
if(!defined('_TOPMENU_TITLE'))                 define('_TOPMENU_TITLE', 'Ligazóns do menú superior');
if(!defined('_TOPMENU_TEXT'))                  define('_TOPMENU_TEXT', 'Aquí podes crear o teu menú superior. O ID indica o orde do teu menú, CID é o ID do contido ou extensión a enlazar.');


// MENUTITLE
if(!defined('_MENUTITLE_TITLE'))               define('_MENUTITLE_TITLE', 'Título do menú');
if(!defined('_MENUTITLE_TEXT'))                define('_MENUTITLE_TEXT', 'O Número-Posicións marca o lugar no menú.');


// CONTENT
if(!defined('_CONTENT_TITLE'))                 define('_CONTENT_TITLE', 'Amosar as páxinas con contido estático');
if(!defined('_CONTENT_TEXT'))                  define('_CONTENT_TEXT', 'O ID-Número é o número que necesitar para ligar todas as páxinas.');
if(!defined('_CONTENT_TEXT_PAGE'))             define('_CONTENT_TEXT_PAGE', 'Introduce todos os datos aquí. Título da páxina, pequeno subtítulo, texto da páxina, e se o desexas un pé de páxina.');
if(!defined('_CONTENT_TEMPLATE'))              define('_CONTENT_TEMPLATE', 'Plantilla de contido');
if(!defined('_CONTENT_SECOND'))                define('_CONTENT_SECOND', 'Segundo texto');
if(!defined('_CONTENT_OLDIMAGE'))              define('_CONTENT_OLDIMAGE', 'Imaxe vella');
if(!defined('_CONTENT_IMAGEUNDER'))            define('_CONTENT_IMAGEUNDER', 'Imaxe baixo o texto');
if(!defined('_CONTENT_IMAGERIGHT'))            define('_CONTENT_IMAGERIGHT', 'Imaxe a dereita do texto');
if(!defined('_CONTENT_FOOT'))                  define('_CONTENT_FOOT', 'Nota ao pé');
if(!defined('_CONTENT_NEXT_PAGE'))             define('_CONTENT_NEXT_PAGE', 'Páxina seguinte');
if(!defined('_CONTENT_LAST_PAGE'))             define('_CONTENT_LAST_PAGE', 'Última páxina');
if(!defined('_CONTENT_BACK_PAGE'))             define('_CONTENT_BACK_PAGE', 'Unha páxina atrás');
if(!defined('_CONTENT_FIRST_PAGE'))            define('_CONTENT_FIRST_PAGE', 'Primeira páxina');
if(!defined('_CONTENT_LAST_UPDATE'))           define('_CONTENT_LAST_UPDATE', 'Última actualización');
if(!defined('_CONTENT_NEW_LANG_DOCUMENT'))     define('_CONTENT_NEW_LANG_DOCUMENT', 'Novo documento noutro idioma');
if(!defined('_CONTENT_ORG_DOCUMENT'))          define('_CONTENT_ORG_DOCUMENT', 'Documento orixinal');


// IMPRESSUM
if(!defined('_IMPRESSUM_CONFIG'))              define('_IMPRESSUM_CONFIG', 'Configuración da impresión');
if(!defined('_IMPRESSUM_ID'))                  define('_IMPRESSUM_ID', 'ID');
if(!defined('_IMPRESSUM_TITLE'))               define('_IMPRESSUM_TITLE', 'Título da impresión');
if(!defined('_IMPRESSUM_SUBTITLE'))            define('_IMPRESSUM_SUBTITLE', 'Subtítulo da impresión');
if(!defined('_IMPRESSUM_CONTACT'))             define('_IMPRESSUM_CONTACT', 'Persoa de contacto');
if(!defined('_IMPRESSUM_NO_CONTACT'))          define('_IMPRESSUM_NO_CONTACT', 'Sen persoa de contacto');
if(!defined('_IMPRESSUM_SELECT'))              define('_IMPRESSUM_SELECT', 'Escolle');
if(!defined('_IMPRESSUM_TAX'))                 define('_IMPRESSUM_TAX', 'Número de tasa');
if(!defined('_IMPRESSUM_UST'))                 define('_IMPRESSUM_UST', 'Ust. Id.');
if(!defined('_IMPRESSUM_LEGAL'))               define('_IMPRESSUM_LEGAL', 'Condición legais');
if(!defined('_IMPRESSUM_PHONE'))               define('_IMPRESSUM_PHONE', 'Teléfono');
if(!defined('_IMPRESSUM_FAX'))                 define('_IMPRESSUM_FAX', 'Fax');
if(!defined('_IMPRESSUM_CONTACTPERSON'))       define('_IMPRESSUM_CONTACTPERSON', 'Persoa de contacto');
if(!defined('_IMPRESSUM_OFFICE'))              define('_IMPRESSUM_OFFICE', 'Oficina');
if(!defined('_IMPRESSUM_EMAIL'))               define('_IMPRESSUM_EMAIL', 'Correo-e');
if(!defined('_IMPRESSUM_COPY'))                define('_IMPRESSUM_COPY', 'Todos os dereitos reservados.');
if(!defined('_IMPRESSUM_SITECOPY'))            define('_IMPRESSUM_SITECOPY', 'Os contidos do sitio están baixo o copyright de ');


// SIDEBAR
if(!defined('_SIDE_TEXT'))                     define('_SIDE_TEXT', 'O ID-Número é o número que precisas para ligar a todas as páxinas.');
if(!defined('_SIDE_CONTACTS'))                 define('_SIDE_CONTACTS', 'Contactos');


// HELP
if(!defined('_HELP_SUPPORTED_CHARSETS'))       define('_HELP_SUPPORTED_CHARSETS', 'Xogos de caracteres soportados');


// GROUPS
if(!defined('_GROUP_DEV'))                     define('_GROUP_DEV', 'Desenvolvedor e Mantenemento');
if(!defined('_GROUP_ADMIN'))                   define('_GROUP_ADMIN', 'Administrador');
if(!defined('_GROUP_WRITER'))                  define('_GROUP_WRITER', 'Editor extendido');
if(!defined('_GROUP_EDITOR'))                  define('_GROUP_EDITOR', 'Editor simple');
if(!defined('_GROUP_PRESENTER'))               define('_GROUP_PRESENTER', 'Presentador do foro');
if(!defined('_GROUP_USER'))                    define('_GROUP_USER', 'Usuario do sitio');


// TCMS SCRIPT
if(!defined('_TCMSSCRIPT_BR'))                 define('_TCMSSCRIPT_BR', 'Salto de liña');
if(!defined('_TCMSSCRIPT_MORE'))               define('_TCMSSCRIPT_MORE', 'Parar novas personalizadas para o frontend');
if(!defined('_TCMSSCRIPT_IMAGES'))             define('_TCMSSCRIPT_IMAGES', 'Navegar polas imaxes');


// GLOBAL ID
if(!defined('_NEWPAGE_TITLE'))                 define('_NEWPAGE_TITLE', 'Crear unha nova páxina');
if(!defined('_NEWPAGE_TEXT'))                  define('_NEWPAGE_TEXT', 'Con este diálogo podes crear unha nova páxina. Escolle o título, o menú, se o desexas, un submenú e o nivel de acceso.');


// EXPLORER
if(!defined('_EXPLORE_UP'))                    define('_EXPLORE_UP', 'Mover a entrada para arriba');
if(!defined('_EXPLORE_DOWN'))                  define('_EXPLORE_DOWN', 'Mover a entrada para abaixo');


// NOTEBOOK
if(!defined('_NOTEBOOK_TITLE'))                define('_NOTEBOOK_TITLE', 'Libreta persoal');
if(!defined('_NOTEBOOK_TEXT'))                 define('_NOTEBOOK_TEXT', 'This is your personal notebook. You can write here all your working steps and open ideas. It is only for your eye\'s.');
if(!defined('_NOTEBOOK_DETAIL'))               define('_NOTEBOOK_DETAIL', 'A túa libreta');
if(!defined('_NOTEBOOK_MSG'))                  define('_NOTEBOOK_MSG', 'A túa libreta necesítate');


// EXTENSIONS
if(!defined('_EXT_NEWS'))                      define('_EXT_NEWS', 'Xestor de novas');
if(!defined('_EXT_NEWS_NEWSAMOUNT'))           define('_EXT_NEWS_NEWSAMOUNT', 'Cantidade de novas no xestor de novas (non no arquivo)');
if(!defined('_EXT_NEWS_ID'))                   define('_EXT_NEWS_ID', 'ID');
if(!defined('_EXT_NEWS_TITLE'))                define('_EXT_NEWS_TITLE', 'Título da páxinda de novas');
if(!defined('_EXT_NEWS_SUBTITLE'))             define('_EXT_NEWS_SUBTITLE', 'Subtítulo da páxina de novas');
if(!defined('_EXT_NEWS_IMAGE'))                define('_EXT_NEWS_IMAGE', 'Imaxe da páxina de novas');
if(!defined('_EXT_NEWS_USE_COMMENTS'))         define('_EXT_NEWS_USE_COMMENTS', 'Usar comentarios');
if(!defined('_EXT_NEWS_USE_EMOTICONS'))        define('_EXT_NEWS_USE_EMOTICONS', 'Empregar emoticonos nos comentarios');
if(!defined('_EXT_NEWS_USE_GRAVATAR'))         define('_EXT_NEWS_USE_GRAVATAR', 'Empregar avatar para os usuarios');
if(!defined('_EXT_NEWS_USE_AUTOR'))            define('_EXT_NEWS_USE_AUTOR', 'Amosar o autor das novas');
if(!defined('_EXT_NEWS_USE_AUTOR_LINK'))       define('_EXT_NEWS_USE_AUTOR_LINK', 'Amosar o autor da nova coma unha ligazón');
if(!defined('_EXT_NEWS_D_TIMESINCE'))          define('_EXT_NEWS_D_TIMESINCE', 'Dende fai');
if(!defined('_EXT_NEWS_D_DATE'))               define('_EXT_NEWS_D_DATE', 'Data normal');
if(!defined('_EXT_NEWS_D_TEXT'))               define('_EXT_NEWS_D_TEXT', 'Representación textual');
if(!defined('_EXT_NEWS_DISPLAY'))              define('_EXT_NEWS_DISPLAY', 'Representación da data');
if(!defined('_EXT_NEWS_DISPLAY_MORE'))         define('_EXT_NEWS_DISPLAY_MORE', 'Representación da ligazón ler máis');
if(!defined('_EXT_NEWS_MORE_NL_LEFT'))         define('_EXT_NEWS_MORE_NL_LEFT', 'Nova liña - aliñar a esquerda');
if(!defined('_EXT_NEWS_MORE_NL_RIGHT'))        define('_EXT_NEWS_MORE_NL_RIGHT', 'Nova liña - aliñar a dereita');
if(!defined('_EXT_NEWS_MORE_NL_DIRECT'))       define('_EXT_NEWS_MORE_NL_DIRECT', 'Mesma liña - despois do texto');
if(!defined('_EXT_NEWS_NEWS_SPACING'))         define('_EXT_NEWS_NEWS_SPACING', 'Espaciado de novas');
if(!defined('_EXT_NEWS_SELECT'))               define('_EXT_NEWS_SELECT', 'Selecciona por favor');
if(!defined('_EXT_NEWS_DESELECT'))             define('_EXT_NEWS_DESELECT', 'Sen imaxe');
if(!defined('_EXT_NEWS_USE_FEEDS'))            define('_EXT_NEWS_USE_FEEDS', 'Empregar sindicación (Feeds)');
if(!defined('_EXT_NEWS_USE_RSS091'))           define('_EXT_NEWS_USE_RSS091', 'Usar RSS 0.91');
if(!defined('_EXT_NEWS_USE_RSS10'))            define('_EXT_NEWS_USE_RSS10', 'Usar RSS 1.0');
if(!defined('_EXT_NEWS_USE_RSS20'))            define('_EXT_NEWS_USE_RSS20', 'Usar RSS 2.0');
if(!defined('_EXT_NEWS_USE_ATOM03'))           define('_EXT_NEWS_USE_ATOM03', 'Usar ATOM 0.3');
if(!defined('_EXT_NEWS_USE_OPML'))             define('_EXT_NEWS_USE_OPML', 'Usar OPML');
if(!defined('_EXT_NEWS_SYN_AMOUNT'))           define('_EXT_NEWS_SYN_AMOUNT', 'Cantidade de novas a sindicar');
if(!defined('_EXT_NEWS_USE_SYN_TITLE'))        define('_EXT_NEWS_USE_SYN_TITLE', 'Usar título de sindicar na barra lateral');
if(!defined('_EXT_NEWS_DEFAULT_FEED'))         define('_EXT_NEWS_DEFAULT_FEED', 'Sindicación por defecto');
if(!defined('_EXT_NEWS_USE_TRACKBACK'))        define('_EXT_NEWS_USE_TRACKBACK', 'Usar Trackback');
if(!defined('_EXT_CFORM'))                     define('_EXT_CFORM', 'Formulario de contacto');
if(!defined('_EXT_CFORM_SHOW_CONTACTS_IN_SIDEBAR'))define('_EXT_CFORM_SHOW_CONTACTS_IN_SIDEBAR', 'Amosar os contacto na barra lateral');
if(!defined('_EXT_CFORM_USE_ADRESSBOOK'))      define('_EXT_CFORM_USE_ADRESSBOOK', 'Usar o libro de enderezos');
if(!defined('_EXT_CFORM_USE_CONTACTPERSON'))   define('_EXT_CFORM_USE_CONTACTPERSON', 'Amosar a persoa de contacto');
if(!defined('_EXT_CFORM_EMAIL'))               define('_EXT_CFORM_EMAIL', 'eMail');
if(!defined('_EXT_CFORM_ID'))                  define('_EXT_CFORM_ID', 'ID');
if(!defined('_EXT_CFORM_TITLE'))               define('_EXT_CFORM_TITLE', 'Título do formulario de contacto');
if(!defined('_EXT_CFORM_SUBTITLE'))            define('_EXT_CFORM_SUBTITLE', 'Subtítulo do formulario de contacto');
if(!defined('_EXT_CFORM_SHOW_CONTACTEMAIL'))   define('_EXT_CFORM_SHOW_CONTACTEMAIL', 'Amosar o enderezo de correo de contacto');
if(!defined('_EXT_BOOK'))                      define('_EXT_BOOK', 'Libro de visitas');
if(!defined('_EXT_BOOK_ID'))                   define('_EXT_BOOK_ID', 'ID');
if(!defined('_EXT_BOOK_TITLE'))                define('_EXT_BOOK_TITLE', 'Título do libro de visitas');
if(!defined('_EXT_BOOK_SUBTITLE'))             define('_EXT_BOOK_SUBTITLE', 'Subtítulo do libro de visitas');
if(!defined('_EXT_BOOK_ADMINPASS'))            define('_EXT_BOOK_ADMINPASS', 'Contrasinal de administración');
if(!defined('_EXT_BOOK_ADMINUSER'))            define('_EXT_BOOK_ADMINUSER', 'Nome de usuario de administración');
if(!defined('_EXT_BOOK_ADMINCOLOR'))           define('_EXT_BOOK_ADMINCOLOR', 'Cor do texto da administración');
if(!defined('_EXT_BOOK_ENTRYCOLOR'))           define('_EXT_BOOK_ENTRYCOLOR', 'Cor do número das entradas');
if(!defined('_EXT_DOWNLOAD'))                  define('_EXT_DOWNLOAD', 'Configuración do xestor de descargas');
if(!defined('_EXT_DOWNLOAD_ID'))               define('_EXT_DOWNLOAD_ID', 'ID');
if(!defined('_EXT_DOWNLOAD_TITLE'))            define('_EXT_DOWNLOAD_TITLE', 'Título do xestor de descargas');
if(!defined('_EXT_DOWNLOAD_SUBTITLE'))         define('_EXT_DOWNLOAD_SUBTITLE', 'Subtítulo do xestor de descargas');
if(!defined('_EXT_DOWNLOAD_TEXT'))             define('_EXT_DOWNLOAD_TEXT', 'Texto do xestor de descargas');
if(!defined('_EXT_NEWS_SYN_USE_RSS091_IMG'))   define('_EXT_NEWS_SYN_USE_RSS091_IMG', 'Empregar a imaxe por defecto para a ligazón RSS 0.91');
if(!defined('_EXT_NEWS_SYN_RSS091_TEXT'))      define('_EXT_NEWS_SYN_RSS091_TEXT', 'Texto da ligazón RSS 0.91');
if(!defined('_EXT_NEWS_SYN_USE_RSS10_IMG'))    define('_EXT_NEWS_SYN_USE_RSS10_IMG', 'Empregar a imaxe por defecto para a ligazón RSS 1.0');
if(!defined('_EXT_NEWS_SYN_RSS10_TEXT'))       define('_EXT_NEWS_SYN_RSS10_TEXT', 'Texto da ligazón RSS 1.0');
if(!defined('_EXT_NEWS_SYN_USE_RSS20_IMG'))    define('_EXT_NEWS_SYN_USE_RSS20_IMG', 'Empregar a imaxe por defecto para a ligazón RSS 2.0');
if(!defined('_EXT_NEWS_SYN_RSS20_TEXT'))       define('_EXT_NEWS_SYN_RSS20_TEXT', 'Texto da ligazón RSS 2.0');
if(!defined('_EXT_NEWS_SYN_USE_ATOM03_IMG'))   define('_EXT_NEWS_SYN_USE_ATOM03_IMG', 'Empregar a imaxe por defecto para a ligazón Atom 0.3');
if(!defined('_EXT_NEWS_SYN_ATOM03_TEXT'))      define('_EXT_NEWS_SYN_ATOM03_TEXT', 'Texto da ligazón Atom 0.3');
if(!defined('_EXT_NEWS_SYN_USE_OPML_IMG'))     define('_EXT_NEWS_SYN_USE_OPML_IMG', 'Empregar a imaxe por defecto para a ligazón Opml');
if(!defined('_EXT_NEWS_SYN_OPML_TEXT'))        define('_EXT_NEWS_SYN_OPML_TEXT', 'Texto da ligazón Opml');
if(!defined('_EXT_NEWS_SYN_USE_CFEED'))        define('_EXT_NEWS_SYN_USE_CFEED', 'Empregar RSS para os comentarios');
if(!defined('_EXT_NEWS_SYN_USE_CFEED_IMG'))    define('_EXT_NEWS_SYN_USE_CFEED_IMG', 'Empregar unha imaxe para a ligazón do RSS de comentarios');
if(!defined('_EXT_NEWS_SYN_CFEED_TEXT'))       define('_EXT_NEWS_SYN_CFEED_TEXT', 'Texto da ligazón do RSS dos comentarios');
if(!defined('_EXT_NEWS_SYN_CFEED_AMOUNT'))     define('_EXT_NEWS_SYN_CFEED_AMOUNT', 'Cantidade de comentarios no RSS');
if(!defined('_EXT_NEWS_SYN_CFEED_TYPE'))       define('_EXT_NEWS_SYN_CFEED_TYPE', 'Tipo de RSS para os comentarios');


// GALLERY
if(!defined('_GALLERY_CONFIG'))                define('_GALLERY_CONFIG', 'Configuración da galería de imaxes');
if(!defined('_GALLERY_ID'))                    define('_GALLERY_ID', 'ID');
if(!defined('_GALLERY_COMMENTS'))              define('_GALLERY_COMMENTS', 'Usar comentarios');
if(!defined('_GALLERY_FRONT_TITLE'))           define('_GALLERY_FRONT_TITLE', 'Título da galería');
if(!defined('_GALLERY_FRONT_SUBTITLE'))        define('_GALLERY_FRONT_SUBTITLE', 'Subtítulo da galería');
if(!defined('_GALLERY_CREATE'))                define('_GALLERY_CREATE', 'Crear novo álbume');
if(!defined('_GALLERY_NEW'))                   define('_GALLERY_NEW', 'Novo álbume');
if(!defined('_GALLERY_DESCRIPTION'))           define('_GALLERY_DESCRIPTION', 'Descrición');
if(!defined('_GALLERY_TITLE'))                 define('_GALLERY_TITLE', 'Galería');
if(!defined('_GALLERY_THISIS'))                define('_GALLERY_THISIS', 'Este é o');
if(!defined('_GALLERY_THISIS2'))               define('_GALLERY_THISIS2', 'álbume');
if(!defined('_GALLERY_THISIS3'))               define('_GALLERY_THISIS3', 'Carga aquí as túas imaxes, eliminalas ou editar a descrición. Pero só se pode gardar unha descrición á vez.');
if(!defined('_GALLERY_IMGTITLE'))              define('_GALLERY_IMGTITLE', 'Título');
if(!defined('_GALLERY_IMGSIZE'))               define('_GALLERY_IMGSIZE', 'Tamaño do ficheiro');
if(!defined('_GALLERY_IMGRESOLUTION'))         define('_GALLERY_IMGRESOLUTION', 'Resolución');
if(!defined('_GALLERY_AMOUNT'))                define('_GALLERY_AMOUNT', 'Cantidade');
if(!defined('_GALLERY_IMG_DETAILS'))           define('_GALLERY_IMG_DETAILS', 'Usar detalles da imaxe');
if(!defined('_GALLERY_FTP_UPLOAD'))            define('_GALLERY_FTP_UPLOAD', 'Todos os álbumes dispoñibles');
if(!defined('_GALLERY_FTP_UPLOAD_TEXT'))       define('_GALLERY_FTP_UPLOAD_TEXT', 'Se subiches as imaxes cun cliente FTP a "data/imaes/albums" podes convertir ese álbume nun galería de toendaCMS. Escolle un álbume para convertilo nunha galería de toendaCMS.');
if(!defined('_GALLERY_UPLOAD'))                define('_GALLERY_UPLOAD', 'Subir imaxes');
if(!defined('_GALLERY_TEXT'))                  define('_GALLERY_TEXT', 'Se tes un álbume comprimido (.zip), podes subilo ao directorio e despois convertilo.');
if(!defined('_GALLERY_ZTITLE'))                define('_GALLERY_ZTITLE', 'Subir e instalar o ficheiro comprimido');
if(!defined('_GALLERY_ZFILE'))                 define('_GALLERY_ZFILE', 'Ficheiro comprimido (.zip)');
if(!defined('_GALLERY_POSTED'))                define('_GALLERY_POSTED', 'Subido en');
if(!defined('_GALLERY_GRAVATAR'))              define('_GALLERY_GRAVATAR', 'You can change here some settings for the imagegallery. But if you want to enable / disable the gravatar icon or the smiley icon support, go to the <a href="admin.php?id_user='.( isset($id_user) ? $id_user : '' ).'&amp;site=mod_news&amp;todo=config">newsmanager settings</a>');
if(!defined('_GALLERY_LAST_SHOW'))             define('_GALLERY_LAST_SHOW', 'Amosar as imaxes máis recentes na barra lateral');
if(!defined('_GALLERY_LAST_SHOW_TITLE'))       define('_GALLERY_LAST_SHOW_TITLE', 'Amosar os títulos das imaxes máis recentes');
if(!defined('_GALLERY_LAST_MAX_IMG'))          define('_GALLERY_LAST_MAX_IMG', 'Cantas imaxes');
if(!defined('_GALLERY_LAST_SIZE'))             define('_GALLERY_LAST_SIZE', 'Tamaño das imaxes');
if(!defined('_GALLERY_LAST_TEXT'))             define('_GALLERY_LAST_TEXT', 'Texto para as imaxes recentes');
if(!defined('_GALLERY_LAST_ALIGN'))            define('_GALLERY_LAST_ALIGN', 'Alineamento para as imaxes recentes');
if(!defined('_GALLERY_LIST_NORMAL'))           define('_GALLERY_LIST_NORMAL', 'Lista de imaxes normal (unha baixo a outra, con información)');
if(!defined('_GALLERY_LIST_3_THUMB'))          define('_GALLERY_LIST_3_THUMB', 'Imaxes en miniatura unha ao lado da outra');
if(!defined('_GALLERY_MIMETYPE'))              define('_GALLERY_MIMETYPE', 'Mimetype');


// PERSON
if(!defined('_PERSON_NAME'))                   define('_PERSON_NAME', 'Nome');
if(!defined('_PERSON_USERNAME'))               define('_PERSON_USERNAME', 'Nome de usuario');
if(!defined('_PERSON_POSITION'))               define('_PERSON_POSITION', 'Posición');
if(!defined('_PERSON_OCCUPATION'))             define('_PERSON_OCCUPATION', 'Ocupación');
if(!defined('_PERSON_GROUP'))                  define('_PERSON_GROUP', 'Grupo de usuario');
if(!defined('_PERSON_JOINDATE'))               define('_PERSON_JOINDATE', 'Adherido');
if(!defined('_PERSON_RIGHTS'))                 define('_PERSON_RIGHTS', 'Dereitos de usuario');
if(!defined('_PERSON_EMAIL'))                  define('_PERSON_EMAIL', 'Enderezo de correo');
if(!defined('_PERSON_PASSWORD'))               define('_PERSON_PASSWORD', 'Contrasinal');
if(!defined('_PERSON_AS_MD5'))                 define('_PERSON_AS_MD5', 'Cadea MD5');
if(!defined('_PERSON_VPASSWORD'))              define('_PERSON_VPASSWORD', 'Verificar Contrasinal');
if(!defined('_PERSON_STREET'))                 define('_PERSON_STREET', 'Rúa');
if(!defined('_PERSON_STATE'))                  define('_PERSON_STATE', 'Provincia');
if(!defined('_PERSON_TOWN'))                   define('_PERSON_TOWN', 'Cidade');
if(!defined('_PERSON_COUNTRY'))                define('_PERSON_COUNTRY', 'País');
if(!defined('_PERSON_POSTAL'))                 define('_PERSON_POSTAL', 'Código postal');
if(!defined('_PERSON_PHONE'))                  define('_PERSON_PHONE', 'Teléfono');
if(!defined('_PERSON_FAX'))                    define('_PERSON_FAX', 'Fax');
if(!defined('_PERSON_DETAILS'))                define('_PERSON_DETAILS', 'Detalles');
if(!defined('_PERSON_WWW'))                    define('_PERSON_WWW', 'Páxina de inicio');
if(!defined('_PERSON_ICQ'))                    define('_PERSON_ICQ', 'Número ICQ');
if(!defined('_PERSON_AIM'))                    define('_PERSON_AIM', 'Nome AIM');
if(!defined('_PERSON_YIM'))                    define('_PERSON_YIM', 'YIM Messenger');
if(!defined('_PERSON_MSN'))                    define('_PERSON_MSN', 'MSN Messenger');
if(!defined('_PERSON_SKYPE'))                  define('_PERSON_SKYPE', 'Skype');
if(!defined('_PERSON_BIRTHDAY'))               define('_PERSON_BIRTHDAY', 'Cumpreanos');
if(!defined('_PERSON_SEX'))                    define('_PERSON_SEX', 'Xénero');
if(!defined('_PERSON_SEX_MAN'))                define('_PERSON_SEX_MAN', 'Home');
if(!defined('_PERSON_SEX_WOMAN'))              define('_PERSON_SEX_WOMAN', 'Muller');
if(!defined('_PERSON_SEX_KA'))                 define('_PERSON_SEX_KA', 'Sen información');
if(!defined('_PERSON_TCMS_ENABLED'))           define('_PERSON_TCMS_ENABLED', 'toendaScript habilitado');
if(!defined('_PERSON_SIGNATURE'))              define('_PERSON_SIGNATURE', 'Sinatura');
if(!defined('_PERSON_HOBBY'))                  define('_PERSON_HOBBY', 'Aficións');
if(!defined('_PERSON_LOCATION'))               define('_PERSON_LOCATION', 'Residencia');
if(!defined('_PERSON_LASTLOGIN'))              define('_PERSON_LASTLOGIN', 'Última sesión');


// SIDE EXTENSIONS
if(!defined('_SIDEEXT_SIDEMENU'))              define('_SIDEEXT_SIDEMENU', 'Menú lateral');
if(!defined('_SIDEEXT_SIDEMENU_TITLE'))        define('_SIDEEXT_SIDEMENU_TITLE', 'Título do menú lateral');
if(!defined('_SIDEEXT_SIDEMENU_SHOW'))         define('_SIDEEXT_SIDEMENU_SHOW', 'Amosar o título do menú lateral');
if(!defined('_SIDEEXT_SIDEBAR'))               define('_SIDEEXT_SIDEBAR', 'Barra lateral');
if(!defined('_SIDEEXT_SIDEBAR_SHOW_TITLE'))    define('_SIDEEXT_SIDEBAR_SHOW_TITLE', 'Amosar o título da barra lateral');
if(!defined('_SIDEEXT_SIDEBAR_TITLE'))         define('_SIDEEXT_SIDEBAR_TITLE', 'Título da barra lateral');
if(!defined('_SIDEEXT_SIDEBAR_SHOW'))          define('_SIDEEXT_SIDEBAR_SHOW', 'Amosar barra lateral');
if(!defined('_SIDEEXT_TC'))                    define('_SIDEEXT_TC', 'Selector de plantillas');
if(!defined('_SIDEEXT_TC_SHOW_TITLE'))         define('_SIDEEXT_TC_SHOW_TITLE', 'Amosar o título do selector de plantillas');
if(!defined('_SIDEEXT_TC_TITLE'))              define('_SIDEEXT_TC_TITLE', 'Título do selector de plantillas');
if(!defined('_SIDEEXT_TC_SHOW'))               define('_SIDEEXT_TC_SHOW', 'Amosar o selector de plantillas');
if(!defined('_SIDEEXT_SEARCH'))                define('_SIDEEXT_SEARCH', 'Buscador do sitio');
if(!defined('_SIDEEXT_SEARCH_SHOW_TITLE'))     define('_SIDEEXT_SEARCH_SHOW_TITLE', 'Amosar o título do buscador ');
if(!defined('_SIDEEXT_SEARCH_TITLE'))          define('_SIDEEXT_SEARCH_TITLE', 'Título da busca');
if(!defined('_SIDEEXT_SEARCH_RESULT_TITLE'))   define('_SIDEEXT_SEARCH_RESULT_TITLE', 'Título dos resultados da procura');
if(!defined('_SIDEEXT_SEARCH_ALIGNMENT'))      define('_SIDEEXT_SEARCH_ALIGNMENT', 'Alineamento da caixa de procura');
if(!defined('_SIDEEXT_SEARCH_WITH_BR'))        define('_SIDEEXT_SEARCH_WITH_BR', 'Debaixo do botón de busca');
if(!defined('_SIDEEXT_SEARCH_WITH_BUTTON'))    define('_SIDEEXT_SEARCH_WITH_BUTTON', 'Amosar o botón de busca');
if(!defined('_SIDEEXT_SEARCH_WORD'))           define('_SIDEEXT_SEARCH_WORD', 'Texto no campo de busca');
if(!defined('_SIDEEXT_SEARCH_SHOW'))           define('_SIDEEXT_SEARCH_SHOW', 'Amosar busca');
if(!defined('_SIDEEXT_LOGIN'))                 define('_SIDEEXT_LOGIN', 'Acceso');
if(!defined('_SIDEEXT_LOGIN_TITLE'))           define('_SIDEEXT_LOGIN_TITLE', 'Título acceso');
if(!defined('_SIDEEXT_USERM_TITLE'))           define('_SIDEEXT_USERM_TITLE', 'Título do menú de usuario');
if(!defined('_SIDEEXT_LOGIN_SHOW'))            define('_SIDEEXT_LOGIN_SHOW', 'Amosar acceso');
if(!defined('_SIDEEXT_LOGIN_USER'))            define('_SIDEEXT_LOGIN_USER', 'Campo de acceso do nome de usuario');
if(!defined('_SIDEEXT_LOGIN_PASS'))            define('_SIDEEXT_LOGIN_PASS', 'Campo de acceso do contrasinal');
if(!defined('_SIDEEXT_LOGIN_ACCOUNT'))         define('_SIDEEXT_LOGIN_ACCOUNT', 'Texto para SEN CONTA');
if(!defined('_SIDEEXT_LOGIN_REG'))             define('_SIDEEXT_LOGIN_REG', 'Ligazón de rexistro');
if(!defined('_SIDEEXT_LOGIN_MENU'))            define('_SIDEEXT_LOGIN_MENU', 'Empregar menú de usuario');
if(!defined('_SIDEEXT_LOGIN_ALLOW'))           define('_SIDEEXT_LOGIN_ALLOW', 'Permitir rexistro');
if(!defined('_SIDEEXT_LOGIN_SHOW_TITLE'))      define('_SIDEEXT_LOGIN_SHOW_TITLE', 'Amosar o título do acceso');
if(!defined('_SIDEEXT_LOGIN_SHOW_MEMBERLIST')) define('_SIDEEXT_LOGIN_SHOW_MEMBERLIST', 'Amosar a lista de membros');
if(!defined('_SIDEEXT_NEWS'))                  define('_SIDEEXT_NEWS', 'Novas');
if(!defined('_SIDEEXT_NEWS_CATEGORIES_SHOW'))  define('_SIDEEXT_NEWS_CATEGORIES_SHOW', 'Amosar categorías de novas');
if(!defined('_SIDEEXT_NEWS_ARCHIVES_SHOW'))    define('_SIDEEXT_NEWS_ARCHIVES_SHOW', 'Amosar os arquivos de novas');
if(!defined('_SIDEEXT_NEWS_CATEGORIES_AMOUNT_SHOW'))define('_SIDEEXT_NEWS_CATEGORIES_AMOUNT_SHOW', 'Amosar a cantidade de novas nas categorías');
if(!defined('_SIDEEXT_MODUL'))                 define('_SIDEEXT_MODUL', 'Módulos');
if(!defined('_SIDEEXT_LANGUAGE_SELECTOR'))     define('_SIDEEXT_LANGUAGE_SELECTOR', 'Selector de idioma');


// NEWSLETTER
if(!defined('_NL_CONFIG'))                     define('_NL_CONFIG', 'Configuración do boletín de novas');
if(!defined('_NL_TITLE'))                      define('_NL_TITLE', 'Título do boletín de novas');
if(!defined('_NL_SHOW_TITLE'))                 define('_NL_SHOW_TITLE', 'Amosar o título  do boletín de novas');
if(!defined('_NL_TEXT'))                       define('_NL_TEXT', 'Texto do boletín de novas');
if(!defined('_NL_SUBMIT'))                     define('_NL_SUBMIT', 'Botón de envío do boletín de novas');
if(!defined('_NL_SHOW'))                       define('_NL_SHOW', 'Empregar o boletín de novas');
if(!defined('_NL_SEND'))                       define('_NL_SEND', 'Envías o boletín de novas');
if(!defined('_NL_SUBJECT'))                    define('_NL_SUBJECT', 'Asunto');
if(!defined('_NL_MESSAGE'))                    define('_NL_MESSAGE', 'Mensaxe');
if(!defined('_NL_USER'))                       define('_NL_USER', 'Amosar todos os usuarios do boletín de novas');
if(!defined('_NL_NEWUSER'))                    define('_NL_NEWUSER', 'Crear un novo usuario do boletín de novas.');
if(!defined('_NL_EDITUSER'))                   define('_NL_EDITUSER', 'Editar usuario do boletín de novas.');
if(!defined('_NL_USERNAME'))                   define('_NL_USERNAME', 'o teu nome aquí');
if(!defined('_NL_USEREMAIL'))                  define('_NL_USEREMAIL', 'o teu enderezo de correo aquí');
if(!defined('_NL_MAILMESSAGE'))                define('_NL_MAILMESSAGE', 'Se non desexa recibir o boletín de novas nun futuro, contesta con');
if(!defined('_NL_CHECKSTRING'))                define('_NL_CHECKSTRING', 'POR FAVOR, NON ENVIAR BOLETÍN DE NOVAS');
if(!defined('_NL_CHECKFORUNSUBSCRIBE'))        define('_NL_CHECKFORUNSUBSCRIBE', 'Comprobar correos dos usuarios non inscritos');
if(!defined('_NL_CHECK'))                      define('_NL_CHECK', 'Verificar');
if(!defined('_NL_MAILSCHECKED'))               define('_NL_MAILSCHECKED', 'Correo verificado...');
if(!defined('_NL_CHECKTITLE'))                 define('_NL_CHECKTITLE', 'Verificar correos-e dos usuarios a eliminar a subscrición');
if(!defined('_NL_CHECKTEXT'))                  define('_NL_CHECKTEXT', 'Verificamos os correos-e na túa conta de correo, para os correos que teñan a cadea de non subscrición. Se algún deles teñen esta cadea de non subscrición, procederase a comprobar que o usuario existe, e nese caso, eliminarase.');
if(!defined('_NL_NEWSLETTER'))                 define('_NL_NEWSLETTER', 'Boletín de novas');


// USER
if(!defined('_USER_TITLE'))                    define('_USER_TITLE', 'Amosar usuarios');
if(!defined('_USER_TEXT'))                     define('_USER_TEXT', 'Aquí está todos os usuarios listados. Algún deles son usuarios da administración.');
if(!defined('_USER_SELF'))                     define('_USER_SELF', 'Nome de usuario propio');
if(!defined('_USER_ALL'))                      define('_USER_ALL', 'Todos os usuarios');


// CONTACTS
if(!defined('_CONTACT_TITLE'))                 define('_CONTACT_TITLE', 'Amosar contactos');
if(!defined('_CONTACT_TEXT'))                  define('_CONTACT_TEXT', 'Aquí tes unha lista de todos os teus contactos. Algúns amósanse na páxina de contactos.');
if(!defined('_CONTACT_ADRESS_BOOK'))           define('_CONTACT_ADRESS_BOOK', 'Libro de enderezos');
if(!defined('_CONTACT_ADRESS_EMAIL'))          define('_CONTACT_ADRESS_EMAIL', 'Correo-e de contacto');
if(!defined('_CONTACT_SEND_A_EMAIL'))          define('_CONTACT_SEND_A_EMAIL', 'Enviar correo');
if(!defined('_CONTACT_DETAIL'))                define('_CONTACT_DETAIL', 'Detalles do contacto');
if(!defined('_CONTACT_VCARD'))                 define('_CONTACT_VCARD', 'vCard');
if(!defined('_CONTACT_VCARD_IMPORT_TEXT'))     define('_CONTACT_VCARD_IMPORT_TEXT', 'Se tes un ficheiro .vcf, súbeo e toendaCMS importará o contacto automaticamente.');
if(!defined('_CONTACT_VCARD_VCF'))             define('_CONTACT_VCARD_VCF', 'Ficheiro vCard .vcf');
if(!defined('_CONTACT_VCARD_DOWNLOAD'))        define('_CONTACT_VCARD_DOWNLOAD', 'Descargar vCard');


// GLOBALS
if(!defined('_GLOBAL'))                        define('_GLOBAL', 'Sitio');
if(!defined('_GLOBAL_CONFIG'))                 define('_GLOBAL_CONFIG', 'Configuración do sitio');
if(!defined('_GLOBAL_TITLE'))                  define('_GLOBAL_TITLE', 'Título do sitio');
if(!defined('_GLOBAL_NAME'))                   define('_GLOBAL_NAME', 'Nome do sitio');
if(!defined('_GLOBAL_SUBTITLE'))               define('_GLOBAL_SUBTITLE', 'Subtítulo do sitio');
if(!defined('_GLOBAL_LOGO'))                   define('_GLOBAL_LOGO', 'Logo do sitio (dende o xestor multimedia)');
if(!defined('_GLOBAL_OWNER'))                  define('_GLOBAL_OWNER', 'Propietario do sitio');
if(!defined('_GLOBAL_URL'))                    define('_GLOBAL_URL', 'URL do sitio (só o dominio)');
if(!defined('_GLOBAL_TCMSLOGO'))               define('_GLOBAL_TCMSLOGO', 'Mostrar o logo toendaCMS no pé de páxina');
if(!defined('_GLOBAL_TCMSLOGO_IN_SITETITLE'))  define('_GLOBAL_TCMSLOGO_IN_SITETITLE', 'Amosar o nome toendaCMS no sitio');
if(!defined('_GLOBAL_PAGELOADINGTIME'))        define('_GLOBAL_PAGELOADINGTIME', 'Amosar o tempo de carga da páxina no pé');
if(!defined('_GLOBAL_EMAIL'))                  define('_GLOBAL_EMAIL', 'Correo-e por defecto');
if(!defined('_GLOBAL_YEAR'))                   define('_GLOBAL_YEAR', 'Ano do Copyright');
if(!defined('_GLOBAL_CHARSET'))                define('_GLOBAL_CHARSET', 'Charset');
if(!defined('_GLOBAL_LANG'))                   define('_GLOBAL_LANG', 'Linguaxe do Framework de Administración');
if(!defined('_GLOBAL_FRONT_LANG'))             define('_GLOBAL_FRONT_LANG', 'Idioma do sitio');
if(!defined('_GLOBAL_WYSIWYG'))                define('_GLOBAL_WYSIWYG', 'Empregar editor WYSIWYG');
if(!defined('_GLOBAL_SITE_NAVI'))              define('_GLOBAL_SITE_NAVI', 'Navegación');
if(!defined('_GLOBAL_SITE_NAVI_TOP'))          define('_GLOBAL_SITE_NAVI_TOP', 'Menú superior');
if(!defined('_GLOBAL_SITE_NAVI_SIDE'))         define('_GLOBAL_SITE_NAVI_SIDE', 'Menú lateral');
if(!defined('_GLOBAL_META'))                   define('_GLOBAL_META', 'Metadatos para a cabeceira HTML');
if(!defined('_GLOBAL_METATAGS'))               define('_GLOBAL_METATAGS', 'Metadatos');
if(!defined('_GLOBAL_DESCRIPTION'))            define('_GLOBAL_DESCRIPTION', 'Descrición');
if(!defined('_GLOBAL_CURRENCY'))               define('_GLOBAL_CURRENCY', 'Moeda');
if(!defined('_GLOBAL_LEGAL_LINK_IN_FOOTER'))   define('_GLOBAL_LEGAL_LINK_IN_FOOTER', 'Amosar unha ligazón dos termos legais no pé de páxina');
if(!defined('_GLOBAL_ADMIN_LINK_IN_FOOTER'))   define('_GLOBAL_ADMIN_LINK_IN_FOOTER', 'Amosar unha ligazón de Administración no pé de páxina');
if(!defined('_GLOBAL_DEFAULT_FOOTER'))         define('_GLOBAL_DEFAULT_FOOTER', 'Amosar o pé de páxina por defecto de toendaCMS');
if(!defined('_GLOBAL_ACTIVE_TOPMENU_LINKS'))   define('_GLOBAL_ACTIVE_TOPMENU_LINKS', 'Empregar clases CSS para as ligazóns do menú superior');
if(!defined('_GLOBAL_FOOTER_TEXT'))            define('_GLOBAL_FOOTER_TEXT', 'Texto do pé de páxina personalizado');
if(!defined('_GLOBAL_MAIL_SETTINGS'))          define('_GLOBAL_MAIL_SETTINGS', 'Correo-e');
if(!defined('_GLOBAL_MAIL_WITH_SMTP'))         define('_GLOBAL_MAIL_WITH_SMTP', 'Enviar correos por SMTP');
if(!defined('_GLOBAL_MAIL_AS_HTML'))           define('_GLOBAL_MAIL_AS_HTML', 'Enviar correos como HTML');
if(!defined('_GLOBAL_MAIL_SERVER'))            define('_GLOBAL_MAIL_SERVER', 'Servidor POP3');
if(!defined('_GLOBAL_MAIL_SERVER_SMTP'))       define('_GLOBAL_MAIL_SERVER_SMTP', 'Servidor SMTP');
if(!defined('_GLOBAL_MAIL_PORT'))              define('_GLOBAL_MAIL_PORT', 'Porto do servidor de correo');
if(!defined('_GLOBAL_MAIL_POP3'))              define('_GLOBAL_MAIL_POP3', 'POP3');
if(!defined('_GLOBAL_MAIL_USER'))              define('_GLOBAL_MAIL_USER', 'Nome de usuario do correo');
if(!defined('_GLOBAL_MAIL_PASSWORD'))          define('_GLOBAL_MAIL_PASSWORD', 'Contrasinal do correo-e');
if(!defined('_GLOBAL_USE_STATISTICS'))         define('_GLOBAL_USE_STATISTICS', 'Empregar estatísticas');
if(!defined('_GLOBAL_USE_NEW_ADMINMENU'))      define('_GLOBAL_USE_NEW_ADMINMENU', 'Usar o novo menú de administración');
if(!defined('_GLOBAL_SEO'))                    define('_GLOBAL_SEO', 'URL SEO');
if(!defined('_GLOBAL_SEO_ENABLED'))            define('_GLOBAL_SEO_ENABLED', 'Habilitar SEO');
if(!defined('_GLOBAL_SEO_FOLDER'))             define('_GLOBAL_SEO_FOLDER', 'Directorio de toendaCMS no servidor');
if(!defined('_GLOBAL_SEO_FORMAT'))             define('_GLOBAL_SEO_FORMAT', 'Formato SEO');
if(!defined('_GLOBAL_SEO_NEWS_TITLE'))         define('_GLOBAL_SEO_NEWS_TITLE', 'Converter os títulos a novas-url');
if(!defined('_GLOBAL_SEO_CONTENT_TITLE'))      define('_GLOBAL_SEO_CONTENT_TITLE', 'Converter os títulos a contido-url');
if(!defined('_GLOBAL_SITE_OFFLINE'))           define('_GLOBAL_SITE_OFFLINE', 'Sitio fora de liña');
if(!defined('_GLOBAL_SITE_OFFLINE_TEXT'))      define('_GLOBAL_SITE_OFFLINE_TEXT', 'Texto para o sitio fora de liña');
if(!defined('_GLOBAL_PASTE_FOOTER_TEXT'))      define('_GLOBAL_PASTE_FOOTER_TEXT', 'Pegar texto de mostra');
if(!defined('_GLOBAL_SHOW_TOP_PAGES'))         define('_GLOBAL_SHOW_TOP_PAGES', 'Amosar páxinas na parte superio do documento');
if(!defined('_GLOBAL_CIPHER_EMAIL'))           define('_GLOBAL_CIPHER_EMAIL', 'Sempre cifrar os enderezos de correo');
if(!defined('_GLOBAL_JS_BROWSER_DETECTION'))   define('_GLOBAL_JS_BROWSER_DETECTION', 'Detectar o navegador do usuario con Javascript');
if(!defined('_GLOBAL_USE_CS'))                 define('_GLOBAL_USE_CS', 'Usar o sistema de compoñentes de toendaCMS');
if(!defined('_GLOBAL_SECURITY'))               define('_GLOBAL_SECURITY', 'Seguridade');
if(!defined('_GLOBAL_FOOTER'))                 define('_GLOBAL_FOOTER', 'Pé de páxina');
if(!defined('_GLOBAL_SHOW_BOOKMARK_LINKS'))    define('_GLOBAL_SHOW_BOOKMARK_LINKS', 'Amosar os Marcadores');
if(!defined('_GLOBAL_CAPTCHA'))                define('_GLOBAL_CAPTCHA', 'Empregar captcha para os comentarios');
if(!defined('_GLOBAL_CAPTCHA_CLEAN'))          define('_GLOBAL_CAPTCHA_CLEAN', 'Tamaño da caché captcha a limpar');
if(!defined('_GLOBAL_SHOW_DOC_AUTOR'))         define('_GLOBAL_SHOW_DOC_AUTOR', 'Amosar o autor do documento');
if(!defined('_GLOBAL_PATHWAY_CHAR'))           define('_GLOBAL_PATHWAY_CHAR', 'Carácter separado para a ruta (pathway)');
if(!defined('_GLOBAL_ANTI_FRAME'))             define('_GLOBAL_ANTI_FRAME', 'Frame-Killer (toendaCMS no se poderá cargar dentro dun marco HTML)');
if(!defined('_GLOBAL_REVISIT_AFTER'))          define('_GLOBAL_REVISIT_AFTER', 'Días para a reindexación por un motor de busca');
if(!defined('_GLOBAL_ROBOTSFILE'))             define('_GLOBAL_ROBOTSFILE', 'URL ao ficheiros "robots.txt"');
if(!defined('_GLOBAL_PDFLINK_IN_FOOTER'))      define('_GLOBAL_PDFLINK_IN_FOOTER', 'Amosar a ligazón PDF no pé de páxina');
if(!defined('_GLOBAL_CACHE_CONTROL'))          define('_GLOBAL_CACHE_CONTROL', 'Opción da etiqueta meta caché');
if(!defined('_GLOBAL_PRAGMA'))                 define('_GLOBAL_PRAGMA', 'Opción da etiqueta meta pragma');
if(!defined('_GLOBAL_EXPIRES'))                define('_GLOBAL_EXPIRES', 'O sitio pode caducar (expire)');
if(!defined('_GLOBAL_ROBOTSSETTINGS'))         define('_GLOBAL_ROBOTSSETTINGS', 'Opcións para os robots do sitio (Webcrawler)');
if(!defined('_GLOBAL_LAST_CHANGES'))           define('_GLOBAL_LAST_CHANGES', 'Últimos cambios na web');
if(!defined('_GLOBAL_USE_CONTENT_LANG'))       define('_GLOBAL_USE_CONTENT_LANG', 'Usar estes idiomas no contido');
if(!defined('_GLOBAL_VALIDLINKS'))             define('_GLOBAL_VALIDLINKS', 'Amosar ligazóns de Web estándar');
if(!defined('_GLOBAL_MM_VIEW_LIST'))           define('_GLOBAL_MM_VIEW_LIST', 'Vista en listado');
if(!defined('_GLOBAL_MM_VIEW_ICON'))           define('_GLOBAL_MM_VIEW_ICON', 'Vista en iconos');
if(!defined('_GLOBAL_MM_VIEW'))                define('_GLOBAL_MM_VIEW', 'Vista de Ítems Multimedia');


// POLL
if(!defined('_POLL_MAINTITLE'))                define('_POLL_MAINTITLE', 'Módulo Enquisa');
if(!defined('_POLL_ALL_TITLE'))                define('_POLL_ALL_TITLE', 'Todas as enquisas');
if(!defined('_POLL_TITLE'))                    define('_POLL_TITLE', 'Título do módulo enquisa');
if(!defined('_POLL_SHOW_TITLE'))               define('_POLL_SHOW_TITLE', 'Amosar título da enquisa');
if(!defined('_POLL_ALLPOLL_TITLES'))           define('_POLL_ALLPOLL_TITLES', 'Todos os títulos das enquisas');
if(!defined('_POLL_SHOW'))                     define('_POLL_SHOW', 'Amosar enquisa na barra lateral');
if(!defined('_POLL_TITLE_SIDEMENU'))           define('_POLL_TITLE_SIDEMENU', 'Menú lateral');
if(!defined('_POLL_MENU_TITLE'))               define('_POLL_MENU_TITLE', 'Ligar título da enquisa');
if(!defined('_POLL_MENU_SHOW'))                define('_POLL_MENU_SHOW', 'Amosar ligazón á enquisa');
if(!defined('_POLL_MENU_POS'))                 define('_POLL_MENU_POS', 'En que lugar');
if(!defined('_POLL_TITLE_TOPMENU'))            define('_POLL_TITLE_TOPMENU', 'Menú superior');
if(!defined('_POLL_VOTETEXT'))                 define('_POLL_VOTETEXT', 'Grazas polo teu voto!');
if(!defined('_POLL_RESULTTEXT'))               define('_POLL_RESULTTEXT', 'Xa votaches esta enquisa');
if(!defined('_POLL_ALLPOLLS'))                 define('_POLL_ALLPOLLS', 'Todas as enquisas');
if(!defined('_POLL_RESULT'))                   define('_POLL_RESULT', 'Resultado');
if(!defined('_POLL_POLLS_INACTIVE'))           define('_POLL_POLLS_INACTIVE', 'Non hai enquisas activas.');
if(!defined('_POLL_SIDE_WIDTH'))               define('_POLL_SIDE_WIDTH', 'Ancho da enquisa na barra lateral');
if(!defined('_POLL_MAIN_WIDTH'))               define('_POLL_MAIN_WIDTH', 'Ancho da enquisa no contido');
if(!defined('_POLL_ANSWERS'))                  define('_POLL_ANSWERS', 'Respostas');


// PATHWAY
if(!defined('_PATH_HOME'))                     define('_PATH_HOME', 'Inicio');
if(!defined('_PATH_REGISTRATION'))             define('_PATH_REGISTRATION', 'Rexistro');
if(!defined('_PATH_PROFILE'))                  define('_PATH_PROFILE', 'Perfil de usuario');
if(!defined('_PATH_POLLS'))                    define('_PATH_POLLS', 'Todas as enquisas');
if(!defined('_PATH_LOSTPW'))                   define('_PATH_LOSTPW', 'Perdiches o teu contrasinal?');
if(!defined('_PATH_SEARCH'))                   define('_PATH_SEARCH', 'Procurar');
if(!defined('_PATH_LEGAL'))                    define('_PATH_LEGAL', 'Información legal');
if(!defined('_PATH_LINKS'))                    define('_PATH_LINKS', 'Ligazóns');
if(!defined('_PATH_CONTACTFORM'))              define('_PATH_CONTACTFORM', 'Formulario de contacto');
if(!defined('_PATH_SITEMAP'))                  define('_PATH_SITEMAP', 'Mapa do sitio');


// LAYOUT
if(!defined('_LAYOUT_SELECT'))                 define('_LAYOUT_SELECT', 'Seleccionar');
if(!defined('_LAYOUT_NO'))                     define('_LAYOUT_NO', 'No.');
if(!defined('_LAYOUT_PATH'))                   define('_LAYOUT_PATH', 'Ruta');
if(!defined('_LAYOUT_NAME'))                   define('_LAYOUT_NAME', 'Nome');
if(!defined('_LAYOUT_AUTOR'))                  define('_LAYOUT_AUTOR', 'Autor');
if(!defined('_LAYOUT_URL'))                    define('_LAYOUT_URL', 'URL');
if(!defined('_LAYOUT_VERSION'))                define('_LAYOUT_VERSION', 'Versión');
if(!defined('_LAYOUT_PREVIEW'))                define('_LAYOUT_PREVIEW', 'Previsualizar');
if(!defined('_LAYOUT_CURRENT'))                define('_LAYOUT_CURRENT', 'Plantilla actual');
if(!defined('_LAYOUT_COUNT'))                  define('_LAYOUT_COUNT', 'Plantillas instaladas');
if(!defined('_LAYOUT_FRONTEND'))               define('_LAYOUT_FRONTEND', 'Plantillas da páxina principal');
if(!defined('_LAYOUT_BACKEND'))                define('_LAYOUT_BACKEND', 'Plantillas de administración');


// LAYOUT UPLOAD
if(!defined('_LU_TEXT'))                       define('_LU_TEXT', 'If you have an .zip, use the Package File Upload. Otherwise, copy the complete Theme (index.php, Images and CSS-Stylesheets) to the Theme Directory. If you want, use the Upload File dialog. If  you don\'t have a Description file, click the NEW Button.');
if(!defined('_LU_DIR'))                        define('_LU_DIR', 'Nome do directorio da plantilla');
if(!defined('_LU_FILE'))                       define('_LU_FILE', 'Ficheiro');
if(!defined('_LU_ZTITLE'))                     define('_LU_ZTITLE', 'Subir e instalar o ficheiro comprimido');
if(!defined('_LU_ZFILE'))                      define('_LU_ZFILE', 'Ficheiro comprimido (.zip)');
if(!defined('_LU_UPLOAD'))                     define('_LU_UPLOAD', '');
if(!defined('_LU_UPLOAD_TEMPLATE'))            define('_LU_UPLOAD_TEMPLATE', 'Subir os ficheiros de plantilla no directorio');
if(!defined('_LU_UPLOAD_IMAGE'))               define('_LU_UPLOAD_IMAGE', 'Imaxes da plantilla');
if(!defined('_LU_DESCRIPTION'))                define('_LU_DESCRIPTION', 'Description, must be provided.<br />If you don\'t have anyone, create it by clicking on NEW.');
if(!defined('_LU_THUMB'))                      define('_LU_THUMB', 'Pantallazo con ancho');
if(!defined('_LU_DES_TEXT'))                   define('_LU_DES_TEXT', 'Cumprimenta os campos marcados.');
if(!defined('_LU_DES_DIR'))                    define('_LU_DES_DIR', 'Directorio onde gardar o ficheiro');
if(!defined('_LU_DES_NAME'))                   define('_LU_DES_NAME', 'Nome da plantilla');
if(!defined('_LU_DES_AUTOR'))                  define('_LU_DES_AUTOR', 'Nome do autor');
if(!defined('_LU_DES_URL'))                    define('_LU_DES_URL', 'URL of the Author\'s Website');
if(!defined('_LU_DES_VERSION'))                define('_LU_DES_VERSION', 'Versión da túa plantilla');
if(!defined('_LU_TEMPLATE_FILE'))              define('_LU_TEMPLATE_FILE', 'Ficheiro de plantilla');
if(!defined('_LU_TEMPLATE_EDITOR'))            define('_LU_TEMPLATE_EDITOR', 'Editor da plantilla');
if(!defined('_LU_TEMPLATE_CREATE'))            define('_LU_TEMPLATE_CREATE', 'Crear ficheiro');


// CREDITS
if(!defined('_CREDITS_SYSTEM'))                define('_CREDITS_SYSTEM', 'Sistema');
if(!defined('_CREDITS_RELEVANT'))              define('_CREDITS_RELEVANT', 'Importante para o Sistema de Gestión de Contidos');
if(!defined('_CREDITS_VERSION'))               define('_CREDITS_VERSION', 'Versión de toendaCMS');
if(!defined('_CREDITS_PLATFORM'))              define('_CREDITS_PLATFORM', 'Plataforma');
if(!defined('_CREDITS_PHP_VERSION'))           define('_CREDITS_PHP_VERSION', 'Versión de PHP');
if(!defined('_CREDITS_SERVER'))                define('_CREDITS_SERVER', 'Servidor web');
if(!defined('_CREDITS_SERVER_FACE'))           define('_CREDITS_SERVER_FACE', 'Interface PHP do servidor web');
if(!defined('_CREDITS_RELEVANT_SET'))          define('_CREDITS_RELEVANT_SET', 'Axuste PHP importantes');
if(!defined('_CREDITS_SET_GLOBALS'))           define('_CREDITS_SET_GLOBALS', 'Register Globals');
if(!defined('_CREDITS_SET'))                   define('_CREDITS_SET', 'habilitado');
if(!defined('_CREDITS_PHP_MODULES'))           define('_CREDITS_PHP_MODULES', 'Módulos PHP');


// ABOUT MOD
if(!defined('_ABOUTMOD_TITLE'))                define('_ABOUTMOD_TITLE', 'Esta é unha pequena descrición dos módulos');
if(!defined('_ABOUTMOD_MODULE'))               define('_ABOUTMOD_MODULE', 'Módulo');
if(!defined('_ABOUTMOD_DESCRIPTION'))          define('_ABOUTMOD_DESCRIPTION', 'Descrición');


// ABOUT
if(!defined('_ABOUT_TITLE'))                   define('_ABOUT_TITLE', 'toendaCMS - Your ideas ahead! - Open Source Content Management Framework');
if(!defined('_ABOUT_TEXT'))                    define('_ABOUT_TEXT', 'toendaCMS é un Framework de Xestión de Contidos libre e de código aberto desenvolvido en PHP4, PHP5, XML e para varios xestores de base de datos.');
if(!defined('_ABOUT_TEXT2'))                   define('_ABOUT_TEXT2', 'Vaite a http://www.toenda.com/ para máis información. toendaCMS non ofrece NINGUNHA GARANTÍA en si mesmo. É Software Libre, e estás invitado a redistribuilo baixo certas condicións. Borrar a aparición desta información está prohibido por lei.');
if(!defined('_ABOUT_EMAIL_INFO'))              define('_ABOUT_EMAIL_INFO', 'Información e soporte técnico');
if(!defined('_ABOUT_EMAIL_BUG'))               define('_ABOUT_EMAIL_BUG', 'Informe de erros');
if(!defined('_ABOUT_URL_DEVELOPMENT'))         define('_ABOUT_URL_DEVELOPMENT', 'Desenvolvemento de toendaCMS');
if(!defined('_ABOUT_URL'))                     define('_ABOUT_URL', 'Sitio de demostración oficial de toendaCMS');
if(!defined('_ABOUT_URL_DOWNLOAD'))            define('_ABOUT_URL_DOWNLOAD', 'Descargar e parches');
if(!defined('_ABOUT_SVN_REPO'))                define('_ABOUT_SVN_REPO', 'Repositorio SVN');
if(!defined('_ABOUT_FREE_SOFTWARE'))           define('_ABOUT_FREE_SOFTWARE', 'é Software Libre liberado baixo licenza GNU/GPL');
if(!defined('_ABOUT_CODE_IS_POESIE'))          define('_ABOUT_CODE_IS_POESIE', 'Recorda sempre: O código é poesía.');
if(!defined('_ABOUT_POWERED_BY'))              define('_ABOUT_POWERED_BY', 'Powered by');


// CONTACTFORM
if(!defined('_FORM_NAME'))                     define('_FORM_NAME', 'Nome');
if(!defined('_FORM_EMAIL'))                    define('_FORM_EMAIL', 'Correo-e');
if(!defined('_FORM_MESSAGE'))                  define('_FORM_MESSAGE', 'Mensaxe');
if(!defined('_FORM_URL'))                      define('_FORM_URL', 'Sitio web');
if(!defined('_FORM_SUBJECT'))                  define('_FORM_SUBJECT', 'Asunto');
if(!defined('_FORM_MSG'))                      define('_FORM_MSG', 'Mensaxe');
if(!defined('_FORM_COPY'))                     define('_FORM_COPY', 'Envíame unha copia');
if(!defined('_FORM_SEND'))                     define('_FORM_SEND', 'Enviar');
if(!defined('_FORM_SUBMIT'))                   define('_FORM_SUBMIT', 'Enviar');
if(!defined('_FORM_MSG_CONTENT'))              define('_FORM_MSG_CONTENT', 'A seguinte mensaxe enviada dende o formulario de contacto a');
if(!defined('_FORM_DEAR'))                     define('_FORM_DEAR', 'Estimado');
if(!defined('_FORM_THANKYOU'))                 define('_FORM_THANKYOU', 'Graciñas por visitar a nosa web!');
if(!defined('_FORM_FOLLOWMSG'))                define('_FORM_FOLLOWMSG', 'A seguinte mensaxe é enviada dende o formulario de contacto:');
if(!defined('_FORM_YOUR'))                     define('_FORM_YOUR', 'O seu');
if(!defined('_FORM_CFORM'))                    define('_FORM_CFORM', 'Formulario de contacto');
if(!defined('_FORM_SYSTEM'))                   define('_FORM_SYSTEM', 'Esta é unha mensaxe xerada polo sistema, non a respostes.');
if(!defined('_FORM_GREETS'))                   define('_FORM_GREETS', 'Atentamente');
if(!defined('_FORM_FROM'))                     define('_FORM_FROM', 'Este boletín de novas é de');
if(!defined('_FORM_GO'))                       define('_FORM_GO', 'Ir');


// GUESTBOOK
if(!defined('_BOOK_SEND'))                     define('_BOOK_SEND', 'Enviar');
if(!defined('_BOOK_ENTRYS'))                   define('_BOOK_ENTRYS', 'Entradas do Libro de visitas');
if(!defined('_BOOK_ENTRY1'))                   define('_BOOK_ENTRY1', 'entradas');
if(!defined('_BOOK_ENTRY2'))                   define('_BOOK_ENTRY2', 'entrada');
if(!defined('_BOOK_E_NO'))                     define('_BOOK_E_NO', 'No.');
if(!defined('_BOOK_E_NAME'))                   define('_BOOK_E_NAME', 'Nome');
if(!defined('_BOOK_E_DATE'))                   define('_BOOK_E_DATE', 'Data');
if(!defined('_BOOK_E_EMAIL'))                  define('_BOOK_E_EMAIL', 'Correo-e');
if(!defined('_BOOK_PAGE'))                     define('_BOOK_PAGE', 'Páxina');
if(!defined('_BOOK_ADD'))                      define('_BOOK_ADD', 'Enviar unha entrada');
if(!defined('_BOOK_FILTER_LINKS'))             define('_BOOK_FILTER_LINKS', 'Ligazóns (ligazóns web, enderezos de correo)');
if(!defined('_BOOK_FILTER_SCRIPT'))            define('_BOOK_FILTER_SCRIPT', 'Scripts (Javascript, PHP)');
if(!defined('_BOOK_FILTER_MAIL'))              define('_BOOK_FILTER_MAIL', 'Amosar enderezos de correo');
if(!defined('_BOOK_FILTER_SPAM'))              define('_BOOK_FILTER_SPAM', 'Converter @ a [arroba] nos enderezos de correo');
if(!defined('_BOOK_WIDTH_NAME'))               define('_BOOK_WIDTH_NAME', 'Ancho do campo nome (en píxels)');
if(!defined('_BOOK_WIDTH_TEXT'))               define('_BOOK_WIDTH_TEXT', 'Ancho do campo de texto (in píxels)');
if(!defined('_BOOK_COLOR_ROW_1'))              define('_BOOK_COLOR_ROW_1', 'Cor da fila un');
if(!defined('_BOOK_COLOR_ROW_2'))              define('_BOOK_COLOR_ROW_2', 'Cor da fila dúas');
if(!defined('_BOOK_TITLE'))                    define('_BOOK_TITLE', 'Entradas do libro de visitas');
if(!defined('_BOOK_TEXT'))                     define('_BOOK_TEXT', 'Here can you administer the entry\'s of your guestbook. You can edit or delete them.');


// DOWNLOADS
if(!defined('_DOWNLOADS_TITLE'))               define('_DOWNLOADS_TITLE', 'Descargas');
if(!defined('_DOWNLOADS_TEXT'))                define('_DOWNLOADS_TEXT', 'Controlando todos os ficheiro descargables.');
if(!defined('_DOWNLOADS_NEW'))                 define('_DOWNLOADS_NEW', 'Crear un ítem descargable.');
if(!defined('_DOWNLOADS_EDIT'))                define('_DOWNLOADS_EDIT', 'Edit all your download entry\'s in the category');
if(!defined('_DOWNLOADS_HELP'))                define('_DOWNLOADS_HELP', 'Se deixas o campo de subida de ficheiros en branco, unha imaxe con ese mimetype crearase para este ficheiro.');
if(!defined('_DOWNLOADS_NEW_CAT'))             define('_DOWNLOADS_NEW_CAT', 'Crear unha nova categoría de descargas, para ordear as túas descargas según desexes.');
if(!defined('_DOWNLOADS_SUBMIT_ON'))           define('_DOWNLOADS_SUBMIT_ON', 'Enviado o');
if(!defined('_DOWNLOADS_SAVE_AS_MIMITYPE'))    define('_DOWNLOADS_SAVE_AS_MIMITYPE', 'Gardar o tipo MIME como imaxe');


// PRODUCTS
if(!defined('_PRODUCTS_TITLE'))                define('_PRODUCTS_TITLE', 'Produtos');
if(!defined('_PRODUCTS_ID'))                   define('_PRODUCTS_ID', 'ID Produto');
if(!defined('_PRODUCTS_SITETITLE'))            define('_PRODUCTS_SITETITLE', 'Título do sitio do produto');
if(!defined('_PRODUCTS_SITESUBTITLE'))         define('_PRODUCTS_SITESUBTITLE', 'Subtítulo do sitio do produto');
if(!defined('_PRODUCTS_SITETEXT'))             define('_PRODUCTS_SITETEXT', 'Texto do sitio do produto');
if(!defined('_PRODUCTS_MAINCATEGORY'))         define('_PRODUCTS_MAINCATEGORY', 'Categoría principal do produto');
if(!defined('_PRODUCTS_TEXT'))                 define('_PRODUCTS_TEXT', 'Controlando todos os teus produtos.');
if(!defined('_PRODUCTS_NEW'))                  define('_PRODUCTS_NEW', 'Crear unha entrada dun novo produto para a categoría');
if(!defined('_PRODUCTS_EDIT'))                 define('_PRODUCTS_EDIT', 'Edit all your product entry\'s in the category');
if(!defined('_PRODUCTS_HELP'))                 define('_PRODUCTS_HELP', 'Se deixas en branco o campo de subida da imaxe, unha imaxe baleira crearase para este ficheiro.');
if(!defined('_PRODUCTS_NEW_CAT'))              define('_PRODUCTS_NEW_CAT', 'Crear unha entrada dun novo produto para a categoría');
if(!defined('_PRODUCTS_SUBMIT_ON'))            define('_PRODUCTS_SUBMIT_ON', 'Enviado a');
if(!defined('_PRODUCTS_INC_TAX'))              define('_PRODUCTS_INC_TAX', 'Impostos incluídos');
if(!defined('_PRODUCTS_EX_TAX'))               define('_PRODUCTS_EX_TAX', 'Impostos excluídos');
if(!defined('_PRODUCTS_CATEGORY_TITLE'))       define('_PRODUCTS_CATEGORY_TITLE', 'Título da categoría na barra lateral');
if(!defined('_PRODUCTS_USE_CATEGORY_TITLE'))   define('_PRODUCTS_USE_CATEGORY_TITLE', 'Amosar o título da categoría na barra lateral');
if(!defined('_PRODUCTS_SHOW_PRICE_ONLY_USERS'))define('_PRODUCTS_SHOW_PRICE_ONLY_USERS', 'Amosar o prezo só aos usuarios');
if(!defined('_PRODUCTS_STARTPAGETITLE'))       define('_PRODUCTS_STARTPAGETITLE', 'Título da páxina de inicio');
if(!defined('_PRODUCTS_ARTICLE'))              define('_PRODUCTS_ARTICLE', 'Artigo');
if(!defined('_PRODUCTS_CATEGORY'))             define('_PRODUCTS_CATEGORY', 'Categoría');
if(!defined('_PRODUCTS_CATEGORIES'))           define('_PRODUCTS_CATEGORIES', 'Categorías');
if(!defined('_PRODUCTS_CATALOGUE'))            define('_PRODUCTS_CATALOGUE', 'Catálogo');
if(!defined('_PRODUCTS_USESIDEBARCATEGORIES')) define('_PRODUCTS_USESIDEBARCATEGORIES', 'Empregar categorías na barra lateral');
if(!defined('_PRODUCTS_LATEST'))               define('_PRODUCTS_LATEST', 'Últimos artigos');
if(!defined('_PRODUCTS_AMOUNT_OF_LATEST'))     define('_PRODUCTS_AMOUNT_OF_LATEST', 'Cantidade de últimos artigos no frontend');
if(!defined('_PRODUCTS_ADD_TO_CART'))          define('_PRODUCTS_ADD_TO_CART', 'Engadir ao carro');


// NEWS
if(!defined('_NEWS_WRITTEN'))                  define('_NEWS_WRITTEN', 'Enviado por');
if(!defined('_NEWS_CATEGORIE_IN'))             define('_NEWS_CATEGORIE_IN', 'Categorizado');
if(!defined('_NEWS_TITLE'))                    define('_NEWS_TITLE', 'Amosar todas as novas');
if(!defined('_NEWS_TEXT'))                     define('_NEWS_TEXT', 'Aquí están listadas todas as túas novas. Podes editalas ou crear unha nova.');
if(!defined('_NEWS_EDIT_CURRENT'))             define('_NEWS_EDIT_CURRENT', 'Editar esta nova.');
if(!defined('_NEWS_NEW_CURRENT'))              define('_NEWS_NEW_CURRENT', 'Crear unha nova.');
if(!defined('_NEWS_ID'))                       define('_NEWS_ID', 'ID da nova');
if(!defined('_NEWS_DATE'))                     define('_NEWS_DATE', 'Data');
if(!defined('_NEWS_TIME'))                     define('_NEWS_TIME', 'Hora');
if(!defined('_NEWS_SAMPLE'))                   define('_NEWS_SAMPLE', 'Exemplo');
if(!defined('_NEWS_MAINTEXT'))                 define('_NEWS_MAINTEXT', 'Texto da nova');
if(!defined('_NEWS_IMAGE_HELP'))               define('_NEWS_IMAGE_HELP', 'Preme nos botóns para poñer un stop no frontpage de novas, unha liña de quebra e imaxes dentro do teu texto.');
if(!defined('_NEWS_TCMS_HELP'))                define('_NEWS_TCMS_HELP', 'Copia estas etiquetas dentro do texto que desexes.');
if(!defined('_NEWS_IMAGES'))                   define('_NEWS_IMAGES', 'Imaxe das novas');
if(!defined('_NEWS_IMAGE'))                    define('_NEWS_IMAGE', 'Imaxe');
if(!defined('_NEWS_DIR'))                      define('_NEWS_DIR', 'Directorio');
if(!defined('_NEWS_ARCHIVE'))                  define('_NEWS_ARCHIVE', 'Arquivo');
if(!defined('_NEWS_ALL'))                      define('_NEWS_ALL', 'Todo');
if(!defined('_NEWS_LAST'))                     define('_NEWS_LAST', 'último');
if(!defined('_NEWS_ORDER_BY_TIME'))            define('_NEWS_ORDER_BY_TIME', 'ordear por data');
if(!defined('_NEWS_ORDER_BY_CAT'))             define('_NEWS_ORDER_BY_CAT', 'ordear por categorías');
if(!defined('_NEWS_CATEGORIES_TITLE'))         define('_NEWS_CATEGORIES_TITLE', 'Categorías de noticias');
if(!defined('_NEWS_ARCHIVES_TITLE'))           define('_NEWS_ARCHIVES_TITLE', 'Arquivos de novas');
if(!defined('_NEWS_CATEGORIES_TEXT'))          define('_NEWS_CATEGORIES_TEXT', 'Podes crear e editar as categorías das novas aquí.');
if(!defined('_NEWS_IN'))                       define('_NEWS_IN', 'en');
if(!defined('_NEWS_CATEGORY_ARCHIV'))          define('_NEWS_CATEGORY_ARCHIV', 'Arquivo para a categoría');
if(!defined('_NEWS_ARCHIV_FOR'))               define('_NEWS_ARCHIV_FOR', 'Arquivo para');
if(!defined('_NEWS_SYNDICATION'))              define('_NEWS_SYNDICATION', 'Sindicación');
if(!defined('_NEWS_TRACKBACK'))                define('_NEWS_TRACKBACK', 'Trackback');
if(!defined('_NEWS_SHOW_ON_FRONTPAGE'))        define('_NEWS_SHOW_ON_FRONTPAGE', 'Amosar as novas na páxina de inicio');


// FRONTPAGE
if(!defined('_FRONTPAGE_CONFIG'))              define('_FRONTPAGE_CONFIG', 'Configuración da páxina de inicio');
if(!defined('_FRONTPAGE_USE'))                 define('_FRONTPAGE_USE', 'Empregar páxina de inicio');
if(!defined('_FRONTPAGE_ID'))                  define('_FRONTPAGE_ID', 'ID (se usas a páxina de inicio, ID é 0)');
if(!defined('_FRONTPAGE_TITLE'))               define('_FRONTPAGE_TITLE', 'Título da páxina de inicio');
if(!defined('_FRONTPAGE_SUBTITLE'))            define('_FRONTPAGE_SUBTITLE', 'Subtítulo da páxina de inicio');
if(!defined('_FRONTPAGE_TEXT'))                define('_FRONTPAGE_TEXT', 'Texto da páxina de inicio');
if(!defined('_FRONTPAGE_NEWS'))                define('_FRONTPAGE_NEWS', 'Novas');
if(!defined('_FRONTPAGE_NEWS_TITLE'))          define('_FRONTPAGE_NEWS_TITLE', 'Título das novas');
if(!defined('_FRONTPAGE_NEWS_MUCH'))           define('_FRONTPAGE_NEWS_MUCH', 'Cantas novas queres na páxina de inicio?');
if(!defined('_FRONTPAGE_NEWS_CHARS'))          define('_FRONTPAGE_NEWS_CHARS', 'Cantos caracteres en esta nova?');
if(!defined('_FRONT_MORE'))                    define('_FRONT_MORE', 'Ler máis');
if(!defined('_FRONT_COMMENT'))                 define('_FRONT_COMMENT', 'Comentario');
if(!defined('_FRONT_COMMENTS'))                define('_FRONT_COMMENTS', 'Comentarios');
if(!defined('_FRONT_NOCOMMENT'))               define('_FRONT_NOCOMMENT', 'Nengún comentario enviado!');
if(!defined('_FRONT_COMMENT_TITLE'))           define('_FRONT_COMMENT_TITLE', 'Enviar un comentario');
if(!defined('_FRONT_COMMENT_NAME'))            define('_FRONT_COMMENT_NAME', 'Nome');
if(!defined('_FRONT_COMMENT_EMAIL'))           define('_FRONT_COMMENT_EMAIL', 'Correo-e');
if(!defined('_FRONT_COMMENT_WEB'))             define('_FRONT_COMMENT_WEB', 'Sitio web');
if(!defined('_FRONT_COMMENT_TEXT'))            define('_FRONT_COMMENT_TEXT', 'Mensaxe');
if(!defined('_FRONT_COMMENT_POST'))            define('_FRONT_COMMENT_POST', 'Enviado por');
if(!defined('_FRONT_OWN_TRACKBACK'))           define('_FRONT_OWN_TRACKBACK', 'URL propio trackback');
if(!defined('_FRONT_TRACKBACK_URL'))           define('_FRONT_TRACKBACK_URL', 'URL destino trackback');
if(!defined('_FRONTPAGE_SIDEBAR_NEWS'))        define('_FRONTPAGE_SIDEBAR_NEWS', 'Novas da barra lateral');
if(!defined('_FRONTPAGE_SIDEBAR_NEWS_USE'))    define('_FRONTPAGE_SIDEBAR_NEWS_USE', 'Amosar novas na barra lateral');
if(!defined('_FRONTPAGE_SIDEBAR_NEWS_TITLE'))  define('_FRONTPAGE_SIDEBAR_NEWS_TITLE', 'Título das novas da barra lateral');
if(!defined('_FRONTPAGE_SIDEBAR_NEWS_MUCH'))   define('_FRONTPAGE_SIDEBAR_NEWS_MUCH', 'Cantas novas se amosarán na barra lateral da páxina principal?');
if(!defined('_FRONTPAGE_NEWS_DISPLAY'))        define('_FRONTPAGE_NEWS_DISPLAY', 'Como amosar as novas na barra lateral?');
if(!defined('_FRONTPAGE_TDT'))                 define('_FRONTPAGE_TDT', 'Título, data e hora, texto');
if(!defined('_FRONTPAGE_TD'))                  define('_FRONTPAGE_TD', 'Título, data e hora');
if(!defined('_FRONTPAGE_T'))                   define('_FRONTPAGE_T', 'Título');
if(!defined('_FRONTPAGE_DT'))                  define('_FRONTPAGE_DT', 'Data e hora, título');
if(!defined('_FRONT_CAPTCHA'))                 define('_FRONT_CAPTCHA', 'Introduce o seguinte código');


// DOCUMENTATION
if(!defined('_DOCU_TITLE'))                    define('_DOCU_TITLE', 'Documentación');
if(!defined('_DOCU_TEXT'))                     define('_DOCU_TEXT', 'QUERES ESCRIBIR ALGO?');


// SEARCH
if(!defined('_SEARCH_TITLE'))                  define('_SEARCH_TITLE', 'Procurar');
if(!defined('_SEARCH_SUBMIT'))                 define('_SEARCH_SUBMIT', 'Procurar');
if(!defined('_SEARCH_BOX'))                    define('_SEARCH_BOX', 'Busca');
if(!defined('_SEARCH_TEXT_FOUND'))             define('_SEARCH_TEXT_FOUND', 'Resultado da busca:');
if(!defined('_SEARCH_EMPTY'))                  define('_SEARCH_EMPTY', 'Insire unha palabra pola que procurar.');
if(!defined('_SEARCH_START'))                  define('_SEARCH_START', 'Introduce a túa busca.');
if(!defined('_SEARCH_NOTFOUND_1'))             define('_SEARCH_NOTFOUND_1', 'A túa busca');
if(!defined('_SEARCH_NOTFOUND_2'))             define('_SEARCH_NOTFOUND_2', 'non foi atopada.');
if(!defined('_SEARCH_WITH_GOOGLE'))            define('_SEARCH_WITH_GOOGLE', 'Buscar con');
if(!defined('_SEARCH_WITH_GOOGLE'))            define('_SEARCH_WEBSEARCH', 'Websearch');


// FILESYSTEMS
if(!defined('_FOLDER_DEFAULT'))                define('_FOLDER_DEFAULT', 'Por defecto');
if(!defined('_FOLDER_HTML'))                   define('_FOLDER_HTML', 'HTML');
if(!defined('_FOLDER_IMAGES'))                 define('_FOLDER_IMAGES', 'Imaxes');
if(!defined('_FOLDER_LOCKED'))                 define('_FOLDER_LOCKED', 'Bloqueado');
if(!defined('_FOLDER_PACK'))                   define('_FOLDER_PACK', 'Paquetes');
if(!defined('_FOLDER_PRINT'))                  define('_FOLDER_PRINT', 'Imprimir');
if(!defined('_FOLDER_SOUND'))                  define('_FOLDER_SOUND', 'Son');
if(!defined('_FOLDER_DOCU'))                   define('_FOLDER_DOCU', 'Documentos');
if(!defined('_FOLDER_VID'))                    define('_FOLDER_VID', 'Vídeo');


// FILESYSTEMS
if(!defined('_DB_CHOOSE'))                     define('_DB_CHOOSE', 'Base de datos para toendaCMS');
if(!defined('_DB_USER'))                       define('_DB_USER', 'Nome de usuario SQL Server');
if(!defined('_DB_PASSWORD'))                   define('_DB_PASSWORD', 'Contrasinal SQL Server');
if(!defined('_DB_HOST'))                       define('_DB_HOST', 'Host SQL Server');
if(!defined('_DB_DATABASE'))                   define('_DB_DATABASE', 'Base de datos SQL Server');
if(!defined('_DB_PORT'))                       define('_DB_PORT', 'Porto SQL Server (relacionado co servidor PostgreSQL)');
if(!defined('_DB_PREFIX'))                     define('_DB_PREFIX', 'Prefixo base de datos SQL Server');
if(!defined('_DB_XML'))                        define('_DB_XML', 'Base de datos XML');
if(!defined('_DB_MYSQL'))                      define('_DB_MYSQL', 'Base de datos MySQL');
if(!defined('_DB_PGSQL'))                      define('_DB_PGSQL', 'Base de datos PostgreSQL');
if(!defined('_DB_MSSQL'))                      define('_DB_MSSQL', 'Base de datos Microsoft SQL Server');
if(!defined('_DB_BACKUP'))                     define('_DB_BACKUP', 'Copia de seguridade da base de datos');
if(!defined('_DB_OPTIMIZATION'))               define('_DB_OPTIMIZATION', 'Optimizar a Base de datos');
if(!defined('_DB_RESTORE'))                    define('_DB_RESTORE', 'Restaurar a Base de datos');
if(!defined('_DB_START_BACKUP'))               define('_DB_START_BACKUP', 'Iniciar a copia de seguridade');
if(!defined('_DB_START_OPTIMIZATION'))         define('_DB_START_OPTIMIZATION', 'Iniciar agora optimización');
if(!defined('_DB_START_RESTORE'))              define('_DB_START_RESTORE', 'Iniciar agora a restauración');
if(!defined('_DB_CONFIG'))                     define('_DB_CONFIG', 'Configuración da Base de datos');
if(!defined('_DB_BACKUP_RESTORE'))             define('_DB_BACKUP_RESTORE', 'Copia de seguridade da base de datos e Restauración');
if(!defined('_DB_BACKUP_OPTIMIZATION'))        define('_DB_BACKUP_OPTIMIZATION', 'Optimización da base de datos');
if(!defined('_DB_DB'))                         define('_DB_DB', 'Base de datos');
if(!defined('_DB_BACKUP_AS_FILE'))             define('_DB_BACKUP_AS_FILE', 'Gardar a copia de seguridade coma un ficheiro?');
if(!defined('_DB_BACKUP_AS_STRUCTURE'))        define('_DB_BACKUP_AS_STRUCTURE', 'Só a estrutura da base de datos?');
if(!defined('_DB_CLEAN_UP'))                   define('_DB_CLEAN_UP', 'Limpeza da base de datos');
if(!defined('_DB_START_CLEAN_UP'))             define('_DB_START_CLEAN_UP', 'Comezar limpeza');


// LINKS
if(!defined('_LINK_MODULE'))                   define('_LINK_MODULE', 'Configuración do xestor de ligazóns');
if(!defined('_LINK_MODULE_TITLE'))             define('_LINK_MODULE_TITLE', 'Xestor de ligazóns');
if(!defined('_LINK_MODULE_DESC'))              define('_LINK_MODULE_DESC', 'Aquí podes crear ligazóns e categorías. Ten en conta que cada ligazón ten que integrarse dentro dunha categoría.');
if(!defined('_LINK_USE_SIDELINKS'))            define('_LINK_USE_SIDELINKS', 'Amosar ligazóns na barra lateral');
if(!defined('_LINK_USE_SIDELINKS_DESC'))       define('_LINK_USE_SIDELINKS_DESC', 'Amosar a descrición da ligazón na barra lateral');
if(!defined('_LINK_USE_SIDELINKS_TITLE'))      define('_LINK_USE_SIDELINKS_TITLE', 'Amosar o título para as ligazóns da barra lateral');
if(!defined('_LINK_SIDELINKS_TITLE'))          define('_LINK_SIDELINKS_TITLE', 'Título para as ligazóns da barra lateral');
if(!defined('_LINK_MAINLINKS_TITLE'))          define('_LINK_MAINLINKS_TITLE', 'Título para a páxina de contido');
if(!defined('_LINK_MAINLINKS_SUBTITLE'))       define('_LINK_MAINLINKS_SUBTITLE', 'Subtítulo para a páxina de contido');
if(!defined('_LINK_MAINLINKS_TEXT'))           define('_LINK_MAINLINKS_TEXT', 'Texto para a páxina de contido');
if(!defined('_LINK_USE_MAINLINKS_DESC'))       define('_LINK_USE_MAINLINKS_DESC', 'Amosar a descrición da ligazón na páxina de contido');
if(!defined('_LINK_WICH_MODULE'))              define('_LINK_WICH_MODULE', 'Amosar a ligazón neste módulo');

// COMMENTS
if(!defined('_COMMENTS_TITLE'))                define('_COMMENTS_TITLE', 'Administrar comentarios');
if(!defined('_COMMENTS_TEXT'))                 define('_COMMENTS_TEXT', 'Podes administrar todos os comentarios das túas novas e imaxes dende aquí. Se queres editar ou eliminalas. Tamén podes ver o enderezo de correo, IP e nomes de dominios dos comentarios da xente.');


// STATS
if(!defined('_STATS_HOST'))                    define('_STATS_HOST', 'Host');
if(!defined('_STATS_REF'))                     define('_STATS_REF', 'Referrer');
if(!defined('_STATS_PAGE'))                    define('_STATS_PAGE', 'Páxina');
if(!defined('_STATS_COUNT'))                   define('_STATS_COUNT', 'Contador');
if(!defined('_STATS_SUM_CLICKS'))              define('_STATS_SUM_CLICKS', 'Suma de todos os hits');
if(!defined('_STATS_SUM_UNIQUE'))              define('_STATS_SUM_UNIQUE', 'Suma de todos os hits únicos');
if(!defined('_STATS_SUM_IP'))                  define('_STATS_SUM_IP', 'Suma dos enderezos IP diferentes');
if(!defined('_STATS_BROWSER_OS'))              define('_STATS_BROWSER_OS', 'Browser, OS');
if(!defined('_STATS_HITS'))                    define('_STATS_HITS', 'Hits, páxina de impresións, Referrers');
if(!defined('_STATS_BROWSER'))                 define('_STATS_BROWSER', 'Browser');
if(!defined('_STATS_OS'))                      define('_STATS_OS', 'Sistema Operativo');
if(!defined('_STATS_RESET'))                   define('_STATS_RESET', 'Reiniciar estatísticas');
if(!defined('_STATS_RESET_TEXT'))              define('_STATS_RESET_TEXT', 'Aquí podes reiniciar as estatísticas. ATENCIÓN! Non poderás voltar cara atrás despois de reiniciar.');
if(!defined('_STATS_RESET_SUCCESS'))           define('_STATS_RESET_SUCCESS', 'Estatísticas reiniciadas satisfactoriamente.');
if(!defined('_STATS_RESET_FAILED'))            define('_STATS_RESET_FAILED', 'Erro ao reiniciar as estatísticas.');
if(!defined('_STATS_DATA_DIR_SIZE'))           define('_STATS_DATA_DIR_SIZE', 'Tamaño de los directorios de datos');
if(!defined('_STATS_LOG_TITLE'))               define('_STATS_LOG_TITLE', 'Visor do rexistro');
if(!defined('_STATS_LOG_TEXT'))                define('_STATS_LOG_TEXT', 'Visión xeral de todas as túas actividades');
if(!defined('_STATS_LOG_TEXT_ADMIN'))          define('_STATS_LOG_TEXT_ADMIN', 'e as actividades de todos os usuarios');


// FAQ's
if(!defined('_FAQ_TITLE'))                     define('_FAQ_TITLE', 'Show All FAQ\'s and articles');
if(!defined('_FAQ_TEXT'))                      define('_FAQ_TEXT', 'Here are all your FAQ\'s and articles listed. You can edit this items or create a new item and/or categories.');
if(!defined('_FAQ_BASE_CATEGORY'))             define('_FAQ_BASE_CATEGORY', 'Categoría Base');
if(!defined('_FAQ_CFG_TITLE'))                 define('_FAQ_CFG_TITLE', 'Configurar a base de coñecemento');


// IMPORT
if(!defined('_IMPORT_BLOGGER_FTP'))            define('_IMPORT_BLOGGER_FTP', 'Blogger FTP');
if(!defined('_IMPORT_BLOGGER_FTP_DESC'))       define('_IMPORT_BLOGGER_FTP_DESC', 'Importar novas e comentarios dende unha conta de Blogger a cal está localizada nun servidor FTP propio (hai documentación dispoñible no wiki).');
if(!defined('_IMPORT_OOO2_DOCBOOK_XML'))       define('_IMPORT_OOO2_DOCBOOK_XML', 'OpenDocument');
if(!defined('_IMPORT_OOO2_DOCBOOK_XML_DESC'))  define('_IMPORT_OOO2_DOCBOOK_XML_DESC', 'Importar documentos dende campos con formato OpenDocument.');


// COMPONENTS UPLOAD
if(!defined('_CS_UPLOAD_TEXT'))                define('_CS_UPLOAD_TEXT', 'Se tes un ficheiro .zip, usa a opción Subir Ficheiro Comprimido. Do contrario, copia o compoñente completo (a carpeta con todos os ficheiros necesarios) ao directorio components. Se queres, usa a opción Subir Ficheiro.');
if(!defined('_CS_UPLOAD_ZTITLE'))              define('_CS_UPLOAD_ZTITLE', 'Subir e instalar o ficheiro comprimido');
if(!defined('_CS_UPLOAD_ZFILE'))               define('_CS_UPLOAD_ZFILE', 'Ficheiro Comprimido (.zip)');


// LANGUAGE LIST
if(!defined('_LANG_GERMAN'))                   define('_LANG_GERMAN', 'Alemán');
if(!defined('_LANG_ENGLISH'))                  define('_LANG_ENGLISH', 'Inglés');
if(!defined('_LANG_BULGARIAN'))                define('_LANG_BULGARIAN', 'Búlgaro');
if(!defined('_LANG_DUTCH'))                    define('_LANG_DUTCH', 'Holandés');
if(!defined('_LANG_FINNISH'))                  define('_LANG_FINNISH', 'Finés');
if(!defined('_LANG_ITALY'))                    define('_LANG_ITALY', 'Italiano');
if(!defined('_LANG_KOREAN'))                   define('_LANG_KOREAN', 'Coreano');
if(!defined('_LANG_NORWEGIAN'))                define('_LANG_NORWEGIAN', 'Noruego');
if(!defined('_LANG_PORTUGUES'))                define('_LANG_PORTUGUES', 'Portugués');
if(!defined('_LANG_ROMANIAN'))                 define('_LANG_ROMANIAN', 'Rumano');
if(!defined('_LANG_SLOVAK'))                   define('_LANG_SLOVAK', 'Eslovaco');
if(!defined('_LANG_SPANISH'))                  define('_LANG_SPANISH', 'Castelán');
if(!defined('_LANG_SWEDISH'))                  define('_LANG_SWEDISH', 'Sueco');


// FOOTER
if(!defined('_FOOTER_VALID_TITLE'))            define('_FOOTER_VALID_TITLE', 'Este sitio cumple os seguintes estándares');
if(!defined('_FOOTER_VALID_US_805'))           define('_FOOTER_VALID_US_805', 'Este sitio toendaCMS cumpre coas pautas de accesibilidade Section 508.');
if(!defined('_FOOTER_VALID_W3C_WAI'))          define('_FOOTER_VALID_W3C_WAI', 'Este sitio toendaCMS cumpre coas pautas de accesibilidade do W3C-WAI.');
if(!defined('_FOOTER_VALID_XHTML'))            define('_FOOTER_VALID_XHTML', 'Este sitio toendaCMS é XHTML válido.');
if(!defined('_FOOTER_VALID_CSS'))              define('_FOOTER_VALID_CSS', 'Este sitio toendaCMS foi creado con CSS válido.');
if(!defined('_FOOTER_VALID_ANY_BROWSER'))      define('_FOOTER_VALID_ANY_BROWSER', 'Este sitio toendaCMS vese correctamente con calquera navegador web.');


// SITEMAP
if(!defined('_SITEMAP_TITLE'))                 define('_SITEMAP_TITLE', 'Sitemap');
if(!defined('_SITEMAP_SUBTITLE'))              define('_SITEMAP_SUBTITLE', 'Conseguir unha visión xeral desta páxina web');
if(!defined('_SITEMAP_TEXT'))                  define('_SITEMAP_TEXT', '');
if(!defined('_SITEMAP_SIDEMENU'))              define('_SITEMAP_SIDEMENU', 'Accesible dende o menú lateral:');
if(!defined('_SITEMAP_TOPMENU'))               define('_SITEMAP_TOPMENU', 'Accesible dende o menú superior:');


// COUNTRY LIST
if(!defined('_COUNTRY_AFGHANISTAN'))           define('_COUNTRY_AFGHANISTAN', 'Afghanistan');
if(!defined('_COUNTRY_ALBANIA'))               define('_COUNTRY_ALBANIA', 'Albania');
if(!defined('_COUNTRY_ALGERIA'))               define('_COUNTRY_ALGERIA', 'Algeria');
if(!defined('_COUNTRY_AMERICANSAMOA'))         define('_COUNTRY_AMERICANSAMOA', 'Illas Samoa Americanas');
if(!defined('_COUNTRY_ANDORRA'))               define('_COUNTRY_ANDORRA', 'Andorra');
if(!defined('_COUNTRY_ANGOLA'))                define('_COUNTRY_ANGOLA', 'Angola');
if(!defined('_COUNTRY_ANQUILLA'))              define('_COUNTRY_ANQUILLA', 'Anguilla');
if(!defined('_COUNTRY_ANTARCTICA'))            define('_COUNTRY_ANTARCTICA', 'Antártida');
if(!defined('_COUNTRY_ANTIQUAANDBARBUDA'))     define('_COUNTRY_ANTIQUAANDBARBUDA', 'Antigua e Barbuda');
if(!defined('_COUNTRY_ARGENTINA'))             define('_COUNTRY_ARGENTINA', 'Argentina');
if(!defined('_COUNTRY_ARMENIA'))               define('_COUNTRY_ARMENIA', 'Armenia');
if(!defined('_COUNTRY_ARUBA'))                 define('_COUNTRY_ARUBA', 'Aruba');
if(!defined('_COUNTRY_AZERBAIJAN'))            define('_COUNTRY_AZERBAIJAN', 'Azerbaijan');
if(!defined('_COUNTRY_EGYPT'))                 define('_COUNTRY_EGYPT', 'Exipto');
if(!defined('_COUNTRY_EQUATORIALGUINEA'))      define('_COUNTRY_EQUATORIALGUINEA', 'Guinea Ecuatorial');
if(!defined('_COUNTRY_ETHIOPIA'))              define('_COUNTRY_ETHIOPIA', 'Etiopia');
if(!defined('_COUNTRY_AUSTRALIA'))             define('_COUNTRY_AUSTRALIA', 'Australia');
if(!defined('_COUNTRY_BAHAMAS'))               define('_COUNTRY_BAHAMAS', 'Bahamas');
if(!defined('_COUNTRY_BAHRAIN'))               define('_COUNTRY_BAHRAIN', 'Bahrain');
if(!defined('_COUNTRY_BANGLADESH'))            define('_COUNTRY_BANGLADESH', 'Bangladesh');
if(!defined('_COUNTRY_BARBADOS'))              define('_COUNTRY_BARBADOS', 'Barbados');
if(!defined('_COUNTRY_BELGIUM'))               define('_COUNTRY_BELGIUM', 'Bélxica');
if(!defined('_COUNTRY_BELIZE'))                define('_COUNTRY_BELIZE', 'Belize');
if(!defined('_COUNTRY_BENIN'))                 define('_COUNTRY_BENIN', 'Benin');
if(!defined('_COUNTRY_BERMUDA'))               define('_COUNTRY_BERMUDA', 'Bermuda');
if(!defined('_COUNTRY_BHUTAN'))                define('_COUNTRY_BHUTAN', 'Bhutan');
if(!defined('_COUNTRY_BOLIVIA'))               define('_COUNTRY_BOLIVIA', 'Bolivia');
if(!defined('_COUNTRY_BOSNIAANDHERZEGOVINA'))  define('_COUNTRY_BOSNIAANDHERZEGOVINA', 'Bosnia e Herzegovina');
if(!defined('_COUNTRY_BOTSWANA'))              define('_COUNTRY_BOTSWANA', 'Botswana');
if(!defined('_COUNTRY_BOUVETISLAND'))          define('_COUNTRY_BOUVETISLAND', 'Illa Bouvet');
if(!defined('_COUNTRY_BRAZIL'))                define('_COUNTRY_BRAZIL', 'Brasil');
if(!defined('_COUNTRY_BRITININDIAOCEAN'))      define('_COUNTRY_BRITININDIAOCEAN', 'Territorio Británico no océano Índico');
if(!defined('_COUNTRY_VIRGINISLANDS'))         define('_COUNTRY_VIRGINISLANDS', 'Illas Virgin');
if(!defined('_COUNTRY_BULGARIA'))              define('_COUNTRY_BULGARIA', 'Bulgaria');
if(!defined('_COUNTRY_BURKINAFASO'))           define('_COUNTRY_BURKINAFASO', 'Burkina Faso');
if(!defined('_COUNTRY_BURUNDI'))               define('_COUNTRY_BURUNDI', 'Burundi');
if(!defined('_COUNTRY_BRUNEI'))                define('_COUNTRY_BRUNEI', 'Brunei');
if(!defined('_COUNTRY_CAYMANISLAND'))          define('_COUNTRY_CAYMANISLAND', 'Illas Caimán');
if(!defined('_COUNTRY_CHILE'))                 define('_COUNTRY_CHILE', 'Chile');
if(!defined('_COUNTRY_CHINA'))                 define('_COUNTRY_CHINA', 'China');
if(!defined('_COUNTRY_COOKISLANDS'))           define('_COUNTRY_COOKISLANDS', 'Illas Cook');
if(!defined('_COUNTRY_COSTARICA'))             define('_COUNTRY_COSTARICA', 'Costa Rica');
if(!defined('_COUNTRY_GERMANY'))               define('_COUNTRY_GERMANY', 'Alemaña');
if(!defined('_COUNTRY_DJIBOUTI'))              define('_COUNTRY_DJIBOUTI', 'Djibouti');
if(!defined('_COUNTRY_DOMINICA'))              define('_COUNTRY_DOMINICA', 'Dominica');
if(!defined('_COUNTRY_DOMINICANREPUPLIC'))     define('_COUNTRY_DOMINICANREPUPLIC', 'República Dominicana');
if(!defined('_COUNTRY_DENMARK'))               define('_COUNTRY_DENMARK', 'Dinamarca');
if(!defined('_COUNTRY_ELSALVADOR'))            define('_COUNTRY_ELSALVADOR', 'El Salvador');
if(!defined('_COUNTRY_IVORYCOAST'))            define('_COUNTRY_IVORYCOAST', 'Ivory Coast');
if(!defined('_COUNTRY_ECUADOR'))               define('_COUNTRY_ECUADOR', 'Ecuador');
if(!defined('_COUNTRY_ERITREA'))               define('_COUNTRY_ERITREA', 'Eritrea');
if(!defined('_COUNTRY_ESTONIA'))               define('_COUNTRY_ESTONIA', 'Estonia');
if(!defined('_COUNTRY_FALKLANDISLANDS'))       define('_COUNTRY_FALKLANDISLANDS', 'Illas Falkland (Malvinas)');
if(!defined('_COUNTRY_FIJI'))                  define('_COUNTRY_FIJI', 'Filli');
if(!defined('_COUNTRY_FINLAND'))               define('_COUNTRY_FINLAND', 'Finlandia');
if(!defined('_COUNTRY_FRANCE'))                define('_COUNTRY_FRANCE', 'Francia');
if(!defined('_COUNTRY_FRENCHGUIANA'))          define('_COUNTRY_FRENCHGUIANA', 'Guinea Francesa');
if(!defined('_COUNTRY_FRENCHPOLINESIA'))       define('_COUNTRY_FRENCHPOLINESIA', 'Polinesia Francesa');
if(!defined('_COUNTRY_FRENCHSOUNTHTERITORIES'))define('_COUNTRY_FRENCHSOUNTHTERITORIES', 'Territorios do Sur de Francia');
if(!defined('_COUNTRY_FAROEISLANDS'))          define('_COUNTRY_FAROEISLANDS', 'Illas Feroe');
if(!defined('_COUNTRY_GABUN'))                 define('_COUNTRY_GABUN', 'Gabun');
if(!defined('_COUNTRY_GAMBIA'))                define('_COUNTRY_GAMBIA', 'Gambia');
if(!defined('_COUNTRY_GEORGIA'))               define('_COUNTRY_GEORGIA', 'Georgia');
if(!defined('_COUNTRY_GHANA'))                 define('_COUNTRY_GHANA', 'Ghana');
if(!defined('_COUNTRY_GIBRALTAR'))             define('_COUNTRY_GIBRALTAR', 'Xibraltar');
if(!defined('_COUNTRY_GRENADA'))               define('_COUNTRY_GRENADA', 'Grenada');
if(!defined('_COUNTRY_GREECE'))                define('_COUNTRY_GREECE', 'Grecia');
if(!defined('_COUNTRY_BRITANY'))               define('_COUNTRY_BRITANY', 'Gran Bretaña');
if(!defined('_COUNTRY_GREENLAND'))             define('_COUNTRY_GREENLAND', 'Groenlandia');
if(!defined('_COUNTRY_GUADELOUPE'))            define('_COUNTRY_GUADELOUPE', 'Guadalupe');
if(!defined('_COUNTRY_GUAM'))                  define('_COUNTRY_GUAM', 'Guam');
if(!defined('_COUNTRY_GUATEMALA'))             define('_COUNTRY_GUATEMALA', 'Guatemala');
if(!defined('_COUNTRY_GUINEA'))                define('_COUNTRY_GUINEA', 'Guinea');
if(!defined('_COUNTRY_GUINEABISSAU'))          define('_COUNTRY_GUINEABISSAU', 'Guinea - Bissau');
if(!defined('_COUNTRY_GUYANA'))                define('_COUNTRY_GUYANA', 'Guyana');
if(!defined('_COUNTRY_HAITI'))                 define('_COUNTRY_HAITI', 'Haiti');
if(!defined('_COUNTRY_HEARDMCDONALDISLANDS'))  define('_COUNTRY_HEARDMCDONALDISLANDS', 'Illas Heard e McDonald');
if(!defined('_COUNTRY_HONDURAS'))              define('_COUNTRY_HONDURAS', 'Honduras');
if(!defined('_COUNTRY_HONGKONG'))              define('_COUNTRY_HONGKONG', 'Hong Kong');
if(!defined('_COUNTRY_INDIA'))                 define('_COUNTRY_INDIA', 'India');
if(!defined('_COUNTRY_INDONESIA'))             define('_COUNTRY_INDONESIA', 'Indonesia');
if(!defined('_COUNTRY_IRAQ'))                  define('_COUNTRY_IRAQ', 'Irak');
if(!defined('_COUNTRY_IRAN'))                  define('_COUNTRY_IRAN', 'Irán');
if(!defined('_COUNTRY_IRELAND'))               define('_COUNTRY_IRELAND', 'Irlanda');
if(!defined('_COUNTRY_ICELAND'))               define('_COUNTRY_ICELAND', 'Islandia');
if(!defined('_COUNTRY_ISRAEL'))                define('_COUNTRY_ISRAEL', 'Israel');
if(!defined('_COUNTRY_ITALY'))                 define('_COUNTRY_ITALY', 'Italia');
if(!defined('_COUNTRY_JAMAICA'))               define('_COUNTRY_JAMAICA', 'Xamaica');
if(!defined('_COUNTRY_JAPAN'))                 define('_COUNTRY_JAPAN', 'Xapón');
if(!defined('_COUNTRY_YEMEN'))                 define('_COUNTRY_YEMEN', 'Iemen');
if(!defined('_COUNTRY_JORDAN'))                define('_COUNTRY_JORDAN', 'Jordán');
if(!defined('_COUNTRY_YUGOSLAVIA'))            define('_COUNTRY_YUGOSLAVIA', 'Iugoslavia (alumni)');
if(!defined('_COUNTRY_CAMBODIA'))              define('_COUNTRY_CAMBODIA', 'Camboia');
if(!defined('_COUNTRY_CAMEROON'))              define('_COUNTRY_CAMEROON', 'Camerún');
if(!defined('_COUNTRY_CANADA'))                define('_COUNTRY_CANADA', 'Canada');
if(!defined('_COUNTRY_CAPEVERDEISLANDS'))      define('_COUNTRY_CAPEVERDEISLANDS', 'Illas Cabo Verde');
if(!defined('_COUNTRY_KAZAKHSTAN'))            define('_COUNTRY_KAZAKHSTAN', 'Kazakhstan');
if(!defined('_COUNTRY_KATAR'))                 define('_COUNTRY_KATAR', 'Katar');
if(!defined('_COUNTRY_KENYA'))                 define('_COUNTRY_KENYA', 'Kenia');
if(!defined('_COUNTRY_KYRGYZSTAN'))            define('_COUNTRY_KYRGYZSTAN', 'Kyrgyzstan');
if(!defined('_COUNTRY_KIRIBATI'))              define('_COUNTRY_KIRIBATI', 'Kiribati');
if(!defined('_COUNTRY_COCOSISLANDS'))          define('_COUNTRY_COCOSISLANDS', 'Illas Cocos');
if(!defined('_COUNTRY_COLOMBIA'))              define('_COUNTRY_COLOMBIA', 'Colombia');
if(!defined('_COUNTRY_COMOROS'))               define('_COUNTRY_COMOROS', 'Comoros');
if(!defined('_COUNTRY_CONGO'))                 define('_COUNTRY_CONGO', 'Congo');
if(!defined('_COUNTRY_CROATIA'))               define('_COUNTRY_CROATIA', 'Croacia');
if(!defined('_COUNTRY_CUBA'))                  define('_COUNTRY_CUBA', 'Cuba');
if(!defined('_COUNTRY_KUWAIT'))                define('_COUNTRY_KUWAIT', 'Kuwait');
if(!defined('_COUNTRY_LAOS'))                  define('_COUNTRY_LAOS', 'Laos');
if(!defined('_COUNTRY_LESOTHO'))               define('_COUNTRY_LESOTHO', 'Lesotho');
if(!defined('_COUNTRY_LATVIA'))                define('_COUNTRY_LATVIA', 'Latvia');
if(!defined('_COUNTRY_LEBANON'))               define('_COUNTRY_LEBANON', 'Lebanon');
if(!defined('_COUNTRY_LIBERIA'))               define('_COUNTRY_LIBERIA', 'Liberia');
if(!defined('_COUNTRY_LIBYA'))                 define('_COUNTRY_LIBYA', 'Libia');
if(!defined('_COUNTRY_LIECHTENSTEIN'))         define('_COUNTRY_LIECHTENSTEIN', 'Liechtenstein');
if(!defined('_COUNTRY_LITHUANIA'))             define('_COUNTRY_LITHUANIA', 'Lituania');
if(!defined('_COUNTRY_LUXEMBOURG'))            define('_COUNTRY_LUXEMBOURG', 'Luxemburgo');
if(!defined('_COUNTRY_MACAO'))                 define('_COUNTRY_MACAO', 'Macao');
if(!defined('_COUNTRY_MADAGASCAR'))            define('_COUNTRY_MADAGASCAR', 'Madagascar');
if(!defined('_COUNTRY_MALAWI'))                define('_COUNTRY_MALAWI', 'Malawi');
if(!defined('_COUNTRY_MALAYSIA'))              define('_COUNTRY_MALAYSIA', 'Malasia');
if(!defined('_COUNTRY_MALDIVEISLANDS'))        define('_COUNTRY_MALDIVEISLANDS', 'Illas Maldivas');
if(!defined('_COUNTRY_MALI'))                  define('_COUNTRY_MALI', 'Mali');
if(!defined('_COUNTRY_MALTA'))                 define('_COUNTRY_MALTA', 'Malta');
if(!defined('_COUNTRY_MAROCCO'))               define('_COUNTRY_MAROCCO', 'Marrocos');
if(!defined('_COUNTRY_MARSHALLISLANDS'))       define('_COUNTRY_MARSHALLISLANDS', 'Illas Marshall');
if(!defined('_COUNTRY_MARTINIQUE'))            define('_COUNTRY_MARTINIQUE', 'Martinique');

$arrCountry['mr'] = 'Mauretanien';
$arrCountry['mu'] = 'Mauritius';
$arrCountry['yt'] = 'Mayotte';
$arrCountry['mk'] = 'Mazedonien';
$arrCountry['mx'] = 'Mexiko';
$arrCountry['fm'] = 'Mikronesien';
$arrCountry['md'] = 'Moldavien';
$arrCountry['mc'] = 'Monaco';
$arrCountry['mn'] = 'Mongolei';
$arrCountry['ms'] = 'Montserrat';
$arrCountry['mz'] = 'Mozambique';
$arrCountry['mm'] = 'Myanmar';
$arrCountry['na'] = 'Namibia';
$arrCountry['nr'] = 'Nauru';
$arrCountry['np'] = 'Nepal';
$arrCountry['nc'] = 'Neukaledonien';
$arrCountry['nz'] = 'Neuseeland';
$arrCountry['ni'] = 'Nicaragua';
$arrCountry['nl'] = 'Niederlande';
$arrCountry['an'] = 'Niederl&#228;ndische Antillen';
$arrCountry['ne'] = 'Niger';
$arrCountry['ng'] = 'Nigeria';
$arrCountry['nu'] = 'Niue';
$arrCountry['kp'] = 'Nordkorea';
$arrCountry['nf'] = 'Norfolk-Inseln';
$arrCountry['no'] = 'Norwegen';
$arrCountry['mp'] = 'N?rdliche Marianen';
$arrCountry['om'] = 'Oman';
$arrCountry['at'] = '&Ouml;sterreich';
$arrCountry['tp'] = 'Ost-Timor';
$arrCountry['pk'] = 'Pakistan';
$arrCountry['pw'] = 'Palau';
$arrCountry['pa'] = 'Panama';
$arrCountry['pg'] = 'Papua-Neuguinea';
$arrCountry['py'] = 'Paraguay';
$arrCountry['pe'] = 'Peru';
$arrCountry['ph'] = 'Philippinen';
$arrCountry['pn'] = 'Pitcairn-Inseln';
$arrCountry['pl'] = 'Polen';
$arrCountry['pt'] = 'Portugal';
$arrCountry['pr'] = 'Puerto Rico';
$arrCountry['re'] = 'Reunion';
$arrCountry['rw'] = 'Ruanda';
$arrCountry['ro'] = 'Rum&#228;nien';
$arrCountry['ru'] = 'Ru&&#223;land';
$arrCountry['ws'] = 'Samoa';
$arrCountry['sm'] = 'San Marino';
$arrCountry['st'] = 'Sao Tome und Principe';
$arrCountry['sa'] = 'Saudi Arabien';
$arrCountry['ch'] = 'Schweiz';
$arrCountry['sn'] = 'Senegal';
$arrCountry['sc'] = 'Seychellen';
$arrCountry['sl'] = 'Sierra Leone';
$arrCountry['zw'] = 'Simbabwe';
$arrCountry['sg'] = 'Singapur';
$arrCountry['sk'] = 'Slovakei';
$arrCountry['si'] = 'Slovenien';
$arrCountry['so'] = 'Somalia';
$arrCountry['sp'] = 'Solomon-Inseln';
$arrCountry['es'] = 'Spanien';
$arrCountry['lk'] = 'Sri Lanka';
$arrCountry['gs'] = 'St. Georgia und S. Sandwich-Is.';
$arrCountry['sh'] = 'St. Helena';
$arrCountry['kn'] = 'St. Kitts &amp; Nevis';
$arrCountry['lc'] = 'St. Lucia';
$arrCountry['pm'] = 'St. Pierre und Miquelon';
$arrCountry['vc'] = 'St. Vincent und Grenadinen';

if(!defined('_COUNTRY_SUDAN'))                 define('_COUNTRY_SUDAN', 'Sudán');
if(!defined('_COUNTRY_SURINAME'))              define('_COUNTRY_SURINAME', 'Suriname');
if(!defined('_COUNTRY_SVALBARD'))              define('_COUNTRY_SVALBARD', 'Svalbard e Jan Mayen');
if(!defined('_COUNTRY_SWAZILAND'))             define('_COUNTRY_SWAZILAND', 'Swaziland');
if(!defined('_COUNTRY_SWEDEN'))                define('_COUNTRY_SWEDEN', 'Suecia');
if(!defined('_COUNTRY_SOUTHAFRICA'))           define('_COUNTRY_SOUTHAFRICA', 'Sudafrica');
if(!defined('_COUNTRY_SOUTHKOREA'))            define('_COUNTRY_SOUTHKOREA', 'Suecia');
if(!defined('_COUNTRY_SYRIA'))                 define('_COUNTRY_SYRIA', 'Siria');
if(!defined('_COUNTRY_TADZHIKISTAN'))          define('_COUNTRY_TADZHIKISTAN', 'Tadzhikistan');
if(!defined('_COUNTRY_TAIWAN'))                define('_COUNTRY_TAIWAN', 'Taiwan');
if(!defined('_COUNTRY_TANZANIA'))              define('_COUNTRY_TANZANIA', 'Tanzania');
if(!defined('_COUNTRY_THAILAND'))              define('_COUNTRY_THAILAND', 'Thailand');
if(!defined('_COUNTRY_TOGO'))                  define('_COUNTRY_TOGO', 'Togo');
if(!defined('_COUNTRY_TOKELAU'))               define('_COUNTRY_TOKELAU', 'Tokelau');
if(!defined('_COUNTRY_TONGA'))                 define('_COUNTRY_TONGA', 'Tonga');
if(!defined('_COUNTRY_TRINIDATANDTOBAGO'))     define('_COUNTRY_TRINIDATANDTOBAGO', 'Trinidade e Tobago');
if(!defined('_COUNTRY_CHAD'))                  define('_COUNTRY_CHAD', 'Chad');
if(!defined('_COUNTRY_CZECHREPUBLIC'))         define('_COUNTRY_CZECHREPUBLIC', 'República Checa');
if(!defined('_COUNTRY_TUNISIA'))               define('_COUNTRY_TUNISIA', 'Túnez');
if(!defined('_COUNTRY_TURKSANDCAICOSISLANDS')) define('_COUNTRY_TURKSANDCAICOSISLANDS', 'Illas Turks e Caicos');
if(!defined('_COUNTRY_TURKMENISTAN'))          define('_COUNTRY_TURKMENISTAN', 'Turkmenistan');
if(!defined('_COUNTRY_TUVALU'))                define('_COUNTRY_TUVALU', 'Tuvalu');
if(!defined('_COUNTRY_TURKEY'))                define('_COUNTRY_TURKEY', 'Turquía');
if(!defined('_COUNTRY_USMINOROUTLYINGISLANDS'))define('_COUNTRY_USMINOROUTLYINGISLANDS', 'Illas U.S. Minor Outlying');
if(!defined('_COUNTRY_UGANDA'))                define('_COUNTRY_UGANDA', 'Uganda');
if(!defined('_COUNTRY_UKRAINA'))               define('_COUNTRY_UKRAINA', 'Ucrania');
if(!defined('_COUNTRY_HUNGARY'))               define('_COUNTRY_HUNGARY', 'Hungría');
if(!defined('_COUNTRY_URUGUAY'))               define('_COUNTRY_URUGUAY', 'Uruguay');
if(!defined('_COUNTRY_UZBEKISTAN'))            define('_COUNTRY_UZBEKISTAN', 'Uzbekistán');
if(!defined('_COUNTRY_USA'))                   define('_COUNTRY_USA', 'Estados Unidos de América');
if(!defined('_COUNTRY_VANUATA'))               define('_COUNTRY_VANUATA', 'Vanuatu');
if(!defined('_COUNTRY_VATICANCITY'))           define('_COUNTRY_VATICANCITY', 'Cidade do Vaticano');
if(!defined('_COUNTRY_VENEZUELA'))             define('_COUNTRY_VENEZUELA', 'Venezuela');
if(!defined('_COUNTRY_UAE'))                   define('_COUNTRY_UAE', 'Emiratos Árabes Unidos');
if(!defined('_COUNTRY_VIETNAM'))               define('_COUNTRY_VIETNAM', 'Vietnam');
if(!defined('_COUNTRY_VALAISANDFUTUNAISLANDS'))define('_COUNTRY_VALAISANDFUTUNAISLANDS', 'Illas Valais e Futuna');
if(!defined('_COUNTRY_CHRISTMASISLANDS'))      define('_COUNTRY_CHRISTMASISLANDS', 'Illa de Pascua');
if(!defined('_COUNTRY_BELARUS'))               define('_COUNTRY_BELARUS', 'Belarus');
if(!defined('_COUNTRY_WESTERNSAHARA'))         define('_COUNTRY_WESTERNSAHARA', 'Sahara');
if(!defined('_COUNTRY_ZAIRE'))                 define('_COUNTRY_ZAIRE', 'Zaire');
if(!defined('_COUNTRY_ZAMBIA'))                define('_COUNTRY_ZAMBIA', 'Zambia');
if(!defined('_COUNTRY_CENTRALAFRICANREPUBLIC'))define('_COUNTRY_CENTRALAFRICANREPUBLIC', 'República de África Central');
if(!defined('_COUNTRY_CYPRUS'))                define('_COUNTRY_CYPRUS', 'Chipre');


// SOME FORMATS
if(!function_exists(lang_date) && !function_exists('lang_date')) {
	function lang_date($day, $month, $year, $hour, $min, $sec) {
		if(trim($day) != '' && trim($month) != '' && trim($year) != '') {
			$str1 = $day.'.'.$month.'.'.$year;
		}
		else {
			$str1 = '';
		}
		
		if(trim($hour) != '' && trim($min) != '') {
			if(trim($str1) != '') {
				$str3 = ' - '.$hour.':'.$min;
			}
			else {
				$str3 = $hour.':'.$min;
			}
		}
		else {
			$str3 = '';
		}
		
		if(trim($sec) != '') {
			$str2 = ':'.$sec;
		}
		else {
			$str2 = '';
		}
		
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

//if(_TCMS_LANGUAGE_STARTPOINT == 'admin'){ include_once('../language/english_EN/lang_english_EN.php'); }
//else{ include_once('engine/language/english_EN/lang_english_EN.php'); }


// INCLUDE DEFAULT LANGUAGE
if(_TCMS_LANGUAGE_STARTPOINT == 'admin') { include_once('../language/english_EN/lang_english_EN.php'); }
else { include_once('engine/language/english_EN/lang_english_EN.php'); }
// END INCLUDE

?>
