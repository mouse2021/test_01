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

$name = addslashes($name);
$email = addslashes($email);
$address1 = addslashes($address1);
$address2 = addslashes($address2);

$phone = $phone1."-".$phone2."-".$phone3;
$hphone = $hphone1."-".$hphone2."-".$hphone3;
$zipcode = $zipcode1."-".$zipcode2;

########## ȸ������ ���̺� �Է°��� �����Ѵ�. ########## 
$query = "UPDATE member SET passwd   = '$passwd',
                            name     = '$name',
							email    = '$email',
							phone    = '$phone',
							mobile   = '$hphone',
							zipcode  = '$zipcode',
							address1 = '$address1',
							address2 = '$address2'
		  WHERE id='$_SESSION[p_id]' ";
$result = mysql_query($query,$connect);

if (!$result) {      
   err_msg('�����ͺ��̽� ������ �߻��Ͽ����ϴ�.');
}
else {
    
	// ������ �ٽ� �ο��մϴ�.
	session_register("p_name");
    session_register("p_email");
   
	$p_name   = $name;
    $p_email  = $email;

    echo("<script>
	      window.alert('���������� �����Ǿ����ϴ�!');
	      </script>");
    echo "<meta http-equiv='Refresh' content='0; URL=mem_edit.php'>"; 
}
?>
