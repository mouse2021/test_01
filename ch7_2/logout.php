<?php
	session_start();
	if (isset($_SESSION['user_id'])) {
		$_SESSION = array(); // 모든 세션변수 삭제
	
		if (isset($_COOKIE[session_name()])) {			setcookie(session_name(), '', time() - 3600); // 쿠기 만기 시간을 1시간 전으로 설정 = 삭제		}
		session_destroy();
	}
	setcookie('user_id', '', time() - 3600);
	setcookie('username', '', time() - 3600);
	
	$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
	header('Location: ' . $home_url);
?>
