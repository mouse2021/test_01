<?
include "../php/config.php";
// 각종 유틸함수
include "../php/util.php";
// MySQL 연결
$connect=my_connect($host,$dbid,$dbpass,$dbname);

if(!isset($_SESSION["p_id"]) || !isset($_SESSION["p_name"])){
  err_msg('회원 로그인 후 사용할 수 있습니다.');
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
//상단 메뉴 부분을 파일에서 불러옵니다.
include '../include/top_menu.php';  
?>
<br>
<table style="border-width:1; border-style:solid;" border="0" cellpadding="0" cellspacing="0" width="938">
  <tr>
    <td width="210" height="376" valign="top">
	  <?  
      //좌측 로그인 부분을 파일에서 불러옵니다.
      include '../include/left_login.php';  

      //경매프로그램의 왼쪽 메뉴를 파일에서 불러옵니다.
      include '../include/left_menu3.php';  
      ?>
    </td>
    <td width="728" valign="top" >
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr> 
        <td height="30" style="padding:10 0 0 14px"><a href="/">홈</a> 
          &gt; <a href="../auction/auct_main.php">AUCTION</a> &gt; 
		  <a href="../auction/my_auct_list.php">나의 경매목록</a></td>
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
	   <td colspan="2" align="center" class="line2">상품명</td>
       <td width="90" align="center" class="line2">현재가</td>
	   <td width="150" align="center" class="line2">종료일시</td>
       <td width="60" align="center" class="line2">입찰수</td>
	   <td width="60" align="center" class="line2">현재상태</td>
     </tr>
	<?
	$end_chr['Y'] = "<font color=red>종료</font>";
	$end_chr['N'] = "진행중";

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
		<?=substr($rows[auct_end],4,2)?>월
		<?=substr($rows[auct_end],6,2)?>일
		<?=substr($rows[auct_end],8,2)?>시  
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
