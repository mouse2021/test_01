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
$email = addslashes($email);
$address1 = addslashes($address1);
$address2 = addslashes($address2);

########## ȸ������ ���̺� �Է°��� ����Ѵ�. ########## 
$query1 = " update member set name = '$name',
                              passwd = '$passwd',
							  email='$email',
                              phone='$phone', 
							  mobile = '$mobile',
							  zipcode = '$zipcode',
							  address1 = '$address1',
							  address2 = '$address2'
			where seq_num='$num' ";

$result1 = mysql_query($query1,$connect);

if (!$result1) {
	err_msg('DB�� ������ �߻��߽��ϴ�'); 
}
else {
   echo("
      <script>
        window.alert('������ ���������� �����Ǿ����ϴ�.')
 	  </script>
    ");
    echo("<meta http-equiv='Refresh' content='0;  URL=member_view.php?num=$num'>");
   }
?>
