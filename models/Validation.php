<?php
	class Validation {

		public function validLogin($login) {
			if(!preg_match("/^[a-zA-Z]+([a-zA-Z0-9_]+)?$/", $login)) return false;
			return $this->validString($login, 3, 15);
		}

		public function validPass($pass) {
			if(!preg_match("/^[a-zA-Z0-9]+([a-z0-9_]+)?$/", $pass)) return false;
			return $this->validString($pass, 5, 20);
		}

		public function validEmail($email) {
			if(!preg_match("/^[a-zA-Z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/", $email)) return false;
			else return true;
		}

		private function validString($string, $min_length, $max_length) {
			if(!is_string($string)) return false;
			if(strlen($string) < $min_length) return false;
			if(strlen($string) > $max_length) return false;
			return true;
		}
}
?>