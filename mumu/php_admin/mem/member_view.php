<?
//������ ���� ����
include "../../php/auth.php";
// ����Ÿ���̽� �������� �� ��Ÿ����
include "../../php/config.php";
// ���� ��ƿ�Լ�
include "../../php/util.php";
// MySQL ����
$connect=my_connect($host,$dbid,$dbpass,$dbname);
?>
<html>
<head>
<title>PHPSAMPLE SITE</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link rel="stylesheet" href="../../common/global.css">
<script language="JavaScript" src="../../common/global.js"></script>
</head>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
  <table width="490" border="0" cellspacing="0" cellpadding="0" height="400">
   <tr> 
    <td height="20" bgcolor="#FFFFFF" align="right">&nbsp;
     �� ���� ���� / ����&nbsp;</td>
   </tr>
<?
  $qry = "select * from member where seq_num=$num ";
  $res = mysql_query($qry,$connect);
  $ksh = mysql_fetch_array($res);
?>  
   <form name='primary' method='post' action='mem_view_edit.php'>
   <input type='hidden' name='num' value='<?=$num?>'>
    <tr> 
     <td colspan="2" bgcolor="FFFFFF" style="padding:15"> 
      <table width="480" border="0" cellspacing="0" cellpadding="0" height="250" align="center">
       <tr valign="top"> 
        <td style="padding:25"> 
         <table width="480" border="1" cellspacing="0" cellpadding="0" align="center" height="250" bgcolor="#FFFFFF">
          <tr> 
           <td width="150" class="margin" align="left" bgcolor="#FFF5EC">
             ���̵� </td>
           <td class="margin_left"> <?=$ksh[id]?> </td>
          </tr>
		  <tr> 
           <td width="150" class="margin" align="left" bgcolor="#FFF5EC">
            ��й�ȣ </td>
           <td class="margin_left"> 
		    <input type="text" name="passwd" size="15" class="input" value='<?=$ksh[passwd]?>'> 
		   </td>
          </tr>
		  <tr> 
           <td width="150" class="margin" align="left" bgcolor="#FFF5EC">
            �̸� </td>
           <td class="margin_left"> 
		    <input type="text" name="name" size="25" class="input" value='<?=$ksh[name]?>'> 
		   </td>
          </tr>
	   	  <tr> 
           <td width="150" class="margin" align="left" bgcolor="#FFE9D2">
            �ֹι�ȣ</td>
           <td class="margin_left"> 
		    <?=$ksh[jnumber]?>
		   </td>
          </tr>
          <tr> 
           <td width="150" class="margin" align="left">
            E - mail</td>
           <td class="margin_left"> 
            <input type="text" name="email" size="25" class="input" value='<?=$ksh[email]?>'>
           </td>
          </tr>
		  <tr> 
           <td width="150" class="margin" align="left">
            ��ȭ��ȣ</td>
           <td class="margin_left"> 
             <input type="text" name="phone" size="20" class="input" value='<?=$ksh[phone]?>'>
           </td>
          </tr>
		  <tr> 
           <td width="150" class="margin" align="left">
             �޴���</td>
           <td class="margin_left"> 
             <input type="text" name="mobile" size="20" class="input" value='<?=$ksh[mobile]?>'>
           </td>
          </tr>
		  <tr> 
           <td width="150" class="margin" align="left" bgcolor="#FFE9D2">
            �����ȣ</td>
           <td class="margin_left"> 
	        <input type="text" name="zipcode" size="8" class="input" value='<?=$ksh[zipcode]?>'>
	       </td>
          </tr>
		  <tr> 
           <td width="150" class="margin" align="left" bgcolor="#FFE9D2">
            �ּ�</td>
           <td class="margin_left"> 
	        <input type="text" name="address1" size="30" class="input" value='<?=$ksh[address1]?>'>
            <input type="text" name="address2" size="30" class="input" value='<?=$ksh[address2]?>'>
	       </td>
          </tr>
         </table>
         <br>
         <table width="480" border="0" cellspacing="0" cellpadding="0" align="center">
          <tr> 
           <td>&nbsp;</td>
           <td align="right"><input type=submit value="�����ϱ�">&nbsp;</td>
          </tr>
         </table>
        </td>
       </tr>
	</form>
    </table> 
</center>
</body>
</html>
