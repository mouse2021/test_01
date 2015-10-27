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
        <td height="30" style="padding:10 0 0 14px"><a href="/">홈</a> 
          &gt; SHOPPING &gt; <a href="../shopping/shop_main.php">쇼핑홈</a></td>
      </tr>
     </table>
<?
    $query = "Select * From products p,products_cart c
	          Where c.user_sid='$_COOKIE[p_sid]' and
			 	    p.num=c.product_fk
			   Order by c.cart_id desc ";
     $result = mysql_query($query, $connect);
     $total_count = mysql_num_rows($result);
     
     $tot_money =0;
     $tot_mny1 = 0;

     if(!$total_count){
?>
           <table width="95%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center" class="line">장바구니에 상품이 존재하지 않습니다. </td>
              </tr>
           </table>
<?
     }
	 else{
?>
            <table width="95%" border="0" cellspacing="0" cellpadding="0">
			  <tr bgcolor="EDEDED"> 
                <td colspan="2" align="center" class="line2"><strong><font color="#666666">상품명</font></strong></td>
                <td width="1" class="line2"><img src="../img/line1.gif" width="1" height="23"></td>
                <td width="80" align="center" class="line2"><strong><font color="#666666">판매가</font></strong></td>
                <td width="1" class="line2"><img src="../img/line1.gif" width="1" height="23"></td>
                <td width="120" align="center" class="line2"><strong><font color="#666666">수량</font></strong></td>
                <td width="1" class="line2"><img src="../img/line1.gif" width="1" height="23"></td>
                <td width="90" align="center" class="line2"><strong><font color="#666666">합계</font></strong></td>
                <td width="1" align="center" class="line2"><img src="../img/line1.gif" width="1" height="23"></td>
                <td width="40" align="center" class="line2"><strong><font color="#666666">삭제</font></strong></td>
              </tr>
<?
      for($i=1; $row = mysql_fetch_array($result); $i++){
		 $s_tot = (int)$row[volume] * (int)$row[amount];
		 $tot_money = $tot_money + $s_tot; 
?>
            <form name='basket<?=$i?>' method='post' action="cart_update.php">
			<input type='hidden' name='from' value='basket'>
              <tr> 
                <td width="100" height="70" align="center" class="line"><a href="details.php?pnum=<?=$row[num]?>&l_code=<?=$row[category_fk]?>"><img src="/upload/p_image/s/<?=$row[prod_code]?>.<?=$row[s_image_ty]?>" width="50" height="50" border="0" onerror="this.src='../img/noimage.gif'"></a></td>
                <td class="line"><?=$row[name]?></td>
                <td valign="bottom" class="line"><img src="../img/line1.gif" width="1" height="23"></td>
                <td align="center" class="line"><?=number_format($row[amount])?></td>
                <td valign="bottom" class="line"><img src="../img/line1.gif" width="1" height="23"></td>
                <td align="center" class="line" >
				 <table border=0>
				  <tr>
				   <td>
				    <input name="products_count" maxlength="3" size="2" value="<?echo($row[volume])?>" style="BORDER-BOTTOM: 1px solid; BORDER-LEFT: 1px solid; BORDER-RIGHT: 1px solid; BORDER-TOP: 1px solid; COLOR: #666666;width:30 ;height:15">
				   </td>
				   <td>
				    <A href="javascript:num_plus(document.basket<?=$i?>);"><img src="../img/order_top.gif" width="9" height="9" border="0"></a><br> 
                    <A href="javascript:num_minus(document.basket<?=$i?>);"><img src="../img/order_down.gif" width="9" height="9" border="0"></a> 
				   </td>
				   <td>
				    <input type=hidden name='md' value='edit'>
					<input type=hidden name='cart_id' value='<?=$row[cart_id]?>'>
				    <input type=image src="../img/bt_change.gif" >
				   </td>
				  </tr>
				 </table>
				</td>
                <td valign="bottom" class="line"><img src="../img/line1.gif" width="1" height="23"></td>
                <td align="center" class="line"><?=number_format($s_tot)?></td>
                <td align="center" valign="bottom" class="line"><img src="../img/line1.gif" width="1" height="23"></td>
				<td align="center" class="line"><a href="cart_update.php?md=del&cart_id=<?=$row[cart_id]?>&from=basket"><img src="../img/bt_del.gif" width="14" height="13" border='0'></td>
              </tr>
			 </form>
   <? } ?>
            </table>
            <table width="95%" border="0" cellspacing="0" cellpadding="0">
              <tr bgcolor="#EBEDD3"> 
                <td width="70%" height="30" bgcolor="#EBEDD3">&nbsp;</td>
                <td width="30%"><strong>총 결제금액 :<font color="#AE3E0D"> <?=number_format($tot_money)?>원</font></strong></td>
              </tr>
            </table>
	<?
	if($total_count == 0){
        $go_purcharse = "javascript:alert('장바구니에 상품이 없습니다.')";
	}
	else{
         $go_purcharse = "purchase.php?from=basket";
	}
  ?>
			<table width="95%" border="0" cellspacing="0" cellpadding="0">
              <tr bgcolor="#FFFFFF"> 
                <td width="100%" height="30" align=center>&nbsp;
				<a href="<?=$go_purcharse?>"><img src="../img/bt_buy.gif" border="0" align="absmiddle"></a>
			    <a href="shop_main.php"><img src="../img/bt_cart1.gif" border="0"></a>
				</td>
              </tr>
            </table>
  <? 
    }
  ?>
	</td>
  </tr>
</table>
</body>
</html>
