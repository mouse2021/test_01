<?
########## 데이터베이스에 연결한다. ##########
// 데이타베이스 연결정보 및 기타설정
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
                <form name=form1 method=post action="id_search_result.php">
				<tr> 
                  <td width="38%" align="right"><b>이름</b></td>
                  <td width="62%"> 
                    <input type="text" name="name" size="18" class="InputStyle1">
                  </td>
                </tr>
                <tr> 
                  <td width="38%" align="right"><b>주민번호</b></td>
                  <td width="62%"> 
                    <input class="InputStyle1"  size=7 name="jumin1" OnKeyUp="focus_move();">
                    - 
                    <input class="InputStyle1"  size=7 name="jumin2" >
                  </td>
                </tr>
                <tr> 
                  <td width="38%" align="right">&nbsp;</td>
                  <td width="62%"><a href="javascript:lost_checkInput1();"><img src="../img/butn_ok.gif" border="0"></a><a href="/index.php"><img src="../img/btn_cancel.gif" hspace="4" border="0"></a></td>
                </tr>
				</form>
              </table>
              <br>
            </td>
            <td width="54%" style="padding:0 22 18 0px" valign="top">&nbsp;
            </td>
          </tr>
        </table>
        <br>
        <table width="92%" border="0" cellspacing="1" cellpadding="3">
          <tr> 
            <td style="padding:7 0 6 10px"  bgcolor="F5F6F1">패스워드 찾기 : </td>
          </tr>
        </table>
        <table width="92%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FAFAFA">
		  <tr> 
            <td valign="top" > <br>
              <table width="90%" border="0" cellspacing="2" cellpadding="2">
                <form name=form2 method=post action="pass_search_result.php">
				<tr> 
                  <td width="38%" align="right"><b>아이디</b></td>
                  <td width="62%"> 
                    <input type="text" name="id" size="18" class="InputStyle1">
                  </td>
                </tr>
                <tr> 
                  <td width="38%" align="right"><b>이름</b></td>
                  <td width="62%">
                    <input type="text" name="name" size="18" class="InputStyle1">
                  </td>
                </tr>
                <tr> 
                  <td width="38%" align="right" class="b_data1"><b>주민번호</b></td>
                  <td width="62%">
                    <input class="InputStyle1"  size=7 name="jumin1" OnKeyUp="focus_move2();">
                    - 
                    <input class="InputStyle1"  size=7 name="jumin2" >
                  </td>
                </tr>
                <tr> 
                  <td width="38%" align="right">&nbsp;</td>
                  <td width="62%"><a href="javascript:lost_checkInput2();"><img src="../img/butn_ok.gif" border="0"></a><a href="/index.php"><img src="../img/btn_cancel.gif" hspace="4" border="0"></a></td>
                </tr>
				</form>
              </table>
              <br>
            </td>
            <td width="54%" style="padding:0 22 18 0px" valign="top"> <br>&nbsp;
            </td>
          </tr>
        </table>
	  </form>
	</td>
  </tr>
</table>
</body>
</html>
