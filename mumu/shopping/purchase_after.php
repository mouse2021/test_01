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
<script language="JavaScript" src="../common/shopping.js"></script>
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
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr> 
        <td height="200" align=center style="padding:10 0 0 14px">
		<br>
            <strong>&quot; �̿��� �ּż� �����մϴ�.&quot;</strong><br>
         <br>
		</td>
      </tr>
     </table>
	 
	</td>
  </tr>
</table>
</body>
</html>
