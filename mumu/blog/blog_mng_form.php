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
            <b>블로그 기본정보 관리</b> | 
			<a href="blog_brd_mng.php?b_id=<?=$b_id?>">블로그 리스트 관리</a>
		  </td>
        </tr>
      </table>
	 <form name=form1 method=post action="blog_mng_post.php" enctype="multipart/form-data">
	  <input type='hidden' name="b_id" value="<?=$b_id?>">
	   <table width="100%" border="0" cellspacing="1" cellpadding="2">
        <tr> 
         <td colspan=2 class=line-t height=1 bgcolor="#e1e1e1"></td>
        </tr>
        <tr> 
         <td class=line-n colspan="2" height="30" valign="top" bgcolor="#EEECCC">기본정보관리</td>
       </tr>
	   <tr> 
         <td class=line-n valign="top" bgcolor="#f8f8f7">아이디</td>
         <td class="line"> 
           <?=$b_id?>
		 </td>
       </tr>
       <tr> 
        <td class=line-n valign="top" bgcolor="f8f8f7"> 
         블로그명</td>
        <td class="line"> 
         <input type="text" name="blog_name" value="<?=$rows1[blog_name]?>" size="25" class="InputStyle1">
        </td>
       </tr>
	   <tr> 
        <td class=line-n valign="top" bgcolor="f8f8f7"> 
         닉네임</td>
        <td class="line"> 
         <input type="text" name="nick_name" value="<?=$rows1[nick_name]?>" size="16" class="InputStyle1">
        </td>        
       </tr>
       <tr> 
        <td class=line-n valign="top" bgcolor="f8f8f7"> 블로그 소개</td>
        <td class="line"> 
          <input type="text" name="blog_cont" value="<?=$rows1[blog_cont]?>" size="45" class="InputStyle1">
        </td>        
       </tr>
	   <tr> 
        <td class=line-n valign="top" bgcolor="f8f8f7"> 본인 소개</td>
        <td class="line"> 
          <textarea name="my_profile" onkeyup="checklen(this,'250')" cols="50" rows="4"><?=stripslashes($rows1[my_profile])?></textarea>
		  <br> 250byte(한글 100자 내외)로 입력하세요.
        </td>        
       </tr>
	   <tr> 
         <td class=line-n valign="top" bgcolor="f8f8f7">정보공개여부</td>
         <td class="line"> 
           <input type="radio" name="view_chk" value="Y" <? if($rows1[view_chk]=='Y' || !$rows1[view_chk]) echo"checked"; ?>>공개
           <input type="radio" name="view_chk" value="N" <? if($rows1[view_chk]=='N') echo"checked"; ?>>비공개
         </td>         
        </tr>
        <tr> 
         <td class=line-n valign="top" bgcolor="f8f8f7">생성일</td>
         <td class="line"> <?=$rows1[blog_cdate]?> </td>         
        </tr>
        <tr> 
          <td class=line-n colspan="2" height="30" valign="top" bgcolor="#EEECCC">디자인관리</td>
        </tr>
        <tr> 
         <td class=line-n valign="top" bgcolor="f8f8f7">
         표지이미지</td>
         <td class="line"> 
          <input type="file" name="blog_logo" size="30"><br>
    <? 
	   if ($rows1[blog_logo]=='Y'){
		 $p_image = "../upload/b_image/".$b_id."/blog_logo.".$rows1[blog_logo_ty];
		 echo"현재 등록된 이미지가 있습니다. ";
	     echo"<input type='button' value='이미지보기' onclick=\"ShowImage('$p_image');\">";
		 echo" <input type='button' value='이미지삭제' onclick=\"location='img_del.php?b_id=$b_id&img_code=blog_logo&img_ty=$rows1[blog_logo_ty]'\">";
	   }
	?>
         </td>         
        </tr>
		<tr> 
         <td class=line-n valign="top" bgcolor="f8f8f7">
         블로그 상단 배경</td>
         <td class="line"> 
           <input type="radio" name="title_bgtype" value="1" onclick="bg_change()" <? if($rows1[title_bgtype]=='1' || !$rows1[title_bgtype]) echo"checked"; ?>>일반색상
           <input type="radio" name="title_bgtype" value="2" onclick="bg_change()" <? if($rows1[title_bgtype]=='2') echo"checked"; ?>>이미지
         </td>         
        </tr>
		<tr> 
         <td class=line-n valign="top" bgcolor="f8f8f7">
         배경 이미지</td>
         <td class="line"> 
           <input type="file" name="title_bgimg" size="30" ><br>
    <? 
	   if ($rows1[title_bgimg]=='Y'){
		 $p_image = "../upload/b_image/".$b_id."/title_bgimg.".$rows1[title_bgimg_ty];
		 echo"현재 등록된 이미지가 있습니다. ";
	     echo"<input type='button' value='이미지보기' onclick=\"ShowImage('$p_image');\">";
		 echo" <input type='button' value='이미지삭제' onclick=\"location='img_del.php?b_id=$b_id&img_code=title_bgimg&img_ty=$rows1[title_bgimg_ty]'\">";
	   }
	?>
         </td>         
        </tr>
		<tr> 
         <td class=line-n valign="top" bgcolor="f8f8f7">
         배경 색상</td>
         <td class="line"> 
           <input type="text" name="title_bgcolor" value="<?=$rows1[title_bgcolor]?>" size="10" maxlength="10" class="InputStyle1"> (없을 경우 기본 : #FFFFFF )
         </td>         
        </tr>
		<tr> 
         <td class=line-n valign="top" bgcolor="f8f8f7">
         왼쪽 상자색</td>
         <td class="line"> 
           <input type="text" name="box_bgcolor" value="<?=$rows1[box_bgcolor]?>" size="10" maxlength="10" class="InputStyle1"> (없을 경우 기본 : #D7D7D7 )
         </td>         
        </tr>
        <tr> 
         <td class=line-n valign="top" bgcolor="f8f8f7">
         메인상단이미지</td>
         <td class="line"> 
           <input type="file" name="main_img" size="30" ><br>
    <? 
	   if ($rows1[main_img]=='Y'){
		 $p_image = "../upload/b_image/".$b_id."/main_img.".$rows1[main_img_ty];
		 echo"현재 등록된 이미지가 있습니다. ";
	     echo"<input type='button' value='이미지보기' onclick=\"ShowImage('$p_image');\">";
		 echo" <input type='button' value='이미지삭제' onclick=\"location='img_del.php?b_id=$b_id&img_code=main_img&img_ty=$rows1[main_img_ty]'\">";
	   }
	?>
         </td>         
        </tr>
		<tr> 
        <td class=line-n valign="top" bgcolor="f8f8f7">블로그 상단 HTML</td>
        <td class="line"> 
          <textarea name="main_text" cols="50" rows="8"><?=stripslashes($rows1[main_text])?></textarea>
        </td>        
       </tr>
	   <tr> 
        <td class=line-n valign="top" bgcolor="f8f8f7">블로그 하단 HTML</td>
        <td class="line"> 
          <textarea name="main_text_bt" cols="50" rows="8"><?=stripslashes($rows1[main_text_bt])?></textarea>
        </td>        
       </tr>
       </table>
       <table width="100%" border="0" cellspacing="0" cellpadding="10">
         <tr> 
           <td align="center">
	         <a href="javascript:blog_mng_edit()"><img src="../img/butn_ok.gif" border="0"></a>
		     <a href="/index.php"><img src="../img/btn_cancel.gif" hspace="4" border="0"></a>
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