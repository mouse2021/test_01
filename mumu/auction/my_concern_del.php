<?
include "../php/config.php";
// ���� ��ƿ�Լ�
include "../php/util.php";
// MySQL ����
$connect=my_connect($host,$dbid,$dbpass,$dbname);

if(!isset($_SESSION["p_id"]) || !isset($_SESSION["p_name"])){
  err_msg('ȸ�� �α��� �� ����� �� �ֽ��ϴ�.');
}

for($i=0;$i < sizeof($prod_num);$i++){
  //������ ����ǰ���� ������
  if($prod_num[$i]){   
	 $qry = "delete from auct_concern where user_id='$_SESSION[p_id]' And
	                                        auction_code_fk='$prod_num[$i]' ";
	 $res = mysql_query($qry,$connect);
  }
}

echo("
   <script>
	window.alert('ó���Ǿ����ϴ�.')
   </script>
");
echo "<meta http-equiv='Refresh' content='0; URL=my_concern_list.php'>"; 

?>
