<?
include "../php/config.php";
// ���� ��ƿ�Լ�
include "../php/util.php";
// MySQL ����
$connect=my_connect($host,$dbid,$dbpass,$dbname);

// �̸��� ���̵� �ش�Ǵ� ������ �����ϴ��� Ȯ��
if(!isset($_SESSION["p_id"]) || !isset($_SESSION["p_name"])){
  err_msg('�α��� ������ �����ϴ�. �ٽ� �α����� �ּ���.');
}

//����ȭ�鿡�� ����
if($mode=='view'){
    //���� �����Գ����� ����
	if($gb=='1'){
	  $qry = "update message_info set receive_del='Y' where mnum='$mnum' ";
	  $res = mysql_query($qry,$connect);

	  echo("<meta http-equiv='Refresh' content='0; URL=message_1.php'>");
	}
	else if($gb=='2'){  //���� ������ �������
	  $qry = "update message_info set send_del='Y' where mnum='$mnum' ";
	  $res = mysql_query($qry,$connect);
      
	  echo("<meta http-equiv='Refresh' content='0; URL=message_2.php'>");
	}
}
else{
	//���� �����Կ��� ����
	if($gb=='1'){
	  for($i=0;$i < sizeof($mnum);$i++){

		 if($mnum[$i]){
			$qry = "update message_info set receive_del='Y' where mnum='$mnum[$i]' ";
			$res = mysql_query($qry,$connect);
		 }
	  }
	  echo("<meta http-equiv='Refresh' content='0; URL=message_1.php'>");
	}
	else if($gb=='2'){ //���� �����Կ��� ����
	  for($i=0;$i < sizeof($mnum);$i++){

		 if($mnum[$i]){
			$qry = "update message_info set send_del='Y' where mnum='$mnum[$i]' ";
			$res = mysql_query($qry,$connect);
		 }
	  }
	  echo("<meta http-equiv='Refresh' content='0; URL=message_2.php'>");
	}
}
?>
