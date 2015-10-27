<?php
	require_once('db_info.php');
	
	class member {
		private $dbc;
		
		function __construct() {
			// echo '생성자 호출<br/>';
			$this->dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		}
		function __destruct() {
			// echo '소멸자 호출<br/>';
			mysqli_close($this->dbc);
		}
		function show() {
			$query = 	"select *".
						"from member ".
						"where id = '111' ".
						"and pw = '111'";
			$data = mysqli_query($this->dbc, $query);
			
			while ($row = mysqli_fetch_array($data)) {
				echo $row['id'].' / '.$row['pw'].'<br/>';
			}
		}
	}
?>