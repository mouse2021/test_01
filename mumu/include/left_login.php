 <table border="0" cellpadding="0" cellspacing="0" width="200" style="border:5px solid #CCCEEE">
  <tr>
   <td style="padding:4 2 10">  
	  <table border="0" cellpadding="0" cellspacing="0" width="198">
<?
// 이름과 아이디에 해당되는 세션이 존재하는지 확인
if(!$_SESSION[p_id] || !$_SESSION[p_name]){
?>
        <form method='post' name='login' action='/member/login_process.php' onsubmit="JavaScript:return(login_check());">
		<tr>
          <td width="198" height="26"><IMG height=25 src="/img/login_subject.gif" width=200></td>
        </tr>
        <tr>
          <td width="198" height="45">
		   <TABLE cellSpacing=0 cellPadding=0 width=200 border=0>
             <TR>
               <TD height=5></TD>
               <td></td>
               <td></td>
             </TR>
             <TR>
               <TD width=40>
			    <TABLE cellSpacing=0 cellPadding=0 width=100 border=0>
                 <TR>
                   <TD width=40 height=25>
				     <IMG height=9 src="/img/login_id.gif" width=39>
				   </TD>
                   <TD>
				     <INPUT class=loginbox size=12 name=id>
				   </TD>
                 </TR>
                 <TR>
                   <TD height=25>
				     <IMG height=9 src="/img/login_pass.gif" width=39>
				   </TD>
                   <TD>
				    <INPUT class=loginbox type=password size=12 name=pwd>
				   </TD>
                  </TR>
                </TABLE>
			   </TD>
               <TD align=middle width=50>
			    <INPUT type=image height=46 width=45 src="/img/login_btn.gif">
			   </TD>
               <td></td>
             </TR>
             <TR align=middle>
               <td></td>
                <td></td>
                <td></td>
             </tr>
            </table>
            <TABLE height=25 cellSpacing=0 cellPadding=0 width="168" border=0 align="center">
             <TR>
              <TD class=chon11px >
			    <IMG height=7 src="/img/login_blit.gif" width=7 border=0>
				<FONT color=#000000><a href="/member/join.php">회원가입</a></FONT>
			  </TD>
              <TD class=chon11px >
			    <IMG height=7 src="/img/login_blit.gif" width=7 border=0>
				<FONT color=#000000><a href="/member/idpass_search.php">ID/비밀번호 찾기</a></FONT>
			  </TD>
             </TR>
           </TABLE>
		 </TD>
        </TR>
		</form>
 <?
  }
  else{
        //아직 본인이 확인하지 않은 쪽지수 파악
		$t_qry4 = " select count(mnum) as cnt_1 from message_info 
		            where receiveid_fk='$_SESSION[p_id]' And 
				          receive_del='N' And 
				          receive_chk='N' ";
        $t_res4 = mysql_query($t_qry4,$connect);
        $t_rows4 = mysql_fetch_array($t_res4);
        mysql_free_result($t_res4);
 ?> 
		<tr>
          <td width="198" height="26"><IMG height=25 src="/img/login_subject.gif" width=200></td>
        </tr>
        <tr>
          <td width="198" height="45">
		   <table cellspacing=0 cellpadding=0 width=200 border=0>
             <tr>
               <td height=5></td>
               <td></td>
               <td></td>
             </tr>
             <tr>
               <td colspan="3" align=center>
			    <table cellspacing=0 cellpadding=0 width=150 border=0>
                 <tr>
                   <td height=35 align=center> 
				     <?=$_SESSION[p_name]?> 님 반갑습니다.
				   </td>
                 </tr>
                </table>
			   </td>
             </tr>
             <tr align=middle>
               <td></td>
                <td></td>
                <td></td>
             </tr>
            </table>
            <table height=25 cellspacing=0 cellpadding=0 width="168" border=0 align="center">
             <tr>
			  <td class=chon11px >
			    <img height=7 src="/img/login_blit.gif" width=7 border=0>
				<font color=#000000><a href="/member/mem_edit.php">회원수정</a></font>
			  </td>
              <td class=chon11px >
			    <img height=7 src="/img/login_blit.gif" width=7 border=0>
				<font color=#000000><a href="/member/logout_process.php">로그아웃</a></font>
			  </td>
             </tr>
           </table>
		   <table border="0" cellpadding="0" cellspacing="0" width="95%">
			<tr> 
			<td width="13"><img src="/img/bt_msg.gif" align=absmiddle></td>
			<td class="line2" width="75"><a href="/member/message_1.php">새쪽지 수</a></td>
			<td class="line2" align="center" width="10">:</td>
			<td class="line2" align="right" width="62"><a href="/member/message_1.php"><b><?=number_format($t_rows4[cnt_1])?></b> 개</a></td>
		   </tr>
		  </table>
		 </td>
        </tr>
<? 
  }  //end if
 ?>
      </table>
	</td>
  </tr>
</table>