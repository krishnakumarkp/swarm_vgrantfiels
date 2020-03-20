<?php
define('WEBROOT', str_replace("public/index.php", "", $_SERVER["SCRIPT_NAME"]));
define('ROOT', str_replace("public/index.php", "", $_SERVER["SCRIPT_FILENAME"]));

require(ROOT . 'Application/Core/Autoloader.php');

$loader = new \Application\Core\Autoloader;

$loader->register();

$loader->addNamespace('Application\Core', ROOT . 'Application/Core');
$loader->addNamespace('Application\Lib', ROOT . 'Application/Lib');
$loader->addNamespace('Application\Lib\MysqlStore', ROOT . 'Application/Lib/MysqlStore');
$loader->addNamespace('Application\Config', ROOT . 'Application/Config');
$loader->addNamespace('Application\Controllers', ROOT . 'Application/Controllers');
$loader->addNamespace('Application\Models', ROOT . 'Application/Models');

/*
require(ROOT . 'Application/Core/Request.php');
require(ROOT . 'Application/Core/Router.php');
require(ROOT . 'Application/Core/Dispatcher.php');
require(ROOT . 'Application/Core/Template.php');
require(ROOT . 'Application/Core/Model.php');
require(ROOT . 'Application/Core/Controller.php');
require(ROOT . 'Application/Config/Config.php');
require(ROOT . 'Application/Lib/MysqlStore/Database.php');
require(ROOT . 'Application/Lib/Session.php');
require(ROOT . 'Application/Lib/User.php');

*/
//require(ROOT . 'Application/Lib/MysqlStore/Database.php');
$config = new \Application\Config\Config();
$db = \Application\Lib\MysqlStore\Database::getDatabase($config);
$session = new \Application\Lib\Session();
$request = new \Application\Core\Request();

$dispatcher = new \Application\Core\Dispatcher($db, $session);
$dispatcher->dispatch($request);

