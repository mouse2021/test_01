<?php
	session_start(); // 세션시작
	$_SESSION['a'] = 'hello world'; // 세션에 값 설정
	$_SESSION['b'] = 'im fine thank you';
	echo $_SESSION['a'] . '<br/>'; // 세션에 값 호출
	echo $_SESSION['b'] . '<br/>';
	unset($_SESSION['a']);
	echo $_SESSION['a'] . '<br/>'; // 세션에 값 호출
	echo $_SESSION['b'] . '<br/>';
?>