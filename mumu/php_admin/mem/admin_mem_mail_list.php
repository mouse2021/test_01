<?
//������ ���� ����
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
<script language="JavaScript">
<!--

var checkflag = "false";

function checkAll() {
    var form = document.form1;
	if (checkflag == "false") {
		for (var j = 0; j < form.elements.length; j++) {
			if(form.elements[j].name == "num[]"){
					if(form.elements[j].checked == false)
						form.elements[j].checked = true;
					}
		    }
		checkflag="true";
	}
	else if (checkflag == "true"){
		for (var j = 0; j < form.elements.length; j++) {
			if(form.elements[j].name == "num[]"){
					if(form.elements[j].checked == true)
						form.elements[j].checked = false;
					}
		}
		checkflag="false";
	}
}

function mail_send(){
  var form = document.form1;
  var no_count = 0;
	for(i=0; i < form.elements.length; i++){
		if(form.elements[i].name == "num[]"){
			if(form.elements[i].checked == true){
				no_count++;
			}
		}
	}

	if(no_count == 0){
		alert('���õ� �׸��� �����ϴ�');
		return;
	}
	MM_openBrWindow('','msend','width=660,height=350,resizable=yes,top=50,left=50');

	form.target = "msend";
	form.action = "open_mem_mail_form.php";
	form.submit();
}

function MM_openBrWindow(theURL,winName,features) { //v2.0
  winName = window.open(theURL,winName,features);
  winName.focus();
}

//-->
</script>
</head>

<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td height="40" class="title">ȸ�� ���� ���� </td>
  </tr>
</table>
<?

if($mode == 'search'){
  if($id){
    $sear_char .= " and id = '$id' ";
  }

  if($mobile){
    $sear_char .= " and mobile like '%$mobile%' ";
  }

  if($name){
    $sear_char .= " and name like '%$name%' ";
  }

  if($jnumber){
    $sear_char .= " and jnumber like '%$jnumber%' ";
  }

  if($email){
    $sear_char .= " and email like '%$email%' ";
  }

  if($phone){
    $sear_char .= " and phone like '%$phone%' ";
  }
    
}

//ȸ�� ���̺��� ����Ʈ�� �ҷ��ɴϴ�.
$query = "Select * From member where email <> '' $sear_char "; 
$result = mysql_query($query, $connect);
$total = mysql_num_rows($result);

?>
<form name="form1" method="post" action="admin_mem_mail_list.php">
<input type='hidden' name='mode' value='search'>
<div align="center">
 <table border="0" cellpadding="0" cellspacing="1" width="95%">
  <tr class=text>
   <td width="150" height="20" bgcolor="#F1F1F1" align="center"><b>���̵�</b></td>
     <td width="250" height="20">&nbsp;
	  <input type="text" name="id" value='<?=$id?>' size=20 class=input></td>
     <td width="150" height="20" bgcolor="#F1F1F1" align="center"><b>�޴���</b></td>
     <td width="250" height="20">&nbsp;
	  <input type="text" name="mobile" value='<?=$mobile?>' size=20 class=input></td>
    </tr>
	<tr class=text>
        <td width="150" height="20" bgcolor="#F1F1F1" align="center"><b>����</b></td>
        <td width="250" height="20">&nbsp;<input type="text" name="name" value='<?=$name?>' size=20 class=input></td>
        <td width="150" height="20" bgcolor="#F1F1F1" align="center"><b>�ֹι�ȣ</b></td>
        <td width="250" height="20">&nbsp;<input type="text" name="jnumber" value='<?=$jnumber?>' size=20 class=input></td>
    </tr>
	<tr class=text>
        <td width="150" height="20" bgcolor="#F1F1F1" align="center"><b>�̸���</b></td>
        <td width="250" height="20">&nbsp;<input type="text" name="email" value='<?=$email?>' size=20 class=input></td>
        <td width="150" height="20" bgcolor="#F1F1F1" align="center"><b>����ó</b></td>
        <td width="250" height="20">&nbsp;
		  <input type="text" name="phone" value='<?=$phone?>' size=20 class=input>
		</td>
    </tr>
	<tr>
	 <td colspan="4">
	  <center><input type="submit" value="Ȯ��" class=input></center>
	 </td>
	</tr>
   </table>
   </div>
 <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr class=text> 
    <td align=right>ȸ�� ( <?=number_format($total)?> �� )</td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#999999">
  <tr align="center" class="text"> 
    <td height="25" bgcolor="#f5f5f5"><strong>��ȣ</strong></td>
    <td height="25" bgcolor="#f5f5f5"><strong>���̵�</strong></td>
	<td height="25" bgcolor="#f5f5f5"><strong>�̸�</strong></td>
    <td height="25" bgcolor="#f5f5f5">�ֹι�ȣ</td>
    <td height="25" bgcolor="#f5f5f5">���Գ�¥</td>
	<td height="25" bgcolor="#f5f5f5">�̸���</td>
	<td width="113" height="25" bgcolor="#f5f5f5"><a href="javascript:checkAll()">����</a></td>
  </tr>
  <?
    if(!$page_scale){
	   $scale=30;
    }
    else if($page_scale == "all"){
	  if($total == 0){
	    $scale = 1;
      }
      else{
	    $scale = $total;
      }
	  $checked = "checked";
    }

    
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
				    
	$sql_2 = "select * from member where email <> '' $sear_char order by seq_num desc LIMIT $cline,$scale1 "; 
    $result_2 = mysql_query($sql_2, $connect);
 	for($i=1; $list = mysql_fetch_array($result_2); $i++){
      
	   $bunho = $total - ( $i + $cline) + 1; 
 ?>	  
  <tr bgcolor="#FFFFFF" class="text"> 
    <td align="center"><?=$bunho?></td>
    <td ><?=$list[id]?></td>
	<td><?=$list[name]?></td>
    <td><?=$list[jnumber]?></td>
    <td align="center"><?=$list[reg_date]?></td>
	<td align="center"><?=$list[email]?></td>
	<td align="center"><input type=checkbox name="num[]" value="<?=$list[seq_num]?>"></td>
  </tr>
  <?
    }
    mysql_free_result($result_2);
  ?>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td height="40" width="150" class="text">
	  <a href="javascript:mail_send()">���� �߼�</a>
	</td>
	<td height="40" align="center" class="text">
	<?
	 $url = "admin_mem_mail_list.php?$id=$id&mode=$mode&jnumber=$jnumber&email=$email&phone=$phone&name=$name&mobile=$mobile&page_scale=$page_scale"; 
 	 page_avg($totalpage,$cpage,$url); 
   ?>
	&nbsp; </td>
	<td height="40" width="150" align="right" class="text">
	  <input type="checkbox" name="page_scale" value="all" <?=$checked?> onClick="document.form1.submit()"> �� ȭ������ ����
	</td>
  </tr>
  </form>
</table>
</body>
</html>
