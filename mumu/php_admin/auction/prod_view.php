<?
// 아파치 인증
include "../../php/auth.php";
// 데이타베이스 연결정보 및 기타설정
include "../../php/config.php";
// 각종 유틸함수
include "../../php/util.php";
// MySQL 연결
$connect=my_connect($host,$dbid,$dbpass,$dbname);

$query = "select * from auct_master where anum=$p_num";
$result = mysql_query($query, $connect);
$row = mysql_fetch_array($result);
mysql_free_result($result);

$a_prod_type['1'] = "신상품";
$a_prod_type['2'] = "중고상품";

$a_as_type['Y'] = "AS가능";
$a_as_type['N'] = "AS불가능";

$a_limit_type['1'] = "즉시구매 사용";
$a_limit_type['2'] = "즉시구매 없음";

$a_trans_type['1'] = "택배 본인부담(착불)";
$a_trans_type['2'] = "택배 경매자부담";
$a_trans_type['3'] = "빠른우편";
$a_trans_type['4'] = "직접수령";

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
  <table width="700" border="1" cellspacing="0" cellpadding="3" bordercolorlight="#000000" bordercolordark="#FFFFFF" align="center">
	<tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">경매분류</td>
      <td width="70%" bgcolor="#FFFFFF">
    <?
	 $qry1 = "select * from auct_category where code='$row[category_fk]'";
	 $res1 = mysql_query($qry1,$connect);
	 $ksh1 = mysql_fetch_array($res1);
	 mysql_free_result($res1);
     echo"$ksh1[name]";
	?>
      </td>
    </tr>
    <tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">등록상품명</td>
      <td width="70%" bgcolor="#FFFFFF">
        <?=$row[prod_name]?> &nbsp;
      </td>
    </tr>
    <tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">중고상품 유무</td>
      <td width="70%" bgcolor="#FFFFFF">
         <?=$a_prod_type[$row[prod_type]]?> &nbsp;
      </td>
    </tr>
	<tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">판매자 거주지역</td>
      <td width="70%" bgcolor="#FFFFFF">
	    <?=$row[in_addr]?> &nbsp;
      </td>
    </tr>
	<tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">판매자 연락처</td>
      <td width="70%" bgcolor="#FFFFFF">
        <?=$row[phone]?> &nbsp;
      </td>
    </tr>
	<tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">판매 가능지역</td>
      <td width="70%" bgcolor="#FFFFFF">
	    <?=$row[addr]?> &nbsp;
      </td>
    </tr>
	<tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">AS가능 여부</td>
      <td width="70%" bgcolor="#FFFFFF">
	    <?=$a_as_type[$row[as_type]]?> &nbsp;
      </td>
    </tr>
	<tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">경매 시작가격</td>
      <td width="70%" bgcolor="#FFFFFF">
        <?=number_format($row[start_amt])?>원 
      </td>
    </tr>
	<tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">즉시구매 여부</td>
      <td width="70%" bgcolor="#FFFFFF">
         <?=$a_limit_type[$row[limit_type]]?> &nbsp;
      </td>
    </tr>
	<tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">즉시구매가</td>
      <td width="70%" bgcolor="#FFFFFF">
        <?=number_format($row[limit_amt])?>원 
      </td>
    </tr>
	<tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">경매입찰 단위</td>
      <td width="70%" bgcolor="#FFFFFF">
        <?=number_format($row[join_amt])?>원 
      </td>
    </tr>
    <tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">총 판매수량</td>
      <td width="70%" bgcolor="#FFFFFF">
        <?=number_format($row[total_cnt])?> 개
      </td>
    </tr>
	<tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">경매 시작시간</td>
      <td width="70%" bgcolor="#FFFFFF">
        <?=substr($row[auct_start],0,4)?>년
		<?=substr($row[auct_start],4,2)?>월
		<?=substr($row[auct_start],6,2)?>일
		<?=substr($row[auct_start],8,2)?>시
      </td>
    </tr>
	<tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">경매 마감시간</td>
      <td width="70%" bgcolor="#FFFFFF">
        <?=substr($row[auct_end],0,4)?>년
		<?=substr($row[auct_end],4,2)?>월
		<?=substr($row[auct_end],6,2)?>일
		<?=substr($row[auct_end],8,2)?>시
      </td>
    </tr>
	<tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">운송방법</td>
      <td width="70%" bgcolor="#FFFFFF"> <?=$a_trans_type[$row[trans_type]]?> &nbsp;
      </td>
    </tr>
    <tr class="hanamii">
      <td width="30%" bgcolor="#D9D9D9" align="center">상품이미지</td>
      <td width="70%" bgcolor="#EFEFEF">&nbsp;
<?
if($row[prod_img]){
?>
      <img src="../../upload/a_image/<?=$row[prod_img]?>">
<?
}
?>
      </td>
    </tr>
   <tr class="hanamii">
     <td bgcolor="#D9D9D9" width="20%" align="center">상품설명</td>
     <td bgcolor="#F5F5F5" width="80%">
   <?
	 if($row[con_html] =='1'){
	  echo(stripslashes($row[contents]));
	 }
	 else{
	   echo(nl2br(stripslashes($row[contents])));
     }
  ?>
     </td>
    </tr>
	<tr class="hanamii">
     <td bgcolor="#D9D9D9" width="20%" align="center">삭제 여부</td>
     <td bgcolor="#F5F5F5" width="80%">&nbsp;<?=$row[delete_chk ]?></td>
    </tr>
	<tr class="hanamii">
     <td bgcolor="#D9D9D9" width="20%" align="center">등록일자</td>
     <td bgcolor="#F5F5F5" width="80%">&nbsp;<?=$row[reg_date]?></td>
    </tr>
   </table>
  </td>
 </tr>
</table>
<table width="600" border="0" cellspacing="0" cellpadding="3">
 <tr>
  <td align="center"> 
   <a href='prod_list.php?page=<?=$page?>'>목록보기</a>&nbsp;&nbsp;
   <a href='prod_write.php?mode=update&p_num=<?=$p_num?>&page=<?=$page?>'>수정하기</a>
   &nbsp;&nbsp;
   <a href='prod_delete.php?p_num=<?=$p_num?>&page=<?=$page?>' onClick="return confirm('삭제하시겠습니까?')">삭제하기</a>
  </td>
 </tr>
</table>
</body>
</html>
