<table border="0" cellpadding="0" cellspacing="0" width="215" style="border:5px solid #D7D7D7">
  <tr>
   <td style="padding:4 2 10">
<?
// �α��� ���� ���
if($_SESSION[p_id]){
	//������ ��α� ��������Ȯ��
	$c_qry = "select * from blog_list where user_id='$_SESSION[p_id]' ";
	$c_res = mysql_query($c_qry,$connect);
	$c_rows = mysql_fetch_array($c_res);
	mysql_free_result($c_res);

	// ������ ��αװ� ���� ���
	if($c_rows){
		//���� ��¥�� ���մϴ�.
		$n_date = date('Ymd');
		//���� ��¥�� �ش�Ǵ� �湮�ڼ�
		$t_qry1 = "select * from blog_visit_count 
				   where user_id='$_SESSION[p_id]' And
						 visit_date = '$n_date' ";
		$t_res1 = mysql_query($t_qry1,$connect);
		$t_rows1 = mysql_fetch_array($t_res1);
		mysql_free_result($t_res1);
		
		//�� �湮��
		$t_qry2 = "select sum(visit_count) as tcnt from blog_visit_count 
				   where user_id='$_SESSION[p_id]' ";
		$t_res2 = mysql_query($t_qry2,$connect);
		$t_rows2 = mysql_fetch_array($t_res2);
		mysql_free_result($t_res2);
		
		//������ ��α� ���̺�
		$blog_t = "bg_".$_SESSION[p_id]."_t";

		//�ѵ�ϵ� ��αױ� ��
		$t_qry3 = "select * from $blog_t ";
		$t_res3 = mysql_query($t_qry3,$connect);
		$tot3 = mysql_num_rows($t_res3);
		mysql_free_result($t_res3);
  
	?>
   <table border="0" cellpadding="0" cellspacing="0" width="95%">
    <tr> 
     <td colspan="4" align=center>
	   <img src="/img/game_event_icon.gif" align=absMiddle> MY ��α� ����
     </td>
    </tr>
	<tr> 
     <td width="13"><img src="/img/notice_icon.gif" align=absMiddle></td>
     <td class="line2" width="75">���� �湮��</td>
     <td class="line2" align="center" width="10">:</td>
     <td class="line2" align="right" width="62">
	   <b><?=number_format($t_rows1[visit_count])?></b> ��
	 </td>
    </tr>
    <tr> 
     <td width="13"><img src="/img/notice_icon.gif" align=absMiddle></td>
     <td class="line2" width="75">�� �湮��</td>
     <td class="line2" align="center" width="10">:</td>
     <td class="line2" align="right" width="62">
	 <b><?=number_format($t_rows2[tcnt])?></b> ��
	 </td>
   </tr>
   <tr> 
     <td width="13"><img src="/img/notice_icon.gif" align=absMiddle></td>
     <td class="line2" width="75">�� �ۼ�</td>
     <td class="line2" align="center" width="10">:</td>
     <td class="line2" align="right" width="62"><b>
	   <a href="/blog/blog_tlist.php?b_id=<?=$_SESSION[p_id]?>"><?=$tot3?></b> ��</a>
	 </td>
   </tr>
   <td width="100%" height="40" valign="middle" colspan="4" align=center>
      <input type="button" name="MY ��α� �ٷΰ���" value="MY ��α� �ٷΰ���" onclick="location='/blog/blog_main.php?b_id=<?=$_SESSION[p_id]?>'" class="InputStyle">
    </td>
   </tr>
  </table>

<?
	}
	else{  //ȸ���α����� �Ǿ������� ������ ��αװ� ���� ���
?>
  <table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr> 
     <td width="100%" colspan="4" height="35" valign=middle align=center>
	   <img src="/img/game_event_icon.gif" align=absMiddle> MY ��α� ����
     </td>
    </tr>
	<tr> 
     <td width="100%" colspan="4" align=center>��αװ� �������� �ʽ��ϴ�.
	 </td>
    </tr>
	<tr> 
     <td width="100%" colspan="4" align=center>
	  <input type="button" name="MY ��α� ����" value="MY ��α� ����" onclick="location='/blog/blog_create_form.php'" class="InputStyle">
	 </td>
    </tr>
 </table>
<?
    }
}
else{  // �α��� ���� �ʾ��� ���
?>
 <table  border="0" cellpadding="0" cellspacing="0" width="100%">
   <tr>
    <td width="200" height="32" bgcolor="whitesmoke"><p>&nbsp;
	  <img src="/img/game_event_icon.gif" align=absMiddle> ����Ʈ �޴�</p>
	</td>
   </tr>
   <tr>
    <td width="200" height="23" >&nbsp;
	 <img src="/img/notice_icon.gif" align=absMiddle>
     <a href="/member/join.php">ȸ������</a>
	</td>
   </tr>
 </table>
<?
}
?>
</td>
</tr>
</table>

