<?php

// Definir el uso horario o timezone del sistema
date_default_timezone_set('America/Mexico_City');

// Configuración básica de la aplicación
define('APP_NAME' , env('APP_NAME', 'little app'));
define('APP_VERSION' , env('APP_VERSION', '0.0.1'));
define('APP_CHARSET' , env('APP_CHARSET', 'utf8'));
define('APP_LANG'    , env('APP_LANG', 'us'));

// DB Constants Config
define('DB_DRIVER', env('DB_DRIVER', 'mysql'));
define('DB_HOST', env('DB_HOST', 'localhost'));
define('DB_DATABASE', env('DB_DATABASE', 'little'));
define('DB_USERNAME', env('DB_USERNAME', 'root'));
define('DB_PASSWORD', env('DB_PASSWORD', ''));
define('DB_CHARSET', env('DB_CHARSET', 'utf8'));

// App Port and App URL 
define('IS_LOCAL'     , in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1']));
define('BASEPATH'     , IS_LOCAL ? env('APP_LOCAL_ROUTE', '/') :  env('APP_PROD_ROUTE', '/')); // Debe ser cambiada a la ruta de tu proyecto en producción y desarrollo
define('APP_DEMO'      , env('APP_DEMO', false));
define('APP_ENV'      , env('APP_ENV', 'production'));

define('PROTOCOL'   , isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http"); // Detectar si está en HTTPS o HTTP
define('HOST'       , $_SERVER['HTTP_HOST'] === 'localhost' ? 'localhost' : $_SERVER['HTTP_HOST']); // Dominio o host localhost.com tudominio.com
define('REQUEST_URI', $_SERVER["REQUEST_URI"]); // Parámetros y ruta requerida
define('URL'        , PROTOCOL.'://'.HOST.BASEPATH); // URL del sitio
define('CUR_PAGE'   , PROTOCOL.'://'.HOST.REQUEST_URI); // URL actual incluyendo parámetros get

// Las rutas de directorios y archivos
define('DS'         , DIRECTORY_SEPARATOR);
// define('ROOT'       , getcwd().DS);
define('ROOT'       , realpath('..').DS);

define('APP'        , ROOT.'app'.DS);
define('CLASSES'    , APP.'classes'.DS);
define('CONFIG'     , APP.'config'.DS);
define('CONTROLLERS', APP.'controllers'.DS);
define('HELPERS'  , APP.'helpers'.DS);
define('MODELS'     , APP.'models'.DS);
define('LOGS'       , APP.'logs'.DS);

define('RESOURCES'  , ROOT.'resources'.DS);
define('INCLUDES'   , RESOURCES.'includes'.DS);
define('COMPONENTS'    , RESOURCES.'components'.DS);
define('VIEWS'      , RESOURCES.'views'.DS);

// Rutas de recursos y assets absolutos
define('IMAGES_PATH', ROOT.'assets'.DS.'images'.DS);

// Rutas de archivos o assets con base URL
define('ASSETS'     , URL.'public/');
define('CSS'        , ASSETS.'css/');
define('FAVICON'    , ASSETS.'favicon/');
define('FONTS'      , ASSETS.'fonts/');
define('IMAGES'     , ASSETS.'images/');
define('JS'         , ASSETS.'js/');
define('PLUGINS'    , ASSETS.'plugins/');
define('UPLOADS'    , ROOT.'assets'.DS.'uploads'.DS);
define('UPLOADED'   , ASSETS.'uploads/');

// El controlador por defecto / el método por defecto de la página de error 
define('DEFAULT_ERROR_CONTROLLER', 'errorController');
define('DEFAULT_ERROR_METHOD'          , 'index'); //  errorController@index


define('AUTH_SALT', env('AUTH_SALT', ''));