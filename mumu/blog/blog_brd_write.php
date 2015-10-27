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
	  <form name=form1 method=post action="blog_brd_write_post.php">
	  <input type='hidden' name="b_id" value="<?=$b_id?>">
<?
  if($md=='edit'){

     $qry3 = "select * from blog_brd_list where user_id='$b_id' And
	                                            num = '$brd_num' ";
	 $res3 = mysql_query($qry3,$connect);
	 $rows3 = mysql_fetch_array($res3);
	 mysql_free_result($res3);
?>
    <input type='hidden' name="md" value="<?=$md?>">
    <input type='hidden' name="brd_num" value="<?=$brd_num?>">
<?
  }
?>
	  
	   <table width="100%" border="0" cellspacing="1" cellpadding="2">
        <tr> 
         <td colspan=2 class=line-t height=1 bgcolor="#e1e1e1"></td>
        </tr>
        <tr> 
         <td class=line-n colspan="2" height="30" valign="top" bgcolor="#EEECCC">블로그 분류 등록</td>
       </tr>
       <tr> 
        <td class=line-n valign="top" bgcolor="f8f8f7"> 
         분류명</td>
        <td class="line"> 
         <input type="text" name="brd_title" value="<?=$rows3[brd_title]?>" size="15" class="InputStyle1">
        </td>
       </tr>
       <tr> 
        <td class=line-n valign="top" bgcolor="f8f8f7"> 게시물 읽기 권한</td>
        <td class="line"> 
          <select name="brd_pow_1">
		    <option value="1" <? if($rows3[brd_pow_1]=='1') echo"selected"; ?> >본인</option>
			<option value="2" <? if($rows3[brd_pow_1]=='2') echo"selected"; ?>>회원</option>
			<option value="3" <? if($rows3[brd_pow_1]=='3') echo"selected"; ?>>비회원</option>
		  </select>
        </td>        
       </tr>
	   <tr> 
        <td class=line-n valign="top" bgcolor="f8f8f7"> 코멘트 쓰기 권한</td>
        <td class="line"> 
          <select name="brd_pow_2">
		    <option value="1" <? if($rows3[brd_pow_2]=='1') echo"selected"; ?> >본인</option>
			<option value="2" <? if($rows3[brd_pow_2]=='2') echo"selected"; ?>>회원</option>
			<option value="3" <? if($rows3[brd_pow_2]=='3') echo"selected"; ?>>비회원</option>
		  </select>
        </td>        
       </tr>
       </table>
       <table width="100%" border="0" cellspacing="0" cellpadding="10">
         <tr> 
           <td align="center">
	         <a href="javascript:blog_brd_post()"><img src="../img/butn_ok.gif" border="0"></a>
		     <a href="javascript:history.go(-1)"><img src="../img/btn_cancel.gif" hspace="4" border="0"></a>
			 </td>
           </tr>
         </table>
	  </form>
	 <?  
     //사용자가 설정한 부분
     include '../include/blog_main_bt.php';  
     ?>
	</td>
  </tr>
</table>
</body>
</html>