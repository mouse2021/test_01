<?
//������ ���� ����
include "../../php/auth.php";
// ����Ÿ���̽� �������� �� ��Ÿ����
include "../../php/config.php";
// ���� ��ƿ�Լ�
include "../../php/util.php";
// MySQL ����
$connect=my_connect($host,$dbid,$dbpass,$dbname);

// ����ī�װ� �ڵ尪���� ���� �� ī�װ� ���� ����
$query = "select * from products_category2 where category_code_fk='$sub_code' ";
$result = mysql_query($query, $connect);
$total_count = mysql_num_rows($result);
?>
<html>
<head>
<title>PHPSAMPLE SITE</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link rel="stylesheet" href="../../common/global.css">
<script language="JavaScript" src="../../common/global.js"></script>

<body bgcolor="#FFFFFF" text="#000000">
<center>
<form method="post" action="sub_list.php">
  <table width="700" border="0" cellspacing="0" cellpadding="3">
    <tr class="hanamii">
     <td align="right"><?=number_format($total_count)?>��</td>
    </tr>
  </table>
  <table width="700" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td bgcolor="#666666"> 
        <table width="100%" border="0" cellspacing="1" cellpadding="2">
          <tr align="center" bgcolor="#D9D9D9" class="hanamii"> 
            <td width="10%">��ȣ</td>
            <td width="15%">�ڵ�</td>
            <td width="30%">ī�װ���</td>
            <td width="20%">��ϵ� ��ǰ��</td>
			<td width="25%">����</td>
          </tr>
<?
for($i=0; $row = mysql_fetch_array($result); $i++){
	$query = "select * from products where l_category_fk='$row[code]'";
	$result2 = mysql_query($query, $connect);
	$products_count = mysql_num_rows($result2);
	mysql_free_result($result2);

	// ������ ������ �ٸ��� ǥ��
	if($i%2 == 0){
		$bgcolor = "#FFFFFF";
	}else{
		$bgcolor = "#F5F5F5";
	}
?>
         <tr bgcolor="<?=$bgcolor?>" align="center" class="hanamii">
           <td><?=($i+1)?></td>
           <td><?=$row[code]?></td>
           <td><?=$row[name]?></td>
           <td><?=$products_count?></td>
	       <td class="hanamii">
            <a href='sub_write.php?mode=update&id=<?=$row[id]?>&h_code=<?=$row[category_code_fk]?>'>����</a>&nbsp;
            <a href='sub_delete.php?id=<?=$row[id]?>&h_code=<?=$row[category_code_fk]?>' onClick="return confirm('���� �����Ͻðڽ��ϱ�?')">����</a>
           </td>
         </tr>
<?
}
mysql_free_result($result);

if($total_count == 0){
?>
          <tr bgcolor="#FFFFFF" align="center" class="hanamii">
            <td colspan="5">��ϵ� �з��� �����ϴ�.</td>
          </tr>
<?
	}
?>
        </table>
      </td>
    </tr>
  </table>
  <br>
  <table width="700" border="0" cellspacing="0" cellpadding="3">
    <tr>
      <td align="center">
        <input type="button" value="����ϱ�" onClick="location='sub_write.php?h_code=<?=$sub_code?>'">&nbsp;
        <input type="button" value="�����׸�" onClick="location='list.php'">
      </td>
    </tr>
  </table>
</form>
</body>
</html>
