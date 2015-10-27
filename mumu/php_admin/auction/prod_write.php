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
	$query = "select * from auct_master where anum=$p_num";
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
<script language="JavaScript" src="../../common/auction.js"></script>
</head>

<body bgcolor="#FFFFFF" text="#000000">
<center>
<form name="form1" method="post" enctype="multipart/form-data" action="prod_insert.php">

  <table width="700" border="1" cellspacing="0" cellpadding="3" bordercolorlight="#000000" bordercolordark="#FFFFFF" align="center">
	<tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">경매분류</td>
      <td width="70%" bgcolor="#FFFFFF">
        <select name="category_code_fk">
<?
$query3 = "select * from auct_category where cancel_chk='N' ";
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
      <td width="30%" bgcolor="#D9D9D9" align="center">등록상품명</td>
      <td width="70%" bgcolor="#FFFFFF">
        <input type="text" name="prod_name" value="<?=$row[prod_name]?>" size="25">
      </td>
    </tr>
    <tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">중고상품 유무</td>
      <td width="70%" bgcolor="#FFFFFF">
         <input type=radio name="prod_type" value='1' 
		  <? if($row[prod_type]=='1' || $row[prod_type]) echo"checked"; ?> > 신상품
        <input type=radio name="prod_type" value='2' 
		  <? if($row[prod_type]=='2') echo"checked"; ?> > 중고상품
      </td>
    </tr>
	<tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">판매자 거주지역</td>
      <td width="70%" bgcolor="#FFFFFF">
        <select name="in_addr">
         <option <? if($row[in_addr]=='서울') echo"selected"; ?> >서울</option>
		 <option <? if($row[in_addr]=='부산') echo"selected"; ?> >부산</option>
		 <option <? if($row[in_addr]=='대구') echo"selected"; ?> >대구</option>
		 <option <? if($row[in_addr]=='광주') echo"selected"; ?> >광주</option>
		 <option <? if($row[in_addr]=='인천') echo"selected"; ?> >인천</option>
		</select>
      </td>
    </tr>
	<tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">판매자 연락처</td>
      <td width="70%" bgcolor="#FFFFFF">
        <input type="text" name="phone" value="<?=$row[phone]?>" size="25">
      </td>
    </tr>
	<tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">판매 가능지역</td>
      <td width="70%" bgcolor="#FFFFFF">
        <select name="addr">
		 <option <? if($row[addr]=='전국') echo"selected"; ?> >전국</option>
         <option <? if($row[addr]=='서울') echo"selected"; ?> >서울</option>
		 <option <? if($row[addr]=='부산') echo"selected"; ?> >부산</option>
		 <option <? if($row[addr]=='대구') echo"selected"; ?> >대구</option>
		 <option <? if($row[addr]=='광주') echo"selected"; ?> >광주</option>
		 <option <? if($row[addr]=='인천') echo"selected"; ?> >인천</option>
		</select>
      </td>
    </tr>
	<tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">AS가능 여부</td>
      <td width="70%" bgcolor="#FFFFFF">
        <select name="as_type">
		 <option value="Y" <? if($row[as_type]=='Y') echo"selected"; ?> >AS가능</option>
         <option value="N" <? if($row[as_type]=='N') echo"selected"; ?> >AS불가능</option>
		</select>
      </td>
    </tr>
	<tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">경매 시작가격</td>
      <td width="70%" bgcolor="#FFFFFF">
        <input type="text" name="start_amt" onKeyUp="onlyNumber1(this)" value="<?=$row[start_amt]?>">원 (숫자로 기입)
      </td>
    </tr>
	<tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">즉시구매 여부</td>
      <td width="70%" bgcolor="#FFFFFF">
         <input type=radio name="limit_type" value='1' 
		  <? if($row[limit_type]=='1' || $row[limit_type]) echo"checked"; ?> > 즉시구매 사용
        <input type=radio name="limit_type" value='2' 
		  <? if($row[limit_type]=='2') echo"checked"; ?> > 즉시구매 없음
      </td>
    </tr>
	<tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">즉시구매가</td>
      <td width="70%" bgcolor="#FFFFFF">
        <input type="text" name="limit_amt" onKeyUp="onlyNumber1(this)" value="<?=$row[limit_amt]?>">원 (숫자로 기입)
      </td>
    </tr>
	<tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">경매입찰 단위</td>
      <td width="70%" bgcolor="#FFFFFF">
        <input type="text" name="join_amt" onKeyUp="onlyNumber1(this)" value="<?=$row[join_amt]?>">천원 (숫자로 기입)
      </td>
    </tr>
    <tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">총 판매수량</td>
      <td width="70%" bgcolor="#FFFFFF">
        <input type="text" name="total_cnt" onKeyUp="onlyNumber1(this)" value="<?=$row[total_cnt]?>">개 (숫자로 기입)
      </td>
    </tr>
	<tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">경매 시작시간</td>
      <td width="70%" bgcolor="#FFFFFF">
<?

$nyear = date('Y');
if($mode =='insert'){
    $syear  = date('Y');
    $smonth = date('m');
    $sday   = date('d');
	$stime  = date('H');

	$eyear  = date('Y');
    $emonth = date('m');
    $eday   = date('d');
	$etime  = date('H');
}
else{
    $syear   = substr($row[auct_start],0,4);
	$smonth  = substr($row[auct_start],4,2);
    $sday    = substr($row[auct_start],6,2);
	$stime   = substr($row[auct_start],8,2);
    
	$eyear   = substr($row[auct_end],0,4);
	$emonth  = substr($row[auct_end],4,2);
    $eday    = substr($row[auct_end],6,2);
	$etime   = substr($row[auct_end],8,2);
}
?>
        <select name="s_year">
        <? 
		  for($i = 2004; $i < ($nyear+1); $i++){
  		?>
          <option value="<?=$i?>" <? if($i==$syear) echo"selected"; ?> ><?=$i?></option>
        <? } ?>
         </select> 년 
         <select name="s_month">
        <? 
	     for($j=1;$j<13;$j++){
	       $j_chr = sprintf("%02d",$j);
		?>
          <option value="<?=$j_chr?>" <? if($j_chr==$smonth) echo"selected"; ?> ><?=$j?></option>
       <? } ?>
         </select> 월
	     <select name="s_day">
        <? 
	     for($k=1;$k<32;$k++){
			$k_chr = sprintf("%02d",$k);
	    ?>
          <option value="<?=$k_chr?>" <? if($k_chr==$sday) echo"selected"; ?> ><?=$k?></option>
       <? } ?>
         </select> 일
         <select name="s_time">
       <? 
	     for($l=0;$l<24;$l++){
            $l_chr = sprintf("%02d",$l);
	   ?>
          <option value="<?=$l_chr?>" <? if($l_chr==$stime) echo"selected"; ?> ><?=$l?></option>
       <? } ?>
         </select> 시
      </td>
    </tr>
	<tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">경매 마감시간</td>
      <td width="70%" bgcolor="#FFFFFF">
        <select name="e_year">
        <? 
		  for($i = 2004; $i < ($nyear+1); $i++){
  		?>
          <option value="<?=$i?>" <? if($i==$eyear) echo"selected"; ?> ><?=$i?></option>
        <? } ?>
         </select> 년 
         <select name="e_month">
        <? 
	     for($j=1;$j<13;$j++){
	       $j_chr = sprintf("%02d",$j);
		?>
          <option value="<?=$j_chr?>" <? if($j_chr==$emonth) echo"selected"; ?> ><?=$j?></option>
       <? } ?>
         </select> 월
	     <select name="e_day">
        <? 
	     for($k=1;$k<32;$k++){
			$k_chr = sprintf("%02d",$k);
	    ?>
          <option value="<?=$k_chr?>" <? if($k_chr==$eday) echo"selected"; ?> ><?=$k?></option>
       <? } ?>
         </select> 일
         <select name="e_time">
       <? 
	     for($l=0;$l<24;$l++){
            $l_chr = sprintf("%02d",$l);
	   ?>
          <option value="<?=$l_chr?>" <? if($l_chr==$etime) echo"selected"; ?> ><?=$l?></option>
       <? } ?>
         </select> 시
      </td>
    </tr>
	<tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">운송방법</td>
      <td width="70%" bgcolor="#FFFFFF">
        <select name="trans_type">
		 <option value="1" <? if($row[trans_type]=='1') echo"selected"; ?> >택배 본인부담(착불)</option>
         <option value="2" <? if($row[trans_type]=='2') echo"selected"; ?> >택배 경매자부담</option>
		 <option value="3" <? if($row[trans_type]=='3') echo"selected"; ?> >빠른우편</option>
		 <option value="4" <? if($row[trans_type]=='4') echo"selected"; ?> >직접수령</option>
		</select>
      </td>
    </tr>
    <tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">상품이미지</td>
      <td width="70%" bgcolor="#EFEFEF">
        <input type="file" name="s_image" size="30">
      </td>
    </tr>

    <tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">상품 상세설명<br>
	   <input type="radio" name="con_html" value="1" <?if($row[con_html]=='1') echo("checked"); ?>>HTML
       <input type="radio" name="con_html" value="2"  <?if(($mode=='insert') || ($row[con_html]=='2')) echo("checked"); ?>>TEXT
	  </td>
      <td width="70%" bgcolor="#FFFFFF">
        <textarea name="contents" cols="50" rows="8"><?=stripslashes($row[contents])?></textarea>
      </td>
    </tr>
  </table>
  <table width="600" border="0" cellspacing="0" cellpadding="3" align="center">
    <tr>
      <td align="center">
        <input type="hidden" name="mode" value="<?=$mode?>">
        <input type="hidden" name="p_num" value="<?=$p_num?>">
        <input type="hidden" name="page" value="<?=$page?>">
        <input type="button" value="전송하기" onClick="javascript:form_save()">
        <input type="reset" value="다시쓰기">
        <input type="button" value="취소하기" onClick="location='prod_list.php?category_code_fk=<?=$category_code_fk?>&page=<?=$page?>'">
      </td>
    </tr>
  </table>
  </form>
</body>
</html>
