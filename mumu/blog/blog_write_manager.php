<?
include "../php/config.php";
// ���� ��ƿ�Լ�
include "../php/util.php";
// MySQL ����
$connect=my_connect($host,$dbid,$dbpass,$dbname);

if(!isset($_SESSION["p_id"]) || !isset($_SESSION["p_name"])){
  err_msg('ȸ�� �α��� �� ����� �� �ֽ��ϴ�.');
}

if($_SESSION[p_id] != $b_id){
  err_msg('������ ��αװ� �ƴմϴ�. ��α� ������ Ȯ���ϼ���.');
}

$qry1  = "select * from blog_list a ,blog_info b 
          where a.user_id='$b_id' And
                a.user_id=b.user_id ";
$res1  = mysql_query($qry1,$connect);
$rows1 = mysql_fetch_array($res1);

if(!$rows1){
  err_msg('��α� ������ �������� �ʽ��ϴ�.');
}

//�̹��� ��� & �����
if($blog_img1_name){
  $file_ext1 = substr(strrchr($blog_img1_name,"."), 1);
  if ($file_ext1 != 'jpg' && $file_ext1 != 'gif' && $file_ext1 != 'jpeg' && $file_ext1 != 'bmp' ){
	 err_msg("�̹��� ���ϸ� �ø� �� �ֽ��ϴ�.");  
  }
  if (!$blog_img1_size) {
	 err_msg("������ ������ ���ų� ���� ũ�Ⱑ 0KB�Դϴ�.");  
  }   
}

//�̹��� ��� & �����
if($blog_img2_name){
  $file_ext2 = substr(strrchr($blog_img2_name,"."), 1);
  if ($file_ext2 != 'jpg' && $file_ext2 != 'gif' && $file_ext2 != 'jpeg' && $file_ext2 != 'bmp' ){
	 err_msg("�̹��� ���ϸ� �ø� �� �ֽ��ϴ�.");  
  }
  if (!$blog_img2_size) {
	 err_msg("������ ������ ���ų� ���� ũ�Ⱑ 0KB�Դϴ�.");  
  }   
}

//�̹��� ��� & �����
if($blog_img3_name){
  $file_ext3 = substr(strrchr($blog_img3_name,"."), 1);
  if ($file_ext3 != 'jpg' && $file_ext3 != 'gif' && $file_ext3 != 'jpeg' && $file_ext3 != 'bmp' ){
	 err_msg("�̹��� ���ϸ� �ø� �� �ֽ��ϴ�.");  
  }
  if (!$blog_img3_size) {
	 err_msg("������ ������ ���ų� ���� ũ�Ⱑ 0KB�Դϴ�.");  
  }   
}

$title          = addslashes($title);
$contents_1     = addslashes($contents_1);
$contents_2     = addslashes($contents_2);
$contents_3     = addslashes($contents_3);

//�ش� ���̺�
$blog_t = "bg_".$b_id."_t";

//���� ������ ���
if($md=='insert'){
	//�̹��� ����
	if($blog_img1_name){
	  $p_image1_1 = "../upload/b_image/".$b_id."/".$blog_img1_name;
	  copy($blog_img1,$p_image1_1);
	  unlink($blog_img1);
	}

	//�̹��� ����
	if($blog_img2_name){
	  $p_image2_1 = "../upload/b_image/".$b_id."/".$blog_img2_name;
	  copy($blog_img2,$p_image2_1);
	  unlink($blog_img2);
	}

	//�̹��� ����
	if($blog_img3_name){
	  $p_image3_1 = "../upload/b_image/".$b_id."/".$blog_img3_name;
	  copy($blog_img3,$p_image3_1);
	  unlink($blog_img3);
	}

    $ndate = date('Ymd');
	
	$ins1 = "insert into $blog_t 
	           ( brd_list_fk,id_fk,name,title,blog_img1,contents_1,
	             blog_img2,contents_2,blog_img3,contents_3,
			     comm_chk,wdate )
			  values('$brd_list_fk','$b_id','$rows1[nick_name]','$title',
				     '$blog_img1_name','$contents_1','$blog_img2_name','$contents_2',
				     '$blog_img3_name','$contents_3','$comm_chk','$ndate' )";
	$res1 = mysql_query($ins1,$connect);
    
	if($res1) {    	 
	  msg('������ ��ϵǾ����ϴ�.');
	  echo "<meta http-equiv='Refresh' content='0; URL=blog_tlist.php?b_id=$b_id'>"; 
	}
	else{
	   err_msg('DB������ �߻��߽��ϴ�.');
	}
}
else if($md=='edit'){

    $c_qry = "select * from $blog_t where num='$ed_num' ";
	$c_res = mysql_query($c_qry,$connect);
	$c_rows = mysql_fetch_array($c_res);

	if(!$c_rows){
	  err_msg('���� �������� �ʽ��ϴ�.');
	}

	//÷�� ������ ������ üũ�Ͽ��� ���
    if($file_chk1 =='1'){  
      if($blog_img1_name){
		 //���� �̹����� ����
		 if($c_rows[blog_img1]){
			$p_image1 = "../upload/b_image/".$b_id."/".$c_rows[blog_img1];
			if(file_exists($p_image1)){
			   unlink($p_image1);
			}
		 }
         //�ű��̹��� ����
		 $p_image1_1 = "../upload/b_image/".$b_id."/".$blog_img1_name;
	     copy($blog_img1,$p_image1_1);
	     unlink($blog_img1);

		 $edit_file1_char = " , blog_img1 = '$blog_img1_name' ";
	   }
	   else{  //���� �̹����� �����Ҷ�
	     //���� �̹����� ����
		 if($c_rows[blog_img1]){
			$p_image1 = "../upload/b_image/".$b_id."/".$c_rows[blog_img1];
			if(file_exists($p_image1)){
			   unlink($p_image1);
			}
		 }
         $edit_file1_char = " , blog_img1 = '' ";
	   }
	}

	//÷�� ������ ������ üũ�Ͽ��� ���
    if($file_chk2 =='1'){  
      if($blog_img2_name){
		 //���� �̹����� ����
		 if($c_rows[blog_img2]){
			$p_image2 = "../upload/b_image/".$b_id."/".$c_rows[blog_img2];
			if(file_exists($p_image2)){
			   unlink($p_image2);
			}
		 }
         //�ű��̹��� ����
		 $p_image2_1 = "../upload/b_image/".$b_id."/".$blog_img2_name;
	     copy($blog_img2,$p_image2_1);
	     unlink($blog_img2);

		 $edit_file2_char = " , blog_img2 = '$blog_img2_name' ";
	   }
	   else{  //���� �̹����� �����Ҷ�
	     //���� �̹����� ����
		 if($c_rows[blog_img2]){
			$p_image2 = "../upload/b_image/".$b_id."/".$c_rows[blog_img2];
			if(file_exists($p_image2)){
			   unlink($p_image2);
			}
		 }
         $edit_file2_char = " , blog_img2 = '' ";
	   }
	}

	//÷�� ������ ������ üũ�Ͽ��� ���
    if($file_chk3 =='1'){  
      if($blog_img3_name){
		 //���� �̹����� ����
		 if($c_rows[blog_img3]){
			$p_image3 = "../upload/b_image/".$b_id."/".$c_rows[blog_img3];
			if(file_exists($p_image3)){
			   unlink($p_image3);
			}
		 }
         //�ű��̹��� ����
		 $p_image3_1 = "../upload/b_image/".$b_id."/".$blog_img3_name;
	     copy($blog_img3,$p_image3_1);
	     unlink($blog_img3);

		 $edit_file3_char = " , blog_img3 = '$blog_img3_name' ";
	   }
	   else{  //���� �̹����� �����Ҷ�
	     //���� �̹����� ����
		 if($c_rows[blog_img3]){
			$p_image3 = "../upload/b_image/".$b_id."/".$c_rows[blog_img3];
			if(file_exists($p_image3)){
			   unlink($p_image3);
			}
		 }
         $edit_file3_char = " , blog_img3 = '' ";
	   }
	}

    $up1 = " update $blog_t set 
                   brd_list_fk = '$brd_list_fk',
				   title = '$title' ,
				   contents_1 = '$contents_1',
				   contents_2 = '$contents_2',
				   contents_3 = '$contents_3'
				   $edit_file1_char
				   $edit_file2_char
				   $edit_file3_char ,
				   comm_chk = '$comm_chk'
			  where num='$ed_num' ";
   $res1 = mysql_query($up1,$connect);
   
    if($res1) {    	 
	  msg('������ �����Ǿ����ϴ�.');
	  echo "<meta http-equiv='Refresh' content='0; URL=blog_tlist.php?b_id=$b_id'>"; 
	}
	else{
	   err_msg('DB������ �߻��߽��ϴ�.');
	}

}
else if($md=='delete'){
  
    $c_qry = "select * from $blog_t where num='$del_num' ";
	$c_res = mysql_query($c_qry,$connect);
	$c_rows = mysql_fetch_array($c_res);

	if(!$c_rows){
	  err_msg('���� �������� �ʽ��ϴ�.');
	}
    
	//�ش� �̹����� �����Ҷ�
	if($c_rows[blog_img1]){
	    $p_image1 = "../upload/b_image/".$b_id."/".$c_rows[blog_img1];
		if(file_exists($p_image1)){
		   unlink($p_image1);
		}
	}

	//�ش� �̹����� �����Ҷ�
	if($c_rows[blog_img2]){
	    $p_image2 = "../upload/b_image/".$b_id."/".$c_rows[blog_img2];
		if(file_exists($p_image2)){
		   unlink($p_image2);
		}
	}

	//�ش� �̹����� �����Ҷ�
	if($c_rows[blog_img3]){
	    $p_image3 = "../upload/b_image/".$b_id."/".$c_rows[blog_img3];
		if(file_exists($p_image3)){
		   unlink($p_image3);
		}
	}
    
	//��� ���̺�
    $blog_ct = "bg_".$b_id."_ct";
    
	//�ش� �ۿ� ���Ե� ��� ����
	$del1 = "delete from $blog_ct where num_fk = '$del_num' ";
	$res1 = mysql_query($del1,$connect);

	$del2 = "delete from $blog_t where num = '$del_num' ";
	$res2 = mysql_query($del2,$connect);

    if($res1 && $res2) {    	 
	  msg('������ �����Ǿ����ϴ�.');
	  echo "<meta http-equiv='Refresh' content='0; URL=blog_tlist.php?b_id=$b_id'>"; 
	}
	else{
	   err_msg('�������� DB������ �߻��߽��ϴ�.');
	}
}
?>
