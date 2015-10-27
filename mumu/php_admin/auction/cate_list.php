<?
//관리자 인증 파일
include "../../php/auth.php";
// 데이타베이스 연결정보 및 기타설정
include "../../php/config.php";
// 각종 유틸함수
include "../../php/util.php";
// MySQL 연결
$connect=my_connect($host,$dbid,$dbpass,$dbname);

// 상위카테고리 코드값으로 부터 현 카테고리 값을 구함
$query = "select * from auct_category ";
$result = mysql_query($query, $connect);
$total_count = mysql_num_rows($result);
?>
<html>
<head>
<title>PHPSAMPLE SITE</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link rel="stylesheet" href="../../common/global.css">
<script language="JavaScript" src="../../common/global.js"></script>

<body bgcolor="#FFFFFF" text="#000000">
<center>
<form method="post" action="list.php">
  <table width="700" border="0" cellspacing="0" cellpadding="3">
    <tr class="hanamii">
     <td align="right"><?echo($total_count)?>건</td>
    </tr>
  </table>
  <table width="700" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td bgcolor="#666666"> 
        <table width="100%" border="0" cellspacing="1" cellpadding="2">
          <tr align="center" bgcolor="#D9D9D9" class="hanamii"> 
            <td width="10%">번호</td>
            <td width="15%">코드</td>
            <td width="30%">카테고리명</td>
            <td width="20%">경매물품수</td>
			<td width="15%">사용유무</td>
			<td width="10%">관리</td>
          </tr>
<?
$a_cancel_chk['Y'] = "<font color=red>비사용</font>";
$a_cancel_chk['N'] = "<font color=blue>사용중</font>";

for($i=0; $row = mysql_fetch_array($result); $i++){
	
	$query1 = "select * from auct_master where category_fk='$row[code]'";
	$result3= mysql_query($query1, $connect);
	$sub_count1 = mysql_num_rows($result3);
	mysql_free_result($result3);
	
	// 라인의 색상을 다르게 표시
	if($i%2 == 0){
		$bgcolor = "#FFFFFF";
	}else{
		$bgcolor = "#F5F5F5";
	}
?>
       <tr bgcolor="<?=$bgcolor?>" align="center" class="hanamii">
        <td><?=($i+1)?></td>
        <td><?=$row[code]?></td>
        <td><?=$row[name]?></td>
        <td><?=$sub_count1?> 개</td>
		<td><?=$a_cancel_chk[$row[cancel_chk]]?></td>
		<td class="hanamii">
         <a href='cate_write.php?mode=update&id=<?=$row[id]?>'>수정</a>&nbsp;
         <a href='cate_delete.php?id=<?=$row[id]?>' onClick="return confirm('삭제시 데이터가 지워지는것이 아니라 삭제 코드의 값이 변하게 됩니다. \n삭제하시겠습니까?')">삭제</a>
        </td>
       </tr>
<?
}
mysql_free_result($result);

if($total_count == 0){
?>
      <tr bgcolor="#FFFFFF" align="center" class="hanamii">
         <td colspan="6">등록된 분류가 없습니다.</td>
      </tr>
<?
	}
?>
        </table>
      </td>
    </tr>
  </table>
  <table width="700" border="0" cellspacing="0" cellpadding="3">
    <tr>
      <td align="center">
        <input type="button" value="등록하기" onClick="location='cate_write.php'">
      </td>
    </tr>
  </table>
</form>
</body>
</html>
