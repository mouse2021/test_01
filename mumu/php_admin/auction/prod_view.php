<?
// ����ġ ����
include "../../php/auth.php";
// ����Ÿ���̽� �������� �� ��Ÿ����
include "../../php/config.php";
// ���� ��ƿ�Լ�
include "../../php/util.php";
// MySQL ����
$connect=my_connect($host,$dbid,$dbpass,$dbname);

$query = "select * from auct_master where anum=$p_num";
$result = mysql_query($query, $connect);
$row = mysql_fetch_array($result);
mysql_free_result($result);

$a_prod_type['1'] = "�Ż�ǰ";
$a_prod_type['2'] = "�߰��ǰ";

$a_as_type['Y'] = "AS����";
$a_as_type['N'] = "AS�Ұ���";

$a_limit_type['1'] = "��ñ��� ���";
$a_limit_type['2'] = "��ñ��� ����";

$a_trans_type['1'] = "�ù� ���κδ�(����)";
$a_trans_type['2'] = "�ù� ����ںδ�";
$a_trans_type['3'] = "��������";
$a_trans_type['4'] = "��������";

?>
<html>
<head>
<title>PHPSAMPLE SITE</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link rel="stylesheet" href="../../common/global.css">
<script language="JavaScript" src="../../common/global.js"></script>
<script language="JavaScript" src="../../common/auction.js"></script>
</head>

<body bgcolor="#FFFFFF" text="#000000">
<center>
  <table width="700" border="1" cellspacing="0" cellpadding="3" bordercolorlight="#000000" bordercolordark="#FFFFFF" align="center">
	<tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">��źз�</td>
      <td width="70%" bgcolor="#FFFFFF">
    <?
	 $qry1 = "select * from auct_category where code='$row[category_fk]'";
	 $res1 = mysql_query($qry1,$connect);
	 $ksh1 = mysql_fetch_array($res1);
	 mysql_free_result($res1);
     echo"$ksh1[name]";
	?>
      </td>
    </tr>
    <tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">��ϻ�ǰ��</td>
      <td width="70%" bgcolor="#FFFFFF">
        <?=$row[prod_name]?> &nbsp;
      </td>
    </tr>
    <tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">�߰��ǰ ����</td>
      <td width="70%" bgcolor="#FFFFFF">
         <?=$a_prod_type[$row[prod_type]]?> &nbsp;
      </td>
    </tr>
	<tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">�Ǹ��� ��������</td>
      <td width="70%" bgcolor="#FFFFFF">
	    <?=$row[in_addr]?> &nbsp;
      </td>
    </tr>
	<tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">�Ǹ��� ����ó</td>
      <td width="70%" bgcolor="#FFFFFF">
        <?=$row[phone]?> &nbsp;
      </td>
    </tr>
	<tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">�Ǹ� ��������</td>
      <td width="70%" bgcolor="#FFFFFF">
	    <?=$row[addr]?> &nbsp;
      </td>
    </tr>
	<tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">AS���� ����</td>
      <td width="70%" bgcolor="#FFFFFF">
	    <?=$a_as_type[$row[as_type]]?> &nbsp;
      </td>
    </tr>
	<tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">��� ���۰���</td>
      <td width="70%" bgcolor="#FFFFFF">
        <?=number_format($row[start_amt])?>�� 
      </td>
    </tr>
	<tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">��ñ��� ����</td>
      <td width="70%" bgcolor="#FFFFFF">
         <?=$a_limit_type[$row[limit_type]]?> &nbsp;
      </td>
    </tr>
	<tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">��ñ��Ű�</td>
      <td width="70%" bgcolor="#FFFFFF">
        <?=number_format($row[limit_amt])?>�� 
      </td>
    </tr>
	<tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">������� ����</td>
      <td width="70%" bgcolor="#FFFFFF">
        <?=number_format($row[join_amt])?>�� 
      </td>
    </tr>
    <tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">�� �Ǹż���</td>
      <td width="70%" bgcolor="#FFFFFF">
        <?=number_format($row[total_cnt])?> ��
      </td>
    </tr>
	<tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">��� ���۽ð�</td>
      <td width="70%" bgcolor="#FFFFFF">
        <?=substr($row[auct_start],0,4)?>��
		<?=substr($row[auct_start],4,2)?>��
		<?=substr($row[auct_start],6,2)?>��
		<?=substr($row[auct_start],8,2)?>��
      </td>
    </tr>
	<tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">��� �����ð�</td>
      <td width="70%" bgcolor="#FFFFFF">
        <?=substr($row[auct_end],0,4)?>��
		<?=substr($row[auct_end],4,2)?>��
		<?=substr($row[auct_end],6,2)?>��
		<?=substr($row[auct_end],8,2)?>��
      </td>
    </tr>
	<tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">��۹��</td>
      <td width="70%" bgcolor="#FFFFFF"> <?=$a_trans_type[$row[trans_type]]?> &nbsp;
      </td>
    </tr>
    <tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">��ǰ�̹���</td>
      <td width="70%" bgcolor="#EFEFEF">&nbsp;
<?
if($row[prod_img]){
?>
      <img src="../../upload/a_image/<?=$row[prod_img]?>">
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
     <td bgcolor="#D9D9D9" width="20%" align="center">���� ����</td>
     <td bgcolor="#F5F5F5" width="80%">&nbsp;<?=$row[delete_chk ]?></td>
    </tr>
	<tr class="hanamii">
     <td bgcolor="#D9D9D9" width="20%" align="center">�������</td>
     <td bgcolor="#F5F5F5" width="80%">&nbsp;<?=$row[reg_date]?></td>
    </tr>
   </table>
  </td>
 </tr>
</table>
<table width="600" border="0" cellspacing="0" cellpadding="3">
 <tr>
  <td align="center"> 
   <a href='prod_list.php?page=<?=$page?>'>��Ϻ���</a>&nbsp;&nbsp;
   <a href='prod_write.php?mode=update&p_num=<?=$p_num?>&page=<?=$page?>'>�����ϱ�</a>
   &nbsp;&nbsp;
   <a href='prod_delete.php?p_num=<?=$p_num?>&page=<?=$page?>' onClick="return confirm('�����Ͻðڽ��ϱ�?')">�����ϱ�</a>
  </td>
 </tr>
</table>
</body>
</html>
