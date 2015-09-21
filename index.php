<?php
// отображение ошибок
error_reporting (E_ALL);
session_start();
// подключаем конфиг
require_once('config.php');
// Соединяемся с БД
require_once(SITE_PATH.DS.'core'.DS.'Connecting_DB.php');
// подключаем ядро сайта
require_once(SITE_PATH.DS.'core'.DS.'Core.php');
try{
// Создаем объект главного контроллера
$frontObj = FrontController::getInstance();
// Запускаем маршрутизатор
	$frontObj->route();
// Кидаем 404 ошибку
}catch (NotFoundPageException $e){
	$rc = new ReflectionClass('NotFoundPageController');
	$controller = $rc->newInstance();
	$method = $rc->getMethod('indexAction');
	$method->invoke($controller);
}