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
     <table width="100%" border="0" cellspacing="1" cellpadding="2">
      <tr> 
       <td class=line-t height=1 bgcolor="#e1e1e1"></td>
      <tr> 
	  <tr> 
       <td class=line-t height=20 bgcolor="#e1e1e1"> - �̺�Ʈ ��ǰ - </td>
      <tr> 
       <td width="100%" align=center>
		 <table width="99%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
          <?
		   $query1 = "select * from products 
		              where del_chk='N' and 
		                    option1_chk='Y' 
					  order by num desc limit 0,5";
		   $result1 = mysql_query($query1,$connect);
		   for($kk=0;$rows1=mysql_fetch_array($result1);$kk++){
		  ?>
           <td width="115" height="120" valign='top'>
 		    <table border='0'>
			 <tr>
			  <td align='center' valign='top' width="115" height="120">
			    <a href="details.php?pnum=<?=$rows1[num]?>&l_code=<?=$rows1[category_fk]?>"><img src="/upload/p_image/m/<?=$rows1[prod_code]?>.<?=$rows1[m_image_ty]?>" width="100" height="120" border="0" onerror="this.src='../img/noimage.gif'"></a>
		   	  </td>
		     </tr>
			 <tr>
			  <td class="hanamii" align=center>
               <?=stripslashes($rows1[name])?>&nbsp;
		      </td>
		     </tr>
			 <tr>
			  <td class="hanamii" align=center>
               <s><?=number_format($rows1[cust_price])?></s>&nbsp;
		      </td>
		     </tr>
			 <tr>
			  <td class="hanamii" align=center>
               <b><?=number_format($rows1[price])?></b>&nbsp;
		      </td>
		     </tr>
			</table>
		   </td>
          <? 
		   }
		   mysql_free_result($result1);
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
	   </td>
      </tr>
     </table>
	 <br>
	 <table width="100%" border="0" cellspacing="1" cellpadding="2">
      <tr> 
       <td class=line-t height=1 bgcolor="#e1e1e1"></td>
      <tr> 
	  <tr> 
       <td class=line-t height=20 bgcolor="#e1e1e1"> - �Ż�ǰ - </td>
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
			    <a href="details.php?pnum=<?=$rows2[num]?>&l_code=<?=$rows2[category_fk]?>"><img src="/upload/p_image/m/<?=$rows2[prod_code]?>.<?=$rows2[m_image_ty]?>" width="100" height="120" border="0" onerror="this.src='../img/noimage.gif'"></a>
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

	   </td>
      </tr>
     </table>
	</td>
  </tr>
</table>
</body>
</html>
