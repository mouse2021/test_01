<?
########## 데이터베이스에 연결한다. ##########
// 데이타베이스 연결정보 및 기타설정
include "../php/config.php";
// 각종 유틸함수
include "../php/util.php";
// MySQL 연결
$connect=my_connect($host,$dbid,$dbpass,$dbname);

// 이름과 아이디에 해당되는 세션이 존재하는지 확인
if(!isset($_SESSION["p_id"]) || !isset($_SESSION["p_name"])){
  err_msg('로그인 정보가 없습니다. 다시 로그인해 주세요.');
}
else{
   // 회원테이블에서 정보추출
   $qry = "select * from member where id='$_SESSION[p_id]' ";
   $res = mysql_query($qry,$connect);
   $rows = mysql_fetch_array($res);
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
    <td width="728" height="576" valign="top" >
       <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td height="30" style="padding:10 0 0 14px"><a href="/">홈</a> 
              &gt; 회원정보 &gt; <a href="mem_edit.php">회원수정</a></td>
          </tr>
        </table>
      <form name=form1 method=post action="mem_edit_post.php">
	   <table width="100%" border="0" cellspacing="1" cellpadding="2">
        <tr> 
         <td colspan=3 class=line-t height=1 bgcolor="#e1e1e1"></td>
        </tr>
        <tr> 
         <td class=line-n valign="top" bgcolor="#f8f8f7">아이디</td>
         <td class="line"> 
           <?=$rows[id]?>
		 </td>
         <td rowspan="2"></td>
       </tr>
       <tr> 
         <td class=line-n valign="top" bgcolor="f8f8f7"> 비밀번호</td>
         <td class="line"> 
          <input type="password" name="passwd" size="16" value="<?=$rows[passwd]?>" class="InputStyle1" maxlength="10">
          <br>
          특수문자, 공백을 포함할 수 없으며<br>
          대, 소문자를 구분합니다.(5~10자 사이)</td>
          <td></td>
       </tr>
       <tr> 
        <td class=line-n valign="top" bgcolor="f8f8f7"> 
         비밀번호 재입력</td>
        <td class="line"> 
         <input type="password" name="passwd2" size="16" value="<?=$rows[passwd]?>"  class="InputStyle1">
        </td>
        <td></td>
       </tr>
       <tr> 
        <td class=line-n valign="top" bgcolor="f8f8f7"> 이름</td>
        <td class="line"> 
          <input type="text" name="name" size="16" value="<?=$rows[name]?>" class="InputStyle1">
        </td>
        <td></td>
       </tr>
       <tr> 
         <td class=line-n valign="top" bgcolor="f8f8f7">주민등록번호</td>
         <td class="line"> 
           <?=substr($rows[jnumber],0,6)?> - *******
         </td>
         <td></td>
        </tr>
        <tr> 
         <td class=line-n valign="top" bgcolor="f8f8f7">
         전자메일</td>
         <td class="line"> 
          <input type="text" name="email" value="<?=$rows[email]?>" size="25"  class="InputStyle1">
         </td>
         <td></td>
        </tr>
		<?
	     // 우편번호를 "-"를 기준으로 나눕니다.
         $a_zipno = explode("-",$rows[zipcode]);
	   ?>
        <tr> 
         <td class=line-n valign="top" bgcolor="f8f8f7"> 
          우편번호</td>
         <td class="line"> 
         <input type="text" name="zipcode1" size="3" value="<?=$a_zipno[0]?>" class="InputStyle1">
         - 
         <input type="text" name="zipcode2" size="3" value="<?=$a_zipno[1]?>" class="InputStyle1">
         <a href="javascript:ZipWindow('zip_search.php')">우편번호 검색</a> 
         </td>
         <td></td>
        </tr>
        <tr> 
         <td class=line-n valign="top" bgcolor="f8f8f7"> 주소</td>
         <td class="line"> 
          <input type="text" name="address1" value="<?=$rows[address1]?>" size="35"  class="InputStyle1">
          (동까지 입력)<br>
          <input type="text" name="address2" value="<?=$rows[address2]?>" size="35"  class="InputStyle1" maxlength="50">
          (나머지 입력)</td>
          <td></td>
         </tr>
	   <?
	     // 전화번호를 "-"를 기준으로 나눕니다.
         $a_phone = explode("-",$rows[phone]);
	   ?>
         <tr> 
          <td class=line-n valign="top" bgcolor="f8f8f7"> 
          전화번호</td>
          <td class="line"> 
           <input type="text" name="phone1" size="3" value="<?=$a_phone[0]?>" class="InputStyle1">
           - 
           <input type="text" name="phone2" size="4" value="<?=$a_phone[1]?>" class="InputStyle1">
           - 
           <input type="text" name="phone3" size="4" value="<?=$a_phone[2]?>"  class="InputStyle1">
           (자택 또는 회사)</td>
           <td></td>
          </tr>
	  <?
	     // 휴대폰번호를 "-"를 기준으로 나눕니다.
         $a_hphone = explode("-",$rows[mobile]);
	   ?>
          <tr> 
           <td class=line-n valign="top" bgcolor="f8f8f7"> 
            휴대폰</td>
           <td class="line"> 
            <select name="hphone1" class="InputStyle1">
		      <option value="">선택</option>
              <option value="011" <? if($a_hphone[0] =='011') echo"selected"; ?> >011</option>
              <option value="016" <? if($a_hphone[0] =='016') echo"selected"; ?>>016</option>
              <option value="017" <? if($a_hphone[0] =='017') echo"selected"; ?>>017</option>
              <option value="018" <? if($a_hphone[0] =='018') echo"selected"; ?>>018</option>
              <option value="019" <? if($a_hphone[0] =='019') echo"selected"; ?>>019</option>
             </select>
             - 
             <input type="text" name="hphone2" size="4" value="<?=$a_hphone[1]?>" class="InputStyle1">
             - 
             <input type="text" name="hphone3" size="4" value="<?=$a_hphone[2]?>"  class="InputStyle1">
            </td>
            <td></td>
           </tr>
          </table>
          <table width="100%" border="0" cellspacing="0" cellpadding="10">
            <tr> 
             <td align="center">
			   <a href="javascript:checkEdit()"><img src="../img/butn_ok.gif" border="0"></a>
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
