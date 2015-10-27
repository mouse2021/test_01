<? 
######### 데이터베이스에 연결한다. ##########
// 데이타베이스 연결정보 및 기타설정
include "../php/config.php";
// 각종 유틸함수
include "../php/util.php";
// MySQL 연결
$connect=my_connect($host,$dbid,$dbpass,$dbname);
 ?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=euc-kr">
<title> id체크</title>
<link rel="stylesheet" href="../common/global.css">
<script language="JavaScript" src="../common/global.js"></script>
<script language = "JavaScript">
<!--
function send() {
 if(!document.id_check.id.value)
 {
   alert("ID를 입력하세요.");
   document.id_check.id.focus();	
   return;
 }
   document.id_check.submit()
}

function form_send(s_id) {
 opener.document.form1.id.value=s_id;
 self.close();
}
-->
</script>
</head>
<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0">
<table border="0" cellpadding="0" cellspacing="0" width="37%" height="255" align="center">
  <tr>
        
    <td width="396" height="51"> 
      <p><img src="../img/member_title3.gif" width="390" height="61" border="0"></p>
        </td>
    </tr>
  <?
  $query  = "select id from member where id='$id'";
  $result = mysql_query($query,$connect);
  $total_num = mysql_num_rows($result);
  if($total_num){
  ?>  
	<tr>        
     <td width="396"> 
      <table border="0" cellpadding="4" width="70%" align="center" class="stranzer_18">
        <form method='post' name='id_check' action='id_check.php'>
		<tr>                    
          <td width="296" align="center"> 
            <p align="left">선택하신 <br>
              ID : <?=$id?>는 현재 사용중인 아이디입니다.</p>
           </td>
         </tr>
		 <tr>
           <td>
		    <input type="text" name="id" size="15">
		    <input type='button' name='btn' onclick="javascript:send()" value='재검색'>
		   </td>
		 </tr>
		 </form>
       </table>
     </td>
    </tr>
   <?
  }
 else{
  ?>  
    <tr>        
     <td width="396"> 
      <table border="0" cellpadding="4" width="70%" align="center" class="stranzer_18">
        <tr>
          <td width="296" height="61" align="center"> 
            <p align="left">선택하신 <br>
              ID : <?=$id?>는 회원 ID로 <br>
              사용하실 수 있습니다.</p>
           </td>
         </tr>
        <tr>    
          <td width="296" align="center"> 
            <p align="center"><a href="javascript:form_send('<?=$id?>')"><img src="../img/member_button3.gif" width="88" height="26" border="0"></a></p>
          </td>
         </tr>
       </table>
     </td>
    </tr>
<?  } ?>
	<tr>
     <td width="396" height="34"> 
      <p align="right">&nbsp;<a href="javascript:window.close();"><img src="../img/member_close_button.gif" width="60" height="19" border="0"></a></p>
        </td>
    </tr>
</table>
</body>
</html>