<?
$qry1  = "select * from blog_list a ,blog_info b 
          where a.user_id='$b_id' And
                a.user_id=b.user_id ";
$res1  = mysql_query($qry1,$connect);
$rows1 = mysql_fetch_array($res1);

if(!$rows1){
  err_msg('블로그 정보가 존재하지 않습니다.');
}
else{
	   
   if($rows1[box_bgcolor]){
     $box_color = $rows1[box_bgcolor];
   }
   else{
     $box_color = "#D7D7D7";
   }
?>
 <br>
 <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border:5px solid <?=$box_color?>">
  <tr>
   <td style="padding:4 2 10">
	 <table  border="0" cellpadding="0" cellspacing="0" width="98%">
        <tr>
          <td width="200" align=center valign=middle>
		 <?
		  //타이틀 이미지가 존재할때
		  if($rows1[blog_logo]=='Y'){
			 if(file_exists("../upload/b_image/".$b_id."/blog_logo.".$rows1[blog_logo_ty])){
				 $a_size = getimagesize ("../upload/b_image/".$b_id."/blog_logo.".$rows1[blog_logo_ty]);
				 $width = $a_size[0];
				 $height = $a_size[1];
				 if($width > 200){
				   $width = "200";
				 }
				 if($height > 200){
				   $height = "200";
				 }
		 ?>
		 <img src="../upload/b_image/<?=$b_id?>/blog_logo.<?=$rows1[blog_logo_ty]?>" width="<?=$width?>" height="<?=$height?>" border="0" onerror="this.src='../img/noimage.gif'">
		 <?
			 }
		     else{
		 ?>
		      <img src="../img/noimage.gif"  border="0">
		 <?
			 }
		   }
		   else{
		 ?>
		      <img src="../img/noimage.gif"  border="0">
		 <?
		   }
		 ?>
		  </td>
        </tr>
        <tr>
          <td width="200" align=center>
		  <b><?=$rows1[nick_name]?></b> (<?=$b_id?>)
		  </td>
        </tr>
		<tr>
          <td width="200" height="40" valign=middle align=center>
		   <input type="button" name="프로필 보기" value="프로필 보기" onclick="location='blog_profile.php?b_id=<?=$b_id?>'" class="InputStyle">
		  </td>
        </tr>
<?
//본인의 블로그일때
if($_SESSION[p_id] && ($b_id == $_SESSION[p_id])){
?>
        <tr>
          <td width="200" valign=middle align=center>
		   <input type="button" name="글쓰기" value="글쓰기" onclick="location='blog_write.php?b_id=<?=$b_id?>'" class="InputStyle"> 
		   &nbsp;
		   <input type="button" name="블로그 관리" value="블로그 관리" onclick="location='blog_mng_form.php?b_id=<?=$b_id?>'" class="InputStyle">
		  </td>
        </tr>
<? } ?>
      </table>
	</td>
  </tr>
</table>

<br>
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border:5px solid <?=$box_color?>">
  <tr>
   <td style="padding:4 2 10">
	 <table  border="0" cellpadding="0" cellspacing="0" width="98%">
        <form name="b_search" action="blog_tlist.php">
		<input type=hidden name="b_id" value="<?=$b_id?>">
		<tr>
          <td width="200" height="30" >
		   <img src="/img/game_event_icon.gif" align=absMiddle> 블로그내 검색
		  </td>
        </tr>
        <tr>
          <td width="200" align=center>
		  <input name="s_val" type="text" class="input3" size="10">
		  <input type=image src="/img/bt_search2.gif" border="0">
		  </td>
        </tr>
		</form>
        <tr>
          <td width="200" height="30" >
		   <img src="/img/game_event_icon.gif" align=absMiddle> 블로그 리스트
		  </td>
        </tr>
        <tr>
          <td width="200" >
		   <img src="/img/notice_icon.gif" align=absMiddle> <a href="blog_tlist.php?b_id=<?=$b_id?>"><b>전체보기</b></a> 
		  </td>
        </tr>
 <?
  $qry2 = "select * from blog_brd_list where user_id='$b_id' ";
  $res2  = mysql_query($qry2,$connect);
  for($ii=0; $rows2 = mysql_fetch_array($res2); $ii++){
 ?> 
        <tr>
          <td width="200" >
		   <img src="/img/notice_icon.gif" align=absMiddle> <a href="blog_list.php?b_id=<?=$b_id?>&b_nm=<?=$rows2[num]?>"><?=$rows2[brd_title]?></a> 
		  </td>
        </tr>
 <?
  }
  mysql_free_result($res2);
 ?>
	  </table>
	</td>
  </tr>
</table>
<?
	  if(!$mode) {
		 $today=date("Y-m-d");
		 $a_today=explode("-",$today);

		 $year=$a_today[0];
		 $month=$a_today[1];
		 $day=$a_today[2];
	  }

	  if($mode=='back') {
		 if($month=='1') {
		   $year=$year-1;
		   $month=12;
		 }
		 else{
		   $month=$month-1;
		 }
	  }

	  if($mode=='next') {
		if($month=='12') {
			$year=$year+1;
			$month=1;
		}
		else{
			$month=$month+1;
		} 
	  }

    $month_1 = strlen($month);
	$year_1 = strlen($year);
	
	$month_2 = (int)($month);
	$year_2 = (int)($year);
    $day = (int)($day);

    $last_day=date("t", mktime(1,1,1,$month_2,1,$year_2));
    if($day>$last_day) {
         $day=$last_day;
    }
    $now_day_yoil= date("l", mktime(0,0,0,$month_2 , $day , $year_2));
	$first_day_yoil = date("l", mktime(0,0,0,$month_2 , 1, $year_2)); 
               
    $m_weekand[0] = "Sunday";
	$m_weekand[1] = "Monday";
	$m_weekand[2] = "Tuesday";
	$m_weekand[3] = "Wednesday";
	$m_weekand[4] = "Thursday";
	$m_weekand[5] = "Friday";
	$m_weekand[6] = "Saturday";
?>
<br>
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border:5px solid <?=$box_color?>">
  <tr>
   <td style="padding:4 2 10">
	 <table  border="0" cellpadding="0" cellspacing="0" width="98%">
		<tr>
          <td width="200" align=center>
		  <?
	       $back_url = $PHP_SELF."?b_id=".$b_id."&day=".$day."&month=".$month."&year=".$year."&mode=back";
           $next_url = $PHP_SELF."?b_id=".$b_id."&day=".$day."&month=".$month."&year=".$year."&mode=next";
          ?>
		  <a href="<?=$back_url?>">◀</a>  
		   <?=$year?> / <?=$month?> / <?=$day?>  
		  <a href="<?=$next_url?>">▶</a>
		  </td>
        </tr>
        <tr>
          <td width="200" align=center>
		    <table width="95%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td bgcolor="#F4DF8B">
                  <table width="100%" border="0" cellspacing="1" cellpadding="1">
                    <tr align="center" valign="middle"> 
                      <td bgcolor="#FFCC33"><font color="#FF0000">일</font></td>
                      <td bgcolor="#FFCC33">월</td>
                      <td bgcolor="#FFCC33">화</td>
                      <td bgcolor="#FFCC33">수</td>
                      <td bgcolor="#FFCC33">목</td>
                      <td bgcolor="#FFCC33">금</td>
                      <td bgcolor="#FFCC33"><font color="#0000FF">토</font></td>
                    </tr>
                    <tr align="center" valign="middle"> 
          <?     
              for($i = 0; $i < 7; $i++) {
	            if( $m_weekand[$i] != $first_day_yoil ) {
                   echo ("<td>&nbsp;</td>");
		           $count++;
		         } else{
		   	       break;
		         }	
	           }  	
	          for($i=1; $i <= $last_day; $i++) {
		         if($i==$day){
				   $font_color = "#5544ff";
				 } else if($count == 0) {
				   $font_color = "red";
				 } else{
				   $font_color = "#000000";
				 }

				 $ndate =  date("Ymd", mktime(0,0,0,$month_2 , $i , $year_2));
                 
       	  	    echo("<td><a href='blog_tlist.php?b_id=$b_id&dt=$ndate'><font color='$font_color'>$i</font></a></td>");
		       $count++;
		
		       if($count == 7) {
			     echo ("</tr><tr align='center' valign='middle'>");
			     $count = 0;
		       }
	        }     
          ?>				     
                  </table>
                </td>
              </tr>
            </table>
		  </td>
        </tr>
	  </table>
	</td>
  </tr>
</table>

<?
//오늘 날짜를 구합니다.
$n_date = date('Ymd');
//오늘 날짜에 해당되는 방문자수
$t_qry1 = "select * from blog_visit_count 
		   where user_id='$b_id' And
				 visit_date = '$n_date' ";
$t_res1 = mysql_query($t_qry1,$connect);
$t_rows1 = mysql_fetch_array($t_res1);
mysql_free_result($t_res1);
		
//총 방문자
$t_qry2 = "select sum(visit_count) as tcnt from blog_visit_count 
		   where user_id='$b_id' ";
$t_res2 = mysql_query($t_qry2,$connect);
$t_rows2 = mysql_fetch_array($t_res2);
mysql_free_result($t_res2);
		
?>
<br>
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border:5px solid <?=$box_color?>">
  <tr>
   <td style="padding:4 2 10">
	 <table border="0" cellpadding="0" cellspacing="0" width="95%">
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
	  </table>
	</td>
  </tr>
</table>

<br>
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border:5px solid <?=$box_color?>">
  <tr>
   <td style="padding:4 2 10">
	 <table border="0" cellpadding="0" cellspacing="0" width="95%">
		<tr> 
		 <td align=left height="30" valign=middle>
		   <img src="/img/game_event_icon.gif" align=absMiddle> 최근댓글
		 </td>
		</tr>
 <?
  $blog_ct = "bg_".$b_id."_ct";
  $qry3 = "select * from $blog_ct 
           where id_fk='$b_id' order by cnum desc limit 0,5 ";
  $res3  = mysql_query($qry3,$connect);
  for($ii=0; $rows3 = mysql_fetch_array($res3); $ii++){
	 $com_desc = shortenStr($rows3[memo],16);
 ?> 
        <tr>
          <td width="200">
		   <img src="/img/notice_icon.gif" align=absMiddle> <a href="blog_view.php?b_id=<?=$b_id?>&brd_num=<?=$rows3[num_fk]?>"><?=$com_desc?></a> 
		  </td>
        </tr>
 <?
  }
  mysql_free_result($res3);
 ?>
	  </table>
	</td>
  </tr>
</table>


<br>
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border:5px solid <?=$box_color?>">
  <tr>
   <td style="padding:4 2 10">
	 <table border="0" cellpadding="0" cellspacing="0" width="95%">
		<tr> 
		 <td align=left height="30" valign=middle>
		   <img src="/img/game_event_icon.gif" align=absMiddle> 최근 방문객
		 </td>
		</tr>
 <?
  $qry4 = "select b.user_id,b.nick_name from blog_visit_member a , blog_list b
                    where a.user_id='$b_id' And a.visit_id=b.user_id limit 0,5 ";
  $res4  = mysql_query($qry4,$connect);
  for($ii=0; $rows4 = mysql_fetch_array($res4); $ii++){
 ?> 
        <tr>
          <td width="200">
		   <img src="/img/notice_icon.gif" align=absMiddle> <a href="blog_main.php?b_id=<?=$rows4[user_id]?>"><?=$rows4[nick_name]?>(<?=$rows4[user_id]?>)</a> 
		  </td>
        </tr>
 <?
  }
  mysql_free_result($res4);
 ?>
	  </table>
	</td>
  </tr>
</table>

<? } ?>
