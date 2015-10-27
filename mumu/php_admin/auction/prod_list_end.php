<?
// 아파치 인증
include "../../php/auth.php";
// 데이타베이스 연결정보 및 기타설정
include "../../php/config.php";
// 각종 유틸함수
include "../../php/util.php";
// MySQL 연결
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
        <tr bgcolor="#FFFFFF" class="hanamii" height="35" align="left">
          <td width="100%" colspan="7"><b>마감된 경매 LIST</b></td>
         </tr>
		<tr bgcolor="#D9D9D9" class="hanamii" align="center">
          <td width="20%">분류</td>
          <td width="20%">상품명</td>
          <td width="10%">경매시작가</td>
		  <td width="10%">마감가</td>
          <td width="20%">경매 마감일자</td>
		  <td width="10%">판매수량</td>
          <td width="10%">신청건수</td>
		 </tr>
<?
	// 마감된 상품의 정보를 모두 가져옴
	$query  = "select a.anum from auct_master a , auct_category b
	           where a.category_fk=b.code And 
			         a.end_chk='Y' And
					 a.delete_chk = 'N' ";
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

    $query = "select * from auct_master a , auct_category b
              where a.category_fk=b.code And 
			        a.end_chk='Y' And
					a.delete_chk = 'N'
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
          <td>&nbsp;<?=number_format($row[start_amt])?>원</td>
		  <td>&nbsp;<?=number_format($row[curr_amt])?>원</td>
		  <td>
		    <?=substr($row[auct_end],0,4)?>년
		    <?=substr($row[auct_end],4,2)?>월
			<?=substr($row[auct_end],6,2)?>일
			<?=substr($row[auct_end],8,2)?>시
		  </td>
		  <td>&nbsp;<?=$row[total_cnt]?>개</td>
		  <td>&nbsp;<a href="#" onclick="javascript:window.open('open_join_list.php?anum=<?=$row[anum]?>','목록보기','width=800,height=550,scrollbars=yes')"><?=number_format($row[join_cnt])?>건</a></td>          
		 </tr>
	 <?
	}
	mysql_free_result($result);
	?>
	<?
	if($total == 0){
	?>
          <tr bgcolor="#FFFFFF" align="center" class="hanamii">
            <td colspan="8">마감된 물목이 없습니다.</td>
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
</table>

</form>
</body>
</html>
