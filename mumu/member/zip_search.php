<?
########## 데이터베이스에 연결한다. ##########
// 데이타베이스 연결정보 및 기타설정
include "../php/config.php";
// 각종 유틸함수
include "../php/util.php";
// MySQL 연결
$connect=my_connect($host,$dbid,$dbpass,$dbname);

if(!$what){
  $what = "1";
}
?>
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link rel="stylesheet" href="../common/global.css">
<script language="JavaScript" src="../common/global.js"></script>
<script language="JavaScript">
<!--
function checkInput(form){
   var form = document.zipsearch;
   if(!form.dong.value) {
        alert("찾기를 원하는 동을 입력하세요!");
        form.dong.focus();
	    return false;
   }else{
       form.submit();
   }
}
//-->
</script>
<script language="javascript">

function open_move1(zipcode,adr) {
   
   var form_object = eval("opener.document.form1");
      
      zip1=zipcode.substring(0,3);
      zip2=zipcode.substring(4,7);
      b=adr
            
      form_object.zipcode1.value = zip1;
      form_object.zipcode2.value = zip2;
      form_object.address1.value = b;
	  form_object.address2.focus();
   
      self.close();
}

function open_move2(zipcode,adr) {
   
   var form_object = eval("opener.document.purchase");
      
      zip1=zipcode.substring(0,3);
      zip2=zipcode.substring(4,7);
      b=adr
            
      form_object.buyer_zipcode01.value = zip1;
      form_object.buyer_zipcode02.value = zip2;
      form_object.buyer_address01.value = b;
	  form_object.buyer_address02.focus();
   
      self.close();
}

function open_move3(zipcode,adr) {
   
   var form_object = eval("opener.document.purchase");
      
      zip1=zipcode.substring(0,3);
      zip2=zipcode.substring(4,7);
      b=adr
            
      form_object.recipient_zipcode01.value = zip1;
      form_object.recipient_zipcode02.value = zip2;
      form_object.recipient_address01.value = b;
	  form_object.recipient_address02.focus();
   
      self.close();
}

</script>
<style type="text/css">
<!--
a:active {  color: #333333; text-decoration: none}
a:hover {  color: #CC0000}
a:link {  color: #CC0000; text-decoration: underline}
a:visited {  color: #333333}
td {  font-size: 9pt}
-->
</style>
</head>

<body topmargin="0">
<table width="390" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#666666">
  <tr> 
    <td>
	  <table width="390" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr> 
          <td bgcolor="#999999"><div align="center">
		   <img src="../img/member_title4.gif" width="390" height="61" border="0"></div>
		  </td>
        </tr>
        <tr> 
          <td height="13" bgcolor="f5f5f5"><div align="center"></div></td>
        </tr>
        <tr> 
          <td bgcolor="f5f5f5">
		   <table width="217" height="25" border="0" align="center" cellpadding="0" cellspacing="0">
             <form name="zipsearch" method="post" action="<?=$PHP_SELF?>" onsubmit="return checkInput()">
			  <tr> 
                <td width="50">동이름</td>
                <td width="118"><input type="text" name="dong" size="12"></td>
				<input type='hidden' name='mode' value='search'>
			    <input type='hidden' name='what' value='<?=$what?>'>
                <td width="50">
				 <input type=submit name="btn" value="확인">
				</td>
              </tr>
			 </form>
            </table>
		  </td>
        </tr>
<?
if($mode == 'search'){

########## 주소 데이터베이스에서 사용자가 입력한 주소와 일치하는 레코드를 검색한다. ##########
$query  = "select post_id,post_num,address,phon_num from p_zipcode 
           where address LIKE '%$dong%' ";
$result = mysql_query($query,$connect);
$total_num = mysql_num_rows($result);
########## 검색결과가 존재하면 리스트박스 형태로 출력한다. ########## 
?>
       <tr> 
         <td height="50" bgcolor="f5f5f5"><div align="center"><font color="#000099">해당 
            주소를 클릭하시면 자동입력됩니다.</font></div></td>
        </tr>
        <tr> 
          <td bgcolor="f5f5f5">
		    <table width="350" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC">
              <tr> 
                <td>
				  <table width="350" height="33" border="0" cellpadding="0" cellspacing="1">
				  <?
				  if($total_num){
				    for($i=0 ;$i<$total_num;$i++){
					  $post_id = mysql_result($result,$i,"post_id");
					  $post_num = mysql_result($result,$i,"post_num");
					  $address = mysql_result($result,$i,"address");
					  $phon_num = mysql_result($result,$i,"phon_num");
					  
					  $a_addr = explode(" ",$address);
					  $addr1 = $a_addr[0]." ".$a_addr[1]." ".$a_addr[2];

					  $address1 = "$addr1";
                      
					  $addr_code = explode("-",$post_num);
				 ?>
                    <tr bgcolor="#FFFFFF"> 
                      <td width="57" height="30"><div align="center"><a href="javascript:open_move<?=$what?>('<?=$post_num?>','<?=$address1?>')"><?=$post_num?></a></div></td>
                      <td width="293" height="30"><div align="center"><a href="javascript:open_move<?=$what?>('<?=$post_num?>','<?=$address1?>')"><?=$address?></a></div></td>
                    </tr>
				 <?
				      }
				   }
				   else{
                 ?> 
				    <tr bgcolor="#FFFFFF"> 
                      <td colspan="2" height="30"><div align="center">해당하는 주소가 없습니다.</div></td>
                    </tr>
				<? }  ?>
                  </table></td>
              </tr>
            </table></td>
        </tr>
	<?
	  }
	 else{
	 ?>
	    <tr> 
          <td height="85" bgcolor="f5f5f5"><div align="center"><font color="#000099">검색하려는 주소의 <br>동 이나 단어를 입력하세요. </font></div></td>
        </tr>
     <? } ?>   
		<tr>
          <td bgcolor="f5f5f5">&nbsp;</td>
        </tr>
        <tr> 
          <td height="1" bgcolor="#FFFFFF"></td>
        </tr>
        <tr>
         <td width="396" bgcolor="#FFFFFF"> 
           <p align="right">&nbsp;
		    <a href="javascript:window.close();"><img src="../img/member_close_button.gif" width="60" height="19" border="0"></a></p>
        </td>
       </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
