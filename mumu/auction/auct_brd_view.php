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
          &gt; <a href="../auction/auct_main.php">AUCTION</a> &gt; �Խ���</a></td>
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
<?
  $qry2 = "select * from auct_board where num='$brd_num' ";
  $res2 = mysql_query($qry2,$connect);
  $rows2 = mysql_fetch_array($res2);
?>
		  <tr>
		    <td>
			<br>
			  <table width="730" border="0" cellspacing="0" cellpadding="2" class="linetop">
				<tr bgcolor="#FFFFFF"> 
				  <td  class="line" width="100" align="center" bgcolor="#F5F5f5">����&nbsp;</td>
				  <td class="line"> 
					<?=stripslashes($rows2[subject])?>
				  </td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
				  <td  class="line" width="100" align="center" bgcolor="#F5F5f5">����&nbsp;</td>
				  <td class="line"> 
					<?=nl2br(stripslashes($rows2[contents]))?></textarea>
				  </td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
				  <td  class="line" width="100" align="center" bgcolor="#F5F5f5">�ۼ���&nbsp;</td>
				  <td class="line"> 
					<?=$rows2[wdate]?>
				  </td>
				</tr>
			  </table>
			  <table width="730" border="0" cellspacing="0" cellpadding="5">
				<tr> 
				  <td align="center">
              <?
			   //�α��� ���̸鼭 �۾��̰� �����϶�
			   if($_SESSION[p_id]){
			     if($rows2[user_id] == $_SESSION[p_id]){
			  ?>
			      <a href='auct_brd_del.php?brd_num=<?=$brd_num?>&anum=<?=$anum?>&md=write' onClick="return confirm('�����Ͻðڽ��ϱ�?')"><img src="../img/bt_delete2.gif" border="0"></a>
			   <?
				 }
			   }
			   ?>
				   <a href="auct_brd_list.php?anum=<?=$anum?>"><img src="../img/bt_list2.gif" border="0"></a>
				</td>
			   </tr>
			  </table>
			</td>
		  </tr>
		  </form>
          <tr>
		    <td align=center >
			  <table width="99%" border="0" cellspacing="1" cellpadding="5" bgcolor="#CCCEEE">
			 <?
				$m_qry = "select * from auct_board_memo where board_num_fk='$brd_num' order by mnum asc";
				$m_res = mysql_query($m_qry,$connect);
				for($i=0; $m_ksh=mysql_fetch_array($m_res);$i++){
			 ?>
				<tr> 
				  <td  class="name" width="140" style="padding:3 0 3 10px" bgcolor="#CCCEEE"><?=$m_ksh[user_id]?></td>
				  <td bgcolor="#FFFFFF" ><?=stripslashes(nl2br($m_ksh[memo]))?></td>
				  <td width="120" align="center" bgcolor="#FFFFFF"><?=$m_ksh[wdate]?>&nbsp;
			  <?
			   //�α��� ���̸鼭 �۾��̰� �����϶�
			   if($_SESSION[p_id]){
			     if($m_ksh[user_id] == $_SESSION[p_id]){
			  		  echo("<a href='auct_brd_del.php?anum=$anum&brd_num=$brd_num&m_num=$m_ksh[mnum]&md=memo'>X</a>");
				 }
			   }
			  ?>
				  </td>
				</tr>
			  <? 
				}
				mysql_free_result($m_res);
			  ?>
			  </table>
			  <table width="99%" border="0" cellspacing="0" cellpadding="0" class="line1">
				<form name='form2' action='auct_brd_post.php' method='post'>
				<tr>
				  <td width="140" align="center">���(���)����</td>
				  <td style="padding:5 0 7 5px">
					<textarea name="memo" cols="60" class="InputStyle" rows="5"></textarea>
					<input type=image src="../img/bt_ok2.gif" align="absmiddle" border="0">
				   </td>
				</tr>
				<input type='hidden' name='anum' value='<?=$anum?>'>
				<input type='hidden' name='brd_num' value='<?=$brd_num?>'>
				<input type='hidden' name='md' value='memo'>
				</form>
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
</table>
</body>
</html>
