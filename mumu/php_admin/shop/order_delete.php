<?
// ����ġ ����
include	"../../php/auth.php";
// ����Ÿ���̽� �������� �� ��Ÿ����
include	"../../php/config.php";
// ����	��ƿ�Լ�
include	"../../php/util.php";
// MySQL ����
$connect=my_connect($host,$dbid,$dbpass,$dbname);

// �ش� �ֹ������� ���ó�� �մϴ�.
$update = "update mall_order set cancel='Y' where num='$oid' ";
$result = mysql_query($update,$connect);

echo "<meta http-equiv='refresh' content='0; URL=order_list.php?page=$page'>";	
?>
 
