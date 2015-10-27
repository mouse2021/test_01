<?
include "../php/config.php";
// 각종 유틸함수
include "../php/util.php";
// MySQL 연결
$connect=my_connect($host,$dbid,$dbpass,$dbname);

// 이름과 아이디에 해당되는 세션이 존재하는지 확인
if(!isset($_SESSION["p_id"]) || !isset($_SESSION["p_name"])){
  err_msg('로그인 정보가 없습니다. 다시 로그인해 주세요.');
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

      //메인의 왼쪽 메뉴를 파일에서 불러옵니다.
      include '../include/main_left.php';  
      ?>
    </td>
    <td width="728" valign="top" >
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr> 
        <td height="30" style="padding:10 0 0 14px"><a href="/">홈</a> 
          &gt; 메시지 </td>
      </tr>
     </table>
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="89" style="padding:16 0 0 25px"> 
            <table width="90%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td ><img src="../img/message_title.gif" width="30" height="30" align="absmiddle" hspace="2">메시지 확인</td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
	  <form method='post' name="form1" action="message_del.php">
	  <input type="hidden" name="gb">
	  <table width="90%" border="0" cellspacing="0" cellpadding="6">
        <tr>
          <td align="right"> 
            <a href="message_2.php">받은쪽지함</a> | 
			<a href="message_2.php">보낸쪽지함</a> |
            <a href="message_3.php">쪽지쓰기</a>
		  </td>
        </tr>
      </table>
      <table width="90%" border="0" cellspacing="0" cellpadding="0">
		<tr bgcolor="CCCCCC"> 
		   <td align="center" class="line2">메시지</td>
		   <td align="center" class="line2">보낸시간</td>
		 </tr>
	  
<?	  
      $query2 = "select * from message_info where mnum='$mnum' ";
	  $result2 = mysql_query($query2, $connect);
	  $rows2 = mysql_fetch_array($result2);
      

	  //받은 편지함 & 수신전
      if($gb=='1' && ($rows2[receive_chk] =='N')){
	    $query1  = "update message_info set receive_chk='Y',receive_reg=now() where mnum='$mnum' ";
		$result1 = mysql_query($query1,$connect);
      }
?>
     <tr> 
       <td class="line">
	     <?=nl2br(stripslashes($rows2[message]))?></a>
	   </td>
	   <td align="center" class="line"><?=$rows2[send_reg]?></td>
      </tr>
     </table>
	 <table width="90%" border="0" cellspacing="0" cellpadding="0">
       <tr>
	     <td height="36">
		 <a href="message_del.php?mode=view&gb=<?=$gb?>"><img src="../img/bt_del2.gif" hspace="4" border="0"></a> 
		 </td>
       </tr>
     </table>
	  <br>
	</td>
  </tr>
</table>
</body>
</html>
