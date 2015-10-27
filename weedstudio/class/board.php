<?php
	require_once('db_info.php');
	
	class board {
		function __construct() {
			echo '생성자 호출<br/>';
			echo DB_HOST.'<br/>';
		}
		function __destruct() {
			echo '소멸자 호출<br/>';
		}
	}
?>