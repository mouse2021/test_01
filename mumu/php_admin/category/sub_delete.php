<?
//관리자 인증 파일
include "../../php/auth.php";
// 데이타베이스 연결정보 및 기타설정
include "../../php/config.php";
// 각종 유틸함수
include "../../php/util.php";
// MySQL 연결
$connect=my_connect($host,$dbid,$dbpass,$dbname);

// 삭제하고자 하는 카테고리의 코드값을 구함
$query = "select * from products_category2 where id=$id";
$result = mysql_query($query, $connect);
$row = mysql_fetch_array($result);
mysql_free_result($result);
$code = $row[code];

//카테고리에 속하는 상품정보 삭제
$query1 = "delete from products where l_category_fk='$code'";
mysql_query($query1, $connect);

// 자신을 지움
$query = "delete from products_category2 where id=$id";
mysql_query($query, $connect);

echo ("<meta http-equiv='refresh' content='0; URL=sub_list.php?sub_code=$row[category_code_fk]'>");
?>
