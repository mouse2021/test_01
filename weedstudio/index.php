<?php
	$page_title = '위드스튜디오';
	echo $_POST['id'];
	echo $_POST['pw'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="style.css" />
		<script type="text/javascript" src="javascript.js"></script>
		<title><?php echo $page_title ?></title>
	</head>
	<body>
		<div class="i_header">
<?php 		require_once('layout/header.php'); 										?>
		</div>
		<div class="i_navigation">
<?php 		require_once('layout/navigation.php'); 									?>
		</div>
		<div class="i_section">
<?php 		require_once('layout/section2.php'); 									?>
		</div>
		<div class="i_footer">
<?php 		require_once('layout/footer.php'); 										?>
		</div>
	</body>
</html>