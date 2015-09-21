<?php
	class NotFoundPageController implements IController {
		public function indexAction() {
			$notFoundPage = new NotFoundPage();
			$notFoundPage->render();
		}
	}
?>