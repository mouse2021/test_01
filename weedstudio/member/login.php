<form class="login" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="login">
	<input type="hidden" name="login_bt">
	<div class="login_box">
		<input class="login_box_id" type="text" name="id" value="<?php if (!empty($_POST['id'])) echo $_POST['id']; ?>">
		<input type="text" name="pw" value="<?php if (!empty($_POST['pw'])) echo $_POST['pw']; ?>">
	</div>
	<div class="login_btn">
		<input type="button" value="로그인" onClick="login_btn()">
	</div>
</form>
