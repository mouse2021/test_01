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
	  <form name=form1 method=post action="blog_brd_write_post.php">
	  <input type='hidden' name="b_id" value="<?=$b_id?>">
<?
  if($md=='edit'){

     $qry3 = "select * from blog_brd_list where user_id='$b_id' And
	                                            num = '$brd_num' ";
	 $res3 = mysql_query($qry3,$connect);
	 $rows3 = mysql_fetch_array($res3);
	 mysql_free_result($res3);
?>
    <input type='hidden' name="md" value="<?=$md?>">
    <input type='hidden' name="brd_num" value="<?=$brd_num?>">
<?
  }
?>
	  
	   <table width="100%" border="0" cellspacing="1" cellpadding="2">
        <tr> 
         <td colspan=2 class=line-t height=1 bgcolor="#e1e1e1"></td>
        </tr>
        <tr> 
         <td class=line-n colspan="2" height="30" valign="top" bgcolor="#EEECCC">��α� �з� ���</td>
       </tr>
       <tr> 
        <td class=line-n valign="top" bgcolor="f8f8f7"> 
         �з���</td>
        <td class="line"> 
         <input type="text" name="brd_title" value="<?=$rows3[brd_title]?>" size="15" class="InputStyle1">
        </td>
       </tr>
       <tr> 
        <td class=line-n valign="top" bgcolor="f8f8f7"> �Խù� �б� ����</td>
        <td class="line"> 
          <select name="brd_pow_1">
		    <option value="1" <? if($rows3[brd_pow_1]=='1') echo"selected"; ?> >����</option>
			<option value="2" <? if($rows3[brd_pow_1]=='2') echo"selected"; ?>>ȸ��</option>
			<option value="3" <? if($rows3[brd_pow_1]=='3') echo"selected"; ?>>��ȸ��</option>
		  </select>
        </td>        
       </tr>
	   <tr> 
        <td class=line-n valign="top" bgcolor="f8f8f7"> �ڸ�Ʈ ���� ����</td>
        <td class="line"> 
          <select name="brd_pow_2">
		    <option value="1" <? if($rows3[brd_pow_2]=='1') echo"selected"; ?> >����</option>
			<option value="2" <? if($rows3[brd_pow_2]=='2') echo"selected"; ?>>ȸ��</option>
			<option value="3" <? if($rows3[brd_pow_2]=='3') echo"selected"; ?>>��ȸ��</option>
		  </select>
        </td>        
       </tr>
       </table>
       <table width="100%" border="0" cellspacing="0" cellpadding="10">
         <tr> 
           <td align="center">
	         <a href="javascript:blog_brd_post()"><img src="../img/butn_ok.gif" border="0"></a>
		     <a href="javascript:history.go(-1)"><img src="../img/btn_cancel.gif" hspace="4" border="0"></a>
			 </td>
           </tr>
         </table>
	  </form>
	 <?  
     //����ڰ� ������ �κ�
     include '../include/blog_main_bt.php';  
     ?>
	</td>
  </tr>
</table>
</body>
</html>