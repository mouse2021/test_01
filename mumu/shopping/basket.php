<?
include "../php/config.php";
// ���� ��ƿ�Լ�
include "../php/util.php";
// MySQL ����
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
//��� �޴� �κ��� ���Ͽ��� �ҷ��ɴϴ�.
include '../include/top_menu.php';  
?>
<br>
<table style="border-width:1; border-style:solid;" border="0" cellpadding="0" cellspacing="0" width="938">
  <tr>
    <td width="210" height="376" valign="top">
	  <?  
      //���� �α��� �κ��� ���Ͽ��� �ҷ��ɴϴ�.
      include '../include/left_login.php';  

      //���θ��� ���� �޴��� ���Ͽ��� �ҷ��ɴϴ�.
      include '../include/left_menu2.php';  
      ?>
    </td>
    <td width="728" valign="top" >
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr> 
        <td height="30" style="padding:10 0 0 14px"><a href="/">Ȩ</a> 
          &gt; SHOPPING &gt; <a href="../shopping/shop_main.php">����Ȩ</a></td>
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
                <td align="center" class="line">��ٱ��Ͽ� ��ǰ�� �������� �ʽ��ϴ�. </td>
              </tr>
           </table>
<?
     }
	 else{
?>
            <table width="95%" border="0" cellspacing="0" cellpadding="0">
			  <tr bgcolor="EDEDED"> 
                <td colspan="2" align="center" class="line2"><strong><font color="#666666">��ǰ��</font></strong></td>
                <td width="1" class="line2"><img src="../img/line1.gif" width="1" height="23"></td>
                <td width="80" align="center" class="line2"><strong><font color="#666666">�ǸŰ�</font></strong></td>
                <td width="1" class="line2"><img src="../img/line1.gif" width="1" height="23"></td>
                <td width="120" align="center" class="line2"><strong><font color="#666666">����</font></strong></td>
                <td width="1" class="line2"><img src="../img/line1.gif" width="1" height="23"></td>
                <td width="90" align="center" class="line2"><strong><font color="#666666">�հ�</font></strong></td>
                <td width="1" align="center" class="line2"><img src="../img/line1.gif" width="1" height="23"></td>
                <td width="40" align="center" class="line2"><strong><font color="#666666">����</font></strong></td>
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
                <td width="30%"><strong>�� �����ݾ� :<font color="#AE3E0D"> <?=number_format($tot_money)?>��</font></strong></td>
              </tr>
            </table>
	<?
	if($total_count == 0){
        $go_purcharse = "javascript:alert('��ٱ��Ͽ� ��ǰ�� �����ϴ�.')";
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
