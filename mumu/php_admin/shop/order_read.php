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
<table width='100%' border='0'>
 <tr>
  <td valign='top'>
<?
$sql = "select * from mall_order where num = '$oid' ";
$res = mysql_query($sql,$connect);
$ksh1 = mysql_fetch_array($res);

$a_goods_fk = explode("|", $ksh1[goods_fk]);
$a_price = explode("|", $ksh1[goods_price]);
$a_volume = explode("|", $ksh1[goods_count]);

$temp .= "<table border='0' width='100%'>
			<tr bgcolor='#cbe2f5'>	
				<td align='center' >이미지</td>
				<td align='center' >상품명</td>
				<td align='center' >제조사</td>
				<td align='center' >수량</td>
				<td align='center' >가격</td>
			</tr>
";

 //물건 정보를 불러옵니다.
for($i=0; $i<sizeof($a_goods_fk); $i++){
   $sql_5="select * from products where num='$a_goods_fk[$i]'";
   $result_5 = mysql_query($sql_5, $connect);
   $row_5 = mysql_fetch_array($result_5);

   $goods_name= shortenStr($row_5[name],20);
   $img_char = "../../upload/p_image/s/".$row_5[prod_code].".".$row_5[s_image_ty];

$temp .= "
		<tr>
		  <td align='center' class='hanamii'><img border=0 height=50 src='$img_char' width=50></td>
          <td align='center' class='hanamii'>$goods_name</td>
		  <td align='center' class='hanamii'>$row_5[company]</td>
		  <td align='center' class='hanamii'>&nbsp;$a_volume[$i]</td>
		  <td align='center' class='hanamii'>&nbsp;$a_price[$i]원</td>
		</tr>
	";
	
	$tot_amount = $tot_amount + ((int)$a_price[$i] * (int)$a_volume[$i]);
	$t_count = $t_count + (int)$a_volume[$i];
	
}
 
 $trans_cost = 0;
 if($trans_cost > 0){
   $amount_o = $tot_amount + $trans_cost;
   $amount_temp = " ( $tot_amount 원 + $trans_cost 원 ) ";
 }
 else{
   $amount_o = $tot_amount;
 }

 $temp .= "
    <tr bgcolor='#ece2f5'>
        <td colspan=3 align='right' class='hanamii'>합계 : </td>
		<td align='center' class='hanamii'><font color=blue>$t_count</font>개</td>
		<td align='center' class='hanamii'><font color=blue>$tot_amount</font> 원</td>
	</tr>
 	";
		
 $temp .= "</table>";

if($ksh1[payment_type]==1) { $payment_type = "무통장 입금"; }
if($ksh1[payment_type]==2) { $payment_type = "신용카드"; }
if($ksh1[payment_type]==2) { $payment_type = "휴대폰 결제"; }


$a_status['3'] = "입금확인전"; 
$a_status['5'] = "입금확인"; 
$a_status['7'] = "배송중"; 
$a_status['8'] = "배송완료"; 
?>

  <table width='94%' border='0' cellspacing='2' cellpadding='1' >
   <tr> 
    <td height='25' align='center' >
	 <b>주문 상세 내역 ( <font color='red' ><?=$oid?></font> )</b></td>
   </tr>
  </table>
  <table width='94%' border='0' cellspacing='0' cellpadding='0'>
    <tr bgcolor='#3a9edf'> 
     <td > 
	<table width='100%' border='0' cellspacing='1' cellpadding='3'>
	<tr bgcolor='#cbe2f5'> 
	 <td  class='hanamii' align='center' height='20'><b>주문내역</b></td>
	 <td  class='hanamii' align='left' colspan=3 bgcolor='white'><?=$temp?></td>
	</tr>
	<tr bgcolor='#cbe2f5'> 
	 <td  class='hanamii' align='center' width='100' ><b>주문번호</b></td>
	 <td  class='hanamii' align='center' bgcolor='white'><?=$ksh1[orderid]?></td>
	 <td  class='hanamii' align='center' width='100' ><b>구매일자</b></td>
	 <td  class='hanamii' align='center' bgcolor='white' ><?=$ksh1[createdate]?></td>
    </tr>
    <tr bgcolor='#cbe2f5'> 
     <td  class='hanamii' align='center' width='100' ><b>구매자</b></td>
     <td  class='hanamii' align='left' valign='top' bgcolor='white'>
	  	구매자명 : <?=$ksh1[buyer_name]?> <br>
	   	우편번호 : <?=$ksh1[buyer_zipno]?> <br>
	   	연락주소 : <?=$ksh1[buyer_address]?> <br>
	   	연락번호 : <?=$ksh1[buyer_phone]?> <br>
		휴대폰 : <?=$ksh1[buyer_hphone]?> <br>
	   	E-mail : <a href='mailto:<?=$ksh1[buyer_email]?>'>
		(메일 전송)▶ <?=$ksh1[buyer_email]?></a>
     </td>
     <td  class='hanamii' align='center' width='100' ><b>수령자</b></td>
     <td  class='hanamii' align='left' valign='top' bgcolor='white'>	
    	수령자명 : <?=$ksh1[recipient_name]?> <br>
    	우편번호 : <?=$ksh1[recipient_zipno]?> <br>
    	연락주소 : <?=$ksh1[recipient_address]?> <br>
    	연락번호 : <?=$ksh1[recipient_phone]?> <br>
		휴대폰 : <?=$ksh1[recipient_hphone]?> 
	 </td>
    </tr>
    <tr bgcolor='#cbe2f5'> 
	 <td  class='hanamii' align='center' height='20'><b>ID 정보</b></td>
	 <td  class='hanamii' bgcolor='white' colspan='3'><?=$ksh1[user_id]?></td>
   </tr>
   <tr bgcolor='#cbe2f5'> 
	<td  class='hanamii' align='center' height='20'><b>결제방법</b></td>
	<td  class='hanamii' align='center' bgcolor='white' ><?=$payment_type?></td>
	<td  class='hanamii' align='center' height='20'><b>구매금액</b></td>
	<td  class='hanamii' align='center' bgcolor='white' >
	  <?=number_format($ksh1[amount])?> 원 
	  (배송비 : <?=number_format($ksh1[trans_cost])?> 원)
	</td>
   </tr>
   <tr bgcolor='#cbe2f5'> 
	<td  class='hanamii' align='center' height='20'>
	  <b>포인트 사용</b>
	</td>
	<td  class='hanamii' align='center' bgcolor='white' >
	  <?=number_format($ksh1[mileage_use])?> 원
	</td>
	<td  class='hanamii' align='center' height='20'>
	  <b>포인트 적립</b>
	</td>
	<td  class='hanamii' align='center' bgcolor='white' >
	  <?=number_format($ksh1[mileage_add])?> 원
	</td>
   </tr>
   <tr bgcolor='#cbe2f5'> 
	<td  class='hanamii' align='center' height='20'><b>실 결제금액</b></td>
	<td  class='hanamii' colspan='3' bgcolor='white' >
	 <font color=red><b><?=number_format($ksh1[real_amount])?> 원</font></b>
    </td>
  </tr>
  <tr bgcolor='#cbe2f5'> 
    <td  class='hanamii' align='center' width='100' ><b>상태</b></td>
    <td  class='hanamii' align='center' bgcolor='white'>
	  <?=$a_status[$ksh1[status]]?>
    </td>
	<td  class='hanamii' align='center' width='100' ><b>상태변경</b></td>
	<td  class='hanamii' align='center' bgcolor='white'>
	  <a href='order_change.php?mode=1&oid=<?=$oid?>&status=<?=$ksh1[status]?>'
	    onClick="return confirm('선택 하시겠습니까?')">입금확인</a>/
	  <a href='order_change.php?mode=2&oid=<?=$oid?>&status=<?=$ksh1[status]?>'
	    onClick="return confirm('선택 하시겠습니까?')" >배송중</a>/ 
	  <a href='order_change.php?mode=3&oid=<?=$oid?>&status=<?=$ksh1[status]?>' 
	    onClick="return confirm('배송완료시 상품에 포인트가 있을 경우 마일리지로 적립되게 됩니다. 선택하시겠습니까?')" >배송완료</a> 
	</td>
   </tr>
   <?
   //무통장 입금시만 출력
   if($ksh[payment_type]=='1'){
   ?>
   <tr bgcolor='#cbe2f5'> 
	<td  class='hanamii' align='center' height='20'><b>입금은행명</b></td>
    <td  class='hanamii' align='center' bgcolor='white'><?=$ksh1[bank]?></td>
    <td  class='hanamii' align='center' width='100' ><b>입금자</b></td>
	<td  class='hanamii' align='center' colspan=3 ><?=$ksh1[account]?></td>
   </tr>
   <tr bgcolor='#cbe2f5'> 
	<td  class='hanamii' align='center' height='20'><b>입금예정일</b></td>
    <td  class='hanamii' colspan='3'  bgcolor='white'>&nbsp;&nbsp;&nbsp;<?=$ksh1[deposit_date]?></td>
   </tr>
  <?
   }
  ?>
  </table>
 </td>
</tr>
</table>
<table width='94%' border='0' cellspacing='2' cellpadding='1' >
    <tr> 
    <td height='25' align='left' ><a href='order_list.php?page=<?=$page?>'> <b>목록보기</b></a></td>
  </tr>
</table>
</td>
 </tr>
 </table>