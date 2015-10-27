<?php 
	class MemberDTO {
		private $num;
		private $join_date;
		private $nick;
		private $id;
		private $pw;
		
		function setNum($num) { $this->num = $num; }
		function getNum() { return $this->num; }
		function setJoin_date($join_date) { $this->join_date = $join_date; }
		function getJoin_date() { return $this->join_date; }
		function setNick($nick) { $this->nick = $nick; }
		function getNick() { return $this->nick; }
		function setId($id) { $this->id = $id; }
		function getId() { return $this->id; }
		function setPw($pw) { $this->pw = $pw; }
		function getPw() { return $this->pw; }
	}
?>