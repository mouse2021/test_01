<?
// ����ġ ����
include "../../php/auth.php";
// ����Ÿ���̽� �������� �� ��Ÿ����
include "../../php/config.php";
// ���� ��ƿ�Լ�
include "../../php/util.php";
// MySQL ����
$connect=my_connect($host,$dbid,$dbpass,$dbname);

// �������
if($mode == "update"){
	$query = "select * from products where num=$p_num";
	$result = mysql_query($query, $connect);
	$row = mysql_fetch_array($result);
	mysql_free_result($result);
    	
}else{
	$mode = "insert";
}
?>
<html>
<head>
<title>PHPSAMPLE SITE</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link rel="stylesheet" href="../../common/global.css">
<script language="JavaScript" src="../../common/global.js"></script>
<script language="JavaScript">
<!--

function WorkChange() {
    document.form1.action = "write.php";
	document.form1.submit();
}

// ���۹�ư Ŭ���� ȣ��
function send_post()
{
 var form = document.form1;
 
   
  if(!form.name.value) {
     alert("��ǰ���� �Է��ϼ���!");
	 form.name.focus();
	 return ;
  }
 
 if(!form.price.value) {
     alert("��ǰ������ �Է��ϼ���!");
	 form.price.focus();
	 return ;
  }

 if(form.price.value) {
     if(!IsNumber(form.price.name)){
         alert("��ǰ������ �����̾�� �մϴ�!");
	     form.price.focus();
	     return;
	  }
  }
  
  if(form.mileage.value) {
     if(!IsNumber(form.mileage.name)){
         alert("����Ʈ�� �����̾�� �մϴ�!");
	     form.mileage.focus();
	     return;
	  }
  }
  
  form.submit();
}

function IsNumber(formname) {
     var form=eval("document.form1." + formname);

	 for(var i=0; i < form.value.length; i++) {
	     var chr = form.value.substr(i,1);
		 if((chr < '0' || chr > '9')) {
		    return false;
		 }
     }
     return true;
  }

-->
</script>
</head>

<body bgcolor="#FFFFFF" text="#000000">
<center>
<br>
<form name="form1" method="post" enctype="multipart/form-data" action="insert.php">

  <table width="700" border="1" cellspacing="0" cellpadding="3" bordercolorlight="#000000" bordercolordark="#FFFFFF" align="center">
    <tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">��ǰ��� ����</td>
      <td width="70%" bgcolor="#FFFFFF">
        <input type="radio" name="del_chk" value="N" <? if(($mode=='insert') || ($row[del_chk]=='N')) echo("checked"); ?>>���
		<input type="radio" name="del_chk" value="Y" <? if($row[del_chk]=='Y') echo("checked"); ?>>�Ǹ�����
      </td>
    </tr>
	<tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">��з���</td>
      <td width="70%" bgcolor="#FFFFFF">
        <select name="category_code_fk" onChange="WorkChange()">
<?
$query3 = "select * from products_category1 ";
$result3 = mysql_query($query3, $connect);
for($i=0; $row3 = mysql_fetch_array($result3); $i++){
	if($row3[code] == $category_code_fk){
?>
          <option value="<?echo($row3[code])?>" selected><?=$row3[name]?></option>
<?
	}else{
?>
          <option value="<?echo($row3[code])?>"><?=$row3[name]?></option>
<?
	}
}
mysql_free_result($result3);
?>
        </select>
      </td>
    </tr>

    <tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">�ߺз���</td>
      <td width="70%" bgcolor="#FFFFFF">
        <select name="l_category_fk">
		 <option value="">�����ϼ���</option>
<?
$query4 = "select * from products_category2 where category_code_fk='$category_code_fk'";
$result4 = mysql_query($query4, $connect);
for($i=0; $row4 = mysql_fetch_array($result4); $i++){
    if($row4[code] == $l_category_fk){
?>
        <option value='<?=$row4[code]?>' selected ><?=$row4[name]?></option>
<?
	}
	else{
?>
        <option value='<?=$row4[code]?>' ><?=$row4[name]?></option>
<?
	}
}
mysql_free_result($result4);
?>
        </select>
      </td>
    </tr>
    <tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">��ǰ��</td>
      <td width="70%" bgcolor="#FFFFFF">
        <input type="text" name="name" value="<?echo($row[name])?>" size="25">
      </td>
    </tr>
	<tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">������(������)</td>
      <td width="70%" bgcolor="#FFFFFF">
        <input type="text" name="company" value="<?echo($row[company])?>">
      </td>
    </tr>
	<tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">�Һ��� ����</td>
      <td width="70%" bgcolor="#FFFFFF">
        <input type="text" name="cust_price" value="<?=$row[cust_price]?>">�� (���ڷ� ����)
      </td>
    </tr>
	<tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">��ǰ����</td>
      <td width="70%" bgcolor="#FFFFFF">
        <input type="text" name="price" value="<?echo($row[price])?>">�� (���ڷ� ����)
      </td>
    </tr>
	<tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">����Ʈ</td>
      <td width="70%" bgcolor="#FFFFFF">
        <input type="text" name="mileage" value="<?echo($row[mileage])?>"> POINT (���ڷ� ����)
      </td>
    </tr>
	<tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">���û���</td>
      <td width="70%" bgcolor="#FFFFFF">
        <input type="text" name="size" size='50' value="<?echo($row[size])?>">
		<br>������ "|"�� �ϼ��� (��:255mm|266mm|277mm)
      </td>
    </tr>
    <tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">��ǰ�̹���(��:����Ʈ)</td>
      <td width="70%" bgcolor="#EFEFEF">
        <input type="file" name="s_image" size="30">
      </td>
    </tr>
	<tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">��ǰ�̹���(��:�󼼺���)</td>
      <td width="70%" bgcolor="#EFEFEF">
        <input type="file" name="m_image" size="30">
      </td>
    </tr>
	<tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">��ǰ�̹���(��:Ȯ��)</td>
      <td width="70%" bgcolor="#EFEFEF">
        <input type="file" name="b_image" size="30">
      </td>
    </tr>
    <tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">��ǰ �󼼼���<br>
	   <input type="radio" name="con_html" value="1" <?if($row[con_html]=='1') echo("checked"); ?>>HTML
       <input type="radio" name="con_html" value="2"  <?if(($mode=='insert') || ($row[con_html]=='2')) echo("checked"); ?>>TEXT
	  </td>
      <td width="70%" bgcolor="#FFFFFF">
        <textarea name="contents" cols="50" rows="7"><?=stripslashes($row[contents])?></textarea>
      </td>
    </tr>
   <tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">��Ϻз�</td>
      <td width="70%" bgcolor="#FFFFFF"> 
        <input type=checkbox name=option1_chk value='Y' 
		  <? if($row[option1_chk]=='Y') echo"checked"; ?> > �̺�Ʈ ��ǰ
        <input type=checkbox name=option2_chk value='Y' 
		  <? if($row[option2_chk]=='Y') echo"checked"; ?> > �Ż�ǰ
	  </td>
    </tr>
  </table>
  <table width="600" border="0" cellspacing="0" cellpadding="3" align="center">
    <tr>
      <td align="center">
        <input type="hidden" name="mode" value="<?echo($mode)?>">
        <input type="hidden" name="p_num" value="<?echo($p_num)?>">
        <input type="hidden" name="level" value="<?echo($level)?>">
        <input type="hidden" name="page" value="<?echo($page)?>">
        <input type="hidden" name="old_l_cate" value="<?=$row[l_category_fk]?>">
        <input type="button" value="�����ϱ�" onClick="javascript:send_post()">
        <input type="reset" value="�ٽþ���">
        <input type="button" value="����ϱ�" onClick="location='list.php?level=<?=$level?>&category_code_fk=<?=$category_code_fk?>&page=<?=$page?>&l_category_fk=<?=$l_category_fk?>'">
      </td>
    </tr>
  </table>
  </form>
</body>
</html>
