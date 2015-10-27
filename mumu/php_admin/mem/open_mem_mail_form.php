<html>
<head>
<title>회원 메일 발송</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link rel="stylesheet" href="../../common/global.css">
<script language="JavaScript" src="../../common/global.js"></script>
<script language="JavaScript">
<!--
function send_check() {
	var form = document.mail;
	if(!form.sender.value){
		alert('보내는 사람 이름을 입력하지 않았습니다.');
		form.sender.focus();
		return;
	}

	if(!form.sender_email.value){
		alert('보내는 사람 이메일을 입력하지 않았습니다.');
		form.sender_email.focus();
		return;
	}

	if(!form.subject.value){
		alert('메일 제목을 입력하지 않았습니다.');
		form.subject.focus();
		return;
	}

	if(!form.contents.value){
		alert('발송 내용을 입력하지 않았습니다.');
		form.contents.focus();
		return;
	}
	form.submit();
}
//-->
</script>
</head>
<body bgcolor="#FFFFFF" text="#000000">
<?
$tot_cnt = sizeof($num);
?>
<table width="650" border="1" cellspacing="0" cellpadding="3" bordercolordark="#FFFFFF">
 <tr>
  <td>메일 발송 (발송할 회원 수 : <?=$tot_cnt?>)</td>
 </tr>
 <tr>
 <form method='post' name='mail' action='open_mem_mail_send.php'>
 <?
 for($i=0;$i < sizeof($num);$i++){
 ?>
 <input type=hidden name='num[]' value='<?=$num[$i]?>'>
 <?
  }
 ?>
  <td align=center> 
   <table width="100%" border="0" cellspacing="0" cellpadding="0" height="100%" >
    <tr> 
     <td> 
      <table width="100%" border="0" cellspacing="1" cellpadding="4">
	   <tr> 
        <td bgcolor="#ebe9f5" width="30%"  align="center">보내는 사람</td>
        <td bgcolor="#FFFFFF" width="70%"  align="left">
		 <input type='text' size='20' name="sender">
	    </td>
	   </tr>
	   <tr> 
        <td bgcolor="#ebe9f5" width="30%"  align="center">보내는 Email</td>
        <td bgcolor="#FFFFFF" width="70%"  align="left">
		 <input type='text' size='50' name="sender_email">
		</td>
	    </tr>
		 <tr> 
         <td bgcolor="#ebe9f5" width="30%"  align="center">메일 제목</td>
         <td bgcolor="#FFFFFF" width="70%"  align="left">
		   <input type='text' size='60' name="subject" >
	     </td>
	    </tr>
		<tr>
		 <td bgcolor="#ebe9f5" width="30%"  align="center">발송 내용</td>
		 <td bgcolor="#FFFFFF" width="70%"  align="left">
		  <textarea name="contents" cols="55" rows="8" ></textarea>
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
     <input type='button' value=" 메 일 발 송 " onclick="javascript:send_check()">
	 <input type='reset' value=" 다 시 작 성 ">
    </td>
  </tr>
 </form>
 </table>
</body>
</html>