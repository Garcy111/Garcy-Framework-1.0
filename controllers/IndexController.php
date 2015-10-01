<?php
namespace Main\controllers;
	class IndexController implements \Main\core\IController {
		public function indexAction() {
			$index = new \Main\models\IndexContent();
			$index->render();
		}
	}