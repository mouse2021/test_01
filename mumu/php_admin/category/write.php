<?
//������ ���� ����
include "../../php/auth.php";
// ����Ÿ���̽� �������� �� ��Ÿ����
include "../../php/config.php";
// ���� ��ƿ�Լ�
include "../../php/util.php";
// MySQL ����
$connect=my_connect($host,$dbid,$dbpass,$dbname);

if($mode == "update"){
	$query = "select * from products_category1 where id=$id";
	$result = mysql_query($query, $connect);
	$row = mysql_fetch_array($result);
	mysql_free_result($result);
}else{
	$mode = "insert";
}
?>
<html>
<head>
<title>PHPSAMPLE SITE</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link rel="stylesheet" href="../../common/global.css">
<script language="JavaScript">
<!--
function form_send(){
  var form = document.form1;
  
  if(!form.code.value) {
     alert("�ڵ带 �Է��ϼ���!");
	 form.code.focus();
	 return ;
  }
  
  if(!form.name.value) {
     alert("��з����� �Է��ϼ���!");
	 form.name.focus();
	 return ;
  }
  form.submit();
}
// -->
</script>

<body bgcolor="#FFFFFF" text="#000000">
<center>
<form name="form1" method="post" action="insert.php">
  <table width="600" border="0" cellspacing="0" cellpadding="0">
   <tr class="hanamii">
    <td bgcolor="#D9D9D9" width="20%" align="center">�ڵ�</td>
	  <td bgcolor="#FFFFFF" width="80%">
       <input type="text" name="code" value="<?=$row[code]?>"
	    <? if($mode=='update') echo("readonly"); ?> size="20" maxlength="5">
	   <br>*������ �ڵ�� ������ �� �����ϴ�.
    </td>
   </tr>
   <tr class="hanamii">
    <td bgcolor="#D9D9D9" width="20%" align="center">��з���</td>
    <td bgcolor="#FFFFFF" width="80%">
       <input type="text" name="name" value="<?=$row[name]?>" size="50" maxlength="60">
    </td>
   </tr>
  </table>
  <br>
  <table width="600" border="0" cellspacing="0" cellpadding="3">
    <tr>
      <td align="center"> 
        <input type="hidden" name="mode" value="<?=$mode?>">
        <input type="hidden" name="id" value="<?=$id?>">
        <input type="button" value="�����ϱ�" onclick="javascript:form_send();">
        <input type="reset" value="�ٽþ���">
        <input type="button" value="����ϱ�" onClick="history.back()">
      </td>
    </tr>
  </table>
</form>
</body>
</html>
