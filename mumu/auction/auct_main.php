<?
include "../php/config.php";
// ���� ��ƿ�Լ�
include "../php/util.php";
// MySQL ����
$connect=my_connect($host,$dbid,$dbpass,$dbname);

//����� ��� ������Ʈ
end_exe($connect);
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

      //������α׷��� ���� �޴��� ���Ͽ��� �ҷ��ɴϴ�.
      include '../include/left_menu3.php';  
      ?>
    </td>
    <td width="728" valign="top" >
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr> 
        <td height="30" style="padding:10 0 0 14px"><a href="/">Ȩ</a> 
          &gt; <a href="../auction/auct_main.php">AUCTION</a> &gt; 
		  <a href="../auction/auct_main.php">���Ȩ</a></td>
      </tr>
     </table>
     <table width="100%" border="0" cellspacing="1" cellpadding="2">
      <tr> 
       <td class=line-t height=1 bgcolor="#e1e1e1"></td>
      <tr> 
	  <tr> 
       <td class=line-t height=20 bgcolor="#e1e1e1"> - ī�װ� - </td>
      <tr> 
       <td width="100%" align=center>
		 <table width="99%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
          <?
		   $query1 = "select * from auct_category
		              where cancel_chk='N' ";
		   $result1 = mysql_query($query1,$connect);
		   for($kk=1;$rows1=mysql_fetch_array($result1);$kk++){
		  ?>
           <td width="150" height="25" align='center' bgcolor="ECCCCCC">
 		    <a href="sub_list.php?l_code=<?=$rows1[code]?>"><?=$rows1[name]?></a>
		   </td>
          <? 
			  if(($kk % 4) == '0'){
          ?>
		  </tr>
		  <tr>
		  <?
		      }
		   }
		   mysql_free_result($result1);

		   $jj = ($kk - 1) % 4;

		   if($jj != '0'){
		     for($j =$jj ; $j < 4 ; $j++){
		  ?>
             <td width="150" height="25" align='center' bgcolor="ECCCCCC">&nbsp;</td>
		   <?
			  }
		   }
		   ?>
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
       <td class=line-t height=20 bgcolor="#e1e1e1"> - ���� �ö�� ��� - </td>
      <tr> 
       <td width="100%" align=center>
		 <table width="99%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
          <?
		   $now_date = date('YmdH');

		   $query2 = "select * from auct_master 
		              where auct_start <= $now_date And 
					        delete_chk='N' And 
							end_chk='N'
					  order by anum desc limit 0,5";
		   $result2 = mysql_query($query2,$connect);
		   for($kk=0;$rows2=mysql_fetch_array($result2);$kk++){
			  $prod_name = shortenStr($rows2[prod_name],15);
		  ?>
           <td width="115" height="120" valign='top'>
 		    <table border='0'>
			 <tr>
			  <td align='center' valign='top' width="115" height="120">
			  <?
			  if($rows2[prod_img]){
			  ?>
			    <a href="auct_details.php?anum=<?=$rows2[anum]?>&l_code=<?=$rows2[category_fk]?>"><img src="/upload/a_image/<?=$rows2[prod_img]?>" onerror="this.src='../img/noimage.gif'" width="100" height="120" border="0"></a>
		   	  <? } ?>
			  </td>
		     </tr>
			 <tr>
			  <td class="hanamii" align=center>
               <a href="auct_details.php?anum=<?=$rows2[anum]?>&l_code=<?=$rows2[category_fk]?>"><?=$prod_name?></a>
		      </td>
		     </tr>
			 <tr>
			  <td class="hanamii" align=center>
               ���۰� : <?=number_format($rows2[start_amt])?>��
		      </td>
		     </tr>
			 <tr>
			  <td class="hanamii" align=center>
               ���簡 : <?=number_format($rows2[curr_amt])?>��
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
	 <table width="100%" border="0" cellspacing="1" cellpadding="2">
      <tr> 
       <td class=line-t height=1 bgcolor="#e1e1e1"></td>
      <tr> 
	  <tr> 
       <td class=line-t height=20 bgcolor="#e1e1e1"> - ��Ʈ��ǰ - </td>
      <tr> 
       <td width="100%" align=center>
		 <table width="99%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
          <?
		   $query2 = "select * from auct_master 
		              where auct_start <= $now_date And 
					        delete_chk='N' And 
							end_chk='N' 
					  order by join_cnt desc limit 0,5";
		   $result2 = mysql_query($query2,$connect);
		   for($kk=0;$rows2=mysql_fetch_array($result2);$kk++){
			   $prod_name = shortenStr($rows2[prod_name],15);
		  ?>
           <td width="115" height="120" valign='top'>
 		    <table border='0'>
			 <tr>
			  <td align='center' valign='top' width="115" height="120">
			  <?
			  if($rows2[prod_img]){
			  ?>
			    <a href="auct_details.php?anum=<?=$rows2[anum]?>&l_code=<?=$rows2[category_fk]?>"><img src="/upload/a_image/<?=$rows2[prod_img]?>" onerror="this.src='../img/noimage.gif'" width="100" height="120" border="0"></a>
		   	  <? } ?>
			  </td>
		     </tr>
			 <tr>
			  <td class="hanamii" align=center>
               <a href="auct_details.php?anum=<?=$rows2[anum]?>&l_code=<?=$rows2[category_fk]?>"><?=$prod_name?></a>
		      </td>
		     </tr>
			 <tr>
			  <td class="hanamii" align=center>
               ���۰� : <?=number_format($rows2[start_amt])?>��
		      </td>
		     </tr>
			 <tr>
			  <td class="hanamii" align=center>
               ���簡 : <?=number_format($rows2[curr_amt])?>��
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
	</td>
  </tr>
</table>
</body>
</html>
