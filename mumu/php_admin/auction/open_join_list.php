<?
include "../../php/config.php";
// 각종 유틸함수
include "../../php/util.php";
// MySQL 연결
$connect=my_connect($host,$dbid,$dbpass,$dbname);

?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=euc-kr">
<title>PHPSAMPLE SITE</title>
<link rel="stylesheet" href="../../common/global.css">
<script language="JavaScript" src="../../common/global.js"></script>
</head>
<body>

<table border="0" cellpadding="0" cellspacing="0" width="770">
  <tr>    
    <td width="770" valign="top" >
     <table width="770" border="0" cellspacing="0" cellpadding="0">
	   <tr> 
        <td valign="top"> 
          <table width="98%" border="0" cellspacing="0" cellpadding="0">
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
       </table>		
	</td>
  </tr>
</table>
</body>
</html>
