     <table  border="0" cellpadding="0" cellspacing="0" width="100%">  
		<tr>
          <td width="200" height="32" bgcolor="whitesmoke"><p>&nbsp;<IMG 
src="/img/game_event_icon.gif" align=absMiddle width="14" height="14"> ºÓ«Œ∏Ù ∏ﬁ¥∫</p></td>
        </tr>
	<?
	  // ºÓ«Œ∏Ù ¥Î∫–∑˘
	  $l_qry = "select * from products_category1 ";
	  $l_res = mysql_query($l_qry,$connect);
	  for($i=0; $l_rows = mysql_fetch_array($l_res); $i++){
	?>
        <tr>
          <td width="200" height="23" >&nbsp;<IMG 
src="/img/notice_icon.gif" align=absMiddle width="13" height="14"><a href="/shopping/sub_list.php?l_code=<?=$l_rows[code]?>"><?=$l_rows[name]?></a></td>
        </tr>
	<? 
	  }
	  mysql_free_result($l_res);
    ?>
	    <tr>
          <td width="200" height="10" >&nbsp;</td>
        </tr>
        <tr>
          <td width="200" height="23" ><p>&nbsp;<IMG 
src="/img/notice_icon.gif" align=absMiddle width="13" height="14"><a href="/shopping/basket.php">¿ÂπŸ±∏¥œ</a></p></td>
        </tr>
      </table>