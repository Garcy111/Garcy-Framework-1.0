<?php
	// Устанавливаем директории для поиска включаемых файлов
	set_include_path(get_include_path()
		.PATH_SEPARATOR.'controllers'
		.PATH_SEPARATOR.'models'
		.PATH_SEPARATOR.'views'
		.PATH_SEPARATOR.'core'
		.PATH_SEPARATOR.'lib'
		.PATH_SEPARATOR.'lib/sysplugins');

	function __autoload($className) {
		$fileName = $className.'.php';
		require_once($fileName);
}