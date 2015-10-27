<?
// 아파치 인증
include	"../../php/auth.php";
// 데이타베이스 연결정보 및 기타설정
include	"../../php/config.php";
// 각종	유틸함수
include	"../../php/util.php";
// MySQL 연결
$connect=my_connect($host,$dbid,$dbpass,$dbname);

// 해당 주문정보를 취소처리 합니다.
$update = "update mall_order set cancel='Y' where num='$oid' ";
$result = mysql_query($update,$connect);

echo "<meta http-equiv='refresh' content='0; URL=order_list.php?page=$page'>";	
?>
 
