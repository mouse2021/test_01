<?
// ����ġ ����
include "../../php/auth.php";
// ����Ÿ���̽� �������� �� ��Ÿ����
include "../../php/config.php";
// ���� ��ƿ�Լ�
include "../../php/util.php";
// MySQL ����
$connect=my_connect($host,$dbid,$dbpass,$dbname);

$query = "select * from products where num=$p_num";
$result = mysql_query($query, $connect);
$row = mysql_fetch_array($result);
mysql_free_result($result);
    
?>
<html>
<head>
<title>PHPSAMPLE SITE</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link rel="stylesheet" href="../../common/global.css">
<script language="JavaScript" src="../../common/global.js"></script>
</head>

<body bgcolor="#FFFFFF" text="#000000">
<center>
 <table width="700" border="0" cellspacing="0" cellpadding="0">
  <tr>
   <td bgcolor="#666666">
    <table width="100%" border="0" cellspacing="1" cellpadding="2">
     <tr class="hanamii">
      <td bgcolor="#D9D9D9" width="20%" align="center">��ǰ ī�װ�</td>
      <td bgcolor="#F5F5F5" width="80%">
	<?
	 $qry1 = "select * from products_category1 where code='$category_code_fk'";
	 $res1 = mysql_query($qry1,$connect);
	 $ksh1 = mysql_fetch_array($res1);
	 mysql_free_result($res1);
     echo"$ksh1[name]";

	 if($row[l_category_fk]){
	  $qry2 = "select * from products_category2 where code='$row[l_category_fk]'";
	  $res2 = mysql_query($qry2,$connect);
 	  $ksh2 = mysql_fetch_array($res2);
 	  mysql_free_result($res2);
	  echo" >> ";
	  echo" $ksh2[name]";
	 }
	?>
     </td>
    </tr>
	<tr class="hanamii">
     <td bgcolor="#D9D9D9" width="20%" align="center">��ǰ��</td>
     <td bgcolor="#F5F5F5" width="80%">&nbsp;<?=$row[name]?></td>
    </tr>
	<tr class="hanamii">
      <td bgcolor="#D9D9D9" width="20%" align="center">������(������)</td>
      <td bgcolor="#F5F5F5" width="80%">&nbsp;<?=$row[company]?></td>
    </tr>
	<tr class="hanamii">
     <td bgcolor="#D9D9D9" width="20%" align="center">�Һ��� ����</td>
     <td bgcolor="#F5F5F5" width="80%">&nbsp;<?=number_format($row[cust_price])?> ��</td>
    </tr>
    <tr class="hanamii">
     <td bgcolor="#D9D9D9" width="20%" align="center">�ǸŰ���</td>
     <td bgcolor="#F5F5F5" width="80%">&nbsp;<?=number_format($row[price])?> ��</td>
    </tr>
    <tr class="hanamii">
      <td bgcolor="#D9D9D9" width="20%" align="center">����Ʈ</td>
      <td bgcolor="#F5F5F5" width="80%">&nbsp;<?=number_format($row[mileage])?> POINT</td>
    </tr>
	<tr class="hanamii">
      <td bgcolor="#D9D9D9" width="20%" align="center">���û���</td>
      <td bgcolor="#F5F5F5" width="80%">&nbsp;<?=$row[size]?></td>
    </tr>
	<tr class="hanamii">
      <td bgcolor="#D9D9D9" width="20%" align="center">�̹���(��)</td>
      <td bgcolor="#F5F5F5" width="80%">&nbsp;
 <?
if($row[s_image]=='Y'){
?>
      <img src="../../upload/p_image/s/<?=$row[prod_code]?>.<?=$row[s_image_ty]?>">
<?
}
?>
	 </td>
    </tr>
	<tr class="hanamii">
     <td bgcolor="#D9D9D9" width="20%" align="center">�̹���(��)</td>
     <td bgcolor="#F5F5F5" width="80%">&nbsp;
 <?
if($row[m_image]=='Y'){
?>
      <img src="../../upload/p_image/m/<?=$row[prod_code]?>.<?=$row[m_image_ty]?>">
<?
}
?>
	</td>
   </tr>
   <tr class="hanamii">
    <td bgcolor="#D9D9D9" width="20%" align="center">�̹���(��)</td>
    <td bgcolor="#F5F5F5" width="80%">&nbsp;
 <?
if($row[b_image]=='Y'){
?>
      <img src="../../upload/p_image/b/<?=$row[prod_code]?>.<?=$row[b_image_ty]?>">
<?
}
?>
	</td>
   </tr>
   <tr class="hanamii">
     <td bgcolor="#D9D9D9" width="20%" align="center">��ǰ����</td>
     <td bgcolor="#F5F5F5" width="80%">
   <?
	 if($row[con_html] =='1'){
	  echo(stripslashes($row[contents]));
	 }
	 else{
	   echo(nl2br(stripslashes($row[contents])));
     }
  ?>
     </td>
    </tr>
    <tr class="hanamii">
     <td bgcolor="#D9D9D9" width="20%" align="center">�̺�Ʈ��ǰ ����</td>
     <td bgcolor="#F5F5F5" width="80%">&nbsp;<?=$row[option1_chk]?></td>
    </tr>
	<tr class="hanamii">
     <td bgcolor="#D9D9D9" width="20%" align="center">�Ż�ǰ ����</td>
     <td bgcolor="#F5F5F5" width="80%">&nbsp;<?=$row[option2_chk]?></td>
    </tr>
	<tr class="hanamii">
     <td bgcolor="#D9D9D9" width="20%" align="center">�Ǹ����� ����</td>
     <td bgcolor="#F5F5F5" width="80%">&nbsp;<?=$row[del_chk]?></td>
    </tr>
	<tr class="hanamii">
     <td bgcolor="#D9D9D9" width="20%" align="center">�������</td>
     <td bgcolor="#F5F5F5" width="80%">&nbsp;<?=$row[created]?></td>
    </tr>
   </table>
  </td>
 </tr>
</table>
<table width="600" border="0" cellspacing="0" cellpadding="3">
 <tr>
  <td align="center"> 
   <a href='list.php?level=<?=$level?>&category_code_fk=<?=$category_code_fk?>&page=<?=$page?>&l_category_fk=<?=$l_category_fk?>'>��Ϻ���</a>&nbsp;&nbsp;
   <a href='write.php?mode=update&p_num=<?=$p_num?>&level=<?=$level?>&category_code_fk=<?=$category_code_fk?>&page=<?=$page?>&l_category_fk=<?=$l_category_fk?>'>�����ϱ�</a>&nbsp;&nbsp;
   <a href='delete.php?p_num=<?=$p_num?>&level=<?=$level?>&category_code_fk=<?=$category_code_fk?>&page=<?echo($page)?>&l_category_fk=<?=$l_category_fk?>' onClick="return confirm('���� �����Ͻðڽ��ϱ�?')">�����ϱ�</a>
  </td>
 </tr>
</table>
</body>
</html>
