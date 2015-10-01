<?php
namespace Main;

session_start();

require('config.php');
require(SITE_PATH . 'vendor' . DS . 'autoload.php');
require(SITE_PATH . 'core' . DS . 'Connecting_DB.php');

try{
// Создаем объект главного контроллера
$frontObj = core\FrontController::getInstance();
// Запускаем маршрутизатор
	$frontObj->route();
// Кидаем 404 ошибку
}catch (core\NotFoundPageException $e){
	// echo $e->getMessage(); // Для отладки
	$rc = new \ReflectionClass('\Main\controllers\NotFoundPageController');
	$controller = $rc->newInstance();
	$method = $rc->getMethod('indexAction');
	$method->invoke($controller);
}