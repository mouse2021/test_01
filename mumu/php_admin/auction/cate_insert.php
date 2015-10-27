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

if ($mode == "insert") {
	// 카테고리 코드값 존재여부
    $query = "select * from auct_category where code='$code'";
    $result = mysql_query($query, $connect);
    $count = mysql_num_rows($result);
    mysql_free_result($result);

    if($count){
        err_msg("입력하신 코드가 이미 있습니다.");
    }
    
    $query = "insert into auct_category values ('','$code','$name','$cancel_chk')";
    mysql_query($query, $connect);

} 
else if ($mode == "update") {
	    
	  // 자신의 값 변경
    $query = "update auct_category set name='$name',
	                                   cancel_chk='$cancel_chk'
	          where id=$id";
    mysql_query($query, $connect);
}
 echo ("<meta http-equiv='refresh' content='0; URL=cate_list.php'>");
?>
