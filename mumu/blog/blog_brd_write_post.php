<?
include "../php/config.php";
// 각종 유틸함수
include "../php/util.php";
// MySQL 연결
$connect=my_connect($host,$dbid,$dbpass,$dbname);

if(!isset($_SESSION["p_id"]) || !isset($_SESSION["p_name"])){
  err_msg('회원 로그인 후 사용할 수 있습니다.');
}

if($_SESSION[p_id] != $b_id){
  err_msg('본인의 블로그가 아닙니다. 블로그 정보를 확인하세요.');
}

$brd_title = addslashes($brd_title);

//수정일때
if($md=='edit'){
	//기본정보 업데이트
	$up1 = "update blog_brd_list set brd_title = '$brd_title',
								     brd_pow_1 = '$brd_pow_1',
									 brd_pow_2 = '$brd_pow_2'
			where num = '$brd_num' ";
	$res1 = mysql_query($up1,$connect);

}
else{  //추가일때
  
    $ins1 = "insert into blog_brd_list
	          (user_id,brd_title,brd_pow_1,brd_pow_2,brd_wdate)
	         values('$b_id','$brd_title','$brd_pow_1','$brd_pow_2',now())";
	$res1 = mysql_query($ins1,$connect);
    
}

if($res1) {    	 
    echo "<meta http-equiv='Refresh' content='0; URL=blog_brd_mng.php?b_id=$b_id'>"; 
}
else{
   err_msg('DB오류가 발생했습니다.');
}

?>
