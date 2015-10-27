<?
// 데이타베이스 연결정보 및 기타설정
include "../php/config.php";
// 각종 유틸함수
include "../php/util.php";
// MySQL 연결
$connect=my_connect($host,$dbid,$dbpass,$dbname);

if(!$name || !$jumin1 || !$jumin2){
  err_msg('정식으로 접속하세요.');
}

$jnumber = $jumin1."-".$jumin2;

$query = "select * from member where name='$name' and jnumber='$jnumber' ";
$result = mysql_query($query,$connect);
$ksh = mysql_fetch_array($result);
mysql_free_result($result);

if(!$ksh){
  err_msg('이름 및 주민번호와 일치하는 정보가 없습니다.');
}
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=euc-kr">
<title>PHPSAMPLE SITE</title>
<link rel="stylesheet" href="../common/global.css">
<script language="JavaScript" src="../common/global.js"></script>
<script language="JavaScript" src="../common/member.js"></script>
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
    <td width="728" height="576" valign="top" align=center >
       <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td height="30" style="padding:10 0 0 14px"><a href="/">홈</a> 
              &gt; 회원정보 &gt; <a href="../member/.php">아이디 패스워드 찾기</a></td>
          </tr>
        </table>
        <table width="92%" border="0" cellspacing="1" cellpadding="3">
          <tr> 
            <td style="padding:7 0 6 10px"  bgcolor="F5F6F1">아이디 찾기 : </td>
          </tr>
        </table>
        <table width="92%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FAFAFA">
          <tr> 
            <td valign="top" > <br>
              <table width="90%" border="0" cellspacing="2" cellpadding="2">
				<tr> 
                  <td width="95%" align="center" valign=middle>
				    <?=$name?> 회원님의 아이디는 <?=$ksh[id]?> 입니다. 
				  </td>
                </tr>
              </table>
              <br>
            </td>
          </tr>
        </table>
	</td>
  </tr>
</table>
</body>
</html>
