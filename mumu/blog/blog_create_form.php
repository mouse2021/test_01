<?
include "../php/config.php";
// 각종 유틸함수
include "../php/util.php";
// MySQL 연결
$connect=my_connect($host,$dbid,$dbpass,$dbname);

if(!isset($_SESSION["p_id"]) || !isset($_SESSION["p_name"])){
  err_msg('회원 로그인 후 사용할 수 있습니다.');
}

$query = "select * from blog_list where user_id ='$_SESSION[p_id]' ";
$result = mysql_query($query, $connect);
$rows = mysql_fetch_array($result);
mysql_free_result($result);

if($rows){
  err_msg('이미 본인의 블로그가 생성되어 있습니다.');
}
else{

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
      include '../include/main_left.php';  
      ?>
    </td>
    <td width="728" valign="top" >
     
	 <form name=form1 method=post action="blog_create_post.php" enctype="multipart/form-data">
	   <table width="100%" border="0" cellspacing="1" cellpadding="2">
        <tr> 
         <td colspan=2 class=line-t height=1 bgcolor="#e1e1e1"></td>
        </tr>
        <tr> 
         <td class=line-n valign="top" bgcolor="#f8f8f7">아이디</td>
         <td class="line"> 
           <?=$_SESSION[p_id]?>
		 </td>
       </tr>
       <tr> 
        <td class=line-n valign="top" bgcolor="f8f8f7"> 
         블로그명</td>
        <td class="line"> 
         <input type="text" name="blog_name" size="25" class="InputStyle1">
        </td>
       </tr>
	   <tr> 
        <td class=line-n valign="top" bgcolor="f8f8f7"> 
         닉네임</td>
        <td class="line"> 
         <input type="text" name="nick_name" size="16" class="InputStyle1">
        </td>        
       </tr>
       <tr> 
        <td class=line-n valign="top" bgcolor="f8f8f7"> 블로그 소개</td>
        <td class="line"> 
          <input type="text" name="blog_cont" size="45" class="InputStyle1">
        </td>        
       </tr>
       <tr> 
         <td class=line-n valign="top" bgcolor="f8f8f7">생성일</td>
         <td class="line"> 
           <?=date('Y-m-d H:i:s')?> 
         </td>         
        </tr>
        <tr> 
         <td class=line-n valign="top" bgcolor="f8f8f7">
         표지이미지</td>
         <td class="line"> 
          <input type="file" name="t_image" size="30">
         </td>         
        </tr>
        <tr> 
         <td class=line-n valign="top" bgcolor="f8f8f7">정보공개여부</td>
         <td class="line"> 
           <input type="radio" name="view_chk" value="Y" checked>공개
           <input type="radio" name="view_chk" value="N" >비공개
         </td>         
        </tr>
       </table>
       <table width="100%" border="0" cellspacing="0" cellpadding="10">
         <tr> 
           <td align="center">
	         <a href="javascript:blog_created()"><img src="../img/butn_ok.gif" border="0"></a>
		     <a href="/index.php"><img src="../img/btn_cancel.gif" hspace="4" border="0"></a>
			 </td>
           </tr>
         </table>
	  </form>
	</td>
  </tr>
</table>
</body>
</html>
<? } ?>
