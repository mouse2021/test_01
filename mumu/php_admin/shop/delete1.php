<?
// 아파치 인증
include	"../../php/auth.php";
// 데이타베이스 연결정보 및 기타설정
include	"../../php/config.php";
// 각종	유틸함수
include	"../../php/util.php";
// MySQL 연결
$connect=my_connect($host,$dbid,$dbpass,$dbname);


if($mode=='del'){
  // 해당데이타 검색
  $update = "update products set $ck = 'N' where num=$p_num ";
  $result = mysql_query($update,$connect);
} 

if($mode=='insert'){
   $update = "update products set $ck = 'Y' where num=$p_num ";
   $result = mysql_query($update,$connect);
}
if($result){    
  echo("
      <script>
	    window.alert('내용이 수정되었습니다.')
	   </script>
   ");
   echo "<meta http-equiv='Refresh' content='0; URL=list.php?level=$level&category_code_fk=$category_code_fk&page=$page&l_category_fk=$l_category_fk'>"; 
}
else{
     err_msg('DB오류가 발생했습니다.');
}
?>
