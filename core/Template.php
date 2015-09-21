<?php
	require_once(SMARTY_DIR.'Smarty.class.php');
	class Template extends Smarty {

		public function __construct() {
			parent::__construct();
			$this->template_dir = SMARTY_TEMPLATE;
			$this->compile_dir = SMARTY_COMPILE;
			$this->config_dir = SMARTY_CONFIG;
			$this->cache_dir = SMARTY_CACHE;
		}
	}
?>