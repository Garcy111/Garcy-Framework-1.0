<?php
	class IndexController implements IController {
		public function indexAction() {
			$index = new IndexContent();
			$index->render();
		}
	}
?>