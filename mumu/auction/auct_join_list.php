<?
include "../php/config.php";
// ���� ��ƿ�Լ�
include "../php/util.php";
// MySQL ����
$connect=my_connect($host,$dbid,$dbpass,$dbname);

?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=euc-kr">
<title>PHPSAMPLE SITE</title>
<link rel="stylesheet" href="../common/global.css">
<script language="JavaScript" src="../common/global.js"></script>
<script language="JavaScript" src="../common/auction.js"></script>
</head>
<body>
<?  
//��� �޴� �κ��� ���Ͽ��� �ҷ��ɴϴ�.
include '../include/top_menu.php';  
?>
<br>
<table style="border-width:1; border-style:solid;" border="0" cellpadding="0" cellspacing="0" width="938">
  <tr>
    <td width="210" height="376" valign="top">
	  <?  
      //���� �α��� �κ��� ���Ͽ��� �ҷ��ɴϴ�.
      include '../include/left_login.php';  

      //������α׷��� ���� �޴��� ���Ͽ��� �ҷ��ɴϴ�.
      include '../include/left_menu3.php';  
      ?>
    </td>
    <td width="728" valign="top" >
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr> 
        <td height="30" style="padding:10 0 0 14px"><a href="/">Ȩ</a> 
          &gt; <a href="../auction/auct_main.php">AUCTION</a> &gt; ��ű��</a></td>
      </tr>
     </table>
<?
$query = "select * from auct_master where anum=$anum";
$result = mysql_query($query, $connect);
$rows = mysql_fetch_array($result);
mysql_free_result($result);

if(!$rows){
  err_msg('��� �ڵ忡 ���ϴ� ��Ű� �������� �ʽ��ϴ�.');
}
?>
     <table width="645" border="0" cellspacing="0" cellpadding="0">
	   <tr> 
        <td valign="top"> <br>
          <table width="90%" border="0" cellspacing="0" cellpadding="0">
            <tr> 
             <td height="30" align="center" class="text5"><?=$rows[prod_name]?></td>
            </tr>
            <tr> 
             <td height="5" bgcolor="#585858"></td>
            </tr>
           </table>
           <br> 
		   <table width="90%" border="0" cellspacing="0" cellpadding="0">
            <tr> 
             <td width="80" height="26" class="line">��Ÿ�����</td>
             <td class="line"> 
			 <?=substr($rows[auct_end],0,4)?>��
			 <?=substr($rows[auct_end],4,2)?>��
			 <?=substr($rows[auct_end],6,2)?>��
		     <?=substr($rows[auct_end],8,2)?>��  
			 </td>
			 <td width="80" height="26" class="line">�ǸŰ���</td>
             <td class="line"> 
			 <?=number_format($rows[total_cnt])?>��
			  </td>
            </tr>
			<tr> 
             <td width="80" height="26" class="line">���簡</td>
             <td class="line"> <?=number_format($rows[curr_amt])?>��</td>
			 <td width="80" height="26" class="line">��ñ��Ű�</td>
             <td class="line"> <?=number_format($rows[limit_amt])?>��</td>
            </tr>			
            </table>
          </td>
         </tr>
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
	<?
     if($rows[end_chk]=='Y'){
	     $go_join    = "javascript:alert('����� ����Դϴ�.')";
	 }
	 else{
			if(!$_SESSION[p_id]){
				$go_join    = "javascript:alert('��������� �α��� �Ŀ� �����մϴ�.')";
			}
			else{
				 $go_join    = "auct_join.php?anum=$anum&gb=1";
			}
	 }
  ?>   
		  <tr>
		   <td align=center colspan="2">
		     <br>
		     <table width="90%" border="0" cellspacing="4" cellpadding="5">
              <tr> 
               <td align="center">
			    <b><a href="<?=$go_join?>">�������</a></b> | 
			   <b><a href="auct_details.php?anum=<?=$anum?>">��������</a></b>
			   </td>
              </tr>
             </table>
		   </td>
		  </tr>
        </table>		
	</td>
  </tr>
  </form>
</table>
</body>
</html>