<?
include "../php/config.php";
// ���� ��ƿ�Լ�
include "../php/util.php";
// MySQL ����
$connect=my_connect($host,$dbid,$dbpass,$dbname);

// �̸��� ���̵� �ش�Ǵ� ������ �����ϴ��� Ȯ��
if(!isset($_SESSION["p_id"]) || !isset($_SESSION["p_name"])){
  err_msg('�α��� ������ �����ϴ�. �ٽ� �α����� �ּ���.');
}

?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=euc-kr">
<title>PHPSAMPLE SITE</title>
<link rel="stylesheet" href="../common/global.css">
<script language="JavaScript" src="../common/global.js"></script>
<script language="JavaScript" type="text/JavaScript">
<!--

 function send_chk(){
  var form = document.form1;
  
  if(!form.receive_id.value) {
     alert("�޴� ��� ���̵� �Է��ϼ���!");
	 form.receive_id.focus();
	 return ;
  }

  if(!form.msg.value) {
     alert("���� ������ �Է��ϼ���!");
	 form.msg.focus();
	 return ;
  }

  form.submit();
  }

//-->
</script>
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
    <td width="728" valign="top" >
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr> 
        <td height="30" style="padding:10 0 0 14px"><a href="/">Ȩ</a> 
          &gt; �޽��� </td>
      </tr>
     </table>
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="89" style="padding:16 0 0 25px"> 
            <table width="90%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td ><img src="../img/message_title.gif" width="30" height="30" align="absmiddle" hspace="2">��������</td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
	  <table width="90%" border="0" cellspacing="0" cellpadding="6">
        <tr>
          <td align="right"> 
            <a href="message_2.php">����������</a> | 
			<a href="message_2.php">����������</a> |
            <b>��������</b>
		  </td>
        </tr>
      </table>
      <table width="90%" border="0" cellspacing="0" cellpadding="0">
       <form method='post' name=form1 action="message_send_post.php">
		<tr > 
          <td colspan="3" background="../img/table_bg_001.gif"><img src="../img/table_bg_001.gif" width="3" height="1"></td>
        </tr>
		<tr> 
          <td align="center" width="155"><b>�޴»��</b></td>
          <td width="378" style="padding:8 0 5 0px"> 
            <input type="text" name="receive_id" size="10">
            </td>
        </tr>
        <tr > 
          <td colspan="3" background="../img/table_bg_001.gif"><img src="../img/table_bg_001.gif" width="3" height="1"></td>
        </tr>
        <tr> 
          <td colspan="2" align="center" background="../img/table_bg_001.gif" width="154"><img src="../img/table_bg_001.gif" width="3" height="1"></td>
        </tr>
        <tr>
          <td width="155" align="center" ><b>����</b></td>
          <td width="378" style="padding:5 0 5 0px"> 
            <textarea name="msg" cols="50" rows="15" ></textarea>
          </td>
        </tr>
      </table>
      <table width="90%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td background="../img/table_im_004.gif"><img src="../img/table_im_004.gif" width="3" height="4"></td>
        </tr>
      </table>
      <table width="90%" border="0" cellspacing="0" cellpadding="4">
        <tr> 
          <td align="center" width="10%">&nbsp;</td>
          <td align="center" width="90%"><a href="javascript:send_chk()"><img src="../img/bt_ok2.gif" border="0"><a href="javascript:history.go(-1)"><img src="../img/bt_list2.gif"  border="0"></a></td>
        </tr>
	   </form>
      </table>
	  <br>
	</td>
  </tr>
</table>
</body>
</html>
