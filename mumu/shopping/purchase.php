<?
include "../php/config.php";
// 각종 유틸함수
include "../php/util.php";
// MySQL 연결
$connect=my_connect($host,$dbid,$dbpass,$dbname);

if(!$_COOKIE[p_sid]){
  $SID = md5(uniqid(rand()));
  SetCookie("p_sid",$SID,0,"/");  
}
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=euc-kr">
<title>PHPSAMPLE SITE</title>
<link rel="stylesheet" href="../common/global.css">
<script language="JavaScript" src="../common/global.js"></script>
<script language="JavaScript" src="../common/shopping.js"></script>
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

      //쇼핑몰의 왼쪽 메뉴를 파일에서 불러옵니다.
      include '../include/left_menu2.php';  
      ?>
    </td>
    <td width="728" valign="top" >
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr> 
        <td style="padding:10 0 0 14px"><a href="/">홈</a> 
          &gt; SHOPPING &gt; <a href="../shopping/shop_main.php">쇼핑홈</a></td>
      </tr>
     </table>
     <table width="95%" border="0" cellspacing="0" cellpadding="0">
      <form name="purchase" method="post" action="purchase_post.php"> 
	   <tr bgcolor="EDEDED"> 
         <td align="center" class="line2">상품명</td>
         <td width="1" class="line2"><img src="../img/line1.gif" width="1" height="23"></td>
         <td width="100" align="center" class="line2">판매가</td>
         <td width="1" class="line2"><img src="../img/line1.gif" width="1" height="23"></td>
         <td width="80" align="center" class="line2">수량</td>
         <td width="1" class="line2"><img src="../img/line1.gif" width="1" height="23"></td>
         <td width="100" align="center" class="line2">합계</td>
        </tr>
<?
if($from == "detail"){
    $query = " select * from products p, products_cart c 
	           where user_sid='$_COOKIE[p_sid]' and 
				     p.num=c.product_fk  
			   order by c.cart_id desc limit 0,1";
}else if($from == "basket"){
    $query = "select * from products p, products_cart c 
	          where user_sid='$_COOKIE[p_sid]' and 
				    p.num=c.product_fk 
			  order by c.cart_id desc";
}
$result = mysql_query($query, $connect);
$jumun_tot = mysql_num_rows($result);
  
$sub_tot = 0;
$sub_point = 0;

for($i=0; $row = mysql_fetch_array($result); $i++){
  $s_tot = (int)$row[volume] * (int)$row[amount];
?>
      <tr> 
       <td height="40" align="center" class="line"><?=$row[name]?></td>
       <td valign="bottom" class="line"><img src="../img/line1.gif" width="1" height="23"></td>
       <td align="center" class="line"><?=number_format($row[amount])?></td>
       <td valign="bottom" class="line"><img src="../img/line1.gif" width="1" height="23"></td>
       <td align="center" class="line"><?=number_format($row[volume])?></td>
       <td valign="bottom" class="line"><img src="../img/line1.gif" width="1" height="23"></td>
       <td align="center" class="line"><?=number_format($s_tot)?> 원</td>
      </tr>
	  <input type="hidden" name="products_fk[]" value="<?=$row[num]?>">
      <input type="hidden" name="products_name[]" value="<?=$row[name]?>">
	  <input type="hidden" name="products_kind[]" value="<?=$row[p_size]?>">
      <input type="hidden" name="products_count[]" value="<?=$row[volume]?>">
	  <input type="hidden" name="products_price[]" value="<?=$row[amount]?>">
	  <input type="hidden" name="products_point[]" value="<?=$row[mileage]?>">
<? 
      $sub_tot = $sub_tot +  $s_tot;
	  $sub_point = $sub_point + (int)$row[mileage];
    } 
     // 배송비를 0으로
	 $trans_cost = 0; 
	 $last_cost = $sub_tot + $trans_cost;
?>
   </table>
   <input type="hidden" name="trans_cost" value="<?=$trans_cost?>">
   <input type="hidden" name="amount" value="<?=$last_cost?>">
   <table width="95%" border="0" cellspacing="0" cellpadding="0">
    <tr bgcolor="#EBEDD3"> 
     <td width="70%">&nbsp;</td>
     <td width="30%"><strong>총 주문금액 :<font color="#AE3E0D"> <?=number_format($last_cost)?>&nbsp;원</font></strong></td>
    </tr>
   </table>
   <br>
   <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr bgcolor="#CCCCCC"> 
     <td> -- 주문자 정보 --</td>
    </tr>
   </table><br>
   <?
	 if($_SESSION[p_id]){
	  $m_qry = "select * from member where id='$_SESSION[p_id]' ";
      $m_res = mysql_query($m_qry,$connect);
	  $ksh= mysql_fetch_array($m_res);

	  $resnumber = explode("-",$ksh[jnumber]);
	  $aphone = explode("-",$ksh[phone]);
	  $ahphone = explode("-",$ksh[mobile]);
	  $azipcode = explode("-",$ksh[zipcode]);
     }
   ?>
   <table width="88%" border="0" cellspacing="0" cellpadding="0">
    <tr> 
     <td width="14" class="line">&nbsp;</td>
     <td width="100" class="line">이름 : </td>
     <td class="line">
	  <input name="buyer_name" value="<?=$ksh[name]?>" type="text" class="input3" size="10">
	 </td>
    </tr>
    <tr> 
      <td class="line">&nbsp;</td>
      <td class="line">E-mail : </td>
      <td class="line">
	    <input name="buyer_email" value="<?=$ksh[email]?>" type="text" class="input3" size="30">
	  </td>
     </tr>
     <tr> 
      <td valign="top" class="line">&nbsp;</td>
      <td valign="top" class="line"><br> 주소 : </td>
      <td class="line"> 
	    <input name="buyer_zipcode01" value="<?=$azipcode[0]?>" type="text" class="input3" size="6">
        - 
        <input name="buyer_zipcode02" value="<?=$azipcode[1]?>" type="text" class="input3" size="6"> 
        <a href="javascript:ZipWindow('../member/zip_search.php',2)">우편번호 검색</a> 
        <br> <input name="buyer_address01" value="<?=$ksh[address1]?>" type="text" class="input3" size="30"> 
        <br> <input name="buyer_address02" value="<?=$ksh[address2]?>" type="text" class="input3" size="50"> 
	   </td>
     </tr>
     <tr> 
       <td class="line">&nbsp;</td>
       <td class="line">전화번호 : </td>
       <td class="line">
		 <input name="buyer_phone01" value="<?=$aphone[0]?>" type="text" class="input3" size="6"> - 
         <input name="buyer_phone02" value="<?=$aphone[1]?>" type="text" class="input3" size="6"> - 
         <input name="buyer_phone03" value="<?=$aphone[2]?>" type="text" class="input3" size="6">
	   </td>
      </tr>
      <tr> 
        <td class="line">&nbsp;</td>
        <td class="line">휴대전화 : </td>
        <td class="line">
		 <input name="buyer_hphone01" value="<?=$ahphone[0]?>" type="text" class="input3" size="6"> - 
         <input name="buyer_hphone02" value="<?=$ahphone[1]?>" type="text" class="input3" size="6"> - 
         <input name="buyer_hphone03" value="<?=$ahphone[2]?>" type="text" class="input3" size="6">
	    </td>
      </tr>
      <tr> 
       <td class="line">&nbsp;</td>
       <td class="line">주민등록번호 : </td>
       <td class="line">
	    <input name="buyer_resnumber01" value="<?=$resnumber[0]?>" type="text" class="input3" size="6"> - 
        <input name="buyer_resnumber02" value="<?=$resnumber[1]?>" type="text" class="input3" size="7">
	   </td>
      </tr>
     </table>
	 <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr> 
       <td align=center valign=middle> 
		 <input type="checkbox" name="equ" onclick="equalRecipient(this.purchase);"> 
           <font color="#CC3300">배송장소 정보가 위와 동일합니다.</font></td>
      </tr>
     </table>
	 <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr bgcolor="#CCCCCC"> 
     <td> -- 수령자 정보 --</td>
    </tr>
   </table>
     <table width="88%" border="0" cellspacing="0" cellpadding="0">
	  <tr> 
       <td width="14" class="line">&nbsp;</td>
       <td width="100" class="line">받으실 분 이름 : </td>
       <td class="line">
		  <input name="recipient_name" type="text" class="input3" size="10"></td>
      </tr>
      <tr> 
      <td valign="top" class="line">&nbsp;</td>
        <td valign="top" class="line"><br> 주소 : </td>
        <td class="line"> 
		 <input name="recipient_zipcode01" type="text" class="input3" size="6"> - 
         <input name="recipient_zipcode02" type="text" class="input3" size="6"> 
          <a href="javascript:ZipWindow('../member/zip_search.php',3)">우편번호 검색</a> 
          <br> <input name="recipient_address01" type="text" class="input3" size="30"> 
          <br> <input name="recipient_address02" type="text" class="input3" size="50"> 
		</td>
      </tr>
      <tr> 
       <td class="line">&nbsp;</td>
       <td class="line">전화번호 : </td>
       <td class="line">
	     <input name="recipient_phone01" type="text" class="input3" size="6"> - 
         <input name="recipient_phone02" type="text" class="input3" size="6"> - 
         <input name="recipient_phone03" type="text" class="input3" size="6">
	   </td>
      </tr>
      <tr> 
       <td class="line">&nbsp;</td>
       <td class="line">휴대전화 : </td>
       <td class="line">
	    <input name="recipient_hphone01" type="text" class="input3" size="6"> - 
        <input name="recipient_hphone02" type="text" class="input3" size="6"> - 
        <input name="recipient_hphone03" type="text" class="input3" size="6">
	   </td>
      </tr>
     </table> <br>
     <table width="88%" border="0" cellspacing="0" cellpadding="0">
      <tr> 
       <td class="line">&nbsp;결제방법 : </td>
        <td class="line"><input type="radio" name="pay_type" value="1" checked>
        온라인 입금</td>
        <td class="line">
		입금은행 :
	      <select name="bank_name" class="input4">
           <option>국민 111-22-333333</option>
          </select> <br>
		  입금일자 : 
	      <select name="deposit_year">
<?
for($i=1; $i<=10; $i++){
	$temp_year = 2000 + $i;
	if($temp_year == date(Y)){
		$select = "selected";
	}else{
		$select = "";
	}
?>
             <option value="<?echo($temp_year)?>" <?echo($select)?>>
		       <?echo($temp_year)?>년</option>
<?
}
?>
            </select>
            <select name="deposit_month">
<?
for($i=1; $i<=12; $i++){
	$temp_month = $i;
	if($temp_month == date(n)){
		$select = "selected";
	}else{
		$select = "";
	}
?>
             <option value="<?echo($temp_month)?>" <?echo($select)?>>
			 <?echo($temp_month)?>월</option>
<?
}
?>
           </select>
           <select name="deposit_day">
<?
for($i=1; $i<=31; $i++){
	$temp_day = $i;
	if($temp_day == date(j)){
		$select = "selected";
	}else{
		$select = "";
	}
?>
            <option value="<?echo($temp_day)?>" <?echo($select)?>>
		     <?echo($temp_day)?>일</option>
<?
}
?>
            </select>
	    </td>
      </tr>
      <tr bgcolor="#EEF8E9">
        <td class="line">  총 주문금액 : </td>
        <td valign="bottom" colspan="2" class="line">
		  &nbsp;<?=number_format($last_cost)?>원
		</td>
      </tr>
	<?
   if($_SESSION[p_id]){
	 $query3 = "select sum(mileage) as msum from mileage 
		       where id_fk='$_SESSION[p_id]' ";
     $result3 = mysql_query($query3, $connect);
     $ksh3 = mysql_fetch_array($result3);
     $total_sum = (int)$ksh3[msum];
   }
   else{
     $total_sum = "0";
   }
  ?>
       <tr bgcolor="#EEF8E9"> 
       <td class="line">&nbsp;적립금 : </td>
       <td class="line" colspan="2">
	    <input name="mileage_use" type="text" class="input3" value="0" onkeyup="mny_function()" size="10">
	    원 <font color="#CC3300">(사용가능금액 : <?=number_format($total_sum)?>원)</font></td>
     </tr>
     <tr bgcolor="#EEF8E9"> 
       <td class="line">실 결제금액 : </td>
       <td class="line" colspan="2"><input name="real_mny" type="text" value="<?=$last_cost?>" onfocus="mny_function()" class="input3" size="10" readonly>
        원</td>
     </tr>
	 <input type=hidden name=mileage_tot value="<?=$total_sum?>">
	 <input type=hidden name=mileage_add value="<?=$sub_point?>">
    </table><br>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr>
      <td height="45" align="center">
        &nbsp;<a href="javascript:sendOrder(this.purchase);"><img src="../img/bt_ok1.gif" border="0"></a> 
      </td>
     </tr>
    </table>
	</form>
	</td>
  </tr>
</table>
</body>
</html>
