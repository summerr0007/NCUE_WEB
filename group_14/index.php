<?php   
    define('APP_PATH', __DIR__ . '/');
    define('APP_DEBUG', true);
    define('FCPATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);
    require(APP_PATH . 'mvcphp/Mvcphp.php');
    $config = require(APP_PATH . 'config/config.php');
    
     
    (new mvcphp\Mvcphp($config))->run();

