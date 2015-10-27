<?
// 아파치 인증
include "../../php/auth.php";
// 데이타베이스 연결정보 및 기타설정
include "../../php/config.php";
// 각종 유틸함수
include "../../php/util.php";
// MySQL 연결
$connect=my_connect($host,$dbid,$dbpass,$dbname);

// 수정모드
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

// 전송버튼 클릭시 호출
function send_post()
{
 var form = document.form1;
 
   
  if(!form.name.value) {
     alert("상품명을 입력하세요!");
	 form.name.focus();
	 return ;
  }
 
 if(!form.price.value) {
     alert("상품가격을 입력하세요!");
	 form.price.focus();
	 return ;
  }

 if(form.price.value) {
     if(!IsNumber(form.price.name)){
         alert("상품가격은 숫자이어야 합니다!");
	     form.price.focus();
	     return;
	  }
  }
  
  if(form.mileage.value) {
     if(!IsNumber(form.mileage.name)){
         alert("포인트는 숫자이어야 합니다!");
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
      <td width="30%" bgcolor="#D9D9D9" align="center">상품등록 관리</td>
      <td width="70%" bgcolor="#FFFFFF">
        <input type="radio" name="del_chk" value="N" <? if(($mode=='insert') || ($row[del_chk]=='N')) echo("checked"); ?>>등록
		<input type="radio" name="del_chk" value="Y" <? if($row[del_chk]=='Y') echo("checked"); ?>>판매중지
      </td>
    </tr>
	<tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">대분류명</td>
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
      <td width="30%" bgcolor="#D9D9D9" align="center">중분류명</td>
      <td width="70%" bgcolor="#FFFFFF">
        <select name="l_category_fk">
		 <option value="">선택하세요</option>
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
      <td width="30%" bgcolor="#D9D9D9" align="center">상품명</td>
      <td width="70%" bgcolor="#FFFFFF">
        <input type="text" name="name" value="<?echo($row[name])?>" size="25">
      </td>
    </tr>
	<tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">제조사(생산지)</td>
      <td width="70%" bgcolor="#FFFFFF">
        <input type="text" name="company" value="<?echo($row[company])?>">
      </td>
    </tr>
	<tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">소비자 가격</td>
      <td width="70%" bgcolor="#FFFFFF">
        <input type="text" name="cust_price" value="<?=$row[cust_price]?>">원 (숫자로 기입)
      </td>
    </tr>
	<tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">상품가격</td>
      <td width="70%" bgcolor="#FFFFFF">
        <input type="text" name="price" value="<?echo($row[price])?>">원 (숫자로 기입)
      </td>
    </tr>
	<tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">포인트</td>
      <td width="70%" bgcolor="#FFFFFF">
        <input type="text" name="mileage" value="<?echo($row[mileage])?>"> POINT (숫자로 기입)
      </td>
    </tr>
	<tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">선택사항</td>
      <td width="70%" bgcolor="#FFFFFF">
        <input type="text" name="size" size='50' value="<?echo($row[size])?>">
		<br>구분은 "|"로 하세요 (예:255mm|266mm|277mm)
      </td>
    </tr>
    <tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">상품이미지(소:리스트)</td>
      <td width="70%" bgcolor="#EFEFEF">
        <input type="file" name="s_image" size="30">
      </td>
    </tr>
	<tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">상품이미지(중:상세보기)</td>
      <td width="70%" bgcolor="#EFEFEF">
        <input type="file" name="m_image" size="30">
      </td>
    </tr>
	<tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">상품이미지(대:확대)</td>
      <td width="70%" bgcolor="#EFEFEF">
        <input type="file" name="b_image" size="30">
      </td>
    </tr>
    <tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">상품 상세설명<br>
	   <input type="radio" name="con_html" value="1" <?if($row[con_html]=='1') echo("checked"); ?>>HTML
       <input type="radio" name="con_html" value="2"  <?if(($mode=='insert') || ($row[con_html]=='2')) echo("checked"); ?>>TEXT
	  </td>
      <td width="70%" bgcolor="#FFFFFF">
        <textarea name="contents" cols="50" rows="7"><?=stripslashes($row[contents])?></textarea>
      </td>
    </tr>
   <tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">등록분류</td>
      <td width="70%" bgcolor="#FFFFFF"> 
        <input type=checkbox name=option1_chk value='Y' 
		  <? if($row[option1_chk]=='Y') echo"checked"; ?> > 이벤트 상품
        <input type=checkbox name=option2_chk value='Y' 
		  <? if($row[option2_chk]=='Y') echo"checked"; ?> > 신상품
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
        <input type="button" value="전송하기" onClick="javascript:send_post()">
        <input type="reset" value="다시쓰기">
        <input type="button" value="취소하기" onClick="location='list.php?level=<?=$level?>&category_code_fk=<?=$category_code_fk?>&page=<?=$page?>&l_category_fk=<?=$l_category_fk?>'">
      </td>
    </tr>
  </table>
  </form>
</body>
</html>
