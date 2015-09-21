<?php
	class NotFoundPage extends MainContent {

		public function __construct() {
			parent::__construct();
			header("HTTP/1.0 404 Not Found");
		}

		public function render() {
			$smarty = new Template();
			$smarty->display('NotFoundPage.tpl');
		}
	}
?>