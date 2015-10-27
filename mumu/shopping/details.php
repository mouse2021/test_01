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
$query = "select * from products where num=$pnum";
$result = mysql_query($query, $connect);
$rows = mysql_fetch_array($result);
mysql_free_result($result);
?>
     <table width="645" border="0" cellspacing="0" cellpadding="0">
      <form name="products_info" method="post">
	    <input type="hidden" name="from" value="details">
	    <input type="hidden" name="pnum" value="<?=$pnum?>">    
		<input type='hidden' name='amount' value='<?=$rows[price]?>'>
	   <tr> 
        <td width="340" height="300" align="center" valign="bottom">
	  	 <img src="/upload/p_image/m/<?=$rows[prod_code]?>.<?=$rows[m_image_ty]?>" width="230" height="230" border="0" onerror="this.src='../img/noimage.gif'"><br>
         <?
		  if($rows[b_image]=='Y'){
		 ?>
           <a href="javascript:MM_openBrWindow('open_big_view.php?prod_code=<?=$rows[prod_code]?>&prod_ty=<?=$rows[b_image_ty]?>','','width=400,height=450,scrollbars=yes,resizable=yes')"><img src="../img/icon_zoom.gif" width="46" height="16" vspace="6" border="0"></a> 
         <?
		   }
		   else{
	  	 ?>
            <img src="../img/icon_zoom.gif" width="46" height="16" vspace="6" border="0"> 
         <? } ?>
        </td>
        <td valign="top"> <br>
          <table width="90%" border="0" cellspacing="0" cellpadding="0">
            <tr> 
             <td height="30" align="center" class="text5"><?=$rows[name]?></td>
            </tr>
            <tr> 
             <td height="5" bgcolor="#585858"></td>
            </tr>
           </table>
           <br> 
		   <table width="90%" border="0" cellspacing="0" cellpadding="0">
            <tr> 
             <td width="130" height="26" class="line">소비자 가격</td>
             <td class="line"> <s><?=number_format($rows[cust_price])?>원</s></td>
            </tr>
			<tr> 
             <td width="130" height="26" class="line">판매가격</td>
             <td class="line"> <?=number_format($rows[price])?>원</td>
            </tr>
            <tr> 
              <td height="26" class="line">적립금</td>
              <td class="line"> <?=number_format($rows[mileage])?> 포인트</td>
            </tr>
		<? 
		  if($rows[size]){
            $t_size = explode('|', $rows[size]);                    
		?>	
		    <tr> 
              <td height="26" class="line">옵션</font></td>
              <td class="line"> 
			   <select name=products_size>
	      <?
           for($i=0; $i<sizeof($t_size); $i++){
             if(trim($t_size[$i]) == $products_size){
                $selected = "selected";
             }else{
                $selected = "";
             }
          ?>
                <option value="<?=trim($t_size[$i])?>" <?echo($selected)?>><?=shortenStr(trim($t_size[$i]),24)?></option> 
        <?
		   }
		?>
               </select>            
		      </td>
             </tr>
      <?
		}
	  ?>      
	 	 	 <tr> 
               <td height="26" class="line">주문수량</font></td>
                <td valign="bottom" class="line"> 
			     <table width="100" border="0" cellspacing="0" cellpadding="0">
                  <tr> 
                   <td width="40">
				    <input name="products_count" value="1" onkeypress="is_number();" type="text" class="input3" size="4" maxlength="5">
				   </td>
                   <td width="16" valign="bottom">
					 <A href="javascript:num_plus(document.products_info);"><img src="../img/order_top.gif" width="9" height="9" border="0"></a><br> 
                     <A href="javascript:num_minus(document.products_info);"><img src="../img/order_down.gif" width="9" height="9" border="0"></a> 
                   </td>
                   <td>개</td>
                  </tr>
                 </table>
		 	    </td>
              </tr>
              <tr> 
                <td height="26" class="line">생산지</font></td>
                <td class="line"> <?=$rows[company]?></td>
              </tr>
              <tr> 
               <td height="20">&nbsp;</td>
               <td>&nbsp;</td>
              </tr>
             </table>
             <table width="90%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
               <td align="center">
			    <a href="javascript:goCart(this.products_info);"><img src="../img/bt_basket.gif" width="87" height="20" border="0"></a>&nbsp; 
                <a href="javascript:goOrder(this.products_info);"><img src="../img/bt_buy.gif" width="76" height="20" border="0"></a>
			   </td>
              </tr>
             </table></td>
              </tr>
            </table>
            <br> <table width="90%" border="0" cellpadding="0" cellspacing="0">
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
			</form>
          </table>
	</td>
  </tr>
</table>
</body>
</html>
