<?
include "../php/config.php";
// 각종 유틸함수
include "../php/util.php";
// MySQL 연결
$connect=my_connect($host,$dbid,$dbpass,$dbname);

$jnumber=$jumin1."-".$jumin2; //주민등록번호
$id = addslashes($id);

########## 동일 정보 존재여부 확인. ########## 
$query  = "SELECT id FROM member WHERE id='$id' or jnumber='$jnumber' ";
$result = mysql_query($query,$connect);
$total_num = mysql_num_rows($result);

if($total_num){
	echo("<script>
	      window.alert('아이디 , 주민번호 중 중복된 값이 있습니다!')
	      history.go(-1)
	      </script>");
	exit;
}
else{

    ########## 회원가입 시기를 저장한다. ##########

    $email = addslashes($email);
	$address1 = addslashes($address1);
	$address2 = addslashes($address2);
	$phone = $phone1."-".$phone2."-".$phone3;
	$hphone = $hphone1."-".$hphone2."-".$hphone3;
	$zipcode = $zipcode1."-".$zipcode2;

	########## 회원정보 테이블에 입력값을 등록한다. ########## 
	$query = "INSERT INTO member(id,passwd,email,name,jnumber,phone,mobile,
		                         zipcode,address1,address2,reg_date) 
			   VALUES ('$id','$passwd','$email','$name','$jnumber',
					   '$phone','$hphone','$zipcode','$address1',
					   '$address2',now() )";
	$result = mysql_query($query,$connect);
	
	// 저장과정에서 오류가 발생하면
	if (!$result) {      
	   err_msg('데이터베이스 오류가 발생하였습니다.');
	}
	else {
	   echo("<script>
	      window.alert('정상적으로 회원 가입되었습니다. 로그인 후 사용하세요!');
	      </script>");
	   echo "<meta http-equiv='Refresh' content='0; URL=/index.php'>"; 
	}
}
?>
