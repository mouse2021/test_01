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
		  <tr>
		    <td>
			<br>
		  	 <table width="100%" border="0" cellspacing="0" cellpadding="0">
			    <tr bgcolor="#FFFFFF"> 
				   <td align="center" class="hanamii" colspan="7">
					<b>��Ź��� �Խ��� </b>
				   </td>
				 </tr>
				  <tr bgcolor="CCCEEE" height="30"> 
				   <td align="center" width="10%" class="hanamii"><b>��ȣ</b></td>
				   <td align="center" width="65%" class="line2"><b>����</b></td>
				   <td align="center" width="15%" class="line2"><b>�ۼ�����</b></td>
				 </tr>
				<?
	
				$query = "select num from auct_board 
				          where auction_code_fk='$anum' ";
				$result = mysql_query($query, $connect);
				$total_bnum = mysql_num_rows($result);
				mysql_free_result($result);

				 if(!$page){
					$page = 1;
				 }

				  $p_scale=10;

				 $cpage = intval($page);
				 $totalpage = intval($total_bnum/$p_scale);
				  if ($totalpage*$p_scale != $total_bnum)
					$totalpage = $totalpage + 1;
					  
				  if ($cpage ==1) {
					  $cline = 0 ;
				  } else {
					  $cline = ($cpage*$p_scale) - $p_scale ;
				  } 
						
				   $limit=$cline+$p_scale;
						
				  if ($limit >= $total_bnum) 
						$limit=$total_bnum;

				  $p_scale1 = $limit - $cline;

				$query1 = "select * from auct_board 
				           where auction_code_fk='$anum' 
						   order by num desc limit $cline,$p_scale1";
				$result1 = mysql_query($query1, $connect);
				for($i=0; $rows1 = mysql_fetch_array($result1); $i++){
				   $bunho = $total_bnum - ($i + $cline) + 1;
				?>
				  <tr height="25"> 
				   <td align="center" class="hanamii">
					<?=$bunho?>
				   </td>
				   <td class="hanamii">
					<a href="auct_brd_view.php?anum=<?=$anum?>&brd_num=<?=$rows1[num]?>"><?=$rows1[subject]?> 
					<?
					 //�޸� ������
				     if($rows1[re_cnt] > 0 ){
					  echo" ( $rows1[re_cnt] ) ";
				     }
					?>
				   </td>
				   <td align="center" class="hanamii">
					<?=$rows1[wdate]?>
				   </td>
				  </tr>
				<?
				 }  
				 mysql_free_result($result1);
				?>
				 <tr height="25"> 
				   <td align="center" colspan="4" class="hanamii">
					<?
					 if($total_bnum > 0){
						$url = "auct_brd_list.php?anum=$anum"; 
						page_avg($totalpage,$cpage,$url); 
					 }
					?>     
				   </td>
				  </tr>
				  <tr height="25"> 
				   <td align="right" colspan="4" class="hanamii">
					<a href="auct_brd_write.php?anum=<?=$anum?>"><img src="../img/bt_write2.gif" border="0"></a>
				   </td>
				  </tr>
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
