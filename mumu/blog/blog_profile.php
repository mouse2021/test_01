<?
include "../php/config.php";
// ���� ��ƿ�Լ�
include "../php/util.php";
// MySQL ����
$connect=my_connect($host,$dbid,$dbpass,$dbname);
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

      //���� �޴��� ���Ͽ��� �ҷ��ɴϴ�.
      include '../include/left_menu1.php';  
      ?>
    </td>
    <td width="728" valign="top" >
     <?  
     //����ڰ� ������ �κ�
     include '../include/blog_main_top.php';  
     ?>
	 <br><br>
  <?
    //������϶�
    if(($b_id != $_SESSION[p_id]) && $rows1[view_chk] =='N'){
  ?>
     <table width="100%" border="0" cellspacing="1" cellpadding="2">
        <tr> 
         <td colspan=2 class=line-t height=1 bgcolor="#e1e1e1"></td>
        </tr>
        <tr> 
         <td class=line-n valign="middle" align=center height="300" bgcolor="#f8f8f7">
		   <?=$rows1[nick_name]?> ���� ������� �صξ����ϴ�.
		 </td>
       </tr>
	 </table>
 <?
	}
    else{
 ?>
    <table width="100%" border="0" cellspacing="1" cellpadding="2">
       <tr> 
        <td class=line-n valign="top" bgcolor="f8f8f7"> 
         ��α׸�</td>
        <td class="line"> 
		  <?=$rows1[blog_name]?>&nbsp;
        </td>
       </tr>
	   <tr> 
        <td class=line-n valign="top" bgcolor="f8f8f7"> 
         �г���</td>
        <td class="line"> 
         <?=$rows1[nick_name]?>&nbsp;
        </td>        
       </tr>
       <tr> 
        <td class=line-n valign="top" bgcolor="f8f8f7"> ��α� �Ұ�</td>
        <td class="line"> 
          <?=$rows1[blog_cont]?>&nbsp;
        </td>        
       </tr>
	   <tr> 
        <td class=line-n valign="top" bgcolor="f8f8f7"> ���� �Ұ�</td>
        <td class="line"> 
          <?=nl2br($rows1[my_profile])?>&nbsp;
        </td>        
       </tr>
       <tr> 
         <td class=line-n valign="top" bgcolor="f8f8f7">������</td>
         <td class="line"> 
           <?=$rows1[blog_cdate]?>&nbsp;
         </td>         
        </tr>
       </table>
 <? } ?>
     <?  
     //����ڰ� ������ �κ�
     include '../include/blog_main_bt.php';  
     ?>
	</td>
  </tr>
</table>
</body>
</html>

