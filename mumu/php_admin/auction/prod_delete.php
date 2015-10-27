<?
//관리자 인증 파일
include "../../php/auth.php";
// 데이타베이스 연결정보 및 기타설정
include "../../php/config.php";
// 각종 유틸함수
include "../../php/util.php";
// MySQL 연결
$connect=my_connect($host,$dbid,$dbpass,$dbname);


// 화면에 보여지지 않도록 변경
$query1 = "update auct_master set delete_chk='Y' where anum=$p_num";
mysql_query($query1, $connect);

echo ("<meta http-equiv='refresh' content='0; URL=prod_list.php'>");
?>
