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
<script language="JavaScript">
<!--
function open_win(theURL,winName,features) { 
  window.open(theURL,winName,features);
}
//-->
</script>
</head>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td height="40" class="title">ȸ�� ���� </td>
  </tr>
</table>
<?

if($mode == 'search'){
  if($id){
    $sear_char .= " and id = '$id' ";
  }

  if($name){
    $sear_char .= " and name like '%$name%' ";
  }

  if($mobile){
    $sear_char .= " and mobile like '%$mobile%' ";
  }

  if($jnumber){
    $sear_char .= " and jnumber like '%$jnumber%' ";
  }

  if($email){
    $sear_char .= " and email like '%$email%' ";
  }
  if($phone){
    $sear_char .= " and phone like '%$phone%' ";
  }
}

$time = date('Y-m-d');

// ���� ������ ȸ������ �˻�
$query = "Select * From member where date_format(reg_date,'%Y-%m-%d')='$time' $sear_char "; 
$result = mysql_query($query, $connect);
$total = mysql_num_rows($result);
?>
 <form name="mb" method="post" action="admin_today_list.php">
 <input type='hidden' name='mode' value='search'>
<div align="center">
<table border="0" cellpadding="0" cellspacing="1" width="95%">
   <tr class=text>
     <td width="150" height="20" bgcolor="#F1F1F1" align="center">
	   <b>���̵�</b>
	 </td>
     <td width="250" height="20">&nbsp;
	  <input type="text" name="id" value='<?=$id?>' size=20 class=input>
	 </td>
     <td width="150" height="20" bgcolor="#F1F1F1" align="center">
	   <b>�޴���</b>
	 </td>
     <td width="250" height="20">&nbsp;
	  <input type="text" name="mobile" value='<?=$mobile?>' size=20 class=input>
	 </td>
    </tr>
	<tr class=text>
     <td width="150" height="20" bgcolor="#F1F1F1" align="center">
	  <b>����</b>
	 </td>
     <td width="250" height="20">&nbsp;
	  <input type="text" name="name" value='<?=$name?>' size=20 class=input>
	 </td>
     <td width="150" height="20" bgcolor="#F1F1F1" align="center">
	  <b>�ֹι�ȣ</b>
	 </td>
     <td width="250" height="20">&nbsp;
	  <input type="text" name="jnumber" value='<?=$jnumber?>' size=20 class=input>
	 </td>
    </tr>
	<tr class=text>
     <td width="150" height="20" bgcolor="#F1F1F1" align="center">
	   <b>�̸���</b>
	 </td>
     <td width="250" height="20">&nbsp;
	   <input type="text" name="email" value='<?=$email?>' size=20 class=input>
	 </td>
     <td width="150" height="20" bgcolor="#F1F1F1" align="center">
	   <b>����ó</b>
	 </td>
     <td width="250" height="20">&nbsp;
	  <input type="text" name="phone" value='<?=$phone?>' size=20 class=input>
	 </td>
    </tr>
	<tr>
	  <td colspan="4">
	    <center><input type="submit" value="Ȯ��" class=input></center>
      </td>
	</tr>
  </table>
 </div>
 </form>
 <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr class=text> 
    <td align=right>ȸ�� ( <?=number_format($total)?> �� )</td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#999999">
  <tr align="center" class="text"> 
    <td height="25" bgcolor="#f5f5f5"><strong>��ȣ</strong></td>
    <td height="25" bgcolor="#f5f5f5"><strong>���̵�</strong></td>
	<td height="25" bgcolor="#f5f5f5"><strong>�̸�</strong></td>
    <td height="25" bgcolor="#f5f5f5">�ֹι�ȣ</td>
    <td height="25" bgcolor="#f5f5f5">���Գ�¥</td>
	<td height="25" bgcolor="#f5f5f5">����ó</td>
	<td height="25" bgcolor="#f5f5f5">�޴���</td>
	<td height="25" bgcolor="#f5f5f5">����</td>
  </tr>
 <?
    $scale=30;
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
				    
	$sql_2 = "select * from member 
	          where date_format(reg_date,'%Y-%m-%d')='$time'  
			        $sear_char 
			  order by seq_num desc 
			  LIMIT $cline,$scale1 "; 
    $result_2 = mysql_query($sql_2, $connect);

    for($i=1; $list = mysql_fetch_array($result_2); $i++){
     $bunho = $total - ( $i + $cline) + 1; 
 ?>	  
  <tr bgcolor="#FFFFFF" class="text"> 
    <td align="center"><?=$bunho?></td>
    <td ><a href="javascript:open_win('member_view.php?num=<?=$list[seq_num]?>','nwin','scrollbars=no,width=550,height=400');"><?=$list[id]?></a></td>
	<td><?=$list[name]?></td>
    <td><?=$list[jnumber]?></td>
    <td align="center"><?=$list[reg_date]?></td>
	<td align="center"><?=$list[phone]?></td>
	<td align="center"><?=$list[mobile]?></td>
	<td align="center"><a href="mem_del.php?m_num=<?=$list[seq_num]?>&page=<?=$page?>&ck=2" onClick="return confirm('������ �Ͻð� �Ǹ� �� ȸ���� ��� ������ �����˴ϴ�. \n�����Ͻðڽ��ϱ�?')">����</td>
  </tr>
  <?
    }
    mysql_free_result($result_2);
  ?>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td height="40" align="center" class="text">&nbsp; 
	<?
	 $url = "admin_today_list.php?$id=$id&mode=$mode&jnumber=$jnumber&$email=$email&name=$name&phone=$phone&mobile=$mobile"; 
	 page_avg($totalpage,$cpage,$url); 
   ?>
	</td>
  </tr>
</table>    
</body>
</html>
