<?php
require 'config.php';
require_once 'engine/action.php';
require_once 'engine/router.php';
require_once 'engine/registry.php';
require_once 'engine/controller.php';
require_once 'engine/model.php';
require_once 'engine/proxy.php';
require_once 'engine/loader.php';
require_once 'engine/language.php';

require_once 'engine/mydb.php';

$registry = new Registry();
$loader = new Loader($registry);
$registry->set('load', $loader);

$db = new MyDB(MYSQL_HOSTNAME, MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DATABASENAME);
$registry->set('db', $db);

$language = new Language();
$registry->set('language', $language);

$router = new Router($registry);
//$router->addPreAction(new Action('startup/preaction'));
$router->dispatch(new Action((isset($_GET['route']) ? $_GET['route'] : 'main')), new Action('error/error'));


?>