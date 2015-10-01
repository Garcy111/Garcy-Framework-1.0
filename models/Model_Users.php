<?php
namespace Main\models;
class Model_Users extends \Main\core\Model_DB {

	public $id;
	public $login;
	public $password;

	public function fieldsTable() {
		return array(
			"id" => "",
			"login" => "",
			"password" => ""
			);
	}
}