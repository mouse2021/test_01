<?
include "../php/config.php";
// ���� ��ƿ�Լ�
include "../php/util.php";
// MySQL ����
$connect=my_connect($host,$dbid,$dbpass,$dbname);

if(!isset($_SESSION["p_id"]) || !isset($_SESSION["p_name"])){
  err_msg('�α��� �� �̿��� �� �ֽ��ϴ�.');
}

//�̹� ��ϵǾ��ִ��� ����Ȯ��
$qry = "select * from auct_concern 
        where user_id='$_SESSION[p_id]' And 
              auction_code_fk='$anum' ";
$res = mysql_query($qry,$connect);
$rows = mysql_fetch_array($res);

//��ϵǾ�������
if($rows){
  err_msg('�̹� ��ϵǾ� �ֽ��ϴ�.');
}
else{
  $qry1 = "insert into auct_concern(user_id,auction_code_fk,wdate)
           values('$_SESSION[p_id]','$anum',now() )";
  $res1 = mysql_query($qry1,$connect);

  if($res1){
     echo("
      <script>
	    window.alert('����ǰ������ ��ϵǾ����ϴ�.')
	   </script>
     ");
	 echo "<meta http-equiv='Refresh' content='0; URL=auct_details.php?anum=$anum'>";

  }
  else{
    err_msg('����ǰ�� ��ϵ��� ������ �߻��߽��ϴ�.');
  }
}
?>
