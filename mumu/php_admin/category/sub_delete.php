<?
//������ ���� ����
include "../../php/auth.php";
// ����Ÿ���̽� �������� �� ��Ÿ����
include "../../php/config.php";
// ���� ��ƿ�Լ�
include "../../php/util.php";
// MySQL ����
$connect=my_connect($host,$dbid,$dbpass,$dbname);

// �����ϰ��� �ϴ� ī�װ��� �ڵ尪�� ����
$query = "select * from products_category2 where id=$id";
$result = mysql_query($query, $connect);
$row = mysql_fetch_array($result);
mysql_free_result($result);
$code = $row[code];

//ī�װ��� ���ϴ� ��ǰ���� ����
$query1 = "delete from products where l_category_fk='$code'";
mysql_query($query1, $connect);

// �ڽ��� ����
$query = "delete from products_category2 where id=$id";
mysql_query($query, $connect);

echo ("<meta http-equiv='refresh' content='0; URL=sub_list.php?sub_code=$row[category_code_fk]'>");
?>
