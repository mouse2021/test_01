<?
include "../php/config.php";
// ���� ��ƿ�Լ�
include "../php/util.php";
// MySQL ����
$connect=my_connect($host,$dbid,$dbpass,$dbname);

$jnumber=$jumin1."-".$jumin2; //�ֹε�Ϲ�ȣ
$id = addslashes($id);

########## ���� ���� ���翩�� Ȯ��. ########## 
$query  = "SELECT id FROM member WHERE id='$id' or jnumber='$jnumber' ";
$result = mysql_query($query,$connect);
$total_num = mysql_num_rows($result);

if($total_num){
	echo("<script>
	      window.alert('���̵� , �ֹι�ȣ �� �ߺ��� ���� �ֽ��ϴ�!')
	      history.go(-1)
	      </script>");
	exit;
}
else{

    ########## ȸ������ �ñ⸦ �����Ѵ�. ##########

    $email = addslashes($email);
	$address1 = addslashes($address1);
	$address2 = addslashes($address2);
	$phone = $phone1."-".$phone2."-".$phone3;
	$hphone = $hphone1."-".$hphone2."-".$hphone3;
	$zipcode = $zipcode1."-".$zipcode2;

	########## ȸ������ ���̺� �Է°��� ����Ѵ�. ########## 
	$query = "INSERT INTO member(id,passwd,email,name,jnumber,phone,mobile,
		                         zipcode,address1,address2,reg_date) 
			   VALUES ('$id','$passwd','$email','$name','$jnumber',
					   '$phone','$hphone','$zipcode','$address1',
					   '$address2',now() )";
	$result = mysql_query($query,$connect);
	
	// ����������� ������ �߻��ϸ�
	if (!$result) {      
	   err_msg('�����ͺ��̽� ������ �߻��Ͽ����ϴ�.');
	}
	else {
	   echo("<script>
	      window.alert('���������� ȸ�� ���ԵǾ����ϴ�. �α��� �� ����ϼ���!');
	      </script>");
	   echo "<meta http-equiv='Refresh' content='0; URL=/index.php'>"; 
	}
}
?>
