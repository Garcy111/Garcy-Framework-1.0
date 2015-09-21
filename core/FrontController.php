<?php
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
				// Контроллер по умолчанию
				$route = 'index';
			}
			$splits = explode('/', trim($route, '/\\'));
			// Выбор контроллера
			$this->_controller = ucfirst($splits[0]).'Controller';
			// Выбор экшена
			if(!empty($splits[1])) {
				$split = $splits[1];
				$q = strpos($split, ",");
				if($q) $this->_action = 'index';
				else $this->_action = $splits[1];
			}else $this->_action = 'index';
			// Выбор параметров
			$index = !empty($q)?1:2;
			if(!empty($splits[$index])) {
				$key = $value = array();
				for($i=$index; count($splits) > $i; $i++) {
					$param = explode(',', $splits[$i]);
					if(!empty($param[1])) {
						$key[] .= $param[0];
						$value[] .= $param[1];
					}
					else
						throw new NotFoundPageException('Not valid parameter');
				}
					$this->_params = array_combine($key, $value);
			}
		}

		// Имя файла контроллера и его класса должно быть одинаково
		public function route() {
			// Проверяем наличие файла контроллера
			if(file_exists(SITE_PATH.DS.'controllers'.DS.$this->getController().'.php')) {
				// Проверяем наличие класса контроллера
				if(class_exists($this->getController())) {
					$rc = new ReflectionClass($this->getController());
					// Проверяем наличие реализации интерфеса в классе
					if($rc->implementsInterface('IController')) {
						// Вызываем экшен контроллера
						if($rc->hasMethod($this->_action.'Action')) {
							$controller = $rc->newInstance();
							$method = $rc->getMethod($this->_action.'Action');
							$method->invoke($controller);
						}else {
							throw new NotFoundPageException('Wrong Action');
						}
					}else {
						throw new NotFoundPageException('Wrong Interface');
					}
				}else {
					throw new NotFoundPageException('Wrong Class Controller');
				}
			}else {
				throw new NotFoundPageException('Wrong File Controller');
			}
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