<?
//������ ���� ����
include "../../php/auth.php";
// ����Ÿ���̽� �������� �� ��Ÿ����
include "../../php/config.php";
// ���� ��ƿ�Լ�
include "../../php/util.php";
// MySQL ����
$connect=my_connect($host,$dbid,$dbpass,$dbname);


// ȭ�鿡 �������� �ʵ��� ����
$query1 = "update auct_master set delete_chk='Y' where anum=$p_num";
mysql_query($query1, $connect);

echo ("<meta http-equiv='refresh' content='0; URL=prod_list.php'>");
?>
