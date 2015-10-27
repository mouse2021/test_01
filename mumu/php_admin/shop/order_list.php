<?
// 아파치 인증
include	"../../php/auth.php";
// 데이타베이스 연결정보 및 기타설정
include	"../../php/config.php";
// 각종	유틸함수
include	"../../php/util.php";
// MySQL 연결
$connect=my_connect($host,$dbid,$dbpass,$dbname);
?>
<html>
<head>
<title>PHPSAMPLE SITE</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link rel="stylesheet" href="../../common/global.css">
<script language="JavaScript" src="../../common/global.js"></script>
</head>

<body bgcolor="#FFFFFF" text="#000000">
<table width='780' border='0'>
 <tr>
  <td valign='top'>
  <form action='order_list.php' name='f' method='post' >  
<?
	// 자료 총수 구하기
	if ($mode=='search') {
	   $sql_2=" select orderid from mall_order 
				where cancel = 'N' and 
					  $key like '%$key_value%' "; 
	} 
	else {
	   $sql_2 = "select orderid from mall_order where cancel='N' "; 
	}
	$res_2 = mysql_query($sql_2,$connect);
	$total = mysql_num_rows($res_2);


   $scale=15;
   if ($page == ''){
      $page=1;
   }	    
   
   $cpage = intval($page);
   $totalpage = intval($total/$scale);
	
    if ($totalpage*$scale != $total)
  		$totalpage = $totalpage + 1;
        
    if ($cpage ==1) {
	  $cline = 0 ;
    } else {
 	  $cline = ($cpage*$scale) - $scale ;
    } 
        
     $limit=$cline+$scale;
       
     if ($limit >= $total) 
       	$limit=$total;

     $scale1 = $limit - $cline;
?>
  <table width='99%' border='0' cellspacing='2' cellpadding='1' >
    <tr> 
	<td height='25' align='center'><b><font color='blue' size='3'>상품주문 현황</a></b></td>
  </tr>
 </table>
 <table width="99%" border="0" cellspacing="0" cellpadding="0">
  <tr bgcolor="#3a9edf"> 
   <td > 
	<table width="100%" border="0" cellspacing="1" cellpadding="3">
	  <tr bgcolor="#cbe2f5"> 
	    <td align="center" height="20"><b>주문번호</b></td>
	    <td align="center"><b>ID</b></td>
	    <td align="center"><b>주문일</b></td>
	    <td align="center"><b>구매자</b></td>
	    <td align="center"><b>수령자</b></td>
	    <td align="center"><b>주문방식</b></td>
	    <td align="center"><b>주문액</b></td>
	    <td align="center"><b>처리상태</b></td>
	    <td align="center"><b>삭제</b></td>
	  </tr>
<?

if ($mode=='search') {
   $sql_4 = "select * from mall_order 
             where cancel = 'N' and 
				   $key like '%$key_value%' 
			 order by num desc LIMIT $cline,$scale1 "; 
} else {
   $sql_4 = "select * from mall_order where cancel = 'N' 
             order by num desc LIMIT $cline,$scale1 "; 
}

$a_pay_type['1'] = "무통장 입금";
$a_pay_type['2'] = "신용카드";
$a_pay_type['3'] = "휴대폰 결제";

$res_4 = mysql_query($sql_4,$connect);
for($i=0; $row = mysql_fetch_array($res_4); $i++){

	if($row[status]=='1'){
		$c_color='#FFFFFF'; 
		$status_now="입금확인전";
	}
	else if ($row[status]=='3'){ 
		$c_color='#FFFFFF'; 
		$status_now="입금확인전";
	}
	else if($row[status]=='5'){
		$c_color='#E0FFE0'; 
		$status_now="입금확인";
	}
	else if ($row[status]=='7'){ 
		$c_color='#EFFCFC';
		$status_now="배송중";
	}
	else if ($row[status]=='8'){ 
		$c_color='#FFFCCC'; 
		$status_now="배송완료";
	}
?>
  <tr bgcolor="<?=$c_color?>"> 
    <td align='center' ><a href='order_read.php?oid=<?=$row[num]?>&page=<?=$page?>'><?=$row[orderid]?></a></td>
    <td align='center' ><?=$row[user_id]?></td>
    <td align='center' ><?=$row[createdate]?></td>
    <td align='center'><?=$row[buyer_name]?></td>
    <td align='center'><?=$row[recipient_name]?></td>
    <td align='center' ><?=$a_pay_type[$row[payment_type]]?> </td>
    <td align='center' ><?=$row[amount]?> 원</td>
    <td align='center' ><?=$status_now?> </td>
	<td align='center'><a href='order_delete.php?oid=<?=$row[num]?>&page=<?=$page?>&pay_type=<?=$row[pay_type]?>' onClick="return confirm('정말 주문 취소하시겠습니까?')">삭제</a></td>
	  </tr>
 <? 
  }
 ?>
   <tr bgcolor="#f2f9ff" > 
    <td  colspan="10"> 
     <table width="100%" border="0" cellspacing="0" cellpadding="2">
 	  <tr> 
	   <td  align="center" >	
     <?
	  $url = "$PHP_SELF?mode=$mode&key=$key&key_value=$key_value"; 
      page_avg($totalpage,$cpage,$url); 
	?>
      </td>
	 </tr>
	</table>
   </td>
  </tr>
  <tr bgcolor="#cbe2f5"> 
   <td  colspan="10" align='left' > 
	<select name='key'>
	<option value='user_id'>아이디</option>
	<option value='buyer_name'>구매자명</option>
	<option value='orderid'>상품코드</option>
	</select>
	<input type='hidden' name='mode' value='search'>
	<input type='text' name='key_value' size='16' class=input>
	<input type='submit' name='submit' value='검색'  class=submit>	 
   </td>
  </tr>
 </table>
</td>
</tr>
 </table>
  </CENTER>
</form>
</td>
 </tr>
 </table>
</body>
</html>