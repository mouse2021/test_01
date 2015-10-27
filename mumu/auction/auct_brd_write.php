<?
include "../php/config.php";
// 각종 유틸함수
include "../php/util.php";
// MySQL 연결
$connect=my_connect($host,$dbid,$dbpass,$dbname);

if(!isset($_SESSION["p_id"]) || !isset($_SESSION["p_name"])){
  err_msg('회원 로그인 후 사용할 수 있습니다.');
}

//종료된 경매 업데이트
end_exe($connect);

?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=euc-kr">
<title>PHPSAMPLE SITE</title>
<link rel="stylesheet" href="../common/global.css">
<script language="JavaScript" src="../common/global.js"></script>
<script language="JavaScript" src="../common/auction.js"></script>
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

      //경매프로그램의 왼쪽 메뉴를 파일에서 불러옵니다.
      include '../include/left_menu3.php';  
      ?>
    </td>
    <td width="728" valign="top" >
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr> 
        <td height="30" style="padding:10 0 0 14px"><a href="/">홈</a> 
          &gt; <a href="../auction/auct_main.php">AUCTION</a> &gt; 게시판</a></td>
      </tr>
     </table>
<?
$query = "select * from auct_master where anum=$anum";
$result = mysql_query($query, $connect);
$rows = mysql_fetch_array($result);
mysql_free_result($result);

if(!$rows){
  err_msg('경매 코드에 속하는 경매가 존재하지 않습니다.');
}
?>
     <table width="645" border="0" cellspacing="0" cellpadding="0">
	   <tr> 
        <td valign="top"> <br>
          <table width="90%" border="0" cellspacing="0" cellpadding="0">
            <tr> 
             <td height="30" align="center" class="text5"><?=$rows[prod_name]?></td>
            </tr>
            <tr> 
             <td height="5" bgcolor="#585858"></td>
            </tr>
           </table>
           <br> 
		   <table width="90%" border="0" cellspacing="0" cellpadding="0">
            <tr> 
             <td width="80" height="26" class="line">경매마감일</td>
             <td class="line"> 
			 <?=substr($rows[auct_end],0,4)?>년
			 <?=substr($rows[auct_end],4,2)?>월
			 <?=substr($rows[auct_end],6,2)?>일
		     <?=substr($rows[auct_end],8,2)?>시  
			 </td>
			 <td width="80" height="26" class="line">판매개수</td>
             <td class="line"> 
			 <?=number_format($rows[total_cnt])?>개
			  </td>
            </tr>
			<tr> 
             <td width="80" height="26" class="line">현재가</td>
             <td class="line"> <?=number_format($rows[curr_amt])?>원</td>
			 <td width="80" height="26" class="line">즉시구매가</td>
             <td class="line"> <?=number_format($rows[limit_amt])?>원</td>
            </tr>			
            </table>
          </td>
         </tr>
		  <form method='post' name='form1' action='auct_brd_post.php'>
		  <input type="hidden" name="anum" value="<?=$anum?>">
		  <input type="hidden" name="md" value="write">
		  <tr>
		    <td>
			<br>
			  <table width="730" border="0" cellspacing="1" cellpadding="2" class="linetop">
				<tr bgcolor="#FFFFFF"> 
				  <td  class="line" align="right" bgcolor="#F5F5f5">제목&nbsp;</td>
				  <td  class="line" align="right">&nbsp;</td>
				  <td class="line"> 
					<input type="text" name="subject" class="inputstyle" size="50">
				  </td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
				  <td  class="line" align="right" bgcolor="#F5F5f5">내용&nbsp;</td>
				  <td  class="line" align="right">&nbsp;</td>
				  <td class="line"> 
					<textarea name="contents" cols="80" rows="10" style="padding:6 6 6 6px" class="inputstyle"></textarea>
				  </td>
				</tr>
			  </table>
			  <table width="730" border="0" cellspacing="0" cellpadding="5">
				<tr> 
				  <td align="center">
				   <a href="javascript:brd_send_post()"><img src="../img/bt_ok2.gif" border="0"></a>
				   <a href="auct_brd_list.php?anum=<?=$anum?>"><img src="../img/bt_cancel2.gif" border="0"></a>
				</td>
			   </tr>
			  </table>
			</td>
		  </tr>
		  </form>
		  <tr>
   <?
     if($rows[end_chk]=='Y'){
	     $go_join    = "javascript:alert('종료된 경매입니다.')";
	 }
	 else{
			if(!$_SESSION[p_id]){
				$go_join    = "javascript:alert('경매입찰은 로그인 후에 가능합니다.')";
			}
			else{
				 $go_join    = "auct_join.php?anum=$anum&gb=1";
			}
	 }
  ?>   
		   <td align=center colspan="2">
		     <br>
		     <table width="90%" border="0" cellspacing="4" cellpadding="5">
              <tr> 
               <td align="center">
			    <b><a href="<?=$go_join?>">경매입찰</a></b> | 
			   <b><a href="auct_details.php?anum=<?=$anum?>">상세페이지</a></b>
			   </td>
              </tr>
             </table>
		   </td>
		  </tr>
        </table>		
	</td>
  </tr>
</table>
</body>
</html>
