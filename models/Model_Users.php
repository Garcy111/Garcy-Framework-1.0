<?php
class Model_Users extends Model_DB {

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
?>