<?
//������ ���� ����
include "../../php/auth.php";
// ����Ÿ���̽� �������� �� ��Ÿ����
include "../../php/config.php";
// ���� ��ƿ�Լ�
include "../../php/util.php";
// MySQL ����
$connect=my_connect($host,$dbid,$dbpass,$dbname);

$name = addslashes($name);

if ($mode == "insert") {
	// ī�װ� �ڵ尪 ���翩��
    $query = "select * from products_category1 where code='$code'";
    $result = mysql_query($query, $connect);
    $count = mysql_num_rows($result);
    mysql_free_result($result);

    if($count){
        err_msg("�Է��Ͻ� �ڵ尡 �̹� �ֽ��ϴ�.");
    }
    
    $query = "insert into products_category1 values ('','$code','$name')";
    mysql_query($query, $connect);

} 
else if ($mode == "update") {
	    
	  // �ڽ��� �� ����
    $query = "update products_category1 set name='$name' where id=$id";
    mysql_query($query, $connect);
}
 echo ("<meta http-equiv='refresh' content='0; URL=list.php'>");
?>
