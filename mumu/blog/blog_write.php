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
		    <b>�۾���</b> | 
            <a href="blog_mng_form.php?b_id=<?=$b_id?>">��α� �⺻���� ����</a> | 
			<a href="blog_brd_mng.php?b_id=<?=$b_id?>">��α� ����Ʈ ����</a>
		  </td>
        </tr>
      </table>
	 <form name=form1 method=post action="blog_write_manager.php" enctype="multipart/form-data">
	  <input type='hidden' name="b_id" value="<?=$b_id?>">
	  <input type="hidden" name="md" value="insert">
	   <table width="100%" border="0" cellspacing="1" cellpadding="2">
       <tr> 
        <td class=line-n valign="top" bgcolor="f8f8f7"> 
         ��α� �з�</td>
        <td class="line"> 
         <select name="brd_list_fk">
		   <option value="">�����ϼ���</option>
 <?
   $query2 = "select * from blog_brd_list where user_id = '$b_id' 
	  	      order by num desc ";
   $result2 = mysql_query($query2, $connect);
   for($i=0; $rows2 = mysql_fetch_array($result2); $i++){
 ?>
          <option value="<?=$rows2[num]?>"><?=$rows2[brd_title]?></option>
<?
   }
   mysql_free_result($result2);
?>
		 </select>
        </td>
       </tr>
	   <tr> 
        <td class=line-n valign="top" bgcolor="f8f8f7"> 
         ����</td>
        <td class="line"> 
         <input type="text" name="title" size="35" class="InputStyle1">
        </td>        
       </tr>
	   <tr> 
         <td class=line-n valign="top" bgcolor="f8f8f7">
         �̹���÷��1</td>
         <td class="line"> 
          <input type="file" name="blog_img1" size="40" class="InputStyle1">
         </td>         
        </tr>
       <tr> 
       <tr> 
         <td class=line-n valign="top" bgcolor="f8f8f7">����1</td>
         <td class="line"> 
           <textarea name="contents_1" cols="60" rows="8" class="InputStyle1"></textarea>
         </td>         
        </tr>
		<tr> 
         <td class=line-n valign="top" bgcolor="f8f8f7">
         �̹���÷��2</td>
         <td class="line"> 
          <input type="file" name="blog_img2" size="40" class="InputStyle1">
         </td>         
        </tr>
       <tr> 
       <tr> 
         <td class=line-n valign="top" bgcolor="f8f8f7">����2</td>
         <td class="line"> 
           <textarea name="contents_2" cols="60" rows="8" class="InputStyle1"></textarea>
         </td>         
        </tr>
		<tr> 
         <td class=line-n valign="top" bgcolor="f8f8f7">
         �̹���÷��3</td>
         <td class="line"> 
          <input type="file" name="blog_img3" size="40" class="InputStyle1">
         </td>         
        </tr>
       <tr> 
       <tr> 
         <td class=line-n valign="top" bgcolor="f8f8f7">����3</td>
         <td class="line"> 
           <textarea name="contents_3" cols="60" rows="8" class="InputStyle1"></textarea>
         </td>         
        </tr>
		<tr> 
         <td class=line-n valign="top" bgcolor="f8f8f7">�ڸ�Ʈ��뿩��</td>
         <td class="line"> 
           <input type="radio" name="comm_chk" value="Y" checked>��� ���
           <input type="radio" name="comm_chk" value="N" >��� ��� ����
         </td>         
        </tr>
       </table>
       <table width="100%" border="0" cellspacing="0" cellpadding="10">
         <tr> 
           <td align="center">
	         <a href="javascript:blog_write_post()"><img src="../img/butn_ok.gif" border="0"></a>
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