<?
include "../php/config.php";
// ���� ��ƿ�Լ�
include "../php/util.php";
// MySQL ����
$connect=my_connect($host,$dbid,$dbpass,$dbname);

//����� ��� ������Ʈ
end_exe($connect);

if(!isset($_SESSION["p_id"]) || !isset($_SESSION["p_name"])){
  err_msg('ȸ�� �α��� �� ����� �� �ֽ��ϴ�.');
}
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
          &gt; <a href="../auction/auct_main.php">AUCTION</a> &gt; ������</a></td>
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

if($rows[end_chk]=='Y'){
  err_msg('�̹� ����� ����Դϴ�.');
}

$now_time = date('YmdH');

if($rows[auct_start] > $now_time){
   err_msg('���� �������� ���� ����Դϴ�. ��� ���� �� �����Ͽ� �ֽñ� �ٶ��ϴ�.');
}

if($rows[auct_end] <= $now_time){
  err_msg('��Ű� ����Ǿ����ϴ�.');
}

$t_cnt = 0;
//�ʱ� ��� ���۰�
$w_join_amt1 = $rows[start_amt];

//�ʱ� �������� ��Ž��۰��� (������ ���� ��� ���)
$w_join_amt = $w_join_amt1;

$query1 = "select * from auct_master_join
 		   where auction_code_fk='$anum'
	 	   order by join_gb asc , amount desc , jnum asc ";
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
		$w_join_amt2 = $rows1[amount];
	 }
	 else{
	   $font_gb = "3";   //�Ұ�
	 }
  }
  $t_cnt = $t_cnt + $rows1[volume];

  //���� ���� ��� ���� ��û�ڰ� ���� ��쿡�� �������ɰ��� ���۰��� �մϴ�.
  if($t_cnt < $rows[total_cnt]){
    $w_join_amt = $w_join_amt1;
  }
  else{  
    $w_join_amt = $w_join_amt2 + (int)$rows[join_amt]; 
  }
  
  // �Ʒ��ʿ��� �����ֱ� ���� �迭�� ���� �ӽ� �����մϴ�.
  $ary_1[$i] = $rows1[user_id];
  $ary_2[$i] = $font_gb;
  $ary_3[$i] = $rows1[join_created];
  $ary_4[$i] = $rows1[amount];
  $ary_5[$i] = $rows1[volume];
  $ary_6[$i] = $t_cnt;

}
mysql_free_result($result1);
?>
     <table width="645" border="0" cellspacing="0" cellpadding="0">
	   <form name="form1" method="post">
	   <input type="hidden" name="anum" value="<?=$anum?>">
	   <input type="hidden" name="gb" value="<?=$gb?>">
	   <input type="hidden" name="limit_type" value="<?=$rows[limit_type]?>">
	   <input type="hidden" name="limit_amt" value="<?=$rows[limit_amt]?>">
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
			<tr> 
             <td width="80" height="26" class="line">��������</td>
             <td class="line" colspan="3"> 
			  <input type="hidden" name="join_cnt_1" value="<?=($rows[total_cnt] - $rows[limit_cnt])?>">
			  <input type="text" name="join_cnt" size="3" onKeyUp="onlyNumber1(this)" value="1">�� 
			  (�ִ� ��û���� ���� : <?=($rows[total_cnt] - $rows[limit_cnt])?> ��)

			 </td>
            </tr>			
			<tr> 
             <td width="80" height="26" class="line">��������</td>
             <td class="line" colspan="3"> 
			<?
			  // ��ñ����϶�
			  if($gb=='2'){
			?>
			<input type="text" name="join_amt" readonly size="7" onKeyUp="onlyNumber1(this)" value="<?=$rows[limit_amt]?>">�� 
			<?
			  }
			  else{ //��ñ��Ű� �ƴҶ�
			 ?>
			  <input type="text" name="join_amt" size="7" onKeyUp="onlyNumber1(this)" value="<?=$w_join_amt?>">�� 
			 <? } ?>
			  (�ּ� ���� ���� �ݾ� : <?=number_format($w_join_amt)?> �� , �������� <?=number_format($rows[join_amt])?>)
			  <input type="hidden" name="join_amt_1" value="<?=$w_join_amt?>">
			 </td>
            </tr>			
            </table>
          </td>
         </tr>
		 <tr>
		   <td align=center colspan="2">
		     <br>
		     <table width="90%" border="0" cellspacing="4" cellpadding="5">
              <tr> 
               <td align="center">
			    <b><a href="javascript:auct_send()">�������</a></b> | 
			   <b><a href="javascript:history.go(-1)">����������</a></b>
			   </td>
              </tr>
             </table>
		   </td>
		  </tr>
		  <tr>
		    <td>
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
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

				for($i=0; $i < sizeof($ary_1); $i++){
				?>
				  <tr height="25"> 
				   <td align="center" class="hanamii">
					<font color="<?=$font_chr[$ary_2[$i]]?>"><?=$ary_1[$i]?></font>
				   </td>
				   <td align="center"  class="hanamii">
					<?=$ary_3[$i]?>
				   </td>
				   <td align="center" class="hanamii">
					<?=number_format($ary_4[$i])?> ��
				   </td>
				   <td align="center" class="hanamii">
					 <?=number_format($ary_5[$i])?> ��
				   </td>
				   <td align="center" class="hanamii">
					 <?=number_format($ary_6[$i])?> ��
				   </td>
				  </tr>
				<?
				 }  
				?>
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