<div class="header">
	<div class="header_text"><a href="index.php">WeedStudio</a></div>
	<div class="h_login">
<?php
	if (!isset($_POST['login_bt'])) { // 없는경우
		require_once('member/login.php');
	} else {
		echo "메롱";
	}
?>	
	</div>
</div>