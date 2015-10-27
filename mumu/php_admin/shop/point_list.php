<?
// 아파치 인증
include "../../php/auth.php";
// 데이타베이스 연결정보 및 기타설정
include "../../php/config.php";
// 각종 유틸함수
include "../../php/util.php";
// MySQL 연결
$connect=my_connect($host,$dbid,$dbpass,$dbname);

if($mode == 'search'){
  if($id_fk){
    $sear_char = " where id_fk like '%$id_fk%' ";
  }
}

$query = "Select * From mileage $sear_char "; 
$result = mysql_query($query, $connect);
$total = mysql_num_rows($result);
?>
<html>
<head>
<title>PHPSAMPLE SITE</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link rel="stylesheet" href="../../common/global.css">
<script language="JavaScript" src="../../common/global.js"></script>
<script language="JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
</head>

<body bgcolor="#FFFFFF" text="#000000">
<table width="750" border="0" cellspacing="0" cellpadding="0">
 <tr>
  <td>
   <table width="90%" border="0" cellspacing="0" cellpadding="3">
    <tr class="text">
      <td>총 <?=number_format($total)?>건 </td>
    </tr>
   </table>
  </td>
 </tr>
  <tr>
    <td bgcolor="#666666">
      <table width="100%" border="0" cellspacing="1" cellpadding="2">
        <tr bgcolor="#D9D9D9" class="hanamii" align="center">
          <td width="5%">번호</td>
          <td width="15%">아이디</td>
          <td width="15%">포인트</td>
          <td width="40%">포인트 내역</td>
		  <td width="25%">생성일</td>
         </tr>
   <?
      $scale=100;
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
			
     $sql_2 = "select * from mileage $sear_char order by num desc LIMIT $cline,$scale1 "; 	
	 $result_2 = mysql_query($sql_2, $connect);

 	 for($i=1; $ksh = mysql_fetch_array($result_2); $i++){				   
	   $bunho = $total - ( $i + $cline) + 1; 
	?>
        <tr align="center" bgcolor='#FFFFFF' class="hanamii">
          <td>&nbsp;<?=$bunho?></td>
		  <td>&nbsp;<?=$ksh[id_fk]?></td>
		  <td>&nbsp;<?=$ksh[mileage]?></td>
		  <td>&nbsp;<?=$ksh[mile_desc]?></td>
		  <td>&nbsp;<?=$ksh[wdate]?></td>
		 </tr>
  <?
    }
    mysql_free_result($result); 
  ?>
  <?
   if($total == 0){
  ?>
          <tr bgcolor="#FFFFFF" align="center" class="hanamii">
            <td colspan="5">등록된 포인트가 없습니다.</td>
          </tr>
  <?
	}
  ?>
        <form action='point_list.php' name='f' method='post' >
         <tr bgcolor="#FFFFFF" class="hanamii">
            <td colspan="10">
	        <input type='hidden' name='mode' value='search'>
            아이디 
	        <input type='text' name='id_fk' size='16' class=input>
	   	    <input type='submit' name='submit' value='검색'  class=submit>	
		   </td>
          </tr>
	   </form>
      </table>
    </td>
  </tr>
</table>
</body>
</html>
