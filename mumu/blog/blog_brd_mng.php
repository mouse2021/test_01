<?
include "../php/config.php";
// ���� ��ƿ�Լ�
include "../php/util.php";
// MySQL ����
$connect=my_connect($host,$dbid,$dbpass,$dbname);

if(!isset($_SESSION["p_id"]) || !isset($_SESSION["p_name"])){
  err_msg('ȸ�� �α��� �� ����� �� �ֽ��ϴ�.');
}

if($_SESSION[p_id] != $b_id){
  err_msg('������ ��αװ� �ƴմϴ�. ��α� ������ Ȯ���ϼ���.');
}

?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=euc-kr">
<title>PHPSAMPLE SITE</title>
<link rel="stylesheet" href="../common/global.css">
<script language="JavaScript" src="../common/global.js"></script>
<script language="JavaScript" src="../common/blog.js"></script>
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

      //���� �޴��� ���Ͽ��� �ҷ��ɴϴ�.
      include '../include/left_menu1.php';  
      ?>
    </td>
    <td width="728" valign="top" >
     <?  
     //����ڰ� ������ �κ�
     include '../include/blog_main_top.php';  
     ?>
	 <br>
     <table width="90%" border="0" cellspacing="0" cellpadding="6">
        <tr>
          <td align="right"> 
		    <a href="blog_write.php?b_id=<?=$b_id?>">�۾���</a> | 
            <a href="blog_mng_form.php?b_id=<?=$b_id?>">��α� �⺻���� ����</a> | 
			<b><a href="blog_brd_mng.php?b_id=<?=$b_id?>">��α� ����Ʈ ����</a></b>
		  </td>
        </tr>
      </table>
	  <table width="90%" border="0" cellspacing="1" cellpadding="2">
        <tr> 
         <td colspan=2 class=line-t height=1 bgcolor="#e1e1e1"></td>
        </tr>
        <tr> 
         <td class=line-n colspan="2" height="30" valign="top" bgcolor="#EEECCC">���� ��ϵ� �з�</td>
       </tr>
	  </table>
	  <br>
      <table width="90%" border="0" cellspacing="0" cellpadding="0">
	     <tr bgcolor="CCCCCC"> 
		   <td align="center" width="30" class="line2">��ȣ</td>
		   <td align="center" width="170" class="line2">��α� �з���</td>
           <td align="center" width="100" class="line2">�б� ����</td>
		   <td align="center" width="100" class="line2">���� ����</td>
		   <td align="center" width="100" class="line2">������</td>
		 </tr>
<?

$a_power_1['1'] ="����";
$a_power_1['2'] ="ȸ��";
$a_power_1['3'] ="��ȸ��";

$a_power_2['1'] ="����";
$a_power_2['2'] ="ȸ��";
$a_power_2['3'] ="��ȸ��";

$query2 = "select * from blog_brd_list where user_id = '$b_id' 
		  order by num desc ";
$result2 = mysql_query($query2, $connect);
for($i=0; $rows2 = mysql_fetch_array($result2); $i++){
?>
		 <tr> 
		   <td align="center" class="line"><?=($i+1)?></td>
		   <td align="center" class="line">
			  <a href="blog_brd_write.php?b_id=<?=$b_id?>&md=edit&brd_num=<?=$rows2[num]?>"><?=$rows2[brd_title]?></a>&nbsp;
		   </td>
		   <td align="center" class="line"><?=$a_power_1[$rows2[brd_pow_1]]?>&nbsp;</td>
		   <td align="center" class="line"><?=$a_power_2[$rows2[brd_pow_2]]?>&nbsp;</td>
		   <td align="center" class="line"><?=$rows2[brd_wdate]?>&nbsp;</td>
		  </tr>
    <?
	 }  
	 mysql_free_result($result2);
    ?>
       </table>
	   <table width="90%" border="0" cellspacing="1" cellpadding="2">
        <tr> 
         <td class=line-n height="30" valign="middle" bgcolor="#EEECCC">
		  <input type="button" name="�з�����" value="�з�����" onclick="location='blog_brd_write.php?b_id=<?=$b_id?>'">
		 </td>
       </tr>
	  </table>
	  <?  
     //����ڰ� ������ �κ�
     include '../include/blog_main_bt.php';  
     ?>
	</td>
  </tr>
</table>
</body>
</html>