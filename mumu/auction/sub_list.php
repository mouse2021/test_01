<?
include "../php/config.php";
// 각종 유틸함수
include "../php/util.php";
// MySQL 연결
$connect=my_connect($host,$dbid,$dbpass,$dbname);

//종료된 경매 업데이트
end_exe($connect);
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=euc-kr">
<title>PHPSAMPLE SITE</title>
<link rel="stylesheet" href="../common/global.css">
<script language="JavaScript" src="../common/global.js"></script>
<script language="JavaScript" type="text/JavaScript">
<!--

function price_comparison(){
  var form = document.form1;
  var b=0;
     for (i=0; i < form.elements.length; i++) {
		 if (form.elements[i].name =="prod_num[]") {
            if (form.elements[i].checked == true) {
			  b++;
			 }
	     }
	 }
	
	if(b == 0) {
	 alert("적어도 하나의 항목은 선택하셔야 합니다.");
	     return;
     }
   MM_openBrWindow('','view','width=700,height=600,menubar=yes,scrollbars=yes,resizable=yes');

   form.target = "view";
   form.action="sub_comparison.php";
   form.submit();
  }

//-->
</script>
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
		  <a href="../auction/sub_list.php">경매목록</a></td>
      </tr>
     </table>
     <table width="100%" border="0" cellspacing="1" cellpadding="2">
      <form name=form1 method='post'>
	  <tr> 
       <td class=line-t height=1 bgcolor="#e1e1e1"></td>
      <tr> 
	  <tr> 
       <td class=line-t height=20 bgcolor="#e1e1e1"> - 카테고리 - </td>
      </tr>
	  <tr> 
       <td width="100%" align=center>
		 <table width="99%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
          <?
		   $query1 = "select * from auct_category
		              where cancel_chk='N' ";
		   $result1 = mysql_query($query1,$connect);
		   for($kk=1;$rows1=mysql_fetch_array($result1);$kk++){
		  ?>
           <td width="150" height="25" align='center' bgcolor="ECCCCCC">
		   <?
			 if($rows1[code]==$l_code){
		   ?>
 		    <a href="sub_list.php?l_code=<?=$rows1[code]?>"><font color=blue><?=$rows1[name]?></font></a>
		   <? 
		     }
		     else{
		   ?>
            <a href="sub_list.php?l_code=<?=$rows1[code]?>"><?=$rows1[name]?></a>
		   </td>
          <? 
			 }
		     if(($kk % 4) == '0'){
          ?>
		  </tr>
		  <tr>
		  <?
		      }
		   }
		   mysql_free_result($result1);

		   $jj = ($kk - 1) % 4;

		   if($jj != '0'){
		     for($j =$jj ; $j < 4 ; $j++){
		  ?>
             <td width="150" height="25" align='center' bgcolor="ECCCCCC">&nbsp;</td>
		   <?
			  }
		   }
		   ?>
           </tr>
          </table>
	   </td>
      </tr>
     </table>
	 <br>
<?
    $now_date = date('YmdH');

	//중분류 선택시
	if($l_code){
	  $l_code_qry = " And category_fk ='$l_code' ";
	}

	// 현재 진행중인 경매정보를 모두 가져옴
	$query = "select * from auct_master 
			  where (auct_start <= $now_date) And
	                (auct_end > $now_date) And 
                    delete_chk='N' And 
					end_chk='N'
			        $l_code_qry ";
	$result = mysql_query($query, $connect);
	$total_bnum = mysql_num_rows($result);
	mysql_free_result($result);

	 if(!$page){
		$page = 1;
	 }

	  $p_scale=20;

	 $cpage = intval($page);
	 $totalpage = intval($total_bnum/$p_scale);
	  if ($totalpage*$p_scale != $total_bnum)
		$totalpage = $totalpage + 1;
		  
	  if ($cpage ==1) {
		  $cline = 0 ;
	  } else {
		  $cline = ($cpage*$p_scale) - $p_scale ;
	  } 
			
	   $limit=$cline+$p_scale;
			
	  if ($limit >= $total_bnum) 
			$limit=$total_bnum;

	  $p_scale1 = $limit - $cline;

?>
	 <br>
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr bgcolor="CCCCCC"> 
       <td width="30" align="center" class="hanamii">선택</td>
	   <td colspan="2" align="center" class="line2">상품명</td>
       <td width="90" align="center" class="line2">현재가</td>
	   <td width="150" align="center" class="line2">종료일시</td>
       <td width="60" align="center" class="line2">입찰</td>
     </tr>
	<?
	$query = "select * from auct_master 
			  where (auct_start <= $now_date) And
	                (auct_end > $now_date) And 
					delete_chk='N' And 
					end_chk='N'
					$l_code_qry 
			  order by join_cnt desc limit $cline,$p_scale1";
	$result = mysql_query($query, $connect);
	for($i=0; $rows = mysql_fetch_array($result); $i++){
	?>
      <tr> 
       <td height="40" align="center" class="line">
		<input type="checkbox" name="prod_num[]" value="<?=$rows[anum]?>"></td>
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
      </tr>
    <?
	 }  
	 mysql_free_result($result);
    ?>
     </table>
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
       <tr> 
         <td width="60" height="36"><a href="javascript:price_comparison()"><img src="../img/bt1.gif" width="48" height="20" hspace="4" border="0"></a></td>
         <td align="center">
	<?
	//페이지 나누기
	$url = "sub_list.php?l_code=$l_code"; 
    page_avg($totalpage,$cpage,$url); 
    ?>   			
	      </td>
          <td width="60">&nbsp;</td>
         </tr>
       </table>
	   </form>
	</td>
  </tr>
</table>
</body>
</html>
