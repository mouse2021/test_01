<?
// ����ġ ����
include "../../php/auth.php";
// ����Ÿ���̽� �������� �� ��Ÿ����
include "../../php/config.php";
// ���� ��ƿ�Լ�
include "../../php/util.php";
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
<table width="750" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td bgcolor="#666666">
      <table width="100%" border="0" cellspacing="1" cellpadding="2">
        <tr bgcolor="#D9D9D9" class="hanamii" align="center">
          <td width="20%">�з�</td>
          <td width="20%">��ǰ��</td>
          <td width="10%">��Ž��۰�</td>
		  <td width="20%">��� ��������</td>
          <td width="20%">��� ��������</td>
		  <td width="5%">��������</td>
		  <td width="5%">�Ǹż���</td>
         </tr>
<?
	// ��ǰ�� ������ ��� ������
	$query  = "select a.anum from auct_master a , auct_category b
	           where a.category_fk=b.code ";
	$result = mysql_query($query, $connect);
	$total  = mysql_num_rows($result);
	mysql_free_result($result);

    $scale=15;

    if ($page == ''){
       $page=1;
    }	    

    $cpage = intval($page);
    $totalpage = intval($total/$scale);
    if ($totalpage*$scale != $total)
      $totalpage = $totalpage + 1;
        
    if ($cpage ==1) {
	   $cline = 0 ;
    } else {
	   $cline = ($cpage*$scale) - $scale ;
    } 
        
	$limit=$cline+$scale;
        
	if ($limit >= $total) 
       $limit=$total;
 
    $scale1 = $limit - $cline;

    $a_del_char['Y'] = "<font color=red>����</font>";
    $a_del_char['N'] = "����";

    $query = "select * from auct_master a , auct_category b
              where a.category_fk=b.code 
	  	      order by a.anum desc limit $cline,$scale1";
    $result = mysql_query($query, $connect);

  for($i=0; $row = mysql_fetch_array($result); $i++){
       
		$list_num = $total - ($cline + $i);
      
        if($i%2 == 0){
                $bgcolor = "#FFFFFF";
        }else{
                $bgcolor = "#F5F5F5";
        }

?>
        <tr bgcolor="<?=$bgcolor?>" align="center" class="hanamii">
          <td>&nbsp;<a href="prod_view.php?p_num=<?=$row[anum]?>&page=<?=$page?>"><?=$row[name]?></a></td>
		  <td>&nbsp;<a href="prod_view.php?p_num=<?=$row[anum]?>&page=<?=$page?>"><?=$row[prod_name]?></a></td>
          <td>&nbsp;<?=number_format($row[start_amt])?>��</td>
		  <td>
		    <?=substr($row[auct_start],0,4)?>��
		    <?=substr($row[auct_start],4,2)?>��
			<?=substr($row[auct_start],6,2)?>��
			<?=substr($row[auct_start],8,2)?>��
		  </td>
		  <td>
		    <?=substr($row[auct_end],0,4)?>��
		    <?=substr($row[auct_end],4,2)?>��
			<?=substr($row[auct_end],6,2)?>��
			<?=substr($row[auct_end],8,2)?>��
		  </td>
		  <td>&nbsp;<?=$a_del_char[$row[delete_chk]]?></td>
          <td>&nbsp;<?=$row[total_cnt]?>��</td>
		 </tr>
	 <?
	}
	mysql_free_result($result);
	?>
	<?
	if($total == 0){
	?>
          <tr bgcolor="#FFFFFF" align="center" class="hanamii">
            <td colspan="7">��ϵ� ������ �����ϴ�.</td>
          </tr>
	<?
		}
	?>
      </table>
    </td>
  </tr>
</table>
<br>
<table width="750" border="0" cellspacing="0" cellpadding="3">
  <tr bgcolor="#FFFFFF" align="center" class="hanamii">
    <td>
	<?
	  $url = "$PHP_SELF?mode=$mode"; 
      page_avg($totalpage,$cpage,$url); 
	?>
	</td>
  </tr>
  <tr>
    <td align="right">
      <input type="button" value="��ǰ���" onClick="location='prod_write.php?page=<?=$page?>'">
    </td>
  </tr>
</table>

</form>
</body>
</html>
