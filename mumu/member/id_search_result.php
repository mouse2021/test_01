<?
// ����Ÿ���̽� �������� �� ��Ÿ����
include "../php/config.php";
// ���� ��ƿ�Լ�
include "../php/util.php";
// MySQL ����
$connect=my_connect($host,$dbid,$dbpass,$dbname);

if(!$name || !$jumin1 || !$jumin2){
  err_msg('�������� �����ϼ���.');
}

$jnumber = $jumin1."-".$jumin2;

$query = "select * from member where name='$name' and jnumber='$jnumber' ";
$result = mysql_query($query,$connect);
$ksh = mysql_fetch_array($result);
mysql_free_result($result);

if(!$ksh){
  err_msg('�̸� �� �ֹι�ȣ�� ��ġ�ϴ� ������ �����ϴ�.');
}
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=euc-kr">
<title>PHPSAMPLE SITE</title>
<link rel="stylesheet" href="../common/global.css">
<script language="JavaScript" src="../common/global.js"></script>
<script language="JavaScript" src="../common/member.js"></script>
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

      //������ ���� �޴��� ���Ͽ��� �ҷ��ɴϴ�.
      include '../include/main_left.php';  
      ?>
    </td>
    <td width="728" height="576" valign="top" align=center >
       <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td height="30" style="padding:10 0 0 14px"><a href="/">Ȩ</a> 
              &gt; ȸ������ &gt; <a href="../member/.php">���̵� �н����� ã��</a></td>
          </tr>
        </table>
        <table width="92%" border="0" cellspacing="1" cellpadding="3">
          <tr> 
            <td style="padding:7 0 6 10px"  bgcolor="F5F6F1">���̵� ã�� : </td>
          </tr>
        </table>
        <table width="92%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FAFAFA">
          <tr> 
            <td valign="top" > <br>
              <table width="90%" border="0" cellspacing="2" cellpadding="2">
				<tr> 
                  <td width="95%" align="center" valign=middle>
				    <?=$name?> ȸ������ ���̵�� <?=$ksh[id]?> �Դϴ�. 
				  </td>
                </tr>
              </table>
              <br>
            </td>
          </tr>
        </table>
	</td>
  </tr>
</table>
</body>
</html>
