<?php 
	require_once('db_info.php');
	
	class MemberDAO {
		private $dbc;
		
		function __construct() {
			// echo '생성자 호출<br/>';
			$this->dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		}
		function __destruct() {
			// echo '소멸자 호출<br/>';
			mysqli_close($this->dbc);
		}
		function getAllList() {
 			$arr = array();
			$query =	"select * ".
						"from member ";
			$data = mysqli_query($this->dbc, $query);
			
 			for ($i = 0 ; $row = mysqli_fetch_array($data) ; $i++) {
				$dto = new MemberDTO();
				$dto->setNum($row['num']);
				$dto->setJoin_date($row['join_date']);
				$dto->setNick($row['nick']);
				$dto->setId($row['id']);
				$dto->setPw($row['pw']);
				$arr[$i] = $dto;
			}
			return $arr;
		}
		function getLogin($id, $pw) {
			$dto = null;
			$query =	"select * ".
						"from member ".
						"where id = '$id' ".
						"and pw = '$pw' ";
			$data = mysqli_query($this->dbc, $query);
			
			if ($row = mysqli_fetch_array($data)) {
				$dto = new MemberDTO();
				$dto->setNum($row['num']);
				$dto->setJoin_date($row['join_date']);
				$dto->setNick($row['nick']);
				$dto->setId($row['id']);
				$dto->setPw($row['pw']);
			}
			return $dto;
		}
	}
?>