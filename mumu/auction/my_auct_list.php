<?
include "../php/config.php";
// ���� ��ƿ�Լ�
include "../php/util.php";
// MySQL ����
$connect=my_connect($host,$dbid,$dbpass,$dbname);

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
          &gt; <a href="../auction/auct_main.php">AUCTION</a> &gt; 
		  <a href="../auction/my_auct_list.php">���� ��Ÿ��</a></td>
      </tr>
     </table>
     <table width="100%" border="0" cellspacing="1" cellpadding="2">
      <form name=form1 method='post'>
	  <tr> 
       <td class=line-t height=1 bgcolor="#e1e1e1"></td>
      <tr> 
     </table>
	 <br>
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr bgcolor="CCCCCC"> 
	   <td colspan="2" align="center" class="line2">��ǰ��</td>
       <td width="90" align="center" class="line2">���簡</td>
	   <td width="150" align="center" class="line2">�����Ͻ�</td>
       <td width="60" align="center" class="line2">������</td>
	   <td width="60" align="center" class="line2">�������</td>
     </tr>
	<?
	$end_chr['Y'] = "<font color=red>����</font>";
	$end_chr['N'] = "������";

	$query1 = "select auction_code_fk from auct_master_join 
	          where user_id='$_SESSION[p_id]' 
			  group by auction_code_fk ";
	$result1 = mysql_query($query1, $connect);
	for($i=0; $rows1 = mysql_fetch_array($result1); $i++){
	   $query = "select * from auct_master where anum='$rows1[auction_code_fk]' ";
	   $result = mysql_query($query,$connect);
	   $rows = mysql_fetch_array($result);
	?>
      <tr> 
       <td width="40" align="center" class="line">
	   <?
	    if($rows[prod_img]){
	   ?>
	     <img src="/upload/a_image/<?=$rows[prod_img]?>" width="30" height="30" onerror="this.src='../img/noimage.gif'" border="0">
	  <? } ?>
	   </td>
       <td class="line">
	     <a href="auct_details.php?anum=<?=$rows[anum]?>&l_code=<?=$l_code?>"><?=$rows[prod_name]?></a>
	   </td>
       <td align="center" class="line"><?=number_format($rows[curr_amt])?></td>
       <td align="center" class="line"> 
		<?=substr($rows[auct_end],4,2)?>��
		<?=substr($rows[auct_end],6,2)?>��
		<?=substr($rows[auct_end],8,2)?>��  
	   </td>
	   <td align="center" class="line"><?=number_format($rows[join_cnt])?></td>
	   <td height="40" align="center" class="line">
	    <?=$end_chr[$rows[end_chk]]?>
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
</body>
</html>
