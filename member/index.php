<?php
	$page_title = '회원가입';
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
	<?php 
		require_once('class/MemberDTO.php');
		require_once('class/MemberDAO.php');
		
		$dao = new MemberDAO();
		$dto = $dao->getAllList();
		if ($dto == null) {
			echo '널<br/>';
		} else {
			for ($i=0 ; $i<count($dto) ; $i++) {
				echo $dto[$i]->getNum().'<br/>';
				echo $dto[$i]->getJoin_date().'<br/>';
				echo $dto[$i]->getNick().'<br/>';
				echo $dto[$i]->getId().'<br/>';
				echo $dto[$i]->getPw().'<br/>';
			}
		}
		
		$dto2 = $dao->getLogin(111, 111);
		if ($dto2 == null) {
			echo '널<br/>';
		} else {
			echo $dto2->getNum().'<br/>';
			echo $dto2->getJoin_date().'<br/>';
			echo $dto2->getNick().'<br/>';
			echo $dto2->getId().'<br/>';
			echo $dto2->getPw().'<br/>';
		}
	?>
	</body>
</html>