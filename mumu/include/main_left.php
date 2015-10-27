<table border="0" cellpadding="0" cellspacing="0" width="215" style="border:5px solid #D7D7D7">
  <tr>
   <td style="padding:4 2 10">
<?
// 로그인 했을 경우
if($_SESSION[p_id]){
	//본인의 블로그 존재유무확인
	$c_qry = "select * from blog_list where user_id='$_SESSION[p_id]' ";
	$c_res = mysql_query($c_qry,$connect);
	$c_rows = mysql_fetch_array($c_res);
	mysql_free_result($c_res);

	// 본인의 블로그가 있을 경우
	if($c_rows){
		//오늘 날짜를 구합니다.
		$n_date = date('Ymd');
		//오늘 날짜에 해당되는 방문자수
		$t_qry1 = "select * from blog_visit_count 
				   where user_id='$_SESSION[p_id]' And
						 visit_date = '$n_date' ";
		$t_res1 = mysql_query($t_qry1,$connect);
		$t_rows1 = mysql_fetch_array($t_res1);
		mysql_free_result($t_res1);
		
		//총 방문자
		$t_qry2 = "select sum(visit_count) as tcnt from blog_visit_count 
				   where user_id='$_SESSION[p_id]' ";
		$t_res2 = mysql_query($t_qry2,$connect);
		$t_rows2 = mysql_fetch_array($t_res2);
		mysql_free_result($t_res2);
		
		//본인의 블로그 테이블
		$blog_t = "bg_".$_SESSION[p_id]."_t";

		//총등록된 블로그글 수
		$t_qry3 = "select * from $blog_t ";
		$t_res3 = mysql_query($t_qry3,$connect);
		$tot3 = mysql_num_rows($t_res3);
		mysql_free_result($t_res3);
  
	?>
   <table border="0" cellpadding="0" cellspacing="0" width="95%">
    <tr> 
     <td colspan="4" align=center>
	   <img src="/img/game_event_icon.gif" align=absMiddle> MY 블로그 정보
     </td>
    </tr>
	<tr> 
     <td width="13"><img src="/img/notice_icon.gif" align=absMiddle></td>
     <td class="line2" width="75">오늘 방문자</td>
     <td class="line2" align="center" width="10">:</td>
     <td class="line2" align="right" width="62">
	   <b><?=number_format($t_rows1[visit_count])?></b> 명
	 </td>
    </tr>
    <tr> 
     <td width="13"><img src="/img/notice_icon.gif" align=absMiddle></td>
     <td class="line2" width="75">총 방문자</td>
     <td class="line2" align="center" width="10">:</td>
     <td class="line2" align="right" width="62">
	 <b><?=number_format($t_rows2[tcnt])?></b> 명
	 </td>
   </tr>
   <tr> 
     <td width="13"><img src="/img/notice_icon.gif" align=absMiddle></td>
     <td class="line2" width="75">총 글수</td>
     <td class="line2" align="center" width="10">:</td>
     <td class="line2" align="right" width="62"><b>
	   <a href="/blog/blog_tlist.php?b_id=<?=$_SESSION[p_id]?>"><?=$tot3?></b> 개</a>
	 </td>
   </tr>
   <td width="100%" height="40" valign="middle" colspan="4" align=center>
      <input type="button" name="MY 블로그 바로가기" value="MY 블로그 바로가기" onclick="location='/blog/blog_main.php?b_id=<?=$_SESSION[p_id]?>'" class="InputStyle">
    </td>
   </tr>
  </table>

<?
	}
	else{  //회원로그인은 되어있으나 본인의 블로그가 없을 경우
?>
  <table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr> 
     <td width="100%" colspan="4" height="35" valign=middle align=center>
	   <img src="/img/game_event_icon.gif" align=absMiddle> MY 블로그 정보
     </td>
    </tr>
	<tr> 
     <td width="100%" colspan="4" align=center>블로그가 존재하지 않습니다.
	 </td>
    </tr>
	<tr> 
     <td width="100%" colspan="4" align=center>
	  <input type="button" name="MY 블로그 생성" value="MY 블로그 생성" onclick="location='/blog/blog_create_form.php'" class="InputStyle">
	 </td>
    </tr>
 </table>
<?
    }
}
else{  // 로그인 하지 않았을 경우
?>
 <table  border="0" cellpadding="0" cellspacing="0" width="100%">
   <tr>
    <td width="200" height="32" bgcolor="whitesmoke"><p>&nbsp;
	  <img src="/img/game_event_icon.gif" align=absMiddle> 사이트 메뉴</p>
	</td>
   </tr>
   <tr>
    <td width="200" height="23" >&nbsp;
	 <img src="/img/notice_icon.gif" align=absMiddle>
     <a href="/member/join.php">회원가입</a>
	</td>
   </tr>
 </table>
<?
}
?>
</td>
</tr>
</table>

