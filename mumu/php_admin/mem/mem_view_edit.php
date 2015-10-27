<?
//관리자 인증 파일
include "../../php/auth.php";
// 데이타베이스 연결정보 및 기타설정
include "../../php/config.php";
// 각종 유틸함수
include "../../php/util.php";
// MySQL 연결
$connect=my_connect($host,$dbid,$dbpass,$dbname);

$name = addslashes($name);
$email = addslashes($email);
$address1 = addslashes($address1);
$address2 = addslashes($address2);

########## 회원정보 테이블에 입력값을 등록한다. ########## 
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
	err_msg('DB에 에러가 발생했습니다'); 
}
else {
   echo("
      <script>
        window.alert('내용이 성공적으로 수정되었습니다.')
 	  </script>
    ");
    echo("<meta http-equiv='Refresh' content='0;  URL=member_view.php?num=$num'>");
   }
?>
