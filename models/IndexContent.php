<?php
namespace Main\models;
class IndexContent extends MainContent {

	private $params;

	public function __construct() {
		parent::__construct();
		$rc = \Main\core\FrontController::getInstance();
		$this->params = $rc->getParams();
	}

	public function render() {
		$smarty = new \Main\core\Template();
		// $smarty->assign('primer', $this->primer());
		$smarty->display('index.tpl');
	}

	# Пример работы с БД
	// public function primer() {
	// 	 // Выборка записей из БД по условию
	// 	$select = array("where" => "`id` >= 1");
	// 	$obj = new Model_Users($select);
	// 	$data = $obj->getAllRows();
	// 	$value = '';
	// 	for($i=0; count($data) > $i; $i++) {
	// 		$value .= $data[$i]['login']."\n";
	// 	}
	// 	return $value;
		

	// 	// Создание записи в БД
	// 	$obj = new Model_Users();
	// 	$obj->fetchOne();
	// 	$obj->login = "Admin";
	// 	$obj->password = md5("gghj737");
	// 	$obj->save();
		
	// }
}