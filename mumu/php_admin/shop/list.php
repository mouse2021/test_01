<?
// ����ġ ����
include "../../php/auth.php";
// ����Ÿ���̽� �������� �� ��Ÿ����
include "../../php/config.php";
// ���� ��ƿ�Լ�
include "../../php/util.php";
// MySQL ����
$connect=my_connect($host,$dbid,$dbpass,$dbname);

// ī�װ����� 1�̻��� �ƴҰ�� 1��..
if(!$level){
	$level = 1;
}
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
  <td>
   <table border="0" cellspacing="1" cellpadding="2">
    <tr class="hanamii">
     <td>������ġ : <a href="list.php?level=1">ó��</a> &gt; </td>
<?
	$query = "select * from products_category1 ";
	$result2 = mysql_query($query, $connect);
	
// ������ġ ǥ��
for($i=1; $row2 = mysql_fetch_array($result2); $i++){
    $category_code = $row2[code];
	$category_name = $row2[name];
?>
     <td align="center"><a href="list.php?level=2&category_code_fk=<?=$category_code?>"><?=$category_name?></a> &gt; </td>
<?
}
mysql_free_result($result2);
?>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>
      <table width="100%" border="0" cellspacing="1" cellpadding="2">
        <tr class="hanamii">
          <td> <b>ī�װ��� �����ϼ���. </b><br>
<?
if(($level == 2) || ($level == 3)){
	$query = "select * from products_category2 where category_code_fk='$category_code_fk' order by code";
    $result = mysql_query($query, $connect);

   for($i=0; $row = mysql_fetch_array($result); $i++){
	if($i == 0){
		if(!$category_code){
			$category_code = $row[code];
		}
	}else{
		   echo(" | ");
	}
	 echo("<a href=$PHP_SELF?level=3&l_category_fk=$row[code]&category_code_fk=$category_code_fk>$row[name]</a>");
  }
}
?>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td bgcolor="#666666">
      <table width="100%" border="0" cellspacing="1" cellpadding="2">
        <tr bgcolor="#D9D9D9" class="hanamii" align="center">
          <td width="5%">��ȣ</td>
          <td width="15%">������(������)</td>
          <td width="25%">��ǰ��</td>
          <td width="15%">�Һ��� ����</td>
		  <td width="15%">�ǸŰ���</td>
          <td width="13%">�̺�Ʈ</td>
		  <td width="13%">�Ż�ǰ</td>
         </tr>
<?

if($mode =='search'){
 $sear_char = " and $key like '%$key_value%' ";
}

if($category_code_fk){
  $qry_char = " and category_fk ='$category_code_fk' ";
}
if($l_category_fk){
  $qry_char .= " and l_category_fk ='$l_category_fk' ";
}

// ��ǰ�� ������ ��� ������
$query  = "select * from products where 1 $qry_char $sear_char ";
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


  $query = "select * from products 
            where 1 $qry_char $sear_char 
	  	    order by num desc limit $cline,$scale1";
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
          <td>&nbsp;<a href="view.php?p_num=<?=$row[num]?>&level=<?=$level?>&category_code_fk=<?=$row[category_fk]?>&page=<?=$page?>&l_category_fk=<?=$row[l_category_fk]?>"><?=$list_num?></a></td>
          <td>&nbsp;<?=$row[company]?></td>
          <td>&nbsp;<a href="view.php?p_num=<?=$row[num]?>&level=<?=$level?>&category_code_fk=<?=$row[category_fk]?>&page=<?=$page?>&l_category_fk=<?=$row[l_category_fk]?>"><?=$row[name]?></a></td>
		  <td>&nbsp;<?=number_format(trim($row[cust_price]))?>��</td>
          <td>&nbsp;<?=number_format(trim($row[price]))?>��</td>
		  <td>
		  <? if($row[option1_chk]=='Y'){
			    echo("<font color='red'>�����</font>&nbsp;<a href='delete1.php?p_num=$row[num]&mode=del&category_code_fk=$row[category_fk]&page=$page&l_category_fk=$row[l_category_fk]&ck=option1_chk&level=$level'><����></a>");
			   }
               else{
			    echo("<a href='delete1.php?p_num=$row[num]&mode=insert&category_code_fk=$row[category_fk]&page=$page&l_category_fk=$row[l_category_fk]&ck=option1_chk&level=$level'><���></a>");
			   }
		  ?>
		  </td>
		  <td>
		  <? if($row[option2_chk]=='Y'){
			    echo("<font color='red'>�����</font>&nbsp;<a href='delete1.php?p_num=$row[num]&mode=del&category_code_fk=$row[category_fk]&page=$page&l_category_fk=$row[l_category_fk]&ck=option2_chk&level=$level'><����></a>");
			   }
               else{
			    echo("<a href='delete1.php?p_num=$row[num]&mode=insert&category_code_fk=$row[category_fk]&page=$page&l_category_fk=$row[l_category_fk]&ck=option2_chk&level=$level'><���></a>");
			   }
		  ?>
		  </td>
		 </tr>
 <?
}
mysql_free_result($result);
?>
<?
if($total == 0){
?>
          <tr bgcolor="#FFFFFF" align="center" class="hanamii">
            <td colspan="11">��ϵ� ��ǰ�� �����ϴ�.</td>
          </tr>
<?
	}
?>
        <form action='list.php' name='f' method='post' >
         <tr bgcolor="#FFFFFF" align="center" class="hanamii">
            <td colspan="10">
			 <select name='key'>
	           <option value='company'>����ȸ��</option>
	           <option value='price'>�ǸŰ���</option>
			   <option value='name'>��ǰ��</option>
	        </select>
	        <input type='hidden' name='mode' value='search'>
			<input type='hidden' name='l_category_fk' value='<?=$l_category_fk?>'>
			<input type='hidden' name='category_code_fk' value='<?=$category_code_fk?>'>
			<input type='hidden' name='level' value='<?=$level?>'>
	        <input type='text' name='key_value' size='16' class=input>
	   	    <input type='submit' name='submit' value='�˻�'  class=submit>	
		   </td>
          </tr>
		  </form>

      </table>
    </td>
  </tr>
</table>
<br>
<?
if($level >= 2){
?>
<table width="90%" border="0" cellspacing="0" cellpadding="3">
  <tr bgcolor="#FFFFFF" align="center" class="hanamii">
    <td>
	<?
	  $url = "$PHP_SELF?l_category_fk=$l_category_fk&category_code_fk=$category_code_fk&level=$level&mode=$mode&key=$key&key_value=$key_value"; 
      page_avg($totalpage,$cpage,$url); 
	?>
	</td>
  </tr>
  <tr>
    <td align="center">
      <input type="button" value="��ǰ���" onClick="location='write.php?level=<?=$level?>&category_code_fk=<?=$category_code_fk?>&page=<?=$page?>&l_category_fk=<?=$l_category_fk?>'">
      <input type="button" value="�ٽ��б�" onClick="location='list.php?level=<?=$level?>&category_code_fk=<?=$category_code_fk?>&page=<?=$page?>&l_category_fk=<?=$l_category_fk?>'">
    </td>
  </tr>
</table>
<? } ?>
</form>
</body>
</html>
