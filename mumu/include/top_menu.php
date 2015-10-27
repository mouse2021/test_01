<TABLE height=77 cellSpacing=0 cellPadding=0 width=939 background="/img/topback.gif" border=0>
 <TR>
   <TD align=middle width=939>
     <TABLE height=77 cellSpacing=0 cellPadding=0 width=890 border=0>
      <TR>
       <TD width="238" height="50">
	     <a href="/index.php"><font size="4" color="white"><b>PHPSAMPLE SITE</b></font></a></TD>
       <TD align=middle width="597" height="50">
	     <FONT color="white">
<?
// 이름과 아이디에 해당되는 세션이 존재하는지 확인
if(!$_SESSION[p_id] || !$_SESSION[p_name]){
?>
		 <b><a href="/member/join.php"><font color=#FFFFFF>회원가입</font></a> 
		 &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp; 
		 <a href="/index.php"><font color=#FFFFFF>블로그</a></a>
<?
 }
 else{
?>
       <b><a href="/member/mem_edit.php"><font color=#FFFFFF>회원수정</font></a> 
	   &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp; 
	   <a href="/blog/blog_main.php?b_id=<?=$_SESSION[p_id]?>"><font color=#FFFFFF>블로그</a>
	   
<? } ?>
		 &nbsp;&nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;
		 <a href="/shopping/shop_main.php"><font color=#FFFFFF>Shopping</font></a> 
		 &nbsp;&nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;
		 <a href="/auction/auct_main.php"><font color=#FFFFFF>Auction</a><BR>
         </b></FONT></TD>
       <TD class=chon11px align=right width="55" height="50">&nbsp;</TD>
      </TR>
    </TABLE>
   </TD>
  </TR>
</TABLE>