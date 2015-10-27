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
<script language="JavaScript" type="text/JavaScript">
<!--

function price_comparison(){
  var form = document.form1;
  var b=0;
     for (i=0; i < form.elements.length; i++) {
		 if (form.elements[i].name =="prod_num[]") {
            if (form.elements[i].checked == true) {
			  b++;
			 }
	     }
	 }
	
	if(b == 0) {
	 alert("적어도 하나의 항목은 선택하셔야 합니다.");
	     return;
     }

   form.action="sub_comparison.php";
   form.submit();
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
     <form name=form1 method='post'>
	 <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr> 
        <td width="10" bgcolor="#e1e1e1">&nbsp;</td>
        <td height="24" bgcolor="#e1e1e1">
	     <img src="../img/sp.gif" width="8" height="6"><strong>카테고리 : </strong>
	 <?
	    $c_qry = "select * from products_category2 where category_code_fk='$l_code' ";
        $c_res = mysql_query($c_qry, $connect);
		for($i=0; $c_row = mysql_fetch_array($c_res); $i++){
	 ?>
		<a href="sub_list.php?l_code=<?=$l_code?>&s_code=<?=$c_row[code]?>"><?=$c_row[name]?></a> |
		<?
		 }
	    ?>
		</td>
       </tr>
      </table>
      
<?
	//중분류 선택시
	if($s_code){
	  $s_code_qry = " and l_category_fk ='$s_code' ";
	}

	// 상품의 정보를 모두 가져옴
	$query = "select * from products 
			  where category_fk='$l_code' and del_chk='N' $s_code_qry ";
	$result = mysql_query($query, $connect);
	$total_bnum = mysql_num_rows($result);
	mysql_free_result($result);

	 if(!$page){
		$page = 1;
	 }

	  $p_scale=10;

	 $cpage = intval($page);
	 $totalpage = intval($total_bnum/$p_scale);
	  if ($totalpage*$p_scale != $total_bnum)
		$totalpage = $totalpage + 1;
		  
	  if ($cpage ==1) {
		  $cline = 0 ;
	  } else {
		  $cline = ($cpage*$p_scale) - $p_scale ;
	  } 
			
	   $limit=$cline+$p_scale;
			
	  if ($limit >= $total_bnum) 
			$limit=$total_bnum;

	  $p_scale1 = $limit - $cline;
?>
     <br>
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr bgcolor="CCCCCC"> 
       <td width="55" align="center" class="hanamii">선택</td>
       <td width="1" class="line2">
	    <img src="../img/line1.gif" width="1" height="23">
	   </td>
       <td colspan="2" align="center" class="line2">상품명</td>
       <td width="1" class="line2">
	     <img src="../img/line1.gif" width="1" height="23">
	   </td>
       <td width="90" align="center" class="line2">생산지</td>
	   <td width="1" class="line2">
	     <img src="../img/line1.gif" width="1" height="23">
	   </td>
       <td width="120" align="center" class="line2">가격/포인트</td>
     </tr>
<?
$query = "select * from products where category_fk='$l_code' 
                                       $s_code_qry and 
									   del_chk='N' 
		  order by num desc limit $cline,$p_scale1";
$result = mysql_query($query, $connect);
for($i=0; $rows = mysql_fetch_array($result); $i++){
?>
      <tr> 
       <td height="90" align="center" class="line">
		<input type="checkbox" name="prod_num[]" value="<?=$rows[num]?>"></td>
       <td valign="bottom" class="line"><img src="../img/line1.gif" width="1" height="23"></td>
       <td width="160" align="center" class="line">
	     <a href="details.php?pnum=<?=$rows[num]?>&l_code=<?=$l_code?>"><img src="/upload/p_image/s/<?=$rows[prod_code]?>.<?=$rows[s_image_ty]?>" width="80" height="80" border="0" onerror="this.src='../img/noimage.gif'"></a>
	   </td>
       <td class="line">
	     <a href="details.php?pnum=<?=$rows[num]?>&l_code=<?=$l_code?>"><?=$rows[name]?></a>
	   </td>
       <td valign="bottom" class="line"><img src="../img/line1.gif" width="1" height="23"></td>
       <td align="center" class="line"><?=$rows[company]?></td>
       <td valign="bottom" class="line"><img src="../img/line1.gif" width="1" height="23"></td>
       <td align="center" class="line"> 
	     <table border="0" cellspacing="0" cellpadding="0">
            <tr> 
             <td>
			     <img src="../img/icon3.gif" width="11" height="11"> 
                 <font color="#955275"><s><?=number_format($rows[cust_price])?>원</s></font>
			  </td>
             </tr>
			<tr> 
             <td>
			     <img src="../img/icon3.gif" width="11" height="11"> 
                 <font color="#955275"><?=number_format($rows[price])?>원</font>
			  </td>
             </tr>
             <tr> 
                <td><strong><img src="../img/icon4.gif" width="11" height="11"></strong> 
                 <?=number_format($rows[mileage])?>포인트 </td>
            </tr>
          </table>
		</td>
        <td valign="bottom" class="line"><img src="../img/line1.gif" width="1" height="23"></td>
      </tr>
    <?
	 }  
	 mysql_free_result($result);
    ?>
     </table>
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
       <tr> 
         <td width="60" height="36"><a href="javascript:price_comparison()"><img src="../img/bt1.gif" width="48" height="20" hspace="4" border="0"></a></td>
         <td align="center">
	<?
	//페이지 나누기
	$url = "sub_list.php?l_code=$l_code&s_code=$s_code"; 
    page_avg($totalpage,$cpage,$url); 
    ?>   			
	      </td>
          <td width="60">&nbsp;</td>
         </tr>
       </table>
	   </form>
	</td>
  </tr>
</table>
</body>
</html>
