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
            <b>��α� �⺻���� ����</b> | 
			<a href="blog_brd_mng.php?b_id=<?=$b_id?>">��α� ����Ʈ ����</a>
		  </td>
        </tr>
      </table>
	 <form name=form1 method=post action="blog_mng_post.php" enctype="multipart/form-data">
	  <input type='hidden' name="b_id" value="<?=$b_id?>">
	   <table width="100%" border="0" cellspacing="1" cellpadding="2">
        <tr> 
         <td colspan=2 class=line-t height=1 bgcolor="#e1e1e1"></td>
        </tr>
        <tr> 
         <td class=line-n colspan="2" height="30" valign="top" bgcolor="#EEECCC">�⺻��������</td>
       </tr>
	   <tr> 
         <td class=line-n valign="top" bgcolor="#f8f8f7">���̵�</td>
         <td class="line"> 
           <?=$b_id?>
		 </td>
       </tr>
       <tr> 
        <td class=line-n valign="top" bgcolor="f8f8f7"> 
         ��α׸�</td>
        <td class="line"> 
         <input type="text" name="blog_name" value="<?=$rows1[blog_name]?>" size="25" class="InputStyle1">
        </td>
       </tr>
	   <tr> 
        <td class=line-n valign="top" bgcolor="f8f8f7"> 
         �г���</td>
        <td class="line"> 
         <input type="text" name="nick_name" value="<?=$rows1[nick_name]?>" size="16" class="InputStyle1">
        </td>        
       </tr>
       <tr> 
        <td class=line-n valign="top" bgcolor="f8f8f7"> ��α� �Ұ�</td>
        <td class="line"> 
          <input type="text" name="blog_cont" value="<?=$rows1[blog_cont]?>" size="45" class="InputStyle1">
        </td>        
       </tr>
	   <tr> 
        <td class=line-n valign="top" bgcolor="f8f8f7"> ���� �Ұ�</td>
        <td class="line"> 
          <textarea name="my_profile" onkeyup="checklen(this,'250')" cols="50" rows="4"><?=stripslashes($rows1[my_profile])?></textarea>
		  <br> 250byte(�ѱ� 100�� ����)�� �Է��ϼ���.
        </td>        
       </tr>
	   <tr> 
         <td class=line-n valign="top" bgcolor="f8f8f7">������������</td>
         <td class="line"> 
           <input type="radio" name="view_chk" value="Y" <? if($rows1[view_chk]=='Y' || !$rows1[view_chk]) echo"checked"; ?>>����
           <input type="radio" name="view_chk" value="N" <? if($rows1[view_chk]=='N') echo"checked"; ?>>�����
         </td>         
        </tr>
        <tr> 
         <td class=line-n valign="top" bgcolor="f8f8f7">������</td>
         <td class="line"> <?=$rows1[blog_cdate]?> </td>         
        </tr>
        <tr> 
          <td class=line-n colspan="2" height="30" valign="top" bgcolor="#EEECCC">�����ΰ���</td>
        </tr>
        <tr> 
         <td class=line-n valign="top" bgcolor="f8f8f7">
         ǥ���̹���</td>
         <td class="line"> 
          <input type="file" name="blog_logo" size="30"><br>
    <? 
	   if ($rows1[blog_logo]=='Y'){
		 $p_image = "../upload/b_image/".$b_id."/blog_logo.".$rows1[blog_logo_ty];
		 echo"���� ��ϵ� �̹����� �ֽ��ϴ�. ";
	     echo"<input type='button' value='�̹�������' onclick=\"ShowImage('$p_image');\">";
		 echo" <input type='button' value='�̹�������' onclick=\"location='img_del.php?b_id=$b_id&img_code=blog_logo&img_ty=$rows1[blog_logo_ty]'\">";
	   }
	?>
         </td>         
        </tr>
		<tr> 
         <td class=line-n valign="top" bgcolor="f8f8f7">
         ��α� ��� ���</td>
         <td class="line"> 
           <input type="radio" name="title_bgtype" value="1" onclick="bg_change()" <? if($rows1[title_bgtype]=='1' || !$rows1[title_bgtype]) echo"checked"; ?>>�Ϲݻ���
           <input type="radio" name="title_bgtype" value="2" onclick="bg_change()" <? if($rows1[title_bgtype]=='2') echo"checked"; ?>>�̹���
         </td>         
        </tr>
		<tr> 
         <td class=line-n valign="top" bgcolor="f8f8f7">
         ��� �̹���</td>
         <td class="line"> 
           <input type="file" name="title_bgimg" size="30" ><br>
    <? 
	   if ($rows1[title_bgimg]=='Y'){
		 $p_image = "../upload/b_image/".$b_id."/title_bgimg.".$rows1[title_bgimg_ty];
		 echo"���� ��ϵ� �̹����� �ֽ��ϴ�. ";
	     echo"<input type='button' value='�̹�������' onclick=\"ShowImage('$p_image');\">";
		 echo" <input type='button' value='�̹�������' onclick=\"location='img_del.php?b_id=$b_id&img_code=title_bgimg&img_ty=$rows1[title_bgimg_ty]'\">";
	   }
	?>
         </td>         
        </tr>
		<tr> 
         <td class=line-n valign="top" bgcolor="f8f8f7">
         ��� ����</td>
         <td class="line"> 
           <input type="text" name="title_bgcolor" value="<?=$rows1[title_bgcolor]?>" size="10" maxlength="10" class="InputStyle1"> (���� ��� �⺻ : #FFFFFF )
         </td>         
        </tr>
		<tr> 
         <td class=line-n valign="top" bgcolor="f8f8f7">
         ���� ���ڻ�</td>
         <td class="line"> 
           <input type="text" name="box_bgcolor" value="<?=$rows1[box_bgcolor]?>" size="10" maxlength="10" class="InputStyle1"> (���� ��� �⺻ : #D7D7D7 )
         </td>         
        </tr>
        <tr> 
         <td class=line-n valign="top" bgcolor="f8f8f7">
         ���λ���̹���</td>
         <td class="line"> 
           <input type="file" name="main_img" size="30" ><br>
    <? 
	   if ($rows1[main_img]=='Y'){
		 $p_image = "../upload/b_image/".$b_id."/main_img.".$rows1[main_img_ty];
		 echo"���� ��ϵ� �̹����� �ֽ��ϴ�. ";
	     echo"<input type='button' value='�̹�������' onclick=\"ShowImage('$p_image');\">";
		 echo" <input type='button' value='�̹�������' onclick=\"location='img_del.php?b_id=$b_id&img_code=main_img&img_ty=$rows1[main_img_ty]'\">";
	   }
	?>
         </td>         
        </tr>
		<tr> 
        <td class=line-n valign="top" bgcolor="f8f8f7">��α� ��� HTML</td>
        <td class="line"> 
          <textarea name="main_text" cols="50" rows="8"><?=stripslashes($rows1[main_text])?></textarea>
        </td>        
       </tr>
	   <tr> 
        <td class=line-n valign="top" bgcolor="f8f8f7">��α� �ϴ� HTML</td>
        <td class="line"> 
          <textarea name="main_text_bt" cols="50" rows="8"><?=stripslashes($rows1[main_text_bt])?></textarea>
        </td>        
       </tr>
       </table>
       <table width="100%" border="0" cellspacing="0" cellpadding="10">
         <tr> 
           <td align="center">
	         <a href="javascript:blog_mng_edit()"><img src="../img/butn_ok.gif" border="0"></a>
		     <a href="/index.php"><img src="../img/btn_cancel.gif" hspace="4" border="0"></a>
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