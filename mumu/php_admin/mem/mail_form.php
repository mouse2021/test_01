<html>
<head>
<title>PHPSAMPLE SITE</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link rel="stylesheet" href="../../common/global.css">
<script language="JavaScript" src="../../common/global.js"></script>
<script language="JavaScript">
<!--
function send_check() {
	var form = document.mail;
	if(!form.sender.value){
		alert('������ ��� �̸��� �Է����� �ʾҽ��ϴ�.');
		form.sender.focus();
		return;
	}

	if(!form.sender_email.value){
		alert('������ ��� �̸����� �Է����� �ʾҽ��ϴ�.');
		form.sender_email.focus();
		return;
	}

	if(!form.receiver.value){
		alert('�޴� ��� �̸��� �Է����� �ʾҽ��ϴ�.');
		form.receiver.focus();
		return;
	}

	if(!form.receiver_email.value){
		alert('�޴� ��� �̸����� �Է����� �ʾҽ��ϴ�.');
		form.receiver_email.focus();
		return;
	}

	if(!form.subject.value){
		alert('���� ������ �Է����� �ʾҽ��ϴ�.');
		form.subject.focus();
		return;
	}

	if(!form.contents.value){
		alert('�߼� ������ �Է����� �ʾҽ��ϴ�.');
		form.contents.focus();
		return;
	}
	form.submit();
}
//-->
</script>
</head>

<body bgcolor="#FFFFFF" text="#000000">

<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td height="40" class="title">���� ���� �߼�</td>
  </tr>
</table>
<table width="95%" border="1" cellspacing="0" cellpadding="3" bordercolordark="#FFFFFF">
 <tr>
 <form method='post' name='mail' action='mail_form_send.php' enctype="multipart/form-data">
  <td align=center> 
   <table width="100%" border="0" cellspacing="0" cellpadding="0" height="100%" >
    <tr> 
     <td> 
      <table width="100%" border="0" cellspacing="1" cellpadding="4">
	   <tr> 
        <td bgcolor="#ebe9f5" width="40%"  align="center">������ ���</td>
        <td bgcolor="#FFFFFF" width="60%"  align="left">
		 <input type='text' size='20' name="sender">
	    </td>
	   </tr>
	   <tr> 
        <td bgcolor="#ebe9f5" width="40%"  align="center">������ ��� Email</td>
        <td bgcolor="#FFFFFF" width="60%"  align="left">
		 <input type='text' size='50' name="sender_email">
		</td>
	    </tr>
		<tr> 
         <td bgcolor="#ebe9f5" width="40%"  align="center">�޴� ���</td>
         <td bgcolor="#FFFFFF" width="60%"  align="left">
		 <input type='text' size='20' name="receiver">
		 </td>
	    </tr>
		<tr> 
         <td bgcolor="#ebe9f5" width="40%"  align="center">�޴� ��� Email</td>
         <td bgcolor="#FFFFFF" width="60%"  align="left">
		  <input type='text' size='50' name="receiver_email">
		  </td>
	     </tr>
		 <tr> 
         <td bgcolor="#ebe9f5" width="40%"  align="center">÷�� ����</td>
         <td bgcolor="#FFFFFF" width="60%"  align="left">
		   <input type='file' size='40' name="userfile">
	     </td>
	    </tr>
		 <tr> 
         <td bgcolor="#ebe9f5" width="40%"  align="center">���� ����</td>
         <td bgcolor="#FFFFFF" width="60%"  align="left">
		   <input type='text' size='60' name="subject" >
	     </td>
	    </tr>
		<tr>
		 <td bgcolor="#ebe9f5" width="40%"  align="center">�߼� ����</td>
		 <td bgcolor="#FFFFFF" width="60%"  align="left">
		  <textarea name="contents" cols="60" rows="8" ></textarea>
		  </td>
		 </tr>
        </table>
	   </td>
      </tr>
     </table>
    </td>
  </tr>
  <tr bgcolor='#FFFFFF'>
   <td align='right'>
     <input type='button' value=" �� �� �� �� " onclick="javascript:send_check()">
	 <input type='reset' value=" �� �� �� �� ">
    </td>
  </tr>
 </form>
 </table>
</body>
</html>