<?php
namespace Main;

session_start();

require('config.php');
require(SITE_PATH . 'vendor' . DS . 'autoload.php');
require(SITE_PATH . 'core' . DS . 'Connecting_DB.php');

try{
// Запускаем маршрутизатор
$frontObj = core\FrontController::getInstance();
	$frontObj->route();
// Отображаем страничку 404
}catch (core\NotFoundPageException $e){
	// echo $e->getMessage(); // Для отладки
	$rc = new \ReflectionClass('\Main\controllers\NotFoundPageController');
	$controller = $rc->newInstance();
	$method = $rc->getMethod('indexAction');
	$method->invoke($controller);
}