<?
include "../../php/config.php";
// ���� ��ƿ�Լ�
include "../../php/util.php";
// MySQL ����
$connect=my_connect($host,$dbid,$dbpass,$dbname);

?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=euc-kr">
<title>PHPSAMPLE SITE</title>
<link rel="stylesheet" href="../../common/global.css">
<script language="JavaScript" src="../../common/global.js"></script>
</head>
<body>

<table border="0" cellpadding="0" cellspacing="0" width="770">
  <tr>    
    <td width="770" valign="top" >
     <table width="770" border="0" cellspacing="0" cellpadding="0">
	   <tr> 
        <td valign="top"> 
          <table width="98%" border="0" cellspacing="0" cellpadding="0">
		   <tr>
		    <td>
			<br>
		  	 <table width="100%" border="0" cellspacing="0" cellpadding="0">
			    <tr bgcolor="#FFFFFF"> 
				   <td align="center" class="hanamii" colspan="7">
					<b>��� ��� </b>
				   </td>
				 </tr>
				<tr bgcolor="#FFFFFF"> 
				   <td align="right" class="hanamii" colspan="7">
					���� : <font color=red>������</font> | 
						   <font color=blue>������ ������</font> 
				   </td>
				 </tr>
				  <tr bgcolor="CCCCCC"> 
				   <td align="center" class="hanamii">������</td>
				   <td align="center" class="line2">��������</td>
				   <td align="center" class="line2">��������</td>
				   <td align="center" class="line2">��������</td>
				   <td align="center" class="line2">��������</td>
				 </tr>
				<?
				
				$font_chr['1'] = "red";
				$font_chr['2'] = "blue";
				$font_chr['3'] = "black";

				$t_cnt = 0;

				$query1 = "select * from auct_master_join
						  where auction_code_fk='$anum'
						  order by join_gb asc ,amount desc , jnum asc ";
				$result1 = mysql_query($query1, $connect);
				for($i=0; $rows1 = mysql_fetch_array($result1); $i++){
				   
				   //��ñ���
				   if($rows1[join_gb] =='1'){
					 if($t_cnt < $rows[total_cnt]) {
					   $font_gb = "1";   //����
					 }
					 else{
					   $font_gb = "3";   //�Ұ�
					 }
				   }
				   else {  //�Ϲ� ����
					  if($t_cnt < $rows[total_cnt]) {
						$font_gb = "2";   //��������
					 }
					 else{
					   $font_gb = "3";   //�Ұ�
					 }
				   }

				   $t_cnt = $t_cnt + $rows1[volume];
				   
				?>
				  <tr height="25"> 
				   <td align="center" class="hanamii">
					<font color="<?=$font_chr[$font_gb]?>"><?=$rows1[user_id]?></font>
				   </td>
				   <td align="center" class="hanamii">
					<?=$rows1[join_created]?>
				   </td>
				   <td align="center" class="hanamii">
					<?=number_format($rows1[amount])?> ��
				   </td>
				   <td align="center" class="hanamii">
					 <?=number_format($rows1[volume])?> ��
				   </td>
				   <td align="center" class="hanamii">
					 <?=number_format($t_cnt)?> ��
				   </td>
				  </tr>
				<?
				 }  
				 mysql_free_result($result1);
				?>
				 </table>
			</td>
		  </tr>
       </table>		
	</td>
  </tr>
</table>
</body>
</html>
