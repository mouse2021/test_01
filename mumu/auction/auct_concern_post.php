<?
include "../php/config.php";
// 각종 유틸함수
include "../php/util.php";
// MySQL 연결
$connect=my_connect($host,$dbid,$dbpass,$dbname);

if(!isset($_SESSION["p_id"]) || !isset($_SESSION["p_name"])){
  err_msg('로그인 후 이용할 수 있습니다.');
}

//이미 등록되어있는지 여부확인
$qry = "select * from auct_concern 
        where user_id='$_SESSION[p_id]' And 
              auction_code_fk='$anum' ";
$res = mysql_query($qry,$connect);
$rows = mysql_fetch_array($res);

//등록되어있을때
if($rows){
  err_msg('이미 등록되어 있습니다.');
}
else{
  $qry1 = "insert into auct_concern(user_id,auction_code_fk,wdate)
           values('$_SESSION[p_id]','$anum',now() )";
  $res1 = mysql_query($qry1,$connect);

  if($res1){
     echo("
      <script>
	    window.alert('관심품목으로 등록되었습니다.')
	   </script>
     ");
	 echo "<meta http-equiv='Refresh' content='0; URL=auct_details.php?anum=$anum'>";

  }
  else{
    err_msg('관심품록 등록도중 오류가 발생했습니다.');
  }
}
?>
