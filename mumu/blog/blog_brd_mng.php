<?
include "../php/config.php";
// 각종 유틸함수
include "../php/util.php";
// MySQL 연결
$connect=my_connect($host,$dbid,$dbpass,$dbname);

if(!isset($_SESSION["p_id"]) || !isset($_SESSION["p_name"])){
  err_msg('회원 로그인 후 사용할 수 있습니다.');
}

if($_SESSION[p_id] != $b_id){
  err_msg('본인의 블로그가 아닙니다. 블로그 정보를 확인하세요.');
}

?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=euc-kr">
<title>PHPSAMPLE SITE</title>
<link rel="stylesheet" href="../common/global.css">
<script language="JavaScript" src="../common/global.js"></script>
<script language="JavaScript" src="../common/blog.js"></script>
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

      //왼쪽 메뉴를 파일에서 불러옵니다.
      include '../include/left_menu1.php';  
      ?>
    </td>
    <td width="728" valign="top" >
     <?  
     //사용자가 설정한 부분
     include '../include/blog_main_top.php';  
     ?>
	 <br>
     <table width="90%" border="0" cellspacing="0" cellpadding="6">
        <tr>
          <td align="right"> 
		    <a href="blog_write.php?b_id=<?=$b_id?>">글쓰기</a> | 
            <a href="blog_mng_form.php?b_id=<?=$b_id?>">블로그 기본정보 관리</a> | 
			<b><a href="blog_brd_mng.php?b_id=<?=$b_id?>">블로그 리스트 관리</a></b>
		  </td>
        </tr>
      </table>
	  <table width="90%" border="0" cellspacing="1" cellpadding="2">
        <tr> 
         <td colspan=2 class=line-t height=1 bgcolor="#e1e1e1"></td>
        </tr>
        <tr> 
         <td class=line-n colspan="2" height="30" valign="top" bgcolor="#EEECCC">현재 등록된 분류</td>
       </tr>
	  </table>
	  <br>
      <table width="90%" border="0" cellspacing="0" cellpadding="0">
	     <tr bgcolor="CCCCCC"> 
		   <td align="center" width="30" class="line2">번호</td>
		   <td align="center" width="170" class="line2">블로그 분류명</td>
           <td align="center" width="100" class="line2">읽기 권한</td>
		   <td align="center" width="100" class="line2">쓰기 권한</td>
		   <td align="center" width="100" class="line2">생성일</td>
		 </tr>
<?

$a_power_1['1'] ="본인";
$a_power_1['2'] ="회원";
$a_power_1['3'] ="비회원";

$a_power_2['1'] ="본인";
$a_power_2['2'] ="회원";
$a_power_2['3'] ="비회원";

$query2 = "select * from blog_brd_list where user_id = '$b_id' 
		  order by num desc ";
$result2 = mysql_query($query2, $connect);
for($i=0; $rows2 = mysql_fetch_array($result2); $i++){
?>
		 <tr> 
		   <td align="center" class="line"><?=($i+1)?></td>
		   <td align="center" class="line">
			  <a href="blog_brd_write.php?b_id=<?=$b_id?>&md=edit&brd_num=<?=$rows2[num]?>"><?=$rows2[brd_title]?></a>&nbsp;
		   </td>
		   <td align="center" class="line"><?=$a_power_1[$rows2[brd_pow_1]]?>&nbsp;</td>
		   <td align="center" class="line"><?=$a_power_2[$rows2[brd_pow_2]]?>&nbsp;</td>
		   <td align="center" class="line"><?=$rows2[brd_wdate]?>&nbsp;</td>
		  </tr>
    <?
	 }  
	 mysql_free_result($result2);
    ?>
       </table>
	   <table width="90%" border="0" cellspacing="1" cellpadding="2">
        <tr> 
         <td class=line-n height="30" valign="middle" bgcolor="#EEECCC">
		  <input type="button" name="분류생성" value="분류생성" onclick="location='blog_brd_write.php?b_id=<?=$b_id?>'">
		 </td>
       </tr>
	  </table>
	  <?  
     //사용자가 설정한 부분
     include '../include/blog_main_bt.php';  
     ?>
	</td>
  </tr>
</table>
</body>
</html>