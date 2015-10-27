<?
include "../php/config.php";
// 각종 유틸함수
include "../php/util.php";
// MySQL 연결
$connect=my_connect($host,$dbid,$dbpass,$dbname);
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

      //왼쪽 메뉴를 파일에서 불러옵니다.
      include '../include/left_menu1.php';  
      ?>
    </td>
    <td width="728" valign="top" >
     <?  
     //사용자가 설정한 부분
     include '../include/blog_main_top.php';  
     ?>
	 <br><br>
  <?
    //비공개일때
    if(($b_id != $_SESSION[p_id]) && $rows1[view_chk] =='N'){
  ?>
     <table width="100%" border="0" cellspacing="1" cellpadding="2">
        <tr> 
         <td colspan=2 class=line-t height=1 bgcolor="#e1e1e1"></td>
        </tr>
        <tr> 
         <td class=line-n valign="middle" align=center height="300" bgcolor="#f8f8f7">
		   <?=$rows1[nick_name]?> 님이 비공개로 해두었습니다.
		 </td>
       </tr>
	 </table>
 <?
	}
    else{
 ?>
    <table width="100%" border="0" cellspacing="1" cellpadding="2">
       <tr> 
        <td class=line-n valign="top" bgcolor="f8f8f7"> 
         블로그명</td>
        <td class="line"> 
		  <?=$rows1[blog_name]?>&nbsp;
        </td>
       </tr>
	   <tr> 
        <td class=line-n valign="top" bgcolor="f8f8f7"> 
         닉네임</td>
        <td class="line"> 
         <?=$rows1[nick_name]?>&nbsp;
        </td>        
       </tr>
       <tr> 
        <td class=line-n valign="top" bgcolor="f8f8f7"> 블로그 소개</td>
        <td class="line"> 
          <?=$rows1[blog_cont]?>&nbsp;
        </td>        
       </tr>
	   <tr> 
        <td class=line-n valign="top" bgcolor="f8f8f7"> 본인 소개</td>
        <td class="line"> 
          <?=nl2br($rows1[my_profile])?>&nbsp;
        </td>        
       </tr>
       <tr> 
         <td class=line-n valign="top" bgcolor="f8f8f7">생성일</td>
         <td class="line"> 
           <?=$rows1[blog_cdate]?>&nbsp;
         </td>         
        </tr>
       </table>
 <? } ?>
     <?  
     //사용자가 설정한 부분
     include '../include/blog_main_bt.php';  
     ?>
	</td>
  </tr>
</table>
</body>
</html>

