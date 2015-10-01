<?php
namespace Main\core;
	class FrontController {
		private $_controller;
		private $_action;
		private $_params = array();
		static $_instance;

		public static function getInstance() {
			if(!(self::$_instance instanceOf self))
				self::$_instance = new self;
				return self::$_instance;
		}

		 private function __construct() {
			$route = (empty($_GET['route']))?'': $_GET['route'];
			unset($_GET['route']);
			if(empty($route)) {
				$this->_controller = 'IndexController';
				$this->_action = 'indexAction';
			}
			else {
				// Choice controller
				$splits = explode('/', trim($route, '/\\'));
				$this->_controller = ucfirst($splits[0]).'Controller';
				if(strpos($splits[0],"=") !== false or empty($splits[0])) {
					$this->_controller = 'IndexController';
				}
				// Choice action
				$q = !empty($splits[1])?strpos($splits[1], "="):false;
				if(!empty($splits[1]) && $q === false) {
					$this->_action = $splits[1].'Action';
				} else $this->_action = 'indexAction';
				// Choice params
				$length = count($splits);
				for ($i=0; $length > $i; $i++) { 
					$q = strpos($splits[$i], "=");
					if($q !== false) {
						$inx = $i;
						break;
					}
				}
				if(is_int($inx)) {
					$key = $val = array();
					for($i=$inx; count($splits) > $i; $i++) {
						$param = explode('=', $splits[$i]);
						if(!empty($param[0]) && !empty($param[1])) {
							$key[] .= $param[0];
							$val[] .= $param[1];
						}
						else throw new NotFoundPageException('Not valid parameter');
					}
					$this->_params = array_combine($key, $val);
				}
			}

			// echo 'Контроллер: ' . $this->_controller;
			// echo '<br>';
			// echo '<br>';
			// echo 'Экшен: ' . $this->_action;
			// echo '<br>';
			// echo '<br>';
			// echo 'Параметры: ';
			// print '<pre>';
			// print_r($this->_params);
			// print '</pre>';
		}

		public function route() {
			if(file_exists(SITE_PATH.'controllers'.DS.$this->_controller.'.php')) {
				if(class_exists('\Main\controllers\\' . $this->_controller)) {
					$rc = new \ReflectionClass('\Main\controllers\\'.$this->_controller);
					if($rc->implementsInterface('\Main\core\IController')) {
						// Call action of controller
						if($rc->hasMethod($this->_action)) {
							$controller = $rc->newInstance();
							$method = $rc->getMethod($this->_action);
							$method->invoke($controller);
						} else throw new NotFoundPageException('Wrong Action');
					} else throw new NotFoundPageException('Wrong Interface');
				} else throw new NotFoundPageException('Wrong Class Controller');
			} else throw new NotFoundPageException('Wrong File Controller');
		}

		public function getController() {
			return $this->_controller;
		}

		public function getAction() {
			return $this->_action;
		}

		public function getParams() {
			return $this->_params;
		}
	}
?>