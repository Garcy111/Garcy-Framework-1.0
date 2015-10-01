<?php
namespace Main\controllers;
	class NotFoundPageController implements \Main\core\IController {
		public function indexAction() {
			$notFoundPage = new \Main\models\NotFoundPage();
			$notFoundPage->render();
		}
	}