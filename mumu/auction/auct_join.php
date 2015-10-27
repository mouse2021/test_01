<?
include "../php/config.php";
// 각종 유틸함수
include "../php/util.php";
// MySQL 연결
$connect=my_connect($host,$dbid,$dbpass,$dbname);

//종료된 경매 업데이트
end_exe($connect);

if(!isset($_SESSION["p_id"]) || !isset($_SESSION["p_name"])){
  err_msg('회원 로그인 후 사용할 수 있습니다.');
}
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=euc-kr">
<title>PHPSAMPLE SITE</title>
<link rel="stylesheet" href="../common/global.css">
<script language="JavaScript" src="../common/global.js"></script>
<script language="JavaScript" src="../common/auction.js"></script>
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

if($rows[end_chk]=='Y'){
  err_msg('이미 종료된 경매입니다.');
}

$now_time = date('YmdH');

if($rows[auct_start] > $now_time){
   err_msg('아직 시작하지 않은 경매입니다. 경매 시작 후 입찰하여 주시기 바랍니다.');
}

if($rows[auct_end] <= $now_time){
  err_msg('경매가 종료되었습니다.');
}

$t_cnt = 0;
//초기 경매 시작가
$w_join_amt1 = $rows[start_amt];

//초기 입찰가는 경매시작가로 (입찰이 없을 경우 사용)
$w_join_amt = $w_join_amt1;

$query1 = "select * from auct_master_join
 		   where auction_code_fk='$anum'
	 	   order by join_gb asc , amount desc , jnum asc ";
$result1 = mysql_query($query1, $connect);
for($i=0; $rows1 = mysql_fetch_array($result1); $i++){
				   
  //즉시구매
  if($rows1[join_gb] =='1'){
	 if($t_cnt < $rows[total_cnt]) {
	   $font_gb = "1";   //낙찰
	 }
	 else{
	   $font_gb = "3";   //불가
	 }
  }
  else {  //일반 구매
     if($t_cnt < $rows[total_cnt]) {
		$font_gb = "2";   //낙찰가능
		$w_join_amt2 = $rows1[amount];
	 }
	 else{
	   $font_gb = "3";   //불가
	 }
  }
  $t_cnt = $t_cnt + $rows1[volume];

  //현재 남은 재고 보다 신청자가 적을 경우에는 입찰가능가를 시작가로 합니다.
  if($t_cnt < $rows[total_cnt]){
    $w_join_amt = $w_join_amt1;
  }
  else{  
    $w_join_amt = $w_join_amt2 + (int)$rows[join_amt]; 
  }
  
  // 아래쪽에서 보여주기 위해 배열에 값을 임시 저장합니다.
  $ary_1[$i] = $rows1[user_id];
  $ary_2[$i] = $font_gb;
  $ary_3[$i] = $rows1[join_created];
  $ary_4[$i] = $rows1[amount];
  $ary_5[$i] = $rows1[volume];
  $ary_6[$i] = $t_cnt;

}
mysql_free_result($result1);
?>
     <table width="645" border="0" cellspacing="0" cellpadding="0">
	   <form name="form1" method="post">
	   <input type="hidden" name="anum" value="<?=$anum?>">
	   <input type="hidden" name="gb" value="<?=$gb?>">
	   <input type="hidden" name="limit_type" value="<?=$rows[limit_type]?>">
	   <input type="hidden" name="limit_amt" value="<?=$rows[limit_amt]?>">
	   <tr> 
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
             <td width="80" height="26" class="line">경매마감일</td>
             <td class="line"> 
			 <?=substr($rows[auct_end],0,4)?>년
			 <?=substr($rows[auct_end],4,2)?>월
			 <?=substr($rows[auct_end],6,2)?>일
		     <?=substr($rows[auct_end],8,2)?>시  
			 </td>
			 <td width="80" height="26" class="line">판매개수</td>
             <td class="line"> 
			 <?=number_format($rows[total_cnt])?>개
			  </td>
            </tr>
			<tr> 
             <td width="80" height="26" class="line">현재가</td>
             <td class="line"> <?=number_format($rows[curr_amt])?>원</td>
			 <td width="80" height="26" class="line">즉시구매가</td>
             <td class="line"> <?=number_format($rows[limit_amt])?>원</td>
            </tr>			
			<tr> 
             <td width="80" height="26" class="line">입찰수량</td>
             <td class="line" colspan="3"> 
			  <input type="hidden" name="join_cnt_1" value="<?=($rows[total_cnt] - $rows[limit_cnt])?>">
			  <input type="text" name="join_cnt" size="3" onKeyUp="onlyNumber1(this)" value="1">개 
			  (최대 신청가능 수량 : <?=($rows[total_cnt] - $rows[limit_cnt])?> 개)

			 </td>
            </tr>			
			<tr> 
             <td width="80" height="26" class="line">입찰가격</td>
             <td class="line" colspan="3"> 
			<?
			  // 즉시구매일때
			  if($gb=='2'){
			?>
			<input type="text" name="join_amt" readonly size="7" onKeyUp="onlyNumber1(this)" value="<?=$rows[limit_amt]?>">원 
			<?
			  }
			  else{ //즉시구매가 아닐때
			 ?>
			  <input type="text" name="join_amt" size="7" onKeyUp="onlyNumber1(this)" value="<?=$w_join_amt?>">원 
			 <? } ?>
			  (최소 입찰 가능 금액 : <?=number_format($w_join_amt)?> 원 , 입찰단위 <?=number_format($rows[join_amt])?>)
			  <input type="hidden" name="join_amt_1" value="<?=$w_join_amt?>">
			 </td>
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
			    <b><a href="javascript:auct_send()">경매입찰</a></b> | 
			   <b><a href="javascript:history.go(-1)">이전페이지</a></b>
			   </td>
              </tr>
             </table>
		   </td>
		  </tr>
		  <tr>
		    <td>
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr bgcolor="#FFFFFF"> 
				   <td align="right" class="hanamii" colspan="7">
					구분 : <font color=red>낙찰자</font> | 
						   <font color=blue>낙찰자 가능자</font> 
				   </td>
				 </tr>
				  <tr bgcolor="CCCCCC"> 
				   <td align="center" class="hanamii">입찰자</td>
				   <td align="center" class="line2">입찰일자</td>
				   <td align="center" class="line2">입찰가격</td>
				   <td align="center" class="line2">입찰수량</td>
				   <td align="center" class="line2">누적수량</td>
				 </tr>
				<?
				
				$font_chr['1'] = "red";
				$font_chr['2'] = "blue";
				$font_chr['3'] = "black";

				for($i=0; $i < sizeof($ary_1); $i++){
				?>
				  <tr height="25"> 
				   <td align="center" class="hanamii">
					<font color="<?=$font_chr[$ary_2[$i]]?>"><?=$ary_1[$i]?></font>
				   </td>
				   <td align="center"  class="hanamii">
					<?=$ary_3[$i]?>
				   </td>
				   <td align="center" class="hanamii">
					<?=number_format($ary_4[$i])?> 원
				   </td>
				   <td align="center" class="hanamii">
					 <?=number_format($ary_5[$i])?> 개
				   </td>
				   <td align="center" class="hanamii">
					 <?=number_format($ary_6[$i])?> 개
				   </td>
				  </tr>
				<?
				 }  
				?>
				 </table>
			</td>
		  </tr>
        </table>		
	</td>
  </tr>
  </form>
</table>
</body>
</html>