<?php
namespace Main\models;
	class NotFoundPage extends MainContent {

		public function __construct() {
			parent::__construct();
			header("HTTP/1.0 404 Not Found");
		}

		public function render() {
			$smarty = new \Main\core\Template();
			$smarty->display('NotFoundPage.tpl');
		}
	}