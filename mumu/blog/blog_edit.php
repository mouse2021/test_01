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
<?
    //해당 테이블
    $blog_t = "bg_".$b_id."_t";

    $c_qry = "select * from $blog_t where num='$ed_num' ";
	$c_res = mysql_query($c_qry,$connect);
	$c_rows = mysql_fetch_array($c_res);

	if(!$c_rows){
	  err_msg('글이 존재하지 않습니다.');
	}
?>
	 <form name=form1 method=post action="blog_write_manager.php" enctype="multipart/form-data">
	  <input type='hidden' name="b_id" value="<?=$b_id?>">
	  <input type="hidden" name="md" value="edit">
	  <input type="hidden" name="ed_num" value="<?=$ed_num?>">

	   <table width="100%" border="0" cellspacing="1" cellpadding="2">
       <tr> 
        <td class=line-n valign="top" bgcolor="f8f8f7"> 
         블로그 분류</td>
        <td class="line"> 
         <select name="brd_list_fk">
		   <option value="">선택하세요</option>
 <?
   $query2 = "select * from blog_brd_list where user_id = '$b_id' 
	  	      order by num desc ";
   $result2 = mysql_query($query2, $connect);
   for($i=0; $rows2 = mysql_fetch_array($result2); $i++){
 ?>
         <option value="<?=$rows2[num]?>" <? if($c_rows[brd_list_fk] == $rows2[num]) echo"selected"; ?>><?=$rows2[brd_title]?></option>
<?
   }
   mysql_free_result($result2);
?>
		 </select>
        </td>
       </tr>
	   <tr> 
        <td class=line-n valign="top" bgcolor="f8f8f7"> 
         제목</td>
        <td class="line"> 
         <input type="text" name="title" size="35" value="<?=$c_rows[title]?>" class="InputStyle1">
        </td>        
       </tr>
	   <tr> 
         <td class=line-n valign="top" bgcolor="f8f8f7">
         이미지첨부1</td>
         <td class="line"> 
		  <input type=checkbox name="file_chk1" value="1">수정 &nbsp;
          <input type="file" name="blog_img1" size="40" class="InputStyle1"><br>
	<? 
	   if ($c_rows[blog_img1]){
		 $p_image = "../upload/b_image/".$b_id."/".$c_rows[blog_img1];
		 echo"등록된 이미지가 있습니다 ";
	     echo"<input type='button' value='이미지보기' onclick=\"ShowImage('$p_image');\">";
	   }
	?>
         </td>         
        </tr>
       <tr> 
       <tr> 
         <td class=line-n valign="top" bgcolor="f8f8f7">내용1</td>
         <td class="line"> 
           <textarea name="contents_1" cols="60" rows="8" class="InputStyle1"><?=stripslashes($c_rows[contents_1])?></textarea>
         </td>         
        </tr>
		<tr> 
         <td class=line-n valign="top" bgcolor="f8f8f7">
         이미지첨부2</td>
         <td class="line"> 
		  <input type=checkbox name="file_chk2" value="1">수정 &nbsp;
          <input type="file" name="blog_img2" size="40" class="InputStyle1"><br>
	<? 
	   if ($c_rows[blog_img2]){
		 $p_image = "../upload/b_image/".$b_id."/".$c_rows[blog_img2];
		 echo"등록된 이미지가 있습니다 ";
	     echo"<input type='button' value='이미지보기' onclick=\"ShowImage('$p_image');\">";
	   }
	?>
         </td>         
        </tr>
       <tr> 
       <tr> 
         <td class=line-n valign="top" bgcolor="f8f8f7">내용2</td>
         <td class="line"> 
           <textarea name="contents_2" cols="60" rows="8" class="InputStyle1"><?=stripslashes($c_rows[contents_2])?></textarea>
         </td>         
        </tr>
		<tr> 
         <td class=line-n valign="top" bgcolor="f8f8f7">
         이미지첨부3</td>
         <td class="line"> 
		  <input type=checkbox name="file_chk3" value="1">수정 &nbsp;
          <input type="file" name="blog_img3" size="40" class="InputStyle1"><br>
	<? 
	   if ($c_rows[blog_img3]){
		 $p_image = "../upload/b_image/".$b_id."/".$c_rows[blog_img3];
		 echo"등록된 이미지가 있습니다 ";
	     echo"<input type='button' value='이미지보기' onclick=\"ShowImage('$p_image');\">";
	   }
	?>
         </td>         
        </tr>
       <tr> 
       <tr> 
         <td class=line-n valign="top" bgcolor="f8f8f7">내용3</td>
         <td class="line"> 
           <textarea name="contents_3" cols="60" rows="8" class="InputStyle1"><?=stripslashes($c_rows[contents_3])?></textarea>
         </td>         
        </tr>
		<tr> 
         <td class=line-n valign="top" bgcolor="f8f8f7">코멘트사용여부</td>
         <td class="line"> 
           <input type="radio" name="comm_chk" value="Y" <? if($c_rows[comm_chk]=='Y' || !$c_rows[comm_chk]) echo"checked"; ?>>댓글 사용
           <input type="radio" name="comm_chk" value="N" <? if($c_rows[comm_chk]=='N') echo"checked"; ?>>댓글 사용 안함
         </td>         
        </tr>
       </table>
       <table width="100%" border="0" cellspacing="0" cellpadding="10">
         <tr> 
           <td align="center">
	         <a href="javascript:blog_write_post()"><img src="../img/butn_ok.gif" border="0"></a>
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