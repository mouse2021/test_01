<?
include "../php/config.php";
// 각종 유틸함수
include "../php/util.php";
// MySQL 연결
$connect=my_connect($host,$dbid,$dbpass,$dbname);

//종료된 경매 업데이트
end_exe($connect);

?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=euc-kr">
<title>PHPSAMPLE SITE</title>
<link rel="stylesheet" href="../common/global.css">
<script language="JavaScript" src="../common/global.js"></script>
<script language="JavaScript" type="text/JavaScript">
<!--
function initObj() {
	var sys_time = document.all['systime_1'].value;
	var time = new Date(sys_time.substring(0,4), sys_time.substring(4,6) - 1, sys_time.substring(6,8), sys_time.substring(8,10), sys_time.substring(10,12), sys_time.substring(12,14));
	var to_time = document.all['totime_1'].value;
	var time2 = new Date(to_time.substring(0,4), to_time.substring(4,6) - 1, to_time.substring(6,8), to_time.substring(8,10), to_time.substring(10,12), to_time.substring(12,14));
	document.all['clock2_1'].value = time2 - time; 
  clock();
}

function clock() {
  document.all['clock2_1'].value = document.all['clock2_1'].value - 1000;
  var current_time = document.all['clock2_1'].value;
  var hh = Math.floor(((current_time)/1000/60/60));
  var m = Math.floor((((current_time)/1000/60/60) - hh)*60);
  var ss = Math.floor((((((current_time)/1000/60/60) - hh)*60) - m)*60);
  if(hh < 0 || m < 0 && ss < 0){
    document.all['clock1_1'].value = "경매가 마감되었습니다."; 
  }
  else{
   document.all['clock1_1'].value = hh + "시간 " + m + "분 " + ss + "초 남았습니다."; 
  }

 setTimeout("clock()", 1000);
}

//-->
</script>
</head>
<body>
<?  
//상단 메뉴 부분을 파일에서 불러옵니다.
include '../include/top_menu.php';  
?>
<br>
<table style="border-width:1; border-style:solid;" border="0" cellpadding="0" cellspacing="0" width="938">
  <tr>
    <td width="210" height="376" valign="top">
	  <?  
      //좌측 로그인 부분을 파일에서 불러옵니다.
      include '../include/left_login.php';  

      //경매프로그램의 왼쪽 메뉴를 파일에서 불러옵니다.
      include '../include/left_menu3.php';  
      ?>
    </td>
    <td width="728" valign="top" >
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr> 
        <td height="30" style="padding:10 0 0 14px"><a href="/">홈</a> 
          &gt; <a href="../auction/auct_main.php">AUCTION</a> &gt; 상세정보</a></td>
      </tr>
     </table>
<?
$query = "select * from auct_master where anum=$anum";
$result = mysql_query($query, $connect);
$rows = mysql_fetch_array($result);
mysql_free_result($result);

if(!$rows){
  err_msg('경매 코드에 속하는 경매가 존재하지 않습니다.');
}

$a_prod_type['1'] = "신상품";
$a_prod_type['2'] = "중고상품";

$a_as_type['Y'] = "AS가능";
$a_as_type['N'] = "AS불가능";

$a_limit_type['1'] = "즉시구매 사용";
$a_limit_type['2'] = "즉시구매 없음";

$a_trans_type['1'] = "택배 본인부담(착불)";
$a_trans_type['2'] = "택배 경매자부담";
$a_trans_type['3'] = "빠른우편";
$a_trans_type['4'] = "직접수령";

?>
     <table width="645" border="0" cellspacing="0" cellpadding="0">
	   <tr> 
        <td width="200" height="300" align="center" valign="middle">
	  	  <?
		  if($rows[prod_img]){
		    $a_size = getimagesize ("../upload/a_image/".$rows[prod_img]);
            $width = $a_size[0];
            $height = $a_size[1];
			if($width > 200){
			  $width = "200";
			}
			if($height > 200){
			  $height = "200";
			}
		 ?>
		   <img src="/upload/a_image/<?=$rows[prod_img]?>" width="<?=$width?>" height="<?=$height?>" onerror="this.src='../img/noimage.gif'">
		 <? 
	       }
		 ?>
        </td>
        <td valign="top"> <br>
          <table width="90%" border="0" cellspacing="0" cellpadding="0">
            <tr> 
             <td height="30" align="center" class="text5"><?=$rows[prod_name]?></td>
            </tr>
            <tr> 
             <td height="5" bgcolor="#585858"></td>
            </tr>
           </table>
           <br> 
		   <table width="90%" border="0" cellspacing="0" cellpadding="0">
            <tr> 
             <td width="80" height="26" class="line">기간</td>
             <td class="line"> 
             <?=substr($rows[auct_start],0,4)?>년
			 <?=substr($rows[auct_start],4,2)?>월
			 <?=substr($rows[auct_start],6,2)?>일
		     <?=substr($rows[auct_start],8,2)?>시 ~
			 <?=substr($rows[auct_end],0,4)?>년
			 <?=substr($rows[auct_end],4,2)?>월
			 <?=substr($rows[auct_end],6,2)?>일
		     <?=substr($rows[auct_end],8,2)?>시  
			 </td>
            </tr>
			<tr> 
             <td width="80" height="26" class="line">남은시간</td>
             <td class="line"> 
		<?
         if($rows[end_chk]=='Y'){
		?>
		      <font color=red><b>종료되었습니다.</b></font>
		<?
		 }
		 else{
			 $start_time = $rows[auct_start];
             $end_time   = $rows[auct_end];
              
			 $now_time = date('YmdH');
             if($start_time > $now_time){
			   echo"아직 시작되지 않은 경매입니다.";
			 }
			 else if($end_time <= $now_time){
			   echo"이미 종료된 경매입니다.";
			 }
			 else{
		    ?>
			  <form name="time" method="post">
			  <input size="30" name="clock1_1" value="" style="border:0; color:e30000;" readonly>
		     <?
			   $endtime = $rows[auct_end]."0000";
			   $systime = date('YmdHis');
		     ?>
			   <input type="hidden" name="clock2_1" value="<?=$endtime?>">
			   <input type="hidden" name="systime_1" value="<?=$systime?>">
			   <input type="hidden" name="totime_1" value="<?=$endtime?>">
			   <script> initObj(); </script>
			   </form>
		<?
			 }
		 }
		?>
			  </td>
            </tr>
			<tr> 
             <td width="80" height="26" class="line">경매 시작가격</td>
             <td class="line"> <?=number_format($rows[start_amt])?> 원</td>
            </tr>
			<tr> 
             <td width="80" height="26" class="line">현재가격</td>
             <td class="line"> <?=number_format($rows[curr_amt])?> 원</td>
            </tr>
			<?
			//즉시구매가 가능할때
			if($rows[limit_type] =='1' && ((int)$rows[limit_amt]) > 0){
			?>
            <tr> 
             <td width="80" height="26" class="line">즉시구매가</td>
             <td class="line"> <?=number_format($rows[limit_amt])?> 원 <a href="auct_join.php?anum=<?=$anum?>&gb=2"><b>즉시구매하기</b></a></td>
            </tr>
			<?
			}
			?>
			<tr> 
             <td width="80" height="26" class="line">총 판매수량</td>
             <td class="line"> <?=number_format($rows[total_cnt])?> 개</td>
            </tr>
			<tr> 
             <td width="80" height="26" class="line">입찰자수</td>
             <td class="line"> <?=number_format($rows[join_cnt])?> 개</td>
            </tr>
            </table>
          </td>
         </tr>
		 <tr>
		   <td align=center colspan="2">
		     <br>
		     <table width="90%" border="0" cellspacing="4" cellpadding="5">
              <tr> 
               <td align="center">
	<?
     if($rows[end_chk]=='Y'){
	     $go_join    = "javascript:alert('종료된 경매입니다.')";
		 $go_djoin   = "javascript:alert('종료된 경매입니다.')";
		 $go_concern = "javascript:alert('종료된 경매입니다.')";
	 }
	 else{
			if(!$_SESSION[p_id]){
				$go_join    = "javascript:alert('경매입찰은 로그인 후에 가능합니다.')";
				$go_djoin   = "javascript:alert('즉시구매는 로그인 후에 가능합니다.')";
				$go_concern = "javascript:alert('관심품목 등록은 로그인 후에 가능합니다.')";
				$go_board   = "auct_brd_list.php?anum=$anum";
			}
			else{
				 $go_join    = "auct_join.php?anum=$anum&gb=1";
				 $go_djoin   = "auct_join.php?anum=$anum&gb=2";
				 $go_concern = "auct_concern_post.php?anum=$anum";
				 $go_board   = "auct_brd_list.php?anum=$anum";
			}
	 }
  ?>   
			    <b><a href="<?=$go_join?>">경매입찰</a></b> | 
	<?
	//즉시구매가 가능할때
	if($rows[limit_type] =='1' && ((int)$rows[limit_amt]) > 0){
	?>
               <b><a href="<?=$go_djoin?>">즉시구매</a></b> |
	<?
	}
	?>
			   <b><a href="auct_join_list.php?anum=<?=$anum?>">경매기록</a></b> |
			   <b><a href="<?=$go_concern?>">관심품목 등록</a></b> | 
			   <b><a href="<?=$go_board?>">문의게시판</a></b>

			   </td>
              </tr>
             </table>
		   </td>
		  </tr>
        </table>
        <br> 
		<table width="90%" border="0" cellpadding="0" cellspacing="0">
          <tr> 
           <td bgcolor="F7F7F7">-- 물품 정보 --</td>
          </tr>
          <tr> 
            <td>
		      <table width="100%" border="1" cellspacing="0" cellpadding="10">
                <tr> 
			       <td width="100" align=center bgcolor=#CCCFFF>
				     판매자 거주지역
				   </td>
				   <td width="200" align=center>
				     <?=$rows[in_addr]?>
				   </td>
				   <td width="100" align=center bgcolor=#CCCFFF>
				     경매입찰 단위
				   </td>
				   <td width="200" align=center>
				     <?=number_format($rows[join_amt])?>원
				   </td>
			     </tr>
				 <tr> 
				   <td width="100" align=center bgcolor=#CCCFFF>
				     중고상품 유무
				   </td>
				   <td align=center>
				     <?=$a_prod_type[$rows[prod_type]]?>
				   </td>
				   <td width="100" align=center bgcolor=#CCCFFF>
				     판매 가능지역
				   </td>
				   <td align=center>
				     <?=$rows[addr]?> &nbsp;
				   </td>
				</tr>
				<tr> 
				   <td width="100" align=center bgcolor=#CCCFFF>
				     AS가능 여부
				   </td>
				   <td align=center>
				     <?=$a_as_type[$rows[as_type]]?>
				   </td>
				   <td width="100" align=center bgcolor=#CCCFFF>
				     운송방법
				   </td>
				   <td align=center>
				     <?=$a_trans_type[$rows[trans_type]]?> &nbsp;
				   </td>
				</tr>
		 	  </table>
		 	</td>
			<tr> 
              <td height="10">&nbsp;</td>
            </tr>
		    <tr> 
              <td bgcolor="F7F7F7">-- 상품 상세 정보 --</td>
            </tr>
            <tr> 
              <td>
		   	    <table width="100%" border="0" cellspacing="0" cellpadding="10">
                  <tr> 
                   <td>
	    	<?
			 if($rows[con_html] =='1'){
			    echo(stripslashes($rows[contents]));
			 }
			 else{
			    echo(nl2br(stripslashes($rows[contents])));
			  }
			?>
 	 	  	      </td>
                 </tr>
               </table>
			  </td>
            </tr>
        </table>
	</td>
  </tr>
</table>
</body>
</html>
