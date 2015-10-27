<?
include "../php/config.php";
// 각종 유틸함수
include "../php/util.php";
// MySQL 연결
$connect=my_connect($host,$dbid,$dbpass,$dbname);
end_exe($connect);
if(!isset($_SESSION["p_id"]) || !isset($_SESSION["p_name"])){
  err_msg('회원 로그인 후 사용할 수 있습니다.');
}

$query = "select * from auct_master where anum=$anum";
$result = mysql_query($query, $connect);
$rows = mysql_fetch_array($result);
mysql_free_result($result);

if(!$rows){
  err_msg('경매 코드에 속하는 경매가 존재하지 않습니다.');
}

if($rows[end_chk]=='Y'){
  err_msg('이미 종료된 경매입니다.');
}

//일반 구매이면서 즉구가를 입력했을 경우
if($gb=='1' && ($rows[limit_type]=='1') && ($join_amt == $rows[limit_amt])){
  $gb = "2";
}

//즉시 구매일때
if($gb=='2'){
  
   $limit_cnt_1 = $rows[limit_cnt] + $join_cnt;
   if($limit_cnt_1 > $rows[total_cnt]){
     err_msg('현재 남아있는 수량이 신청수량보다 적습니다. 신청수량을 변경하세요.');
   }
   else{
      
	  //신청수량이 총 수량과 같을때 경매종료
	  if($limit_cnt_1 == $rows[total_cnt] ){
	    $end_qry = " , end_chk = 'Y' ";
	  }

	  $qry1 = "update auct_master set join_cnt  = join_cnt + $join_cnt ,
	                                  limit_cnt = limit_cnt + $join_cnt 
								      $end_qry
				where anum = '$anum' ";
	  $res1 = mysql_query($qry1,$connect);

	  if(!$res1){
	    err_msg('오류가 발생하였습니다. ');
	  }
	  else{
	     $qry2 = "insert into auct_master_join(auction_code_fk,join_gb,user_id,
		              amount,volume,join_created)
				  values('$anum','1','$_SESSION[p_id]','$join_amt',
						  '$join_cnt',now())";
		 $res2 = mysql_query($qry2,$connect);
	     
         if(!$res2){
	        err_msg('오류가 발생하였습니다.');
	     }
		 else{
			echo("
			   <script>
				window.alert('경매신청이 되었습니다. 확인은 경매기록에서 가능합니다.')
			   </script>
			");
		    echo "<meta http-equiv='Refresh' content='0; URL=auct_details.php?anum=$anum'>"; 
		 }
	  }
   }
}
else {  //일반일때
  
    //신청가와 입찰최소 단위가 같을때 현재가를 신청가로 합니다.
    if($join_amt_1 == $join_amt){
      $join_amt_qry = " , curr_amt = '$join_amt' ";
    }
   
    $qry1 = "update auct_master set join_cnt  = join_cnt + $join_cnt
	                                $join_amt_qry 
			where anum = '$anum' ";
    $res1 = mysql_query($qry1,$connect);

	if(!$res1){
	   err_msg('오류가 발생하였습니다. ');
	}
	else{
	    $qry2 = "insert into auct_master_join(auction_code_fk,join_gb,user_id,
		              amount,volume,join_created)
		  	     values('$anum','2','$_SESSION[p_id]','$join_amt',
						  '$join_cnt',now())";
   	    $res2 = mysql_query($qry2,$connect);
	     
        if(!$res2){
	        err_msg('오류가 발생하였습니다.');
	    }
		else{
			echo("
			   <script>
				window.alert('경매신청이 되었습니다. 확인은 경매기록에서 가능합니다.')
			   </script>
			");
		    echo "<meta http-equiv='Refresh' content='0; URL=auct_details.php?anum=$anum'>"; 
		}
    }
}
?>
