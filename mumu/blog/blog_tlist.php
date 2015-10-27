<?
include "../php/config.php";
// 각종 유틸함수
include "../php/util.php";
// MySQL 연결
$connect=my_connect($host,$dbid,$dbpass,$dbname);

$qry  = "select * from blog_list where user_id='$b_id' ";
$res  = mysql_query($qry,$connect);
$rows = mysql_fetch_array($res);

if(!$rows){
  err_msg('블로그 정보가 존재하지 않습니다.');
}

// 블로그 기본 정보를 불러옵니다.
$rows1 = blog_info_fnc($b_id,$connect);

//하루동안 방문기록 여부 변수
$_cookie_val = $_COOKIE[v_id];

// 방문자 기록 저장 
blog_visit_fnc($b_id,$_SESSION[p_id],$_cookie_val,$connect);

if($_SESSION[p_id]){
  if($b_id == $_SESSION[p_id]){
    $auth_key = "1";
  } 
  else{
    $auth_key = "2";
  }
}
else{
  $auth_key = "3";
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

      //왼쪽 메뉴를 파일에서 불러옵니다.
      include '../include/left_menu1.php';  
      ?>
    </td>
    <td width="728" valign="top" >
     <?  
     //사용자가 설정한 부분
     include '../include/blog_main_top.php';  
     ?>
	 
	   <table width="100%" border="0" cellspacing="1" cellpadding="2">
        <tr> 
         <td colspan=2 class=line-t height=1 bgcolor="#e1e1e1"></td>
        </tr>
        <tr> 
         <td class=line-n colspan=2 height="30" valign="top" bgcolor="#EEECCC">
		   <b>전체 리스트 보기</b> 
	  <?
		//좌측 검색메뉴를 통한 검색일때
		if($s_val){
		  $s_val_qry = " And ( a.title like '%s_val%' or
		                       a.contents_1 like '%$s_val%' or
							   a.contents_2 like '%$s_val%' or 
							   a.contents_3 like '%$s_val%' ) ";
		  echo"(검색어 : $s_val )";
		}
        
		//좌측 달력에서 날짜를 선택해서 들어왔을 경우
		if($dt){
		  $dt_qry = " And a.wdate='$dt' ";
		  echo" (검색일자 : $dt )";
		}
	  ?>
		 </td>
       </tr>
	   
	   <?
	    // 페이지 이동시 사용할 정보
		$get_url ="?b_id=".$b_id."&s_val=".$s_val."&dt=".$dt;

        //블로그 테이블
	    $blog_t = "bg_".$b_id."_t";
		$blog_ct = "bg_".$b_id."_ct";
	            
		$qry = "select a.num from $blog_t a , blog_brd_list b 
		         where a.brd_list_fk = b.num And
					     b.brd_pow_1 >= $auth_key 
						 $s_val_qry
						 $dt_qry ";
        $res = mysql_query($qry,$connect);
		$total_bnum = mysql_num_rows($res);
        mysql_free_result($res);

		if(!$page){
		   $page = 1;
		}
        
		//한 화면에 다섯개씩 출력
		$p_scale=5;

		$cpage = intval($page);
		$totalpage = intval($total_bnum/$p_scale);
		
		if ($totalpage*$p_scale != $total_bnum)
			$totalpage = $totalpage + 1;
			  
		if ($cpage ==1) {
		  $cline = 0 ;
		} else {
		  $cline = ($cpage*$p_scale) - $p_scale ;
		} 
				
		$limit=$cline+$p_scale;
				
		if ($limit >= $total_bnum) 
		   $limit=$total_bnum;

		$p_scale1 = $limit - $cline;

        //자료가 존재하지 않을때
     if((int)$total_bnum < 1){
  ?>
      <tr> 
         <td class=line-n colspan="2" valign="middle" align=center height="100" bgcolor="#f8f8f7">
		   등록된 글이 존재하지 않습니다. 
		 </td>
       </tr>
   <?
	}
	else{
       $mqry = "select a.*,b.brd_title,b.brd_pow_2
	            from $blog_t a , blog_brd_list b 
		        where a.brd_list_fk = b.num And
					     b.brd_pow_1 >= $auth_key 
						 $s_val_qry
						 $dt_qry 
			    order by a.num desc limit $cline,$p_scale1";
	   $mres = mysql_query($mqry, $connect);
	   for($i=0; $mrows = mysql_fetch_array($mres); $i++){
   ?>
	   <tr> 
         <td colspan="2" valign="middle" align=center bgcolor="#f8f8f7">
		   <table border=0 width="98%" align=center >
			 <tr bgcolor="#e1e1e1">
			   <td width="70%" align=left>&nbsp;&nbsp;
			     <b><?=$mrows[title]?> ( <?=$mrows[brd_title]?> )</b> 
			   </td>
			   <td width="30%" align=center>
                <?=substr($mrows[wdate],0,4)?>/<?=substr($mrows[wdate],4,2)?>/<?=substr($mrows[wdate],6,2)?>
				<?
	             //본인일 경우
	             if($auth_key == '1'){
	            ?>
				<input type="button" name="수정" value="수정" onclick="location='blog_edit.php<?=$get_url?>&ed_num=<?=$mrows[num]?>'" class="InputStyle">
				<input type="button" name="삭제" value="삭제" onclick="location='blog_write_manager.php<?=$get_url?>&md=delete&del_num=<?=$mrows[num]?>'" class="InputStyle">
				<?
				 }
				?>
			   </td>
			 </tr>
		  <?
		    if($mrows[blog_img1]){
		  ?>
			 <tr>
			   <td colspan="2" align=center>
			   <img src="../upload/b_image/<?=$b_id?>/<?=$mrows[blog_img1]?>">
			   </td>
			 </tr>
		 <? } ?>
		 <?
		    if($mrows[contents_1]){
		  ?>
			 <tr>
			   <td colspan="2">
			   <?=stripslashes(nl2br($mrows[contents_1]))?>
			   </td>
			 </tr>
		 <? } ?>
		 <?
		    if($mrows[blog_img2]){
		  ?>
			 <tr>
			   <td colspan="2" align=center>
			   <img src="../upload/b_image/<?=$b_id?>/<?=$mrows[blog_img2]?>">
			   </td>
			 </tr>
		 <? } ?>
		 <?
		    if($mrows[contents_2]){
		  ?>
			 <tr>
			   <td colspan="2">
			   <?=stripslashes(nl2br($mrows[contents_2]))?>
			   </td>
			 </tr>
		 <? } ?>
		 <?
		    if($mrows[blog_img3]){
		  ?>
			 <tr>
			   <td colspan="2" align=center>
			   <img src="../upload/b_image/<?=$b_id?>/<?=$mrows[blog_img3]?>">
			   </td>
			 </tr>
		 <? } ?>
		 <?
		    if($mrows[contents_3]){
		  ?>
			 <tr>
			   <td colspan="2">
			   <?=stripslashes(nl2br($mrows[contents_3]))?>
			   </td>
			 </tr>
		 <? } ?>
		   </table>
		 </td>
       </tr>
	   <?
	      $mqry2 = "select * from $blog_ct where num_fk ='$mrows[num]' order by cnum desc ";
		  $mres2 = mysql_query($mqry2,$connect);
		  $mtot2 = mysql_num_rows($mres2);
	   ?>
	   <tr>
	     <td colspan="2" valign="middle" align=center bgcolor="#99CCFF">
		   <table border=0 width="98%" align=center >
			 <tr>
			   <td>
			     댓글 : <?=number_format($mtot2)?> 개 (<a href="<?=$PHP_SELF?><?=$get_url?>&brd_num=<?=$mrows[num]?>&md1=view">보기</a>)
			   </td>
			 </tr>
			</table>
		  </td>
	   </tr>
   <?
     if($md1=='view' && ($brd_num == $mrows[num])){
   ?>
	   <tr>
		 <td align=left colspan="2">
		    <table width="99%" border="0" cellspacing="1" cellpadding="5" bgcolor="#CCCEEE">
			 <?
			 for($j=0; $m_ksh=mysql_fetch_array($mres2);$j++){
			 ?>
				<tr> 
				  <td  class="name" width="140" style="padding:3 0 3 10px" bgcolor="#CCCEEE"><?=$m_ksh[id_fk]?></td>
				  <td bgcolor="#FFFFFF" ><?=stripslashes(nl2br($m_ksh[memo]))?></td>
				  <td width="120" align="center" bgcolor="#FFFFFF"><?=$m_ksh[cdate]?>&nbsp;
			 <?
			   //로그인 중이면서 글쓴이가 본인이거나 블로그 주인일때
			   if($_SESSION[p_id]){
			     if(($m_ksh[id_fk] == $_SESSION[p_id]) || ($auth_key == '1')){
			 ?>		  
			      <a href='blog_memo_manager.php<?=$get_url?>&brd_num=<?=$mrows[num]?>&md=delete&md1=view&del_num=<?=$m_ksh[cnum]?>&ret_url=blog_tlist.php'>X</a>
		      <?		 
				 }
			   }
			  ?>
				  </td>
				</tr>
			  <? 
				}
				mysql_free_result($mres2);
			  ?>
		    </table>
	 <?
	  //댓글 사용일 경우만 쓸수 있도록
	  if($mrows[comm_chk]=='Y'){
		 //해당 권한이 있을때
		 if($mrows[brd_pow_2] >= $auth_key){
	?>
			<table width="99%" border="0" cellspacing="0" cellpadding="0" class="line1">
		  	 <form name='form2' action='blog_memo_manager.php' method='post'>
			  <tr>
			    <td width="140" align="center">답글(댓글)쓰기</td>
			    <td style="padding:5 0 7 5px">
			  	  <textarea name="memo" cols="60" class="InputStyle1" rows="3"></textarea>
				  <input type=image src="../img/bt_ok2.gif" align="absmiddle" border="0">
				</td>
		   	  </tr>
			  <input type='hidden' name='b_id' value='<?=$b_id?>'>
			  <input type='hidden' name='brd_num' value='<?=$mrows[num]?>'>
			  <input type='hidden' name='md' value='insert'>
			  <input type='hidden' name='md1' value='view'>
			  <input type='hidden' name='s_val' value='<?=$s_val?>'>
			  <input type='hidden' name='dt' value='<?=$dt?>'>
			  <input type='hidden' name='ret_url' value='blog_tlist.php'>
			  </form>
		   </table>
     <? 
		 }
	  }
	 ?>
		 </td>
	   </tr>
   <?
	    }		
     }
   ?>
        <tr> 
         <td class=line-n colspan="2" valign="middle" align=center bgcolor="#f8f8f7">
    <?
	//페이지 나누기
	$url = $PHP_SELF.$get_url; 
    page_avg($totalpage,$cpage,$url); 
    ?>   		
		 </td>
       </tr>
<?
}
?>
     </table>
	 <?  
     //사용자가 설정한 부분
     include '../include/blog_main_bt.php';  
     ?>
	</td>
  </tr>
</table>
</body>
</html>
