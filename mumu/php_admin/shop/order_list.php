<?
// ����ġ ����
include	"../../php/auth.php";
// ����Ÿ���̽� �������� �� ��Ÿ����
include	"../../php/config.php";
// ����	��ƿ�Լ�
include	"../../php/util.php";
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

<body bgcolor="#FFFFFF" text="#000000">
<table width='780' border='0'>
 <tr>
  <td valign='top'>
  <form action='order_list.php' name='f' method='post' >  
<?
	// �ڷ� �Ѽ� ���ϱ�
	if ($mode=='search') {
	   $sql_2=" select orderid from mall_order 
				where cancel = 'N' and 
					  $key like '%$key_value%' "; 
	} 
	else {
	   $sql_2 = "select orderid from mall_order where cancel='N' "; 
	}
	$res_2 = mysql_query($sql_2,$connect);
	$total = mysql_num_rows($res_2);


   $scale=15;
   if ($page == ''){
      $page=1;
   }	    
   
   $cpage = intval($page);
   $totalpage = intval($total/$scale);
	
    if ($totalpage*$scale != $total)
  		$totalpage = $totalpage + 1;
        
    if ($cpage ==1) {
	  $cline = 0 ;
    } else {
 	  $cline = ($cpage*$scale) - $scale ;
    } 
        
     $limit=$cline+$scale;
       
     if ($limit >= $total) 
       	$limit=$total;

     $scale1 = $limit - $cline;
?>
  <table width='99%' border='0' cellspacing='2' cellpadding='1' >
    <tr> 
	<td height='25' align='center'><b><font color='blue' size='3'>��ǰ�ֹ� ��Ȳ</a></b></td>
  </tr>
 </table>
 <table width="99%" border="0" cellspacing="0" cellpadding="0">
  <tr bgcolor="#3a9edf"> 
   <td > 
	<table width="100%" border="0" cellspacing="1" cellpadding="3">
	  <tr bgcolor="#cbe2f5"> 
	    <td align="center" height="20"><b>�ֹ���ȣ</b></td>
	    <td align="center"><b>ID</b></td>
	    <td align="center"><b>�ֹ���</b></td>
	    <td align="center"><b>������</b></td>
	    <td align="center"><b>������</b></td>
	    <td align="center"><b>�ֹ����</b></td>
	    <td align="center"><b>�ֹ���</b></td>
	    <td align="center"><b>ó������</b></td>
	    <td align="center"><b>����</b></td>
	  </tr>
<?

if ($mode=='search') {
   $sql_4 = "select * from mall_order 
             where cancel = 'N' and 
				   $key like '%$key_value%' 
			 order by num desc LIMIT $cline,$scale1 "; 
} else {
   $sql_4 = "select * from mall_order where cancel = 'N' 
             order by num desc LIMIT $cline,$scale1 "; 
}

$a_pay_type['1'] = "������ �Ա�";
$a_pay_type['2'] = "�ſ�ī��";
$a_pay_type['3'] = "�޴��� ����";

$res_4 = mysql_query($sql_4,$connect);
for($i=0; $row = mysql_fetch_array($res_4); $i++){

	if($row[status]=='1'){
		$c_color='#FFFFFF'; 
		$status_now="�Ա�Ȯ����";
	}
	else if ($row[status]=='3'){ 
		$c_color='#FFFFFF'; 
		$status_now="�Ա�Ȯ����";
	}
	else if($row[status]=='5'){
		$c_color='#E0FFE0'; 
		$status_now="�Ա�Ȯ��";
	}
	else if ($row[status]=='7'){ 
		$c_color='#EFFCFC';
		$status_now="�����";
	}
	else if ($row[status]=='8'){ 
		$c_color='#FFFCCC'; 
		$status_now="��ۿϷ�";
	}
?>
  <tr bgcolor="<?=$c_color?>"> 
    <td align='center' ><a href='order_read.php?oid=<?=$row[num]?>&page=<?=$page?>'><?=$row[orderid]?></a></td>
    <td align='center' ><?=$row[user_id]?></td>
    <td align='center' ><?=$row[createdate]?></td>
    <td align='center'><?=$row[buyer_name]?></td>
    <td align='center'><?=$row[recipient_name]?></td>
    <td align='center' ><?=$a_pay_type[$row[payment_type]]?> </td>
    <td align='center' ><?=$row[amount]?> ��</td>
    <td align='center' ><?=$status_now?> </td>
	<td align='center'><a href='order_delete.php?oid=<?=$row[num]?>&page=<?=$page?>&pay_type=<?=$row[pay_type]?>' onClick="return confirm('���� �ֹ� ����Ͻðڽ��ϱ�?')">����</a></td>
	  </tr>
 <? 
  }
 ?>
   <tr bgcolor="#f2f9ff" > 
    <td  colspan="10"> 
     <table width="100%" border="0" cellspacing="0" cellpadding="2">
 	  <tr> 
	   <td  align="center" >	
     <?
	  $url = "$PHP_SELF?mode=$mode&key=$key&key_value=$key_value"; 
      page_avg($totalpage,$cpage,$url); 
	?>
      </td>
	 </tr>
	</table>
   </td>
  </tr>
  <tr bgcolor="#cbe2f5"> 
   <td  colspan="10" align='left' > 
	<select name='key'>
	<option value='user_id'>���̵�</option>
	<option value='buyer_name'>�����ڸ�</option>
	<option value='orderid'>��ǰ�ڵ�</option>
	</select>
	<input type='hidden' name='mode' value='search'>
	<input type='text' name='key_value' size='16' class=input>
	<input type='submit' name='submit' value='�˻�'  class=submit>	 
   </td>
  </tr>
 </table>
</td>
</tr>
 </table>
  </CENTER>
</form>
</td>
 </tr>
 </table>
</body>
</html>