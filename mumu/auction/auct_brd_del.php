<?
include "../php/config.php";
// 각종 유틸함수
include "../php/util.php";
// MySQL 연결
$connect=my_connect($host,$dbid,$dbpass,$dbname);

if(!isset($_SESSION["p_id"]) || !isset($_SESSION["p_name"])){
  err_msg('로그인 후 이용할 수 있습니다.');
}

// 게시물 등록
if($md =='write'){
		
	$qry1 = "delete from auct_board where num='$brd_num'";
	$res1 = mysql_query($qry1,$connect);

	$qry2 = "delete from auct_board_memo where board_num_fk='$brd_num'";
	$res2 = mysql_query($qry2,$connect);

	if($res1 && $res2){
		 echo("
		  <script>
			window.alert('내용이 삭제되었습니다.')
		   </script>
		 ");
		 echo "<meta http-equiv='Refresh' content='0; URL=auct_brd_list.php?anum=$anum'>";

	}
	else{
		err_msg('게시물 삭제도중 오류가 발생했습니다.');
	}
}
else if($md =='memo'){  //게시물에 대한 답글(댓글) 등록
    
	$qry1 = "delete from auct_board_memo where mnum='$m_num'";
	$res1 = mysql_query($qry1,$connect);

	if($res1){
         
		 $qry2 = "update auct_board set re_cnt = re_cnt - 1 where num='$brd_num' ";
		 $res2 = mysql_query($qry2,$connect);

		 if($res2){
			 echo("
			  <script>
				window.alert('내용이 삭제되었습니다.')
			   </script>
			 ");
			 echo "<meta http-equiv='Refresh' content='0; URL=auct_brd_view.php?anum=$anum&brd_num=$brd_num'>";
		 }
		 else{
		   err_msg('게시물 업데이트 도중 오류가 발생했습니다.');
		 }
	}
	else{
		err_msg('게시물 삭제도중 오류가 발생했습니다.');
	}
}
?>
