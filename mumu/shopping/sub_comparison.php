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
          &gt; SHOPPING &gt; <a href="shop_main.php">쇼핑홈</a></td>
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
	     for($i=0;$i < sizeof($prod_num);$i++){
		   if($prod_num[$i]){

		     $qry = "select * from products where num='$prod_num[$i]' ";
			 $res = mysql_query($qry,$connect);
			 $rows = mysql_fetch_array($res);
	  ?>
	  <table width="645" border="0" cellspacing="0" cellpadding="0">
       <tr> 
         <td width="340" height="300" align="center"><img src="/upload/p_image/m/<?=$rows[prod_code]?>.<?=$rows[m_image_ty]?>" width="240" height="240" border="0" onerror="this.src='../img/noimage.gif'"><br> 
        <?
	      if($rows[b_image]=='Y'){
	    ?>
	     <a href="javascript:MM_openBrWindow('open_big_view.php?prod_code=<?=$rows[prod_code]?>&prod_ty=<?=$rows[b_image_ty]?>','','width=400,height=450')"><img src="../img/icon_zoom.gif" width="46" height="16" border="0"></a>
	    <?
	     }
		 else{
		?>
		   <img src="../img/icon_zoom.gif" width="46" height="16" border="0"> 
		<? } ?>
		  </td>
          <td valign="top"> 
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
             <tr> 
               <td height="26" class="line"> 제조사</td>
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
				  <a href="details.php?pnum=<?=$rows[num]?>&l_code=<?=$rows[category_fk]?>"><img src='../img/bt_go2.gif' border=0></a>
				  <a href="javascript:history.go(-1)"><img src='../img/bt_back2.gif' border=0></a>
	           </td>
             </tr>
            </table>
	   	  </td>
         </tr>
        </table>
       <br> 
	  <?
	    }
      }
	  ?>
	</td>
  </tr>
</table>
</body>
</html>
