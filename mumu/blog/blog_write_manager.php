<?
include "../php/config.php";
// 각종 유틸함수
include "../php/util.php";
// MySQL 연결
$connect=my_connect($host,$dbid,$dbpass,$dbname);

if(!isset($_SESSION["p_id"]) || !isset($_SESSION["p_name"])){
  err_msg('회원 로그인 후 사용할 수 있습니다.');
}

if($_SESSION[p_id] != $b_id){
  err_msg('본인의 블로그가 아닙니다. 블로그 정보를 확인하세요.');
}

$qry1  = "select * from blog_list a ,blog_info b 
          where a.user_id='$b_id' And
                a.user_id=b.user_id ";
$res1  = mysql_query($qry1,$connect);
$rows1 = mysql_fetch_array($res1);

if(!$rows1){
  err_msg('블로그 정보가 존재하지 않습니다.');
}

//이미지 등록 & 변경시
if($blog_img1_name){
  $file_ext1 = substr(strrchr($blog_img1_name,"."), 1);
  if ($file_ext1 != 'jpg' && $file_ext1 != 'gif' && $file_ext1 != 'jpeg' && $file_ext1 != 'bmp' ){
	 err_msg("이미지 파일만 올릴 수 있습니다.");  
  }
  if (!$blog_img1_size) {
	 err_msg("지정한 파일이 없거나 파일 크기가 0KB입니다.");  
  }   
}

//이미지 등록 & 변경시
if($blog_img2_name){
  $file_ext2 = substr(strrchr($blog_img2_name,"."), 1);
  if ($file_ext2 != 'jpg' && $file_ext2 != 'gif' && $file_ext2 != 'jpeg' && $file_ext2 != 'bmp' ){
	 err_msg("이미지 파일만 올릴 수 있습니다.");  
  }
  if (!$blog_img2_size) {
	 err_msg("지정한 파일이 없거나 파일 크기가 0KB입니다.");  
  }   
}

//이미지 등록 & 변경시
if($blog_img3_name){
  $file_ext3 = substr(strrchr($blog_img3_name,"."), 1);
  if ($file_ext3 != 'jpg' && $file_ext3 != 'gif' && $file_ext3 != 'jpeg' && $file_ext3 != 'bmp' ){
	 err_msg("이미지 파일만 올릴 수 있습니다.");  
  }
  if (!$blog_img3_size) {
	 err_msg("지정한 파일이 없거나 파일 크기가 0KB입니다.");  
  }   
}

$title          = addslashes($title);
$contents_1     = addslashes($contents_1);
$contents_2     = addslashes($contents_2);
$contents_3     = addslashes($contents_3);

//해당 테이블
$blog_t = "bg_".$b_id."_t";

//글의 저장일 경우
if($md=='insert'){
	//이미지 저장
	if($blog_img1_name){
	  $p_image1_1 = "../upload/b_image/".$b_id."/".$blog_img1_name;
	  copy($blog_img1,$p_image1_1);
	  unlink($blog_img1);
	}

	//이미지 저장
	if($blog_img2_name){
	  $p_image2_1 = "../upload/b_image/".$b_id."/".$blog_img2_name;
	  copy($blog_img2,$p_image2_1);
	  unlink($blog_img2);
	}

	//이미지 저장
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
	  msg('내용이 등록되었습니다.');
	  echo "<meta http-equiv='Refresh' content='0; URL=blog_tlist.php?b_id=$b_id'>"; 
	}
	else{
	   err_msg('DB오류가 발생했습니다.');
	}
}
else if($md=='edit'){

    $c_qry = "select * from $blog_t where num='$ed_num' ";
	$c_res = mysql_query($c_qry,$connect);
	$c_rows = mysql_fetch_array($c_res);

	if(!$c_rows){
	  err_msg('글이 존재하지 않습니다.');
	}

	//첨부 파일의 수정에 체크하였을 경우
    if($file_chk1 =='1'){  
      if($blog_img1_name){
		 //기존 이미지는 삭제
		 if($c_rows[blog_img1]){
			$p_image1 = "../upload/b_image/".$b_id."/".$c_rows[blog_img1];
			if(file_exists($p_image1)){
			   unlink($p_image1);
			}
		 }
         //신규이미지 저장
		 $p_image1_1 = "../upload/b_image/".$b_id."/".$blog_img1_name;
	     copy($blog_img1,$p_image1_1);
	     unlink($blog_img1);

		 $edit_file1_char = " , blog_img1 = '$blog_img1_name' ";
	   }
	   else{  //기존 이미지만 삭제할때
	     //기존 이미지는 삭제
		 if($c_rows[blog_img1]){
			$p_image1 = "../upload/b_image/".$b_id."/".$c_rows[blog_img1];
			if(file_exists($p_image1)){
			   unlink($p_image1);
			}
		 }
         $edit_file1_char = " , blog_img1 = '' ";
	   }
	}

	//첨부 파일의 수정에 체크하였을 경우
    if($file_chk2 =='1'){  
      if($blog_img2_name){
		 //기존 이미지는 삭제
		 if($c_rows[blog_img2]){
			$p_image2 = "../upload/b_image/".$b_id."/".$c_rows[blog_img2];
			if(file_exists($p_image2)){
			   unlink($p_image2);
			}
		 }
         //신규이미지 저장
		 $p_image2_1 = "../upload/b_image/".$b_id."/".$blog_img2_name;
	     copy($blog_img2,$p_image2_1);
	     unlink($blog_img2);

		 $edit_file2_char = " , blog_img2 = '$blog_img2_name' ";
	   }
	   else{  //기존 이미지만 삭제할때
	     //기존 이미지는 삭제
		 if($c_rows[blog_img2]){
			$p_image2 = "../upload/b_image/".$b_id."/".$c_rows[blog_img2];
			if(file_exists($p_image2)){
			   unlink($p_image2);
			}
		 }
         $edit_file2_char = " , blog_img2 = '' ";
	   }
	}

	//첨부 파일의 수정에 체크하였을 경우
    if($file_chk3 =='1'){  
      if($blog_img3_name){
		 //기존 이미지는 삭제
		 if($c_rows[blog_img3]){
			$p_image3 = "../upload/b_image/".$b_id."/".$c_rows[blog_img3];
			if(file_exists($p_image3)){
			   unlink($p_image3);
			}
		 }
         //신규이미지 저장
		 $p_image3_1 = "../upload/b_image/".$b_id."/".$blog_img3_name;
	     copy($blog_img3,$p_image3_1);
	     unlink($blog_img3);

		 $edit_file3_char = " , blog_img3 = '$blog_img3_name' ";
	   }
	   else{  //기존 이미지만 삭제할때
	     //기존 이미지는 삭제
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
	  msg('내용이 수정되었습니다.');
	  echo "<meta http-equiv='Refresh' content='0; URL=blog_tlist.php?b_id=$b_id'>"; 
	}
	else{
	   err_msg('DB오류가 발생했습니다.');
	}

}
else if($md=='delete'){
  
    $c_qry = "select * from $blog_t where num='$del_num' ";
	$c_res = mysql_query($c_qry,$connect);
	$c_rows = mysql_fetch_array($c_res);

	if(!$c_rows){
	  err_msg('글이 존재하지 않습니다.');
	}
    
	//해당 이미지가 존재할때
	if($c_rows[blog_img1]){
	    $p_image1 = "../upload/b_image/".$b_id."/".$c_rows[blog_img1];
		if(file_exists($p_image1)){
		   unlink($p_image1);
		}
	}

	//해당 이미지가 존재할때
	if($c_rows[blog_img2]){
	    $p_image2 = "../upload/b_image/".$b_id."/".$c_rows[blog_img2];
		if(file_exists($p_image2)){
		   unlink($p_image2);
		}
	}

	//해당 이미지가 존재할때
	if($c_rows[blog_img3]){
	    $p_image3 = "../upload/b_image/".$b_id."/".$c_rows[blog_img3];
		if(file_exists($p_image3)){
		   unlink($p_image3);
		}
	}
    
	//댓글 테이블
    $blog_ct = "bg_".$b_id."_ct";
    
	//해당 글에 포함된 댓글 삭제
	$del1 = "delete from $blog_ct where num_fk = '$del_num' ";
	$res1 = mysql_query($del1,$connect);

	$del2 = "delete from $blog_t where num = '$del_num' ";
	$res2 = mysql_query($del2,$connect);

    if($res1 && $res2) {    	 
	  msg('내용이 삭제되었습니다.');
	  echo "<meta http-equiv='Refresh' content='0; URL=blog_tlist.php?b_id=$b_id'>"; 
	}
	else{
	   err_msg('삭제도중 DB오류가 발생했습니다.');
	}
}
?>
