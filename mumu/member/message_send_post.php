<?
########## �����ͺ��̽��� �����Ѵ�. ##########
// ����Ÿ���̽� �������� �� ��Ÿ����
include "../php/config.php";
// ���� ��ƿ�Լ�
include "../php/util.php";
// MySQL ����
$connect=my_connect($host,$dbid,$dbpass,$dbname);

// �̸��� ���̵� �ش�Ǵ� ������ �����ϴ��� Ȯ��
if(!isset($_SESSION["p_id"]) || !isset($_SESSION["p_name"])){
  err_msg('�α��� ������ �����ϴ�. �ٽ� �α����� �ּ���.');
}


// �����ϴ� ���̵����� Ȯ��
$query  = "SELECT id FROM member WHERE id='$receive_id' ";
$result = mysql_query($query,$connect);
$total_num = mysql_num_rows($result);

if(!$total_num){
	err_msg('�������� �ʴ� ���̵��Դϴ�. ���̵� Ȯ���ϼ���.');
}
else{
  
  $msg = addslashes($msg);

  $qry1 = "insert into message_info(sendid_fk,receiveid_fk,message,send_reg)
           values('$_SESSION[p_id]','$receive_id','$msg',now()) ";
  
  $res1 = mysql_query($qry1,$connect);
  if (!$res1) {      
     err_msg('�����ͺ��̽� ������ �߻��Ͽ����ϴ�.');
  }
  else {
     echo("<script>
	      window.alert('���������� �޽����� ���� �Ǿ����ϴ�!');
	      </script>");
    echo "<meta http-equiv='Refresh' content='0; URL=/member/message_2.php'>"; 
  }
}
?>
