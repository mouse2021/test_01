<?
include "../php/config.php";
// ���� ��ƿ�Լ�
include "../php/util.php";
// MySQL ����
$connect=my_connect($host,$dbid,$dbpass,$dbname);

//����� ��� ������Ʈ
end_exe($connect);

?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=euc-kr">
<title>PHPSAMPLE SITE</title>
<link rel="stylesheet" href="../common/global.css">
<script language="JavaScript" src="../common/global.js"></script>
<script language="JavaScript" type="text/JavaScript">
<!--
function initObj() {
	var sys_time = document.all['systime_1'].value;
	var time = new Date(sys_time.substring(0,4), sys_time.substring(4,6) - 1, sys_time.substring(6,8), sys_time.substring(8,10), sys_time.substring(10,12), sys_time.substring(12,14));
	var to_time = document.all['totime_1'].value;
	var time2 = new Date(to_time.substring(0,4), to_time.substring(4,6) - 1, to_time.substring(6,8), to_time.substring(8,10), to_time.substring(10,12), to_time.substring(12,14));
	document.all['clock2_1'].value = time2 - time; 
  clock();
}

function clock() {
  document.all['clock2_1'].value = document.all['clock2_1'].value - 1000;
  var current_time = document.all['clock2_1'].value;
  var hh = Math.floor(((current_time)/1000/60/60));
  var m = Math.floor((((current_time)/1000/60/60) - hh)*60);
  var ss = Math.floor((((((current_time)/1000/60/60) - hh)*60) - m)*60);
  if(hh < 0 || m < 0 && ss < 0){
    document.all['clock1_1'].value = "��Ű� �����Ǿ����ϴ�."; 
  }
  else{
   document.all['clock1_1'].value = hh + "�ð� " + m + "�� " + ss + "�� ���ҽ��ϴ�."; 
  }

 setTimeout("clock()", 1000);
}

//-->
</script>
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
     <table width="645" border="0" cellspacing="0" cellpadding="0">
	   <tr> 
        <td width="200" height="300" align="center" valign="middle">
	  	  <?
		  if($rows[prod_img]){
		    $a_size = getimagesize ("../upload/a_image/".$rows[prod_img]);
            $width = $a_size[0];
            $height = $a_size[1];
			if($width > 200){
			  $width = "200";
			}
			if($height > 200){
			  $height = "200";
			}
		 ?>
		   <img src="/upload/a_image/<?=$rows[prod_img]?>" width="<?=$width?>" height="<?=$height?>" onerror="this.src='../img/noimage.gif'">
		 <? 
	       }
		 ?>
        </td>
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
             <td width="80" height="26" class="line">�Ⱓ</td>
             <td class="line"> 
             <?=substr($rows[auct_start],0,4)?>��
			 <?=substr($rows[auct_start],4,2)?>��
			 <?=substr($rows[auct_start],6,2)?>��
		     <?=substr($rows[auct_start],8,2)?>�� ~
			 <?=substr($rows[auct_end],0,4)?>��
			 <?=substr($rows[auct_end],4,2)?>��
			 <?=substr($rows[auct_end],6,2)?>��
		     <?=substr($rows[auct_end],8,2)?>��  
			 </td>
            </tr>
			<tr> 
             <td width="80" height="26" class="line">�����ð�</td>
             <td class="line"> 
		<?
         if($rows[end_chk]=='Y'){
		?>
		      <font color=red><b>����Ǿ����ϴ�.</b></font>
		<?
		 }
		 else{
			 $start_time = $rows[auct_start];
             $end_time   = $rows[auct_end];
              
			 $now_time = date('YmdH');
             if($start_time > $now_time){
			   echo"���� ���۵��� ���� ����Դϴ�.";
			 }
			 else if($end_time <= $now_time){
			   echo"�̹� ����� ����Դϴ�.";
			 }
			 else{
		    ?>
			  <form name="time" method="post">
			  <input size="30" name="clock1_1" value="" style="border:0; color:e30000;" readonly>
		     <?
			   $endtime = $rows[auct_end]."0000";
			   $systime = date('YmdHis');
		     ?>
			   <input type="hidden" name="clock2_1" value="<?=$endtime?>">
			   <input type="hidden" name="systime_1" value="<?=$systime?>">
			   <input type="hidden" name="totime_1" value="<?=$endtime?>">
			   <script> initObj(); </script>
			   </form>
		<?
			 }
		 }
		?>
			  </td>
            </tr>
			<tr> 
             <td width="80" height="26" class="line">��� ���۰���</td>
             <td class="line"> <?=number_format($rows[start_amt])?> ��</td>
            </tr>
			<tr> 
             <td width="80" height="26" class="line">���簡��</td>
             <td class="line"> <?=number_format($rows[curr_amt])?> ��</td>
            </tr>
			<?
			//��ñ��Ű� �����Ҷ�
			if($rows[limit_type] =='1' && ((int)$rows[limit_amt]) > 0){
			?>
            <tr> 
             <td width="80" height="26" class="line">��ñ��Ű�</td>
             <td class="line"> <?=number_format($rows[limit_amt])?> �� <a href="auct_join.php?anum=<?=$anum?>&gb=2"><b>��ñ����ϱ�</b></a></td>
            </tr>
			<?
			}
			?>
			<tr> 
             <td width="80" height="26" class="line">�� �Ǹż���</td>
             <td class="line"> <?=number_format($rows[total_cnt])?> ��</td>
            </tr>
			<tr> 
             <td width="80" height="26" class="line">�����ڼ�</td>
             <td class="line"> <?=number_format($rows[join_cnt])?> ��</td>
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
	<?
     if($rows[end_chk]=='Y'){
	     $go_join    = "javascript:alert('����� ����Դϴ�.')";
		 $go_djoin   = "javascript:alert('����� ����Դϴ�.')";
		 $go_concern = "javascript:alert('����� ����Դϴ�.')";
	 }
	 else{
			if(!$_SESSION[p_id]){
				$go_join    = "javascript:alert('��������� �α��� �Ŀ� �����մϴ�.')";
				$go_djoin   = "javascript:alert('��ñ��Ŵ� �α��� �Ŀ� �����մϴ�.')";
				$go_concern = "javascript:alert('����ǰ�� ����� �α��� �Ŀ� �����մϴ�.')";
				$go_board   = "auct_brd_list.php?anum=$anum";
			}
			else{
				 $go_join    = "auct_join.php?anum=$anum&gb=1";
				 $go_djoin   = "auct_join.php?anum=$anum&gb=2";
				 $go_concern = "auct_concern_post.php?anum=$anum";
				 $go_board   = "auct_brd_list.php?anum=$anum";
			}
	 }
  ?>   
			    <b><a href="<?=$go_join?>">�������</a></b> | 
	<?
	//��ñ��Ű� �����Ҷ�
	if($rows[limit_type] =='1' && ((int)$rows[limit_amt]) > 0){
	?>
               <b><a href="<?=$go_djoin?>">��ñ���</a></b> |
	<?
	}
	?>
			   <b><a href="auct_join_list.php?anum=<?=$anum?>">��ű��</a></b> |
			   <b><a href="<?=$go_concern?>">����ǰ�� ���</a></b> | 
			   <b><a href="<?=$go_board?>">���ǰԽ���</a></b>

			   </td>
              </tr>
             </table>
		   </td>
		  </tr>
        </table>
        <br> 
		<table width="90%" border="0" cellpadding="0" cellspacing="0">
          <tr> 
           <td bgcolor="F7F7F7">-- ��ǰ ���� --</td>
          </tr>
          <tr> 
            <td>
		      <table width="100%" border="1" cellspacing="0" cellpadding="10">
                <tr> 
			       <td width="100" align=center bgcolor=#CCCFFF>
				     �Ǹ��� ��������
				   </td>
				   <td width="200" align=center>
				     <?=$rows[in_addr]?>
				   </td>
				   <td width="100" align=center bgcolor=#CCCFFF>
				     ������� ����
				   </td>
				   <td width="200" align=center>
				     <?=number_format($rows[join_amt])?>��
				   </td>
			     </tr>
				 <tr> 
				   <td width="100" align=center bgcolor=#CCCFFF>
				     �߰��ǰ ����
				   </td>
				   <td align=center>
				     <?=$a_prod_type[$rows[prod_type]]?>
				   </td>
				   <td width="100" align=center bgcolor=#CCCFFF>
				     �Ǹ� ��������
				   </td>
				   <td align=center>
				     <?=$rows[addr]?> &nbsp;
				   </td>
				</tr>
				<tr> 
				   <td width="100" align=center bgcolor=#CCCFFF>
				     AS���� ����
				   </td>
				   <td align=center>
				     <?=$a_as_type[$rows[as_type]]?>
				   </td>
				   <td width="100" align=center bgcolor=#CCCFFF>
				     ��۹��
				   </td>
				   <td align=center>
				     <?=$a_trans_type[$rows[trans_type]]?> &nbsp;
				   </td>
				</tr>
		 	  </table>
		 	</td>
			<tr> 
              <td height="10">&nbsp;</td>
            </tr>
		    <tr> 
              <td bgcolor="F7F7F7">-- ��ǰ �� ���� --</td>
            </tr>
            <tr> 
              <td>
		   	    <table width="100%" border="0" cellspacing="0" cellpadding="10">
                  <tr> 
                   <td>
	    	<?
			 if($rows[con_html] =='1'){
			    echo(stripslashes($rows[contents]));
			 }
			 else{
			    echo(nl2br(stripslashes($rows[contents])));
			  }
			?>
 	 	  	      </td>
                 </tr>
               </table>
			  </td>
            </tr>
        </table>
	</td>
  </tr>
</table>
</body>
</html>
