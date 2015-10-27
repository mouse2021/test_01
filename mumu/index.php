<?
include "php/config.php";
// 각종 유틸함수
include "php/util.php";
// MySQL 연결
$connect=my_connect($host,$dbid,$dbpass,$dbname);
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=euc-kr">
<title>PHPSAMPLE SITE</title>
<link rel="stylesheet" href="common/global.css">
<script language="JavaScript" src="common/global.js"></script>
</head>
<body>
<?  
//상단 메뉴 부분을 파일에서 불러옵니다.
include 'include/top_menu.php';  
?>
<br>
<table style="border-width:1; border-style:solid;" border="0" cellpadding="0" cellspacing="0" width="938">
  <tr>
    <td width="210" height="376" valign="top">
	  <?  
      //좌측 로그인 부분을 파일에서 불러옵니다.
      include 'include/left_login.php';  

      //메인의 왼쪽 메뉴를 파일에서 불러옵니다.
      include 'include/main_left.php';  
      ?>
    </td>
    <td width="728" height="376" valign="top" >
	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr> 
        <td height="30" style="padding:10 0 0 14px"><a href="/">PHP5 샘플예제</a> 
          &gt; <a href="/index.php">HOME</a> </td>
      </tr>
     </table>
     
	 <table width="100%" border="0" cellspacing="1" cellpadding="2">
	  <tr> 
       <td class=hanamii colspan="3" height=30 bgcolor="#CCCEEE"> - 신규 블로그 목록 - </td>
      <tr> 
      <tr bgcolor="CCCCCC"> 
       <td width="200" align="center" class="hanamii">블로그명</td>
	   <td width="250" align="center" class="hanamii">블로그소개</td>
       <td width="100" align="center" class="hanamii">생성일</td>
     </tr>
	<?
	$query1 = "select * from blog_list 		       
			  order by blog_cdate desc limit 0,5";
	$result1 = mysql_query($query1, $connect);
	for($i=0; $rows1 = mysql_fetch_array($result1); $i++){
	   $blog_cont = shortenStr($rows1[blog_cont],50)
	?>
      <tr> 
       <td align="center" class="hanamii"><a href="blog/blog_main.php?b_id=<?=$rows1[user_id]?>"><?=$rows1[blog_name]?></a></td>
       <td align="center" class="hanamii"><a href="blog/blog_main.php?b_id=<?=$rows1[user_id]?>"><?=$blog_cont?></a>&nbsp;</td>
       <td align="center" class="hanamii"><?=$rows1[blog_cdate]?></td>
      </tr>
    <?
	 }  
	 mysql_free_result($result1);
	 for($j = $i; $j < 5;$j++){
    ?>
	 <tr> 
       <td align="center" colspan="3" class="hanamii">&nbsp;</td>
      </tr>
	<? } ?>
     </table>
	 <br><br>

	 <table width="100%" border="0" cellspacing="1" cellpadding="2">
	  <tr> 
       <td class=hanamii height=30 bgcolor="#CCCEEE"> - 쇼핑몰 신상품 - </td>
      <tr> 
       <td width="100%" align=center>
		 <table width="99%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
          <?
		   $query2 = "select * from products 
		              where del_chk='N' and 
		                    option2_chk='Y' 
					  order by num desc limit 0,5";
		   $result2 = mysql_query($query2,$connect);
		   for($kk=0;$rows2=mysql_fetch_array($result2);$kk++){
		  ?>
           <td width="115" height="120" valign='top'>
 		    <table border='0'>
			 <tr>
			  <td align='center' valign='top' width="115" height="120">
			    <a href="shopping/details.php?pnum=<?=$rows2[num]?>&l_code=<?=$rows2[category_fk]?>"><img src="upload/p_image/m/<?=$rows2[prod_code]?>.<?=$rows2[m_image_ty]?>" width="100" height="120" border="0" onerror="this.src='img/noimage.gif'"></a>
		   	  </td>
		     </tr>
			 <tr>
			  <td class="hanamii" align=center>
               <?=stripslashes($rows2[name])?>&nbsp;
		      </td>
		     </tr>
			 <tr>
			  <td class="hanamii" align=center>
               <s><?=number_format($rows2[cust_price])?></s>&nbsp;
		      </td>
		     </tr>
			 <tr>
			  <td class="hanamii" align=center>
               <b><?=number_format($rows2[price])?></b>&nbsp;
		      </td>
		     </tr>
			</table>
		   </td>
          <? 
		   }
		   mysql_free_result($result2);
           for($j =$kk ; $j < 5 ; $j++){
		  ?>
           <td width="115" height="150">
		    <table border='0'>
			  <tr>
		       <td align='center'>&nbsp;</td>
			  </tr>
			  <tr>
			   <td align='center'>&nbsp;</td>
			  </tr>
			  <tr>
			   <td align='center'>&nbsp;</td>
			  </tr>
			  <tr>
			   <td align='center'>&nbsp;</td>
			  </tr>
		  	 </table>
		   </td>
		 <?  }  ?>
         </tr>
       </table>

	 <br><br>
	 <table width="100%" border="0" cellspacing="1" cellpadding="2">
      <tr> 
       <td class=hanamii height=30 bgcolor="#CCCEEE"> - 새로 올라온 경매 - </td>
      <tr> 
       <td width="100%" align=center>
		 <table width="99%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
          <?
		   $now_date = date('YmdH');

		   $query3 = "select * from auct_master 
		              where auct_start <= $now_date And 
					        delete_chk='N' And 
							end_chk='N'
					  order by anum desc limit 0,5";
		   $result3 = mysql_query($query3,$connect);
		   for($kk=0;$rows3=mysql_fetch_array($result3);$kk++){
			  $prod_name = shortenStr($rows3[prod_name],15);
		  ?>
           <td width="115" height="120" valign='top'>
 		    <table border='0'>
			 <tr>
			  <td align='center' valign='top' width="115" height="120">
			  <?
			  if($rows3[prod_img]){
			  ?>
			    <a href="auction/auct_details.php?anum=<?=$rows3[anum]?>&l_code=<?=$rows3[category_fk]?>"><img src="upload/a_image/<?=$rows3[prod_img]?>" onerror="this.src='img/noimage.gif'" width="100" height="120" border="0"></a>
		   	  <? } ?>
			  </td>
		     </tr>
			 <tr>
			  <td class="hanamii" align=center>
               <a href="auction/auct_details.php?anum=<?=$rows3[anum]?>&l_code=<?=$rows3[category_fk]?>"><?=$prod_name?></a>
		      </td>
		     </tr>
			 <tr>
			  <td class="hanamii" align=center>
               시작가 : <?=number_format($rows3[start_amt])?>원
		      </td>
		     </tr>
			 <tr>
			  <td class="hanamii" align=center>
               현재가 : <?=number_format($rows3[curr_amt])?>원
		      </td>
		     </tr>
			</table>
		   </td>
          <? 
		   }
		   mysql_free_result($result3);
           for($j =$kk ; $j < 5 ; $j++){
		  ?>
            <td width="115" height="150">
		     <table border='0'>
			  <tr>
		       <td align='center' >&nbsp;</td>
			  </tr>
			  <tr>
		       <td align='center' >&nbsp;</td>
			  </tr>
			  <tr>
			   <td align='center' >&nbsp;</td>
			  </tr>
			  <tr>
			   <td align='center' >&nbsp;</td>
			  </tr>
		  	 </table>
		    </td>
		   <?  }  ?>
           </tr>
          </table>

	   </td>
      </tr>
     </table>
     <b>
	</td>
  </tr>
</table>
</body>
</html>
