<?php
// connect database
class ConnectMysql{
		public $host = 'localhost';
		public $db_login = 'inter';
		public $db_pass = 'admin';
		public $db_name = 'inter';
		public $isConnected = false;

		function Connect(){
			mysql_connect($this->host, $this->db_login, $this->db_pass)
				or die("Data base error");
			mysql_query('set character_set_client="utf8"');
			mysql_query('set character_set_results="utf8"');
			mysql_select_db($this->db_name) or die(mysql_error());
			$isConnected = true;
		}

		public function isConnected() {
			return $isConnected;
		}
	}
?>
