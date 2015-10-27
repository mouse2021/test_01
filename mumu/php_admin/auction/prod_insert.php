<?
include	"../../php/auth.php";
// 데이타베이스	연결정보 및	기타설정
include	"../../php/config.php";
// 각종	유틸함수
include	"../../php/util.php";
// MySQL 연결
$connect=my_connect($host,$dbid,$dbpass,$dbname);

if($s_image_name){
  $file_ext1 = substr(strrchr($s_image_name,"."), 1);
  if ($file_ext1 != 'jpg' && $file_ext1 != 'gif' && $file_ext1 != 'jpeg' && $file_ext1 != 'bmp' ){
	 err_msg("이미지 파일만 올릴 수 있습니다.");  
  }
  if (!$s_image_size) {
	 err_msg("지정한 파일이 없거나 파일 크기가 0KB입니다.");  
  }   
}

$s_year = sprintf("%04d",$s_year);     //자리수 맞추기
$s_month = sprintf("%02d",$s_month);   //자리수 맞추기
$s_day = sprintf("%02d",$s_day);       //자리수 맞추기
$s_time = sprintf("%02d",$s_time);     //자리수 맞추기
$start_date = $s_year.$s_month.$s_day.$s_time;

$e_year = sprintf("%04d",$e_year);     //자리수 맞추기
$e_month = sprintf("%02d",$e_month);   //자리수 맞추기
$e_day = sprintf("%02d",$e_day);       //자리수 맞추기
$e_time = sprintf("%02d",$e_time);     //자리수 맞추기
$end_date = $e_year.$e_month.$e_day.$e_time;

$now_date =date('YmdH');

if($start_date >= $end_date){
  err_msg('경매 시작시간보다 마감시간이 작거나 같습니다.');
}
if($now_date >= $end_date){
  err_msg('마감시간이 현재시간보다 작습니다.');
}

if($mode =='insert'){
  
  $savedir ="../../upload/a_image";

  if($s_image_name){
   copy($s_image, "$savedir/$s_image_name");
   unlink($s_image);
  }

   $prod_name = addslashes($prod_name);
   $contents = addslashes($contents);
   if($con_html=='2'){
     $contents = htmlspecialchars($contents);
     $contents = chop($contents);
   }

   $dbinsert1 = "insert into auct_master(
                      category_fk,prod_name,in_addr,phone,
					  addr,as_type,start_amt,limit_type,limit_amt,
                      join_amt,curr_amt,total_cnt,auct_start,
					  auct_end,trans_type,prod_img,con_html,
					  contents,reg_date )
				 values(
					  '$category_code_fk','$prod_name','$in_addr','$phone',
					  '$addr','$as_type','$start_amt','$limit_type',
					  '$limit_amt','$join_amt','$start_amt',
					  '$total_cnt','$start_date','$end_date','$trans_type',
					  '$s_image_name','$con_html','$contents',now() )";
   $result1 = mysql_query($dbinsert1,$connect);
  
   if($result1){    
	  echo("
       <script>
	    window.alert('성공적으로 경매물품이 등록되었습니다.')
	   </script>
	  ");
      echo "<meta http-equiv='Refresh' content='0; URL=prod_list.php?category_code_fk=$category_code_fk'>"; 
    }
   else{
	 err_msg('DB오류가 발생했습니다.');
   }
 }
 else if($mode =='update'){
    
  $query = "select * from auct_master where anum=$p_num";
  $result = mysql_query($query, $connect);
  $row = mysql_fetch_array($result);
  mysql_free_result($result);
  
  $q_chk = "select * from auct_master_join where auction_code_fk='$p_num' ";
  $q_res = mysql_query($q_chk,$connect);
  $q_rows = mysql_fetch_array($q_res);

  if($q_rows){
	 if(($row[start_amt] != $start_amt) || ($row[as_type] != $as_type)
		 || ($row[limit_amt] != $limit_amt) || ($row[limit_type] != $limit_type)) {
        err_msg('신청이 있는 경매건수에 대해서는 금액이나 AS유형 등의 정보를 변경할 수 없습니다.'); 
     }
  }
	  
  $savedir ="../../upload/a_image";

  if($s_image_name){
    copy($s_image, "$savedir/$s_image_name");
    unlink($s_image);
    $temp1_char = ", prod_img='$s_image_name' ";
  }

  $prod_name = addslashes($prod_name);
  $contents = addslashes($contents);
  if($con_html=='2'){
    $contents = htmlspecialchars($contents);
    $contents = chop($contents);
  }

   $dbinsert1 = "update auct_master set category_fk ='$category_code_fk',
                                        prod_name   ='$prod_name',
                                        in_addr     ='$in_addr',
									    phone       ='$phone',
									    addr        ='$addr',
									    as_type     ='$as_type',
									    start_amt   ='$start_amt',
									    curr_amt    ='$start_amt',
				                        limit_type  ='$limit_type',
                                        limit_amt   ='$limit_amt',
									    join_amt    ='$join_amt',
								        total_cnt   ='$total_cnt',
								        auct_start  ='$start_date',
								        auct_end    ='$end_date',
								        trans_type  ='$trans_type'								 
									    $temp1_char ,
				                        con_html    ='$con_html',
									    contents    ='$contents'
				  where anum='$p_num' ";
	$result1 = mysql_query($dbinsert1,$connect);
  
    if($result1) {    	 
     echo("
       <script>
	    window.alert('등록 내용이 성공적으로 수정되었습니다.')
	   </script>
	  ");
      echo "<meta http-equiv='Refresh' content='0; URL=prod_list.php?category_code_fk=$category_code_fk'>"; 
    }
    else{
     err_msg('DB오류가 발생했습니다.');
    }
 }
?>
