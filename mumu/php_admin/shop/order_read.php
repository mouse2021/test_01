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
<table width='100%' border='0'>
 <tr>
  <td valign='top'>
<?
$sql = "select * from mall_order where num = '$oid' ";
$res = mysql_query($sql,$connect);
$ksh1 = mysql_fetch_array($res);

$a_goods_fk = explode("|", $ksh1[goods_fk]);
$a_price = explode("|", $ksh1[goods_price]);
$a_volume = explode("|", $ksh1[goods_count]);

$temp .= "<table border='0' width='100%'>
			<tr bgcolor='#cbe2f5'>	
				<td align='center' >�̹���</td>
				<td align='center' >��ǰ��</td>
				<td align='center' >������</td>
				<td align='center' >����</td>
				<td align='center' >����</td>
			</tr>
";

 //���� ������ �ҷ��ɴϴ�.
for($i=0; $i<sizeof($a_goods_fk); $i++){
   $sql_5="select * from products where num='$a_goods_fk[$i]'";
   $result_5 = mysql_query($sql_5, $connect);
   $row_5 = mysql_fetch_array($result_5);

   $goods_name= shortenStr($row_5[name],20);
   $img_char = "../../upload/p_image/s/".$row_5[prod_code].".".$row_5[s_image_ty];

$temp .= "
		<tr>
		  <td align='center' class='hanamii'><img border=0 height=50 src='$img_char' width=50></td>
          <td align='center' class='hanamii'>$goods_name</td>
		  <td align='center' class='hanamii'>$row_5[company]</td>
		  <td align='center' class='hanamii'>&nbsp;$a_volume[$i]</td>
		  <td align='center' class='hanamii'>&nbsp;$a_price[$i]��</td>
		</tr>
	";
	
	$tot_amount = $tot_amount + ((int)$a_price[$i] * (int)$a_volume[$i]);
	$t_count = $t_count + (int)$a_volume[$i];
	
}
 
 $trans_cost = 0;
 if($trans_cost > 0){
   $amount_o = $tot_amount + $trans_cost;
   $amount_temp = " ( $tot_amount �� + $trans_cost �� ) ";
 }
 else{
   $amount_o = $tot_amount;
 }

 $temp .= "
    <tr bgcolor='#ece2f5'>
        <td colspan=3 align='right' class='hanamii'>�հ� : </td>
		<td align='center' class='hanamii'><font color=blue>$t_count</font>��</td>
		<td align='center' class='hanamii'><font color=blue>$tot_amount</font> ��</td>
	</tr>
 	";
		
 $temp .= "</table>";

if($ksh1[payment_type]==1) { $payment_type = "������ �Ա�"; }
if($ksh1[payment_type]==2) { $payment_type = "�ſ�ī��"; }
if($ksh1[payment_type]==2) { $payment_type = "�޴��� ����"; }


$a_status['3'] = "�Ա�Ȯ����"; 
$a_status['5'] = "�Ա�Ȯ��"; 
$a_status['7'] = "�����"; 
$a_status['8'] = "��ۿϷ�"; 
?>

  <table width='94%' border='0' cellspacing='2' cellpadding='1' >
   <tr> 
    <td height='25' align='center' >
	 <b>�ֹ� �� ���� ( <font color='red' ><?=$oid?></font> )</b></td>
   </tr>
  </table>
  <table width='94%' border='0' cellspacing='0' cellpadding='0'>
    <tr bgcolor='#3a9edf'> 
     <td > 
	<table width='100%' border='0' cellspacing='1' cellpadding='3'>
	<tr bgcolor='#cbe2f5'> 
	 <td  class='hanamii' align='center' height='20'><b>�ֹ�����</b></td>
	 <td  class='hanamii' align='left' colspan=3 bgcolor='white'><?=$temp?></td>
	</tr>
	<tr bgcolor='#cbe2f5'> 
	 <td  class='hanamii' align='center' width='100' ><b>�ֹ���ȣ</b></td>
	 <td  class='hanamii' align='center' bgcolor='white'><?=$ksh1[orderid]?></td>
	 <td  class='hanamii' align='center' width='100' ><b>��������</b></td>
	 <td  class='hanamii' align='center' bgcolor='white' ><?=$ksh1[createdate]?></td>
    </tr>
    <tr bgcolor='#cbe2f5'> 
     <td  class='hanamii' align='center' width='100' ><b>������</b></td>
     <td  class='hanamii' align='left' valign='top' bgcolor='white'>
	  	�����ڸ� : <?=$ksh1[buyer_name]?> <br>
	   	�����ȣ : <?=$ksh1[buyer_zipno]?> <br>
	   	�����ּ� : <?=$ksh1[buyer_address]?> <br>
	   	������ȣ : <?=$ksh1[buyer_phone]?> <br>
		�޴��� : <?=$ksh1[buyer_hphone]?> <br>
	   	E-mail : <a href='mailto:<?=$ksh1[buyer_email]?>'>
		(���� ����)�� <?=$ksh1[buyer_email]?></a>
     </td>
     <td  class='hanamii' align='center' width='100' ><b>������</b></td>
     <td  class='hanamii' align='left' valign='top' bgcolor='white'>	
    	�����ڸ� : <?=$ksh1[recipient_name]?> <br>
    	�����ȣ : <?=$ksh1[recipient_zipno]?> <br>
    	�����ּ� : <?=$ksh1[recipient_address]?> <br>
    	������ȣ : <?=$ksh1[recipient_phone]?> <br>
		�޴��� : <?=$ksh1[recipient_hphone]?> 
	 </td>
    </tr>
    <tr bgcolor='#cbe2f5'> 
	 <td  class='hanamii' align='center' height='20'><b>ID ����</b></td>
	 <td  class='hanamii' bgcolor='white' colspan='3'><?=$ksh1[user_id]?></td>
   </tr>
   <tr bgcolor='#cbe2f5'> 
	<td  class='hanamii' align='center' height='20'><b>�������</b></td>
	<td  class='hanamii' align='center' bgcolor='white' ><?=$payment_type?></td>
	<td  class='hanamii' align='center' height='20'><b>���űݾ�</b></td>
	<td  class='hanamii' align='center' bgcolor='white' >
	  <?=number_format($ksh1[amount])?> �� 
	  (��ۺ� : <?=number_format($ksh1[trans_cost])?> ��)
	</td>
   </tr>
   <tr bgcolor='#cbe2f5'> 
	<td  class='hanamii' align='center' height='20'>
	  <b>����Ʈ ���</b>
	</td>
	<td  class='hanamii' align='center' bgcolor='white' >
	  <?=number_format($ksh1[mileage_use])?> ��
	</td>
	<td  class='hanamii' align='center' height='20'>
	  <b>����Ʈ ����</b>
	</td>
	<td  class='hanamii' align='center' bgcolor='white' >
	  <?=number_format($ksh1[mileage_add])?> ��
	</td>
   </tr>
   <tr bgcolor='#cbe2f5'> 
	<td  class='hanamii' align='center' height='20'><b>�� �����ݾ�</b></td>
	<td  class='hanamii' colspan='3' bgcolor='white' >
	 <font color=red><b><?=number_format($ksh1[real_amount])?> ��</font></b>
    </td>
  </tr>
  <tr bgcolor='#cbe2f5'> 
    <td  class='hanamii' align='center' width='100' ><b>����</b></td>
    <td  class='hanamii' align='center' bgcolor='white'>
	  <?=$a_status[$ksh1[status]]?>
    </td>
	<td  class='hanamii' align='center' width='100' ><b>���º���</b></td>
	<td  class='hanamii' align='center' bgcolor='white'>
	  <a href='order_change.php?mode=1&oid=<?=$oid?>&status=<?=$ksh1[status]?>'
	    onClick="return confirm('���� �Ͻðڽ��ϱ�?')">�Ա�Ȯ��</a>/
	  <a href='order_change.php?mode=2&oid=<?=$oid?>&status=<?=$ksh1[status]?>'
	    onClick="return confirm('���� �Ͻðڽ��ϱ�?')" >�����</a>/ 
	  <a href='order_change.php?mode=3&oid=<?=$oid?>&status=<?=$ksh1[status]?>' 
	    onClick="return confirm('��ۿϷ�� ��ǰ�� ����Ʈ�� ���� ��� ���ϸ����� �����ǰ� �˴ϴ�. �����Ͻðڽ��ϱ�?')" >��ۿϷ�</a> 
	</td>
   </tr>
   <?
   //������ �Աݽø� ���
   if($ksh[payment_type]=='1'){
   ?>
   <tr bgcolor='#cbe2f5'> 
	<td  class='hanamii' align='center' height='20'><b>�Ա������</b></td>
    <td  class='hanamii' align='center' bgcolor='white'><?=$ksh1[bank]?></td>
    <td  class='hanamii' align='center' width='100' ><b>�Ա���</b></td>
	<td  class='hanamii' align='center' colspan=3 ><?=$ksh1[account]?></td>
   </tr>
   <tr bgcolor='#cbe2f5'> 
	<td  class='hanamii' align='center' height='20'><b>�Աݿ�����</b></td>
    <td  class='hanamii' colspan='3'  bgcolor='white'>&nbsp;&nbsp;&nbsp;<?=$ksh1[deposit_date]?></td>
   </tr>
  <?
   }
  ?>
  </table>
 </td>
</tr>
</table>
<table width='94%' border='0' cellspacing='2' cellpadding='1' >
    <tr> 
    <td height='25' align='left' ><a href='order_list.php?page=<?=$page?>'> <b>��Ϻ���</b></a></td>
  </tr>
</table>
</td>
 </tr>
 </table>