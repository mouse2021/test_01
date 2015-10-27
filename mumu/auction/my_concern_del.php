<?
include "../php/config.php";
// 각종 유틸함수
include "../php/util.php";
// MySQL 연결
$connect=my_connect($host,$dbid,$dbpass,$dbname);

if(!isset($_SESSION["p_id"]) || !isset($_SESSION["p_name"])){
  err_msg('회원 로그인 후 사용할 수 있습니다.');
}

for($i=0;$i < sizeof($prod_num);$i++){
  //삭제할 관심품목이 있을때
  if($prod_num[$i]){   
	 $qry = "delete from auct_concern where user_id='$_SESSION[p_id]' And
	                                        auction_code_fk='$prod_num[$i]' ";
	 $res = mysql_query($qry,$connect);
  }
}

echo("
   <script>
	window.alert('처리되었습니다.')
   </script>
");
echo "<meta http-equiv='Refresh' content='0; URL=my_concern_list.php'>"; 

?>
