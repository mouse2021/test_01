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
if($blog_logo_name){
  $file_ext1 = substr(strrchr($blog_logo_name,"."), 1);
  if ($file_ext1 != 'jpg' && $file_ext1 != 'gif' && $file_ext1 != 'jpeg' && $file_ext1 != 'bmp' ){
	 err_msg("이미지 파일만 올릴 수 있습니다.");  
  }
  if (!$blog_logo_size) {
	 err_msg("지정한 파일이 없거나 파일 크기가 0KB입니다.");  
  }   
  //해당 이미지가 존재할때
  if($rows1[blog_logo] =='Y'){
    $p_image1 = "../upload/b_image/".$b_id."/blog_logo.".$rows1[blog_logo_ty];
	if(file_exists($p_image1)){
	  unlink($p_image1);
	}
  }
}

//이미지 등록 & 변경시
if($title_bgimg_name){
  $file_ext2 = substr(strrchr($title_bgimg_name,"."), 1);
  if ($file_ext2 != 'jpg' && $file_ext2 != 'gif' && $file_ext2 != 'jpeg' && $file_ext2 != 'bmp' ){
	 err_msg("이미지 파일만 올릴 수 있습니다.");  
  }
  if (!$title_bgimg_size) {
	 err_msg("지정한 파일이 없거나 파일 크기가 0KB입니다.");  
  }   
  //해당 이미지가 존재할때
  if($rows1[title_bgimg] =='Y'){
    $p_image2 = "../upload/b_image/".$b_id."/title_bgimg.".$rows1[title_bgimg_ty];
	if(file_exists($p_image2)){
	  unlink($p_image2);
	}
  }
}

//이미지 등록 & 변경시
if($main_img_name){
  $file_ext3 = substr(strrchr($main_img_name,"."), 1);
  if ($file_ext3 != 'jpg' && $file_ext3 != 'gif' && $file_ext3 != 'jpeg' && $file_ext3 != 'bmp' ){
	 err_msg("이미지 파일만 올릴 수 있습니다.");  
  }
  if (!$main_img_size) {
	 err_msg("지정한 파일이 없거나 파일 크기가 0KB입니다.");  
  }   
  //해당 이미지가 존재할때
  if($rows1[main_img] =='Y'){
    $p_image3 = "../upload/b_image/".$b_id."/main_img.".$rows1[main_img_ty];
	if(file_exists($p_image3)){
	  unlink($p_image3);
	}
  }
}

$blog_name     = addslashes($blog_name);
$nick_name     = addslashes($nick_name);
$blog_cont     = addslashes($blog_cont);
$my_profile    = addslashes($my_profile);
$title_bgcolor = addslashes($title_bgcolor);
$box_bgcolor   = addslashes($box_bgcolor);
$main_text     = addslashes($main_text);
$main_text_bt  = addslashes($main_text_bt);

//이미지 저장
if($blog_logo_name){
  $p_image1_1 = "../upload/b_image/".$b_id."/blog_logo.".$file_ext1;
  copy($blog_logo,$p_image1_1);
  unlink($blog_logo);
  $temp1_char = ", blog_logo='Y' , blog_logo_ty='$file_ext1' ";
}

//이미지 저장
if($title_bgimg_name){
  $p_image2_1 = "../upload/b_image/".$b_id."/title_bgimg.".$file_ext2;
  copy($title_bgimg,$p_image2_1);
  unlink($title_bgimg);
  $temp2_char = ", title_bgimg='Y' , title_bgimg_ty='$file_ext2' ";
}

//이미지 저장
if($main_img_name){
  $p_image3_1 = "../upload/b_image/".$b_id."/main_img.".$file_ext3;
  copy($main_img,$p_image3_1);
  unlink($main_img);
  $temp3_char = ", main_img='Y' , main_img_ty='$file_ext3' ";
}


//기본정보 업데이트
$up1 = "update blog_list set blog_name = '$blog_name',
                             nick_name = '$nick_name',
                             blog_cont = '$blog_cont'
		where user_id='$b_id' ";
$res1 = mysql_query($up1,$connect);

//부가정보 업데이트
$up2 = "update blog_info set my_profile    = '$my_profile',
                             title_bgtype  = '$title_bgtype',
							 title_bgcolor = '$title_bgcolor',
							 box_bgcolor   = '$box_bgcolor' 
							 $temp1_char
							 $temp2_char
							 $temp3_char ,
							 view_chk      = '$view_chk',
							 main_text     = '$main_text',
							 main_text_bt  = '$main_text_bt'
		 where user_id='$b_id' ";
$res2 = mysql_query($up2,$connect);

if($res1 && $res2) {    	 
  msg('내용이 변경되었습니다.');
  echo "<meta http-equiv='Refresh' content='0; URL=blog_mng_form.php?b_id=$b_id'>"; 
}
else{
   err_msg('DB오류가 발생했습니다.');
}

?>
