<?
include "../php/config.php";
// 각종 유틸함수
include "../php/util.php";
// MySQL 연결
$connect=my_connect($host,$dbid,$dbpass,$dbname);

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
          &gt; <a href="../auction/auct_main.php">AUCTION</a> &gt; 경매기록</a></td>
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
?>
     <table width="645" border="0" cellspacing="0" cellpadding="0">
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
            </table>
          </td>
         </tr>
		  <tr>
		    <td>
			<br>
		  	 <table width="100%" border="0" cellspacing="0" cellpadding="0">
			    <tr bgcolor="#FFFFFF"> 
				   <td align="center" class="hanamii" colspan="7">
					<b>경매 기록 </b>
				   </td>
				 </tr>
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

				$t_cnt = 0;

				$query1 = "select * from auct_master_join
						   where auction_code_fk='$anum'
						   order by join_gb asc ,amount desc , jnum asc ";
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
					 }
					 else{
					   $font_gb = "3";   //불가
					 }
				   }

				   $t_cnt = $t_cnt + $rows1[volume];
				   
				?>
				  <tr height="25"> 
				   <td align="center" class="hanamii">
					<font color="<?=$font_chr[$font_gb]?>"><?=$rows1[user_id]?></font>
				   </td>
				   <td align="center" class="hanamii">
					<?=$rows1[join_created]?>
				   </td>
				   <td align="center" class="hanamii">
					<?=number_format($rows1[amount])?> 원
				   </td>
				   <td align="center" class="hanamii">
					 <?=number_format($rows1[volume])?> 개
				   </td>
				   <td align="center" class="hanamii">
					 <?=number_format($t_cnt)?> 개
				   </td>
				  </tr>
				<?
				 }  
				 mysql_free_result($result1);
				?>
				 </table>
			</td>
		  </tr>
	<?
     if($rows[end_chk]=='Y'){
	     $go_join    = "javascript:alert('종료된 경매입니다.')";
	 }
	 else{
			if(!$_SESSION[p_id]){
				$go_join    = "javascript:alert('경매입찰은 로그인 후에 가능합니다.')";
			}
			else{
				 $go_join    = "auct_join.php?anum=$anum&gb=1";
			}
	 }
  ?>   
		  <tr>
		   <td align=center colspan="2">
		     <br>
		     <table width="90%" border="0" cellspacing="4" cellpadding="5">
              <tr> 
               <td align="center">
			    <b><a href="<?=$go_join?>">경매입찰</a></b> | 
			   <b><a href="auct_details.php?anum=<?=$anum?>">상세페이지</a></b>
			   </td>
              </tr>
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