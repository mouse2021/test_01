      <?
	  if($rows1[title_bgtype] =='1'){
	    if($rows1[title_bgcolor]){
	       $t_gb_char = "bgcolor='$rows1[title_bgcolor]' ";
		}
		else{
		   $t_gb_char = "bgcolor='#FFFFFF' ";
		}
	  }
	  else if($rows1[title_bgtype] =='2'){
	     if($rows1[title_bgimg]=='Y'){
			$t_img = "../upload/b_image/".$b_id."/title_bgimg.".$rows1[title_bgimg_ty];
		    $t_gb_char = "background='$t_img' ";
		 }
	  }
	?>
     <table width="100%" <?=$t_gb_char?> border="0" cellspacing="0" cellpadding="0">
      <tr> 
        <td height="30" >
		  <?=$rows1[blog_name]?>
		</td>
      </tr>
	  <tr> 
        <td >
		  <?=$rows1[blog_cont]?>
		</td>
      </tr>
     </table>
     
	 <?
	   if($rows1[main_img] =='Y'){
		   $m_img = "../upload/b_image/".$b_id."/main_img.".$rows1[main_img_ty];
	 ?>
	 <br>
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr> 
        <td >
		  <img src="<?=$m_img?>" border="0">
		</td>
      </tr>
     </table>
	 <?
	   }
	 ?>

	 <?
	 if($rows1[main_text]){
	 ?>
	 <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr> 
        <td >
		  <?=stripslashes($rows1[main_text])?>
		</td>
      </tr>
     </table>
	 <?
	 }
	 ?>