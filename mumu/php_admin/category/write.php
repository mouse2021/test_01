<?
//관리자 인증 파일
include "../../php/auth.php";
// 데이타베이스 연결정보 및 기타설정
include "../../php/config.php";
// 각종 유틸함수
include "../../php/util.php";
// MySQL 연결
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
     alert("코드를 입력하세요!");
	 form.code.focus();
	 return ;
  }
  
  if(!form.name.value) {
     alert("대분류명을 입력하세요!");
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
    <td bgcolor="#D9D9D9" width="20%" align="center">코드</td>
	  <td bgcolor="#FFFFFF" width="80%">
       <input type="text" name="code" value="<?=$row[code]?>"
	    <? if($mode=='update') echo("readonly"); ?> size="20" maxlength="5">
	   <br>*수정시 코드는 변경할 수 없습니다.
    </td>
   </tr>
   <tr class="hanamii">
    <td bgcolor="#D9D9D9" width="20%" align="center">대분류명</td>
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
        <input type="button" value="전송하기" onclick="javascript:form_send();">
        <input type="reset" value="다시쓰기">
        <input type="button" value="취소하기" onClick="history.back()">
      </td>
    </tr>
  </table>
</form>
</body>
</html>
