<?
include "../php/config.php";
// ���� ��ƿ�Լ�
include "../php/util.php";
// MySQL ����
$connect=my_connect($host,$dbid,$dbpass,$dbname);

if(!isset($_SESSION["p_id"]) || !isset($_SESSION["p_name"])){
  err_msg('ȸ�� �α��� �� ����� �� �ֽ��ϴ�.');
}

$query = "select * from blog_list where user_id ='$_SESSION[p_id]' ";
$result = mysql_query($query, $connect);
$rows = mysql_fetch_array($result);
mysql_free_result($result);

if($rows){
  err_msg('�̹� ������ ��αװ� �����Ǿ� �ֽ��ϴ�.');
}
else{

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
      include '../include/main_left.php';  
      ?>
    </td>
    <td width="728" valign="top" >
     
	 <form name=form1 method=post action="blog_create_post.php" enctype="multipart/form-data">
	   <table width="100%" border="0" cellspacing="1" cellpadding="2">
        <tr> 
         <td colspan=2 class=line-t height=1 bgcolor="#e1e1e1"></td>
        </tr>
        <tr> 
         <td class=line-n valign="top" bgcolor="#f8f8f7">���̵�</td>
         <td class="line"> 
           <?=$_SESSION[p_id]?>
		 </td>
       </tr>
       <tr> 
        <td class=line-n valign="top" bgcolor="f8f8f7"> 
         ��α׸�</td>
        <td class="line"> 
         <input type="text" name="blog_name" size="25" class="InputStyle1">
        </td>
       </tr>
	   <tr> 
        <td class=line-n valign="top" bgcolor="f8f8f7"> 
         �г���</td>
        <td class="line"> 
         <input type="text" name="nick_name" size="16" class="InputStyle1">
        </td>        
       </tr>
       <tr> 
        <td class=line-n valign="top" bgcolor="f8f8f7"> ��α� �Ұ�</td>
        <td class="line"> 
          <input type="text" name="blog_cont" size="45" class="InputStyle1">
        </td>        
       </tr>
       <tr> 
         <td class=line-n valign="top" bgcolor="f8f8f7">������</td>
         <td class="line"> 
           <?=date('Y-m-d H:i:s')?> 
         </td>         
        </tr>
        <tr> 
         <td class=line-n valign="top" bgcolor="f8f8f7">
         ǥ���̹���</td>
         <td class="line"> 
          <input type="file" name="t_image" size="30">
         </td>         
        </tr>
        <tr> 
         <td class=line-n valign="top" bgcolor="f8f8f7">������������</td>
         <td class="line"> 
           <input type="radio" name="view_chk" value="Y" checked>����
           <input type="radio" name="view_chk" value="N" >�����
         </td>         
        </tr>
       </table>
       <table width="100%" border="0" cellspacing="0" cellpadding="10">
         <tr> 
           <td align="center">
	         <a href="javascript:blog_created()"><img src="../img/butn_ok.gif" border="0"></a>
		     <a href="/index.php"><img src="../img/btn_cancel.gif" hspace="4" border="0"></a>
			 </td>
           </tr>
         </table>
	  </form>
	</td>
  </tr>
</table>
</body>
</html>
<? } ?>
