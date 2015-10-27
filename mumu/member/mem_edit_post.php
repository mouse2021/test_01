<?
########## 데이터베이스에 연결한다. ##########
// 데이타베이스 연결정보 및 기타설정
include "../php/config.php";
// 각종 유틸함수
include "../php/util.php";
// MySQL 연결
$connect=my_connect($host,$dbid,$dbpass,$dbname);

// 이름과 아이디에 해당되는 세션이 존재하는지 확인
if(!isset($_SESSION["p_id"]) || !isset($_SESSION["p_name"])){
  err_msg('로그인 정보가 없습니다. 다시 로그인해 주세요.');
}

$name = addslashes($name);
$email = addslashes($email);
$address1 = addslashes($address1);
$address2 = addslashes($address2);

$phone = $phone1."-".$phone2."-".$phone3;
$hphone = $hphone1."-".$hphone2."-".$hphone3;
$zipcode = $zipcode1."-".$zipcode2;

########## 회원정보 테이블에 입력값을 수정한다. ########## 
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
   err_msg('데이터베이스 오류가 발생하였습니다.');
}
else {
    
	// 세션을 다시 부여합니다.
	session_register("p_name");
    session_register("p_email");
   
	$p_name   = $name;
    $p_email  = $email;

    echo("<script>
	      window.alert('정상적으로 수정되었습니다!');
	      </script>");
    echo "<meta http-equiv='Refresh' content='0; URL=mem_edit.php'>"; 
}
?>
