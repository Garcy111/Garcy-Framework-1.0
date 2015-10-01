<?php

function __route() {
	$route = (empty($_GET['route']))?'': $_GET['route'];
	unset($_GET['route']);
	if(empty($route)) {
		$this->_controller = 'IndexController';
		$this->_action = 'indexAction';
	}
	else {
		// Choose controller
		$splits = explode('/', trim($route, '/\\'));
		$this->_controller = ucfirst($splits[0]).'Controller';
		if(strpos($splits[0],"=") > 0 && empty($splits[1])) $this->_controller = 'IndexController';

	}
}